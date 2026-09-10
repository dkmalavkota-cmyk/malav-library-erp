<x-layouts::examination :title="$exam->title">

    <style>
        .exam-page {
            min-height: 100vh;
            padding: 32px;
            background:
                radial-gradient(
                    circle at 82% 0%,
                    rgba(99,102,241,.09),
                    transparent 380px
                ),
                #09090b;
        }

        .exam-container {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
        }

        /* =====================================================
           TOP HEADER
        ===================================================== */

        .exam-topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 10px;
            color: #52525b;
            font-size: 10px;
        }

        .breadcrumb a {
            color: #818cf8;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: #a5b4fc;
        }

        .exam-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .exam-icon {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(99,102,241,.25);
            border-radius: 14px;

            background: rgba(99,102,241,.08);
            color: #a5b4fc;
        }

        .exam-icon svg {
            width: 22px;
            height: 22px;
        }

        .exam-title {
            margin: 0;

            color: #fafafa;

            font-size: clamp(25px, 3vw, 34px);
            font-weight: 800;

            letter-spacing: -.035em;
            line-height: 1.1;
        }

        .exam-subtitle {
            margin: 6px 0 0;

            color: #71717a;

            font-size: 12px;
            line-height: 1.5;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
        }

        /* =====================================================
           BUTTONS
        ===================================================== */

        .exam-btn {
            min-height: 39px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 0 13px;

            border: 1px solid #303038;
            border-radius: 10px;

            background: rgba(255,255,255,.025);

            color: #d4d4d8 !important;

            text-decoration: none !important;

            font-size: 10px;
            font-weight: 700;

            transition:
                transform .18s ease,
                background .18s ease,
                border-color .18s ease,
                color .18s ease;
        }

        .exam-btn:hover {
            color: #fff !important;
            background: rgba(255,255,255,.05);
            border-color: #454550;
            transform: translateY(-1px);
        }

        .exam-btn svg {
            width: 14px;
            height: 14px;
        }

        .exam-btn-primary {
            border-color: rgba(99,102,241,.32);
            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );
            color: #fff !important;

            box-shadow:
                0 8px 22px rgba(99,102,241,.17);
        }

        .exam-btn-primary:hover {
            border-color: rgba(129,140,248,.5);
            background:
                linear-gradient(
                    135deg,
                    #7073f5,
                    #8658f2
                );
        }

        .exam-btn-danger {
            border-color: rgba(239,68,68,.18);
            background: rgba(239,68,68,.05);
            color: #fca5a5 !important;
        }

        .exam-btn-danger:hover {
            border-color: rgba(239,68,68,.35);
            background: rgba(239,68,68,.09);
        }

        /* =====================================================
           HERO
        ===================================================== */

        .exam-hero {
            position: relative;
            overflow: hidden;

            padding: 24px;

            margin-bottom: 15px;

            border: 1px solid rgba(255,255,255,.07);
            border-radius: 19px;

            background:
                radial-gradient(
                    circle at 90% 0%,
                    rgba(99,102,241,.12),
                    transparent 330px
                ),
                linear-gradient(
                    145deg,
                    #141419,
                    #101014
                );

            box-shadow:
                0 18px 50px rgba(0,0,0,.16);
        }

        .hero-content {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 25px;
        }

        .hero-left {
            min-width: 0;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            min-height: 27px;

            padding: 0 9px;

            margin-bottom: 10px;

            border: 1px solid rgba(99,102,241,.20);
            border-radius: 9px;

            background: rgba(99,102,241,.07);

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 700;
        }

        .category-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: #818cf8;

            box-shadow:
                0 0 10px rgba(129,140,248,.7);
        }

        .hero-title {
            margin: 0;

            color: #f4f4f5;

            font-size: 20px;
            font-weight: 750;

            letter-spacing: -.025em;
        }

        .hero-description {
            max-width: 800px;

            margin: 7px 0 0;

            color: #71717a;

            font-size: 11px;
            line-height: 1.65;
        }

        .status-stack {
            display: flex;
            align-items: center;
            justify-content: flex-end;

            flex-wrap: wrap;
            gap: 7px;

            flex-shrink: 0;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            min-height: 28px;

            padding: 0 9px;

            border-radius: 9px;

            font-size: 9px;
            font-weight: 700;
        }

        .status-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: currentColor;
        }

        .status-active {
            border: 1px solid rgba(34,197,94,.18);
            background: rgba(34,197,94,.07);
            color: #86efac;
        }

        .status-inactive {
            border: 1px solid rgba(239,68,68,.18);
            background: rgba(239,68,68,.07);
            color: #fca5a5;
        }

        .status-published {
            border: 1px solid rgba(34,197,94,.18);
            background: rgba(34,197,94,.07);
            color: #86efac;
        }

        .status-draft {
            border: 1px solid rgba(234,179,8,.18);
            background: rgba(234,179,8,.07);
            color: #fde68a;
        }

        /* =====================================================
           STATS
        ===================================================== */

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(5, minmax(0, 1fr));

            gap: 9px;

            margin-top: 17px;
        }

        .stat-card {
            min-height: 86px;

            padding: 14px;

            border: 1px solid rgba(255,255,255,.055);
            border-radius: 12px;

            background: rgba(0,0,0,.12);
        }

        .stat-label {
            color: #62626c;

            font-size: 9px;
            font-weight: 600;
        }

        .stat-value {
            margin-top: 6px;

            color: #ededf0;

            font-size: 18px;
            font-weight: 780;

            letter-spacing: -.025em;
        }

        .stat-value span {
            color: #666670;

            font-size: 9px;
            font-weight: 600;
        }

        /* =====================================================
           CONTROL CENTER
        ===================================================== */

        .control-panel {
            margin-bottom: 15px;

            padding: 15px;

            border: 1px solid rgba(99,102,241,.16);
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(99,102,241,.07),
                    rgba(255,255,255,.018)
                );
        }

        .control-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 12px;
        }

        .control-title {
            margin: 0;

            color: #f4f4f5;

            font-size: 13px;
            font-weight: 750;
        }

        .control-subtitle {
            margin-top: 3px;

            color: #666670;

            font-size: 9px;
        }

        .control-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 9px;
        }

        .control-card {
            display: flex;
            align-items: center;
            gap: 10px;

            min-height: 58px;

            padding: 10px 11px;

            border: 1px solid rgba(255,255,255,.06);
            border-radius: 11px;

            background: rgba(0,0,0,.14);

            color: inherit;

            text-decoration: none;

            transition:
                transform .18s ease,
                border-color .18s ease,
                background .18s ease;
        }

        .control-card:hover {
            color: inherit;

            transform: translateY(-2px);

            border-color: rgba(99,102,241,.30);

            background: rgba(99,102,241,.08);
        }

        .control-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(255,255,255,.07);
            border-radius: 9px;

            background: rgba(255,255,255,.025);

            color: #a5b4fc;
        }

        .control-icon svg {
            width: 15px;
            height: 15px;
        }

        .control-text {
            min-width: 0;
        }

        .control-name {
            color: #e4e4e7;

            font-size: 10px;
            font-weight: 700;
        }

        .control-desc {
            margin-top: 2px;

            color: #5f5f69;

            font-size: 8px;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .control-arrow {
            margin-left: auto;

            color: #52525b;

            font-size: 14px;
        }

        /* =====================================================
           MAIN GRID
        ===================================================== */

        .content-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                330px;

            gap: 15px;

            align-items: start;
        }

        .panel {
            overflow: hidden;

            border: 1px solid rgba(255,255,255,.065);
            border-radius: 16px;

            background: #121216;

            box-shadow:
                0 14px 40px rgba(0,0,0,.10);
        }

        .panel + .panel {
            margin-top: 15px;
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding: 16px 18px;

            border-bottom: 1px solid rgba(255,255,255,.055);
        }

        .panel-title {
            margin: 0;

            color: #ededf0;

            font-size: 12px;
            font-weight: 720;
        }

        .panel-description {
            margin: 3px 0 0;

            color: #5f5f69;

            font-size: 9px;
        }

        /* =====================================================
           QUESTION PAPER
        ===================================================== */

        .paper-body {
            padding: 16px;
        }

        .summary-grid {
            display: grid;

            grid-template-columns:
                repeat(3, minmax(0, 1fr));

            gap: 9px;
        }

        .summary-card {
            padding: 13px;

            border: 1px solid rgba(255,255,255,.05);
            border-radius: 11px;

            background: rgba(0,0,0,.10);
        }

        .summary-label {
            color: #62626c;

            font-size: 9px;
        }

        .summary-value {
            margin-top: 5px;

            color: #dedee2;

            font-size: 15px;
            font-weight: 740;
        }

        .progress-wrap {
            margin-top: 14px;
        }

        .progress-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 6px;
        }

        .progress-label,
        .progress-value {
            font-size: 9px;
        }

        .progress-label {
            color: #666670;
        }

        .progress-value {
            color: #a5b4fc;
            font-weight: 700;
        }

        .progress-track {
            height: 6px;

            overflow: hidden;

            border-radius: 999px;

            background: #202026;
        }

        .progress-fill {
            height: 100%;

            border-radius: inherit;

            background:
                linear-gradient(
                    90deg,
                    #6366f1,
                    #8b5cf6
                );
        }

        .question-list {
            display: flex;
            flex-direction: column;

            gap: 8px;

            margin-top: 14px;
        }

        .question-item {
            display: flex;
            align-items: flex-start;

            gap: 11px;

            padding: 11px;

            border: 1px solid rgba(255,255,255,.045);
            border-radius: 11px;

            background: rgba(0,0,0,.10);
        }

        .question-number {
            width: 29px;
            height: 29px;
            flex: 0 0 29px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: rgba(99,102,241,.08);

            color: #a5b4fc;

            font-size: 9px;
            font-weight: 750;
        }

        .question-main {
            min-width: 0;
            flex: 1;
        }

        .question-text {
            color: #d4d4d8;

            font-size: 10px;
            line-height: 1.55;

            font-weight: 600;
        }

        .question-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 5px;

            margin-top: 6px;
        }

        .meta-chip {
            display: inline-flex;
            align-items: center;

            min-height: 20px;

            padding: 0 7px;

            border: 1px solid rgba(255,255,255,.05);
            border-radius: 7px;

            background: #19191e;

            color: #696973;

            font-size: 8px;
        }

        /* =====================================================
           EMPTY
        ===================================================== */

        .empty-state {
            padding: 48px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 12px;

            border: 1px solid rgba(99,102,241,.18);
            border-radius: 14px;

            background: rgba(99,102,241,.06);

            color: #a5b4fc;
        }

        .empty-icon svg {
            width: 22px;
            height: 22px;
        }

        .empty-title {
            margin: 0;

            color: #e4e4e7;

            font-size: 13px;
            font-weight: 700;
        }

        .empty-text {
            max-width: 470px;

            margin: 6px auto 16px;

            color: #60606a;

            font-size: 10px;
            line-height: 1.65;
        }

        /* =====================================================
           SCHEDULE
        ===================================================== */

        .schedule-grid {
            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 9px;

            padding: 15px;
        }

        .schedule-box {
            padding: 13px;

            border: 1px solid rgba(255,255,255,.05);
            border-radius: 11px;

            background: rgba(0,0,0,.10);
        }

        .schedule-label {
            color: #62626c;

            font-size: 9px;
        }

        .schedule-value {
            margin-top: 6px;

            color: #d4d4d8;

            font-size: 10px;
            font-weight: 650;
        }

        .schedule-empty {
            color: #55555f;
        }

        /* =====================================================
           INFO
        ===================================================== */

        .info-list {
            padding: 4px 17px 9px;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            min-height: 39px;

            border-bottom: 1px solid rgba(255,255,255,.045);
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-label {
            color: #64646e;

            font-size: 9px;
        }

        .info-value {
            max-width: 180px;

            color: #c9c9cf;

            font-size: 10px;
            font-weight: 650;

            text-align: right;

            word-break: break-word;
        }

        .muted {
            color: #666670;
        }

        /* =====================================================
           DANGER ZONE
        ===================================================== */

        .danger-panel {
            border-color: rgba(239,68,68,.12);
        }

        .danger-body {
            padding: 15px 17px;
        }

        .danger-text {
            margin: 0 0 12px;

            color: #666670;

            font-size: 9px;
            line-height: 1.6;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1150px) {
            .stats-grid {
                grid-template-columns:
                    repeat(3, minmax(0, 1fr));
            }

            .control-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .content-grid {
                grid-template-columns:
                    minmax(0, 1fr)
                    290px;
            }
        }

        @media (max-width: 900px) {
            .exam-page {
                padding: 24px 20px 35px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .hero-content {
                flex-direction: column;
            }

            .status-stack {
                justify-content: flex-start;
            }
        }

        @media (max-width: 650px) {
            .exam-page {
                padding: 18px 14px 35px;
            }

            .exam-topbar {
                flex-direction: column;
            }

            .top-actions {
                width: 100%;
            }

            .top-actions .exam-btn {
                flex: 1;
            }

            .exam-heading {
                align-items: flex-start;
            }

            .exam-title {
                font-size: 24px;
            }

            .exam-hero {
                padding: 18px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
            }

            .control-grid {
                grid-template-columns: 1fr;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .schedule-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 430px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .top-actions {
                flex-direction: column;
            }

            .top-actions .exam-btn {
                width: 100%;
            }
        }
    </style>


    @php
        $progress = $exam->total_marks > 0
            ? min(
                100,
                round(
                    ($questionMarks / $exam->total_marks) * 100,
                    2
                )
            )
            : 0;
    @endphp


    <div class="exam-page">

        <div class="exam-container">

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="exam-topbar">

                <div>

                    <div class="breadcrumb">

                        <a href="{{ route('exams.index') }}">
                            Exams
                        </a>

                        <span>/</span>

                        <span>
                            {{ $exam->title }}
                        </span>

                    </div>


                    <div class="exam-heading">

                        <div class="exam-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 8h8M8 12h8M8 16h5"
                                />
                            </svg>

                        </div>


                        <div>

                            <h1 class="exam-title">
                                {{ $exam->title }}
                            </h1>

                            <p class="exam-subtitle">
                                Exam Control Center
                            </p>

                        </div>

                    </div>

                </div>


                <div class="top-actions">

                    <a
                        href="{{ route('exams.index') }}"
                        class="exam-btn"
                    >
                        ← Back to Exams
                    </a>


                    <a
                        href="{{ route('exams.edit', $exam) }}"
                        class="exam-btn exam-btn-primary"
                    >
                        Edit / Settings
                    </a>

                </div>

            </div>


            {{-- =================================================
                 HERO
            ================================================== --}}

            <section class="exam-hero">

                <div class="hero-content">

                    <div class="hero-left">

                        @if($exam->category)

                            <div class="category-pill">

                                <span class="category-dot"></span>

                                {{ $exam->category->name }}

                            </div>

                        @endif


                        <h2 class="hero-title">
                            {{ $exam->title }}
                        </h2>


                        <p class="hero-description">
                            {{ $exam->description ?: 'No description has been added for this examination yet.' }}
                        </p>

                    </div>


                    <div class="status-stack">

                        @if($exam->is_active)

                            <span class="status status-active">
                                <span class="status-dot"></span>
                                Active
                            </span>

                        @else

                            <span class="status status-inactive">
                                <span class="status-dot"></span>
                                Inactive
                            </span>

                        @endif


                        @if($exam->is_published)

                            <span class="status status-published">
                                <span class="status-dot"></span>
                                Published
                            </span>

                        @else

                            <span class="status status-draft">
                                <span class="status-dot"></span>
                                Draft
                            </span>

                        @endif

                    </div>

                </div>


                {{-- STATS --}}

                <div class="stats-grid">

                    <div class="stat-card">

                        <div class="stat-label">
                            Duration
                        </div>

                        <div class="stat-value">
                            {{ $exam->duration_minutes }}
                            <span>min</span>
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-label">
                            Total Marks
                        </div>

                        <div class="stat-value">
                            {{ $exam->total_marks }}
                            <span>marks</span>
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-label">
                            Passing Marks
                        </div>

                        <div class="stat-value">
                            {{ $exam->passing_marks }}
                            <span>marks</span>
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-label">
                            Questions
                        </div>

                        <div class="stat-value">
                            {{ $questionCount }}
                            <span>questions</span>
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-label">
                            Attempt Limit
                        </div>

                        <div class="stat-value">
                            {{ $exam->attempt_limit }}
                            <span>attempts</span>
                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 CONTROL CENTER
            ================================================== --}}

            <section class="control-panel">

                <div class="control-header">

                    <div>

                        <h2 class="control-title">
                            Exam Management
                        </h2>

                        <p class="control-subtitle">
                            Manage every important part of this examination from here.
                        </p>

                    </div>

                </div>


                <div class="control-grid">

                    {{-- QUESTION PAPER --}}
                    <a
                        href="{{ url('/exams/' . $exam->id . '/question-paper') }}"
                        class="control-card"
                    >

                        <div class="control-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M5 4h14v16H5z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M8 8h8M8 12h8M8 16h5"
                                />
                            </svg>

                        </div>

                        <div class="control-text">

                            <div class="control-name">
                                Question Paper
                            </div>

                            <div class="control-desc">
                                Build & reorder questions
                            </div>

                        </div>

                        <div class="control-arrow">
                            →
                        </div>

                    </a>


                    {{-- ASSIGNMENTS --}}
                    <a
                        href="{{ url('/exams/' . $exam->id . '/assignments') }}"
                        class="control-card"
                    >

                        <div class="control-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M8 6h13M8 12h13M8 18h13"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linecap="round"
                                    stroke-width="1.7"
                                    d="M3 6h.01M3 12h.01M3 18h.01"
                                />
                            </svg>

                        </div>

                        <div class="control-text">

                            <div class="control-name">
                                Assignments
                            </div>

                            <div class="control-desc">
                                Assign exam to students
                            </div>

                        </div>

                        <div class="control-arrow">
                            →
                        </div>

                    </a>


                    {{-- RESULTS --}}
                    <a
                        href="{{ url('/exams/' . $exam->id . '/results') }}"
                        class="control-card"
                    >

                        <div class="control-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M4 19V5M4 19h16"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M8 16v-4M12 16V8M16 16v-7"
                                />
                            </svg>

                        </div>

                        <div class="control-text">

                            <div class="control-name">
                                Results
                            </div>

                            <div class="control-desc">
                                View student performance
                            </div>

                        </div>

                        <div class="control-arrow">
                            →
                        </div>

                    </a>


                    {{-- SETTINGS --}}
                    <a
                        href="{{ route('exams.edit', $exam) }}"
                        class="control-card"
                    >

                        <div class="control-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.9 1.9-.06-.06a1.7 1.7 0 00-1.88-.34 1.7 1.7 0 00-1.03 1.55V20h-2.68v-.01a1.7 1.7 0 00-1.03-1.55 1.7 1.7 0 00-1.88.34l-.06.06-1.9-1.9.06-.06A1.7 1.7 0 007.6 15a1.7 1.7 0 00-1.55-1.03H6V11.3h.05A1.7 1.7 0 007.6 10a1.7 1.7 0 00-.34-1.88L7.2 8.06l1.9-1.9.06.06a1.7 1.7 0 001.88.34A1.7 1.7 0 0012.07 5H12V4h2.68v1a1.7 1.7 0 001.03 1.55 1.7 1.7 0 001.88-.34l.06-.06 1.9 1.9-.06.06A1.7 1.7 0 0019.4 10c.16.62.7 1.06 1.34 1.06H21v2.68h-.26A1.7 1.7 0 0019.4 15z"
                                />
                            </svg>

                        </div>

                        <div class="control-text">

                            <div class="control-name">
                                Exam Settings
                            </div>

                            <div class="control-desc">
                                Timing, marks & publishing
                            </div>

                        </div>

                        <div class="control-arrow">
                            →
                        </div>

                    </a>

                </div>

            </section>


            {{-- =================================================
                 MAIN CONTENT
            ================================================== --}}

            <div class="content-grid">

                {{-- =================================================
                     LEFT COLUMN
                ================================================== --}}

                <div>

                    {{-- QUESTION PAPER --}}
                    <section class="panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Question Paper
                                </h2>

                                <p class="panel-description">
                                    Questions currently attached to this examination.
                                </p>

                            </div>


                            <a
                                href="{{ url('/exams/' . $exam->id . '/question-paper') }}"
                                class="exam-btn exam-btn-primary"
                            >
                                Manage Paper
                            </a>

                        </div>


                        <div class="paper-body">

                            <div class="summary-grid">

                                <div class="summary-card">

                                    <div class="summary-label">
                                        Questions Added
                                    </div>

                                    <div class="summary-value">
                                        {{ $questionCount }}
                                    </div>

                                </div>


                                <div class="summary-card">

                                    <div class="summary-label">
                                        Marks Added
                                    </div>

                                    <div class="summary-value">
                                        {{ number_format($questionMarks, 2) }}
                                    </div>

                                </div>


                                <div class="summary-card">

                                    <div class="summary-label">
                                        Remaining Marks
                                    </div>

                                    <div class="summary-value">
                                        {{ number_format($remainingMarks, 2) }}
                                    </div>

                                </div>

                            </div>


                            <div class="progress-wrap">

                                <div class="progress-top">

                                    <span class="progress-label">
                                        Question Paper Completion
                                    </span>

                                    <span class="progress-value">
                                        {{ $progress }}%
                                    </span>

                                </div>


                                <div class="progress-track">

                                    <div
                                        class="progress-fill"
                                        style="width: {{ $progress }}%;"
                                    ></div>

                                </div>

                            </div>


                            @if($questionCount > 0)

                                <div class="question-list">

                                    @foreach($exam->questions as $index => $question)

                                        <div class="question-item">

                                            <div class="question-number">
                                                {{ $index + 1 }}
                                            </div>


                                            <div class="question-main">

                                                <div class="question-text">
                                                    {{ $question->question_text }}
                                                </div>


                                                <div class="question-meta">

                                                    @if($question->subject)

                                                        <span class="meta-chip">
                                                            {{ $question->subject->name }}
                                                        </span>

                                                    @endif


                                                    @if($question->topic)

                                                        <span class="meta-chip">
                                                            {{ $question->topic->name }}
                                                        </span>

                                                    @endif


                                                    <span class="meta-chip">

                                                        {{
                                                            number_format(
                                                                $question->pivot->marks !== null
                                                                    ? $question->pivot->marks
                                                                    : $question->marks,
                                                                2
                                                            )
                                                        }}

                                                        marks

                                                    </span>


                                                    @if($question->pivot->negative_marks > 0)

                                                        <span class="meta-chip">
                                                            -{{ $question->pivot->negative_marks }}
                                                            negative
                                                        </span>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @else

                                <div class="empty-state">

                                    <div class="empty-icon">

                                        <svg
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M5 4h14v16H5z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M8 8h8M8 12h8M8 16h5"
                                            />
                                        </svg>

                                    </div>


                                    <h3 class="empty-title">
                                        Question Paper Not Built Yet
                                    </h3>


                                    <p class="empty-text">
                                        Add questions from the Question Bank
                                        and build the final question paper for this exam.
                                    </p>


                                    <a
                                        href="{{ url('/exams/' . $exam->id . '/question-paper') }}"
                                        class="exam-btn exam-btn-primary"
                                    >
                                        Build Question Paper
                                    </a>

                                </div>

                            @endif

                        </div>

                    </section>


                    {{-- SCHEDULE --}}
                    <section class="panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Exam Schedule
                                </h2>

                                <p class="panel-description">
                                    Access window configured for students.
                                </p>

                            </div>

                        </div>


                        <div class="schedule-grid">

                            <div class="schedule-box">

                                <div class="schedule-label">
                                    Starts At
                                </div>

                                @if($exam->starts_at)

                                    <div class="schedule-value">
                                        {{ $exam->starts_at->format('d M Y, h:i A') }}
                                    </div>

                                @else

                                    <div class="schedule-value schedule-empty">
                                        No fixed start time
                                    </div>

                                @endif

                            </div>


                            <div class="schedule-box">

                                <div class="schedule-label">
                                    Ends At
                                </div>

                                @if($exam->ends_at)

                                    <div class="schedule-value">
                                        {{ $exam->ends_at->format('d M Y, h:i A') }}
                                    </div>

                                @else

                                    <div class="schedule-value schedule-empty">
                                        No fixed end time
                                    </div>

                                @endif

                            </div>

                        </div>

                    </section>

                </div>


                {{-- =================================================
                     RIGHT COLUMN
                ================================================== --}}

                <div>

                    {{-- SCORING --}}
                    <section class="panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Scoring Rules
                                </h2>

                                <p class="panel-description">
                                    Evaluation configuration.
                                </p>

                            </div>

                        </div>


                        <div class="info-list">

                            <div class="info-row">

                                <span class="info-label">
                                    Passing Score
                                </span>

                                <span class="info-value">
                                    {{ $exam->passing_marks }} marks
                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Negative Marking
                                </span>

                                <span class="info-value">

                                    @if($exam->negative_marking)

                                        {{ $exam->negative_marks }} marks

                                    @else

                                        <span class="muted">
                                            Disabled
                                        </span>

                                    @endif

                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Attempt Limit
                                </span>

                                <span class="info-value">
                                    {{ $exam->attempt_limit }}
                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Exam Type
                                </span>

                                <span class="info-value">

                                    {{
                                        ucwords(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $exam->exam_type ?? 'regular'
                                            )
                                        )
                                    }}

                                </span>

                            </div>

                        </div>

                    </section>


                    {{-- PUBLISHING --}}
                    <section class="panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Publishing
                                </h2>

                                <p class="panel-description">
                                    Student visibility and exam state.
                                </p>

                            </div>

                        </div>


                        <div class="info-list">

                            <div class="info-row">

                                <span class="info-label">
                                    Visibility
                                </span>

                                <span class="info-value">

                                    @if($exam->is_published)

                                        Published

                                    @else

                                        <span class="muted">
                                            Draft
                                        </span>

                                    @endif

                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Status
                                </span>

                                <span class="info-value">

                                    @if($exam->is_active)
                                        Active
                                    @else
                                        <span class="muted">
                                            Inactive
                                        </span>
                                    @endif

                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Category
                                </span>

                                <span class="info-value">
                                    {{ $exam->category?->name ?? 'No Category' }}
                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Created
                                </span>

                                <span class="info-value">
                                    {{ $exam->created_at?->format('d M Y') }}
                                </span>

                            </div>

                        </div>

                    </section>


                    {{-- IDENTIFICATION --}}
                    <section class="panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Exam Information
                                </h2>

                                <p class="panel-description">
                                    Basic examination configuration.
                                </p>

                            </div>

                        </div>


                        <div class="info-list">

                            <div class="info-row">

                                <span class="info-label">
                                    Slug
                                </span>

                                <span class="info-value">
                                    {{ $exam->slug }}
                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Total Marks
                                </span>

                                <span class="info-value">
                                    {{ $exam->total_marks }}
                                </span>

                            </div>


                            <div class="info-row">

                                <span class="info-label">
                                    Duration
                                </span>

                                <span class="info-value">
                                    {{ $exam->duration_minutes }} minutes
                                </span>

                            </div>

                        </div>

                    </section>


                    {{-- DANGER --}}
                    <section class="panel danger-panel">

                        <div class="panel-header">

                            <div>

                                <h2 class="panel-title">
                                    Danger Zone
                                </h2>

                                <p class="panel-description">
                                    Permanent exam action.
                                </p>

                            </div>

                        </div>


                        <div class="danger-body">

                            <p class="danger-text">
                                Deleting this examination is permanent.
                                Make sure its assignments and results are no longer required.
                            </p>


                            <form
                                method="POST"
                                action="{{ route('exams.destroy', $exam) }}"
                                onsubmit="return confirm('Are you sure you want to permanently delete this exam?');"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="exam-btn exam-btn-danger"
                                >
                                    Delete Exam
                                </button>

                            </form>

                        </div>

                    </section>

                </div>

            </div>


            {{-- =================================================
                 FOOTER ACTIONS
            ================================================== --}}

            <div
                style="
                    display:flex;
                    align-items:center;
                    justify-content:space-between;
                    gap:12px;
                    margin-top:15px;
                    padding:14px;
                    border:1px solid rgba(255,255,255,.06);
                    border-radius:15px;
                    background:#121216;
                "
            >

                <a
                    href="{{ route('exams.index') }}"
                    class="exam-btn"
                >
                    ← Back to Exams
                </a>


                <div
                    style="
                        display:flex;
                        align-items:center;
                        gap:8px;
                    "
                >

                    <a
                        href="{{ url('/exams/' . $exam->id . '/results') }}"
                        class="exam-btn"
                    >
                        View Results
                    </a>


                    <a
                        href="{{ route('exams.edit', $exam) }}"
                        class="exam-btn exam-btn-primary"
                    >
                        Edit Exam
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-layouts::examination>