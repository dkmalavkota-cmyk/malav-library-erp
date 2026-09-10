<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard — Malav Exam Portal</title>

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
                linear-gradient(
                    180deg,
                    #f7f8fc 0%,
                    #f3f5fa 48%,
                    #eef1f7 100%
                );

            color: #171a24;
            overflow-x: hidden;
        }

        a {
            color: inherit;
        }

        button,
        input,
        select {
            font: inherit;
        }

        /* =========================================================
           HEADER
        ========================================================= */

        .student-header {
            position: sticky;
            top: 0;
            z-index: 50;

            height: 72px;

            background: rgba(255,255,255,.92);
            border-bottom: 1px solid #e6e8ef;

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .header-inner {
            width: min(1240px, calc(100% - 42px));
            height: 100%;
            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;

            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background: #111827;
            color: #fff;

            font-size: 16px;
            font-weight: 850;

            box-shadow: 0 8px 20px rgba(17,24,39,.12);
        }

        .brand-title {
            color: #171a24;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: -.01em;
        }

        .brand-subtitle {
            margin-top: 2px;

            color: #8a91a3;

            font-size: 9px;
            font-weight: 500;
        }

        .student-menu {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .student-info {
            text-align: right;
        }

        .student-name {
            color: #252936;
            font-size: 11px;
            font-weight: 750;
        }

        .student-code {
            margin-top: 3px;
            color: #9298a8;
            font-size: 9px;
        }

        .avatar-small,
        .avatar-placeholder {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;

            border-radius: 11px;
        }

        .avatar-small {
            object-fit: cover;
            border: 1px solid #e4e7ee;
        }

        .avatar-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;

            background: #eef0f6;
            border: 1px solid #e0e3eb;

            color: #687084;

            font-size: 12px;
            font-weight: 800;
        }

        .logout-btn {
            height: 36px;
            padding: 0 13px;

            border: 1px solid #e1e4eb;
            border-radius: 9px;

            background: #fff;
            color: #626a7c;

            font-size: 10px;
            font-weight: 700;

            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            border-color: #cfd4df;
            background: #f7f8fb;
            color: #202430;
        }

        /* =========================================================
           PAGE
        ========================================================= */

        .page {
            width: min(1240px, calc(100% - 42px));
            margin: 0 auto;
            padding: 34px 0 55px;
        }

        /* =========================================================
           HERO
        ========================================================= */

        .hero {
            position: relative;
            overflow: hidden;

            padding: 31px 32px;

            border: 1px solid #e1e4ed;
            border-radius: 20px;

            background:
                radial-gradient(
                    circle at 90% 0%,
                    rgba(99,102,241,.13),
                    transparent 24rem
                ),
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #fafbfe 100%
                );

            box-shadow: 0 16px 45px rgba(24,32,56,.06);
        }

        .hero::after {
            content: "";

            position: absolute;
            width: 190px;
            height: 190px;

            right: -65px;
            bottom: -100px;

            border-radius: 50%;

            background: rgba(99,102,241,.07);
        }

        .hero-content {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: #6366f1;

            font-size: 9px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .14em;
        }

        .eyebrow-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #6366f1;
            box-shadow: 0 0 0 4px rgba(99,102,241,.09);
        }

        .hero h1 {
            margin: 8px 0 0;

            color: #171a24;

            font-size: clamp(27px, 4vw, 38px);
            line-height: 1.08;

            font-weight: 850;
            letter-spacing: -.045em;
        }

        .hero h1 span {
            color: #6366f1;
        }

        .hero-text {
            max-width: 590px;
            margin: 9px 0 0;

            color: #737b8d;

            font-size: 12px;
            line-height: 1.65;
        }

        .hero-status {
            flex: 0 0 auto;

            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 13px;

            border: 1px solid #ccefe1;
            border-radius: 999px;

            background: #f1fcf7;
            color: #16845b;

            font-size: 9px;
            font-weight: 750;
        }

        .hero-status-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;
            background: #22c783;
        }

        /* =========================================================
           STATS
        ========================================================= */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;

            margin-top: 15px;
        }

        .stat-card {
            padding: 17px 18px;

            border: 1px solid #e3e6ee;
            border-radius: 15px;

            background: #fff;

            box-shadow: 0 9px 28px rgba(30,40,65,.035);
        }

        .stat-label {
            color: #9298a8;

            font-size: 8px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .stat-value {
            margin-top: 7px;

            color: #202430;

            font-size: 22px;
            line-height: 1;

            font-weight: 850;
            letter-spacing: -.04em;
        }

        .stat-note {
            margin-top: 7px;

            color: #9aa0ae;

            font-size: 9px;
        }

        /* =========================================================
           SECTION
        ========================================================= */

        .section {
            margin-top: 34px;
        }

        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;

            margin-bottom: 14px;
        }

        .section-title {
            margin: 0;

            color: #202430;

            font-size: 20px;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .section-description {
            margin: 4px 0 0;

            color: #8a91a3;

            font-size: 10px;
        }

        .section-count {
            padding: 7px 10px;

            border: 1px solid #e0e3eb;
            border-radius: 8px;

            background: #fff;
            color: #747c8e;

            font-size: 9px;
            font-weight: 750;
        }

        /* =========================================================
           CURRENT AFFAIRS
        ========================================================= */

        .current-affairs-panel {
            position: relative;
            overflow: hidden;

            padding: 21px;

            border: 1px solid #dfe2f1;
            border-radius: 18px;

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #f8f8ff 100%
                );

            box-shadow: 0 12px 35px rgba(71,75,130,.06);
        }

        .current-affairs-panel::before {
            content: "";

            position: absolute;
            width: 230px;
            height: 230px;

            top: -150px;
            right: -80px;

            border-radius: 50%;

            background: rgba(99,102,241,.075);
        }

        .ca-heading {
            position: relative;
            z-index: 2;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;

            margin-bottom: 17px;
        }

        .ca-heading-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .ca-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #eeefff;
            border: 1px solid #dcdefe;

            color: #6366f1;
        }

        .ca-icon svg {
            width: 19px;
            height: 19px;
        }

        .ca-title {
            margin: 0;

            color: #202430;

            font-size: 14px;
            font-weight: 850;
        }

        .ca-subtitle {
            margin: 4px 0 0;

            color: #8b92a3;

            font-size: 9px;
        }

        .ca-badge {
            padding: 7px 10px;

            border-radius: 999px;

            background: #eeefff;
            color: #5c5fe1;

            font-size: 8px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .06em;
        }

        /* =========================================================
           EXAM GRID
        ========================================================= */

        .exam-grid {
            position: relative;
            z-index: 2;

            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .exam-card {
            display: flex;
            flex-direction: column;

            min-height: 270px;
            padding: 18px;

            border: 1px solid #e2e5ec;
            border-radius: 15px;

            background: #fff;

            box-shadow: 0 9px 26px rgba(25,35,60,.035);

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .exam-card:hover {
            transform: translateY(-3px);

            border-color: #d3d6e8;

            box-shadow: 0 18px 38px rgba(25,35,60,.08);
        }

        .exam-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
        }

        .exam-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #f1f2ff;
            border: 1px solid #e1e3ff;

            color: #6366f1;
        }

        .exam-icon svg {
            width: 17px;
            height: 17px;
        }

        .exam-status {
            display: inline-flex;
            align-items: center;

            min-height: 22px;
            padding: 0 8px;

            border: 1px solid #d6f2e6;
            border-radius: 999px;

            background: #f1fcf7;
            color: #16845b;

            font-size: 8px;
            font-weight: 800;
        }

        .exam-card-content {
            flex: 1;
            margin-top: 17px;
        }

        .exam-category {
            color: #6366f1;

            font-size: 8px;
            font-weight: 850;

            text-transform: uppercase;
            letter-spacing: .1em;
        }

        .exam-title {
            margin: 6px 0 0;

            color: #242833;

            font-size: 14px;
            line-height: 1.35;

            font-weight: 800;
            letter-spacing: -.015em;
        }

        .exam-description {
            margin: 7px 0 0;

            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;

            overflow: hidden;

            color: #858c9d;

            font-size: 9px;
            line-height: 1.55;
        }

        .exam-meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 7px;

            margin-top: 18px;
            padding-top: 13px;

            border-top: 1px solid #edf0f4;
        }

        .meta-label {
            color: #a0a6b4;

            font-size: 7px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .meta-value {
            margin-top: 4px;

            color: #343947;

            font-size: 10px;
            font-weight: 750;
        }

        .exam-start-btn {
            width: 100%;
            height: 40px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            margin-top: 16px;

            border: 1px solid #171a24;
            border-radius: 10px;

            background: #171a24;
            color: #fff;

            text-decoration: none;

            font-size: 9px;
            font-weight: 800;

            transition: .2s ease;
        }

        .exam-start-btn:hover {
            background: #303441;
            border-color: #303441;
            transform: translateY(-1px);
        }

        .exam-start-btn svg {
            width: 13px;
            height: 13px;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty-state {
            padding: 48px 22px;

            border: 1px dashed #dce0e8;
            border-radius: 15px;

            background: rgba(255,255,255,.65);

            text-align: center;
        }

        .empty-icon {
            width: 50px;
            height: 50px;

            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #e1e4eb;
            border-radius: 14px;

            background: #f8f9fb;
            color: #9aa1b1;
        }

        .empty-icon svg {
            width: 20px;
            height: 20px;
        }

        .empty-title {
            margin-top: 14px;

            color: #343947;

            font-size: 13px;
            font-weight: 800;
        }

        .empty-text {
            max-width: 430px;
            margin: 6px auto 0;

            color: #8d94a4;

            font-size: 9px;
            line-height: 1.6;
        }

        /* =========================================================
           PROFILE
        ========================================================= */

        .profile-card {
            overflow: hidden;

            border: 1px solid #e1e4eb;
            border-radius: 17px;

            background: #fff;

            box-shadow: 0 10px 30px rgba(25,35,60,.035);
        }

        .profile-header {
            padding: 16px 20px;

            border-bottom: 1px solid #edf0f4;
        }

        .profile-title {
            color: #343947;

            font-size: 12px;
            font-weight: 800;
        }

        .profile-subtitle {
            margin-top: 3px;

            color: #969dac;

            font-size: 9px;
        }

        .profile-body {
            display: flex;
            align-items: center;
            gap: 20px;

            padding: 20px;
        }

        .profile-photo,
        .profile-photo-placeholder {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;

            border-radius: 14px;
        }

        .profile-photo {
            object-fit: cover;
            border: 1px solid #e2e5ec;
        }

        .profile-photo-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;

            background: #f0f1f6;
            border: 1px solid #e0e3ea;

            color: #727a8c;

            font-size: 17px;
            font-weight: 800;
        }

        .details {
            flex: 1;

            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px 25px;
        }

        .detail-label {
            color: #9ba1af;

            font-size: 7px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .detail-value {
            margin-top: 4px;

            color: #424856;

            font-size: 10px;
            font-weight: 650;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .footer {
            margin-top: 38px;
            padding-top: 20px;

            border-top: 1px solid #e1e4eb;

            color: #a0a6b3;

            text-align: center;

            font-size: 8px;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media (max-width: 1050px) {
            .exam-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 820px) {
            .header-inner,
            .page {
                width: min(100% - 28px, 700px);
            }

            .hero-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero-status {
                align-self: flex-start;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .details {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 620px) {
            .student-info {
                display: none;
            }

            .brand-subtitle {
                display: none;
            }

            .page {
                padding-top: 22px;
            }

            .hero {
                padding: 24px 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .exam-grid {
                grid-template-columns: 1fr;
            }

            .ca-heading {
                align-items: flex-start;
                flex-direction: column;
            }

            .profile-body {
                align-items: flex-start;
                flex-direction: column;
            }

            .details {
                width: 100%;
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 430px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .hero h1 {
                font-size: 28px;
            }
        }
    </style>
</head>

<body>

<div>

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <header class="student-header">
        <div class="header-inner">

            <a
                href="{{ route('student-exam.dashboard') }}"
                class="brand"
            >
                <div class="brand-logo">
                    M
                </div>

                <div>
                    <div class="brand-title">
                        Malav Exam Portal
                    </div>

                    <div class="brand-subtitle">
                        Student Examination System
                    </div>
                </div>
            </a>

            <div class="student-menu">

                <div class="student-info">
                    <div class="student-name">
                        {{ $account->student->full_name }}
                    </div>

                    <div class="student-code">
                        {{ $account->student->student_code }}
                    </div>
                </div>

                @if($account->student->photo)

                    <img
                        src="{{ asset('storage/'.$account->student->photo) }}"
                        class="avatar-small"
                        alt="{{ $account->student->full_name }}"
                    >

                @else

                    <div class="avatar-placeholder">
                        {{ strtoupper(substr($account->student->first_name, 0, 1)) }}
                    </div>

                @endif

                <form
                    method="POST"
                    action="{{ route('student-exam.logout') }}"
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
         PAGE
    ========================================================== --}}

    <main class="page">

        {{-- HERO --}}

        <section class="hero">

            <div class="hero-content">

                <div>

                    <div class="eyebrow">
                        <span class="eyebrow-dot"></span>
                        Student Dashboard
                    </div>

                    <h1>
                        Welcome,
                        <span>{{ $account->student->first_name }}</span>
                    </h1>

                    <p class="hero-text">
                        Your examinations, current affairs tests and assessments
                        are organised here. Choose an available test and begin
                        when you are ready.
                    </p>

                </div>

                <div class="hero-status">
                    <span class="hero-status-dot"></span>
                    Account Active
                </div>

            </div>

        </section>


        {{-- =====================================================
             QUICK STATS
        ====================================================== --}}

        @php
            $allExamCount = $exams->count();

            $currentAffairsCount = $exams
                ->where('exam_type', 'current_affairs')
                ->count();

            $availableCount = $availableExams->count();

            $upcomingCount = $upcomingExams->count();
        @endphp

        <section class="stats-grid">

            <div class="stat-card">
                <div class="stat-label">
                    Total Exams
                </div>

                <div class="stat-value">
                    {{ $allExamCount }}
                </div>

                <div class="stat-note">
                    Available in your portal
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Available Now
                </div>

                <div class="stat-value">
                    {{ $availableCount }}
                </div>

                <div class="stat-note">
                    Ready to start
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Current Affairs
                </div>

                <div class="stat-value">
                    {{ $currentAffairsCount }}
                </div>

                <div class="stat-note">
                    Published tests
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Upcoming
                </div>

                <div class="stat-value">
                    {{ $upcomingCount }}
                </div>

                <div class="stat-note">
                    Scheduled for later
                </div>
            </div>

        </section>


        {{-- =====================================================
             CURRENT AFFAIRS
        ====================================================== --}}

       @php
    $currentAffairsExams = $currentAffairsExams ?? collect();
@endphp
        @if($currentAffairsExams->isNotEmpty())

            <section class="section">
                <div
    style="
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom:12px;
        padding:12px 14px;
        border:1px solid #e1e4ed;
        border-radius:13px;
        background:#ffffff;
    "
>

    <div>
        <div
            style="
                color:#969dac;
                font-size:8px;
                font-weight:800;
                text-transform:uppercase;
                letter-spacing:.08em;
            "
        >
            Current Affairs Month
        </div>

        <div
            style="
                margin-top:4px;
                color:#303542;
                font-size:11px;
                font-weight:800;
            "
        >
            @if($selectedCurrentAffairsMonth)
                {{ \Carbon\Carbon::createFromFormat('Y-m', $selectedCurrentAffairsMonth)->format('F Y') }}
            @else
                No month available
            @endif
        </div>
    </div>


    @if($currentAffairsMonths->isNotEmpty())

        <form
            method="GET"
            action="{{ route('student-exam.dashboard') }}"
            style="margin:0;"
        >

            <select
                name="current_affairs_month"
                onchange="this.form.submit()"
                style="
                    min-width:145px;
                    height:35px;
                    padding:0 10px;
                    border:1px solid #dfe3eb;
                    border-radius:9px;
                    background:#f8f9fc;
                    color:#3f4655;
                    font-size:9px;
                    font-weight:700;
                    outline:none;
                    cursor:pointer;
                "
            >

                @foreach($currentAffairsMonths as $month)

                    <option
                        value="{{ $month }}"
                        @selected($selectedCurrentAffairsMonth === $month)
                    >
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                    </option>

                @endforeach

            </select>

        </form>

    @endif

</div>

                <div class="section-header">

                    <div>
                        <h2 class="section-title">
                            Current Affairs
                        </h2>

                        <p class="section-description">
                            Stay updated with the latest current affairs tests.
                        </p>
                    </div>

                    <div class="section-count">
                        {{ $currentAffairsExams->count() }}
                        {{ $currentAffairsExams->count() === 1 ? 'Test' : 'Tests' }}
                    </div>

                </div>


                <div class="current-affairs-panel">

                    <div class="ca-heading">

                        <div class="ca-heading-left">

                            <div class="ca-icon">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="4"
                                        y="3"
                                        width="16"
                                        height="18"
                                        rx="2"
                                    />
                                    <path d="M8 7h8" />
                                    <path d="M8 11h8" />
                                    <path d="M8 15h5" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="ca-title">
                                    Current Affairs Tests
                                </h3>

                                <p class="ca-subtitle">
                                    Tests published by your library
                                </p>
                            </div>

                        </div>

                        <div class="ca-badge">
                            Library Updates
                        </div>

                    </div>


                    <div class="exam-grid">

                        @foreach($currentAffairsExams as $exam)

                            <article class="exam-card">

                                <div class="exam-card-top">

                                    <div class="exam-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <rect
                                                x="5"
                                                y="3"
                                                width="14"
                                                height="18"
                                                rx="2"
                                            />

                                            <path d="M8 7h8" />
                                            <path d="M8 11h8" />
                                            <path d="M8 15h5" />
                                        </svg>

                                    </div>


                                    @php
                                        $latestAttemptForStatus = \App\Models\ExamAttempt::query()
                                            ->where('exam_id', $exam->id)
                                            ->where('student_id', $account->student->id)
                                            ->latest('id')
                                            ->first();
                                    @endphp

                                    <span class="exam-status">

                                        @if(
                                            $latestAttemptForStatus &&
                                            $latestAttemptForStatus->status === 'in_progress'
                                        )
                                            In Progress

                                        @elseif(
                                            $latestAttemptForStatus &&
                                            in_array(
                                                $latestAttemptForStatus->status,
                                                ['submitted', 'expired'],
                                                true
                                            )
                                        )
                                            Completed

                                        @else
                                            Available
                                        @endif

                                    </span>

                                </div>


                                <div class="exam-card-content">

                                    @if($exam->category)

                                        <div class="exam-category">
                                            {{ $exam->category->name }}
                                        </div>

                                    @else

                                        <div class="exam-category">
                                            Current Affairs
                                        </div>

                                    @endif


                                    <h3 class="exam-title">
                                        {{ $exam->title }}
                                    </h3>


                                    @if($exam->description)

                                        <p class="exam-description">
                                            {{ $exam->description }}
                                        </p>

                                    @else

                                        <p class="exam-description">
                                            Test your knowledge with the latest
                                            current affairs questions.
                                        </p>

                                    @endif

                                </div>


                                <div class="exam-meta">

                                    <div>
                                        <div class="meta-label">
                                            Questions
                                        </div>

                                        <div class="meta-value">
                                            {{ $exam->questions_count }}
                                        </div>
                                    </div>

                                    <div>
                                        <div class="meta-label">
                                            Duration
                                        </div>

                                        <div class="meta-value">
                                            {{ $exam->duration_minutes }} min
                                        </div>
                                    </div>

                                    <div>
                                        <div class="meta-label">
                                            Marks
                                        </div>

                                        <div class="meta-value">
                                            {{ $exam->total_marks }}
                                        </div>
                                    </div>

                                </div>


                                @if(
                                    $latestAttemptForStatus &&
                                    $latestAttemptForStatus->status === 'in_progress'
                                )

                                    <a
                                        href="{{ route('student-exam.attempt', [
                                            'exam' => $exam,
                                            'attempt' => $latestAttemptForStatus,
                                        ]) }}"
                                        class="exam-start-btn"
                                    >
                                        Continue Exam

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M5 12h14" />
                                            <path d="m13 6 6 6-6 6" />
                                        </svg>
                                    </a>

                                @elseif(
                                    $latestAttemptForStatus &&
                                    in_array(
                                        $latestAttemptForStatus->status,
                                        ['submitted', 'expired'],
                                        true
                                    )
                                )

                                    <a
                                        href="{{ route('student-exam.result', [
                                            'exam' => $exam,
                                            'attempt' => $latestAttemptForStatus,
                                        ]) }}"
                                        class="exam-start-btn"
                                    >
                                        View Result

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M5 12h14" />
                                            <path d="m13 6 6 6-6 6" />
                                        </svg>
                                    </a>

                                @else

                                    <a
                                        href="{{ route('student-exam.instructions', $exam) }}"
                                        class="exam-start-btn"
                                    >
                                        Start Exam

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="M5 12h14" />
                                            <path d="m13 6 6 6-6 6" />
                                        </svg>
                                    </a>

                                @endif

                            </article>

                        @endforeach

                    </div>

                </div>

            </section>

        @endif

        {{-- =====================================================
     MAJOR TESTS
====================================================== --}}

@if($majorTests->isNotEmpty())

    <section class="section">

        <div class="section-header">

            <div>
                <h2 class="section-title">
                    Major Tests
                </h2>

                <p class="section-description">
                    Full-length tests available for all eligible students.
                </p>
            </div>

            <div class="section-count">
                {{ $majorTests->count() }}
                {{ $majorTests->count() === 1 ? 'Test' : 'Tests' }}
            </div>

        </div>


        <div class="exam-grid">

            @foreach($majorTests as $exam)

                <article class="exam-card">

                    <div class="exam-card-top">

                        <div class="exam-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v17H6.5A2.5 2.5 0 0 0 4 22V5.5Z" />
                                <path d="M4 5.5V19" />
                                <path d="M8 7h8" />
                                <path d="M8 11h7" />
                            </svg>

                        </div>


                        @php
                            $latestAttemptForMajorTest =
                                \App\Models\ExamAttempt::query()
                                    ->where('exam_id', $exam->id)
                                    ->where('student_id', $account->student->id)
                                    ->latest('id')
                                    ->first();
                        @endphp


                        <span class="exam-status">

                            @if(
                                $latestAttemptForMajorTest &&
                                $latestAttemptForMajorTest->status === 'in_progress'
                            )
                                In Progress

                            @elseif(
                                $latestAttemptForMajorTest &&
                                in_array(
                                    $latestAttemptForMajorTest->status,
                                    ['submitted', 'expired'],
                                    true
                                )
                            )
                                Completed

                            @else
                                Available
                            @endif

                        </span>

                    </div>


                    <div class="exam-card-content">

                        @if($exam->category)

                            <div class="exam-category">
                                {{ $exam->category->name }}
                            </div>

                        @else

                            <div class="exam-category">
                                Major Test
                            </div>

                        @endif


                        <h3 class="exam-title">
                            {{ $exam->title }}
                        </h3>


                        @if($exam->description)

                            <p class="exam-description">
                                {{ $exam->description }}
                            </p>

                        @else

                            <p class="exam-description">
                                Complete the full-length major test and check your preparation level.
                            </p>

                        @endif


                        <div class="exam-meta">

                            <div>
                                <div class="meta-label">
                                    Questions
                                </div>

                                <div class="meta-value">
                                    {{ $exam->questions_count ?? 0 }}
                                </div>
                            </div>


                            <div>
                                <div class="meta-label">
                                    Marks
                                </div>

                                <div class="meta-value">
                                    {{ $exam->total_marks }}
                                </div>
                            </div>


                            <div>
                                <div class="meta-label">
                                    Duration
                                </div>

                                <div class="meta-value">
                                    {{ $exam->duration_minutes }} min
                                </div>
                            </div>

                        </div>

                    </div>


                    @if(
    $exam->starts_at &&
    now()->lt($exam->starts_at)
)

    <span
        class="exam-start-btn"
        style="opacity:.65;cursor:not-allowed;"
    >
        Upcoming

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
        >
            <path d="M12 8v4l2.5 2.5" />
            <circle cx="12" cy="12" r="9" />
        </svg>
    </span>

@elseif(
    $exam->ends_at &&
    now()->gt($exam->ends_at)
)

    <span
        class="exam-start-btn"
        style="opacity:.65;cursor:not-allowed;"
    >
        Expired
    </span>

@else

    <a
        href="{{ route('student-exam.instructions', $exam) }}"
        class="exam-start-btn"
    >
        View Test

        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
        >
            <path d="M5 12h14" />
            <path d="m13 6 6 6-6 6" />
        </svg>
    </a>

@endif

                </article>

            @endforeach

        </div>

    </section>

@endif


        {{-- =====================================================
             OTHER EXAMS
        ====================================================== --}}

       @php
    $majorTests = $majorTests ?? collect();

    $otherExams = $exams
        ->whereNotIn('exam_type', ['current_affairs', 'major_test'])
        ->values();
@endphp

        <section class="section">

            <div class="section-header">

                <div>
                    <h2 class="section-title">
                        My Exams
                    </h2>

                    <p class="section-description">
                        Assigned and other published examinations.
                    </p>
                </div>

                <div class="section-count">
                    {{ $otherExams->count() }}
                    {{ $otherExams->count() === 1 ? 'Exam' : 'Exams' }}
                </div>

            </div>


            @if($otherExams->isNotEmpty())

                <div class="exam-grid">

                    @foreach($otherExams as $exam)

                        <article class="exam-card">

                            <div class="exam-card-top">

                                <div class="exam-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="5"
                                            y="3"
                                            width="14"
                                            height="18"
                                            rx="2"
                                        />

                                        <path d="M8 7h8" />
                                        <path d="M8 11h8" />
                                        <path d="M8 15h5" />
                                    </svg>

                                </div>


                                @php
                                    $latestAttemptForStatus = \App\Models\ExamAttempt::query()
                                        ->where('exam_id', $exam->id)
                                        ->where('student_id', $account->student->id)
                                        ->latest('id')
                                        ->first();
                                @endphp

                                <span class="exam-status">

                                    @if(
                                        $latestAttemptForStatus &&
                                        $latestAttemptForStatus->status === 'in_progress'
                                    )
                                        In Progress

                                    @elseif(
                                        $latestAttemptForStatus &&
                                        in_array(
                                            $latestAttemptForStatus->status,
                                            ['submitted', 'expired'],
                                            true
                                        )
                                    )
                                        Completed

                                    @else
                                        Available
                                    @endif

                                </span>

                            </div>


                            <div class="exam-card-content">

                                @if($exam->category)

                                    <div class="exam-category">
                                        {{ $exam->category->name }}
                                    </div>

                                @else

                                    <div class="exam-category">
                                        Examination
                                    </div>

                                @endif


                                <h3 class="exam-title">
                                    {{ $exam->title }}
                                </h3>


                                @if($exam->description)

                                    <p class="exam-description">
                                        {{ $exam->description }}
                                    </p>

                                @else

                                    <p class="exam-description">
                                        Complete this online examination
                                        within the allotted time.
                                    </p>

                                @endif

                            </div>


                            <div class="exam-meta">

                                <div>
                                    <div class="meta-label">
                                        Questions
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->questions_count }}
                                    </div>
                                </div>

                                <div>
                                    <div class="meta-label">
                                        Duration
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->duration_minutes }} min
                                    </div>
                                </div>

                                <div>
                                    <div class="meta-label">
                                        Marks
                                    </div>

                                    <div class="meta-value">
                                        {{ $exam->total_marks }}
                                    </div>
                                </div>

                            </div>


                            @if(
                                $latestAttemptForStatus &&
                                $latestAttemptForStatus->status === 'in_progress'
                            )

                                <a
                                    href="{{ route('student-exam.attempt', [
                                        'exam' => $exam,
                                        'attempt' => $latestAttemptForStatus,
                                    ]) }}"
                                    class="exam-start-btn"
                                >
                                    Continue Exam

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path d="M5 12h14" />
                                        <path d="m13 6 6 6-6 6" />
                                    </svg>
                                </a>

                            @elseif(
                                $latestAttemptForStatus &&
                                in_array(
                                    $latestAttemptForStatus->status,
                                    ['submitted', 'expired'],
                                    true
                                )
                            )

                                <a
                                    href="{{ route('student-exam.result', [
                                        'exam' => $exam,
                                        'attempt' => $latestAttemptForStatus,
                                    ]) }}"
                                    class="exam-start-btn"
                                >
                                    View Result

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path d="M5 12h14" />
                                        <path d="m13 6 6-6" />
                                    </svg>
                                </a>

                            @else

                                <a
                                    href="{{ route('student-exam.instructions', $exam) }}"
                                    class="exam-start-btn"
                                >
                                    Start Exam

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path d="M5 12h14" />
                                        <path d="m13 6 6 6-6 6" />
                                    </svg>
                                </a>

                            @endif

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path d="M9 12h6" />
                            <path d="M9 16h4" />

                            <path
                                d="M7 4h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"
                            />

                            <path d="M9 4V2h6v2" />
                        </svg>

                    </div>

                    <div class="empty-title">
                        No other exams available
                    </div>

                    <div class="empty-text">
                        Assigned and published examinations will appear here
                        when they become available to you.
                    </div>

                </div>

            @endif

        </section>


        {{-- =====================================================
             PROFILE
        ====================================================== --}}

        <section class="section">

            <div class="section-header">

                <div>
                    <h2 class="section-title">
                        My Profile
                    </h2>

                    <p class="section-description">
                        Your registered student information.
                    </p>
                </div>

            </div>


            <section class="profile-card">

                <div class="profile-header">

                    <div class="profile-title">
                        Student Information
                    </div>

                    <div class="profile-subtitle">
                        Details registered with your library
                    </div>

                </div>


                <div class="profile-body">

                    @if($account->student->photo)

                        <img
                            src="{{ asset('storage/'.$account->student->photo) }}"
                            class="profile-photo"
                            alt="{{ $account->student->full_name }}"
                        >

                    @else

                        <div class="profile-photo-placeholder">
                            {{ strtoupper(substr($account->student->first_name, 0, 1)) }}
                        </div>

                    @endif


                    <div class="details">

                        <div>
                            <div class="detail-label">
                                Name
                            </div>

                            <div class="detail-value">
                                {{ $account->student->full_name }}
                            </div>
                        </div>


                        <div>
                            <div class="detail-label">
                                Student ID
                            </div>

                            <div class="detail-value">
                                {{ $account->student->student_code }}
                            </div>
                        </div>


                        <div>
                            <div class="detail-label">
                                Mobile
                            </div>

                            <div class="detail-value">
                                {{ $account->student->mobile ?: '—' }}
                            </div>
                        </div>


                        <div>
                            <div class="detail-label">
                                College
                            </div>

                            <div class="detail-value">
                                {{ $account->student->college ?: '—' }}
                            </div>
                        </div>


                        <div>
                            <div class="detail-label">
                                Course
                            </div>

                            <div class="detail-value">
                                {{ $account->student->course ?: '—' }}
                            </div>
                        </div>


                        <div>
                            <div class="detail-label">
                                Preparing For
                            </div>

                            <div class="detail-value">
                                {{ $account->student->preparing_for ?: '—' }}
                            </div>
                        </div>

                    </div>

                </div>

            </section>

        </section>


        {{-- FOOTER --}}

        <footer class="footer">
            © {{ date('Y') }} Malav Exam Portal
            <span style="margin:0 7px;">•</span>
            Student Examination System
        </footer>

    </main>

</div>

</body>
</html>