<x-layouts::examination :title="'Edit Exam Subject'">

    <style>
        .ese-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 85% 0%, rgba(117,97,255,.11), transparent 32rem),
                radial-gradient(circle at 0% 75%, rgba(82,112,255,.055), transparent 28rem);
        }

        .ese-wrap {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        .ese-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 20px;
        }

        .ese-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .ese-icon {
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

        .ese-icon svg {
            width: 25px;
            height: 25px;
        }

        .ese-eyebrow {
            margin-bottom: 4px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #706c8d;
        }

        .ese-title {
            margin: 0;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
            color: #fff;
        }

        .ese-subtitle {
            margin: 5px 0 0;
            color: #707078;
            font-size: 11px;
        }

        .ese-back {
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

        .ese-back:hover {
            color: #aaa2ff;
            border-color: rgba(117,97,255,.28);
            background: rgba(117,97,255,.045);
        }

        .ese-back svg {
            width: 14px;
            height: 14px;
        }

        .ese-alert {
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

        .ese-alert svg {
            width: 15px;
            height: 15px;
            flex: 0 0 15px;
            margin-top: 1px;
        }

        .ese-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 19px;
            background: #121216;
            box-shadow:
                0 18px 55px rgba(0,0,0,.16),
                inset 0 1px 0 rgba(255,255,255,.015);
        }

        .ese-card-head {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 17px 19px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .ese-card-head-icon {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #9e93ff;
            background: rgba(117,97,255,.08);
        }

        .ese-card-head-icon svg {
            width: 15px;
            height: 15px;
        }

        .ese-card-head-title {
            margin: 0;
            color: #e9e9ed;
            font-size: 11px;
            font-weight: 740;
        }

        .ese-card-head-text {
            margin-top: 3px;
            color: #5f5f68;
            font-size: 8px;
        }

        .ese-form {
            padding: 21px;
        }

        .ese-field {
            margin-bottom: 19px;
        }

        .ese-label {
            display: block;
            margin-bottom: 8px;
            color: #cfcfd5;
            font-size: 10px;
            font-weight: 700;
        }

        .ese-required {
            color: #c98790;
        }

        .ese-input,
        .ese-textarea {
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

        .ese-input {
            height: 44px;
            padding: 0 13px;
        }

        .ese-textarea {
            min-height: 105px;
            padding: 12px 13px;
            resize: vertical;
            line-height: 1.55;
        }

        .ese-input::placeholder,
        .ese-textarea::placeholder {
            color: #484850;
        }

        .ese-input:focus,
        .ese-textarea:focus {
            border-color: rgba(117,97,255,.65);
            box-shadow: 0 0 0 3px rgba(117,97,255,.07);
        }

        .ese-help {
            margin-top: 7px;
            color: #55555e;
            font-size: 8px;
            line-height: 1.55;
        }

        .ese-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .ese-number-wrap {
            position: relative;
        }

        .ese-number {
            padding-right: 52px;
        }

        .ese-number-suffix {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #4f4f58;
            font-size: 8px;
            pointer-events: none;
        }

        .ese-status {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            min-height: 44px;
            padding: 10px 13px;
            box-sizing: border-box;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            background: rgba(255,255,255,.018);
        }

        .ese-status-content {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ese-status-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #9e93ff;
            background: rgba(117,97,255,.075);
        }

        .ese-status-icon svg {
            width: 14px;
            height: 14px;
        }

        .ese-status-title {
            color: #e0e0e4;
            font-size: 9px;
            font-weight: 700;
        }

        .ese-status-text {
            margin-top: 2px;
            color: #5b5b64;
            font-size: 7px;
        }

        .ese-switch {
            position: relative;
            width: 42px;
            height: 23px;
            flex: 0 0 42px;
        }

        .ese-switch input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .ese-switch-track {
            position: absolute;
            inset: 0;
            border: 1px solid #35353d;
            border-radius: 999px;
            background: #1a1a20;
            cursor: pointer;
            transition: .2s ease;
        }

        .ese-switch-track::after {
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

        .ese-switch input:checked + .ese-switch-track {
            border-color: rgba(117,97,255,.5);
            background: rgba(117,97,255,.24);
        }

        .ese-switch input:checked + .ese-switch-track::after {
            transform: translateX(18px);
            background: #a49aff;
        }

        .ese-info {
            margin-top: 2px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 13px;
            background: rgba(255,255,255,.016);
        }

        .ese-info-title {
            margin-bottom: 11px;
            color: #a5a5ad;
            font-size: 9px;
            font-weight: 720;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .ese-info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .ese-info-label {
            color: #50505a;
            font-size: 7px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .ese-info-value {
            margin-top: 4px;
            color: #8b8b94;
            font-size: 9px;
            line-height: 1.45;
            word-break: break-word;
        }

        .ese-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .ese-cancel {
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

        .ese-cancel:hover {
            color: #aaaab2;
            border-color: #383840;
        }

        .ese-submit {
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

        .ese-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 30px rgba(93,73,233,.25);
        }

        .ese-submit svg {
            width: 14px;
            height: 14px;
        }

        @media (max-width: 700px) {
            .ese-page {
                padding: 17px;
            }

            .ese-header {
                align-items: stretch;
                flex-direction: column;
            }

            .ese-back {
                justify-content: center;
                width: 100%;
            }

            .ese-grid,
            .ese-info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .ese-page {
                padding: 11px;
            }

            .ese-heading {
                align-items: flex-start;
            }

            .ese-icon {
                width: 45px;
                height: 45px;
                flex-basis: 45px;
                border-radius: 13px;
            }

            .ese-title {
                font-size: 22px;
            }

            .ese-form {
                padding: 15px;
            }

            .ese-actions {
                flex-direction: column-reverse;
            }

            .ese-cancel,
            .ese-submit {
                width: 100%;
            }
        }
    </style>

    <div class="ese-page">
        <div class="ese-wrap">

            {{-- HEADER --}}
            <div class="ese-header">

                <div class="ese-heading">

                    <div class="ese-icon">
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
                        <div class="ese-eyebrow">
                            Online Examination
                        </div>

                        <h1 class="ese-title">
                            Edit Exam Subject
                        </h1>

                        <p class="ese-subtitle">
                            Update subject information and examination management settings.
                        </p>
                    </div>

                </div>


                <a
                    href="{{ route('exam-subjects.index') }}"
                    class="ese-back"
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

                <div class="ese-alert">

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
            <div class="ese-card">

                <div class="ese-card-head">

                    <div class="ese-card-head-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="m15 5 4 4M4 20l4.2-1 10.1-10.1a2.8 2.8 0 0 0-4-4L4.2 15 4 20Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h2 class="ese-card-head-title">
                            Subject Information
                        </h2>

                        <div class="ese-card-head-text">
                            Update the details used throughout the examination question bank.
                        </div>
                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('exam-subjects.update', $examSubject) }}"
                    class="ese-form"
                >

                    @csrf
                    @method('PUT')


                    {{-- NAME --}}
                    <div class="ese-field">

                        <label
                            class="ese-label"
                            for="name"
                        >
                            Subject Name
                            <span class="ese-required">*</span>
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name', $examSubject->name) }}"
                            placeholder="e.g. General Knowledge"
                            required
                            autofocus
                            class="ese-input"
                        >

                        <div class="ese-help">
                            Use a clear subject name such as Mathematics, Reasoning,
                            General Knowledge, Rajasthan GK, or Current Affairs.
                        </div>

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="ese-field">

                        <label
                            class="ese-label"
                            for="description"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Optional description about this subject..."
                            class="ese-textarea"
                        >{{ old('description', $examSubject->description) }}</textarea>

                        <div class="ese-help">
                            Optional. Describe the type or scope of questions that belong to this subject.
                        </div>

                    </div>


                    {{-- ORDER + STATUS --}}
                    <div class="ese-grid">

                        <div class="ese-field">

                            <label
                                class="ese-label"
                                for="sort_order"
                            >
                                Display Order
                            </label>

                            <div class="ese-number-wrap">

                                <input
                                    id="sort_order"
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order', $examSubject->sort_order) }}"
                                    min="0"
                                    max="9999"
                                    class="ese-input ese-number"
                                >

                                <span class="ese-number-suffix">
                                    ORDER
                                </span>

                            </div>

                            <div class="ese-help">
                                Lower numbers appear first.
                            </div>

                        </div>


                        <div class="ese-field">

                            <label class="ese-label">
                                Subject Status
                            </label>

                            <div class="ese-status">

                                <div class="ese-status-content">

                                    <div class="ese-status-icon">
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
                                        <div class="ese-status-title">
                                            Active Subject
                                        </div>

                                        <div class="ese-status-text">
                                            Available for examination content
                                        </div>
                                    </div>

                                </div>


                                <label class="ese-switch">

                                    <input
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        @checked(old('is_active', $examSubject->is_active))
                                    >

                                    <span class="ese-switch-track"></span>

                                </label>

                            </div>

                        </div>

                    </div>


                    {{-- SUBJECT INFORMATION --}}
                    <div class="ese-info">

                        <div class="ese-info-title">
                            Subject Information
                        </div>

                        <div class="ese-info-grid">

                            <div>
                                <div class="ese-info-label">
                                    Current Slug
                                </div>

                                <div class="ese-info-value">
                                    {{ $examSubject->slug }}
                                </div>
                            </div>


                            <div>
                                <div class="ese-info-label">
                                    Created
                                </div>

                                <div class="ese-info-value">
                                    {{ $examSubject->created_at?->format('d M Y, h:i A') }}
                                </div>
                            </div>

                        </div>

                    </div>


                    {{-- ACTIONS --}}
                    <div class="ese-actions">

                        <a
                            href="{{ route('exam-subjects.index') }}"
                            class="ese-cancel"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="ese-submit"
                        >
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m5 12 4 4L19 6"
                                />
                            </svg>

                            Update Subject
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-layouts::examination>