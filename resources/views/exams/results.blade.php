<x-layouts::examination :title="'Exam Results - ' . $exam->title">

    @php
        $totalAttempts = $attempts->total();

        $passedAttempts = $attempts->getCollection()
            ->where('is_passed', true)
            ->count();

        $failedAttempts = $attempts->getCollection()
            ->where('is_passed', false)
            ->count();

        $completedAttempts = $attempts->getCollection()
            ->filter(fn ($attempt) => $attempt->status !== 'in_progress')
            ->count();

        $passRate = $completedAttempts > 0
            ? round(($passedAttempts / $completedAttempts) * 100, 1)
            : 0;

        $examTotalMarks = (float) $exam->total_marks;
    @endphp

    <style>
        .results-page {
            max-width: 1500px;
            margin: 0 auto;
            padding: 30px 28px 50px;
        }

        .results-hero {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 24px;
            padding: 30px;
            margin-bottom: 22px;
            background:
                radial-gradient(circle at 90% 10%, rgba(99, 102, 241, .20), transparent 34%),
                radial-gradient(circle at 10% 100%, rgba(14, 165, 233, .12), transparent 34%),
                linear-gradient(135deg, #151827 0%, #0f1220 55%, #0b0d16 100%);
            box-shadow: 0 22px 60px rgba(0, 0, 0, .25);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            color: #a5b4fc;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .hero-label span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #818cf8;
            box-shadow: 0 0 14px rgba(129, 140, 248, .8);
        }

        .hero-title {
            margin: 0;
            color: #ffffff;
            font-size: clamp(25px, 3vw, 36px);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .hero-description {
            max-width: 760px;
            margin: 11px 0 0;
            color: #9ca3af;
            font-size: 14px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 10px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 15px;
            border-radius: 11px;
            border: 1px solid rgba(255, 255, 255, .10);
            color: #e5e7eb;
            background: rgba(255, 255, 255, .06);
            text-decoration: none;
            font-size: 13px;
            font-weight: 700;
            transition: .2s ease;
        }

        .action-btn:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, .11);
            border-color: rgba(255, 255, 255, .18);
            transform: translateY(-1px);
        }

        .action-btn.primary {
            color: #ffffff;
            border-color: rgba(99, 102, 241, .55);
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            box-shadow: 0 10px 25px rgba(79, 70, 229, .22);
        }

        .action-btn.primary:hover {
            background: linear-gradient(135deg, #7073ff, #5b52f0);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
            margin-top: 20px;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 11px;
            border: 1px solid rgba(255, 255, 255, .08);
            border-radius: 999px;
            color: #cbd5e1;
            background: rgba(255, 255, 255, .045);
            font-size: 12px;
            font-weight: 600;
        }

        .meta-pill strong {
            color: #ffffff;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            min-height: 128px;
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(15, 23, 42, .06);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 80px;
            right: -30px;
            bottom: -35px;
            border-radius: 50%;
            background: #f3f4f6;
        }

        .stat-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            margin-bottom: 14px;
            border-radius: 10px;
            color: #4f46e5;
            background: #eef2ff;
            font-size: 15px;
            font-weight: 800;
        }

        .stat-label {
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .02em;
        }

        .stat-value {
            margin-top: 5px;
            color: #111827;
            font-size: 25px;
            line-height: 1.1;
            font-weight: 800;
        }

        .stat-note {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 11px;
        }

        .stat-success .stat-icon {
            color: #15803d;
            background: #dcfce7;
        }

        .stat-danger .stat-icon {
            color: #dc2626;
            background: #fee2e2;
        }

        .stat-warning .stat-icon {
            color: #b45309;
            background: #fef3c7;
        }

        .stat-info .stat-icon {
            color: #0369a1;
            background: #e0f2fe;
        }

        .results-card {
            overflow: hidden;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 10px 35px rgba(15, 23, 42, .06);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 21px 23px;
            border-bottom: 1px solid #eef0f4;
        }

        .card-title {
            margin: 0;
            color: #111827;
            font-size: 16px;
            font-weight: 800;
        }

        .card-subtitle {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .result-count {
            padding: 7px 11px;
            border: 1px solid #e0e7ff;
            border-radius: 999px;
            color: #4f46e5;
            background: #f5f7ff;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .results-table {
            width: 100%;
            min-width: 1080px;
            border-collapse: collapse;
        }

        .results-table th {
            padding: 13px 17px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .results-table td {
            padding: 17px;
            color: #334155;
            border-bottom: 1px solid #eef0f4;
            font-size: 13px;
            vertical-align: middle;
        }

        .results-table tbody tr {
            transition: background .15s ease;
        }

        .results-table tbody tr:hover {
            background: #fafbff;
        }

        .results-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .student-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 190px;
        }

        .student-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 40px;
            width: 40px;
            height: 40px;
            border-radius: 12px;
            color: #4f46e5;
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            font-size: 13px;
            font-weight: 800;
        }

        .student-name {
            color: #111827;
            font-weight: 800;
        }

        .student-code {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .attempt-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            padding: 5px 8px;
            border-radius: 8px;
            color: #475569;
            background: #f1f5f9;
            font-size: 11px;
            font-weight: 800;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .status-pass {
            color: #15803d;
            background: #dcfce7;
        }

        .status-pass::before {
            background: #22c55e;
        }

        .status-fail {
            color: #b91c1c;
            background: #fee2e2;
        }

        .status-fail::before {
            background: #ef4444;
        }

        .status-progress {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .status-progress::before {
            background: #3b82f6;
        }

        .status-expired {
            color: #a16207;
            background: #fef3c7;
        }

        .status-expired::before {
            background: #f59e0b;
        }

        .score-main {
            color: #111827;
            font-size: 14px;
            font-weight: 800;
        }

        .score-percent {
            margin-top: 3px;
            color: #64748b;
            font-size: 11px;
        }

        .metric-number {
            color: #334155;
            font-weight: 700;
        }

        .metric-muted {
            color: #94a3b8;
        }

        .date-cell {
            color: #64748b;
            line-height: 1.45;
            white-space: nowrap;
            font-size: 12px;
        }

        .view-result-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 35px;
            padding: 8px 12px;
            border: 1px solid #dbe1ea;
            border-radius: 9px;
            color: #334155;
            background: #ffffff;
            text-decoration: none;
            font-size: 11px;
            font-weight: 800;
            white-space: nowrap;
            transition: .2s ease;
        }

        .view-result-btn:hover {
            color: #ffffff;
            border-color: #4f46e5;
            background: #4f46e5;
            box-shadow: 0 7px 18px rgba(79, 70, 229, .18);
        }

        .running-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 9px;
            border-radius: 9px;
            color: #1d4ed8;
            background: #eff6ff;
            font-size: 10px;
            font-weight: 800;
            white-space: nowrap;
        }

        .running-label span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #3b82f6;
        }

        .empty-state {
            padding: 70px 25px;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 62px;
            height: 62px;
            margin: 0 auto 16px;
            border-radius: 18px;
            color: #4f46e5;
            background: #eef2ff;
            font-size: 22px;
            font-weight: 800;
        }

        .empty-state h3 {
            margin: 0;
            color: #111827;
            font-size: 18px;
            font-weight: 800;
        }

        .empty-state p {
            max-width: 420px;
            margin: 8px auto 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .pagination {
            padding: 18px 22px;
            border-top: 1px solid #eef0f4;
        }

        .summary-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 16px 22px;
            border-bottom: 1px solid #eef0f4;
            background: #fcfcfd;
        }

        .summary-text {
            color: #64748b;
            font-size: 12px;
        }

        .summary-text strong {
            color: #334155;
        }

        .summary-progress {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 190px;
        }

        .progress-track {
            width: 110px;
            height: 6px;
            overflow: hidden;
            border-radius: 999px;
            background: #e2e8f0;
        }

        .progress-fill {
            height: 100%;
            border-radius: inherit;
            background: #22c55e;
        }

        .progress-value {
            color: #15803d;
            font-size: 11px;
            font-weight: 800;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 900px) {
            .results-page {
                padding: 22px 18px 40px;
            }

            .hero-content {
                flex-direction: column;
            }

            .hero-actions {
                justify-content: flex-start;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 560px) {
            .results-page {
                padding: 16px 12px 30px;
            }

            .results-hero {
                padding: 21px;
                border-radius: 18px;
            }

            .hero-title {
                font-size: 24px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .card-header,
            .summary-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary-progress {
                width: 100%;
            }

            .progress-track {
                flex: 1;
                width: auto;
            }
        }
    </style>

    <div class="results-page">

        {{-- Hero --}}
        <section class="results-hero">

            <div class="hero-content">

                <div>
                    <div class="hero-label">
                        <span></span>
                        Examination Results
                    </div>

                    <h1 class="hero-title">
                        {{ $exam->title }}
                    </h1>

                    <p class="hero-description">
                        Review student performance, attempt history, scores and
                        pass/fail outcomes for this examination.
                    </p>

                    <div class="hero-meta">

                        @if($exam->category)
                            <div class="meta-pill">
                                Category:
                                <strong>{{ $exam->category->name }}</strong>
                            </div>
                        @endif

                        <div class="meta-pill">
                            Total Marks:
                            <strong>{{ number_format($examTotalMarks, 2) }}</strong>
                        </div>

                        <div class="meta-pill">
                            Passing:
                            <strong>{{ number_format((float) $exam->passing_marks, 2) }}</strong>
                        </div>

                        <div class="meta-pill">
                            Attempts:
                            <strong>{{ $totalAttempts }}</strong>
                        </div>

                    </div>
                </div>

                <div class="hero-actions">

                    <a
                        href="{{ route('exams.show', $exam) }}"
                        class="action-btn"
                    >
                        ← Back to Exam
                    </a>

                    <a
                        href="{{ url('/exams/' . $exam->id . '/question-paper') }}"
                        class="action-btn"
                    >
                        Question Paper
                    </a>

                    <a
                        href="{{ url('/exams/' . $exam->id . '/assignments') }}"
                        class="action-btn"
                    >
                        Assignments
                    </a>

                    <a
                        href="{{ route('exams.edit', $exam) }}"
                        class="action-btn primary"
                    >
                        Exam Settings
                    </a>

                </div>

            </div>

        </section>


        {{-- Statistics --}}
        <section class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon">#</div>

                <div class="stat-label">
                    Total Attempts
                </div>

                <div class="stat-value">
                    {{ $totalAttempts }}
                </div>

                <div class="stat-note">
                    All recorded attempts
                </div>

            </div>


            <div class="stat-card stat-success">

                <div class="stat-icon">✓</div>

                <div class="stat-label">
                    Passed
                </div>

                <div class="stat-value">
                    {{ $passedAttempts }}
                </div>

                <div class="stat-note">
                    Successful attempts
                </div>

            </div>


            <div class="stat-card stat-danger">

                <div class="stat-icon">×</div>

                <div class="stat-label">
                    Failed
                </div>

                <div class="stat-value">
                    {{ $failedAttempts }}
                </div>

                <div class="stat-note">
                    Unsuccessful attempts
                </div>

            </div>


            <div class="stat-card stat-info">

                <div class="stat-icon">%</div>

                <div class="stat-label">
                    Pass Rate
                </div>

                <div class="stat-value">
                    {{ $passRate }}%
                </div>

                <div class="stat-note">
                    From completed attempts
                </div>

            </div>


            <div class="stat-card stat-warning">

                <div class="stat-icon">★</div>

                <div class="stat-label">
                    Maximum Marks
                </div>

                <div class="stat-value">
                    {{ number_format($examTotalMarks, 2) }}
                </div>

                <div class="stat-note">
                    Passing: {{ number_format((float) $exam->passing_marks, 2) }}
                </div>

            </div>

        </section>


        {{-- Results --}}
        <section class="results-card">

            <div class="card-header">

                <div>
                    <h2 class="card-title">
                        Student Results
                    </h2>

                    <p class="card-subtitle">
                        Detailed attempt-wise performance for this examination.
                    </p>
                </div>

                <div class="result-count">
                    {{ $totalAttempts }} {{ $totalAttempts === 1 ? 'Result' : 'Results' }}
                </div>

            </div>


            @if($attempts->isNotEmpty())

                <div class="summary-bar">

                    <div class="summary-text">
                        Showing
                        <strong>{{ $attempts->firstItem() }}</strong>
                        –
                        <strong>{{ $attempts->lastItem() }}</strong>
                        of
                        <strong>{{ $attempts->total() }}</strong>
                        attempts
                    </div>

                    <div class="summary-progress">

                        <div class="progress-track">
                            <div
                                class="progress-fill"
                                style="width: {{ min(100, max(0, $passRate)) }}%;"
                            ></div>
                        </div>

                        <div class="progress-value">
                            {{ $passRate }}% pass rate
                        </div>

                    </div>

                </div>


                <div class="table-wrapper">

                    <table class="results-table">

                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Attempt</th>
                                <th>Status</th>
                                <th>Score</th>
                                <th>Correct</th>
                                <th>Wrong</th>
                                <th>Unanswered</th>
                                <th>Submitted</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($attempts as $attempt)

                                @php
                                    $studentName = $attempt->student?->full_name ?? 'Unknown Student';

                                    $initials = collect(
                                        preg_split('/\s+/', trim($studentName))
                                    )
                                        ->filter()
                                        ->take(2)
                                        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                                        ->implode('');

                                    $obtainedMarks = (float) $attempt->obtained_marks;
                                    $attemptTotalMarks = (float) $attempt->total_marks;

                                    $percentage = $attemptTotalMarks > 0
                                        ? round(($obtainedMarks / $attemptTotalMarks) * 100, 1)
                                        : 0;
                                @endphp

                                <tr>

                                    {{-- Student --}}
                                    <td>

                                        <div class="student-cell">

                                            <div class="student-avatar">
                                                {{ $initials ?: 'ST' }}
                                            </div>

                                            <div>

                                                <div class="student-name">
                                                    {{ $studentName }}
                                                </div>

                                                @if($attempt->student?->student_code)
                                                    <div class="student-code">
                                                        {{ $attempt->student->student_code }}
                                                    </div>
                                                @endif

                                            </div>

                                        </div>

                                    </td>


                                    {{-- Attempt --}}
                                    <td>
                                        <span class="attempt-badge">
                                            #{{ $attempt->attempt_number }}
                                        </span>
                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($attempt->status === 'expired')

                                            <span class="status-badge status-expired">
                                                Expired
                                            </span>

                                        @elseif($attempt->status === 'in_progress')

                                            <span class="status-badge status-progress">
                                                In Progress
                                            </span>

                                        @elseif($attempt->is_passed)

                                            <span class="status-badge status-pass">
                                                Passed
                                            </span>

                                        @else

                                            <span class="status-badge status-fail">
                                                Failed
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Score --}}
                                    <td>

                                        <div class="score-main">
                                            {{ number_format($obtainedMarks, 2) }}
                                            /
                                            {{ number_format($attemptTotalMarks, 2) }}
                                        </div>

                                        <div class="score-percent">
                                            {{ $percentage }}%
                                        </div>

                                    </td>


                                    {{-- Correct --}}
                                    <td>
                                        <span class="metric-number">
                                            {{ $attempt->correct_answers ?? 0 }}
                                        </span>
                                    </td>


                                    {{-- Wrong --}}
                                    <td>
                                        <span class="metric-number">
                                            {{ $attempt->wrong_answers ?? 0 }}
                                        </span>
                                    </td>


                                    {{-- Unanswered --}}
                                    <td>
                                        <span class="metric-number">
                                            {{ $attempt->unanswered ?? 0 }}
                                        </span>
                                    </td>


                                    {{-- Submitted --}}
                                    <td>

                                        @if($attempt->submitted_at)

                                            <div class="date-cell">
                                                {{ $attempt->submitted_at->format('d M Y') }}<br>
                                                {{ $attempt->submitted_at->format('h:i A') }}
                                            </div>

                                        @else

                                            <span class="metric-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        @if($attempt->status === 'in_progress')

                                            <span class="running-label">
                                                <span></span>
                                                Attempt Running
                                            </span>

                                        @else

                                            <a
                                                href="{{ route('exams.attempt-result', [
                                                    'exam' => $exam,
                                                    'attempt' => $attempt
                                                ]) }}"
                                                class="view-result-btn"
                                            >
                                                View Result →
                                            </a>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                @if($attempts->hasPages())

                    <div class="pagination">
                        {{ $attempts->links() }}
                    </div>

                @endif


            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ∑
                    </div>

                    <h3>
                        No Results Yet
                    </h3>

                    <p>
                        No student attempt has been recorded for this examination.
                        Results will appear here once students submit their attempts.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts::examination>