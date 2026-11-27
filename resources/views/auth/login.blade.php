<x-guest-layout>

<style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f4f7fb;
    }

    /* =====================================================
       MAIN PAGE
    ===================================================== */

    .login-page {
        min-height: 100vh;
        display: flex;
        background: #ffffff;
    }


    /* =====================================================
       LEFT PANEL
    ===================================================== */

    .left-panel {

        width: 55%;
        min-height: 100vh;

        position: relative;
        overflow: hidden;

        display: flex;
        align-items: center;

        padding: 70px;

        color: white;

        background:
            radial-gradient(
                circle at 15% 20%,
                rgba(34,211,238,.18),
                transparent 28%
            ),
            radial-gradient(
                circle at 85% 75%,
                rgba(99,102,241,.20),
                transparent 32%
            ),
            linear-gradient(
                135deg,
                #07111f 0%,
                #102344 50%,
                #102b4f 100%
            );
    }


    /* Decorative Circle */

    .left-panel::before {

        content: "";

        position: absolute;

        width: 500px;
        height: 500px;

        border-radius: 50%;

        border:
            1px solid rgba(255,255,255,.08);

        top: -180px;
        right: -180px;

        box-shadow:
            0 0 0 35px rgba(255,255,255,.025),
            0 0 0 70px rgba(255,255,255,.015);
    }


    .left-panel::after {

        content: "";

        position: absolute;

        width: 300px;
        height: 300px;

        border-radius: 50%;

        border:
            1px solid rgba(34,211,238,.12);

        bottom: -150px;
        left: -120px;
    }


    /* Grid */

    .overlay {

        position: absolute;

        inset: 0;

        background-image:
            linear-gradient(
                rgba(255,255,255,.025) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(255,255,255,.025) 1px,
                transparent 1px
            );

        background-size: 45px 45px;
    }


    .content {

        position: relative;

        z-index: 2;

        max-width: 650px;
    }


    /* =====================================================
       BADGE
    ===================================================== */

    .badge-ai {

        display: inline-flex;

        align-items: center;

        gap: 9px;

        padding: 10px 18px;

        border-radius: 50px;

        background:
            rgba(34,211,238,.08);

        border:
            1px solid rgba(34,211,238,.30);

        color: #67e8f9;

        font-size: 14px;

        font-weight: 500;

        margin-bottom: 28px;
    }


    /* =====================================================
       LEFT HEADING
    ===================================================== */

    .content h1 {

        font-size: 58px;

        line-height: 1.08;

        font-weight: 700;

        letter-spacing: -1.5px;

        margin: 0 0 25px;
    }


    .content h1 span {

        background:
            linear-gradient(
                90deg,
                #67e8f9,
                #818cf8
            );

        -webkit-background-clip: text;

        -webkit-text-fill-color: transparent;
    }


    .content p {

        color: #b8c5d9;

        font-size: 16px;

        line-height: 1.9;

        max-width: 590px;

        margin-bottom: 38px;
    }


    /* =====================================================
       FEATURES
    ===================================================== */

    .feature-list {

        display: flex;

        flex-wrap: wrap;

        gap: 12px;
    }


    .feature {

        padding: 13px 18px;

        border-radius: 12px;

        background:
            rgba(255,255,255,.055);

        border:
            1px solid rgba(255,255,255,.09);

        color: #edf5ff;

        font-size: 13px;

        backdrop-filter: blur(10px);

        transition: .25s;
    }


    .feature:hover {

        transform: translateY(-3px);

        background:
            rgba(255,255,255,.09);
    }


    /* =====================================================
       RIGHT PANEL
    ===================================================== */

    .right-panel {

        width: 45%;

        min-height: 100vh;

        display: flex;

        align-items: center;

        justify-content: center;

        padding: 45px;

        background: #f7f9fc;
    }


    /* =====================================================
       LOGIN CARD
    ===================================================== */

    .login-card {

        width: 100%;

        max-width: 470px;

        background: #ffffff;

        padding: 48px;

        border-radius: 24px;

        border:
            1px solid #e5eaf1;

        box-shadow:
            0 25px 70px rgba(15,23,42,.11);
    }


    /* =====================================================
       LOGO
    ===================================================== */

    .logo {

        width: 68px;

        height: 68px;

        display: flex;

        align-items: center;

        justify-content: center;

        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #101c35,
                #3155a4
            );

        color: #67e8f9;

        box-shadow:
            0 12px 28px rgba(20,38,70,.22);

        font-size: 31px;

        margin-bottom: 24px;
    }


    /* =====================================================
       HEADING
    ===================================================== */

    .login-card h2 {

        margin: 0;

        color: #172033;

        font-size: 32px;

        font-weight: 700;

        letter-spacing: -.5px;
    }


    .subtitle {

        color: #7b8799;

        font-size: 14px;

        line-height: 1.7;

        margin:
            8px 0 32px;
    }


    /* =====================================================
       FORM
    ===================================================== */

    .form-group {

        margin-bottom: 22px;
    }


    .form-group label {

        display: block;

        color: #273247;

        font-size: 14px;

        font-weight: 600;

        margin-bottom: 9px;
    }


    /* =====================================================
       INPUT BOX
    ===================================================== */

    .input-box {

        height: 55px;

        display: flex;

        align-items: center;

        border:
            1px solid #dce2ea;

        border-radius: 12px;

        background: #fafbfd;

        transition: .25s;
    }


    .input-box:focus-within {

        border-color: #536dfe;

        background: #ffffff;

        box-shadow:
            0 0 0 4px rgba(83,109,254,.08);
    }


    .input-box > i {

        margin-left: 17px;

        color: #8b96a8;

        font-size: 18px;
    }


    .input-box input {

        width: 100%;

        height: 100%;

        border: none;

        outline: none;

        background: transparent;

        padding:
            0 15px;

        color: #202a3b;

        font-family: 'Poppins', sans-serif;

        font-size: 14px;
    }


    .input-box input::placeholder {

        color: #a4adbb;
    }


    /* =====================================================
       PASSWORD BUTTON
    ===================================================== */

    .togglePassword {

        border: none;

        outline: none;

        background: transparent;

        color: #8994a6;

        margin-right: 14px;

        cursor: pointer;

        font-size: 17px;

        transition: .2s;
    }


    .togglePassword:hover {

        color: #536dfe;
    }


    /* =====================================================
       ERROR
    ===================================================== */

    .text-danger {

        display: block;

        margin-top: 6px;

        font-size: 12px;
    }


    /* =====================================================
       OPTIONS
    ===================================================== */

    .options {

        display: flex;

        align-items: center;

        justify-content: space-between;

        margin:
            5px 0 26px;

        font-size: 12px;
    }


    .options label {

        display: flex;

        align-items: center;

        gap: 7px;

        color: #727d8f;

        cursor: pointer;
    }


    .options input {

        width: 14px;

        height: 14px;

        accent-color: #536dfe;
    }


    .options a {

        color: #536dfe;

        font-weight: 600;

        text-decoration: none;
    }


    .options a:hover {

        text-decoration: underline;
    }


    /* =====================================================
       LOGIN BUTTON
    ===================================================== */

    .login-btn {

        width: 100%;

        height: 55px;

        border: none;

        border-radius: 12px;

        background:
            linear-gradient(
                135deg,
                #172642,
                #536dfe
            );

        color: white;

        font-family: 'Poppins', sans-serif;

        font-size: 15px;

        font-weight: 600;

        cursor: pointer;

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 10px;

        box-shadow:
            0 12px 25px rgba(61,84,180,.20);

        transition: .25s;
    }


    .login-btn:hover {

        transform: translateY(-2px);

        box-shadow:
            0 16px 32px rgba(61,84,180,.28);
    }


    .login-btn i {

        font-size: 17px;
    }


    /* =====================================================
       REGISTER
    ===================================================== */

    .register {

        text-align: center;

        margin-top: 26px;

        color: #8993a3;

        font-size: 13px;
    }


    .register a {

        color: #536dfe;

        font-weight: 600;

        text-decoration: none;

        margin-left: 4px;
    }


    .register a:hover {

        text-decoration: underline;
    }


    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 1100px) {

        .left-panel {

            width: 52%;

            padding: 50px;
        }

        .right-panel {

            width: 48%;

            padding: 30px;
        }

        .content h1 {

            font-size: 46px;
        }

    }


    @media (max-width: 800px) {

        .login-page {

            display: block;
        }


        .left-panel {

            width: 100%;

            min-height: auto;

            padding: 50px 30px;
        }


        .right-panel {

            width: 100%;

            min-height: auto;

            padding: 40px 20px;
        }


        .content h1 {

            font-size: 42px;
        }

    }


    @media (max-width: 500px) {

        .left-panel {

            padding: 40px 22px;
        }


        .right-panel {

            padding: 25px 15px;
        }


        .login-card {

            padding: 32px 24px;

            border-radius: 20px;
        }


        .content h1 {

            font-size: 35px;
        }


        .content p {

            font-size: 14px;
        }


        .login-card h2 {

            font-size: 28px;
        }

    }

</style>


<div class="login-page">


    <!-- =====================================================
         LEFT SIDE
    ===================================================== -->

    <div class="left-panel">

        <div class="overlay"></div>


        <div class="content">


            <span class="badge-ai">

                🤖 AI Powered Learning

            </span>


            <h1>

                AI Based<br>

                <span>Viva Teacher</span>

            </h1>


            <p>

                Practice viva examinations using Artificial Intelligence.
                Improve your technical knowledge, communication skills and
                confidence through intelligent voice and text-based interviews.

            </p>


            <div class="feature-list">


                <div class="feature">

                    🎤 &nbsp; Voice Viva

                </div>


                <div class="feature">

                    🤖 &nbsp; AI Evaluation

                </div>


                <div class="feature">

                    📊 &nbsp; Performance Analytics

                </div>


            </div>


        </div>

    </div>



    <!-- =====================================================
         RIGHT SIDE
    ===================================================== -->

    <div class="right-panel">


        <div class="login-card">


            <!-- LOGO -->

            <div class="logo">

                <i class="bi bi-robot"></i>

            </div>


            <!-- HEADING -->

            <h2>

                Welcome Back

            </h2>


            <p class="subtitle">

                Sign in to continue your AI-powered viva journey.

            </p>


            <x-auth-session-status
                class="mb-3"
                :status="session('status')" />



            <!-- FORM -->

            <form
                method="POST"
                action="{{ route('login') }}">

                @csrf


                <!-- EMAIL -->

                <div class="form-group">

                    <label>

                        Email Address

                    </label>


                    <div class="input-box">

                        <i class="bi bi-envelope"></i>


                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email address"
                            required
                            autofocus
                            autocomplete="username">

                    </div>


                    @error('email')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                    @enderror

                </div>



                <!-- PASSWORD -->

                <div class="form-group">

                    <label>

                        Password

                    </label>


                    <div class="input-box">

                        <i class="bi bi-lock"></i>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password">


                        <button
                            type="button"
                            class="togglePassword"
                            onclick="togglePassword()">

                            <i
                                class="bi bi-eye"
                                id="eyeIcon">
                            </i>

                        </button>

                    </div>


                    @error('password')

                        <small class="text-danger">

                            {{ $message }}

                        </small>

                    @enderror

                </div>



                <!-- OPTIONS -->

                <div class="options">


                    <label>

                        <input
                            type="checkbox"
                            name="remember">

                        Remember Me

                    </label>


                    @if(Route::has('password.request'))

                        <a href="{{ route('password.request') }}">

                            Forgot Password?

                        </a>

                    @endif


                </div>



                <!-- LOGIN -->

                <button
                    type="submit"
                    class="login-btn">

                    Login

                    <i class="bi bi-arrow-right"></i>

                </button>


            </form>



            <!-- REGISTER -->

            <div class="register">

                Don't have an account?

                <a href="{{ route('register') }}">

                    Create Account

                </a>

            </div>


        </div>

    </div>


</div>



<script>

function togglePassword() {

    const password =
        document.getElementById("password");

    const eyeIcon =
        document.getElementById("eyeIcon");


    if (password.type === "password") {

        password.type = "text";

        eyeIcon.classList.remove("bi-eye");

        eyeIcon.classList.add("bi-eye-slash");

    }

    else {

        password.type = "password";

        eyeIcon.classList.remove("bi-eye-slash");

        eyeIcon.classList.add("bi-eye");

    }

}

</script>


</x-guest-layout>