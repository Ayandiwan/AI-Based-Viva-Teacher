<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AI Viva Teacher - Register</title>

    <!-- Poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {

            font-family: 'Poppins', sans-serif;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #eef4ff,
                    #f8fbff
                );

            padding: 30px;

        }


        /* =====================================================
           MAIN CONTAINER
        ===================================================== */

        .register-container {

            width: 100%;

            max-width: 1100px;

            min-height: 650px;

            display: flex;

            background: #ffffff;

            border-radius: 24px;

            overflow: hidden;

            box-shadow:
                0 20px 60px rgba(15, 23, 42, 0.12);

        }


        /* =====================================================
           LEFT SIDE
        ===================================================== */

        .left-side {

            width: 46%;

            padding: 60px 50px;

            display: flex;

            align-items: center;

            position: relative;

            overflow: hidden;

            color: white;

            background:
                linear-gradient(
                    145deg,
                    #0b1735 0%,
                    #123c78 55%,
                    #075985 100%
                );

        }


        /* Decorative circles */

        .left-side::before {

            content: "";

            position: absolute;

            width: 330px;

            height: 330px;

            border-radius: 50%;

            right: -170px;

            top: -150px;

            border: 1px solid rgba(255,255,255,.10);

            box-shadow:
                0 0 0 35px rgba(255,255,255,.025),
                0 0 0 70px rgba(255,255,255,.018);

        }


        .left-side::after {

            content: "";

            position: absolute;

            width: 220px;

            height: 220px;

            border-radius: 50%;

            left: -120px;

            bottom: -120px;

            background: rgba(56,189,248,.08);

        }


        .left-content {

            position: relative;

            z-index: 2;

            width: 100%;

        }


        /* =====================================================
           LOGO
        ===================================================== */

        .logo {

            width: 72px;

            height: 72px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 20px;

            margin-bottom: 28px;

            color: #67e8f9;

            background:
                rgba(255,255,255,.10);

            border:
                1px solid rgba(255,255,255,.15);

            box-shadow:
                0 12px 30px rgba(0,0,0,.15);

            font-size: 34px;

        }


        /* =====================================================
           LEFT HEADING
        ===================================================== */

        .left-side h1 {

            font-size: 44px;

            line-height: 1.22;

            font-weight: 700;

            letter-spacing: -.8px;

            margin-bottom: 20px;

        }


        .left-side h1 span {

            display: block;

            color: #67e8f9;

        }


        /* =====================================================
           LEFT DESCRIPTION
        ===================================================== */

        .left-description {

            max-width: 500px;

            color: #dbeafe;

            font-size: 14px;

            line-height: 1.9;

            margin-bottom: 35px;

        }


        /* =====================================================
           FEATURES
        ===================================================== */

        .feature {

            display: flex;

            align-items: center;

            gap: 14px;

            margin-bottom: 18px;

        }


        .feature-icon {

            width: 42px;

            height: 42px;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 11px;

            color: #67e8f9;

            background:
                rgba(255,255,255,.09);

            border:
                1px solid rgba(255,255,255,.08);

            font-size: 17px;

        }


        .feature span {

            color: #eff6ff;

            font-size: 13px;

            font-weight: 500;

        }


        /* =====================================================
           RIGHT SIDE
        ===================================================== */

        .right-side {

            width: 54%;

            padding: 55px 70px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #ffffff;

        }


        .register-box {

            width: 100%;

            max-width: 440px;

        }


        /* =====================================================
           FORM HEADING
        ===================================================== */

        .heading {

            margin-bottom: 30px;

        }


        .heading h2 {

            color: #111827;

            font-size: 34px;

            font-weight: 700;

            letter-spacing: -.7px;

            margin-bottom: 8px;

        }


        .heading p {

            color: #6b7280;

            font-size: 13px;

            line-height: 1.7;

        }


        /* =====================================================
           FORM GROUP
        ===================================================== */

        .form-group {

            margin-bottom: 20px;

        }


        .form-group label {

            display: block;

            color: #374151;

            font-size: 13px;

            font-weight: 600;

            margin-bottom: 8px;

        }


        /* =====================================================
           INPUT
        ===================================================== */

        .input-box {

            position: relative;

        }


        .input-box i.input-icon {

            position: absolute;

            left: 16px;

            top: 50%;

            transform: translateY(-50%);

            color: #9ca3af;

            font-size: 16px;

            z-index: 2;

        }


        .form-control {

            width: 100%;

            height: 52px;

            padding:
                0 45px;

            border:
                1px solid #dce2ea;

            border-radius: 11px;

            outline: none;

            background: #f9fafb;

            color: #111827;

            font-family: 'Poppins', sans-serif;

            font-size: 13px;

            transition: .25s;

        }


        .form-control:hover {

            border-color: #c7d2e0;

        }


        .form-control:focus {

            background: #ffffff;

            border-color: #2563eb;

            box-shadow:
                0 0 0 4px rgba(37,99,235,.08);

        }


        .form-control::placeholder {

            color: #9ca3af;

        }


        /* =====================================================
           PASSWORD EYE
        ===================================================== */

        .toggle-password {

            position: absolute;

            right: 15px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            outline: none;

            background: transparent;

            color: #9ca3af;

            cursor: pointer;

            font-size: 16px;

        }


        .toggle-password:hover {

            color: #2563eb;

        }


        /* =====================================================
           ERROR
        ===================================================== */

        .error {

            display: block;

            margin-top: 6px;

            color: #dc2626;

            font-size: 11px;

        }


        /* =====================================================
           TERMS
        ===================================================== */

        .terms {

            display: flex;

            align-items: flex-start;

            gap: 9px;

            margin:
                5px 0 22px;

            color: #6b7280;

            font-size: 11px;

            line-height: 1.6;

            cursor: pointer;

        }


        .terms input {

            width: 14px;

            height: 14px;

            margin-top: 3px;

            flex-shrink: 0;

            accent-color: #2563eb;

        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .register-btn {

            width: 100%;

            height: 52px;

            border: none;

            border-radius: 11px;

            display: flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #0891b2
                );

            color: white;

            font-family: 'Poppins', sans-serif;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            box-shadow:
                0 10px 25px rgba(37,99,235,.20);

            transition: .25s;

        }


        .register-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 14px 30px rgba(37,99,235,.28);

        }


        .register-btn i {

            font-size: 16px;

        }


        /* =====================================================
           LOGIN
        ===================================================== */

        .login-text {

            text-align: center;

            margin-top: 24px;

            color: #6b7280;

            font-size: 12px;

        }


        .login-text a {

            margin-left: 4px;

            color: #2563eb;

            font-weight: 600;

            text-decoration: none;

        }


        .login-text a:hover {

            text-decoration: underline;

        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 900px) {

            body {

                padding: 20px;

            }


            .register-container {

                max-width: 650px;

                flex-direction: column;

            }


            .left-side {

                width: 100%;

                padding: 45px;

            }


            .right-side {

                width: 100%;

                padding: 50px 45px;

            }


            .left-side h1 {

                font-size: 36px;

            }

        }


        @media (max-width: 550px) {

            body {

                padding: 10px;

            }


            .register-container {

                border-radius: 18px;

            }


            .left-side {

                padding: 35px 25px;

            }


            .right-side {

                padding: 40px 25px;

            }


            .logo {

                width: 60px;

                height: 60px;

                font-size: 28px;

            }


            .left-side h1 {

                font-size: 31px;

            }


            .left-description {

                font-size: 13px;

            }


            .heading h2 {

                font-size: 28px;

            }


            .feature span {

                font-size: 12px;

            }

        }

    </style>

</head>


<body>


<div class="register-container">


    <!-- =====================================================
         LEFT SIDE
    ===================================================== -->

    <div class="left-side">

        <div class="left-content">


            <!-- LOGO -->

            <div class="logo">

                <i class="bi bi-robot"></i>

            </div>


            <!-- TITLE -->

            <h1>

                Join

                <span>AI Viva Teacher</span>

            </h1>


            <!-- DESCRIPTION -->

            <p class="left-description">

                Create your account and start preparing for viva
                examinations with Artificial Intelligence.

                Practice questions, answer using voice or text,
                and improve your performance with instant AI feedback.

            </p>


            <!-- FEATURE 1 -->

            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-mic-fill"></i>

                </div>

                <span>

                    Voice & Text Based Viva

                </span>

            </div>


            <!-- FEATURE 2 -->

            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-robot"></i>

                </div>

                <span>

                    AI Powered Answer Evaluation

                </span>

            </div>


            <!-- FEATURE 3 -->

            <div class="feature">

                <div class="feature-icon">

                    <i class="bi bi-bar-chart-fill"></i>

                </div>

                <span>

                    Performance & Result Tracking

                </span>

            </div>


        </div>

    </div>



    <!-- =====================================================
         RIGHT SIDE
    ===================================================== -->

    <div class="right-side">

        <div class="register-box">


            <!-- HEADING -->

            <div class="heading">

                <h2>
                    Create Account
                </h2>

                <p>
                    Register to start your AI-powered viva journey.
                </p>

            </div>


            <!-- FORM -->

            <form
                method="POST"
                action="{{ route('register') }}">

                @csrf


                <!-- FULL NAME -->

                <div class="form-group">

                    <label>
                        Full Name
                    </label>


                    <div class="input-box">

                        <i class="bi bi-person input-icon"></i>


                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Enter your full name"
                            value="{{ old('name') }}"
                            required
                            autofocus>

                    </div>


                    @error('name')

                        <span class="error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>



                <!-- EMAIL -->

                <div class="form-group">

                    <label>
                        Email Address
                    </label>


                    <div class="input-box">

                        <i class="bi bi-envelope input-icon"></i>


                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter your email address"
                            value="{{ old('email') }}"
                            required>

                    </div>


                    @error('email')

                        <span class="error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>



                <!-- PASSWORD -->

                <div class="form-group">

                    <label>
                        Password
                    </label>


                    <div class="input-box">

                        <i class="bi bi-lock input-icon"></i>


                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required>


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('password', this)">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>


                    @error('password')

                        <span class="error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>



                <!-- CONFIRM PASSWORD -->

                <div class="form-group">

                    <label>
                        Confirm Password
                    </label>


                    <div class="input-box">

                        <i class="bi bi-shield-lock input-icon"></i>


                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            placeholder="Confirm your password"
                            required>


                        <button
                            type="button"
                            class="toggle-password"
                            onclick="togglePassword('password_confirmation', this)">

                            <i class="bi bi-eye"></i>

                        </button>

                    </div>

                </div>



                <!-- TERMS -->

                <label class="terms">

                    <input
                        type="checkbox"
                        required>

                    <span>

                        I agree to use AI Viva Teacher for
                        educational and viva preparation purposes.

                    </span>

                </label>



                <!-- BUTTON -->

                <button
                    type="submit"
                    class="register-btn">

                    Create Account

                    <i class="bi bi-arrow-right"></i>

                </button>


            </form>



            <!-- LOGIN -->

            <div class="login-text">

                Already have an account?

                <a href="{{ route('login') }}">
                    Login
                </a>

            </div>


        </div>

    </div>


</div>



<script>

function togglePassword(id, button) {

    const input = document.getElementById(id);

    const icon = button.querySelector('i');


    if (input.type === "password") {

        input.type = "text";

        icon.classList.remove("bi-eye");

        icon.classList.add("bi-eye-slash");

    }

    else {

        input.type = "password";

        icon.classList.remove("bi-eye-slash");

        icon.classList.add("bi-eye");

    }

}

</script>


</body>

</html>