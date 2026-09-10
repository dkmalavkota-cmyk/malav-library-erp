<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Exam Instructions — {{ $exam->title }}
    </title>

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
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                radial-gradient(
                    circle at 8% 0%,
                    rgba(99, 102, 241, .14),
                    transparent 30rem
                ),
                radial-gradient(
                    circle at 95% 20%,
                    rgba(16, 185, 129, .08),
                    transparent 28rem
                ),
                #09090b;

            color: #f4f4f5;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .page {
            min-height: 100vh;
        }

        /* =====================================================
           HEADER
        ====================================================== */

        .header {
            height: 72px;

            display: flex;
            align-items: center;

            border-bottom: 1px solid rgba(255,255,255,.07);

            background: rgba(9,9,11,.84);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .header-inner {
            width: min(1120px, calc(100% - 36px));
            margin: auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #fff;
            color: #09090b;

            font-size: 16px;
            font-weight: 900;
        }

        .brand-name {
            font-size: 14px;
            font-weight: 750;
        }

        .brand-subtitle {
            margin-top: 2px;

            color: #52525b;

            font-size: 9px;
        }

        .student-name {
            color: #a1a1aa;
            font-size: 11px;
            font-weight: 600;
        }

        /* =====================================================
           MAIN
        ====================================================== */

        .main {
            width: min(1000px, calc(100% - 36px));
            margin: 0 auto;

            padding: 48px 0 65px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: #71717a;

            font-size: 11px;
            font-weight: 600;

            transition: .2s ease;
        }

        .back-link:hover {
            color: #e4e4e7;
        }

        .back-link svg {
            width: 14px;
            height: 14px;
        }

        /* =====================================================
           HERO
        ====================================================== */

        .hero {
            margin-top: 28px;

            padding: 32px;

            border: 1px solid rgba(255,255,255,.075);
            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.012)
                );

            box-shadow:
                0 25px 80px rgba(0,0,0,.22);
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 750;

            text-transform: uppercase;
            letter-spacing: .14em;
        }

        .hero-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #818cf8;
            box-shadow: 0 0 12px rgba(129,140,248,.75);
        }

        .hero h1 {
            margin: 12px 0 0;

            color: #fff;

            font-size: clamp(28px, 5vw, 42px);
            line-height: 1.08;

            letter-spacing: -.045em;
            font-weight: 790;
        }

        .hero-description {
            max-width: 700px;

            margin: 12px 0 0;

            color: #71717a;

            font-size: 12px;
            line-height: 1.7;
        }

        .category {
            display: inline-flex;

            margin-top: 18px;
            padding: 7px 10px;

            border: 1px solid rgba(129,140,248,.16);
            border-radius: 8px;

            background: rgba(99,102,241,.07);

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 700;
        }

        /* =====================================================
           STATS
        ====================================================== */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);

            gap: 10px;

            margin-top: 18px;
        }

        .stat {
            padding: 17px;

            border: 1px solid rgba(255,255,255,.065);
            border-radius: 13px;

            background: rgba(255,255,255,.02);
        }

        .stat-label {
            color: #52525b;

            font-size: 8px;
            font-weight: 750;

            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .stat-value {
            margin-top: 7px;

            color: #e4e4e7;

            font-size: 16px;
            font-weight: 750;
        }

        /* =====================================================
           CONTENT GRID
        ====================================================== */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.4fr) minmax(270px, .8fr);

            gap: 17px;

            margin-top: 17px;
        }

        .card {
            padding: 23px;

            border: 1px solid rgba(255,255,255,.07);
            border-radius: 18px;

            background: rgba(255,255,255,.018);
        }

        .card-title {
            color: #e4e4e7;

            font-size: 13px;
            font-weight: 730;
        }

        .card-subtitle {
            margin-top: 5px;

            color: #52525b;

            font-size: 9px;
        }

        /* =====================================================
           INSTRUCTIONS
        ====================================================== */

        .instructions {
            margin-top: 20px;

            display: flex;
            flex-direction: column;
            gap: 13px;
        }

        .instruction {
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .instruction-number {
            width: 23px;
            height: 23px;
            flex: 0 0 23px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 7px;

            background: rgba(99,102,241,.09);
            border: 1px solid rgba(129,140,248,.13);

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 750;
        }

        .instruction-text {
            padding-top: 3px;

            color: #a1a1aa;

            font-size: 10px;
            line-height: 1.6;
        }

        /* =====================================================
           DETAILS
        ====================================================== */

        .detail-list {
            margin-top: 20px;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 12px 0;

            border-bottom: 1px solid rgba(255,255,255,.055);
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-key {
            color: #52525b;

            font-size: 9px;
            font-weight: 650;
        }

        .detail-value {
            color: #d4d4d8;

            font-size: 10px;
            font-weight: 650;

            text-align: right;
        }

        .negative {
            color: #fca5a5;
        }

        .positive {
            color: #6ee7b7;
        }

        /* =====================================================
           WARNING
        ====================================================== */

        .warning {
            margin-top: 17px;

            padding: 15px;

            border: 1px solid rgba(245,158,11,.14);
            border-radius: 13px;

            background: rgba(245,158,11,.045);
        }

        .warning-title {
            color: #fbbf24;

            font-size: 10px;
            font-weight: 750;
        }

        .warning-text {
            margin-top: 5px;

            color: #a1a1aa;

            font-size: 9px;
            line-height: 1.6;
        }

        /* =====================================================
           ACTION
        ====================================================== */

        .action-card {
            margin-top: 17px;

            padding: 21px 23px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;

            border: 1px solid rgba(255,255,255,.075);
            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.015)
                );
        }

        .ready-title {
            color: #e4e4e7;

            font-size: 12px;
            font-weight: 700;
        }

        .ready-text {
            margin-top: 4px;

            color: #52525b;

            font-size: 9px;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .btn {
            height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 15px;

            border-radius: 10px;

            font-family: inherit;
            font-size: 10px;
            font-weight: 700;

            cursor: pointer;

            transition: .2s ease;
        }

        .btn-secondary {
            border: 1px solid rgba(255,255,255,.08);
            background: rgba(255,255,255,.025);
            color: #a1a1aa;
        }

        .btn-secondary:hover {
            color: #fff;
            background: rgba(255,255,255,.06);
        }

        .btn-primary {
            border: 1px solid #fff;
            background: #fff;
            color: #09090b;
        }

        .btn-primary:hover {
            background: #e4e4e7;
        }

        .btn svg {
            width: 13px;
            height: 13px;
        }

        /* =====================================================
           FOOTER
        ====================================================== */

        .footer {
            width: min(1000px, calc(100% - 36px));

            margin: 0 auto;

            padding: 22px 0 30px;

            border-top: 1px solid rgba(255,255,255,.055);

            color: #3f3f46;

            text-align: center;

            font-size: 9px;
        }

        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 800px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .action-card {
                align-items: stretch;
                flex-direction: column;
            }

            .actions {
                width: 100%;
            }

            .btn {
                flex: 1;
            }
        }

        @media (max-width: 560px) {

            .header {
                height: 65px;
            }

            .header-inner,
            .main,
            .footer {
                width: calc(100% - 24px);
            }

            .student-name {
                display: none;
            }

            .main {
                padding-top: 30px;
            }

            .hero {
                padding: 22px;
                border-radius: 17px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .stats {
                gap: 8px;
            }

            .stat {
                padding: 14px;
            }

            .stat-value {
                font-size: 14px;
            }

            .card {
                padding: 18px;
            }

            .action-card {
                padding: 18px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <header class="header">

        <div class="header-inner">

            <a
                href="{{ route('student-exam.dashboard') }}"
                class="brand"
            >

                <div class="brand-logo">
                    M
                </div>

                <div>

                    <div class="brand-name">
                        Malav Exam Portal
                    </div>

                    <div class="brand-subtitle">
                        Student Examination System
                    </div>

                </div>

            </a>


            <div class="student-name">
                {{ $account->student->full_name }}
            </div>

        </div>

    </header>


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="main">

        <a
            href="{{ route('student-exam.dashboard') }}"
            class="back-link"
        >

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
            >
                <path d="m15 18-6-6 6-6"/>
            </svg>

            Back to Dashboard

        </a>


        {{-- =================================================
             HERO
        ================================================== --}}

        <section class="hero">

            <div class="hero-label">

                <span class="hero-dot"></span>

                Exam Instructions

            </div>


            <h1>
                {{ $exam->title }}
            </h1>


            @if($exam->description)

                <p class="hero-description">
                    {{ $exam->description }}
                </p>

            @else

                <p class="hero-description">
                    Please read the following instructions carefully
                    before starting your examination.
                </p>

            @endif


            @if($exam->category)

                <div class="category">
                    {{ $exam->category->name }}
                </div>

            @endif

        </section>


        {{-- =================================================
             STATS
        ================================================== --}}

        <section class="stats">

            <div class="stat">

                <div class="stat-label">
                    Questions
                </div>

                <div class="stat-value">
                    {{ $questionCount }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    Duration
                </div>

                <div class="stat-value">
                    {{ $exam->duration_minutes }} min
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

        </section>


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="content-grid">


            {{-- =================================================
                 INSTRUCTIONS
            ================================================== --}}

            <section class="card">

                <div class="card-title">
                    Important Instructions
                </div>

                <div class="card-subtitle">
                    Please read these points before beginning.
                </div>


                <div class="instructions">

                    <div class="instruction">

                        <div class="instruction-number">
                            01
                        </div>

                        <div class="instruction-text">
                            Make sure you have a stable internet connection
                            before starting the examination.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            02
                        </div>

                        <div class="instruction-text">
                            The examination will run for the allotted
                            {{ $exam->duration_minutes }} minutes.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            03
                        </div>

                        <div class="instruction-text">
                            Once the examination starts, the timer will
                            continue running until the exam is submitted
                            or the allotted time expires.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            04
                        </div>

                        <div class="instruction-text">
                            Do not refresh, close or navigate away from
                            the examination page while attempting the test.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            05
                        </div>

                        <div class="instruction-text">
                            Review your answers carefully before submitting
                            the examination.
                        </div>

                    </div>


                    <div class="instruction">

                        <div class="instruction-number">
                            06
                        </div>

                        <div class="instruction-text">
                            Your attempt must be completed within the
                            allowed attempt limit.
                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 EXAM DETAILS
            ================================================== --}}

            <section class="card">

                <div class="card-title">
                    Exam Details
                </div>

                <div class="card-subtitle">
                    Your examination configuration
                </div>


                <div class="detail-list">

                    <div class="detail-row">

                        <div class="detail-key">
                            Questions
                        </div>

                        <div class="detail-value">
                            {{ $questionCount }}
                        </div>

                    </div>


                    <div class="detail-row">

                        <div class="detail-key">
                            Duration
                        </div>

                        <div class="detail-value">
                            {{ $exam->duration_minutes }} minutes
                        </div>

                    </div>


                    <div class="detail-row">

                        <div class="detail-key">
                            Total Marks
                        </div>

                        <div class="detail-value">
                            {{ $exam->total_marks }}
                        </div>

                    </div>


                    <div class="detail-row">

                        <div class="detail-key">
                            Passing Marks
                        </div>

                        <div class="detail-value">
                            {{ $exam->passing_marks }}
                        </div>

                    </div>


                    <div class="detail-row">

                        <div class="detail-key">
                            Attempt Limit
                        </div>

                        <div class="detail-value">
                            {{ $exam->attempt_limit }}
                        </div>

                    </div>


                    <div class="detail-row">

                        <div class="detail-key">
                            Negative Marking
                        </div>

                        <div class="detail-value">

                            @if($exam->negative_marking)

                                <span class="negative">
                                    Yes
                                    @if($exam->negative_marks > 0)
                                        (−{{ $exam->negative_marks }})
                                    @endif
                                </span>

                            @else

                                <span class="positive">
                                    No
                                </span>

                            @endif

                        </div>

                    </div>


                    @if($exam->starts_at)

                        <div class="detail-row">

                            <div class="detail-key">
                                Starts
                            </div>

                            <div class="detail-value">
                                {{ $exam->starts_at->format('d M Y, h:i A') }}
                            </div>

                        </div>

                    @endif


                    @if($exam->ends_at)

                        <div class="detail-row">

                            <div class="detail-key">
                                Ends
                            </div>

                            <div class="detail-value">
                                {{ $exam->ends_at->format('d M Y, h:i A') }}
                            </div>

                        </div>

                    @endif

                </div>

            </section>

        </div>


        {{-- =================================================
             WARNING
        ================================================== --}}

        <section class="warning">

            <div class="warning-title">
                Important
            </div>

            <div class="warning-text">
                By clicking “Start Exam”, you confirm that you are ready
                to begin this examination. The timer will start immediately
                once your attempt begins.
            </div>

        </section>


        {{-- =================================================
             ACTION
        ================================================== --}}

        <section class="action-card">

            <div>

                <div class="ready-title">
                    Ready to begin?
                </div>

                <div class="ready-text">
                    Make sure you have enough uninterrupted time to complete
                    this examination.
                </div>

            </div>


            <div class="actions">

                <a
                    href="{{ route('student-exam.dashboard') }}"
                    class="btn btn-secondary"
                >
                    Cancel
                </a>


                {{-- Start the real exam attempt. --}}

                <form
                    method="POST"
                    action="{{ route('student-exam.start', $exam) }}"
                    style="margin: 0;"
                >
                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Start Exam

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M5 12h14"/>
                            <path d="m13 6 6 6-6 6"/>
                        </svg>

                    </button>
                </form>

            </div>

        </section>

    </main>


    {{-- =====================================================
         FOOTER
    ====================================================== --}}

    <footer class="footer">

        © {{ date('Y') }} Malav Exam Portal
        <span style="margin: 0 7px;">•</span>
        Student Examination System

    </footer>

</div>

</body>
</html>