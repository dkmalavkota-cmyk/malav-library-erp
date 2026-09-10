<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $exam->title }} - Exam Details</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #07070a;
            color: #fff;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .page {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(99,102,241,.13),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 90%,
                    rgba(124,58,237,.10),
                    transparent 30%
                );
        }

        .topbar {
            height: 76px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            background: rgba(7,7,10,.82);
            backdrop-filter: blur(20px);
        }

        .topbar-inner {
            max-width: 1180px;
            height: 100%;
            margin: auto;
            padding: 0 24px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
        }

        .brand-icon {
            width: 41px;
            height: 41px;
            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(135deg,#6366f1,#7c3aed);

            font-size: 16px;
            font-weight: 850;

            box-shadow:
                0 10px 30px rgba(99,102,241,.22),
                inset 0 1px rgba(255,255,255,.2);
        }

        .brand-name {
            font-size: 13px;
            font-weight: 750;
        }

        .brand-subtitle {
            margin-top: 2px;
            color: #52525b;
            font-size: 9px;
        }

        .back-link {
            color: #71717a;
            text-decoration: none;
            font-size: 11px;
            font-weight: 650;

            transition: .2s ease;
        }

        .back-link:hover {
            color: #c4b5fd;
        }

        .container {
            max-width: 1050px;
            margin: auto;
            padding: 45px 24px 70px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;

            color: #52525b;
            font-size: 10px;
        }

        .breadcrumb-current {
            color: #a1a1aa;
        }

        .hero {
            position: relative;
            overflow: hidden;

            padding: 34px;

            border: 1px solid rgba(255,255,255,.075);
            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.12),
                    rgba(255,255,255,.025) 50%,
                    rgba(124,58,237,.07)
                );

            box-shadow:
                0 25px 70px rgba(0,0,0,.25);
        }

        .hero-glow {
            position: absolute;
            right: -120px;
            top: -180px;

            width: 350px;
            height: 350px;

            border-radius: 50%;

            background: rgba(99,102,241,.18);
            filter: blur(75px);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .category {
            display: inline-flex;
            align-items: center;

            padding: 6px 10px;

            border: 1px solid rgba(129,140,248,.18);
            border-radius: 999px;

            background: rgba(99,102,241,.07);

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .title {
            max-width: 760px;

            margin-top: 16px;

            color: #fafafa;

            font-size: clamp(30px,5vw,48px);
            line-height: 1.05;

            font-weight: 850;
            letter-spacing: -.05em;
        }

        .description {
            max-width: 700px;

            margin-top: 14px;

            color: #71717a;

            font-size: 13px;
            line-height: 1.75;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.35fr .65fr;
            gap: 20px;

            margin-top: 20px;
        }

        .card {
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 21px;

            background: rgba(255,255,255,.025);

            overflow: hidden;
        }

        .card-header {
            padding: 21px 22px;

            border-bottom: 1px solid rgba(255,255,255,.055);
        }

        .card-title {
            color: #e4e4e7;

            font-size: 14px;
            font-weight: 750;
        }

        .card-subtitle {
            margin-top: 4px;

            color: #52525b;

            font-size: 10px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2,1fr);
            gap: 1px;

            background: rgba(255,255,255,.045);
        }

        .stat {
            padding: 18px;

            background: #0b0b0f;
        }

        .stat-label {
            color: #52525b;

            font-size: 9px;
            font-weight: 650;

            text-transform: uppercase;
            letter-spacing: .07em;
        }

        .stat-value {
            margin-top: 7px;

            color: #e4e4e7;

            font-size: 14px;
            font-weight: 750;
        }

        .instructions {
            padding: 22px;
        }

        .instruction {
            display: flex;
            gap: 12px;

            padding: 11px 0;

            color: #a1a1aa;

            font-size: 11px;
            line-height: 1.6;
        }

        .instruction-number {
            width: 23px;
            height: 23px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: rgba(99,102,241,.10);
            color: #a5b4fc;

            font-size: 9px;
            font-weight: 750;
        }

        .start-card {
            padding: 23px;

            border: 1px solid rgba(129,140,248,.12);
            border-radius: 21px;

            background:
                linear-gradient(
                    145deg,
                    rgba(99,102,241,.10),
                    rgba(255,255,255,.025)
                );
        }

        .start-label {
            color: #71717a;

            font-size: 9px;
            font-weight: 650;

            text-transform: uppercase;
            letter-spacing: .09em;
        }

        .start-title {
            margin-top: 8px;

            color: #f4f4f5;

            font-size: 18px;
            font-weight: 800;
            letter-spacing: -.025em;
        }

        .start-text {
            margin-top: 7px;

            color: #52525b;

            font-size: 10px;
            line-height: 1.6;
        }

        .start-btn {
            width: 100%;
            height: 48px;

            margin-top: 21px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            border-radius: 13px;

            background: linear-gradient(135deg,#6366f1,#7c3aed);

            color: white;
            text-decoration: none;

            font-size: 11px;
            font-weight: 750;

            box-shadow:
                0 14px 30px rgba(99,102,241,.18);

            transition: .2s ease;
        }

        .start-btn:hover {
            transform: translateY(-2px);

            box-shadow:
                0 18px 38px rgba(99,102,241,.28);
        }

        .note {
            display: flex;
            gap: 8px;

            margin-top: 13px;

            color: #52525b;

            font-size: 9px;
            line-height: 1.5;
        }

        .negative {
            color: #f59e0b;
        }

        .footer {
            margin-top: 50px;

            padding-top: 20px;

            border-top: 1px solid rgba(255,255,255,.05);

            text-align: center;

            color: #3f3f46;

            font-size: 9px;
        }

        @media (max-width: 800px) {

            .content-grid {
                grid-template-columns: 1fr;
            }

            .hero {
                padding: 27px 22px;
            }

            .container {
                padding: 30px 17px 50px;
            }

        }

        @media (max-width: 500px) {

            .topbar-inner {
                padding: 0 17px;
            }

            .brand-subtitle {
                display: none;
            }

            .title {
                font-size: 34px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .back-link {
                display: none;
            }

        }
    </style>
</head>


<body>

<div class="page">

    {{-- TOP BAR --}}

    <header class="topbar">

        <div class="topbar-inner">

            <a
                href="{{ route('exam-user.dashboard') }}"
                class="brand"
            >

                <div class="brand-icon">
                    E
                </div>

                <div>

                    <div class="brand-name">
                        Online Exams
                    </div>

                    <div class="brand-subtitle">
                        Student Examination Portal
                    </div>

                </div>

            </a>


            <a
                href="{{ route('exam-user.dashboard') }}"
                class="back-link"
            >
                â† Back to Dashboard
            </a>

        </div>

    </header>


    <main class="container">

        {{-- Breadcrumb --}}

        <div class="breadcrumb">

            <span>Dashboard</span>

            <span>â€º</span>

            <span class="breadcrumb-current">
                Examination Details
            </span>

        </div>


        {{-- HERO --}}

        <section class="hero">

            <div class="hero-glow"></div>

            <div class="hero-content">

                @if($exam->category)

                    <div class="category">
                        {{ $exam->category->name }}
                    </div>

                @endif


                <h1 class="title">
                    {{ $exam->title }}
                </h1>


                @if($exam->description)

                    <p class="description">
                        {{ $exam->description }}
                    </p>

                @else

                    <p class="description">
                        Read the examination details and instructions
                        carefully before starting your assessment.
                    </p>

                @endif

            </div>

        </section>


        <div class="content-grid">


            {{-- LEFT --}}

            <section class="card">

                <div class="card-header">

                    <div class="card-title">
                        Examination Overview
                    </div>

                    <div class="card-subtitle">
                        Everything you need to know before starting
                    </div>

                </div>


                <div class="stats">

                    <div class="stat">

                        <div class="stat-label">
                            Duration
                        </div>

                        <div class="stat-value">
                            {{ $exam->duration_minutes }} Minutes
                        </div>

                    </div>


                    <div class="stat">

                        <div class="stat-label">
                            Total Marks
                        </div>

                        <div class="stat-value">
                            {{ $exam->total_marks }}
                        </div>

                    </div>


                    <div class="stat">

                        <div class="stat-label">
                            Passing Marks
                        </div>

                        <div class="stat-value">
                            {{ $exam->passing_marks }}
                        </div>

                    </div>


                    <div class="stat">

                        <div class="stat-label">
                            Questions
                        </div>

                        <div class="stat-value">
                            {{ $exam->questions->count() }}
                        </div>

                    </div>


                    <div class="stat">

                        <div class="stat-label">
                            Attempt Limit
                        </div>

                        <div class="stat-value">
                            {{ $exam->attempt_limit }}
                        </div>

                    </div>


                    <div class="stat">

                        <div class="stat-label">
                            Negative Marking
                        </div>

                        <div class="stat-value {{ $exam->negative_marking ? 'negative' : '' }}">

                            @if($exam->negative_marking)
                                Enabled
                            @else
                                No
                            @endif

                        </div>

                    </div>

                </div>


                {{-- Instructions --}}

                <div class="card-header">

                    <div class="card-title">
                        Before You Begin
                    </div>

                    <div class="card-subtitle">
                        Please read these instructions carefully
                    </div>

                </div>


                <div class="instructions">

                    <div class="instruction">

                        <div class="instruction-number">
                            01
                        </div>

                        <div>
                            Make sure you have a stable internet connection
                            before starting the examination.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            02
                        </div>

                        <div>
                            The examination timer will start when you begin
                            the test.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            03
                        </div>

                        <div>
                            Once the examination starts, manage your time
                            carefully.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            04
                        </div>

                        <div>
                            Submit your answers before the timer expires.
                        </div>

                    </div>


                    @if($exam->negative_marking)

                        <div class="instruction">

                            <div class="instruction-number">
                                05
                            </div>

                            <div>
                                <strong class="negative">
                                    Negative marking is enabled.
                                </strong>
                                Incorrect answers may reduce your score.
                            </div>

                        </div>

                    @endif

                </div>

            </section>


            {{-- RIGHT --}}

            <aside>

                <div class="start-card">

                    <div class="start-label">
                        Ready to begin?
                    </div>

                    <div class="start-title">
                        Start your examination
                    </div>

                    <p class="start-text">
                        Once you click start, your examination session
                        will begin and the timer will be activated.
                    </p>


                <form
    method="POST"
    action="{{ route('exam-user.exam.start', $exam) }}"
>
    @csrf

    <button
        type="submit"
        class="start-btn"
    >
        Start Examination
        <span>â†’</span>
    </button>
</form>

                    <div class="note">

                        <span>ðŸ”’</span>

                        <span>
                            Your examination attempt is securely recorded.
                        </span>

                    </div>

                </div>

            </aside>


        </div>


        <footer class="footer">

            Secure Online Examination Platform
            Â·
            {{ config('app.name', 'Malav Library') }}
            Â·
            {{ date('Y') }}

        </footer>

    </main>

</div>

</body>

</html>
