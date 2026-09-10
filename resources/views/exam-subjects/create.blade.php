<x-layouts::examination :title="'Add Exam Subject'">

    <style>
        .esc-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 85% 0%, rgba(117,97,255,.11), transparent 32rem),
                radial-gradient(circle at 0% 75%, rgba(82,112,255,.055), transparent 28rem);
        }

        .esc-wrap {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .esc-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        .esc-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .esc-icon {
            width: 54px;
            height: 54px;
            flex: 0 0 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 17px;
            color: #9e92ff;
            border: 1px solid rgba(117,97,255,.25);
            background: rgba(117,97,255,.09);
            box-shadow: 0 12px 35px rgba(117,97,255,.07);
        }

        .esc-icon svg {
            width: 25px;
            height: 25px;
        }

        .esc-eyebrow {
            margin-bottom: 4px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #706c8d;
        }

        .esc-title {
            margin: 0;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
            color: #fff;
        }

        .esc-subtitle {
            margin: 5px 0 0;
            color: #707078;
            font-size: 11px;
        }

        .esc-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            height: 40px;
            padding: 0 13px;
            border: 1px solid #2a2a31;
            border-radius: 10px;
            background: #111115;
            color: #85858d;
            text-decoration: none;
            font-size: 10px;
            font-weight: 680;
            transition: .2s ease;
        }

        .esc-back:hover {
            color: #aaa2ff;
            border-color: rgba(117,97,255,.28);
            background: rgba(117,97,255,.045);
        }

        .esc-back svg {
            width: 14px;
            height: 14px;
        }

        .esc-alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid rgba(215,133,140,.20);
            border-radius: 13px;
            background: rgba(215,133,140,.045);
            color: #d7a0a5;
            font-size: 10px;
            line-height: 1.55;
        }

        .esc-alert svg {
            width: 15px;
            height: 15px;
            flex: 0 0 15px;
            margin-top: 1px;
        }

        .esc-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 19px;
            background: #121216;
            box-shadow:
                0 18px 55px rgba(0,0,0,.16),
                inset 0 1px 0 rgba(255,255,255,.015);
        }

        .esc-card-head {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 17px 19px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .esc-card-head-icon {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #9e93ff;
            background: rgba(117,97,255,.08);
        }

        .esc-card-head-icon svg {
            width: 15px;
            height: 15px;
        }

        .esc-card-head-title {
            margin: 0;
            color: #e9e9ed;
            font-size: 11px;
            font-weight: 740;
        }

        .esc-card-head-text {
            margin-top: 3px;
            color: #5f5f68;
            font-size: 8px;
        }

        .esc-form {
            padding: 21px;
        }

        .esc-field {
            margin-bottom: 19px;
        }

        .esc-field:last-child {
            margin-bottom: 0;
        }

        .esc-label {
            display: block;
            margin-bottom: 8px;
            color: #cfcfd5;
            font-size: 10px;
            font-weight: 700;
        }

        .esc-required {
            color: #c98790;
        }

        .esc-input,
        .esc-textarea {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #2d2d35;
            border-radius: 11px;
            outline: none;
            background: #0c0c10;
            color: #e1e1e5;
            font-family: inherit;
            font-size: 10px;
            transition: .2s ease;
        }

        .esc-input {
            height: 44px;
            padding: 0 13px;
        }

        .esc-textarea {
            min-height: 105px;
            padding: 12px 13px;
            resize: vertical;
            line-height: 1.55;
        }

        .esc-input::placeholder,
        .esc-textarea::placeholder {
            color: #484850;
        }

        .esc-input:focus,
        .esc-textarea:focus {
            border-color: rgba(117,97,255,.65);
            box-shadow: 0 0 0 3px rgba(117,97,255,.07);
        }

        .esc-help {
            margin-top: 7px;
            color: #55555e;
            font-size: 8px;
            line-height: 1.55;
        }

        .esc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .esc-number-wrap {
            position: relative;
        }

        .esc-number {
            padding-right: 52px;
        }

        .esc-number-suffix {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #4f4f58;
            font-size: 8px;
            pointer-events: none;
        }

        .esc-status {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            background: rgba(255,255,255,.018);
        }

        .esc-status-content {
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .esc-status-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #9e93ff;
            background: rgba(117,97,255,.075);
        }

        .esc-status-icon svg {
            width: 15px;
            height: 15px;
        }

        .esc-status-title {
            color: #e0e0e4;
            font-size: 10px;
            font-weight: 700;
        }

        .esc-status-text {
            margin-top: 3px;
            max-width: 530px;
            color: #5b5b64;
            font-size: 8px;
            line-height: 1.5;
        }

        .esc-switch {
            position: relative;
            width: 42px;
            height: 23px;
            flex: 0 0 42px;
        }

        .esc-switch input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .esc-switch-track {
            position: absolute;
            inset: 0;
            border: 1px solid #35353d;
            border-radius: 999px;
            background: #1a1a20;
            cursor: pointer;
            transition: .2s ease;
        }

        .esc-switch-track::after {
            content: "";
            position: absolute;
            width: 17px;
            height: 17px;
            top: 2px;
            left: 2px;
            border-radius: 50%;
            background: #777780;
            transition: .2s ease;
        }

        .esc-switch input:checked + .esc-switch-track {
            border-color: rgba(117,97,255,.5);
            background: rgba(117,97,255,.24);
        }

        .esc-switch input:checked + .esc-switch-track::after {
            transform: translateX(18px);
            background: #a49aff;
        }

        .esc-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .esc-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 42px;
            padding: 0 15px;
            border: 1px solid #2a2a31;
            border-radius: 10px;
            background: #0e0e12;
            color: #777780;
            text-decoration: none;
            font-size: 10px;
            font-weight: 680;
            transition: .2s ease;
        }

        .esc-cancel:hover {
            color: #aaaab2;
            border-color: #383840;
        }

        .esc-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 42px;
            padding: 0 17px;
            border: 1px solid rgba(117,97,255,.48);
            border-radius: 10px;
            background: linear-gradient(135deg,#7561ff,#5b47e6);
            color: #fff;
            font-family: inherit;
            font-size: 10px;
            font-weight: 750;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(93,73,233,.17);
            transition: .2s ease;
        }

        .esc-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(93,73,233,.25);
        }

        .esc-submit svg {
            width: 14px;
            height: 14px;
        }

        @media (max-width: 700px) {
            .esc-page {
                padding: 17px;
            }

            .esc-header {
                align-items: stretch;
                flex-direction: column;
            }

            .esc-back {
                justify-content: center;
                width: 100%;
            }

            .esc-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .esc-page {
                padding: 11px;
            }

            .esc-heading {
                align-items: flex-start;
            }

            .esc-icon {
                width: 45px;
                height: 45px;
                flex-basis: 45px;
                border-radius: 13px;
            }

            .esc-title {
                font-size: 22px;
            }

            .esc-form {
                padding: 15px;
            }

            .esc-status {
                align-items: flex-start;
            }

            .esc-actions {
                flex-direction: column-reverse;
            }

            .esc-cancel,
            .esc-submit {
                width: 100%;
            }
        }
    </style>

    <div class="esc-page">
        <div class="esc-wrap">

            {{-- HEADER --}}
            <div class="esc-header">

                <div class="esc-heading">

                    <div class="esc-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"
                            />
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M4 18.5A2.5 2.5 0 0 1 6.5 16H20"
                            />
                        </svg>
                    </div>

                    <div>
                        <div class="esc-eyebrow">
                            Online Examination
                        </div>

                        <h1 class="esc-title">
                            Add Exam Subject
                        </h1>

                        <p class="esc-subtitle">
                            Create a structured subject for your examination question bank.
                        </p>
                    </div>

                </div>


                <a
                    href="{{ route('exam-subjects.index') }}"
                    class="esc-back"
                >
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M19 12H5m6 6-6-6 6-6"
                        />
                    </svg>

                    Subjects
                </a>

            </div>


            {{-- VALIDATION --}}
            @if($errors->any())

                <div class="esc-alert">

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.3 4.9 2.9 18a2 2 0 0 0 1.75 3h14.7a2 2 0 0 0 1.75 0L13.7 4.9a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>

                    <div>
                        <strong>Please fix the following errors:</strong>

                        <ul style="margin:7px 0 0 16px; padding:0;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>

            @endif


            {{-- FORM CARD --}}
            <div class="esc-card">

                <div class="esc-card-head">

                    <div class="esc-card-head-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 5v14M5 12h14"
                            />
                        </svg>
                    </div>

                    <div>
                        <h2 class="esc-card-head-title">
                            Subject Information
                        </h2>

                        <div class="esc-card-head-text">
                            Enter the basic details for this examination subject.
                        </div>
                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('exam-subjects.store') }}"
                    class="esc-form"
                >

                    @csrf


                    {{-- NAME --}}
                    <div class="esc-field">

                        <label class="esc-label" for="name">
                            Subject Name
                            <span class="esc-required">*</span>
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. General Knowledge"
                            required
                            autofocus
                            class="esc-input"
                        >

                        <div class="esc-help">
                            Use a clear subject name such as Mathematics, Reasoning,
                            General Knowledge, Rajasthan GK, or Current Affairs.
                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="esc-field">

                        <label class="esc-label" for="description">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Optional description about this subject..."
                            class="esc-textarea"
                        >{{ old('description') }}</textarea>

                        <div class="esc-help">
                            Optional. Describe the type or scope of questions that belong to this subject.
                        </div>

                    </div>


                    {{-- ORDER --}}
                    <div class="esc-grid">

                        <div class="esc-field">

                            <label class="esc-label" for="sort_order">
                                Display Order
                            </label>

                            <div class="esc-number-wrap">

                                <input
                                    id="sort_order"
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                                    max="9999"
                                    class="esc-input esc-number"
                                >

                                <span class="esc-number-suffix">
                                    ORDER
                                </span>

                            </div>

                            <div class="esc-help">
                                Lower numbers appear first.
                            </div>

                        </div>


                        {{-- STATUS --}}
                        <div class="esc-field">

                            <label class="esc-label">
                                Subject Status
                            </label>

                            <div class="esc-status">

                                <div class="esc-status-content">

                                    <div class="esc-status-icon">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M5 13l4 4L19 7"
                                            />
                                        </svg>
                                    </div>

                                    <div>
                                        <div class="esc-status-title">
                                            Active Subject
                                        </div>

                                        <div class="esc-status-text">
                                            Active subjects can be used while creating examination content.
                                        </div>
                                    </div>

                                </div>


                                <label class="esc-switch">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        @checked(old('is_active', true))
                                    >

                                    <span class="esc-switch-track"></span>

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- ACTIONS --}}
                    <div class="esc-actions">

                        <a
                            href="{{ route('exam-subjects.index') }}"
                            class="esc-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="esc-submit"
                        >
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Create Subject
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-layouts::examination>