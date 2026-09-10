<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Login — Malav Exam Portal</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at 15% 20%, rgba(99, 78, 255, 0.18), transparent 32%),
                radial-gradient(circle at 85% 80%, rgba(124, 58, 237, 0.14), transparent 30%),
                #09090b;
            color: #ffffff;
            overflow-x: hidden;
        }

        .exam-page {
            min-height: 100vh;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            isolation: isolate;
        }

        /* Background glow */
        .glow {
            position: fixed;
            border-radius: 999px;
            filter: blur(80px);
            pointer-events: none;
            z-index: -1;
        }

        .glow-one {
            width: 280px;
            height: 280px;
            top: -100px;
            left: -80px;
            background: rgba(99, 102, 241, 0.18);
        }

        .glow-two {
            width: 320px;
            height: 320px;
            right: -120px;
            bottom: -120px;
            background: rgba(139, 92, 246, 0.15);
        }

        .login-wrapper {
            width: 100%;
            max-width: 470px;
        }

        /* Brand */
        .brand {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo {
            width: 68px;
            height: 68px;
            margin: 0 auto 18px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            font-weight: 800;
            color: #ffffff;
            background: linear-gradient(145deg, #17171c, #0f0f13);
            border: 1px solid rgba(139, 92, 246, 0.55);
            box-shadow:
                0 0 0 7px rgba(124, 58, 237, 0.06),
                0 15px 45px rgba(0, 0, 0, 0.45),
                0 0 35px rgba(99, 102, 241, 0.15);
        }

        .brand-name {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.7px;
            color: #ffffff;
        }

        .brand-subtitle {
            margin: 8px 0 0;
            font-size: 14px;
            color: #8f8f9d;
        }

        .brand-line {
            width: 42px;
            height: 3px;
            margin: 15px auto 0;
            border-radius: 99px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6);
        }

        /* Card */
        .login-card {
            position: relative;
            overflow: hidden;
            border-radius: 26px;
            padding: 34px;
            background:
                linear-gradient(145deg, rgba(27, 27, 34, 0.97), rgba(15, 15, 19, 0.98));
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.50),
                inset 0 1px 0 rgba(255, 255, 255, 0.035);
        }

        .login-card::before {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            top: -150px;
            right: -90px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.12);
            filter: blur(5px);
            pointer-events: none;
        }

        .card-header {
            position: relative;
            z-index: 1;
            margin-bottom: 28px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 13px;
            color: #9b8cff;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #8b5cf6;
            box-shadow: 0 0 12px rgba(139, 92, 246, 0.8);
        }

        .card-title {
            margin: 0;
            color: #ffffff;
            font-size: 24px;
            line-height: 1.25;
            font-weight: 750;
            letter-spacing: -0.4px;
        }

        .card-description {
            margin: 8px 0 0;
            color: #858591;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Error */
        .error-box {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 22px;
            padding: 13px 15px;
            border-radius: 14px;
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.22);
            color: #fca5a5;
            font-size: 13px;
            line-height: 1.5;
        }

        .error-icon {
            flex: 0 0 auto;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(239, 68, 68, 0.16);
            font-weight: 800;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 9px;
            color: #d8d8df;
            font-size: 13px;
            font-weight: 650;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 19px;
            height: 19px;
            color: #686875;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            height: 52px;
            padding: 0 15px 0 45px;
            border: 1px solid #303038;
            border-radius: 14px;
            outline: none;
            background: #111116;
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .form-input::placeholder {
            color: #5f5f6b;
        }

        .form-input:hover {
            border-color: #3d3d48;
        }

        .form-input:focus {
            border-color: #7167ff;
            background: #13131a;
            box-shadow:
                0 0 0 4px rgba(99, 102, 241, 0.10),
                0 0 25px rgba(99, 102, 241, 0.06);
        }

        /* Remember */
        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px 0 24px;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #858591;
            font-size: 13px;
            cursor: pointer;
            user-select: none;
        }

        .remember-checkbox {
            width: 17px;
            height: 17px;
            margin: 0;
            accent-color: #6d5dfc;
            cursor: pointer;
        }

        /* Button */
        .login-button {
            width: 100%;
            height: 54px;
            border: 0;
            border-radius: 15px;
            cursor: pointer;
            color: #ffffff;
            background: linear-gradient(135deg, #6257f5, #7c4dff);
            font-family: inherit;
            font-size: 14px;
            font-weight: 750;
            letter-spacing: 0.1px;
            box-shadow:
                0 12px 28px rgba(99, 75, 240, 0.22),
                inset 0 1px 0 rgba(255, 255, 255, 0.16);
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }

        .login-button:hover {
            transform: translateY(-2px);
            filter: brightness(1.06);
            box-shadow:
                0 17px 35px rgba(99, 75, 240, 0.30),
                inset 0 1px 0 rgba(255, 255, 255, 0.18);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .button-content {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
        }

        .button-arrow {
            font-size: 17px;
            line-height: 1;
        }

        /* Footer */
        .portal-footer {
            margin-top: 22px;
            text-align: center;
            color: #555560;
            font-size: 12px;
        }

        .portal-footer strong {
            color: #777783;
            font-weight: 600;
        }

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 9px;
            color: #4f4f5a;
            font-size: 11px;
        }

        .lock-icon {
            width: 13px;
            height: 13px;
        }

        /* Mobile */
        @media (max-width: 560px) {
            .exam-page {
                padding: 28px 16px;
            }

            .brand {
                margin-bottom: 22px;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
                border-radius: 18px;
                margin-bottom: 14px;
            }

            .brand-name {
                font-size: 24px;
            }

            .login-card {
                padding: 26px 20px;
                border-radius: 22px;
            }

            .card-title {
                font-size: 22px;
            }

            .form-input,
            .login-button {
                height: 52px;
            }
        }
    </style>
</head>

<body>

<div class="exam-page">

    <div class="glow glow-one"></div>
    <div class="glow glow-two"></div>

    <main class="login-wrapper">

        {{-- Brand --}}
        <div class="brand">

            <div class="brand-logo">
                M
            </div>

            <h1 class="brand-name">
                Malav Exam Portal
            </h1>

            <p class="brand-subtitle">
                Secure online examination platform
            </p>

            <div class="brand-line"></div>

        </div>

        {{-- Login Card --}}
        <section class="login-card">

            <div class="card-header">

                <div class="eyebrow">
                    <span class="eyebrow-dot"></span>
                    Student Access
                </div>

                <h2 class="card-title">
                    Welcome back
                </h2>

                <p class="card-description">
                    Sign in to view your available exams and continue your assessment.
                </p>

            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="error-box">
                    <div class="error-icon">!</div>

                    <div>
                        {{ $errors->first() }}
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('student-exam.login.store') }}">
                @csrf

                {{-- Email --}}
                <div class="form-group">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Email Address
                    </label>

                    <div class="input-wrap">

                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <path d="M4 6.5h16v11H4z" />
                            <path d="m4 7 8 6 8-6" />
                        </svg>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="Enter your email address"
                            class="form-input"
                        >

                    </div>

                </div>

                {{-- Password --}}
                <div class="form-group">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Password
                    </label>

                    <div class="input-wrap">

                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                            <rect x="5" y="10" width="14" height="10" rx="2" />
                            <path d="M8 10V7a4 4 0 0 1 8 0v3" />
                        </svg>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="form-input"
                        >

                    </div>

                </div>

                {{-- Remember --}}
                <div class="remember-row">

                    <label
                        for="remember"
                        class="remember-label"
                    >
                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="remember-checkbox"
                        >

                        Remember me
                    </label>

                </div>

                {{-- Login --}}
                <button
                    type="submit"
                    class="login-button"
                >
                    <span class="button-content">
                        Login to Exam Portal
                        <span class="button-arrow">→</span>
                    </span>
                </button>

            </form>

        </section>

        {{-- Footer --}}
        <div class="portal-footer">
            <strong>Malav Exam Portal</strong> · Student Access
        </div>

        <div class="security-note">

            <svg class="lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                <rect x="5" y="10" width="14" height="10" rx="2"/>
                <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
            </svg>

            Secure examination environment

        </div>

    </main>

</div>

</body>
</html>