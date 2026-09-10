<x-layouts::examination :title="'Examination Dashboard'">

    <style>
        .dashboard-page {
            min-height: 100vh;
            padding: 32px;
            background:
                radial-gradient(
                    circle at 82% 0%,
                    rgba(99, 102, 241, 0.10),
                    transparent 360px
                ),
                #09090b;
        }

        /* =====================================================
           TOP HEADER
        ===================================================== */

        .dashboard-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 28px;
        }

        .dashboard-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 10px;

            color: #818cf8;

            font-size: 11px;
            font-weight: 750;

            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .dashboard-eyebrow-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #818cf8;

            box-shadow:
                0 0 12px rgba(129, 140, 248, .7);
        }

        .dashboard-title {
            margin: 0;

            color: #fafafa;

            font-size: clamp(27px, 3vw, 36px);
            font-weight: 800;

            letter-spacing: -.035em;
            line-height: 1.1;
        }

        .dashboard-description {
            max-width: 700px;

            margin: 10px 0 0;

            color: #71717a;

            font-size: 14px;
            line-height: 1.65;
        }

        .dashboard-primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 9px;

            flex-shrink: 0;

            min-height: 42px;

            padding: 0 16px;

            border: 1px solid rgba(129, 140, 248, .35);
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
                0 10px 25px rgba(99, 102, 241, .18),
                inset 0 1px 0 rgba(255,255,255,.15);

            transition:
                transform .18s ease,
                box-shadow .18s ease;
        }

        .dashboard-primary-btn:hover {
            color: #fff;

            transform: translateY(-1px);

            box-shadow:
                0 14px 30px rgba(99, 102, 241, .25),
                inset 0 1px 0 rgba(255,255,255,.18);
        }

        .dashboard-primary-icon {
            width: 16px;
            height: 16px;
        }

        /* =====================================================
           STATISTICS
        ===================================================== */

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));

            gap: 14px;

            margin-bottom: 30px;
        }

        .dashboard-stat {
            position: relative;

            min-height: 128px;

            padding: 20px;

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
                0 12px 35px rgba(0,0,0,.13);

            transition:
                transform .18s ease,
                border-color .18s ease;
        }

        .dashboard-stat:hover {
            transform: translateY(-2px);

            border-color: #3f3f46;
        }

        .dashboard-stat::after {
            content: "";

            position: absolute;

            width: 120px;
            height: 120px;

            right: -55px;
            top: -55px;

            border-radius: 50%;

            background: rgba(99,102,241,.08);

            filter: blur(2px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 15px;
        }

        .stat-label {
            color: #71717a;

            font-size: 11px;
            font-weight: 650;

            text-transform: uppercase;
            letter-spacing: .06em;
        }

        .stat-icon {
            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #27272a;
            border-radius: 10px;

            background: rgba(255,255,255,.025);

            color: #a5b4fc;
        }

        .stat-icon svg {
            width: 17px;
            height: 17px;
        }

        .stat-value {
            color: #fafafa;

            font-size: 29px;
            font-weight: 800;

            letter-spacing: -.03em;
            line-height: 1;
        }

        /* =====================================================
           SECTION HEADER
        ===================================================== */

        .dashboard-section {
            margin-bottom: 28px;
        }

        .section-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 16px;

            margin-bottom: 14px;
        }

        .section-title {
            margin: 0;

            color: #f4f4f5;

            font-size: 16px;
            font-weight: 750;

            letter-spacing: -.015em;
        }

        .section-link {
            color: #818cf8;

            text-decoration: none;

            font-size: 11px;
            font-weight: 650;
        }

        .section-link:hover {
            color: #a5b4fc;
        }

        /* =====================================================
           QUICK ACTIONS
        ===================================================== */

        .dashboard-actions {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));

            gap: 14px;
        }

        .action-card {
            position: relative;

            min-height: 150px;

            display: flex;
            flex-direction: column;

            padding: 19px;

            border: 1px solid #27272a;
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.04),
                    rgba(255,255,255,.015)
                );

            color: #fafafa;

            text-decoration: none;

            overflow: hidden;

            transition:
                transform .18s ease,
                border-color .18s ease,
                background .18s ease;
        }

        .action-card:hover {
            color: #fff;

            transform: translateY(-3px);

            border-color: rgba(99,102,241,.35);

            background:
                linear-gradient(
                    145deg,
                    rgba(99,102,241,.09),
                    rgba(255,255,255,.02)
                );
        }

        .action-icon {
            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 17px;

            border: 1px solid #303038;
            border-radius: 11px;

            background: rgba(99,102,241,.08);

            color: #a5b4fc;
        }

        .action-icon svg {
            width: 18px;
            height: 18px;
        }

        .action-title {
            margin-bottom: 6px;

            color: #f4f4f5;

            font-size: 13px;
            font-weight: 700;
        }

        .action-description {
            color: #71717a;

            font-size: 11px;
            line-height: 1.55;
        }

        .action-arrow {
            position: absolute;

            right: 17px;
            bottom: 17px;

            color: #52525b;

            transition:
                color .18s ease,
                transform .18s ease;
        }

        .action-card:hover .action-arrow {
            color: #a5b4fc;
            transform: translateX(2px);
        }

        .action-arrow svg {
            width: 15px;
            height: 15px;
        }

        /* =====================================================
           RECENT EXAMS
        ===================================================== */

        .recent-card {
            overflow: hidden;

            border: 1px solid #27272a;
            border-radius: 16px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.035),
                    rgba(255,255,255,.015)
                );

            box-shadow:
                0 12px 35px rgba(0,0,0,.12);
        }

        .recent-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 17px 19px;

            border-bottom: 1px solid #27272a;
        }

        .recent-card-title {
            margin: 0;

            color: #f4f4f5;

            font-size: 13px;
            font-weight: 700;
        }

        .recent-card-subtitle {
            margin-top: 3px;

            color: #52525b;

            font-size: 10px;
        }

        .exam-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            padding: 17px 19px;

            border-bottom: 1px solid #1f1f23;

            transition:
                background .18s ease;
        }

        .exam-row:last-child {
            border-bottom: 0;
        }

        .exam-row:hover {
            background: rgba(255,255,255,.018);
        }

        .exam-info {
            min-width: 0;
        }

        .exam-name {
            margin-bottom: 5px;

            color: #f4f4f5;

            font-size: 13px;
            font-weight: 700;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .exam-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;

            gap: 6px 9px;

            color: #71717a;

            font-size: 10px;
        }

        .exam-meta-dot {
            color: #3f3f46;
        }

        .exam-actions {
            display: flex;
            align-items: center;

            gap: 9px;

            flex-shrink: 0;
        }

        .exam-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            min-height: 27px;

            padding: 0 9px;

            border: 1px solid rgba(34,197,94,.18);
            border-radius: 999px;

            background: rgba(34,197,94,.07);

            color: #86efac;

            font-size: 9px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .exam-status.draft {
            border-color: rgba(234,179,8,.18);
            background: rgba(234,179,8,.07);
            color: #fde68a;
        }

        .status-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: currentColor;
        }

        .manage-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            min-height: 32px;

            padding: 0 11px;

            border: 1px solid #303038;
            border-radius: 9px;

            background: rgba(255,255,255,.025);

            color: #d4d4d8;

            text-decoration: none;

            font-size: 10px;
            font-weight: 650;

            transition:
                background .18s ease,
                border-color .18s ease,
                color .18s ease;
        }

        .manage-btn:hover {
            color: #fff;

            background: rgba(99,102,241,.10);

            border-color: rgba(99,102,241,.28);
        }

        .manage-btn svg {
            width: 13px;
            height: 13px;
        }

        .empty-state {
            padding: 45px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 44px;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 12px;

            border: 1px solid #27272a;
            border-radius: 13px;

            background: rgba(255,255,255,.02);

            color: #52525b;
        }

        .empty-icon svg {
            width: 20px;
            height: 20px;
        }

        .empty-title {
            margin-bottom: 5px;

            color: #a1a1aa;

            font-size: 12px;
            font-weight: 650;
        }

        .empty-text {
            color: #52525b;

            font-size: 10px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-actions {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .dashboard-page {
                padding: 22px 18px;
            }

            .dashboard-header {
                flex-direction: column;
            }

            .dashboard-primary-btn {
                width: 100%;
                justify-content: center;
            }

            .dashboard-stats,
            .dashboard-actions {
                grid-template-columns: 1fr;
            }

            .exam-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .exam-actions {
                width: 100%;
            }

            .manage-btn {
                flex: 1;
                justify-content: center;
            }
        }

        @media (max-width: 420px) {
            .dashboard-page {
                padding: 18px 14px;
            }

            .dashboard-title {
                font-size: 26px;
            }

            .exam-actions {
                flex-wrap: wrap;
            }
        }
    </style>


    <div class="dashboard-page">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="dashboard-header">

            <div>

                <div class="dashboard-eyebrow">
                    <span class="dashboard-eyebrow-dot"></span>
                    Examination Management
                </div>

                <h1 class="dashboard-title">
                    Online Examination
                </h1>

                <p class="dashboard-description">
                    Manage examinations, question banks, subjects,
                    assignments and student assessments from one
                    centralized workspace.
                </p>

            </div>


                       <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;justify-content:flex-end;">

                <a
                    href="{{ route('external-exam-students.index') }}"
                    class="dashboard-primary-btn"
                    style="background:transparent;border:1px solid #27272a;box-shadow:none;"
                >
                    <svg
                        class="dashboard-primary-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />
                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                            stroke-width="1.8"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M19 8v6M22 11h-6"
                        />
                    </svg>

                    External Students
                </a>

                <a
                    href="{{ route('exams.create') }}"
                    class="dashboard-primary-btn"
                >
                    <svg
                        class="dashboard-primary-icon"
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

                    Create New Exam
                </a>

            </div>

        </div>


        {{-- =====================================================
             STATISTICS
        ====================================================== --}}

        <div class="dashboard-stats">

            {{-- Total Exams --}}
            <div class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-label">
                        Total Exams
                    </div>

                    <div class="stat-icon">
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
                                d="M8 7h8M8 11h8M8 15h5"
                            />
                        </svg>
                    </div>

                </div>

                <div class="stat-value">
                    {{ $totalExams }}
                </div>

            </div>


            {{-- Active Exams --}}
            <div class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-label">
                        Active Exams
                    </div>

                    <div class="stat-icon">
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>
                    </div>

                </div>

                <div class="stat-value">
                    {{ $activeExams }}
                </div>

            </div>


            {{-- Categories --}}
            <div class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-label">
                        Categories
                    </div>

                    <div class="stat-icon">
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M3 7h6l2 2h10v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"
                            />
                        </svg>
                    </div>

                </div>

                <div class="stat-value">
                    {{ $totalCategories }}
                </div>

            </div>


            {{-- Subjects --}}
            <div class="dashboard-stat">

                <div class="stat-top">

                    <div class="stat-label">
                        Subjects
                    </div>

                    <div class="stat-icon">
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M8 8h8M8 12h8M8 16h5"
                            />
                        </svg>
                    </div>

                </div>

                <div class="stat-value">
                    {{ $totalSubjects }}
                </div>

            </div>

        </div>


        {{-- =====================================================
             QUICK ACTIONS
        ====================================================== --}}

        <section class="dashboard-section">

            <div class="section-heading">

                <h2 class="section-title">
                    Quick Actions
                </h2>

            </div>


            <div class="dashboard-actions">

                {{-- Create Exam --}}
                <a
                    href="{{ route('exams.create') }}"
                    class="action-card"
                >

                    <div class="action-icon">
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
                    </div>

                    <div class="action-title">
                        Create Exam
                    </div>

                    <div class="action-description">
                        Configure a new examination with
                        timing, marks and publishing settings.
                    </div>

                    <span class="action-arrow">
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
                    </span>

                </a>


                {{-- Question Bank --}}
                <a
                    href="{{ route('question-bank.index') }}"
                    class="action-card"
                >

                    <div class="action-icon">
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M4 5a2 2 0 012-2h11a3 3 0 013 3v13a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M8 7h8M8 11h6M8 15h5"
                            />
                        </svg>
                    </div>

                    <div class="action-title">
                        Question Bank
                    </div>

                    <div class="action-description">
                        Create, organize and manage reusable
                        examination questions.
                    </div>

                    <span class="action-arrow">
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
                    </span>

                </a>


                {{-- Subjects --}}
                <a
                    href="{{ route('exam-subjects.index') }}"
                    class="action-card"
                >

                    <div class="action-icon">
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M8 8h8M8 12h8M8 16h5"
                            />
                        </svg>
                    </div>

                    <div class="action-title">
                        Subjects & Topics
                    </div>

                    <div class="action-description">
                        Organize examination content into
                        subjects and topic-wise question banks.
                    </div>

                    <span class="action-arrow">
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
                    </span>

                </a>


                {{-- Assignments --}}
                @if(Route::has('exams.assignments.index'))

                    <a
                        href="{{ route('exams.assignments.index') }}"
                        class="action-card"
                    >

                        <div class="action-icon">
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
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M3 6h.01M3 12h.01M3 18h.01"
                                />
                            </svg>
                        </div>

                        <div class="action-title">
                            Assignments
                        </div>

                        <div class="action-description">
                            Assign examinations to selected
                            students and manage access.
                        </div>

                        <span class="action-arrow">
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
                        </span>

                    </a>

                @else

                    <a
                        href="{{ route('exams.index') }}"
                        class="action-card"
                    >

                        <div class="action-icon">
                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 12l2 2 4-4"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 4h14v16H5z"
                                />
                            </svg>
                        </div>

                        <div class="action-title">
                            Manage Exams
                        </div>

                        <div class="action-description">
                            View, edit and manage all examinations.
                        </div>

                        <span class="action-arrow">
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
                        </span>

                    </a>

                @endif

            </div>

        </section>


        {{-- =====================================================
             RECENT EXAMS
        ====================================================== --}}

        <section class="dashboard-section">

            <div class="section-heading">

                <div>
                    <h2 class="section-title">
                        Recent Examinations
                    </h2>
                </div>

                <a
                    href="{{ route('exams.index') }}"
                    class="section-link"
                >
                    View all exams
                </a>

            </div>


            <div class="recent-card">

                <div class="recent-card-header">

                    <div>
                        <div class="recent-card-title">
                            Latest Exams
                        </div>

                        <div class="recent-card-subtitle">
                            Recently created examinations
                        </div>
                    </div>

                </div>


                @forelse($recentExams as $exam)

                    <div class="exam-row">

                        <div class="exam-info">

                            <div class="exam-name">
                                {{ $exam->title }}
                            </div>

                            <div class="exam-meta">

                                <span>
                                    {{ $exam->category?->name ?? 'No Category' }}
                                </span>

                                <span class="exam-meta-dot">
                                    •
                                </span>

                                <span>
                                    {{ $exam->duration_minutes }} min
                                </span>

                                <span class="exam-meta-dot">
                                    •
                                </span>

                                <span>
                                    {{ $exam->total_marks }} marks
                                </span>

                                @if($exam->exam_type)
                                    <span class="exam-meta-dot">
                                        •
                                    </span>

                                    <span>
                                        {{ ucwords(str_replace('_', ' ', $exam->exam_type)) }}
                                    </span>
                                @endif

                            </div>

                        </div>


                        <div class="exam-actions">

                            @if($exam->is_active && $exam->is_published)

                                <span class="exam-status">
                                    <span class="status-dot"></span>
                                    Published
                                </span>

                            @else

                                <span class="exam-status draft">
                                    <span class="status-dot"></span>
                                    Draft
                                </span>

                            @endif


                            <a
                                href="{{ route('exams.show', $exam) }}"
                                class="manage-btn"
                            >

                                Manage

                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M5 12h14M13 6l6 6-6 6"
                                    />
                                </svg>

                            </a>

                        </div>

                    </div>

                @empty

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
                            </svg>
                        </div>

                        <div class="empty-title">
                            No examinations yet
                        </div>

                        <div class="empty-text">
                            Create your first examination to get started.
                        </div>

                    </div>

                @endforelse

            </div>

        </section>

    </div>

</x-layouts::examination>