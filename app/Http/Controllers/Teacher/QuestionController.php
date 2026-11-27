<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Subject;

class QuestionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display All Questions
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $questions = Question::whereHas('subject', function ($query) {
                $query->where('teacher_id', Auth::id());
            })
            ->with('subject')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'teacher.questions.listquestion',
            compact('questions')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Add Question Form
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $subjects = Subject::where('teacher_id', Auth::id())
            ->orderBy('subject_name')
            ->get();

        return view(
            'teacher.questions.addquestion',
            compact('subjects')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Store Question
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Check Subject
        |--------------------------------------------------------------------------
        */

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Check Subject Belongs To Logged-In Teacher
        |--------------------------------------------------------------------------
        */

        $subject = Subject::where('id', $request->subject_id)
            ->where('teacher_id', Auth::id())
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | AI QUESTION GENERATION
        |--------------------------------------------------------------------------
        */

        if ($request->has('generate_ai')) {

            /*
            |--------------------------------------------------------------------------
            | AI Mode Validation
            |--------------------------------------------------------------------------
            */

            $request->validate([
                'question_file' => [
                    'required',
                    'file',
                    'mimes:pdf,docx,txt',
                    'max:10240',
                ],
            ]);


            /*
            |--------------------------------------------------------------------------
            | Get Uploaded File
            |--------------------------------------------------------------------------
            */

            $file = $request->file('question_file');


            /*
            |--------------------------------------------------------------------------
            | File Name
            |--------------------------------------------------------------------------
            */

            $fileName = $file->getClientOriginalName();


            /*
            |--------------------------------------------------------------------------
            | Temporary File Path
            |--------------------------------------------------------------------------
            */

            $filePath = $file->getRealPath();


            /*
            |--------------------------------------------------------------------------
            | Read TXT File
            |--------------------------------------------------------------------------
            */

            $text = '';

            if ($file->getClientOriginalExtension() === 'txt') {

                $text = file_get_contents($filePath);
            }


            /*
            |--------------------------------------------------------------------------
            | PDF
            |--------------------------------------------------------------------------
            |
            | PDF text extraction should be connected here.
            |
            | If you already have PDF extraction code/library,
            | put it here.
            |
            |--------------------------------------------------------------------------
            */

            elseif ($file->getClientOriginalExtension() === 'pdf') {

                /*
                |--------------------------------------------------------------------------
                | PDF TEXT EXTRACTION
                |--------------------------------------------------------------------------
                |
                | Install:
                |
                | composer require smalot/pdfparser
                |
                */

                if (class_exists('\Smalot\PdfParser\Parser')) {

                    $parser = new \Smalot\PdfParser\Parser();

                    $pdf = $parser->parseFile($filePath);

                    $text = $pdf->getText();

                } else {

                    return back()
                        ->withErrors([
                            'question_file' =>
                                'PDF Parser is not installed. Run: composer require smalot/pdfparser'
                        ])
                        ->withInput();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | DOCX TEXT EXTRACTION
            |--------------------------------------------------------------------------
            */

            elseif ($file->getClientOriginalExtension() === 'docx') {

                /*
                |--------------------------------------------------------------------------
                | DOCX uses ZIP/XML
                |--------------------------------------------------------------------------
                */

                $zip = new \ZipArchive();

                if ($zip->open($filePath) === true) {

                    $xml = $zip->getFromName('word/document.xml');

                    $zip->close();

                    if ($xml !== false) {

                        $text = strip_tags($xml);

                        $text = html_entity_decode($text);
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Check Extracted Text
            |--------------------------------------------------------------------------
            */

            $text = trim($text);


            if (empty($text)) {

                return back()
                    ->withErrors([
                        'question_file' =>
                            'Could not read text from the uploaded file.'
                    ])
                    ->withInput();
            }


            /*
            |--------------------------------------------------------------------------
            | IMPORTANT
            |--------------------------------------------------------------------------
            |
            | At this point:
            |
            | $text
            |
            | contains the text from the uploaded PDF/DOCX/TXT.
            |
            | Example:
            |
            | 1. What is HTML?
            | HTML stands for HyperText Markup Language...
            |
            | 2. What is CSS?
            | CSS stands for Cascading Style Sheets...
            |
            |--------------------------------------------------------------------------
            */


            /*
            |--------------------------------------------------------------------------
            | TEMPORARY QUESTION GENERATION
            |--------------------------------------------------------------------------
            |
            | This section demonstrates extracting numbered questions
            | from the uploaded study material.
            |
            | For real AI generation, this $text should be sent to
            | your AI API and the returned questions should be saved.
            |--------------------------------------------------------------------------
            */

            $generatedQuestions = [];


            /*
            |--------------------------------------------------------------------------
            | Try To Detect Numbered Questions
            |--------------------------------------------------------------------------
            */

            preg_match_all(
                '/(?:^|\n)\s*(\d+)[\.\)]\s*(.+?)(?=\n\s*\d+[\.\)]|\z)/s',
                $text,
                $matches
            );


            if (!empty($matches[2])) {

                foreach ($matches[2] as $block) {

                    $block = trim($block);

                    /*
                    |--------------------------------------------------------------------------
                    | Separate Question And Answer
                    |--------------------------------------------------------------------------
                    */

                    $lines = preg_split(
                        '/\r\n|\r|\n/',
                        $block
                    );

                    $lines = array_values(
                        array_filter(
                            array_map('trim', $lines)
                        )
                    );


                    if (empty($lines)) {
                        continue;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | First Line = Question
                    |--------------------------------------------------------------------------
                    */

                    $generatedQuestion = $lines[0];


                    /*
                    |--------------------------------------------------------------------------
                    | Remaining Lines = Answer
                    |--------------------------------------------------------------------------
                    */

                    $generatedAnswer = '';

                    if (count($lines) > 1) {

                        $generatedAnswer = implode(
                            ' ',
                            array_slice($lines, 1)
                        );
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Clean Question
                    |--------------------------------------------------------------------------
                    */

                    $generatedQuestion = preg_replace(
                        '/^\d+[\.\)]\s*/',
                        '',
                        $generatedQuestion
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Save Generated Question In Array
                    |--------------------------------------------------------------------------
                    */

                    $generatedQuestions[] = [

                        'question' => trim(
                            $generatedQuestion
                        ),

                        'answer' => trim(
                            $generatedAnswer
                        ),

                    ];
                }
            }


            /*
            |--------------------------------------------------------------------------
            | If Questions Were Found
            |--------------------------------------------------------------------------
            */

            if (!empty($generatedQuestions)) {

                foreach ($generatedQuestions as $generated) {

                    /*
                    |--------------------------------------------------------------------------
                    | If Answer Is Empty
                    |--------------------------------------------------------------------------
                    */

                    if (empty($generated['answer'])) {

                        $generated['answer'] =
                            'Answer generated from uploaded study material.';
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Save Question
                    |--------------------------------------------------------------------------
                    */

                    Question::create([

                        'subject_id' => $subject->id,

                        'question' => $generated['question'],

                        'answer' => $generated['answer'],

                        'difficulty' => 'Easy',

                    ]);
                }


                /*
                |--------------------------------------------------------------------------
                | Success
                |--------------------------------------------------------------------------
                */

                return redirect()
                    ->route('questions.index')
                    ->with(
                        'success',
                        count($generatedQuestions) .
                        ' questions generated from ' .
                        $fileName .
                        ' successfully.'
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | No Numbered Questions Found
            |--------------------------------------------------------------------------
            */

            return back()
                ->withErrors([
                    'question_file' =>
                        'The file was read successfully, but no numbered questions were found.'
                ])
                ->withInput();
        }


        /*
        |--------------------------------------------------------------------------
        | MANUAL QUESTION
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'question' => 'required|string',

            'answer' => 'required|string',

            'difficulty' => 'required|in:Easy,Medium,Hard',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Save Manual Question
        |--------------------------------------------------------------------------
        */

        Question::create([

            'subject_id' => $subject->id,

            'question' => trim(
                $request->question
            ),

            'answer' => trim(
                $request->answer
            ),

            'difficulty' => $request->difficulty,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('questions.index')
            ->with(
                'success',
                'Question Added Successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Question
    |--------------------------------------------------------------------------
    */
    public function edit(Question $question)
    {
        /*
        |--------------------------------------------------------------------------
        | Check Teacher Ownership
        |--------------------------------------------------------------------------
        */

        if ($question->subject->teacher_id != Auth::id()) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Teacher Subjects
        |--------------------------------------------------------------------------
        */

        $subjects = Subject::where(
                'teacher_id',
                Auth::id()
            )
            ->orderBy('subject_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Edit View
        |--------------------------------------------------------------------------
        */

        return view(
            'teacher.questions.editquestion',
            compact(
                'question',
                'subjects'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Question
    |--------------------------------------------------------------------------
    */
    public function update(
        Request $request,
        Question $question
    ) {

        /*
        |--------------------------------------------------------------------------
        | Check Teacher Ownership
        |--------------------------------------------------------------------------
        */

        if ($question->subject->teacher_id != Auth::id()) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $request->validate([

            'subject_id' =>
                'required|exists:subjects,id',

            'question' =>
                'required|string',

            'answer' =>
                'required|string',

            'difficulty' =>
                'required|in:Easy,Medium,Hard',

        ]);


        /*
        |--------------------------------------------------------------------------
        | Check New Subject Belongs To Teacher
        |--------------------------------------------------------------------------
        */

        $subject = Subject::where(
                'id',
                $request->subject_id
            )
            ->where(
                'teacher_id',
                Auth::id()
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Update Question
        |--------------------------------------------------------------------------
        */

        $question->update([

            'subject_id' =>
                $subject->id,

            'question' =>
                trim(
                    $request->question
                ),

            'answer' =>
                trim(
                    $request->answer
                ),

            'difficulty' =>
                $request->difficulty,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('questions.index')
            ->with(
                'success',
                'Question Updated Successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Question
    |--------------------------------------------------------------------------
    */
    public function destroy(Question $question)
    {
        /*
        |--------------------------------------------------------------------------
        | Check Teacher Ownership
        |--------------------------------------------------------------------------
        */

        if ($question->subject->teacher_id != Auth::id()) {

            abort(403);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete
        |--------------------------------------------------------------------------
        */

        $question->delete();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('questions.index')
            ->with(
                'success',
                'Question Deleted Successfully.'
            );
    }
}