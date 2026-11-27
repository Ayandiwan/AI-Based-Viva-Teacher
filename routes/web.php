<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\ProfileController;

// =======================
// ADMIN CONTROLLERS
// =======================

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminManageTeacherController;
use App\Http\Controllers\Admin\AdminManageStudentController;

// =======================
// TEACHER CONTROLLERS
// =======================

use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\SubjectController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\ResultController;

// =======================
// STUDENT CONTROLLERS
// =======================

use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentVivaController;

// =======================
// AUTH CONTROLLERS
// =======================

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\TeacherAuthController;
use App\Http\Controllers\Auth\StudentAuthController;

// =======================
// RESULT CONTROLLERS
// =======================

use App\Http\Controllers\StudentResultController;

// =======================
// OTHER CONTROLLERS
// =======================

use App\Http\Controllers\ContactController;


// ======================================================
// HOME
// ======================================================

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/features', 'features')->name('features');


// ======================================================
// CONTACT
// ======================================================

Route::get(
    '/contact',
    [ContactController::class, 'index']
)->name('contact');

Route::post(
    '/contact',
    [ContactController::class, 'store']
)->name('contact.store');


// ======================================================
// DEFAULT DASHBOARD
// ======================================================

Route::get('/dashboard', function () {

    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->role == 'teacher') {
        return redirect()->route('teacher.dashboard');
    }

    if ($user->role == 'student') {
        return redirect()->route('student.dashboard');
    }

    abort(403, 'Invalid Role');

})->middleware('auth')->name('dashboard');


// ======================================================
// PROFILE
// ======================================================

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete(
        '/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');

});


// ======================================================
// ADMIN LOGIN
// ======================================================

Route::get(
    '/admin/login',
    [AdminAuthController::class, 'showLoginForm']
)->name('admin.login');

Route::post(
    '/admin/login',
    [AdminAuthController::class, 'login']
)->name('admin.login.submit');


// ======================================================
// ADMIN MODULE
// ======================================================

Route::middleware(['auth', 'admin'])->group(function () {

    // ADMIN DASHBOARD

    Route::get(
        '/admin/dashboard',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');

    // MANAGE TEACHERS

    Route::get(
        '/admin/teachers',
        [AdminManageTeacherController::class, 'index']
    )->name('admin.teachers');

    Route::get(
        '/admin/teachers/create',
        [AdminManageTeacherController::class, 'create']
    )->name('admin.teachers.create');

    Route::post(
        '/admin/teachers/store',
        [AdminManageTeacherController::class, 'store']
    )->name('admin.teachers.store');

    Route::delete(
        '/admin/teachers/{id}',
        [AdminManageTeacherController::class, 'destroy']
    )->name('admin.teachers.delete');

    Route::get(
        '/admin/teachers/status/{id}',
        [AdminManageTeacherController::class, 'status']
    )->name('admin.teachers.status');

    // MANAGE STUDENTS

    Route::get(
        '/admin/students',
        [AdminManageStudentController::class, 'index']
    )->name('admin.students');

    Route::delete(
        '/admin/students/{id}',
        [AdminManageStudentController::class, 'destroy']
    )->name('admin.students.delete');

    Route::get(
        '/admin/students/status/{id}',
        [AdminManageStudentController::class, 'status']
    )->name('admin.students.status');

    // ADMIN REPORTS

    Route::get(
        '/admin/reports',
        [AdminController::class, 'reports']
    )->name('admin.reports');

    Route::get(
        '/admin/reports/download',
        [AdminController::class, 'downloadReport']
    )->name('admin.reports.download');

    Route::get(
        '/admin/reports/attempt/{resultId}',
        [AdminController::class, 'viewAttempt']
    )->name('admin.reports.attempt');

});


// ======================================================
// TEACHER MODULE
// ======================================================

Route::middleware(['auth', 'teacher'])->group(function () {

    // TEACHER DASHBOARD

    Route::get(
        '/teacher/dashboard',
        [TeacherController::class, 'dashboard']
    )->name('teacher.dashboard');

    // MANAGE STUDENTS

    Route::get(
        '/teacher/students',
        [TeacherController::class, 'students']
    )->name('teacher.students');

    Route::delete(
        '/teacher/students/{id}',
        [TeacherController::class, 'destroyStudent']
    )->name('teacher.students.delete');

    Route::get(
        '/teacher/students/status/{id}',
        [TeacherController::class, 'studentStatus']
    )->name('teacher.students.status');

    // SUBJECTS

    Route::resource('subjects', SubjectController::class);

    // QUESTIONS

    Route::resource('questions', QuestionController::class);

    // RESULTS

    Route::get(
        '/teacher/results',
        [ResultController::class, 'index']
    )->name('teacher.results');

    Route::get(
        '/teacher/results/{id}',
        [ResultController::class, 'show']
    )->name('teacher.results.show');

    Route::get(
        '/teacher/results/{id}/download',
        [ResultController::class, 'download']
    )->name('teacher.results.download');

});


// ======================================================
// STUDENT LOGIN
// ======================================================

Route::get(
    '/student/login',
    [StudentAuthController::class, 'showLoginForm']
)->name('student.login');

Route::post(
    '/student/login',
    [StudentAuthController::class, 'login']
)->name('student.login.submit');


// ======================================================
// STUDENT MODULE
// ======================================================

Route::middleware(['auth', 'student'])->group(function () {

    // PERFORMANCE

    Route::get(
        '/student/performance',
        [StudentController::class, 'performance']
    )->name('student.performance');

    // DASHBOARD

    Route::get(
        '/student/dashboard',
        [StudentController::class, 'dashboard']
    )->name('student.dashboard');

    // SUBJECTS

    Route::get(
        '/student/subjects',
        [StudentVivaController::class, 'subjects']
    )->name('student.subjects');

    // HISTORY

    Route::get(
        '/student/history',
        [StudentController::class, 'history']
    )->name('student.history');

    // AI RESULT HISTORY

    Route::get(
        '/student/results',
        [StudentResultController::class, 'index']
    )->name('student.results');

    Route::get(
        '/student/results/view/{id}',
        [StudentResultController::class, 'show']
    )->name('student.result.show');

    // AI VIVA START

    Route::get(
        '/student/viva/{subject}',
        [StudentVivaController::class, 'start']
    )->name('student.viva.start');

    // AI ANSWER EVALUATION
    // GROQ + GEMINI + OPENROUTER

    Route::post(
        '/student/answer-submit',
        [StudentVivaController::class, 'evaluate']
    )->name('student.answer.submit');

    // AI VIVA FINAL RESULT

    Route::get(
        '/student/viva/result',
        [StudentVivaController::class, 'result']
    )->name('student.viva.result');

});

// ======================================================
// CLOUDFLARE API TOKEN TEST
// TEMPORARY TEST ROUTE
// ======================================================

// ======================================================
// CLOUDFLARE AI ANSWER SCORE TEST
// TEMPORARY TEST ROUTE
// ======================================================

Route::get('/test-cloudflare-token', function () {

    $accountId = config('services.cloudflare.account_id');
    $apiToken = config('services.cloudflare.api_token');

    if (!$accountId || !$apiToken) {
        return response()->json([
            'success' => false,
            'message' => 'Cloudflare Account ID or API token is missing.'
        ], 500);
    }

    $response = Http::withToken($apiToken)
        ->timeout(60)
        ->post(
            "https://api.cloudflare.com/client/v4/accounts/{$accountId}/ai/run/@cf/meta/llama-3.1-8b-instruct",
            [
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Evaluate a student answer against the expected answer. Give a score from 0 to 10 based on relevant concepts and meaning, not exact wording. Return only valid JSON with score, feedback, and matched_concepts.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Question: What is PHP?\nExpected answer: PHP is a server-side scripting language used for web development.\nStudent answer: PHP is used to develop dynamic web applications.\n\nReturn JSON with score, feedback, and matched_concepts."
                    ]
                ]
            ]
        );

    if ($response->failed()) {
        return response()->json([
            'success' => false,
            'status' => $response->status(),
            'error' => $response->json()
        ], 502);
    }

    return response()->json([
        'success' => true,
        'result' => $response->json()
    ]);

})->name('test.cloudflare.token');


// ======================================================
// AUTH ROUTES
// ======================================================

require __DIR__ . '/auth.php';
