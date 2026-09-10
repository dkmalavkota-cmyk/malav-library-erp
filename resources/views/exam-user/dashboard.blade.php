<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exam Dashboard - {{ config('app.name', 'Malav Library') }}</title>

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

        .dashboard-page {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(99, 102, 241, .12),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 100%,
                    rgba(124, 58, 237, .10),
                    transparent 28%
                ),
                #07070a;
        }

        /* HEADER */

        .topbar {
            height: 76px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            background: rgba(7,7,10,.82);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-inner {
            max-width: 1380px;
            height: 100%;
            margin: auto;
            padding: 0 28px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #6366f1,
                #7c3aed
            );

            font-size: 17px;
            font-weight: 850;

            box-shadow:
                0 10px 30px rgba(99,102,241,.24),
                inset 0 1px rgba(255,255,255,.2);
        }

        .brand-name {
            color: #fafafa;
            font-size: 14px;
            font-weight: 750;
            letter-spacing: -.02em;
        }

        .brand-subtitle {
            margin-top: 2px;
            color: #52525b;
            font-size: 10px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            color: #e4e4e7;
            font-size: 12px;
            font-weight: 700;
        }

        .user-email {
            margin-top: 2px;
            color: #52525b;
            font-size: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.25),
                    rgba(124,58,237,.2)
                );

            border: 1px solid rgba(129,140,248,.22);

            color: #a5b4fc;
            font-size: 12px;
            font-weight: 800;
        }

        .logout-btn {
            height: 38px;
            padding: 0 14px;

            border: 1px solid #27272a;
            border-radius: 11px;

            background: rgba(255,255,255,.025);
            color: #a1a1aa;

            font-size: 11px;
            font-weight: 650;

            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            border-color: rgba(248,113,113,.25);
            background: rgba(239,68,68,.07);
            color: #fca5a5;
        }

        /* MAIN */

        .container {
            max-width: 1380px;
            margin: auto;
            padding: 42px 28px 70px;
        }

        /* WELCOME */

        .welcome-card {
            position: relative;
            overflow: hidden;

            padding: 34px;

            border: 1px solid rgba(255,255,255,.075);
            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.11),
                    rgba(255,255,255,.025) 45%,
                    rgba(124,58,237,.06)
                );

            box-shadow:
                0 25px 70px rgba(0,0,0,.25),
                inset 0 1px rgba(255,255,255,.045);
        }

        .welcome-glow {
            position: absolute;
            width: 300px;
            height: 300px;

            right: -100px;
            top: -160px;

            border-radius: 50%;
            background: rgba(99,102,241,.18);
            filter: blur(65px);
            pointer-events: none;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .welcome-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            color: #a5b4fc;

            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 12px rgba(52,211,153,.7);
        }

        .welcome-title {
            margin-top: 13px;

            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.05;

            font-weight: 850;
            letter-spacing: -.05em;
        }

        .welcome-title span {
            color: #a5b4fc;
        }

        .welcome-text {
            max-width: 650px;

            margin-top: 13px;

            color: #71717a;
            font-size: 13px;
            line-height: 1.7;
        }

        /* STATS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;

            margin-top: 18px;
        }

        .stat-card {
            padding: 20px;

            border: 1px solid rgba(255,255,255,.065);
            border-radius: 18px;

            background: rgba(255,255,255,.025);

            transition: .2s ease;
        }

        .stat-card:hover {
            border-color: rgba(129,140,248,.18);
            transform: translateY(-2px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            color: #71717a;
            font-size: 10px;
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .stat-icon {
            width: 32px;
            height: 32px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: rgba(99,102,241,.09);
            color: #818cf8;

            font-size: 13px;
        }

        .stat-value {
            margin-top: 12px;

            color: #fafafa;
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.04em;
        }

        .stat-description {
            margin-top: 3px;
            color: #52525b;
            font-size: 10px;
        }

        /* SECTION */

        .section-header {
            margin-top: 42px;
            margin-bottom: 19px;

            display: flex;
            align-items: end;
            justify-content: space-between;
        }

        .section-title {
            color: #fafafa;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.025em;
        }

        .section-description {
            margin-top: 5px;
            color: #52525b;
            font-size: 11px;
        }

        .exam-count {
            padding: 6px 10px;

            border: 1px solid #27272a;
            border-radius: 999px;

            color: #71717a;
            background: rgba(255,255,255,.02);

            font-size: 10px;
            font-weight: 650;
        }

        /* EXAMS */

        .exam-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .exam-card {
            display: flex;
            flex-direction: column;

            min-height: 390px;

            overflow: hidden;

            border: 1px solid rgba(255,255,255,.065);
            border-radius: 22px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.018)
                );

            transition:
                transform .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        .exam-card:hover {
            transform: translateY(-4px);

            border-color: rgba(129,140,248,.22);

            box-shadow:
                0 25px 60px rgba(0,0,0,.3);
        }

        .exam-card-top {
            padding: 21px 21px 0;
        }

        .exam-card-head {
            display: flex;
            align-items: start;
            justify-content: space-between;
            gap: 12px;
        }

        .exam-icon {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.15),
                    rgba(124,58,237,.08)
                );

            border: 1px solid rgba(129,140,248,.12);

            color: #a5b4fc;
            font-size: 16px;
        }

        .category {
            max-width: 130px;

            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;

            padding: 6px 9px;

            border: 1px solid #27272a;
            border-radius: 999px;

            color: #71717a;
            background: rgba(0,0,0,.18);

            font-size: 9px;
            font-weight: 650;
        }

        .exam-title {
            margin-top: 18px;

            color: #f4f4f5;
            font-size: 17px;
            line-height: 1.3;
            font-weight: 750;
            letter-spacing: -.025em;
        }

        .exam-description {
            margin-top: 8px;

            min-height: 42px;

            color: #52525b;
            font-size: 11px;
            line-height: 1.65;
        }

        .exam-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);

            gap: 8px;

            margin-top: 20px;
        }

        .meta-item {
            padding: 11px;

            border-radius: 12px;

            background: rgba(0,0,0,.20);
            border: 1px solid rgba(255,255,255,.035);
        }

        .meta-label {
            color: #52525b;

            font-size: 8px;
            font-weight: 650;

            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .meta-value {
            margin-top: 4px;

            color: #d4d4d8;

            font-size: 11px;
            font-weight: 700;
        }

        .exam-card-footer {
            margin-top: auto;

            padding: 17px 21px 21px;
        }

        .start-btn {
            width: 100%;
            height: 45px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            border-radius: 12px;

            background: linear-gradient(
                135deg,
                #6366f1,
                #7c3aed
            );

            color: white;

            font-size: 11px;
            font-weight: 750;

            text-decoration: none;

            box-shadow:
                0 12px 25px rgba(99,102,241,.16);

            transition: .2s ease;
        }

        .start-btn:hover {
            transform: translateY(-1px);

            box-shadow:
                0 15px 32px rgba(99,102,241,.25);
        }

        .start-arrow {
            transition: transform .2s ease;
        }

        .start-btn:hover .start-arrow {
            transform: translateX(3px);
        }

        /* EMPTY */

        .empty-state {
            padding: 65px 25px;

            text-align: center;

            border: 1px dashed #27272a;
            border-radius: 22px;

            background: rgba(255,255,255,.015);
        }

        .empty-icon {
            width: 55px;
            height: 55px;

            margin: auto;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background: rgba(99,102,241,.08);

            color: #818cf8;

            font-size: 20px;
        }

        .empty-title {
            margin-top: 16px;

            color: #e4e4e7;
            font-size: 15px;
            font-weight: 750;
        }

        .empty-text {
            max-width: 400px;
            margin: 7px auto 0;

            color: #52525b;
            font-size: 11px;
            line-height: 1.6;
        }

        /* FOOTER */

        .footer {
            margin-top: 60px;
            padding-top: 20px;

            border-top: 1px solid rgba(255,255,255,.05);

            text-align: center;

            color: #3f3f46;
            font-size: 9px;
        }

        /* RESPONSIVE */

        @media (max-width: 1050px) {

            .exam-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 800px) {

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .topbar-inner {
                padding: 0 18px;
            }

            .container {
                padding: 30px 18px 50px;
            }

            .user-info {
                display: none;
            }

        }

        @media (max-width: 650px) {

            .exam-grid {
                grid-template-columns: 1fr;
            }

            .welcome-card {
                padding: 26px 22px;
            }

            .welcome-title {
                font-size: 34px;
            }

            .section-header {
                align-items: center;
            }

            .brand-subtitle {
                display: none;
            }

            .logout-btn {
                padding: 0 11px;
            }

        }
    </style>
</head>


<body>

<div class="dashboard-page">

    {{-- =========================================================
         TOP BAR
    ========================================================== --}}

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


            <div class="top-actions">

                <div class="user-info">

                    <div class="user-name">
                        {{ $examUser->name }}
                    </div>

                    <div class="user-email">
                        {{ $examUser->email }}
                    </div>

                </div>


                <div class="avatar">
                    {{ $examUser->initials() }}
                </div>


                <form
                    method="POST"
                    action="{{ route('exam-user.logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </header>


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="container">


        {{-- Welcome --}}
        <section class="welcome-card">

            <div class="welcome-glow"></div>

            <div class="welcome-content">

                <div class="welcome-label">

                    <span class="status-dot"></span>

                    Student Portal

                </div>


                <h1 class="welcome-title">

                    Welcome back,
                    <span>{{ $examUser->name }}</span>

                </h1>


                <p class="welcome-text">

                    Your examinations are ready. Choose an available test
                    below and begin your assessment whenever you're ready.

                </p>

            </div>

        </section>


        {{-- =====================================================
             STATS
        ====================================================== --}}

        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Available Exams
                    </div>

                    <div class="stat-icon">
                        ◈
                    </div>

                </div>

                <div class="stat-value">
                    {{ $exams->count() }}
                </div>

                <div class="stat-description">
                    Exams currently available
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Account
                    </div>

                    <div class="stat-icon">
                        ✓
                    </div>

                </div>

                <div class="stat-value">
                    Active
                </div>

                <div class="stat-description">
                    Your account is ready
                </div>

            </div>


            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Access
                    </div>

                    <div class="stat-icon">
                        ⚡
                    </div>

                </div>

                <div class="stat-value">
                    Online
                </div>

                <div class="stat-description">
                    Examination portal access
                </div>

            </div>

        </section>


        {{-- =====================================================
             AVAILABLE EXAMS
        ====================================================== --}}

        <div class="section-header">

            <div>

                <div class="section-title">
                    Available Examinations
                </div>

                <div class="section-description">
                    Select an examination to view its details.
                </div>

            </div>


            <div class="exam-count">
                {{ $exams->count() }} {{ $exams->count() === 1 ? 'Exam' : 'Exams' }}
            </div>

        </div>


        @if($exams->isEmpty())

            <div class="empty-state">

                <div class="empty-icon">
                    ◌
                </div>

                <div class="empty-title">
                    No examinations available
                </div>

                <p class="empty-text">
                    There are no published examinations available for you
                    right now. Please check again later.
                </p>

            </div>

        @else

            <div class="exam-grid">

                @foreach($exams as $exam)

                    <article class="exam-card">


                        <div class="exam-card-top">

                            <div class="exam-card-head">

                                <div class="exam-icon">
                                    ✦
                                </div>


                                @if($exam->category)

                                    <div class="category">
                                        {{ $exam->category->name }}
                                    </div>

                                @endif

                            </div>


                            <h2 class="exam-title">
                                {{ $exam->title }}
                            </h2>


                            @if($exam->description)

                                <p class="exam-description">
                                    {{ $exam->description }}
                                </p>

                            @else

                                <p class="exam-description">
                                    Test your knowledge with this online
                                    examination.
                                </p>

                            @endif


                            <div class="exam-meta">


                                <div class="meta-item">

                                    <div class="meta-label">
                                        Duration
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->duration_minutes }} Minutes
                                    </div>

                                </div>


                                <div class="meta-item">

                                    <div class="meta-label">
                                        Total Marks
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->total_marks }}
                                    </div>

                                </div>


                                <div class="meta-item">

                                    <div class="meta-label">
                                        Passing Marks
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->passing_marks }}
                                    </div>

                                </div>


                                <div class="meta-item">

                                    <div class="meta-label">
                                        Attempts
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->attempt_limit }}
                                    </div>

                                </div>


                            </div>

                        </div>


                        <div class="exam-card-footer">

                          <a
    href="{{ route('exam-user.exam.show', $exam) }}"
    class="start-btn"
>
                                View Examination

                                <span class="start-arrow">
                                    →
                                </span>

                            </a>

                        </div>


                    </article>

                @endforeach

            </div>

        @endif


        {{-- Footer --}}

        <footer class="footer">

            Secure Online Examination Platform
            ·
            {{ config('app.name', 'Malav Library') }}
            ·
            {{ date('Y') }}

        </footer>

    </main>

</div>

</body>
</html>