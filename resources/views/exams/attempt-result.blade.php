<x-layouts::examination :title="'Result Details - ' . $exam->title">

    @php
        $totalMarks = (float) $attempt->total_marks;
        $obtainedMarks = (float) $attempt->obtained_marks;

        $percentage = $totalMarks > 0
            ? ($obtainedMarks / $totalMarks) * 100
            : 0;

        $studentName = $attempt->student?->full_name ?? 'Unknown Student';

        $initials = collect(
            preg_split('/\s+/', trim($studentName))
        )
            ->filter()
            ->take(2)
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->implode('');

        $isExpired = $attempt->status === 'expired';
        $isInProgress = $attempt->status === 'in_progress';
        $isPassed = (bool) $attempt->is_passed;

        $statusLabel = $isInProgress
            ? 'In Progress'
            : ($isExpired ? 'Expired' : ($isPassed ? 'Passed' : 'Failed'));

        $statusClass = $isInProgress
            ? 'status-progress'
            : ($isExpired ? 'status-expired' : ($isPassed ? 'status-pass' : 'status-fail'));

        $answers = $attempt->answers;
        $totalQuestions = $answers->count();

        $correctCount = (int) ($attempt->correct_answers ?? 0);
        $wrongCount = (int) ($attempt->wrong_answers ?? 0);
        $unansweredCount = (int) ($attempt->unanswered ?? 0);
    @endphp

    <style>
        .result-page {
            max-width: 1500px;
            margin: 0 auto;
            padding: 30px 28px 55px;
        }

        .result-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
            padding: 30px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            background:
                radial-gradient(circle at 90% 10%, rgba(99,102,241,.22), transparent 32%),
                radial-gradient(circle at 10% 100%, rgba(14,165,233,.12), transparent 32%),
                linear-gradient(135deg,#171a2b,#0f1220 60%,#0b0d15);
            box-shadow: 0 24px 65px rgba(0,0,0,.25);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 25px;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            color: #a5b4fc;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .hero-label span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #818cf8;
            box-shadow: 0 0 15px rgba(129,140,248,.8);
        }

        .hero-title {
            margin: 0;
            color: #fff;
            font-size: clamp(25px,3vw,35px);
            line-height: 1.15;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .hero-subtitle {
            margin: 9px 0 0;
            color: #9ca3af;
            font-size: 13px;
            line-height: 1.6;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 9px;
        }

        .hero-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 41px;
            padding: 9px 14px;
            border: 1px solid rgba(255,255,255,.11);
            border-radius: 10px;
            color: #e5e7eb;
            background: rgba(255,255,255,.055);
            text-decoration: none;
            font-size: 12px;
            font-weight: 750;
            transition: .2s ease;
        }

        .hero-btn:hover {
            color: #fff;
            background: rgba(255,255,255,.11);
            transform: translateY(-1px);
        }

        .hero-btn.primary {
            border-color: rgba(99,102,241,.55);
            color: #fff;
            background: linear-gradient(135deg,#6366f1,#4f46e5);
            box-shadow: 0 9px 24px rgba(79,70,229,.25);
        }

        .hero-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 19px;
        }

        .hero-pill {
            padding: 7px 10px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 999px;
            color: #cbd5e1;
            background: rgba(255,255,255,.045);
            font-size: 11px;
            font-weight: 650;
        }

        .hero-pill strong {
            color: #fff;
        }

        .student-card {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
            padding: 20px 22px;
            border: 1px solid #e5e7eb;
            border-radius: 19px;
            background: #fff;
            box-shadow: 0 9px 32px rgba(15,23,42,.06);
        }

        .student-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 54px;
            width: 54px;
            height: 54px;
            border-radius: 16px;
            color: #4f46e5;
            background: linear-gradient(135deg,#eef2ff,#e0e7ff);
            font-size: 16px;
            font-weight: 850;
        }

        .student-main {
            flex: 1;
            min-width: 0;
        }

        .student-name {
            color: #111827;
            font-size: 17px;
            font-weight: 850;
        }

        .student-code {
            margin-top: 4px;
            color: #64748b;
            font-size: 12px;
        }

        .student-status {
            flex-shrink: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 850;
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(6,minmax(0,1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .info-card {
            padding: 17px;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            background: #fff;
            box-shadow: 0 7px 25px rgba(15,23,42,.045);
        }

        .info-label {
            margin-bottom: 7px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .info-value {
            color: #111827;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: 1.35fr repeat(4,1fr);
            gap: 13px;
            margin-bottom: 22px;
        }

        .summary-card {
            position: relative;
            overflow: hidden;
            min-height: 116px;
            padding: 19px;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            background: #fff;
            box-shadow: 0 8px 28px rgba(15,23,42,.05);
        }

        .summary-card.score-card {
            border-color: #dfe3ff;
            background: linear-gradient(135deg,#fff,#f6f7ff);
        }

        .summary-label {
            color: #64748b;
            font-size: 11px;
            font-weight: 750;
        }

        .summary-value {
            margin-top: 7px;
            color: #111827;
            font-size: 25px;
            font-weight: 850;
        }

        .summary-note {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 10px;
        }

        .score-progress {
            height: 6px;
            overflow: hidden;
            margin-top: 11px;
            border-radius: 999px;
            background: #e2e8f0;
        }

        .score-progress span {
            display: block;
            height: 100%;
            width: {{ min(100,max(0,$percentage)) }}%;
            border-radius: inherit;
            background: #4f46e5;
        }

        .positive {
            color: #15803d;
        }

        .negative {
            color: #dc2626;
        }

        .neutral {
            color: #b45309;
        }

        .questions-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 13px;
        }

        .section-title {
            margin: 0;
            color: #111827;
            font-size: 18px;
            font-weight: 850;
        }

        .section-subtitle {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 11px;
        }

        .question-count {
            padding: 7px 10px;
            border: 1px solid #e0e7ff;
            border-radius: 999px;
            color: #4f46e5;
            background: #f5f7ff;
            font-size: 10px;
            font-weight: 800;
        }

        .question-card {
            overflow: hidden;
            margin-bottom: 13px;
            border: 1px solid #e5e7eb;
            border-left: 4px solid #cbd5e1;
            border-radius: 17px;
            background: #fff;
            box-shadow: 0 7px 26px rgba(15,23,42,.045);
        }

        .question-card.correct {
            border-left-color: #22c55e;
        }

        .question-card.wrong {
            border-left-color: #ef4444;
        }

        .question-card.unanswered {
            border-left-color: #f59e0b;
        }

        .question-inner {
            padding: 20px;
        }

        .question-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 12px;
        }

        .question-number {
            color: #64748b;
            font-size: 11px;
            font-weight: 850;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .question-text {
            margin-bottom: 17px;
            color: #111827;
            font-size: 15px;
            line-height: 1.7;
            font-weight: 700;
        }

        .answer-grid {
            display: grid;
            grid-template-columns: repeat(2,minmax(0,1fr));
            gap: 10px;
        }

        .answer-box {
            padding: 13px;
            border: 1px solid #e5e7eb;
            border-radius: 11px;
            background: #f8fafc;
        }

        .answer-box.student-correct {
            border-color: #bbf7d0;
            background: #f0fdf4;
        }

        .answer-box.student-wrong {
            border-color: #fecaca;
            background: #fef2f2;
        }

        .answer-box.unanswered-box {
            border-color: #fde68a;
            background: #fffbeb;
        }

        .answer-label {
            margin-bottom: 5px;
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .answer-value {
            color: #334155;
            font-size: 12px;
            line-height: 1.55;
        }

        .no-answer {
            color: #a16207;
            font-weight: 750;
        }

        .marks-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 11px;
            padding-top: 11px;
            border-top: 1px solid #eef0f4;
        }

        .marks-label {
            color: #64748b;
            font-size: 10px;
            font-weight: 750;
        }

        .marks-value {
            color: #111827;
            font-size: 12px;
            font-weight: 850;
        }

        .explanation {
            margin-top: 11px;
            padding: 13px;
            border: 1px solid #e5e7eb;
            border-radius: 11px;
            background: #fafafa;
        }

        .explanation-label {
            margin-bottom: 5px;
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .explanation-text {
            color: #475569;
            font-size: 12px;
            line-height: 1.65;
        }

        .empty-card {
            padding: 55px 20px;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            background: #fff;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            border-radius: 16px;
            color: #4f46e5;
            background: #eef2ff;
            font-size: 21px;
            font-weight: 850;
        }

        .empty-card h3 {
            margin: 0;
            color: #111827;
            font-size: 17px;
            font-weight: 850;
        }

        .empty-card p {
            margin: 7px auto 0;
            max-width: 420px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        @media print {
            body {
                background: #fff !important;
            }

            .result-page {
                max-width: 100%;
                padding: 0;
            }

            .hero-actions {
                display: none;
            }

            .result-hero {
                box-shadow: none;
            }

            .student-card,
            .info-card,
            .summary-card,
            .question-card {
                box-shadow: none;
            }

            .question-card {
                break-inside: avoid;
            }
        }

        @media (max-width: 1200px) {
            .info-grid {
                grid-template-columns: repeat(3,minmax(0,1fr));
            }

            .summary-grid {
                grid-template-columns: repeat(3,minmax(0,1fr));
            }
        }

        @media (max-width: 900px) {
            .hero-content {
                flex-direction: column;
            }

            .hero-actions {
                justify-content: flex-start;
            }

            .answer-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 650px) {
            .result-page {
                padding: 17px 12px 35px;
            }

            .result-hero {
                padding: 21px;
                border-radius: 18px;
            }

            .student-card {
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .student-status {
                width: 100%;
            }

            .info-grid,
            .summary-grid {
                grid-template-columns: repeat(2,minmax(0,1fr));
            }

            .question-inner {
                padding: 16px;
            }

            .question-top {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 430px) {
            .info-grid,
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .hero-title {
                font-size: 24px;
            }
        }
    </style>


    <div class="result-page">

        {{-- HERO --}}
        <section class="result-hero">

            <div class="hero-content">

                <div>

                    <div class="hero-label">
                        <span></span>
                        Result Details
                    </div>

                    <h1 class="hero-title">
                        {{ $exam->title }}
                    </h1>

                    <p class="hero-subtitle">
                        Detailed attempt performance and question-wise evaluation.
                    </p>

                    <div class="hero-meta">

                        <div class="hero-pill">
                            Attempt <strong>#{{ $attempt->attempt_number }}</strong>
                        </div>

                        <div class="hero-pill">
                            Score <strong>{{ number_format($obtainedMarks,2) }}/{{ number_format($totalMarks,2) }}</strong>
                        </div>

                        <div class="hero-pill">
                            Percentage <strong>{{ number_format($percentage,2) }}%</strong>
                        </div>

                    </div>

                </div>


                <div class="hero-actions">

                    <a
                        href="{{ route('exams.results', $exam) }}"
                        class="hero-btn"
                    >
                        ← Back to Results
                    </a>

                    <a
                        href="{{ route('exams.show', $exam) }}"
                        class="hero-btn"
                    >
                        Exam Details
                    </a>

                    <button
                        type="button"
                        onclick="window.print()"
                        class="hero-btn primary"
                    >
                        Print Result
                    </button>

                </div>

            </div>

        </section>


        {{-- STUDENT --}}
        <section class="student-card">

            <div class="student-avatar">
                {{ $initials ?: 'ST' }}
            </div>

            <div class="student-main">

                <div class="student-name">
                    {{ $studentName }}
                </div>

                <div class="student-code">
                    Student Code:
                    {{ $attempt->student?->student_code ?? '—' }}
                </div>

            </div>

            <div class="student-status">

                <span class="status-badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>

            </div>

        </section>


        {{-- ATTEMPT INFORMATION --}}
        <section class="info-grid">

            <div class="info-card">
                <div class="info-label">Attempt</div>
                <div class="info-value">
                    #{{ $attempt->attempt_number }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-label">Started At</div>
                <div class="info-value">
                    {{ $attempt->started_at ? $attempt->started_at->format('d M Y, h:i A') : '—' }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-label">Submitted At</div>
                <div class="info-value">
                    {{ $attempt->submitted_at ? $attempt->submitted_at->format('d M Y, h:i A') : '—' }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-label">Passing Marks</div>
                <div class="info-value">
                    {{ number_format((float) $exam->passing_marks,2) }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-label">Exam Marks</div>
                <div class="info-value">
                    {{ number_format($examTotalMarks ?? $totalMarks,2) }}
                </div>
            </div>

            <div class="info-card">
                <div class="info-label">Questions</div>
                <div class="info-value">
                    {{ $totalQuestions }}
                </div>
            </div>

        </section>


        {{-- RESULT SUMMARY --}}
        <section class="summary-grid">

            <div class="summary-card score-card">

                <div class="summary-label">
                    Final Score
                </div>

                <div class="summary-value">
                    {{ number_format($obtainedMarks,2) }}
                    /
                    {{ number_format($totalMarks,2) }}
                </div>

                <div class="score-progress">
                    <span></span>
                </div>

                <div class="summary-note">
                    {{ number_format($percentage,2) }}% of total marks
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-label">
                    Correct
                </div>

                <div class="summary-value positive">
                    {{ $correctCount }}
                </div>

                <div class="summary-note">
                    Correct answers
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-label">
                    Wrong
                </div>

                <div class="summary-value negative">
                    {{ $wrongCount }}
                </div>

                <div class="summary-note">
                    Incorrect answers
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-label">
                    Unanswered
                </div>

                <div class="summary-value neutral">
                    {{ $unansweredCount }}
                </div>

                <div class="summary-note">
                    Questions skipped
                </div>

            </div>


            <div class="summary-card">

                <div class="summary-label">
                    Result
                </div>

                <div class="summary-value">

                    <span class="status-badge {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>

                </div>

                <div class="summary-note">
                    Final evaluation
                </div>

            </div>

        </section>


        {{-- QUESTIONS --}}
        <div class="questions-header">

            <div>
                <h2 class="section-title">
                    Question-wise Result
                </h2>

                <p class="section-subtitle">
                    Review the student's selected answer, correct answer and marks awarded.
                </p>
            </div>

            <div class="question-count">
                {{ $totalQuestions }} Questions
            </div>

        </div>


        @forelse($attempt->answers as $answer)

            @php
                $question = $answer->question;

                $selectedOption = null;

                if ($question && $answer->selected_option_id) {
                    $selectedOption = $question->options->firstWhere(
                        'id',
                        $answer->selected_option_id
                    );
                }

                $correctOptions = $question
                    ? $question->options->where('is_correct', true)
                    : collect();

                $isCorrect = $selectedOption && $selectedOption->is_correct;
                $isUnanswered = !$selectedOption;

                $questionClass = $isCorrect
                    ? 'correct'
                    : ($isUnanswered ? 'unanswered' : 'wrong');

                $answerClass = $isCorrect
                    ? 'student-correct'
                    : ($isUnanswered ? 'unanswered-box' : 'student-wrong');
            @endphp


            <article class="question-card {{ $questionClass }}">

                <div class="question-inner">

                    <div class="question-top">

                        <div class="question-number">
                            Question {{ $loop->iteration }}
                        </div>

                        <div>

                            @if($isCorrect)

                                <span class="status-badge status-pass">
                                    Correct
                                </span>

                            @elseif($isUnanswered)

                                <span class="status-badge status-expired">
                                    Unanswered
                                </span>

                            @else

                                <span class="status-badge status-fail">
                                    Wrong
                                </span>

                            @endif

                        </div>

                    </div>


                    <div class="question-text">

                        {!! nl2br(
                            e(
                                $question
                                    ? $question->question_text
                                    : 'Question not available'
                            )
                        ) !!}

                    </div>


                    <div class="answer-grid">

                        {{-- Student Answer --}}
                        <div class="answer-box {{ $answerClass }}">

                            <div class="answer-label">
                                Student Answer
                            </div>

                            <div class="answer-value">

                                @if($selectedOption)

                                    {{ $selectedOption->option_text }}

                                @else

                                    <span class="no-answer">
                                        Not Answered
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- Correct Answer --}}
                        <div class="answer-box student-correct">

                            <div class="answer-label">
                                Correct Answer
                            </div>

                            <div class="answer-value">

                                @forelse($correctOptions as $correctOption)

                                    <div>
                                        {{ $correctOption->option_text }}
                                    </div>

                                @empty

                                    <span>
                                        Correct answer not available
                                    </span>

                                @endforelse

                            </div>

                        </div>

                    </div>


                    {{-- Marks --}}
                    <div class="marks-row">

                        <div class="marks-label">
                            Marks Awarded
                        </div>

                        <div class="marks-value">
                            {{ number_format((float) ($answer->marks_awarded ?? 0),2) }}
                        </div>

                    </div>


                    {{-- Explanation --}}
                    @if($question && $question->explanation)

                        <div class="explanation">

                            <div class="explanation-label">
                                Explanation
                            </div>

                            <div class="explanation-text">

                                {!! nl2br(
                                    e($question->explanation)
                                ) !!}

                            </div>

                        </div>

                    @endif

                </div>

            </article>

        @empty

            <div class="empty-card">

                <div class="empty-icon">
                    ?
                </div>

                <h3>
                    No Answer Details
                </h3>

                <p>
                    No question-wise answer information is available for this attempt.
                </p>

            </div>

        @endforelse

    </div>

</x-layouts::examination>