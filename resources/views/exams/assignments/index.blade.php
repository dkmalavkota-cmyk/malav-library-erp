<x-layouts::examination :title="'Assignments - ' . $exam->title">

    <style>
        .assign-page {
            min-height: 100vh;
            padding: 30px;
            background:
                radial-gradient(circle at 85% 0%, rgba(99,102,241,.08), transparent 360px),
                #09090b;
            color: #f4f4f5;
        }

        .assign-container {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
        }

        /* HEADER */
        .assign-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 9px;
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

        .heading-row {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .heading-icon {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(99,102,241,.22);
            border-radius: 14px;
            background: rgba(99,102,241,.08);
            color: #a5b4fc;
        }

        .heading-icon svg {
            width: 22px;
            height: 22px;
        }

        .page-title {
            margin: 0;
            color: #fafafa;
            font-size: clamp(25px, 3vw, 33px);
            font-weight: 800;
            letter-spacing: -.035em;
            line-height: 1.1;
        }

        .page-subtitle {
            margin: 6px 0 0;
            color: #71717a;
            font-size: 11px;
        }

        /* BUTTON */
        .assign-btn {
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
            cursor: pointer;
            transition: .18s ease;
        }

        .assign-btn:hover {
            color: #fff !important;
            background: rgba(255,255,255,.05);
            border-color: #454550;
            transform: translateY(-1px);
        }

        .assign-btn-primary {
            border-color: rgba(99,102,241,.35);
            background: linear-gradient(135deg,#6366f1,#7c3aed);
            color: #fff !important;
            box-shadow: 0 8px 22px rgba(99,102,241,.16);
        }

        .assign-btn-primary:hover {
            background: linear-gradient(135deg,#7376f5,#8b5cf6);
        }

        .assign-btn-danger {
            border-color: rgba(239,68,68,.18);
            background: rgba(239,68,68,.05);
            color: #fca5a5 !important;
        }

        .assign-btn-danger:hover {
            background: rgba(239,68,68,.10);
            border-color: rgba(239,68,68,.32);
        }

        .assign-btn:disabled {
            opacity: .35;
            cursor: not-allowed;
            transform: none;
        }

        /* ALERTS */
        .alert {
            margin-bottom: 14px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 10px;
        }

        .alert-success {
            border: 1px solid rgba(34,197,94,.17);
            background: rgba(34,197,94,.055);
            color: #86efac;
        }

        .alert-error {
            border: 1px solid rgba(239,68,68,.17);
            background: rgba(239,68,68,.055);
            color: #fca5a5;
        }

        .alert-title {
            margin-bottom: 4px;
            font-weight: 750;
        }

        .alert ul {
            margin: 5px 0 0;
            padding-left: 17px;
        }

        .alert li {
            margin: 2px 0;
        }

        /* EXAM SUMMARY */
        .exam-summary {
            display: grid;
            grid-template-columns: repeat(4,minmax(0,1fr));
            gap: 9px;
            margin-bottom: 15px;
        }

        .summary-card {
            min-height: 82px;
            padding: 14px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 13px;
            background: #121216;
        }

        .summary-label {
            color: #62626c;
            font-size: 9px;
        }

        .summary-value {
            margin-top: 7px;
            color: #ededf0;
            font-size: 16px;
            font-weight: 750;
            letter-spacing: -.02em;
        }

        .summary-value span {
            color: #666670;
            font-size: 9px;
            font-weight: 600;
        }

        /* PANEL */
        .panel {
            overflow: hidden;
            margin-bottom: 15px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 16px;
            background: #121216;
            box-shadow: 0 14px 40px rgba(0,0,0,.10);
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

        .count-badge {
            display: inline-flex;
            align-items: center;
            min-height: 27px;
            padding: 0 9px;
            border: 1px solid rgba(99,102,241,.17);
            border-radius: 8px;
            background: rgba(99,102,241,.06);
            color: #a5b4fc;
            font-size: 9px;
            font-weight: 700;
        }

        .panel-body {
            padding: 16px;
        }

        /* SEARCH BAR */
        .toolbar {
            display: flex;
            align-items: flex-end;
            gap: 10px;
            margin-bottom: 13px;
        }

        .search-wrap {
            position: relative;
            flex: 1;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            bottom: 12px;
            width: 14px;
            height: 14px;
            color: #52525b;
            pointer-events: none;
        }

        .search-input {
            width: 100%;
            height: 39px;
            padding: 0 12px 0 35px;
            border: 1px solid #2d2d34;
            border-radius: 10px;
            outline: none;
            background: #0d0d10;
            color: #e4e4e7;
            font-size: 10px;
            box-sizing: border-box;
        }

        .search-input::placeholder {
            color: #52525b;
        }

        .search-input:focus {
            border-color: rgba(99,102,241,.55);
            box-shadow: 0 0 0 3px rgba(99,102,241,.07);
        }

        .select-all {
            height: 39px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 12px;
            border: 1px solid #2d2d34;
            border-radius: 10px;
            background: #0d0d10;
            color: #a1a1aa;
            font-size: 10px;
            font-weight: 650;
            cursor: pointer;
        }

        .select-all input,
        .student-checkbox {
            width: 15px;
            height: 15px;
            accent-color: #6366f1;
            cursor: pointer;
        }

        /* TABLE */
        .table-wrap {
            overflow-x: auto;
            border: 1px solid rgba(255,255,255,.045);
            border-radius: 12px;
        }

        .student-table {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
        }

        .student-table th {
            padding: 11px 13px;
            border-bottom: 1px solid rgba(255,255,255,.055);
            background: rgba(255,255,255,.018);
            color: #62626c;
            font-size: 8px;
            font-weight: 700;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .student-table td {
            padding: 12px 13px;
            border-bottom: 1px solid rgba(255,255,255,.04);
            color: #a1a1aa;
            font-size: 9px;
            vertical-align: middle;
        }

        .student-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .student-table tbody tr {
            transition: background .15s ease;
        }

        .student-table tbody tr:hover {
            background: rgba(99,102,241,.035);
        }

        .student-name {
            color: #d4d4d8;
            font-size: 10px;
            font-weight: 680;
        }

        .student-email {
            margin-top: 3px;
            color: #55555f;
            font-size: 8px;
        }

        .student-code {
            color: #a5b4fc;
            font-weight: 650;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-height: 23px;
            padding: 0 8px;
            border: 1px solid rgba(34,197,94,.16);
            border-radius: 7px;
            background: rgba(34,197,94,.05);
            color: #86efac;
            font-size: 8px;
            font-weight: 700;
        }

        .status-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: currentColor;
        }

        /* BOTTOM BAR */
        .assign-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 13px;
            padding: 12px;
            border: 1px solid rgba(255,255,255,.045);
            border-radius: 11px;
            background: rgba(0,0,0,.12);
        }

        .selected-text {
            color: #666670;
            font-size: 9px;
        }

        .selected-number {
            color: #a5b4fc;
            font-weight: 750;
        }

        /* EMPTY */
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
            border: 1px solid rgba(99,102,241,.16);
            border-radius: 14px;
            background: rgba(99,102,241,.055);
            color: #a5b4fc;
        }

        .empty-icon svg {
            width: 23px;
            height: 23px;
        }

        .empty-title {
            margin: 0;
            color: #e4e4e7;
            font-size: 13px;
            font-weight: 700;
        }

        .empty-text {
            max-width: 430px;
            margin: 6px auto 0;
            color: #60606a;
            font-size: 9px;
            line-height: 1.65;
        }

        .remove-btn {
            min-height: 28px;
            padding: 0 9px;
            border: 1px solid rgba(239,68,68,.16);
            border-radius: 7px;
            background: rgba(239,68,68,.045);
            color: #fca5a5;
            font-size: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        .remove-btn:hover {
            background: rgba(239,68,68,.09);
            border-color: rgba(239,68,68,.30);
        }

        /* MOBILE */
        @media (max-width: 900px) {
            .assign-page {
                padding: 24px 20px 35px;
            }

            .exam-summary {
                grid-template-columns: repeat(2,minmax(0,1fr));
            }
        }

        @media (max-width: 650px) {
            .assign-page {
                padding: 18px 14px 30px;
            }

            .assign-header {
                align-items: stretch;
                flex-direction: column;
            }

            .assign-header > .assign-btn {
                width: 100%;
            }

            .toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .select-all {
                justify-content: center;
            }

            .assign-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .assign-footer .assign-btn {
                width: 100%;
            }

            .exam-summary {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 430px) {
            .exam-summary {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 24px;
            }
        }
    </style>


    <div class="assign-page">

        <div class="assign-container">

            {{-- =================================================
                 HEADER
            ================================================== --}}

            <div class="assign-header">

                <div>

                    <div class="breadcrumb">

                        <a href="{{ route('exams.index') }}">
                            Exams
                        </a>

                        <span>/</span>

                        <a href="{{ route('exams.show', $exam) }}">
                            {{ $exam->title }}
                        </a>

                        <span>/</span>

                        <span>
                            Assignments
                        </span>

                    </div>


                    <div class="heading-row">

                        <div class="heading-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                />

                                <circle
                                    cx="9"
                                    cy="7"
                                    r="4"
                                    stroke-width="1.7"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                />
                            </svg>

                        </div>


                        <div>

                            <h1 class="page-title">
                                Assignments
                            </h1>

                            <p class="page-subtitle">
                                Control which students can access this examination.
                            </p>

                        </div>

                    </div>

                </div>


                <a
                    href="{{ route('exams.show', $exam) }}"
                    class="assign-btn"
                >
                    ← Back to Exam
                </a>

            </div>


            {{-- =================================================
                 ALERTS
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <div class="alert-title">
                        Assignment Updated
                    </div>

                    <div>
                        {{ session('success') }}
                    </div>

                </div>

            @endif


            @if($errors->any())

                <div class="alert alert-error">

                    <div class="alert-title">
                        Please fix the following:
                    </div>

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =================================================
                 EXAM SUMMARY
            ================================================== --}}

            <div class="exam-summary">

                <div class="summary-card">

                    <div class="summary-label">
                        Examination
                    </div>

                    <div class="summary-value">
                        {{ $exam->title }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Category
                    </div>

                    <div class="summary-value">
                        {{ $exam->category?->name ?? 'No Category' }}
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Duration
                    </div>

                    <div class="summary-value">
                        {{ $exam->duration_minutes }}
                        <span>minutes</span>
                    </div>

                </div>


                <div class="summary-card">

                    <div class="summary-label">
                        Assigned Students
                    </div>

                    <div class="summary-value">
                        {{ $assignedStudents->count() }}
                        <span>students</span>
                    </div>

                </div>

            </div>


            {{-- =================================================
                 AVAILABLE STUDENTS
            ================================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h2 class="panel-title">
                            Available Students
                        </h2>

                        <p class="panel-description">
                            Select active students who should receive access to this exam.
                        </p>

                    </div>


                    <span class="count-badge">
                        {{ $students->count() }} Available
                    </span>

                </div>


                <div class="panel-body">

                    @if($students->count())

                        <form
                            method="POST"
                            action="{{ route('exam-assignments.store', $exam) }}"
                        >

                            @csrf


                            <div class="toolbar">

                                <div class="search-wrap">

                                    <svg
                                        class="search-icon"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <circle
                                            cx="11"
                                            cy="11"
                                            r="7"
                                            stroke-width="1.7"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-width="1.7"
                                            d="m20 20-4-4"
                                        />
                                    </svg>


                                    <input
                                        type="text"
                                        id="studentSearch"
                                        class="search-input"
                                        placeholder="Search name, student code, mobile or email..."
                                    >

                                </div>


                                <label class="select-all">

                                    <input
                                        type="checkbox"
                                        id="selectAllStudents"
                                    >

                                    <span>
                                        Select All Visible
                                    </span>

                                </label>

                            </div>


                            <div class="table-wrap">

                                <table class="student-table">

                                    <thead>

                                        <tr>

                                            <th style="width:60px;">
                                                Select
                                            </th>

                                            <th>
                                                Student
                                            </th>

                                            <th>
                                                Student Code
                                            </th>

                                            <th>
                                                Mobile
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody id="availableStudents">

                                        @foreach($students as $student)

                                            <tr
                                                class="student-row"
                                                data-search="{{ strtolower(
                                                    ($student->first_name ?? '') . ' ' .
                                                    ($student->last_name ?? '') . ' ' .
                                                    ($student->student_code ?? '') . ' ' .
                                                    ($student->mobile ?? '') . ' ' .
                                                    ($student->email ?? '')
                                                ) }}"
                                            >

                                                <td>

                                                    <input
                                                        type="checkbox"
                                                        name="student_ids[]"
                                                        value="{{ $student->id }}"
                                                        class="student-checkbox"
                                                    >

                                                </td>


                                                <td>

                                                    <div class="student-name">
                                                        {{ $student->full_name }}
                                                    </div>

                                                    @if($student->email)

                                                        <div class="student-email">
                                                            {{ $student->email }}
                                                        </div>

                                                    @endif

                                                </td>


                                                <td>

                                                    <span class="student-code">
                                                        {{ $student->student_code }}
                                                    </span>

                                                </td>


                                                <td>
                                                    {{ $student->mobile ?: '—' }}
                                                </td>


                                                <td>

                                                    <span class="status-pill">

                                                        <span class="status-dot"></span>

                                                        Active

                                                    </span>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>


                            <div class="assign-footer">

                                <div class="selected-text">

                                    Selected:

                                    <span
                                        id="selectedCount"
                                        class="selected-number"
                                    >
                                        0
                                    </span>

                                    student(s)

                                </div>


                                <button
                                    type="submit"
                                    id="assignButton"
                                    class="assign-btn assign-btn-primary"
                                    disabled
                                >
                                    Assign Selected Students
                                </button>

                            </div>

                        </form>

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
                                        d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                                    />

                                    <circle
                                        cx="9"
                                        cy="7"
                                        r="4"
                                        stroke-width="1.7"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                                    />
                                </svg>

                            </div>


                            <h3 class="empty-title">
                                No Students Available
                            </h3>


                            <p class="empty-text">
                                There are currently no active students available
                                to assign to this examination.
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- =================================================
                 ASSIGNED STUDENTS
            ================================================== --}}

            <section class="panel">

                <div class="panel-header">

                    <div>

                        <h2 class="panel-title">
                            Assigned Students
                        </h2>

                        <p class="panel-description">
                            Students who currently have access to this examination.
                        </p>

                    </div>


                    <span class="count-badge">
                        {{ $assignedStudents->count() }} Assigned
                    </span>

                </div>


                <div class="panel-body">

                    @if($assignedStudents->count())

                        <div class="table-wrap">

                            <table class="student-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Student
                                        </th>

                                        <th>
                                            Student Code
                                        </th>

                                        <th>
                                            Mobile
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th style="text-align:right;">
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($assignedStudents as $student)

                                        @php

                                            $assignment = $exam->assignments
                                                ->where('student_id', $student->id)
                                                ->where('status', '!=', 'cancelled')
                                                ->first();

                                        @endphp


                                        <tr>

                                            <td>

                                                <div class="student-name">
                                                    {{ $student->full_name }}
                                                </div>

                                                @if($student->email)

                                                    <div class="student-email">
                                                        {{ $student->email }}
                                                    </div>

                                                @endif

                                            </td>


                                            <td>

                                                <span class="student-code">
                                                    {{ $student->student_code }}
                                                </span>

                                            </td>


                                            <td>
                                                {{ $student->mobile ?: '—' }}
                                            </td>


                                            <td>

                                                <span class="status-pill">

                                                    <span class="status-dot"></span>

                                                    Assigned

                                                </span>

                                            </td>


                                            <td style="text-align:right;">

                                                @if($assignment)

                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'exam-assignments.destroy',
                                                            [
                                                                'exam' => $exam,
                                                                'assignment' => $assignment,
                                                            ]
                                                        ) }}"
                                                        onsubmit="return confirm('Remove this student from the exam?');"
                                                    >

                                                        @csrf

                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="remove-btn"
                                                        >
                                                            Remove
                                                        </button>

                                                    </form>

                                                @endif

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

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
                                        d="M9 5H5a2 2 0 00-2 2v12a2 2 0 002 2h14a2 2 0 002-2V7a2 2 0 00-2-2h-4"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M9 5a3 3 0 016 0v1H9V5z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-width="1.7"
                                        d="M8 12h8M8 16h5"
                                    />
                                </svg>

                            </div>


                            <h3 class="empty-title">
                                No Students Assigned
                            </h3>


                            <p class="empty-text">
                                Select students from the available list above
                                to give them access to this examination.
                            </p>

                        </div>

                    @endif

                </div>

            </section>

        </div>

    </div>


    {{-- =====================================================
         JAVASCRIPT
    ====================================================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput =
                document.getElementById('studentSearch');

            const selectAll =
                document.getElementById('selectAllStudents');

            const selectedCount =
                document.getElementById('selectedCount');

            const assignButton =
                document.getElementById('assignButton');

            const rows =
                Array.from(
                    document.querySelectorAll('.student-row')
                );

            const checkboxes =
                Array.from(
                    document.querySelectorAll('.student-checkbox')
                );


            function getVisibleCheckboxes() {

                return rows
                    .filter(function (row) {
                        return row.style.display !== 'none';
                    })
                    .map(function (row) {
                        return row.querySelector('.student-checkbox');
                    })
                    .filter(Boolean);

            }


            function updateSelection() {

                const checked =
                    checkboxes.filter(function (checkbox) {
                        return checkbox.checked;
                    }).length;


                if (selectedCount) {
                    selectedCount.textContent = checked;
                }


                if (assignButton) {
                    assignButton.disabled = checked === 0;
                }


                if (selectAll) {

                    const visible =
                        getVisibleCheckboxes();

                    const visibleChecked =
                        visible.filter(function (checkbox) {
                            return checkbox.checked;
                        }).length;


                    selectAll.checked =
                        visible.length > 0 &&
                        visibleChecked === visible.length;

                }

            }


            checkboxes.forEach(function (checkbox) {

                checkbox.addEventListener(
                    'change',
                    updateSelection
                );

            });


            if (selectAll) {

                selectAll.addEventListener(
                    'change',
                    function () {

                        getVisibleCheckboxes()
                            .forEach(function (checkbox) {

                                checkbox.checked =
                                    selectAll.checked;

                            });

                        updateSelection();

                    }
                );

            }


            if (searchInput) {

                searchInput.addEventListener(
                    'input',
                    function () {

                        const search =
                            searchInput.value
                                .toLowerCase()
                                .trim();


                        rows.forEach(function (row) {

                            const text =
                                row.dataset.search || '';

                            row.style.display =
                                text.includes(search)
                                    ? ''
                                    : 'none';

                        });


                        updateSelection();

                    }
                );

            }


            updateSelection();

        });
    </script>

</x-layouts::examination>