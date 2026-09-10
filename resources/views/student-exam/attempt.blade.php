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
            padding: 18px 24px;
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

        .timer {
            min-width: 130px;
            padding: 12px 18px;
            border-radius: 10px;
            background: #111827;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
        }

        .container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .question-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 28px;
            margin-bottom: 20px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .question-number {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .question-text {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 22px;
            font-weight: 600;
        }

        .option {
            display: block;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: 0.2s;
        }

        .option:hover {
            background: #f9fafb;
        }

        .option input {
            margin-right: 10px;
        }

        .submit-section {
            text-align: center;
            margin: 30px 0 50px;
        }

        .submit-btn {
            border: 0;
            border-radius: 10px;
            padding: 14px 30px;
            background: #111827;
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        @media (max-width: 700px) {
            .header-inner {
                align-items: flex-start;
                flex-direction: column;
            }

            .timer {
                width: 100%;
            }

            .question-card {
                padding: 20px;
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
                {{ $student->full_name }}
            </div>
        </div>

        <div
            class="timer"
            id="examTimer"
            data-expires-at="{{ $attempt->expires_at?->timestamp }}"
        >
            --:--
        </div>

    </div>

</header>


<main class="container">

   <form
    method="POST"
    action="/exam/{{ $exam->id }}/attempt/{{ $attempt->id }}/submit"
    id="examForm"
>

        @csrf

        @foreach($questions as $index => $answer)

            @php
                $question = $answer->question;
            @endphp

            <div class="question-card">

                <div class="question-number">
                    Question {{ $index + 1 }}
                    of {{ $questions->count() }}
                </div>

                <div class="question-text">
                    {!! nl2br(e($question->question_text ?? $question->question ?? 'Question')) !!}
                </div>

                @foreach($question->options as $option)

                    <label class="option">

                        <input
                            type="radio"
                            name="answers[{{ $question->id }}]"
                            value="{{ $option->id }}"
                        >

                        {{ $option->option_text }}

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

        </div>

    </form>

</main>


<script>

    const timerElement =
        document.getElementById('examTimer');

    const examForm =
        document.getElementById('examForm');

    const submitButton =
        document.getElementById('submitButton');

    const expiresAt =
        Number(timerElement.dataset.expiresAt) * 1000;

    let isSubmitting = false;

    function submitExam() {

        if (isSubmitting) {
            return;
        }

        isSubmitting = true;

        submitButton.disabled = true;

        examForm.submit();
    }

    function updateTimer() {

        const now = Date.now();

        const remaining =
            Math.max(0, expiresAt - now);

        const totalSeconds =
            Math.floor(remaining / 1000);

        const minutes =
            Math.floor(totalSeconds / 60);

        const seconds =
            totalSeconds % 60;

        timerElement.textContent =
            String(minutes).padStart(2, '0')
            + ':'
            + String(seconds).padStart(2, '0');

        if (totalSeconds <= 0) {

            clearInterval(timerInterval);

            timerElement.textContent =
                '00:00';

            alert(
                'Your exam time has expired. Your answers will now be submitted.'
            );

            submitExam();
        }
    }

    examForm.addEventListener(
        'submit',
        function () {
            if (!isSubmitting) {
                isSubmitting = true;
                submitButton.disabled = true;
            }
        }
    );

    updateTimer();

    const timerInterval =
        setInterval(updateTimer, 1000);

</script>

</body>
</html>
