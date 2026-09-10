<x-layouts::examination :title="'Exams'">

    <style>
        .exams-page {
            min-height: 100vh;
            padding: 32px;
            max-width: 1500px;
            margin: 0 auto;
        }

        /* =====================================================
           HERO
        ===================================================== */

        .exams-hero {
            position: relative;
            overflow: hidden;

            padding: 30px;

            margin-bottom: 22px;

            border: 1px solid rgba(99, 102, 241, .22);
            border-radius: 20px;

            background:
                radial-gradient(
                    circle at 85% 10%,
                    rgba(99, 102, 241, .17),
                    transparent 330px
                ),
                radial-gradient(
                    circle at 5% 100%,
                    rgba(124, 58, 237, .09),
                    transparent 300px
                ),
                linear-gradient(
                    145deg,
                    #141419,
                    #101014
                );

            box-shadow:
                0 18px 50px rgba(0,0,0,.18);
        }

        .exams-hero::after {
            content: "";

            position: absolute;

            right: -100px;
            top: -130px;

            width: 280px;
            height: 280px;

            border: 1px solid rgba(129,140,248,.08);
            border-radius: 50%;

            pointer-events: none;
        }

        .exams-hero-content {
            position: relative;
            z-index: 1;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 9px;

            color: #818cf8;

            font-size: 10px;
            font-weight: 750;

            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .hero-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: #818cf8;

            box-shadow:
                0 0 12px rgba(129,140,248,.7);
        }

        .hero-title {
            margin: 0;

            color: #fafafa;

            font-size: clamp(28px, 3vw, 36px);
            font-weight: 800;

            letter-spacing: -.04em;
            line-height: 1.1;
        }

        .hero-subtitle {
            max-width: 720px;

            margin: 9px 0 0;

            color: #71717a;

            font-size: 13px;
            line-height: 1.65;
        }

        .create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            min-height: 42px;

            padding: 0 16px;

            flex-shrink: 0;

            border: 1px solid rgba(129,140,248,.30);
            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );

            color: #fff;

            text-decoration: none;

            font-size: 12px;
            font-weight: 700;

            box-shadow:
                0 10px 28px rgba(99,102,241,.20),
                inset 0 1px 0 rgba(255,255,255,.15);

            transition:
                transform .18s ease,
                box-shadow .18s ease;
        }

        .create-btn:hover {
            color: #fff;

            transform: translateY(-2px);

            box-shadow:
                0 14px 32px rgba(99,102,241,.27),
                inset 0 1px 0 rgba(255,255,255,.18);
        }

        .create-btn svg {
            width: 16px;
            height: 16px;
        }

        /* =====================================================
           STAT CARDS
        ===================================================== */

        .stats-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 13px;

            margin-bottom: 25px;
        }

        .stat-card {
            position: relative;

            min-height: 124px;

            padding: 19px;

            overflow: hidden;

            border: 1px solid #27272a;
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.018)
                );

            box-shadow:
                0 10px 30px rgba(0,0,0,.12);

            transition:
                transform .18s ease,
                border-color .18s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: #3f3f46;
        }

        .stat-card::after {
            content: "";

            position: absolute;

            width: 100px;
            height: 100px;

            right: -50px;
            top: -50px;

            border-radius: 50%;

            background: rgba(99,102,241,.06);
        }

        .stat-top {
            position: relative;
            z-index: 1;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-label {
            color: #71717a;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .stat-icon {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #303038;
            border-radius: 10px;

            background: rgba(99,102,241,.07);

            color: #a5b4fc;

            font-size: 13px;
            font-weight: 800;
        }

        .stat-value {
            position: relative;
            z-index: 1;

            margin-top: 15px;

            color: #fafafa;

            font-size: 28px;
            font-weight: 800;

            letter-spacing: -.035em;
        }

        .stat-value.green {
            color: #86efac;
        }

        .stat-value.yellow {
            color: #fde68a;
        }

        .stat-value.red {
            color: #fca5a5;
        }

        /* =====================================================
           TOOLBAR
        ===================================================== */

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 16px;

            padding: 16px 18px;

            margin-bottom: 13px;

            border: 1px solid #27272a;
            border-radius: 14px;

            background: rgba(255,255,255,.018);
        }

        .toolbar-title {
            color: #f4f4f5;

            font-size: 13px;
            font-weight: 700;
        }

        .toolbar-subtitle {
            margin-top: 3px;

            color: #52525b;

            font-size: 10px;
        }

        .toolbar-count {
            display: inline-flex;
            align-items: center;

            min-height: 28px;

            padding: 0 10px;

            border: 1px solid #303038;
            border-radius: 999px;

            background: rgba(255,255,255,.025);

            color: #a1a1aa;

            font-size: 10px;
            font-weight: 650;
        }

        /* =====================================================
           EXAM LIST
        ===================================================== */

        .exam-list {
            display: flex;
            flex-direction: column;

            gap: 11px;
        }

        .exam-card {
            position: relative;

            overflow: hidden;

            padding: 20px;

            border: 1px solid #27272a;
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.035),
                    rgba(255,255,255,.012)
                );

            transition:
                transform .18s ease,
                border-color .18s ease,
                background .18s ease;
        }

        .exam-card:hover {
            transform: translateY(-1px);

            border-color: rgba(99,102,241,.30);

            background:
                linear-gradient(
                    145deg,
                    rgba(99,102,241,.055),
                    rgba(255,255,255,.015)
                );
        }

        .exam-card-main {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 22px;
        }

        .exam-info {
            flex: 1;
            min-width: 0;
        }

        .exam-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 6px;

            margin-bottom: 9px;
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            min-height: 24px;

            padding: 0 8px;

            border: 1px solid #303038;
            border-radius: 999px;

            background: #17171d;

            color: #a1a1aa;

            font-size: 9px;
            font-weight: 700;
        }

        .pill-category {
            border-color: rgba(99,102,241,.23);
            background: rgba(99,102,241,.08);

            color: #a5b4fc;
        }

        .pill-published {
            border-color: rgba(34,197,94,.18);
            background: rgba(34,197,94,.07);

            color: #86efac;
        }

        .pill-draft {
            border-color: rgba(234,179,8,.18);
            background: rgba(234,179,8,.07);

            color: #fde68a;
        }

        .pill-inactive {
            border-color: rgba(239,68,68,.18);
            background: rgba(239,68,68,.07);

            color: #fca5a5;
        }

        .pill-type {
            border-color: #303038;
            background: rgba(255,255,255,.02);

            color: #a1a1aa;
        }

        .exam-name {
            margin: 0;

            color: #f4f4f5;

            font-size: 16px;
            font-weight: 750;

            letter-spacing: -.015em;

            line-height: 1.35;
        }

        .exam-description {
            max-width: 850px;

            margin-top: 6px;

            color: #71717a;

            font-size: 11px;
            line-height: 1.6;
        }

        .exam-metrics {
            display: flex;
            flex-wrap: wrap;

            gap: 7px;

            margin-top: 14px;
        }

        .metric {
            display: inline-flex;
            align-items: center;

            min-height: 30px;

            padding: 0 10px;

            border: 1px solid #292930;
            border-radius: 9px;

            background: #151519;

            color: #71717a;

            font-size: 10px;
        }

        .metric strong {
            margin-right: 3px;

            color: #e4e4e7;

            font-weight: 700;
        }

        .exam-actions {
            display: flex;
            align-items: center;

            gap: 7px;

            flex-shrink: 0;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;

            min-height: 36px;

            padding: 0 12px;

            border: 1px solid #303038;
            border-radius: 9px;

            background: rgba(255,255,255,.025);

            color: #a1a1aa;

            text-decoration: none;

            font-size: 10px;
            font-weight: 650;

            transition:
                background .18s ease,
                border-color .18s ease,
                color .18s ease,
                transform .18s ease;
        }

        .action-btn:hover {
            color: #fff;

            border-color: #4f46a5;

            background: rgba(99,102,241,.09);
        }

        .action-btn.primary {
            color: #fff;

            border-color: rgba(99,102,241,.25);

            background:
                linear-gradient(
                    135deg,
                    #6366f1,
                    #7c3aed
                );

            box-shadow:
                0 6px 16px rgba(99,102,241,.15);
        }

        .action-btn.primary:hover {
            border-color: transparent;

            background:
                linear-gradient(
                    135deg,
                    #7073f5,
                    #8658f2
                );

            transform: translateY(-1px);
        }

        .action-btn svg {
            width: 13px;
            height: 13px;
        }

        /* =====================================================
           EMPTY STATE
        ===================================================== */

        .empty-state {
            padding: 65px 25px;

            text-align: center;

            border: 1px dashed #303038;
            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.025),
                    rgba(255,255,255,.01)
                );
        }

        .empty-icon {
            width: 58px;
            height: 58px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 15px;

            border: 1px solid rgba(99,102,241,.20);
            border-radius: 16px;

            background: rgba(99,102,241,.07);

            color: #a5b4fc;
        }

        .empty-icon svg {
            width: 24px;
            height: 24px;
        }

        .empty-title {
            color: #f4f4f5;

            font-size: 16px;
            font-weight: 750;
        }

        .empty-text {
            max-width: 480px;

            margin: 6px auto 20px;

            color: #71717a;

            font-size: 11px;
            line-height: 1.6;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {
            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 760px) {
            .exams-page {
                padding: 22px 16px 35px;
            }

            .exams-hero {
                padding: 23px;
            }

            .exams-hero-content {
                align-items: flex-start;
                flex-direction: column;
            }

            .create-btn {
                width: 100%;
            }

            .exam-card-main {
                flex-direction: column;
            }

            .exam-actions {
                width: 100%;
            }

            .action-btn {
                flex: 1;
            }
        }

        @media (max-width: 520px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .toolbar-count {
                align-self: flex-start;
            }

            .exam-actions {
                flex-wrap: wrap;
            }
        }
    </style>


    @php
        $totalExams = $exams->count();

        $publishedExams = $exams
            ->where('is_published', true)
            ->count();

        $draftExams = $exams
            ->where('is_published', false)
            ->count();

        $activeExams = $exams
            ->where('is_active', true)
            ->count();
    @endphp


    <div class="exams-page">

        {{-- =====================================================
             HERO
        ====================================================== --}}

        <section class="exams-hero">

            <div class="exams-hero-content">

                <div>

                    <div class="hero-eyebrow">
                        <span class="hero-dot"></span>
                        Examination Management
                    </div>

                    <h1 class="hero-title">
                        Exams
                    </h1>

                    <p class="hero-subtitle">
                        Create, configure and manage your online
                        examinations using the reusable Question Bank.
                    </p>

                </div>


                <a
                    href="{{ route('exams.create') }}"
                    class="create-btn"
                >

                    <svg
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Create Exam

                </a>

            </div>

        </section>


        {{-- =====================================================
             STATISTICS
        ====================================================== --}}

        <section class="stats-grid">

            {{-- Total --}}
            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Exams
                    </div>

                    <div class="stat-icon">
                        E
                    </div>

                </div>

                <div class="stat-value">
                    {{ $totalExams }}
                </div>

            </div>


            {{-- Published --}}
            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Published
                    </div>

                    <div class="stat-icon">
                        ✓
                    </div>

                </div>

                <div class="stat-value green">
                    {{ $publishedExams }}
                </div>

            </div>


            {{-- Draft --}}
            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Drafts
                    </div>

                    <div class="stat-icon">
                        D
                    </div>

                </div>

                <div class="stat-value yellow">
                    {{ $draftExams }}
                </div>

            </div>


            {{-- Active --}}
            <div class="stat-card">

                <div class="stat-top">

                    <div class="stat-label">
                        Active Exams
                    </div>

                    <div class="stat-icon">
                        ●
                    </div>

                </div>

                <div class="stat-value">
                    {{ $activeExams }}
                </div>

            </div>

        </section>


        {{-- =====================================================
             TOOLBAR
        ====================================================== --}}

        <div class="toolbar">

            <div>

                <div class="toolbar-title">
                    All Examinations
                </div>

                <div class="toolbar-subtitle">
                    Manage tests, assessment sets and online examinations.
                </div>

            </div>


            <div class="toolbar-count">
                {{ $totalExams }}
                {{ $totalExams === 1 ? 'Exam' : 'Exams' }}
            </div>

        </div>


        {{-- =====================================================
             EXAM LIST
        ====================================================== --}}

        @if($exams->count())

            <div class="exam-list">

                @foreach($exams as $exam)

                    <article class="exam-card">

                        <div class="exam-card-main">

                            <div class="exam-info">

                                {{-- Status / Category / Type --}}
                                <div class="exam-meta">

                                    @if($exam->category)

                                        <span class="pill pill-category">
                                            {{ $exam->category->name }}
                                        </span>

                                    @endif


                                    @if($exam->exam_type)

                                        <span class="pill pill-type">
                                            {{ ucwords(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $exam->exam_type
                                                )
                                            ) }}
                                        </span>

                                    @endif


                                    @if($exam->is_published)

                                        <span class="pill pill-published">
                                            <span>●</span>
                                            Published
                                        </span>

                                    @else

                                        <span class="pill pill-draft">
                                            <span>●</span>
                                            Draft
                                        </span>

                                    @endif


                                    @if(!$exam->is_active)

                                        <span class="pill pill-inactive">
                                            Inactive
                                        </span>

                                    @endif

                                </div>


                                {{-- Title --}}
                                <h2 class="exam-name">
                                    {{ $exam->title }}
                                </h2>


                                {{-- Description --}}
                                @if($exam->description)

                                    <div class="exam-description">
                                        {{ $exam->description }}
                                    </div>

                                @endif


                                {{-- Metrics --}}
                                <div class="exam-metrics">

                                    <div class="metric">
                                        <strong>
                                            {{ $exam->duration_minutes }}
                                        </strong>
                                        min
                                    </div>


                                    <div class="metric">
                                        <strong>
                                            {{ $exam->total_marks }}
                                        </strong>
                                        marks
                                    </div>


                                    <div class="metric">
                                        <strong>
                                            {{ $exam->passing_marks }}
                                        </strong>
                                        pass marks
                                    </div>


                                    <div class="metric">
                                        <strong>
                                            {{ $exam->questions_count ?? ($exam->questions?->count() ?? 0) }}
                                        </strong>
                                        questions
                                    </div>


                                    @if($exam->attempt_limit > 0)

                                        <div class="metric">
                                            <strong>
                                                {{ $exam->attempt_limit }}
                                            </strong>
                                            attempt{{ $exam->attempt_limit == 1 ? '' : 's' }}
                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="exam-actions">

                                <a
                                    href="{{ route('exams.show', $exam) }}"
                                    class="action-btn primary"
                                >

                                    View

                                    <svg
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M5 12h14M13 6l6 6-6 6"
                                        />
                                    </svg>

                                </a>


                                <a
                                    href="{{ route('exams.edit', $exam) }}"
                                    class="action-btn"
                                >

                                    Edit

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- =================================================
                 EMPTY
            ================================================== --}}

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
                            d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M9 8h6M9 12h6M9 16h4"
                        />
                    </svg>

                </div>


                <div class="empty-title">
                    No examinations created yet
                </div>


                <div class="empty-text">
                    Create your first examination and start building
                    it with questions from your reusable Question Bank.
                </div>


                <a
                    href="{{ route('exams.create') }}"
                    class="create-btn"
                >

                    <svg
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Create First Exam

                </a>

            </div>

        @endif

    </div>

</x-layouts::examination>