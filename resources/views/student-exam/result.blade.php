<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $exam->title }} - Result
    </title>

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

        .header {
            background: #111827;
            color: #ffffff;
            padding: 25px 20px;
        }

        .header-inner {
            max-width: 900px;
            margin: 0 auto;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .student {
            margin-top: 8px;
            color: #d1d5db;
        }

        .container {
            max-width: 900px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .result-card {
            background: #ffffff;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.07);
            text-align: center;
        }

        .result-status {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .passed {
            color: #059669;
        }

        .failed {
            color: #dc2626;
        }

        .result-message {
            color: #6b7280;
            margin-bottom: 30px;
        }

        .score {
            font-size: 48px;
            font-weight: 800;
            margin: 20px 0;
        }

        .score small {
            font-size: 22px;
            color: #6b7280;
            font-weight: 600;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .stat {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px 10px;
        }

        .stat-number {
            font-size: 25px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .stat-label {
            color: #6b7280;
            font-size: 14px;
        }

        .details {
            margin-top: 30px;
            border-top: 1px solid #e5e7eb;
            padding-top: 25px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 13px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-label {
            color: #6b7280;
        }

        .detail-value {
            font-weight: 700;
            text-align: right;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border-radius: 10px;
            padding: 13px 22px;
            font-weight: 700;
            border: 1px solid #d1d5db;
            color: #111827;
            background: #ffffff;
        }

        .btn-primary {
            background: #111827;
            color: #ffffff;
            border-color: #111827;
        }

        @media (max-width: 700px) {

            .result-card {
                padding: 25px 18px;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .score {
                font-size: 40px;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<header class="header">

    <div class="header-inner">

        <h1>
            {{ $exam->title }}
        </h1>

        <div class="student">
            Student:
            {{ $student->full_name }}
        </div>

    </div>

</header>


<main class="container">

    <div class="result-card">

        @if($attempt->is_passed)

            <div class="result-status passed">
                Congratulations! 🎉
            </div>

            <div class="result-message">
                You have successfully passed the examination.
            </div>

        @else

            <div class="result-status failed">
                Exam Completed
            </div>

            <div class="result-message">
                You did not reach the required passing marks.
            </div>

        @endif


        <div class="score">

            {{ number_format((float) $attempt->obtained_marks, 2) }}

            <small>
                /
                {{ number_format((float) $attempt->total_marks, 2) }}
            </small>

        </div>


        <div class="stats">

            <div class="stat">

                <div class="stat-number">
                    {{ $attempt->correct_answers }}
                </div>

                <div class="stat-label">
                    Correct
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $attempt->wrong_answers }}
                </div>

                <div class="stat-label">
                    Wrong
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $attempt->unanswered }}
                </div>

                <div class="stat-label">
                    Unanswered
                </div>

            </div>


            <div class="stat">

                <div class="stat-number">
                    {{ $attempt->attempt_number }}
                </div>

                <div class="stat-label">
                    Attempt
                </div>

            </div>

        </div>


        <div class="details">

            <div class="detail-row">

                <div class="detail-label">
                    Passing Marks
                </div>

                <div class="detail-value">
                    {{ number_format((float) $exam->passing_marks, 2) }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Obtained Marks
                </div>

                <div class="detail-value">
                    {{ number_format((float) $attempt->obtained_marks, 2) }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Total Marks
                </div>

                <div class="detail-value">
                    {{ number_format((float) $attempt->total_marks, 2) }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Correct Answers
                </div>

                <div class="detail-value">
                    {{ $attempt->correct_answers }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Wrong Answers
                </div>

                <div class="detail-value">
                    {{ $attempt->wrong_answers }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Unanswered
                </div>

                <div class="detail-value">
                    {{ $attempt->unanswered }}
                </div>

            </div>


            <div class="detail-row">

                <div class="detail-label">
                    Submitted At
                </div>

                <div class="detail-value">

                    @if($attempt->submitted_at)

                        {{ $attempt->submitted_at->format('d M Y, h:i A') }}

                    @else

                        —

                    @endif

                </div>

            </div>

        </div>


        <div class="actions">

            <a
                href="{{ route('student-exam.dashboard') }}"
                class="btn btn-primary"
            >
                Back to Dashboard
            </a>

        </div>

    </div>

</main>

</body>
</html>