<x-layouts::examination :title="'Edit Question — ' . $question->question_text">

    <style>
        .edit-question-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at 85% 0%, rgba(99,102,241,.07), transparent 30rem),
                #09090b;
            color: #fafafa;
        }

        .eq-container {
            width: min(1180px, calc(100% - 30px));
            margin: auto;
            padding: 28px 0 55px;
        }

        .eq-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .eq-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 9px;
            color: #71717a;
            font-size: 11px;
        }

        .eq-breadcrumb a {
            color: #a1a1aa;
            text-decoration: none;
        }

        .eq-breadcrumb a:hover {
            color: #c4b5fd;
        }

        .eq-title-row {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .eq-icon {
            width: 48px;
            height: 48px;
            flex: 0 0 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(99,102,241,.11);
            border: 1px solid rgba(129,140,248,.18);
            color: #a5b4fc;
        }

        .eq-title {
            margin: 0;
            color: #fafafa;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 750;
            letter-spacing: -.025em;
        }

        .eq-subtitle {
            margin: 5px 0 0;
            color: #71717a;
            font-size: 12px;
        }

        .eq-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 285px;
            gap: 18px;
            align-items: start;
        }

        .eq-card,
        .eq-sidebar-card {
            overflow: hidden;
            border: 1px solid #29292f;
            border-radius: 18px;
            background: #111113;
            box-shadow: 0 20px 50px rgba(0,0,0,.14);
        }

        .eq-card + .eq-card {
            margin-top: 16px;
        }

        .eq-card-header,
        .eq-sidebar-header {
            padding: 18px 20px;
            border-bottom: 1px solid #27272a;
        }

        .eq-card-title,
        .eq-sidebar-header h3 {
            margin: 0;
            color: #f4f4f5;
            font-size: 14px;
            font-weight: 700;
        }

        .eq-card-help,
        .eq-sidebar-header p {
            margin: 4px 0 0;
            color: #71717a;
            font-size: 10px;
        }

        .eq-card-body,
        .eq-sidebar-body {
            padding: 20px;
        }

        .eq-field {
            margin-bottom: 20px;
        }

        .eq-field:last-child {
            margin-bottom: 0;
        }

        .eq-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .eq-label {
            color: #e4e4e7;
            font-size: 11px;
            font-weight: 700;
        }

        .eq-required {
            color: #52525b;
            font-size: 9px;
        }

        .eq-input,
        .eq-select,
        .eq-textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #303038;
            border-radius: 11px;
            background: #0c0c0f;
            color: #f4f4f5;
            outline: none;
            font-family: inherit;
            font-size: 12px;
            transition: .2s ease;
        }

        .eq-input,
        .eq-select {
            height: 44px;
            padding: 0 13px;
        }

        .eq-textarea {
            min-height: 145px;
            padding: 13px;
            resize: vertical;
            line-height: 1.65;
        }

        .eq-input:focus,
        .eq-select:focus,
        .eq-textarea:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99,102,241,.10);
        }

        .eq-input::placeholder,
        .eq-textarea::placeholder {
            color: #52525b;
        }

        .eq-select-wrap {
            position: relative;
        }

        .eq-select {
            appearance: none;
            cursor: pointer;
            padding-right: 40px;
        }

        .eq-select-arrow {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #71717a;
        }

        .eq-options-box {
            padding: 15px;
            border: 1px solid #29292f;
            border-radius: 13px;
            background: #0c0c0f;
        }

        .eq-options-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .eq-options-title {
            color: #e4e4e7;
            font-size: 11px;
            font-weight: 700;
        }

        .eq-options-help {
            margin-top: 3px;
            color: #52525b;
            font-size: 9px;
        }

        .eq-add-option {
            height: 34px;
            padding: 0 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            border: 1px solid #34343c;
            border-radius: 9px;
            background: #18181b;
            color: #c4b5fd;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .eq-add-option:hover {
            border-color: #6366f1;
            background: #222229;
        }

        .eq-option-list {
            display: grid;
            gap: 9px;
        }

        .eq-option {
            display: grid;
            grid-template-columns: 30px 18px minmax(0,1fr) 32px;
            align-items: center;
            gap: 9px;
        }

        .eq-option-number {
            width: 30px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #18181b;
            border: 1px solid #29292f;
            color: #71717a;
            font-size: 10px;
            font-weight: 800;
        }

        .eq-option-radio {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .eq-remove-option {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #52525b;
            cursor: pointer;
            font-size: 18px;
        }

        .eq-remove-option:hover {
            background: rgba(239,68,68,.08);
            color: #f87171;
        }

        .eq-correct-note {
            margin-top: 10px;
            padding: 9px 11px;
            border-radius: 9px;
            background: rgba(99,102,241,.06);
            border: 1px solid rgba(99,102,241,.12);
            color: #818cf8;
            font-size: 9px;
        }

        .eq-answer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .eq-answer-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .eq-answer-label {
            min-height: 45px;
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 0 13px;
            border: 1px solid #29292f;
            border-radius: 11px;
            background: #0c0c0f;
            color: #d4d4d8;
            font-size: 11px;
            font-weight: 650;
            cursor: pointer;
        }

        .eq-answer-option input:checked + .eq-answer-label {
            border-color: rgba(99,102,241,.60);
            background: rgba(99,102,241,.08);
            color: #a5b4fc;
        }

        .eq-answer-dot {
            width: 15px;
            height: 15px;
            border: 1px solid #52525b;
            border-radius: 50%;
            position: relative;
        }

        .eq-answer-option input:checked + .eq-answer-label .eq-answer-dot {
            border-color: #6366f1;
        }

        .eq-answer-option input:checked + .eq-answer-label .eq-answer-dot::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: #6366f1;
        }

        .eq-settings-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .eq-status-box {
            margin-top: 17px;
            padding: 13px;
            border: 1px solid #29292f;
            border-radius: 11px;
            background: #0c0c0f;
        }

        .eq-status-label {
            margin-bottom: 8px;
            color: #e4e4e7;
            font-size: 11px;
            font-weight: 700;
        }

        .eq-status-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .eq-status-row input {
            width: 16px;
            height: 16px;
            accent-color: #6366f1;
        }

        .eq-status-row label {
            color: #a1a1aa;
            font-size: 11px;
            cursor: pointer;
        }

        .eq-info {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #222226;
        }

        .eq-info:last-child {
            border-bottom: 0;
        }

        .eq-info-label {
            color: #71717a;
            font-size: 10px;
        }

        .eq-info-value {
            max-width: 155px;
            color: #e4e4e7;
            font-size: 10px;
            font-weight: 650;
            text-align: right;
            word-break: break-word;
        }

        .eq-tip {
            padding: 12px;
            border-radius: 11px;
            border: 1px solid rgba(99,102,241,.14);
            background: rgba(99,102,241,.05);
        }

        .eq-tip + .eq-tip {
            margin-top: 9px;
        }

        .eq-tip-title {
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 700;
        }

        .eq-tip-text {
            margin-top: 5px;
            color: #71717a;
            font-size: 9px;
            line-height: 1.6;
        }

        .eq-error {
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid rgba(239,68,68,.22);
            border-radius: 12px;
            background: rgba(239,68,68,.05);
        }

        .eq-error-title {
            color: #fca5a5;
            font-size: 11px;
            font-weight: 700;
        }

        .eq-error ul {
            margin: 7px 0 0;
            padding-left: 17px;
            color: #f87171;
            font-size: 10px;
            line-height: 1.7;
        }

        .eq-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 16px;
            padding: 13px;
            border: 1px solid #29292f;
            border-radius: 15px;
            background: #111113;
        }

        .eq-btn {
            min-height: 42px;
            padding: 0 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        .eq-btn-secondary {
            border: 1px solid #303038;
            background: #0d0d0f;
            color: #a1a1aa;
        }

        .eq-btn-primary {
            border: 1px solid #6366f1;
            background: linear-gradient(135deg,#4f46e5,#6366f1);
            color: white;
            box-shadow: 0 7px 20px rgba(79,70,229,.18);
        }

        @media (max-width: 900px) {
            .eq-layout {
                grid-template-columns: 1fr;
            }

            .eq-sidebar {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 14px;
            }
        }

        @media (max-width: 640px) {
            .eq-container {
                width: calc(100% - 22px);
                padding-top: 20px;
            }

            .eq-header {
                align-items: stretch;
                flex-direction: column;
            }

            .eq-title {
                font-size: 23px;
            }

            .eq-card-header,
            .eq-card-body,
            .eq-sidebar-header,
            .eq-sidebar-body {
                padding: 16px;
            }

            .eq-sidebar {
                display: block;
            }

            .eq-sidebar-card + .eq-sidebar-card {
                margin-top: 14px;
            }

            .eq-settings-grid,
            .eq-answer-grid {
                grid-template-columns: 1fr;
            }

            .eq-options-head {
                align-items: stretch;
                flex-direction: column;
            }

            .eq-add-option {
                width: 100%;
            }

            .eq-actions {
                flex-direction: column-reverse;
            }

            .eq-btn {
                width: 100%;
            }
        }

        @media (max-width: 430px) {
            .eq-option {
                grid-template-columns: 27px 17px minmax(0,1fr) 28px;
                gap: 6px;
            }

            .eq-option-number {
                width: 27px;
            }

            .eq-remove-option {
                width: 28px;
            }
        }
    </style>

    @php
        $questionType = old(
            'question_type',
            $question->question_type ?? 'mcq'
        );

        $oldOptions = old('options');

        if ($oldOptions === null) {
            $oldOptions = $question->options
                ->map(function ($option) {
                    return [
                        'text' => $option->option_text,
                        'is_correct' => (bool) $option->is_correct,
                    ];
                })
                ->values()
                ->toArray();
        }

        if (count($oldOptions) === 0) {
            $oldOptions = [
                ['text' => ''],
                ['text' => ''],
            ];
        }

        if (count($oldOptions) > 6) {
            $oldOptions = array_slice($oldOptions, 0, 6);
        }

        $oldCorrect = old('correct_option');

        if ($oldCorrect === null) {
            $correctIndex = $question->options
                ->values()
                ->search(function ($option) {
                    return (bool) $option->is_correct;
                });

            $oldCorrect = $correctIndex === false
                ? null
                : $correctIndex;
        }

        $trueFalseAnswer = old('tf_answer');

        if ($trueFalseAnswer === null && $questionType === 'true_false') {
            $trueOption = $question->options
                ->first(function ($option) {
                    return strtolower(trim($option->option_text)) === 'true';
                });

            $falseOption = $question->options
                ->first(function ($option) {
                    return strtolower(trim($option->option_text)) === 'false';
                });

            if ($trueOption && $trueOption->is_correct) {
                $trueFalseAnswer = 'true';
            } elseif ($falseOption && $falseOption->is_correct) {
                $trueFalseAnswer = 'false';
            }
        }
    @endphp

    <div class="edit-question-page">

        <div class="eq-container">

            <div class="eq-header">
                <div>

                    <div class="eq-breadcrumb">
                        <a href="{{ route('exam-subjects.index') }}">
                            Subjects
                        </a>

                        <span>›</span>

                        <a href="{{ route('exam-topics.index', $subject) }}">
                            {{ $subject->name }}
                        </a>

                        <span>›</span>

                        <a href="{{ route('exam-questions.index', [$subject, $topic]) }}">
                            {{ $topic->name }}
                        </a>

                        <span>›</span>

                        <span>Edit Question</span>
                    </div>

                    <div class="eq-title-row">

                        <div class="eq-icon">
                            <svg
                                width="22"
                                height="22"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M12 20h9"/>
                                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                            </svg>
                        </div>

                        <div>
                            <h1 class="eq-title">
                                Edit Question
                            </h1>

                            <p class="eq-subtitle">
                                Update question
                                <strong style="color:#a5b4fc;">
                                    #{{ $question->sort_order }}
                                </strong>
                                in {{ $topic->name }}
                            </p>
                        </div>

                    </div>

                </div>

                <a
                    href="{{ route('exam-questions.index', [$subject, $topic]) }}"
                    class="eq-btn eq-btn-secondary"
                >
                    ← Back to Questions
                </a>
            </div>

            @if($errors->any())
                <div class="eq-error">
                    <div class="eq-error-title">
                        Please fix the following:
                    </div>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('exam-questions.update', [$subject, $topic, $question]) }}"
                id="editQuestionForm"
            >
                @csrf
                @method('PUT')

                <div class="eq-layout">

                    <div>

                        <div class="eq-card">

                            <div class="eq-card-header">
                                <h2 class="eq-card-title">
                                    Question Details
                                </h2>

                                <p class="eq-card-help">
                                    Update the question students will see.
                                </p>
                            </div>

                            <div class="eq-card-body">

                                <div class="eq-field">
                                    <div class="eq-label-row">
                                        <label
                                            for="question_text"
                                            class="eq-label"
                                        >
                                            Question
                                        </label>

                                        <span class="eq-required">
                                            Required
                                        </span>
                                    </div>

                                    <textarea
                                        id="question_text"
                                        name="question_text"
                                        class="eq-textarea"
                                        maxlength="10000"
                                        required
                                        placeholder="Enter the question..."
                                    >{{ old('question_text', $question->question_text) }}</textarea>
                                </div>

                                <div class="eq-field">

                                    <div class="eq-label-row">
                                        <label
                                            for="question_type"
                                            class="eq-label"
                                        >
                                            Question Type
                                        </label>

                                        <span class="eq-required">
                                            Required
                                        </span>
                                    </div>

                                    <div class="eq-select-wrap">

                                        <select
                                            id="question_type"
                                            name="question_type"
                                            class="eq-select"
                                            required
                                        >
                                            <option
                                                value="mcq"
                                                @selected($questionType === 'mcq')
                                            >
                                                Multiple Choice (MCQ)
                                            </option>

                                            <option
                                                value="true_false"
                                                @selected($questionType === 'true_false')
                                            >
                                                True / False
                                            </option>
                                        </select>

                                        <svg
                                            class="eq-select-arrow"
                                            width="15"
                                            height="15"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>

                                    </div>

                                </div>

                                <div
                                    id="mcqOptions"
                                    class="eq-field"
                                >
                                    <div class="eq-options-box">

                                        <div class="eq-options-head">

                                            <div>
                                                <div class="eq-options-title">
                                                    Answer Options
                                                </div>

                                                <div class="eq-options-help">
                                                    Select one correct answer. Maximum 6 options.
                                                </div>
                                            </div>

                                            <button
                                                type="button"
                                                class="eq-add-option"
                                                id="addOption"
                                            >
                                                + Add Option
                                            </button>

                                        </div>

                                        <div
                                            id="optionList"
                                            class="eq-option-list"
                                        >

                                            @foreach($oldOptions as $index => $option)

                                                <div class="eq-option">

                                                    <div class="eq-option-number">
                                                        {{ chr(65 + $index) }}
                                                    </div>

                                                    <input
                                                        type="radio"
                                                        name="correct_option"
                                                        value="{{ $index }}"
                                                        class="eq-option-radio"
                                                        @checked((string) $oldCorrect === (string) $index)
                                                        title="Mark as correct answer"
                                                    >

                                                    <input
                                                        type="text"
                                                        name="options[{{ $index }}][text]"
                                                        value="{{ $option['text'] ?? '' }}"
                                                        class="eq-input"
                                                        maxlength="2000"
                                                        placeholder="Option {{ chr(65 + $index) }}"
                                                    >

                                                    <button
                                                        type="button"
                                                        class="eq-remove-option"
                                                        title="Remove option"
                                                        style="{{ $index < 2 ? 'visibility:hidden;' : '' }}"
                                                    >
                                                        ×
                                                    </button>

                                                </div>

                                            @endforeach

                                        </div>

                                        <div class="eq-correct-note">
                                            Select the circle beside an option to mark it as correct.
                                            Minimum 2 and maximum 6 options.
                                        </div>

                                    </div>
                                </div>

                                <div
                                    id="trueFalseOptions"
                                    class="eq-field"
                                    style="display:none;"
                                >

                                    <div class="eq-options-box">

                                        <div class="eq-label-row">
                                            <span class="eq-label">
                                                Correct Answer
                                            </span>

                                            <span class="eq-required">
                                                Required
                                            </span>
                                        </div>

                                        <div class="eq-answer-grid">

                                            <div class="eq-answer-option">
                                                <input
                                                    type="radio"
                                                    id="tfTrue"
                                                    name="tf_answer"
                                                    value="true"
                                                    @checked($trueFalseAnswer === 'true')
                                                >

                                                <label
                                                    for="tfTrue"
                                                    class="eq-answer-label"
                                                >
                                                    <span class="eq-answer-dot"></span>
                                                    True
                                                </label>
                                            </div>

                                            <div class="eq-answer-option">
                                                <input
                                                    type="radio"
                                                    id="tfFalse"
                                                    name="tf_answer"
                                                    value="false"
                                                    @checked($trueFalseAnswer === 'false')
                                                >

                                                <label
                                                    for="tfFalse"
                                                    class="eq-answer-label"
                                                >
                                                    <span class="eq-answer-dot"></span>
                                                    False
                                                </label>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="eq-field">

                                    <div class="eq-label-row">
                                        <label
                                            for="difficulty"
                                            class="eq-label"
                                        >
                                            Difficulty
                                        </label>

                                        <span class="eq-required">
                                            Required
                                        </span>
                                    </div>

                                    <div class="eq-select-wrap">

                                        <select
                                            id="difficulty"
                                            name="difficulty"
                                            class="eq-select"
                                            required
                                        >
                                            <option
                                                value="Easy"
                                                @selected(old('difficulty', $question->difficulty) === 'Easy')
                                            >
                                                Easy
                                            </option>

                                            <option
                                                value="Medium"
                                                @selected(old('difficulty', $question->difficulty) === 'Medium')
                                            >
                                                Medium
                                            </option>

                                            <option
                                                value="Hard"
                                                @selected(old('difficulty', $question->difficulty) === 'Hard')
                                            >
                                                Hard
                                            </option>
                                        </select>

                                        <svg
                                            class="eq-select-arrow"
                                            width="15"
                                            height="15"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                        >
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>

                                    </div>

                                </div>

                                <div class="eq-field">

                                    <div class="eq-label-row">
                                        <label
                                            for="explanation"
                                            class="eq-label"
                                        >
                                            Explanation
                                        </label>

                                        <span class="eq-required">
                                            Optional
                                        </span>
                                    </div>

                                    <textarea
                                        id="explanation"
                                        name="explanation"
                                        class="eq-textarea"
                                        maxlength="10000"
                                        placeholder="Explain the correct answer..."
                                    >{{ old('explanation', $question->explanation) }}</textarea>

                                </div>

                            </div>

                        </div>

                        <div class="eq-card">

                            <div class="eq-card-header">
                                <h2 class="eq-card-title">
                                    Scoring Settings
                                </h2>

                                <p class="eq-card-help">
                                    Update how this question affects the final score.
                                </p>
                            </div>

                            <div class="eq-card-body">

                                <div class="eq-settings-grid">

                                    <div>
                                        <div class="eq-label-row">
                                            <label
                                                for="marks"
                                                class="eq-label"
                                            >
                                                Marks
                                            </label>

                                            <span class="eq-required">
                                                Required
                                            </span>
                                        </div>

                                        <input
                                            id="marks"
                                            type="number"
                                            name="marks"
                                            min="0"
                                            max="999999.99"
                                            step="0.01"
                                            class="eq-input"
                                            value="{{ old('marks', $question->marks) }}"
                                            required
                                        >
                                    </div>

                                    <div>
                                        <div class="eq-label-row">
                                            <label
                                                for="negative_marks"
                                                class="eq-label"
                                            >
                                                Negative Marks
                                            </label>

                                            <span class="eq-required">
                                                Optional
                                            </span>
                                        </div>

                                        <input
                                            id="negative_marks"
                                            type="number"
                                            name="negative_marks"
                                            min="0"
                                            max="999999.99"
                                            step="0.01"
                                            class="eq-input"
                                            value="{{ old('negative_marks', $question->negative_marks) }}"
                                        >
                                    </div>

                                </div>

                                <div class="eq-status-box">

                                    <div class="eq-status-label">
                                        Question Status
                                    </div>

                                    <div class="eq-status-row">

                                        <input
                                            type="checkbox"
                                            id="is_active"
                                            name="is_active"
                                            value="1"
                                            @checked(old('is_active', $question->is_active))
                                        >

                                        <label for="is_active">
                                            Active — available for use in exams
                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="eq-actions">

                            <a
                                href="{{ route('exam-questions.index', [$subject, $topic]) }}"
                                class="eq-btn eq-btn-secondary"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="eq-btn eq-btn-primary"
                            >
                                ✓ Update Question
                            </button>

                        </div>

                    </div>

                    <aside class="eq-sidebar">

                        <div class="eq-sidebar-card">

                            <div class="eq-sidebar-header">
                                <h3>Question Information</h3>

                                <p>Current question details</p>
                            </div>

                            <div class="eq-sidebar-body">

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Subject
                                    </span>

                                    <span class="eq-info-value">
                                        {{ $subject->name }}
                                    </span>
                                </div>

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Topic
                                    </span>

                                    <span class="eq-info-value">
                                        {{ $topic->name }}
                                    </span>
                                </div>

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Question
                                    </span>

                                    <span class="eq-info-value">
                                        #{{ $question->sort_order }}
                                    </span>
                                </div>

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Type
                                    </span>

                                    <span
                                        class="eq-info-value"
                                        id="sidebarQuestionType"
                                    >
                                        {{ strtoupper(str_replace('_', ' ', $questionType)) }}
                                    </span>
                                </div>

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Options
                                    </span>

                                    <span
                                        class="eq-info-value"
                                        id="sidebarOptionCount"
                                    >
                                        {{ $question->options->count() }}
                                    </span>
                                </div>

                                <div class="eq-info">
                                    <span class="eq-info-label">
                                        Current Marks
                                    </span>

                                    <span class="eq-info-value">
                                        {{ number_format((float) $question->marks, 2) }}
                                    </span>
                                </div>

                            </div>

                        </div>

                        <div class="eq-sidebar-card">

                            <div class="eq-sidebar-header">
                                <h3>Editing Tips</h3>

                                <p>Keep the assessment consistent</p>
                            </div>

                            <div class="eq-sidebar-body">

                                <div class="eq-tip">
                                    <div class="eq-tip-title">
                                        Check the answer
                                    </div>

                                    <div class="eq-tip-text">
                                        Make sure the correct option is selected before saving.
                                    </div>
                                </div>

                                <div class="eq-tip">
                                    <div class="eq-tip-title">
                                        Review marks
                                    </div>

                                    <div class="eq-tip-text">
                                        Changing marks can affect overall exam scoring.
                                    </div>
                                </div>

                                <div class="eq-tip">
                                    <div class="eq-tip-title">
                                        True / False
                                    </div>

                                    <div class="eq-tip-text">
                                        Select exactly one correct answer. The system stores True and False as normal question options.
                                    </div>
                                </div>

                            </div>

                        </div>

                    </aside>

                </div>

            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const typeSelect =
                document.getElementById('question_type');

            const mcqOptions =
                document.getElementById('mcqOptions');

            const trueFalseOptions =
                document.getElementById('trueFalseOptions');

            const optionList =
                document.getElementById('optionList');

            const addOption =
                document.getElementById('addOption');

            const sidebarOptionCount =
                document.getElementById('sidebarOptionCount');

            const sidebarQuestionType =
                document.getElementById('sidebarQuestionType');

            const MAX_OPTIONS = 6;

            function updateQuestionType() {

                const type = typeSelect.value;

                mcqOptions.style.display =
                    type === 'mcq' ? 'block' : 'none';

                trueFalseOptions.style.display =
                    type === 'true_false' ? 'block' : 'none';

                if (sidebarQuestionType) {
                    sidebarQuestionType.textContent =
                        type
                            .replace('_', ' ')
                            .toUpperCase();
                }

                if (type === 'mcq') {
                    updateOptions();
                }
            }

            function updateOptions() {

                const options =
                    optionList.querySelectorAll('.eq-option');

                options.forEach(function (option, index) {

                    const letter =
                        String.fromCharCode(65 + index);

                    const number =
                        option.querySelector('.eq-option-number');

                    if (number) {
                        number.textContent = letter;
                    }

                    const input =
                        option.querySelector('input[type="text"]');

                    if (input) {
                        input.name =
                            `options[${index}][text]`;

                        input.placeholder =
                            `Option ${letter}`;
                    }

                    const radio =
                        option.querySelector(
                            'input[type="radio"]'
                        );

                    if (radio) {
                        radio.value = index;
                    }

                    const remove =
                        option.querySelector(
                            '.eq-remove-option'
                        );

                    if (remove) {
                        remove.style.visibility =
                            index < 2
                                ? 'hidden'
                                : 'visible';
                    }
                });

                if (sidebarOptionCount) {
                    sidebarOptionCount.textContent =
                        options.length;
                }

                addOption.disabled =
                    options.length >= MAX_OPTIONS;

                addOption.style.opacity =
                    options.length >= MAX_OPTIONS
                        ? '.45'
                        : '1';

                addOption.style.cursor =
                    options.length >= MAX_OPTIONS
                        ? 'not-allowed'
                        : 'pointer';
            }

            addOption.addEventListener(
                'click',
                function () {

                    const options =
                        optionList.querySelectorAll('.eq-option');

                    if (options.length >= MAX_OPTIONS) {
                        alert(
                            'You can add up to 6 options.'
                        );
                        return;
                    }

                    const index = options.length;

                    const letter =
                        String.fromCharCode(65 + index);

                    const wrapper =
                        document.createElement('div');

                    wrapper.className = 'eq-option';

                    wrapper.innerHTML = `
                        <div class="eq-option-number">
                            ${letter}
                        </div>

                        <input
                            type="radio"
                            name="correct_option"
                            value="${index}"
                            class="eq-option-radio"
                            title="Mark as correct answer"
                        >

                        <input
                            type="text"
                            name="options[${index}][text]"
                            class="eq-input"
                            maxlength="2000"
                            placeholder="Option ${letter}"
                        >

                        <button
                            type="button"
                            class="eq-remove-option"
                            title="Remove option"
                        >
                            ×
                        </button>
                    `;

                    optionList.appendChild(wrapper);

                    updateOptions();
                }
            );

            optionList.addEventListener(
                'click',
                function (event) {

                    const button =
                        event.target.closest(
                            '.eq-remove-option'
                        );

                    if (!button) {
                        return;
                    }

                    const options =
                        optionList.querySelectorAll('.eq-option');

                    if (options.length <= 2) {
                        alert(
                            'At least two options are required.'
                        );
                        return;
                    }

                    const option =
                        button.closest('.eq-option');

                    const radio =
                        option.querySelector(
                            'input[type="radio"]'
                        );

                    const wasChecked =
                        radio && radio.checked;

                    option.remove();

                    updateOptions();

                    if (wasChecked) {
                        const firstRadio =
                            optionList.querySelector(
                                'input[type="radio"]'
                            );

                        if (firstRadio) {
                            firstRadio.checked = true;
                        }
                    }
                }
            );

            typeSelect.addEventListener(
                'change',
                updateQuestionType
            );

            updateQuestionType();
            updateOptions();
        });
    </script>

</x-layouts::examination>