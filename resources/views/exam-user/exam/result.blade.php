<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $exam->title }} - Result</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1f2937;
        }

        .result-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 20px;
        }

        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand-title {
            margin: 0;
            font-size: 22px;
            font-weight: 800;
            color: #111827;
        }

        .candidate-name {
            margin-top: 5px;
            color: #6b7280;
            font-size: 14px;
        }

        .dashboard-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 18px;
            border-radius: 10px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
        }

        .dashboard-btn:hover {
            background: #374151;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .result-hero {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 34px 30px;
            text-align: center;
            box-shadow: 0 8px 28px rgba(0, 0, 0, .05);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .6px;
        }

        .status-pass {
            background: #dcfce7;
            color: #166534;
        }

        .status-fail {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-expired {
            background: #fef3c7;
            color: #92400e;
        }

        .result-title {
            margin: 18px 0 8px;
            font-size: 30px;
            font-weight: 800;
            color: #111827;
        }

        .result-subtitle {
            margin: 0;
            color: #6b7280;
            font-size: 15px;
        }

        .score {
            margin: 26px 0 8px;
            font-size: 54px;
            line-height: 1;
            font-weight: 900;
            color: #111827;
        }

        .score-label {
            color: #6b7280;
            font-size: 14px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            margin-top: 28px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 20px 14px;
            text-align: center;
        }

        .stat-value {
            font-size: 25px;
            font-weight: 800;
            color: #111827;
        }

        .stat-label {
            margin-top: 6px;
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
        }

        .section {
            margin-top: 24px;
        }

        .section-title {
            margin: 0 0 14px;
            font-size: 20px;
            font-weight: 800;
            color: #111827;
        }

        .exam-details {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px 18px;
            border-bottom: 1px solid #f0f1f3;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-label {
            color: #6b7280;
            font-size: 13px;
        }

        .detail-value {
            color: #111827;
            font-size: 14px;
            font-weight: 700;
            text-align: right;
        }

        .answer-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            margin-bottom: 14px;
            overflow: hidden;
        }

        .answer-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 18px;
            border-bottom: 1px solid #eef0f3;
        }

        .question-number {
            font-size: 13px;
            font-weight: 800;
            color: #6b7280;
        }

        .answer-status {
            font-size: 12px;
            font-weight: 800;
            padding: 6px 10px;
            border-radius: 999px;
        }

        .answer-correct {
            background: #dcfce7;
            color: #166534;
        }

        .answer-wrong {
            background: #fee2e2;
            color: #991b1b;
        }

        .answer-unanswered {
            background: #f3f4f6;
            color: #4b5563;
        }

        .answer-body {
            padding: 20px 18px;
        }

        .question-text {
            font-size: 16px;
            line-height: 1.6;
            font-weight: 700;
            color: #111827;
            margin-bottom: 18px;
        }

        .answer-line {
            padding: 12px 14px;
            border-radius: 10px;
            background: #f9fafb;
            margin-top: 9px;
            font-size: 14px;
            line-height: 1.5;
        }

        .answer-line strong {
            display: block;
            margin-bottom: 3px;
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .answer-line.correct-line {
            background: #f0fdf4;
        }

        .answer-line.wrong-line {
            background: #fef2f2;
        }

        .answer-line.neutral-line {
            background: #f9fafb;
        }

        .marks {
            margin-top: 14px;
            color: #6b7280;
            font-size: 12px;
            font-weight: 700;
        }

        .bottom-action {
            text-align: center;
            margin: 30px 0 50px;
        }

        .bottom-action a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 22px;
            border-radius: 10px;
            background: #111827;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 800;
        }

        .empty-review {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 30px;
            text-align: center;
            color: #6b7280;
        }

        @media (max-width: 760px) {
            .header-inner {
                flex-direction: column;
                align-items: stretch;
            }

            .dashboard-btn {
                width: 100%;
            }

            .container {
                margin: 18px auto;
                padding: 0 12px;
            }

            .result-hero {
                padding: 28px 18px;
            }

            .result-title {
                font-size: 25px;
            }

            .score {
                font-size: 45px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .detail-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 5px;
            }

            .detail-value {
                text-align: left;
            }

            .answer-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<header class="result-header">
    <div class="header-inner">

        <div>
            <h1 class="brand-title">
                Examination Result
            </h1>

            <div class="candidate-name">
                Candidate:
                {{ $examUser->name ?? 'Candidate' }}
            </div>
        </div>

        <a
            href="{{ route('exam-user.dashboard') }}"
            class="dashboard-btn"
        >
            Back to Dashboard
        </a>

    </div>
</header>


<main class="container">

    @php
        $totalMarks = (float) ($attempt->total_marks ?? 0);
        $obtainedMarks = (float) ($attempt->obtained_marks ?? 0);

        $percentage = $totalMarks > 0
            ? round(($obtainedMarks / $totalMarks) * 100, 2)
            : 0;

        $statusClass = $attempt->status === 'expired'
            ? 'status-expired'
            : ($attempt->is_passed ? 'status-pass' : 'status-fail');

        $statusText = $attempt->status === 'expired'
            ? 'Expired'
            : ($attempt->is_passed ? 'Passed' : 'Failed');
    @endphp


    <section class="result-hero">

        <span class="status-badge {{ $statusClass }}">
            {{ $statusText }}
        </span>

        <h2 class="result-title">
            {{ $exam->title }}
        </h2>

        <p class="result-subtitle">
            Your examination has been completed successfully.
        </p>

        <div class="score">
            {{ rtrim(rtrim(number_format($obtainedMarks, 2), '0'), '.') }}
            /
            {{ rtrim(rtrim(number_format($totalMarks, 2), '0'), '.') }}
        </div>

        <div class="score-label">
            {{ $percentage }}% Score
        </div>

    </section>


    <section class="stats">

        <div class="stat-card">
            <div class="stat-value">
                {{ (int) ($attempt->correct_answers ?? 0) }}
            </div>

            <div class="stat-label">
                Correct
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-value">
                {{ (int) ($attempt->wrong_answers ?? 0) }}
            </div>

            <div class="stat-label">
                Wrong
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-value">
                {{ (int) ($attempt->unanswered ?? 0) }}
            </div>

            <div class="stat-label">
                Unanswered
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-value">
                {{ $exam->passing_marks }}
            </div>

            <div class="stat-label">
                Passing Marks
            </div>
        </div>

    </section>


    <section class="section">

        <h2 class="section-title">
            Examination Details
        </h2>

        <div class="exam-details">

            <div class="detail-row">
                <span class="detail-label">
                    Examination
                </span>

                <span class="detail-value">
                    {{ $exam->title }}
                </span>
            </div>


            @if($exam->category)
                <div class="detail-row">
                    <span class="detail-label">
                        Category
                    </span>

                    <span class="detail-value">
                        {{ $exam->category->name }}
                    </span>
                </div>
            @endif


            <div class="detail-row">
                <span class="detail-label">
                    Attempt Number
                </span>

                <span class="detail-value">
                    #{{ $attempt->attempt_number }}
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Total Marks
                </span>

                <span class="detail-value">
                    {{ $totalMarks }}
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Passing Marks
                </span>

                <span class="detail-value">
                    {{ $exam->passing_marks }}
                </span>
            </div>


            <div class="detail-row">
                <span class="detail-label">
                    Result Status
                </span>

                <span class="detail-value">
                    {{ $statusText }}
                </span>
            </div>

        </div>

    </section>


    <section class="section">

        <h2 class="section-title">
            Answer Review
        </h2>

        @forelse($attempt->answers as $index => $answer)

            @php
                $question = $answer->question;

                $selectedOption = $question?->options
                    ?->firstWhere('id', $answer->selected_option_id);

                $correctOption = $question?->options
                    ?->firstWhere('is_correct', true);

                if (! $answer->is_answered) {
                    $reviewStatus = 'Unanswered';
                    $reviewClass = 'answer-unanswered';
                } elseif ($answer->is_correct) {
                    $reviewStatus = 'Correct';
                    $reviewClass = 'answer-correct';
                } else {
                    $reviewStatus = 'Wrong';
                    $reviewClass = 'answer-wrong';
                }
            @endphp


            <article class="answer-card">

                <div class="answer-head">

                    <div class="question-number">
                        Question {{ $index + 1 }}
                    </div>

                    <span class="answer-status {{ $reviewClass }}">
                        {{ $reviewStatus }}
                    </span>

                </div>


                <div class="answer-body">

                    <div class="question-text">
                        {!! nl2br(
                            e(
                                $question?->question_text
                                ?? $question?->question
                                ?? 'Question unavailable'
                            )
                        ) !!}
                    </div>


                    @if($selectedOption)

                        <div class="answer-line {{ $answer->is_correct ? 'correct-line' : 'wrong-line' }}">

                            <strong>
                                Your Answer
                            </strong>

                            {{ $selectedOption->option_text }}

                        </div>

                    @else

                        <div class="answer-line neutral-line">

                            <strong>
                                Your Answer
                            </strong>

                            Not answered

                        </div>

                    @endif


                    @if($correctOption)

                        <div class="answer-line correct-line">

                            <strong>
                                Correct Answer
                            </strong>

                            {{ $correctOption->option_text }}

                        </div>

                    @endif


                    <div class="marks">

                        Marks Awarded:
                        {{ number_format((float) ($answer->marks_awarded ?? 0), 2) }}

                    </div>

                </div>

            </article>

        @empty

            <div class="empty-review">
                No answer review is available for this attempt.
            </div>

        @endforelse

    </section>


    <div class="bottom-action">

        <a href="{{ route('exam-user.dashboard') }}">
            Back to Dashboard
        </a>

    </div>

</main>

</body>
</html>