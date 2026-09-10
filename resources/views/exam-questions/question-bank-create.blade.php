<x-layouts::examination title=Add Question>

    <style>
        .qbc-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 88% 0%, rgba(117,97,255,.12), transparent 32rem),
                radial-gradient(circle at 5% 65%, rgba(117,97,255,.045), transparent 28rem);
        }

        .qbc-wrap {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* HEADER */

        .qbc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .qbc-heading {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .qbc-back {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #2b2b32;
            border-radius: 11px;
            background: #121216;
            color: #777780;
            text-decoration: none;
            transition: .2s;
        }

        .qbc-back:hover {
            color: #aaa1ff;
            border-color: rgba(117,97,255,.35);
            background: rgba(117,97,255,.05);
        }

        .qbc-back svg {
            width: 17px;
            height: 17px;
        }

        .qbc-eyebrow {
            margin-bottom: 3px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #756b9e;
        }

        .qbc-title {
            margin: 0;
            font-size: 25px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
            color: #fff;
        }

        .qbc-subtitle {
            margin: 4px 0 0;
            color: #66666f;
            font-size: 10px;
        }

        /* ALERTS */

        .qbc-alert {
            margin-bottom: 15px;
            padding: 13px 15px;
            border: 1px solid rgba(215,133,140,.2);
            border-radius: 12px;
            background: rgba(215,133,140,.045);
            color: #c99399;
            font-size: 10px;
        }

        .qbc-alert ul {
            margin: 0;
            padding-left: 17px;
        }

        .qbc-alert li + li {
            margin-top: 4px;
        }

        /* FORM */

        .qbc-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 19px;
            background: #121216;
            box-shadow: 0 18px 60px rgba(0,0,0,.12);
        }

        .qbc-section {
            padding: 21px;
            border-bottom: 1px solid rgba(255,255,255,.055);
        }

        .qbc-section:last-child {
            border-bottom: 0;
        }

        .qbc-section-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 17px;
        }

        .qbc-section-number {
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: rgba(117,97,255,.09);
            border: 1px solid rgba(117,97,255,.16);
            color: #9b91ee;
            font-size: 9px;
            font-weight: 800;
        }

        .qbc-section-title {
            margin: 0;
            font-size: 12px;
            font-weight: 740;
            color: #e5e5e8;
        }

        .qbc-section-desc {
            margin: 2px 0 0;
            color: #595961;
            font-size: 9px;
        }

        /* GRID */

        .qbc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .qbc-field.full {
            grid-column: span 2;
        }

        .qbc-label {
            display: block;
            margin-bottom: 7px;
            color: #85858e;
            font-size: 9px;
            font-weight: 680;
        }

        .qbc-required {
            color: #8d83e6;
        }

        .qbc-input,
        .qbc-select,
        .qbc-textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #2b2b32;
            outline: none;
            border-radius: 10px;
            background: #0c0c10;
            color: #dedee2;
            font-family: inherit;
            font-size: 10px;
            transition: .2s ease;
        }

        .qbc-input,
        .qbc-select {
            height: 43px;
            padding: 0 12px;
        }

        .qbc-textarea {
            min-height: 135px;
            padding: 12px;
            resize: vertical;
            line-height: 1.6;
        }

        .qbc-input::placeholder,
        .qbc-textarea::placeholder {
            color: #474750;
        }

        .qbc-input:focus,
        .qbc-select:focus,
        .qbc-textarea:focus {
            border-color: rgba(117,97,255,.58);
            box-shadow: 0 0 0 3px rgba(117,97,255,.065);
        }

        .qbc-select {
            appearance: none;
            cursor: pointer;
        }

        .qbc-select-wrap {
            position: relative;
        }

        .qbc-select-wrap::after {
            content: "";
            position: absolute;
            right: 13px;
            bottom: 14px;
            width: 6px;
            height: 6px;
            border-right: 1px solid #686872;
            border-bottom: 1px solid #686872;
            transform: rotate(45deg);
            pointer-events: none;
        }

        .qbc-help {
            margin-top: 6px;
            color: #505059;
            font-size: 8px;
            line-height: 1.5;
        }

        .qbc-error {
            margin-top: 6px;
            color: #bd858c;
            font-size: 8px;
        }

        /* OPTIONS */

        .qbc-options {
            display: grid;
            gap: 9px;
        }

       .qbc-option-row {
    display: grid;
    grid-template-columns: 34px minmax(0, 1fr) 39px 39px;
    align-items: center;
    gap: 9px;
}

        .qbc-option-label {
            width: 32px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #292930;
            border-radius: 9px;
            background: #0d0d11;
            color: #777780;
            font-size: 9px;
            font-weight: 800;
        }

        .qbc-option-row.correct .qbc-option-label {
            color: #9e94ff;
            border-color: rgba(117,97,255,.35);
            background: rgba(117,97,255,.07);
        }

        .qbc-correct {
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #292930;
            border-radius: 9px;
            background: #0d0d11;
            cursor: pointer;
        }

        .qbc-correct input {
            display: none;
        }

        .qbc-radio {
            width: 15px;
            height: 15px;
            border: 1px solid #4a4a53;
            border-radius: 50%;
            position: relative;
        }

        .qbc-correct input:checked + .qbc-radio {
            border-color: #8e83ee;
            box-shadow: 0 0 0 3px rgba(117,97,255,.08);
        }

        .qbc-correct input:checked + .qbc-radio::after {
            content: "";
            position: absolute;
            inset: 3px;
            border-radius: 50%;
            background: #8e83ee;
        }

        .qbc-remove {
            width: 39px;
            height: 39px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #292930;
            border-radius: 9px;
            background: #0d0d11;
            color: #5e5e67;
            cursor: pointer;
        }

        .qbc-remove:hover {
            color: #c9888e;
            border-color: rgba(201,136,142,.28);
        }

        .qbc-remove svg {
            width: 14px;
            height: 14px;
        }

        .qbc-add-option {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 10px;
            padding: 8px 11px;
            border: 1px dashed #34343c;
            border-radius: 9px;
            background: transparent;
            color: #77717f;
            font-family: inherit;
            font-size: 9px;
            font-weight: 680;
            cursor: pointer;
        }

        .qbc-add-option:hover {
            color: #a098ef;
            border-color: rgba(117,97,255,.35);
            background: rgba(117,97,255,.035);
        }

        /* TYPE NOTICE */

        .qbc-type-notice {
            display: none;
            margin-top: 11px;
            padding: 10px 12px;
            border: 1px solid rgba(117,97,255,.12);
            border-radius: 10px;
            background: rgba(117,97,255,.035);
            color: #787287;
            font-size: 9px;
            line-height: 1.5;
        }

        .qbc-type-notice.show {
            display: block;
        }

        /* SETTINGS */

        .qbc-settings {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 13px;
        }

        .qbc-toggle-card {
            min-height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 13px;
            border: 1px solid #292930;
            border-radius: 11px;
            background: #0d0d11;
        }

        .qbc-toggle-title {
            margin: 0;
            color: #bdbdc3;
            font-size: 9px;
            font-weight: 700;
        }

        .qbc-toggle-desc {
            margin: 4px 0 0;
            color: #52525a;
            font-size: 8px;
        }

        .qbc-switch {
            position: relative;
            width: 37px;
            height: 21px;
            flex-shrink: 0;
        }

        .qbc-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .qbc-slider {
            position: absolute;
            inset: 0;
            border-radius: 20px;
            background: #292930;
            cursor: pointer;
            transition: .2s;
        }

        .qbc-slider::before {
            content: "";
            position: absolute;
            width: 15px;
            height: 15px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #777780;
            transition: .2s;
        }

        .qbc-switch input:checked + .qbc-slider {
            background: rgba(117,97,255,.35);
        }

        .qbc-switch input:checked + .qbc-slider::before {
            transform: translateX(16px);
            background: #a49aff;
        }

        /* FOOTER */

        .qbc-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            padding: 16px 21px;
            background: rgba(0,0,0,.10);
        }

        .qbc-cancel {
            height: 41px;
            padding: 0 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #2b2b32;
            border-radius: 10px;
            color: #777780;
            background: transparent;
            text-decoration: none;
            font-size: 9px;
            font-weight: 680;
        }

        .qbc-cancel:hover {
            color: #aaaab1;
            background: rgba(255,255,255,.02);
        }

        .qbc-submit {
            height: 41px;
            padding: 0 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            border: 1px solid rgba(117,97,255,.48);
            border-radius: 10px;
            background: linear-gradient(135deg,#7561ff,#5b47e6);
            color: #fff;
            font-family: inherit;
            font-size: 9px;
            font-weight: 750;
            cursor: pointer;
            box-shadow: 0 9px 23px rgba(93,73,233,.16);
        }

        .qbc-submit:hover {
            box-shadow: 0 12px 27px rgba(93,73,233,.24);
            transform: translateY(-1px);
        }

        .qbc-submit svg {
            width: 14px;
            height: 14px;
        }

        /* RESPONSIVE */

        @media (max-width: 800px) {

            .qbc-page {
                padding: 17px;
            }

            .qbc-grid {
                grid-template-columns: 1fr;
            }

            .qbc-field.full {
                grid-column: span 1;
            }

            .qbc-settings {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 560px) {

            .qbc-page {
                padding: 11px;
            }

            .qbc-header {
                align-items: flex-start;
            }

            .qbc-title {
                font-size: 21px;
            }

            .qbc-subtitle {
                display: none;
            }

            .qbc-section {
                padding: 15px;
            }

           .qbc-option-row {
    grid-template-columns: 30px minmax(0, 1fr) 34px 34px;
    gap: 6px;
}
            .qbc-option-label {
                width: 30px;
            }

            .qbc-remove {
                width: 34px;
            }

            .qbc-footer {
                padding: 13px 15px;
            }

            .qbc-cancel,
            .qbc-submit {
                flex: 1;
            }

        }
    </style>


    <div class="qbc-page">

        <div class="qbc-wrap">

            {{-- HEADER --}}

            <div class="qbc-header">

                <div class="qbc-heading">

                    <a
                        href="{{ route('question-bank.index') }}"
                        class="qbc-back"
                        title="Back to Question Bank"
                    >
                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M19 12H5M11 18l-6-6 6-6"
                            />
                        </svg>
                    </a>

                    <div>

                        <div class="qbc-eyebrow">
                            Question Bank
                        </div>

                        <h1 class="qbc-title">
                            Add Question
                        </h1>

                        <p class="qbc-subtitle">
                            Create a reusable question for your online examinations.
                        </p>

                    </div>

                </div>

            </div>


            {{-- ERRORS --}}

            @if($errors->any())

                <div class="qbc-alert">

                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <form
                method="POST"
                action="{{ route('question-bank.store') }}"
                id="questionForm"
            >

                @csrf


                <div class="qbc-card">


                    {{-- ================================================= --}}
                    {{-- SECTION 1 : LOCATION --}}
                    {{-- ================================================= --}}

                    <div class="qbc-section">

                        <div class="qbc-section-head">

                            <div class="qbc-section-number">
                                01
                            </div>

                            <div>

                                <h2 class="qbc-section-title">
                                    Question Location
                                </h2>

                                <p class="qbc-section-desc">
                                    Choose where this question belongs.
                                </p>

                            </div>

                        </div>


                        <div class="qbc-grid">


                            {{-- SUBJECT --}}

                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Subject
                                    <span class="qbc-required">*</span>
                                </label>

                                <div class="qbc-select-wrap">

                                    <select
                                        name="subject_id"
                                        id="subject_id"
                                        class="qbc-select"
                                        required
                                    >

                                        <option value="">
                                            Select Subject
                                        </option>

                                        @foreach($subjects as $subject)

                                            <option
                                                value="{{ $subject->id }}"
                                                @selected(old('subject_id') == $subject->id)
                                            >
                                                {{ $subject->name }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                                @error('subject_id')

                                    <div class="qbc-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- TOPIC --}}

                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Topic
                                    <span class="qbc-required">*</span>
                                </label>

                                <div class="qbc-select-wrap">

                                    <select
                                        name="topic_id"
                                        id="topic_id"
                                        class="qbc-select"
                                        required
                                        disabled
                                    >

                                        <option value="">
                                            Select Subject First
                                        </option>

                                    </select>

                                </div>

                                <div class="qbc-help">
                                    Topics will appear after selecting a subject.
                                </div>

                                @error('topic_id')

                                    <div class="qbc-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SECTION 2 : QUESTION --}}
                    {{-- ================================================= --}}

                    <div class="qbc-section">

                        <div class="qbc-section-head">

                            <div class="qbc-section-number">
                                02
                            </div>

                            <div>

                                <h2 class="qbc-section-title">
                                    Question
                                </h2>

                                <p class="qbc-section-desc">
                                    Write the question students will answer.
                                </p>

                            </div>

                        </div>


                        <div class="qbc-grid">


                            <div class="qbc-field full">

                                <label class="qbc-label">
                                    Question Text
                                    <span class="qbc-required">*</span>
                                </label>

                                <textarea
                                    name="question_text"
                                    class="qbc-textarea"
                                    placeholder="Enter your question here..."
                                    required
                                >{{ old('question_text') }}</textarea>

                                @error('question_text')

                                    <div class="qbc-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Question Type
                                    <span class="qbc-required">*</span>
                                </label>

                                <div class="qbc-select-wrap">

                                    <select
                                        name="question_type"
                                        id="question_type"
                                        class="qbc-select"
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

                                        <option
                                            value="short_answer"
                                            @selected(old('question_type') === 'short_answer')
                                        >
                                            Short Answer
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Explanation
                                </label>

                                <input
                                    type="text"
                                    name="explanation"
                                    class="qbc-input"
                                    value="{{ old('explanation') }}"
                                    placeholder="Optional answer explanation"
                                >

                            </div>

                        </div>


                        <div
                            class="qbc-type-notice"
                            id="typeNotice"
                        ></div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SECTION 3 : OPTIONS --}}
                    {{-- ================================================= --}}

                    <div
                        class="qbc-section"
                        id="optionsSection"
                    >

                        <div class="qbc-section-head">

                            <div class="qbc-section-number">
                                03
                            </div>

                            <div>

                                <h2 class="qbc-section-title">
                                    Answer Options
                                </h2>

                                <p class="qbc-section-desc">
                                    Add options and select the correct answer.
                                </p>

                            </div>

                        </div>


                        <div
                            class="qbc-options"
                            id="optionsContainer"
                        >

                            @php

                                $oldOptions = old(
                                    'options',
                                    [
                                        ['text' => ''],
                                        ['text' => ''],
                                        ['text' => ''],
                                        ['text' => ''],
                                    ]
                                );

                            @endphp


                            @foreach($oldOptions as $index => $option)

                                <div
                                    class="qbc-option-row"
                                    data-option-index="{{ $index }}"
                                >

                                    <div class="qbc-option-label">
                                        {{ chr(65 + $index) }}
                                    </div>


                                    <input
                                        type="text"
                                        name="options[{{ $index }}][text]"
                                        class="qbc-input option-input"
                                        value="{{ $option['text'] ?? '' }}"
                                        placeholder="Enter option {{ chr(65 + $index) }}"
                                    >


                                    <label
                                        class="qbc-correct"
                                        title="Set as correct answer"
                                    >

                                        <input
                                            type="radio"
                                            name="correct_option"
                                            value="{{ $index }}"
                                            @checked(old('correct_option') !== null && (int) old('correct_option') === $index)
                                        >

                                        <span class="qbc-radio"></span>

                                    </label>


                                    <button
                                        type="button"
                                        class="qbc-remove"
                                        onclick="removeOption(this)"
                                        title="Remove option"
                                    >

                                        <svg
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M6 7h12M10 11v6M14 11v6M8 7l1-3h6l1 3M8 7l1 14h6l1-14"
                                            />
                                        </svg>

                                    </button>

                                </div>

                            @endforeach

                        </div>


                        <button
                            type="button"
                            class="qbc-add-option"
                            id="addOptionBtn"
                        >

                            <svg
                                width="12"
                                height="12"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Add Option

                        </button>


                        @error('options')

                            <div class="qbc-error">
                                {{ $message }}
                            </div>

                        @enderror


                        @error('correct_option')

                            <div class="qbc-error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- ================================================= --}}
                    {{-- SECTION 4 : MARKING --}}
                    {{-- ================================================= --}}

                    <div class="qbc-section">

                        <div class="qbc-section-head">

                            <div class="qbc-section-number">
                                04
                            </div>

                            <div>

                                <h2 class="qbc-section-title">
                                    Marking & Difficulty
                                </h2>

                                <p class="qbc-section-desc">
                                    Configure scoring for this question.
                                </p>

                            </div>

                        </div>


                        <div class="qbc-grid">


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Marks
                                    <span class="qbc-required">*</span>
                                </label>

                                <input
                                    type="number"
                                    name="marks"
                                    class="qbc-input"
                                    value="{{ old('marks', 1) }}"
                                    min="0"
                                    step="0.01"
                                    required
                                >

                            </div>


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Negative Marks
                                </label>

                                <input
                                    type="number"
                                    name="negative_marks"
                                    class="qbc-input"
                                    value="{{ old('negative_marks', 0) }}"
                                    min="0"
                                    step="0.01"
                                >

                            </div>


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Difficulty
                                    <span class="qbc-required">*</span>
                                </label>

                                <div class="qbc-select-wrap">

                                    <select
                                        name="difficulty"
                                        class="qbc-select"
                                        required
                                    >

                                        <option
                                            value="Easy"
                                            @selected(old('difficulty') === 'Easy')
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
                                            @selected(old('difficulty') === 'Hard')
                                        >
                                            Hard
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="qbc-field">

                                <label class="qbc-label">
                                    Display Order
                                </label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    class="qbc-input"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                                >

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- SECTION 5 : STATUS --}}
                    {{-- ================================================= --}}

                    <div class="qbc-section">

                        <div class="qbc-section-head">

                            <div class="qbc-section-number">
                                05
                            </div>

                            <div>

                                <h2 class="qbc-section-title">
                                    Question Status
                                </h2>

                                <p class="qbc-section-desc">
                                    Control whether this question is available for exams.
                                </p>

                            </div>

                        </div>


                        <div class="qbc-settings">

                            <div class="qbc-toggle-card">

                                <div>

                                    <p class="qbc-toggle-title">
                                        Active Question
                                    </p>

                                    <p class="qbc-toggle-desc">
                                        Available for exam selection
                                    </p>

                                </div>


                                <label class="qbc-switch">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        checked
                                    >

                                    <span class="qbc-slider"></span>

                                </label>

                            </div>


                            <div class="qbc-toggle-card">

                                <div>

                                    <p class="qbc-toggle-title">
                                        Reusable
                                    </p>

                                    <p class="qbc-toggle-desc">
                                        Can be used in multiple exams
                                    </p>

                                </div>


                                <div
                                    style="
                                        color:#8d84df;
                                        font-size:8px;
                                        font-weight:700;
                                    "
                                >
                                    QUESTION BANK
                                </div>

                            </div>


                            <div class="qbc-toggle-card">

                                <div>

                                    <p class="qbc-toggle-title">
                                        Library Scope
                                    </p>

                                    <p class="qbc-toggle-desc">
                                        Visible only to this library
                                    </p>

                                </div>


                                <div
                                    style="
                                        color:#6d6d76;
                                        font-size:8px;
                                        font-weight:700;
                                    "
                                >
                                    PRIVATE
                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- FOOTER --}}

                    <div class="qbc-footer">

                        <a
                            href="{{ route('question-bank.index') }}"
                            class="qbc-cancel"
                        >
                            Cancel
                        </a>


                        <button
                            type="submit"
                            class="qbc-submit"
                        >

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 12l4 4L19 6"
                                />
                            </svg>

                            Save Question

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <script>

        /*
        |--------------------------------------------------------------------------
        | Subject Ã¢â€ â€™ Topic
        |--------------------------------------------------------------------------
        */

        const subjectsData = @json(
            $subjects->mapWithKeys(
                fn ($subject) => [
                    $subject->id => $subject->topics->map(
                        fn ($topic) => [
                            'id' => $topic->id,
                            'name' => $topic->name,
                        ]
                    )->values()
                ]
            )
        );


        const subjectSelect =
            document.getElementById('subject_id');

        const topicSelect =
            document.getElementById('topic_id');


        const oldTopic =
            @json(old('topic_id'));


        function loadTopics(selectedTopic = null) {

            const subjectId =
                subjectSelect.value;


            topicSelect.innerHTML =
                '<option value="">Select Topic</option>';


            if (!subjectId) {

                topicSelect.disabled = true;

                topicSelect.innerHTML =
                    '<option value="">Select Subject First</option>';

                return;

            }


            const topics =
                subjectsData[subjectId] ?? [];


            topicSelect.disabled =
                false;


            if (!topics.length) {

                topicSelect.innerHTML =
                    '<option value="">No topics available</option>';

                return;

            }


            topics.forEach(function (topic) {

                const option =
                    document.createElement('option');


                option.value =
                    topic.id;

                option.textContent =
                    topic.name;


                if (
                    selectedTopic &&
                    String(selectedTopic) ===
                    String(topic.id)
                ) {

                    option.selected =
                        true;

                }


                topicSelect.appendChild(
                    option
                );

            });

        }


        subjectSelect.addEventListener(
            'change',
            function () {

                loadTopics();

            }
        );


        loadTopics(oldTopic);


        /*
        |--------------------------------------------------------------------------
        | Question Type
        |--------------------------------------------------------------------------
        */

        const questionType =
            document.getElementById(
                'question_type'
            );

        const optionsSection =
            document.getElementById(
                'optionsSection'
            );

        const typeNotice =
            document.getElementById(
                'typeNotice'
            );


        function updateQuestionType() {

            const type =
                questionType.value;


            if (type === 'mcq') {

                optionsSection.style.display =
                    'block';

                typeNotice.classList.remove(
                    'show'
                );

                typeNotice.textContent = '';

            }


            if (type === 'true_false') {

                optionsSection.style.display =
                    'block';

                typeNotice.classList.add(
                    'show'
                );

                typeNotice.textContent =
                    'True / False questions should use two options. Select the correct answer above.';

                setupTrueFalse();

            }


            if (type === 'short_answer') {

                optionsSection.style.display =
                    'none';

                typeNotice.classList.add(
                    'show'
                );

                typeNotice.textContent =
                    'Short-answer questions do not require MCQ options. Students will provide their own answer.';

            }

        }


        questionType.addEventListener(
            'change',
            updateQuestionType
        );


        /*
        |--------------------------------------------------------------------------
        | Options
        |--------------------------------------------------------------------------
        */

        const optionsContainer =
            document.getElementById(
                'optionsContainer'
            );

        const addOptionBtn =
            document.getElementById(
                'addOptionBtn'
            );


        let optionIndex =
            optionsContainer.querySelectorAll(
                '.qbc-option-row'
            ).length;


        function addOption(
            text = ''
        ) {

            if (optionIndex >= 10) {

                return;

            }


            const letter =
                String.fromCharCode(
                    65 + optionIndex
                );


            const row =
                document.createElement(
                    'div'
                );


            row.className =
                'qbc-option-row';


            row.dataset.optionIndex =
                optionIndex;


            row.innerHTML = `

                <div class="qbc-option-label">
                    ${letter}
                </div>

                <input
                    type="text"
                    name="options[${optionIndex}][text]"
                    class="qbc-input option-input"
                    value="${escapeHtml(text)}"
                    placeholder="Enter option ${letter}"
                >

                <label
                    class="qbc-correct"
                    title="Set as correct answer"
                >

                    <input
                        type="radio"
                        name="correct_option"
                        value="${optionIndex}"
                    >

                    <span class="qbc-radio"></span>

                </label>

                <button
                    type="button"
                    class="qbc-remove"
                    onclick="removeOption(this)"
                    title="Remove option"
                >

                    <svg
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M6 7h12M10 11v6M14 11v6M8 7l1-3h6l1 3M8 7l1 14h6l1-14"
                        />
                    </svg>

                </button>

            `;


            optionsContainer.appendChild(
                row
            );


            optionIndex++;

        }


        function removeOption(button) {

            const rows =
                optionsContainer.querySelectorAll(
                    '.qbc-option-row'
                );


            if (rows.length <= 2) {

                return;

            }


            button
                .closest('.qbc-option-row')
                .remove();


            renumberOptions();

        }


        function renumberOptions() {

            const rows =
                optionsContainer.querySelectorAll(
                    '.qbc-option-row'
                );


            rows.forEach(
                function (row, index) {

                    const letter =
                        String.fromCharCode(
                            65 + index
                        );


                    row.dataset.optionIndex =
                        index;


                    row.querySelector(
                        '.qbc-option-label'
                    ).textContent =
                        letter;


                    const input =
                        row.querySelector(
                            '.option-input'
                        );


                    input.name =
                        `options[${index}][text]`;


                    input.placeholder =
                        `Enter option ${letter}`;


                    const radio =
                        row.querySelector(
                            'input[type="radio"]'
                        );


                    radio.value =
                        index;

                }
            );


            optionIndex =
                rows.length;

        }


        addOptionBtn.addEventListener(
            'click',
            function () {

                addOption();

            }
        );


        function setupTrueFalse() {

            const rows =
                optionsContainer.querySelectorAll(
                    '.qbc-option-row'
                );


            while (rows.length > 2) {

                rows[rows.length - 1]
                    .remove();

                rows.length--;

            }


            const currentRows =
                optionsContainer.querySelectorAll(
                    '.qbc-option-row'
                );


            const values =
                ['True', 'False'];


            currentRows.forEach(
                function (row, index) {

                    const input =
                        row.querySelector(
                            '.option-input'
                        );


                    input.value =
                        values[index];


                    input.readOnly =
                        true;

                }
            );


            optionIndex =
                currentRows.length;


            renumberOptions();

        }


        function escapeHtml(
            text
        ) {

            return String(text)
                .replace(
                    /&/g,
                    '&amp;'
                )
                .replace(
                    /</g,
                    '&lt;'
                )
                .replace(
                    />/g,
                    '&gt;'
                )
                .replace(
                    /"/g,
                    '&quot;'
                )
                .replace(
                    /'/g,
                    '&#039;'
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Initial state
        |--------------------------------------------------------------------------
        */

        updateQuestionType();

    </script>

</x-layouts::examination>
