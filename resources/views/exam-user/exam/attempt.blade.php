<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $exam->title }} - Exam</title>

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

        .exam-header {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .exam-title {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
        }

        .student-name {
            margin-top: 5px;
            color: #6b7280;
            font-size: 14px;
        }

        .timer-box {
            text-align: center;
        }

        .timer-label {
            display: block;
            font-size: 11px;
            color: #6b7280;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .timer {
            min-width: 125px;
            padding: 10px 16px;
            border-radius: 10px;
            background: #111827;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
        }

        .timer.warning {
            background: #b45309;
        }

        .timer.danger {
            background: #dc2626;
        }

        .container {
            max-width: 1100px;
            margin: 28px auto;
            padding: 0 20px;
        }

        .exam-info {
            background: #ffffff;
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
        }

        .exam-info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .exam-info-title {
            font-size: 16px;
            font-weight: 700;
        }

        .progress-text {
            color: #6b7280;
            font-size: 14px;
        }

        .question-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 26px;
            margin-bottom: 20px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        }

        .question-number {
            color: #6b7280;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .question-text {
            font-size: 18px;
            line-height: 1.65;
            margin-bottom: 22px;
            font-weight: 600;
        }

        .option {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: .2s;
            line-height: 1.5;
        }

        .option:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        .option:has(input:checked) {
            background: #f3f4f6;
            border-color: #111827;
        }

        .option input {
            margin: 3px 0 0;
            flex-shrink: 0;
            width: 17px;
            height: 17px;
            cursor: pointer;
        }

        .submit-section {
            text-align: center;
            margin: 30px 0 50px;
        }

        .submit-btn {
            border: 0;
            border-radius: 10px;
            padding: 14px 32px;
            background: #111827;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            min-width: 190px;
        }

        .submit-btn:hover {
            opacity: .9;
        }

        .submit-btn:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .submit-note {
            margin-top: 10px;
            color: #6b7280;
            font-size: 13px;
        }

        .empty-state {
            background: #ffffff;
            border-radius: 14px;
            padding: 40px 20px;
            text-align: center;
            color: #6b7280;
        }

        @media (max-width: 700px) {

            .exam-header {
                padding: 12px 14px;
            }

            .header-inner {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }

            .exam-title {
                font-size: 19px;
            }

            .student-name {
                font-size: 13px;
            }

            .timer-box {
                width: 100%;
            }

            .timer {
                width: 100%;
                font-size: 19px;
            }

            .container {
                margin: 18px auto;
                padding: 0 12px;
            }

            .exam-info {
                padding: 15px;
            }

            .exam-info-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .question-card {
                padding: 20px 16px;
                border-radius: 12px;
            }

            .question-text {
                font-size: 17px;
                line-height: 1.55;
            }

            .option {
                padding: 13px;
                font-size: 15px;
            }

            .submit-btn {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
</head>

<body>

<header class="exam-header">

    <div class="header-inner">

        <div>
            <h1 class="exam-title">
                {{ $exam->title }}
            </h1>

            <div class="student-name">
                Student:
                {{ $examUser->name ?? 'Student' }}
            </div>
        </div>

        <div class="timer-box">

            <span class="timer-label">
                Time Remaining
            </span>

            <div
                class="timer"
                id="examTimer"
                data-expires-at="{{ $attempt->expires_at?->timestamp }}"
            >
                --:--
            </div>

        </div>

    </div>

</header>


<main class="container">

    <div class="exam-info">

        <div class="exam-info-row">

            <div class="exam-info-title">
                Answer all questions carefully.
            </div>

            <div class="progress-text">
                {{ $questions->count() }} Questions
            </div>

        </div>

    </div>


    @if($questions->isEmpty())

        <div class="empty-state">
            No questions are available for this examination.
        </div>

    @else

        <form
            method="POST"
            action="{{ route(
                'exam-user.exam.submit',
                [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ]
            ) }}"
            id="examForm"
        >

            @csrf

            @foreach($questions as $index => $answer)

                @php
                    $question = $answer->question;
                    $selectedOptionId = $answer->selected_option_id;
                @endphp

                <div class="question-card">

                    <div class="question-number">
                        Question {{ $index + 1 }}
                        of {{ $questions->count() }}
                    </div>

                    <div class="question-text">
                        {!! nl2br(
                            e(
                                $question->question_text
                                ?? $question->question
                                ?? 'Question'
                            )
                        ) !!}
                    </div>


                    @foreach($question->options as $option)

                        <label class="option">

                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}"
                                @checked(
                                    (int) $selectedOptionId ===
                                    (int) $option->id
                                )
                            >

                            <span>
                                {{ $option->option_text }}
                            </span>

                        </label>

                    @endforeach

                </div>

            @endforeach


            <div class="submit-section">

                <button
                    type="submit"
                    class="submit-btn"
                    id="submitButton"
                >
                    Submit Exam
                </button>

                <div class="submit-note">
                    Once submitted, your answers cannot be changed.
                </div>

            </div>

        </form>

    @endif

</main>


<script>

    const timerElement =
        document.getElementById('examTimer');

    const examForm =
        document.getElementById('examForm');

    const submitButton =
        document.getElementById('submitButton');

    if (timerElement && examForm && submitButton) {

        const expiresTimestamp =
            Number(timerElement.dataset.expiresAt);

        const expiresAt =
            expiresTimestamp * 1000;

        let isSubmitting = false;

        function submitExam() {

            if (isSubmitting) {
                return;
            }

            isSubmitting = true;

            submitButton.disabled = true;

            submitButton.textContent =
                'Submitting...';

            examForm.submit();
        }

        function updateTimer() {

            const now = Date.now();

            const remaining =
                Math.max(
                    0,
                    expiresAt - now
                );

            const totalSeconds =
                Math.floor(
                    remaining / 1000
                );

            const minutes =
                Math.floor(
                    totalSeconds / 60
                );

            const seconds =
                totalSeconds % 60;

            timerElement.textContent =
                String(minutes).padStart(2, '0')
                + ':'
                + String(seconds).padStart(2, '0');


            /*
            |--------------------------------------------------------------------------
            | Timer warning states
            |--------------------------------------------------------------------------
            */

            timerElement.classList.remove(
                'warning',
                'danger'
            );

            if (totalSeconds <= 60) {

                timerElement.classList.add(
                    'danger'
                );

            } else if (totalSeconds <= 300) {

                timerElement.classList.add(
                    'warning'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Auto submit when time expires
            |--------------------------------------------------------------------------
            */

            if (totalSeconds <= 0) {

                clearInterval(timerInterval);

                timerElement.textContent =
                    '00:00';

                submitExam();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent accidental double submit
        |--------------------------------------------------------------------------
        */

        examForm.addEventListener(
            'submit',
            function () {

                if (!isSubmitting) {

                    isSubmitting = true;

                    submitButton.disabled = true;

                    submitButton.textContent =
                        'Submitting...';
                }
            }
        );


        updateTimer();

        const timerInterval =
            setInterval(
                updateTimer,
                1000
            );
    }

</script>

</body>
</html>