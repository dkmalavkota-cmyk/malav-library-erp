<x-layouts::examination :title="'Edit Exam'">
    <style>
        .exam-edit-page {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 80% 0%,
                    rgba(99, 102, 241, .07),
                    transparent 28rem
                ),
                #09090b;
            color: #fafafa;
        }

        .exam-edit-container {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 34px 0 50px;
        }

        .exam-page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .exam-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 14px;
            font-size: 12px;
            color: #71717a;
        }

        .exam-breadcrumb a {
            color: #a1a1aa;
            text-decoration: none;
        }

        .exam-breadcrumb a:hover {
            color: #fff;
        }

        .exam-heading-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .exam-main-icon {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: rgba(99, 102, 241, .10);
            border: 1px solid rgba(129, 140, 248, .18);
            color: #a5b4fc;
        }

        .exam-main-icon svg {
            width: 21px;
            height: 21px;
        }

        .exam-page-title {
            margin: 0;
            color: #fff;
            font-size: 30px;
            line-height: 1.15;
            font-weight: 700;
            letter-spacing: -.025em;
        }

        .exam-page-subtitle {
            margin: 6px 0 0;
            color: #71717a;
            font-size: 14px;
            line-height: 1.5;
        }

        .exam-back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            height: 42px;
            padding: 0 16px;
            border-radius: 12px;
            border: 1px solid #27272a;
            background: #111113;
            color: #d4d4d8 !important;
            text-decoration: none !important;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-back-btn:hover {
            background: #18181b;
            color: #fff !important;
        }

        .exam-card {
            overflow: hidden;
            margin-bottom: 18px;
            border: 1px solid #27272a;
            border-radius: 18px;
            background: rgba(17, 17, 19, .94);
        }

        .exam-card-header {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 20px 23px;
            border-bottom: 1px solid #27272a;
        }

        .exam-section-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(99, 102, 241, .10);
            color: #a5b4fc;
        }

        .exam-section-icon.green {
            background: rgba(16, 185, 129, .09);
            color: #6ee7b7;
        }

        .exam-section-icon.blue {
            background: rgba(14, 165, 233, .09);
            color: #7dd3fc;
        }

        .exam-card-title {
            margin: 0;
            color: #f4f4f5;
            font-size: 15px;
            font-weight: 650;
        }

        .exam-card-description {
            margin: 3px 0 0;
            color: #71717a;
            font-size: 12px;
            line-height: 1.45;
        }

        .exam-card-body {
            padding: 23px;
        }

        .exam-form-group {
            margin-bottom: 20px;
        }

        .exam-form-group:last-child {
            margin-bottom: 0;
        }

        .exam-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 8px;
        }

        .exam-label {
            display: block;
            color: #e4e4e7;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-label-note {
            color: #52525b;
            font-size: 11px;
        }

        .exam-edit-page input.exam-input,
        .exam-edit-page select.exam-input,
        .exam-edit-page textarea.exam-input {
            box-sizing: border-box !important;
            width: 100% !important;
            margin: 0 !important;
            border: 1px solid #2f2f33 !important;
            border-radius: 12px !important;
            background: #0d0d0f !important;
            color: #f4f4f5 !important;
            box-shadow: none !important;
            outline: none !important;
            font-family: inherit !important;
            font-size: 13px !important;
        }

        .exam-edit-page input.exam-input,
        .exam-edit-page select.exam-input {
            height: 46px !important;
            padding: 0 14px !important;
        }

        .exam-edit-page textarea.exam-input {
            min-height: 105px !important;
            padding: 12px 14px !important;
            resize: vertical !important;
            line-height: 1.6 !important;
        }

        .exam-edit-page input.exam-input:focus,
        .exam-edit-page select.exam-input:focus,
        .exam-edit-page textarea.exam-input:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, .10) !important;
        }

        .exam-settings-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
        }

        .exam-schedule-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .exam-negative-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 18px;
            padding: 16px;
            border: 1px solid #27272a;
            border-radius: 14px;
            background: #0d0d0f;
        }

        .exam-check-label {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            cursor: pointer;
        }

        .exam-check-label input[type="checkbox"] {
            width: 17px !important;
            height: 17px !important;
            margin: 2px 0 0 !important;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .exam-check-title {
            display: block;
            color: #e4e4e7;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-check-text {
            display: block;
            margin-top: 3px;
            color: #52525b;
            font-size: 11px;
            line-height: 1.5;
        }

        .exam-negative-value {
            width: 180px;
        }

        .exam-small-label {
            display: block;
            margin-bottom: 7px;
            color: #71717a;
            font-size: 10px;
            font-weight: 600;
        }

        .exam-publish-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .exam-publish-option {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            min-height: 82px;
            padding: 15px;
            border: 1px solid #27272a;
            border-radius: 14px;
            background: #0d0d0f;
            cursor: pointer;
        }

        .exam-publish-option input[type="checkbox"] {
            width: 17px !important;
            height: 17px !important;
            margin: 2px 0 0 !important;
            accent-color: #6366f1;
            cursor: pointer;
        }

        .exam-option-title {
            color: #f4f4f5;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-option-description {
            margin: 5px 0 0;
            color: #52525b;
            font-size: 11px;
            line-height: 1.55;
        }

        .exam-error {
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid rgba(239, 68, 68, .20);
            border-radius: 14px;
            background: rgba(239, 68, 68, .06);
            color: #f87171;
            font-size: 12px;
        }

        .exam-error-title {
            margin: 0 0 6px;
            color: #fca5a5;
            font-size: 13px;
            font-weight: 600;
        }

        .exam-error ul {
            margin: 0;
            padding-left: 18px;
        }

        .exam-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px;
            border: 1px solid #27272a;
            border-radius: 16px;
            background: #111113;
        }

        .exam-action-buttons {
            display: flex;
            gap: 9px;
        }

        .exam-cancel-btn,
        .exam-submit-btn {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 42px !important;
            padding: 0 18px !important;
            border-radius: 11px !important;
            font-size: 12px !important;
            font-weight: 650 !important;
            text-decoration: none !important;
            cursor: pointer !important;
        }

        .exam-cancel-btn {
            border: 1px solid #2f2f33 !important;
            background: #0d0d0f !important;
            color: #a1a1aa !important;
        }

        .exam-submit-btn {
            border: 1px solid #fff !important;
            background: #fff !important;
            color: #09090b !important;
        }

        @media (max-width: 900px) {
            .exam-settings-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .exam-edit-container {
                width: min(100% - 22px, 600px);
            }

            .exam-page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .exam-settings-grid,
            .exam-schedule-grid,
            .exam-publish-grid {
                grid-template-columns: 1fr;
            }

            .exam-negative-box {
                align-items: flex-start;
                flex-direction: column;
            }

            .exam-negative-value {
                width: 100%;
            }

            .exam-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .exam-action-buttons {
                width: 100%;
                flex-direction: column-reverse;
            }

            .exam-cancel-btn,
            .exam-submit-btn {
                width: 100% !important;
            }
        }
    </style>


    <div class="exam-edit-page">

        <div class="exam-edit-container">

            {{-- HEADER --}}
            <div class="exam-page-header">

                <div>

                    <div class="exam-breadcrumb">
                        <a href="{{ route('exams.index') }}">
                            Exams
                        </a>

                        <span>›</span>

                        <a href="{{ route('exams.show', $exam) }}">
                            {{ $exam->title }}
                        </a>

                        <span>›</span>

                        <span>Edit</span>
                    </div>


                    <div class="exam-heading-wrap">

                        <div class="exam-main-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="5"
                                    y="3"
                                    width="14"
                                    height="18"
                                    rx="2"
                                />
                                <path d="M8 7h8" />
                                <path d="M8 11h8" />
                                <path d="M8 15h5" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="exam-page-title">
                                Edit Exam
                            </h1>

                            <p class="exam-page-subtitle">
                                Update exam configuration and availability.
                            </p>
                        </div>

                    </div>

                </div>


                <a
                    href="{{ route('exams.show', $exam) }}"
                    class="exam-back-btn"
                >
                    ← Back to exam
                </a>

            </div>


            {{-- ERRORS --}}
            @if ($errors->any())

                <div class="exam-error">

                    <p class="exam-error-title">
                        Please check the following:
                    </p>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('exams.update', $exam) }}"
            >

                @csrf
                @method('PUT')


                {{-- BASIC INFORMATION --}}
                <section class="exam-card">

                    <div class="exam-card-header">

                        <div class="exam-section-icon">
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M4 6h16" />
                                <path d="M4 12h10" />
                                <path d="M4 18h16" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="exam-card-title">
                                Basic Information
                            </h2>

                            <p class="exam-card-description">
                                Update the identity and category of this exam.
                            </p>
                        </div>

                    </div>


                    <div class="exam-card-body">

                        {{-- TITLE --}}
                        <div class="exam-form-group">

                            <div class="exam-label-row">
                                <label
                                    for="title"
                                    class="exam-label"
                                >
                                    Exam Title
                                </label>

                                <span class="exam-label-note">
                                    Required
                                </span>
                            </div>

                            <input
                                id="title"
                                name="title"
                                type="text"
                                value="{{ old('title', $exam->title) }}"
                                required
                                class="exam-input"
                            >

                        </div>


                        {{-- CATEGORY --}}
                        <div class="exam-form-group">

                            <div class="exam-label-row">

                                <label
                                    for="exam_category_id"
                                    class="exam-label"
                                >
                                    Exam Category
                                </label>

                                <span class="exam-label-note">
                                    Required
                                </span>

                            </div>


                            <select
                                id="exam_category_id"
                                name="exam_category_id"
                                required
                                class="exam-input"
                            >

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        @selected(
                                            old(
                                                'exam_category_id',
                                                $exam->exam_category_id
                                            ) == $category->id
                                        )
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                                                {{-- EXAM TYPE --}}

                        <div class="exam-form-group">

                            <div class="exam-label-row">

                                <label
                                    for="exam_type"
                                    class="exam-label"
                                >
                                    Exam Type
                                </label>

                                <span class="exam-label-note">
                                    Required
                                </span>

                            </div>


                            <select
                                id="exam_type"
                                name="exam_type"
                                required
                                class="exam-input"
                            >

                                <option
                                    value="regular"
                                    @selected(
                                        old(
                                            'exam_type',
                                            $exam->exam_type ?? 'regular'
                                        ) === 'regular'
                                    )
                                >
                                    Regular / Competitive Exam
                                </option>

                                <option
                                    value="current_affairs"
                                    @selected(
                                        old(
                                            'exam_type',
                                            $exam->exam_type ?? 'regular'
                                        ) === 'current_affairs'
                                    )
                                >
                                    Current Affairs
                                </option>

                                <option
                                    value="major_test"
                                    @selected(
                                        old(
                                            'exam_type',
                                            $exam->exam_type ?? 'regular'
                                        ) === 'major_test'
                                    )
                                >
                                    Major Test
                                </option>

                            </select>


                            <p class="exam-helper">
                                Choose whether this is a regular competitive exam, current affairs test, or major test.
                            </p>

                        </div>




                        {{-- DESCRIPTION --}}
                        <div class="exam-form-group">

                            <div class="exam-label-row">

                                <label
                                    for="description"
                                    class="exam-label"
                                >
                                    Description
                                </label>

                                <span class="exam-label-note">
                                    Optional
                                </span>

                            </div>

                            <textarea
                                id="description"
                                name="description"
                                class="exam-input"
                                placeholder="Describe this examination..."
                            >{{ old('description', $exam->description) }}</textarea>

                        </div>

                    </div>

                </section>


                {{-- EXAM SETTINGS --}}
                <section class="exam-card">

                    <div class="exam-card-header">

                        <div class="exam-section-icon green">
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle cx="12" cy="12" r="8" />
                                <path d="M12 8v4l3 2" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="exam-card-title">
                                Exam Settings
                            </h2>

                            <p class="exam-card-description">
                                Configure duration, scoring and attempts.
                            </p>
                        </div>

                    </div>


                    <div class="exam-card-body">

                        <div class="exam-settings-grid">

                            {{-- DURATION --}}
                            <div>

                                <div class="exam-label-row">
                                    <label
                                        for="duration_minutes"
                                        class="exam-label"
                                    >
                                        Duration
                                    </label>
                                </div>

                                <input
                                    id="duration_minutes"
                                    name="duration_minutes"
                                    type="number"
                                    min="1"
                                    value="{{ old('duration_minutes', $exam->duration_minutes) }}"
                                    required
                                    class="exam-input"
                                >

                            </div>


                            {{-- TOTAL MARKS --}}
                            <div>

                                <div class="exam-label-row">
                                    <label
                                        for="total_marks"
                                        class="exam-label"
                                    >
                                        Total Marks
                                    </label>
                                </div>

                                <input
                                    id="total_marks"
                                    name="total_marks"
                                    type="number"
                                    min="0"
                                    value="{{ old('total_marks', $exam->total_marks) }}"
                                    required
                                    class="exam-input"
                                >

                            </div>


                            {{-- PASSING --}}
                            <div>

                                <div class="exam-label-row">
                                    <label
                                        for="passing_marks"
                                        class="exam-label"
                                    >
                                        Passing Marks
                                    </label>
                                </div>

                                <input
                                    id="passing_marks"
                                    name="passing_marks"
                                    type="number"
                                    min="0"
                                    value="{{ old('passing_marks', $exam->passing_marks) }}"
                                    required
                                    class="exam-input"
                                >

                            </div>


                            {{-- ATTEMPTS --}}
                            <div>

                                <div class="exam-label-row">
                                    <label
                                        for="attempt_limit"
                                        class="exam-label"
                                    >
                                        Attempt Limit
                                    </label>
                                </div>

                                <input
                                    id="attempt_limit"
                                    name="attempt_limit"
                                    type="number"
                                    min="1"
                                    value="{{ old('attempt_limit', $exam->attempt_limit) }}"
                                    required
                                    class="exam-input"
                                >

                            </div>

                        </div>


                        {{-- NEGATIVE MARKING --}}
                        <div class="exam-negative-box">

                            <label class="exam-check-label">

                                <input
                                    type="checkbox"
                                    name="negative_marking"
                                    value="1"
                                    @checked(
                                        old(
                                            'negative_marking',
                                            $exam->negative_marking
                                        )
                                    )
                                >

                                <span>

                                    <span class="exam-check-title">
                                        Enable Negative Marking
                                    </span>

                                    <span class="exam-check-text">
                                        Deduct marks for incorrect answers.
                                    </span>

                                </span>

                            </label>


                            <div class="exam-negative-value">

                                <label
                                    for="negative_marks"
                                    class="exam-small-label"
                                >
                                    DEDUCTION PER WRONG ANSWER
                                </label>

                                <input
                                    id="negative_marks"
                                    name="negative_marks"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    value="{{ old('negative_marks', $exam->negative_marks ?? 0) }}"
                                    class="exam-input"
                                >

                            </div>

                        </div>

                    </div>

                </section>


                {{-- SCHEDULE --}}
                <section class="exam-card">

                    <div class="exam-card-header">

                        <div class="exam-section-icon blue">
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="4"
                                    y="5"
                                    width="16"
                                    height="15"
                                    rx="2"
                                />
                                <path d="M8 3v4" />
                                <path d="M16 3v4" />
                                <path d="M4 9h16" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="exam-card-title">
                                Exam Schedule
                            </h2>

                            <p class="exam-card-description">
                                Control when students can access this exam.
                            </p>
                        </div>

                    </div>


                    <div class="exam-card-body">

                        <div class="exam-schedule-grid">

                            {{-- START --}}
                            <div>

                                <div class="exam-label-row">

                                    <label
                                        for="starts_at"
                                        class="exam-label"
                                    >
                                        Starts At
                                    </label>

                                    <span class="exam-label-note">
                                        Optional
                                    </span>

                                </div>

                                <input
                                    id="starts_at"
                                    name="starts_at"
                                    type="datetime-local"
                                    value="{{ old('starts_at', $exam->starts_at?->format('Y-m-d\TH:i')) }}"
                                    class="exam-input"
                                >

                            </div>


                            {{-- END --}}
                            <div>

                                <div class="exam-label-row">

                                    <label
                                        for="ends_at"
                                        class="exam-label"
                                    >
                                        Ends At
                                    </label>

                                    <span class="exam-label-note">
                                        Optional
                                    </span>

                                </div>

                                <input
                                    id="ends_at"
                                    name="ends_at"
                                    type="datetime-local"
                                    value="{{ old('ends_at', $exam->ends_at?->format('Y-m-d\TH:i')) }}"
                                    class="exam-input"
                                >

                            </div>

                        </div>

                    </div>

                </section>


                {{-- PUBLISHING --}}
                <section class="exam-card">

                    <div class="exam-card-header">

                        <div class="exam-section-icon">
                            <svg
                                width="18"
                                height="18"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M12 3v12" />
                                <path d="M8 7l4-4 4 4" />
                                <path d="M5 13v6h14v-6" />
                            </svg>
                        </div>

                        <div>
                            <h2 class="exam-card-title">
                                Publishing & Availability
                            </h2>

                            <p class="exam-card-description">
                                Control the active and published state.
                            </p>
                        </div>

                    </div>


                    <div class="exam-card-body">

                        <div class="exam-publish-grid">

                            {{-- ACTIVE --}}
                            <label class="exam-publish-option">

                                <input
                                    type="checkbox"
                                    name="is_active"
                                    value="1"
                                    @checked(
                                        old(
                                            'is_active',
                                            $exam->is_active
                                        )
                                    )
                                >

                                <span>

                                    <span class="exam-option-title">
                                        Active Exam
                                    </span>

                                    <p class="exam-option-description">
                                        Keep this exam available for management
                                        and student assignment.
                                    </p>

                                </span>

                            </label>


                            {{-- PUBLISHED --}}
                            <label class="exam-publish-option">

                                <input
                                    type="checkbox"
                                    name="is_published"
                                    value="1"
                                    @checked(
                                        old(
                                            'is_published',
                                            $exam->is_published
                                        )
                                    )
                                >

                                <span>

                                    <span class="exam-option-title">
                                        Publish Exam
                                    </span>

                                    <p class="exam-option-description">
                                        Published exams become visible to
                                        eligible students.
                                    </p>

                                </span>

                            </label>

                        </div>

                    </div>

                </section>


                {{-- ACTIONS --}}
                <div class="exam-actions">

                    <div>
                        <strong style="color:#a1a1aa;font-size:12px;">
                            Update this examination
                        </strong>

                        <div style="color:#52525b;font-size:10px;margin-top:4px;">
                            Changes will be saved to the current exam.
                        </div>
                    </div>


                    <div class="exam-action-buttons">

                        <a
                            href="{{ route('exams.show', $exam) }}"
                            class="exam-cancel-btn"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="exam-submit-btn"
                        >
                            Save Changes
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</x-layouts::examination>