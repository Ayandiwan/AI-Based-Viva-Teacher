@extends('layouts.app')

@section('title','AI Viva Teacher')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-9">

            <div class="card border-0 shadow-lg rounded-4">

                <!-- Header -->
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">

                    <h2 class="fw-bold mb-1">
                        🤖 AI Viva Teacher
                    </h2>

                    <small>
                        Smart AI Based Viva Practice System
                    </small>

                </div>

                <div class="card-body p-4">

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <!-- AI Robot -->
                    <div class="text-center mb-4">

                        <img
                            src="https://cdn-icons-png.flaticon.com/512/4712/4712027.png"
                            class="img-fluid"
                            width="110"
                            alt="AI Robot">

                    </div>


                    <!-- Subject Card -->
                    <div class="card bg-light border-0 shadow-sm mb-4">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-md-8">

                                    <h4 class="fw-bold text-primary">
                                        📘 {{ $subject->subject_name }}
                                    </h4>

                                    <p class="text-muted mb-0">
                                        AI Viva Examination
                                    </p>

                                </div>

                                <div class="col-md-4 text-end">

                                    <span
                                        id="timerBox"
                                        class="badge bg-success fs-5 px-4 py-3 rounded-pill">

                                        ⏳
                                        <span id="timer">02:00</span>

                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- Progress -->

                    @php

                        $questionNo = isset($current) ? $current : 1;

                        $totalQuestions = isset($total) ? $total : 0;

                        if($totalQuestions > 0){

                            $progress =
                                ($questionNo / $totalQuestions) * 100;

                        }else{

                            $progress = 0;

                        }

                    @endphp


                    <div class="mb-4">

                        <div class="d-flex justify-content-between mb-2">

                            <strong>
                                Question {{ $questionNo }} of {{ $totalQuestions }}
                            </strong>

                            <strong>
                                {{ round($progress) }}%
                            </strong>

                        </div>


                        <div
                            class="progress"
                            style="height:12px;">

                            <div
                                class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                role="progressbar"
                                aria-valuemin="0"
                                aria-valuemax="100"
                                aria-valuenow="{{ round($progress) }}"
                                style="width: {{ $progress }}%;">

                            </div>

                        </div>

                    </div>


                    <!-- ================= QUESTION ================= -->

                    <div class="card shadow-sm border-primary mb-4">

                        <div class="card-header bg-primary text-white">

                            <h5 class="mb-0">
                                🎯 Viva Question
                            </h5>

                        </div>

                        <div class="card-body">

                            <h4
                                id="questionText"
                                class="fw-bold">

                                {{ $question->question ?? 'No Question Available' }}

                            </h4>

                        </div>

                    </div>


                    <!-- ================= LISTEN BUTTON ================= -->

                    <div class="text-center mb-4">

                        <button
                            type="button"
                            class="btn btn-primary btn-lg"
                            onclick="speakQuestion()">

                            🔊 Listen Question

                        </button>

                    </div>


                    <!-- ================= VIVA FORM ================= -->

                    <form
                        id="vivaForm"
                        method="POST"
                        enctype="multipart/form-data"
                        action="{{ route('student.answer.submit') }}">

                        @csrf


                        <input
                            type="hidden"
                            name="subject_id"
                            value="{{ $subject->id }}">


                        <input
                            type="hidden"
                            name="question_id"
                            value="{{ $question->id ?? '' }}">


                        <h5 class="fw-bold mb-3">

                            Select Answer Method

                        </h5>


                        <!-- TEXT OPTION -->

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="radio"
                                id="textOption"
                                name="answer_type"
                                value="text">

                            <label
                                class="form-check-label"
                                for="textOption">

                                ✍ Text Answer

                            </label>

                        </div>


                        <!-- VOICE OPTION - DEFAULT -->

                        <div class="form-check mb-4">

                            <input
                                class="form-check-input"
                                type="radio"
                                id="voiceOption"
                                name="answer_type"
                                value="voice"
                                checked>

                            <label
                                class="form-check-label fw-bold"
                                for="voiceOption">

                                🎤 Voice Answer

                            </label>

                        </div>


                        <!-- ANSWER BOX -->

                        <div class="mb-4">

                            <label class="form-label fw-bold">

                                Your Answer

                            </label>


                            <textarea
                                id="answer"
                                name="answer"
                                class="form-control form-control-lg"
                                rows="7"
                                placeholder="Speak your answer..."
                                readonly></textarea>


                            <small class="text-muted">

                                🎤 Voice Answer is selected by default.
                                Click <strong>Start Voice</strong> and speak your answer.

                            </small>

                        </div>


                        <!-- VOICE RECORDING -->

                        <div
                            id="voiceButtons"
                            class="card border-danger shadow-sm mb-4">

                            <div class="card-header bg-danger text-white">

                                <h5 class="mb-0">

                                    🎤 Voice Recording

                                </h5>

                            </div>


                            <div class="card-body text-center">

                                <p class="text-muted">

                                    Click <strong>Start Voice</strong>
                                    and answer the question.

                                </p>


                                <div
                                    class="d-flex justify-content-center gap-3 flex-wrap">

                                    <button
                                        type="button"
                                        class="btn btn-danger btn-lg"
                                        onclick="startVoice()">

                                        🎙 Start Voice

                                    </button>


                                    <button
                                        type="button"
                                        class="btn btn-warning btn-lg"
                                        onclick="stopVoice()">

                                        ⏹ Stop Voice

                                    </button>

                                </div>


                                <div class="mt-3">

                                    <span
                                        id="voiceStatus"
                                        class="badge bg-secondary">

                                        Waiting...

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- BUTTONS -->

                        <div class="row g-3">

                            <div class="col-md-4">

                                <button
                                    type="button"
                                    class="btn btn-secondary w-100"
                                    onclick="clearAnswer()">

                                    🗑 Clear

                                </button>

                            </div>


                            <div class="col-md-4">

                                <button
                                    type="button"
                                    class="btn btn-info text-white w-100"
                                    onclick="speakQuestion()">

                                    🔊 Listen Again

                                </button>

                            </div>


                            <div class="col-md-4">

                                <button
                                    type="submit"
                                    id="submitButton"
                                    class="btn btn-success w-100">

                                    ✅ Submit Answer

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script>

const answerBox =
    document.getElementById("answer");

const textOption =
    document.getElementById("textOption");

const voiceOption =
    document.getElementById("voiceOption");

const voiceButtons =
    document.getElementById("voiceButtons");

const voiceStatus =
    document.getElementById("voiceStatus");

const timer =
    document.getElementById("timer");

const timerBox =
    document.getElementById("timerBox");

const vivaForm =
    document.getElementById("vivaForm");

const submitButton =
    document.getElementById("submitButton");


let recognition = null;

let totalSeconds = 120;

let timerInterval = null;


/* =========================================================
   ANTI COPY / PASTE PROTECTION
   ========================================================= */


/* Disable Right Click */

document.addEventListener("contextmenu", function(e) {

    e.preventDefault();

});


/* Disable Copy */

document.addEventListener("copy", function(e) {

    e.preventDefault();

    alert(
        "❌ Copy is disabled during the Viva session."
    );

});


/* Disable Cut */

document.addEventListener("cut", function(e) {

    e.preventDefault();

    alert(
        "❌ Cut is disabled during the Viva session."
    );

});


/* Disable Paste */

document.addEventListener("paste", function(e) {

    e.preventDefault();

    alert(
        "❌ Paste is disabled during the Viva session."
    );

});


/* Disable Drag & Drop */

document.addEventListener("dragstart", function(e) {

    e.preventDefault();

});


document.addEventListener("drop", function(e) {

    e.preventDefault();

});


/* Disable Keyboard Shortcuts */

document.addEventListener("keydown", function(e) {


    /* Ctrl + C */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "c"
    ){

        e.preventDefault();

        alert(
            "❌ Copy is disabled during the Viva session."
        );

        return;

    }


    /* Ctrl + V */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "v"
    ){

        e.preventDefault();

        alert(
            "❌ Paste is disabled during the Viva session."
        );

        return;

    }


    /* Ctrl + X */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "x"
    ){

        e.preventDefault();

        alert(
            "❌ Cut is disabled during the Viva session."
        );

        return;

    }


    /* Ctrl + A */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "a"
    ){

        e.preventDefault();

        return;

    }


    /* Ctrl + U */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "u"
    ){

        e.preventDefault();

        return;

    }


    /* Ctrl + S */

    if(
        e.ctrlKey &&
        e.key.toLowerCase() === "s"
    ){

        e.preventDefault();

        return;

    }


    /* F12 */

    if(e.key === "F12"){

        e.preventDefault();

        return;

    }


    /* Ctrl + Shift + I */

    if(
        e.ctrlKey &&
        e.shiftKey &&
        e.key.toLowerCase() === "i"
    ){

        e.preventDefault();

        return;

    }


    /* Ctrl + Shift + J */

    if(
        e.ctrlKey &&
        e.shiftKey &&
        e.key.toLowerCase() === "j"
    ){

        e.preventDefault();

        return;

    }


    /* Ctrl + Shift + C */

    if(
        e.ctrlKey &&
        e.shiftKey &&
        e.key.toLowerCase() === "c"
    ){

        e.preventDefault();

        return;

    }


    /* Print Screen */

    if(e.key === "PrintScreen"){

        e.preventDefault();

        alert(
            "❌ Screenshot action is restricted during the Viva."
        );

        return;

    }

});


/* Disable Selection */

document.addEventListener("selectstart", function(e) {

    e.preventDefault();

});


/* =========================================================
   TEXT MODE
   ========================================================= */

textOption.addEventListener(
    "change",
    function(){

        if(this.checked){

            stopVoice();

            answerBox.readOnly = false;

            answerBox.placeholder =
                "Type your answer here...";

            voiceButtons.style.display =
                "none";

            voiceStatus.innerHTML =
                "Text Mode";

            voiceStatus.className =
                "badge bg-secondary";

        }

    }
);


/* =========================================================
   VOICE MODE
   ========================================================= */

voiceOption.addEventListener(
    "change",
    function(){

        if(this.checked){

            answerBox.readOnly = true;

            answerBox.placeholder =
                "Speak your answer...";

            voiceButtons.style.display =
                "block";

            voiceStatus.innerHTML =
                "Waiting...";

            voiceStatus.className =
                "badge bg-secondary";

        }

    }
);


/* =========================================================
   CLEAR ANSWER
   ========================================================= */

function clearAnswer(){

    answerBox.value = "";

}


/* =========================================================
   SPEAK QUESTION
   ========================================================= */

function speakQuestion(){

    if(!("speechSynthesis" in window)){

        alert(
            "Speech Synthesis is not supported."
        );

        return;

    }


    window.speechSynthesis.cancel();


    const question =
        document
            .getElementById("questionText")
            .innerText;


    let speech =
        new SpeechSynthesisUtterance(question);


    speech.lang =
        "en-US";


    speech.rate =
        1;


    speech.pitch =
        1;


    speech.volume =
        1;


    window.speechSynthesis.speak(
        speech
    );

}


/* =========================================================
   START VOICE RECOGNITION
   ========================================================= */

function startVoice(){

    if(!voiceOption.checked){

        alert(
            "Please select Voice Answer."
        );

        return;

    }


    const SpeechRecognition =
        window.SpeechRecognition ||
        window.webkitSpeechRecognition;


    if(!SpeechRecognition){

        alert(
            "Please use Google Chrome."
        );

        return;

    }


    /* Prevent multiple sessions */

    if(recognition){

        try{

            recognition.stop();

        }catch(error){}

        recognition = null;

    }


    recognition =
        new SpeechRecognition();


    recognition.lang =
        "en-US";


    recognition.continuous =
        true;


    recognition.interimResults =
        true;


    voiceStatus.innerHTML =
        "🎤 Listening...";


    voiceStatus.className =
        "badge bg-success";


    try{

        recognition.start();

    }
    catch(error){

        console.log(
            "Voice start error:",
            error
        );

    }


    recognition.onresult =
        function(event){

            let transcript = "";


            for(
                let i = 0;
                i < event.results.length;
                i++
            ){

                transcript +=
                    event.results[i][0].transcript
                    + " ";

            }


            answerBox.value =
                transcript.trim();

        };


    recognition.onerror =
        function(event){

            console.log(
                "Voice error:",
                event.error
            );


            voiceStatus.innerHTML =
                "❌ " + event.error;


            voiceStatus.className =
                "badge bg-danger";

        };


    recognition.onend =
        function(){

            voiceStatus.innerHTML =
                "Stopped";


            voiceStatus.className =
                "badge bg-secondary";

        };

}


/* =========================================================
   STOP VOICE
   ========================================================= */

function stopVoice(){

    if(recognition){

        try{

            recognition.stop();

        }
        catch(error){

            console.log(
                "Voice stop error:",
                error
            );

        }

        recognition = null;

    }


    voiceStatus.innerHTML =
        "Stopped";


    voiceStatus.className =
        "badge bg-secondary";

}


/* =========================================================
   TIMER
   ========================================================= */

function startTimer(){

    updateTimer();


    clearInterval(
        timerInterval
    );


    timerInterval =
        setInterval(
            function(){

                totalSeconds--;


                if(totalSeconds <= 0){

                    totalSeconds =
                        0;


                    updateTimer();


                    clearInterval(
                        timerInterval
                    );


                    stopVoice();


                    if(
                        "speechSynthesis"
                        in window
                    ){

                        window
                            .speechSynthesis
                            .cancel();

                    }


                    /* Auto submit No Answer */

                    if(
                        answerBox.value.trim() === ""
                    ){

                        answerBox.value =
                            "No Answer";

                    }


                    vivaForm.requestSubmit();


                    return;

                }


                updateTimer();

            },
            1000
        );

}


/* =========================================================
   UPDATE TIMER
   ========================================================= */

function updateTimer(){

    let minutes =
        Math.floor(
            totalSeconds / 60
        );


    let seconds =
        totalSeconds % 60;


    timer.innerHTML =
        String(minutes).padStart(2,"0")
        + ":"
        + String(seconds).padStart(2,"0");


    timerBox.className =
        "badge fs-5 px-4 py-3 rounded-pill";


    if(totalSeconds > 60){

        timerBox.classList.add(
            "bg-success",
            "text-white"
        );

    }

    else if(totalSeconds > 30){

        timerBox.classList.add(
            "bg-warning",
            "text-dark"
        );

    }

    else{

        timerBox.classList.add(
            "bg-danger",
            "text-white"
        );

    }

}


/* =========================================================
   SUBMIT FORM
   GROQ + CLOUDFLARE + OPENROUTER
   ========================================================= */

vivaForm.addEventListener(
    "submit",
    async function(e){

        e.preventDefault();


        /* Stop Voice */

        stopVoice();


        /* Stop Question Speech */

        if(
            "speechSynthesis"
            in window
        ){

            window
                .speechSynthesis
                .cancel();

        }


        /* Stop Timer */

        clearInterval(
            timerInterval
        );


        /* Disable Submit */

        submitButton.disabled =
            true;


        submitButton.innerHTML =
            "⏳ Evaluating with AI...";


        /* Form Data */

        const formData =
            new FormData(vivaForm);


        try{

            /* Send Answer */

            const response =
                await fetch(
                    vivaForm.action,
                    {
                        method: "POST",

                        body: formData,

                        headers: {

                            "X-CSRF-TOKEN":
                                document.querySelector(
                                    'input[name="_token"]'
                                ).value,

                            "Accept":
                                "application/json"

                        }

                    }
                );


            /* Response */

            const data =
                await response.json();


            console.log(
                "AI Viva Response:",
                data
            );


            /* Check */

            if(
                !response.ok ||
                !data.success
            ){

                throw new Error(
                    data.message ||
                    "Answer evaluation failed."
                );

            }


            /* Current Question */

            const currentQuestion =
                Number(
                    "{{ $questionNo }}"
                );


            /* Total Questions */

            const totalQuestions =
                Number(
                    "{{ $totalQuestions }}"
                );


            /* Final Question */

            if(
                currentQuestion >=
                totalQuestions
            ){

                submitButton.innerHTML =
                    "✅ Viva Completed!";


                if(data.result_id){

                    window.location.href =
                        "{{ url('/student/results/view') }}/" +
                        data.result_id;

                    return;

                }


                alert(
                    "❌ Viva completed, but result ID was not received."
                );


                submitButton.disabled =
                    false;


                submitButton.innerHTML =
                    "✅ Submit Answer";


                return;

            }


            /* Next Question */

            submitButton.innerHTML =
                "➡️ Loading Next Question...";


            window.location.href =
                "{{ route('student.viva.start', $subject->id) }}";


        }
        catch(error){

            console.error(
                "Viva submission error:",
                error
            );


            alert(
                "❌ " +
                (
                    error.message ||
                    "Something went wrong while evaluating your answer."
                )
            );


            submitButton.disabled =
                false;


            submitButton.innerHTML =
                "✅ Submit Answer";


            /* Restart timer */

            if(totalSeconds > 0){

                startTimer();

            }

        }

    }
);


/* =========================================================
   PAGE LOAD
   ========================================================= */

window.addEventListener(
    "load",
    function(){

        /*
        |--------------------------------------------------------------------------
        | ALWAYS SELECT VOICE
        |--------------------------------------------------------------------------
        */

        voiceOption.checked =
            true;

        textOption.checked =
            false;


        /*
        |--------------------------------------------------------------------------
        | VOICE MODE
        |--------------------------------------------------------------------------
        */

        answerBox.readOnly =
            true;


        answerBox.placeholder =
            "Speak your answer...";


        /*
        |--------------------------------------------------------------------------
        | SHOW VOICE RECORDING
        |--------------------------------------------------------------------------
        */

        voiceButtons.style.display =
            "block";


        voiceStatus.innerHTML =
            "Waiting...";


        voiceStatus.className =
            "badge bg-secondary";


        /*
        |--------------------------------------------------------------------------
        | SPEAK QUESTION
        |--------------------------------------------------------------------------
        */

        setTimeout(
            function(){

                speakQuestion();

            },
            1000
        );


        /*
        |-------------c-------------------------------------------------------------
        | START TIMER
        |--------------------------------------------------------------------------
        */

        startTimer();

    }
);

</script>

@endsection
