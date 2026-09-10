<x-layouts::examination :title="'Add Question — ' . $topic->name">

    <style>
        .question-page {
            min-height: 100%;
            padding: 26px;
            background:
                radial-gradient(circle at 80% 0%, rgba(117,97,255,.10), transparent 31rem),
                radial-gradient(circle at 20% 100%, rgba(80,120,255,.045), transparent 28rem);
            color: #f7f7f8;
        }

        .question-wrap {
            width: 100%;
            max-width: 1320px;
            margin: 0 auto;
        }

        .question-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .question-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .question-icon {
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
            border: 1px solid rgba(117,97,255,.24);
            background: rgba(117,97,255,.10);
            color: #9a8cff;
        }

        .question-icon svg {
            width: 24px;
            height: 24px;
        }

        .breadcrumb {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 7px;
            margin-bottom: 5px;
            font-size: 10px;
            color: #62626c;
        }

        .breadcrumb a {
            color: #858590;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            color: #9a8cff;
        }

        .page-title {
            margin: 0;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 760;
            letter-spacing: -.03em;
            color: #fff;
        }

        .page-subtitle {
            margin: 5px 0 0;
            color: #777782;
            font-size: 12px;
        }

        .highlight {
            color: #9b8fff;
            font-weight: 650;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 42px;
            padding: 0 15px;
            flex-shrink: 0;
            border: 1px solid rgba(255,255,255,.11);
            border-radius: 12px;
            background: rgba(20,20,24,.85);
            color: #c7c7ce !important;
            text-decoration: none !important;
            font-size: 11px;
            font-weight: 650;
        }

        .back-btn:hover {
            border-color: rgba(117,97,255,.30);
            background: rgba(117,97,255,.07);
            color: #fff !important;
        }

        .question-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            align-items: start;
        }

        .card,
        .side-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 20px;
            background: #121216;
            box-shadow:
                0 22px 60px rgba(0,0,0,.16),
                inset 0 1px 0 rgba(255,255,255,.018);
        }

        .card + .card,
        .side-card + .side-card {
            margin-top: 15px;
        }

        .card-head,
        .side-head {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 19px 21px;
            border-bottom: 1px solid rgba(255,255,255,.075);
        }

        .card-head-icon {
            width: 37px;
            height: 37px;
            flex: 0 0 37px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(117,97,255,.08);
            color: #9688ff;
        }

        .card-head-icon svg {
            width: 17px;
            height: 17px;
        }

        .card-title,
        .side-title {
            margin: 0;
            font-size: 13px;
            font-weight: 720;
            color: #f1f1f3;
        }

        .card-help,
        .side-subtitle {
            margin: 3px 0 0;
            font-size: 10px;
            color: #62626c;
        }

        .card-body,
        .side-body {
            padding: 21px;
        }

        .field {
            margin-bottom: 21px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .label {
            font-size: 11px;
            font-weight: 700;
            color: #d9d9de;
        }

        .required {
            font-size: 9px;
            color: #55555f;
        }

        .input,
        .select,
        .textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #303039;
            border-radius: 12px;
            outline: none;
            background: #0c0c10;
            color: #f2f2f4;
            font-family: inherit;
            font-size: 12px;
            transition: .2s ease;
        }

        .input,
        .select {
            height: 45px;
            padding: 0 13px;
        }

        .textarea {
            min-height: 150px;
            padding: 13px;
            resize: vertical;
            line-height: 1.65;
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            border-color: rgba(117,97,255,.85);
            box-shadow: 0 0 0 3px rgba(117,97,255,.09);
        }

        .select-wrap {
            position: relative;
        }

        .select {
            appearance: none;
            padding-right: 40px;
            cursor: pointer;
        }

        .select-arrow {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #666670;
        }

        .options-box {
            margin-top: 7px;
            padding: 16px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 15px;
            background: rgba(0,0,0,.10);
        }

        .options-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .options-title {
            font-size: 11px;
            font-weight: 700;
            color: #dddde2;
        }

        .options-hint {
            margin-top: 3px;
            color: #575761;
            font-size: 9px;
        }

        .add-option {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            height: 33px;
            padding: 0 11px;
            border: 1px solid rgba(117,97,255,.20);
            border-radius: 9px;
            background: rgba(117,97,255,.07);
            color: #a196ff;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .add-option:hover {
            border-color: rgba(117,97,255,.42);
            background: rgba(117,97,255,.13);
        }

        .option-list {
            display: grid;
            gap: 9px;
        }

        .option-row {
            display: grid;
            grid-template-columns: 30px 18px minmax(0,1fr) 32px;
            align-items: center;
            gap: 9px;
        }

        .option-letter {
            width: 30px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #292930;
            border-radius: 9px;
            background: #17171b;
            color: #777782;
            font-size: 10px;
            font-weight: 800;
        }

        .option-radio {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #7561ff;
            cursor: pointer;
        }

        .remove-option {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            border-radius: 9px;
            background: transparent;
            color: #4e4e58;
            cursor: pointer;
            font-size: 18px;
        }

        .remove-option:hover {
            background: rgba(255,104,116,.08);
            color: #ff6874;
        }

        .correct-note {
            margin-top: 11px;
            padding: 9px 11px;
            border: 1px solid rgba(117,97,255,.10);
            border-radius: 9px;
            background: rgba(117,97,255,.045);
            color: #7770a9;
            font-size: 9px;
        }

        .answer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .answer-option {
            position: relative;
        }

        .answer-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .answer-label {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 47px;
            padding: 0 13px;
            border: 1px solid #2d2d35;
            border-radius: 12px;
            background: #0c0c10;
            color: #c9c9cf;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
        }

        .answer-option input:checked + .answer-label {
            border-color: rgba(117,97,255,.55);
            background: rgba(117,97,255,.08);
            color: #a89fff;
        }

        .answer-dot {
            width: 16px;
            height: 16px;
            border: 1px solid #51515b;
            border-radius: 50%;
            position: relative;
        }

        .answer-option input:checked + .answer-label .answer-dot {
            border-color: #7561ff;
        }

        .answer-option input:checked + .answer-label .answer-dot::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: #7561ff;
        }

        .score-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .score-card {
            padding: 14px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 13px;
            background: rgba(0,0,0,.10);
        }

        .score-label {
            margin-bottom: 8px;
            font-size: 10px;
            font-weight: 650;
            color: #96969f;
        }

        .score-input {
            width: 100%;
            height: 42px;
            padding: 0 11px;
            box-sizing: border-box;
            border: 1px solid #303039;
            border-radius: 10px;
            background: #0b0b0e;
            color: #f5f5f6;
            outline: none;
        }

        .score-help {
            margin: 6px 0 0;
            font-size: 9px;
            color: #51515b;
        }

        .sidebar {
            display: grid;
            gap: 14px;
        }

        .side-head {
            padding: 16px;
        }

        .side-body {
            padding: 14px 16px;
        }

        .context-box {
            padding: 12px;
            border: 1px solid rgba(117,97,255,.12);
            border-radius: 12px;
            background: rgba(117,97,255,.045);
        }

        .context-label,
        .info-label {
            font-size: 9px;
            color: #686872;
        }

        .context-value {
            margin-top: 4px;
            font-size: 11px;
            font-weight: 700;
            color: #d8d8dd;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,.045);
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-value {
            font-size: 10px;
            font-weight: 650;
            color: #cfcfd5;
            text-align: right;
        }

        .tip {
            padding: 12px;
            border: 1px solid rgba(117,97,255,.11);
            border-radius: 12px;
            background: rgba(117,97,255,.04);
        }

        .tip + .tip {
            margin-top: 9px;
        }

        .tip-title {
            color: #9e93ff;
            font-size: 10px;
            font-weight: 700;
        }

        .tip-text {
            margin-top: 5px;
            color: #676771;
            font-size: 9px;
            line-height: 1.65;
        }

        .errors {
            margin-bottom: 16px;
            padding: 13px 15px;
            border: 1px solid rgba(255,104,116,.17);
            border-radius: 14px;
            background: rgba(255,104,116,.055);
        }

        .errors-title {
            margin: 0;
            font-size: 11px;
            font-weight: 700;
            color: #ff9aa2;
        }

        .errors ul {
            margin: 5px 0 0;
            padding-left: 15px;
            color: #d46a73;
            font-size: 9px;
            line-height: 1.65;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 15px;
            padding: 14px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 17px;
            background: rgba(18,18,22,.90);
        }

        .action-note {
            color: #55555f;
            font-size: 9px;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 16px;
            border-radius: 11px;
            font-family: inherit;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-cancel {
            border: 1px solid #303039;
            background: #0d0d10;
            color: #a0a0aa !important;
        }

        .btn-save {
            border: 1px solid rgba(117,97,255,.55);
            background: linear-gradient(135deg,#7561ff,#5d49e9);
            color: #fff !important;
        }

        @media (max-width: 1050px) {
            .question-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 720px) {
            .question-page {
                padding: 15px;
            }

            .question-header {
                align-items: stretch;
                flex-direction: column;
            }

            .back-btn {
                width: 100%;
            }

            .sidebar {
                display: block;
            }

            .side-card + .side-card {
                margin-top: 13px;
            }

            .score-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                align-items: stretch;
                flex-direction: column;
            }

            .action-buttons {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 470px) {
            .question-page {
                padding: 11px;
            }

            .page-title {
                font-size: 21px;
            }

            .options-head {
                align-items: stretch;
                flex-direction: column;
            }

            .add-option {
                width: 100%;
            }

            .option-row {
                grid-template-columns: 27px 17px minmax(0,1fr) 28px;
                gap: 7px;
            }

            .option-letter {
                width: 27px;
            }

            .remove-option {
                width: 28px;
            }

            .answer-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="question-page">
        <div class="question-wrap">

            <div class="question-header">
                <div class="question-header-left">

                    <div class="question-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"
                            />
                        </svg>
                    </div>

                    <div class="min-w-0">
                        <div class="breadcrumb">
                            <a href="{{ route('exam-subjects.index') }}">Subjects</a>
                            <span>›</span>

                            <a href="{{ route('exam-topics.index', $subject) }}">
                                {{ $subject->name }}
                            </a>

                            <span>›</span>

                            <a href="{{ route('exam-questions.index', [$subject, $topic]) }}">
                                {{ $topic->name }}
                            </a>

                            <span>›</span>
                            <span>Add Question</span>
                        </div>

                        <h1 class="page-title">Add Question</h1>

                        <p class="page-subtitle">
                            Create a question for
                            <span class="highlight">{{ $topic->name }}</span>
                        </p>
                    </div>
                </div>

                <a
                    href="{{ route('exam-questions.index', [$subject, $topic]) }}"
                    class="back-btn"
                >
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>
                    Back to Questions
                </a>
            </div>

            @if ($errors->any())
                <div class="errors">
                    <p class="errors-title">Please fix the following errors</p>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('exam-questions.store', [$subject, $topic]) }}"
                id="questionForm"
            >
                @csrf

                <div class="question-layout">

                    <div>

                        <div class="card">
                            <div class="card-head">

                                <div class="card-head-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M4 6h16M4 12h16M4 18h10"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="card-title">Question Details</h2>
                                    <p class="card-help">
                                        Write the question and choose how students will answer it.
                                    </p>
                                </div>

                            </div>

                            <div class="card-body">

                                <div class="field">
                                    <div class="label-row">
                                        <label for="question_text" class="label">
                                            Question
                                        </label>

                                        <span class="required">Required</span>
                                    </div>

                                    <textarea
                                        id="question_text"
                                        name="question_text"
                                        class="textarea"
                                        placeholder="Type your question here..."
                                        required
                                    >{{ old('question_text') }}</textarea>
                                </div>

                                <div class="field">
                                    <div class="label-row">
                                        <label for="question_type" class="label">
                                            Question Type
                                        </label>

                                        <span class="required">Required</span>
                                    </div>

                                    <div class="select-wrap">
                                        <select
                                            id="question_type"
                                            name="question_type"
                                            class="select"
                                            required
                                        >
                                            <option
                                                value="mcq"
                                                @selected(old('question_type', 'mcq') === 'mcq')
                                            >
                                                Multiple Choice (MCQ)
                                            </option>

                                            <option
                                                value="true_false"
                                                @selected(old('question_type') === 'true_false')
                                            >
                                                True / False
                                            </option>
                                        </select>

                                        <svg
                                            class="select-arrow"
                                            width="15"
                                            height="15"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="label-row">
                                        <label for="difficulty" class="label">
                                            Difficulty
                                        </label>

                                        <span class="required">Required</span>
                                    </div>

                                    <div class="select-wrap">
                                        <select
                                            id="difficulty"
                                            name="difficulty"
                                            class="select"
                                            required
                                        >
                                            <option
                                                value="Easy"
                                                @selected(old('difficulty', 'Medium') === 'Easy')
                                            >
                                                Easy
                                            </option>

                                            <option
                                                value="Medium"
                                                @selected(old('difficulty', 'Medium') === 'Medium')
                                            >
                                                Medium
                                            </option>

                                            <option
                                                value="Hard"
                                                @selected(old('difficulty', 'Medium') === 'Hard')
                                            >
                                                Hard
                                            </option>
                                        </select>

                                        <svg
                                            class="select-arrow"
                                            width="15"
                                            height="15"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path d="m6 9 6 6 6-6"/>
                                        </svg>
                                    </div>
                                </div>

                                <div id="mcqOptions" class="field">
                                    <div class="options-box">

                                        <div class="options-head">
                                            <div>
                                                <div class="options-title">
                                                    Answer Options
                                                </div>

                                                <div class="options-hint">
                                                    Select one option as the correct answer. Maximum 6 options.
                                                </div>
                                            </div>

                                            <button
                                                type="button"
                                                class="add-option"
                                                id="addOption"
                                            >
                                                <span>+</span>
                                                Add Option
                                            </button>
                                        </div>

                                        <div id="optionList" class="option-list">

                                            @php
                                                $oldOptions = old('options', [
                                                    ['text' => ''],
                                                    ['text' => ''],
                                                    ['text' => ''],
                                                    ['text' => ''],
                                                ]);

                                                $oldCorrect = old('correct_option');
                                            @endphp

                                            @foreach($oldOptions as $index => $option)
                                                <div class="option-row">

                                                    <div class="option-letter">
                                                        {{ chr(65 + $index) }}
                                                    </div>

                                                    <input
                                                        type="radio"
                                                        class="option-radio"
                                                        name="correct_option"
                                                        value="{{ $index }}"
                                                        @checked((string) $oldCorrect === (string) $index)
                                                        title="Mark as correct answer"
                                                    >

                                                    <input
                                                        type="text"
                                                        name="options[{{ $index }}][text]"
                                                        value="{{ $option['text'] ?? '' }}"
                                                        class="input"
                                                        placeholder="Option {{ chr(65 + $index) }}"
                                                    >

                                                    @if($index >= 2)
                                                        <button
                                                            type="button"
                                                            class="remove-option"
                                                            title="Remove option"
                                                        >
                                                            ×
                                                        </button>
                                                    @else
                                                        <div></div>
                                                    @endif

                                                </div>
                                            @endforeach

                                        </div>

                                        <div class="correct-note">
                                            Select the circle beside an option to mark it as the correct answer.
                                        </div>

                                    </div>
                                </div>

                                <div
                                    id="trueFalseOptions"
                                    class="field"
                                    style="display:none;"
                                >
                                    <div class="options-box">

                                        <div class="label-row">
                                            <span class="label">Correct Answer</span>
                                            <span class="required">Required</span>
                                        </div>

                                        <div class="answer-grid">

                                            <div class="answer-option">
                                                <input
                                                    type="radio"
                                                    id="answerTrue"
                                                    name="tf_answer"
                                                    value="true"
                                                    @checked(old('tf_answer') === 'true')
                                                >

                                                <label
                                                    for="answerTrue"
                                                    class="answer-label"
                                                >
                                                    <span class="answer-dot"></span>
                                                    True
                                                </label>
                                            </div>

                                            <div class="answer-option">
                                                <input
                                                    type="radio"
                                                    id="answerFalse"
                                                    name="tf_answer"
                                                    value="false"
                                                    @checked(old('tf_answer') === 'false')
                                                >

                                                <label
                                                    for="answerFalse"
                                                    class="answer-label"
                                                >
                                                    <span class="answer-dot"></span>
                                                    False
                                                </label>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="field">
                                    <div class="label-row">
                                        <label for="explanation" class="label">
                                            Explanation
                                        </label>

                                        <span class="required">Optional</span>
                                    </div>

                                    <textarea
                                        id="explanation"
                                        name="explanation"
                                        class="textarea"
                                        style="min-height:120px;"
                                        placeholder="Explain why this answer is correct..."
                                    >{{ old('explanation') }}</textarea>
                                </div>

                            </div>
                        </div>

                        <div class="card">
                            <div class="card-head">

                                <div class="card-head-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M12 8v8m-4-4h8M4 5h16M4 19h16"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="card-title">Scoring Settings</h2>
                                    <p class="card-help">
                                        Decide how this question affects the score.
                                    </p>
                                </div>

                            </div>

                            <div class="card-body">
                                <div class="score-grid">

                                    <div class="score-card">
                                        <div class="score-label">Marks</div>

                                        <input
                                            id="marks"
                                            type="number"
                                            name="marks"
                                            min="0"
                                            step="0.01"
                                            value="{{ old('marks', 1) }}"
                                            class="score-input"
                                            required
                                        >

                                        <p class="score-help">
                                            Points awarded for the correct answer.
                                        </p>
                                    </div>

                                    <div class="score-card">
                                        <div class="score-label">Negative Marks</div>

                                        <input
                                            id="negative_marks"
                                            type="number"
                                            name="negative_marks"
                                            min="0"
                                            step="0.01"
                                            value="{{ old('negative_marks', 0) }}"
                                            class="score-input"
                                        >

                                        <p class="score-help">
                                            Points deducted for an incorrect answer.
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="actions">

                            <div class="action-note">
                                Your question will be added to this topic.
                            </div>

                            <div class="action-buttons">

                                <a
                                    href="{{ route('exam-questions.index', [$subject, $topic]) }}"
                                    class="btn btn-cancel"
                                >
                                    Cancel
                                </a>

                                <button
                                    type="submit"
                                    class="btn btn-save"
                                >
                                    <svg
                                        width="15"
                                        height="15"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>

                                    Save Question
                                </button>

                            </div>
                        </div>

                    </div>

                    <aside class="sidebar">

                        <div class="side-card">

                            <div class="side-head">
                                <div>
                                    <h3 class="side-title">Question Context</h3>
                                    <p class="side-subtitle">
                                        Where this question belongs
                                    </p>
                                </div>
                            </div>

                            <div class="side-body">

                                <div class="context-box">
                                    <div class="context-label">Subject</div>

                                    <div class="context-value">
                                        {{ $subject->name }}
                                    </div>
                                </div>

                                <div
                                    class="context-box"
                                    style="margin-top:10px;"
                                >
                                    <div class="context-label">Topic</div>

                                    <div class="context-value">
                                        {{ $topic->name }}
                                    </div>
                                </div>

                                <div
                                    class="info-row"
                                    style="margin-top:8px;"
                                >
                                    <span class="info-label">Status</span>
                                    <span class="info-value">Active</span>
                                </div>

                                <div class="info-row">
                                    <span class="info-label">Default Marks</span>
                                    <span class="info-value">1.00</span>
                                </div>

                            </div>
                        </div>

                        <div class="side-card">

                            <div class="side-head">
                                <div>
                                    <h3 class="side-title">Question Tips</h3>
                                    <p class="side-subtitle">
                                        Build better questions
                                    </p>
                                </div>
                            </div>

                            <div class="side-body">

                                <div class="tip">
                                    <div class="tip-title">✦ Keep it clear</div>

                                    <div class="tip-text">
                                        Use simple wording and avoid unnecessary complexity.
                                    </div>
                                </div>

                                <div class="tip">
                                    <div class="tip-title">✓ One correct answer</div>

                                    <div class="tip-text">
                                        For MCQs, make sure only one option is marked correct.
                                    </div>
                                </div>

                                <div class="tip">
                                    <div class="tip-title">◈ Use explanations</div>

                                    <div class="tip-text">
                                        Add an explanation when students need to understand the answer.
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

            const typeSelect = document.getElementById('question_type');
            const mcqOptions = document.getElementById('mcqOptions');
            const trueFalseOptions = document.getElementById('trueFalseOptions');

            const optionList = document.getElementById('optionList');
            const addOption = document.getElementById('addOption');

            const MAX_OPTIONS = 6;

            function updateQuestionType() {
                const type = typeSelect.value;

                mcqOptions.style.display =
                    type === 'mcq' ? 'block' : 'none';

                trueFalseOptions.style.display =
                    type === 'true_false' ? 'block' : 'none';

                if (type === 'mcq') {
                    updateOptions();
                }
            }

            function updateOptions() {
                const options =
                    optionList.querySelectorAll('.option-row');

                options.forEach(function (option, index) {

                    const letter =
                        option.querySelector('.option-letter');

                    if (letter) {
                        letter.textContent =
                            String.fromCharCode(65 + index);
                    }

                    const input =
                        option.querySelector('input[type="text"]');

                    if (input) {
                        input.name =
                            `options[${index}][text]`;

                        input.placeholder =
                            `Option ${String.fromCharCode(65 + index)}`;
                    }

                    const radio =
                        option.querySelector('input[type="radio"]');

                    if (radio) {
                        radio.value = index;
                    }

                    const remove =
                        option.querySelector('.remove-option');

                    if (remove) {
                        remove.style.display =
                            options.length > 2
                                ? 'flex'
                                : 'none';
                    }
                });

                addOption.style.display =
                    options.length >= MAX_OPTIONS
                        ? 'none'
                        : 'inline-flex';
            }

            addOption.addEventListener('click', function () {

                const options =
                    optionList.querySelectorAll('.option-row');

                if (options.length >= MAX_OPTIONS) {
                    alert('You can add up to 6 options.');
                    return;
                }

                const index = options.length;

                const wrapper =
                    document.createElement('div');

                wrapper.className = 'option-row';

                wrapper.innerHTML = `
                    <div class="option-letter">
                        ${String.fromCharCode(65 + index)}
                    </div>

                    <input
                        type="radio"
                        class="option-radio"
                        name="correct_option"
                        value="${index}"
                        title="Mark as correct answer"
                    >

                    <input
                        type="text"
                        name="options[${index}][text]"
                        class="input"
                        placeholder="Option ${String.fromCharCode(65 + index)}"
                    >

                    <button
                        type="button"
                        class="remove-option"
                        title="Remove option"
                    >
                        ×
                    </button>
                `;

                optionList.appendChild(wrapper);

                updateOptions();
            });

            optionList.addEventListener(
                'click',
                function (event) {

                    const button =
                        event.target.closest('.remove-option');

                    if (!button) {
                        return;
                    }

                    const options =
                        optionList.querySelectorAll('.option-row');

                    if (options.length <= 2) {
                        alert('At least two options are required.');
                        return;
                    }

                    button.closest('.option-row').remove();

                    updateOptions();
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