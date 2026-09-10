<x-layouts::examination :title="'Create Exam Category'">
<style>
    /* =========================================================
       EXAM CATEGORY CREATE â€” PREMIUM UI
       Scoped styles so existing ERP CSS does not break this page
    ========================================================== */

    .ec-page {
        width: 100%;
        max-width: 1180px;
        margin: 0 auto;
        padding: 12px 20px 48px;
        color: #f4f4f5;
        box-sizing: border-box;
    }

    .ec-page *,
    .ec-page *::before,
    .ec-page *::after {
        box-sizing: border-box;
    }

    /* ---------- Header ---------- */

    .ec-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 30px;
    }

    .ec-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .ec-icon-box {
        width: 54px;
        height: 54px;
        flex: 0 0 54px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        border: 1px solid rgba(99, 102, 241, .25);
        background: linear-gradient(
            145deg,
            rgba(99, 102, 241, .18),
            rgba(79, 70, 229, .06)
        );
        color: #818cf8;
        box-shadow:
            inset 0 1px 0 rgba(255,255,255,.04),
            0 8px 25px rgba(0,0,0,.12);
    }

    .ec-icon-box svg {
        width: 25px;
        height: 25px;
    }

    .ec-breadcrumb {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 5px;
        font-size: 12px;
        color: #71717a;
    }

    .ec-breadcrumb a {
        color: #818cf8;
        text-decoration: none;
        transition: color .2s ease;
    }

    .ec-breadcrumb a:hover {
        color: #a5b4fc;
    }

    .ec-breadcrumb span {
        color: #52525b;
    }

    .ec-title {
        margin: 0;
        font-size: 29px;
        line-height: 1.2;
        font-weight: 750;
        letter-spacing: -.6px;
        color: #fafafa;
    }

    .ec-subtitle {
        margin: 7px 0 0;
        font-size: 14px;
        line-height: 1.6;
        color: #71717a;
    }

    .ec-back-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 42px;
        padding: 0 17px;
        border: 1px solid #27272a;
        border-radius: 12px;
        background: rgba(24,24,27,.8);
        color: #d4d4d8;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition:
            background .2s ease,
            border-color .2s ease,
            color .2s ease,
            transform .2s ease;
    }

    .ec-back-btn:hover {
        background: #27272a;
        border-color: #3f3f46;
        color: #fff;
        transform: translateY(-1px);
    }

    .ec-back-btn svg {
        width: 16px;
        height: 16px;
    }

    /* ---------- Grid ---------- */

    .ec-grid {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 310px;
        gap: 22px;
        align-items: start;
    }

    /* ---------- Main Card ---------- */

    .ec-card {
        overflow: hidden;
        border: 1px solid #27272a;
        border-radius: 20px;
        background:
            linear-gradient(
                145deg,
                rgba(24,24,27,.98),
                rgba(17,17,19,.98)
            );
        box-shadow:
            0 20px 55px rgba(0,0,0,.20),
            inset 0 1px 0 rgba(255,255,255,.025);
    }

    .ec-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 22px 24px;
        border-bottom: 1px solid #27272a;
    }

    .ec-card-header-icon {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(99,102,241,.10);
        color: #818cf8;
    }

    .ec-card-header-icon svg {
        width: 19px;
        height: 19px;
    }

    .ec-card-heading {
        margin: 0;
        font-size: 16px;
        line-height: 1.3;
        font-weight: 700;
        color: #f4f4f5;
    }

    .ec-card-description {
        margin: 4px 0 0;
        font-size: 12px;
        color: #71717a;
        line-height: 1.5;
    }

    .ec-form-body {
        padding: 25px 24px;
    }

    /* ---------- Fields ---------- */

    .ec-field {
        margin-bottom: 23px;
    }

    .ec-field:last-child {
        margin-bottom: 0;
    }

    .ec-label-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 9px;
    }

    .ec-label {
        display: block;
        font-size: 13px;
        font-weight: 650;
        color: #d4d4d8;
    }

    .ec-required,
    .ec-optional {
        font-size: 11px;
        font-weight: 500;
        color: #52525b;
    }

    .ec-input,
    .ec-textarea {
        width: 100%;
        display: block;
        border: 1px solid #303034;
        border-radius: 13px;
        background: #101012;
        color: #f4f4f5;
        font-family: inherit;
        font-size: 13px;
        outline: none;
        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .ec-input {
        height: 49px;
        padding: 0 15px;
    }

    .ec-textarea {
        min-height: 125px;
        padding: 14px 15px;
        line-height: 1.6;
        resize: vertical;
    }

    .ec-input::placeholder,
    .ec-textarea::placeholder {
        color: #52525b;
    }

    .ec-input:hover,
    .ec-textarea:hover {
        border-color: #3f3f46;
        background: #121214;
    }

    .ec-input:focus,
    .ec-textarea:focus {
        border-color: rgba(99,102,241,.85);
        background: #111114;
        box-shadow:
            0 0 0 3px rgba(99,102,241,.10),
            0 8px 25px rgba(0,0,0,.12);
    }

    .ec-help {
        margin: 7px 0 0;
        font-size: 11px;
        line-height: 1.55;
        color: #52525b;
    }

    /* ---------- Settings ---------- */

    .ec-settings {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
        margin-top: 2px;
    }

    .ec-setting-card {
        min-width: 0;
        padding: 17px;
        border: 1px solid #27272a;
        border-radius: 15px;
        background: rgba(9,9,11,.38);
    }

    .ec-setting-top {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        margin-bottom: 13px;
    }

    .ec-setting-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: #18181b;
        color: #a1a1aa;
    }

    .ec-setting-icon svg {
        width: 16px;
        height: 16px;
    }

    .ec-setting-title {
        margin: 0;
        font-size: 12px;
        font-weight: 650;
        color: #d4d4d8;
    }

    .ec-setting-text {
        margin: 3px 0 0;
        font-size: 10.5px;
        line-height: 1.45;
        color: #52525b;
    }

    .ec-number {
        width: 100%;
        height: 43px;
        padding: 0 12px;
        border: 1px solid #303034;
        border-radius: 11px;
        background: #111113;
        color: #f4f4f5;
        font-size: 13px;
        outline: none;
    }

    .ec-number:focus {
        border-color: rgba(99,102,241,.75);
        box-shadow: 0 0 0 3px rgba(99,102,241,.08);
    }

    /* ---------- Toggle ---------- */

    .ec-active-card {
        cursor: pointer;
        transition:
            border-color .2s ease,
            background .2s ease;
    }

    .ec-active-card:hover {
        border-color: rgba(16,185,129,.25);
        background: rgba(16,185,129,.025);
    }

    .ec-active-row {
        display: flex;
        align-items: flex-start;
        gap: 11px;
    }

    .ec-checkbox {
        width: 18px;
        height: 18px;
        flex: 0 0 18px;
        margin-top: 1px;
        appearance: none;
        -webkit-appearance: none;
        border: 1px solid #52525b;
        border-radius: 5px;
        background: #18181b;
        cursor: pointer;
        position: relative;
    }

    .ec-checkbox:checked {
        border-color: #10b981;
        background: #10b981;
    }

    .ec-checkbox:checked::after {
        content: "";
        position: absolute;
        left: 5px;
        top: 2px;
        width: 5px;
        height: 9px;
        border: solid #052e1f;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .ec-active-content {
        min-width: 0;
    }

    .ec-active-title-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 7px;
    }

    .ec-active-title {
        font-size: 12px;
        font-weight: 650;
        color: #d4d4d8;
    }

    .ec-recommended {
        padding: 3px 7px;
        border-radius: 999px;
        background: rgba(16,185,129,.08);
        color: #34d399;
        font-size: 8px;
        font-weight: 750;
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .ec-active-description {
        margin: 6px 0 0;
        font-size: 10.5px;
        line-height: 1.5;
        color: #52525b;
    }

    /* ---------- Actions ---------- */

    .ec-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 21px;
        border-top: 1px solid #27272a;
    }

    .ec-cancel,
    .ec-submit {
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 0 20px;
        border-radius: 12px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 650;
        text-decoration: none;
        cursor: pointer;
        transition:
            transform .2s ease,
            background .2s ease,
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .ec-cancel {
        border: 1px solid #303034;
        background: #18181b;
        color: #a1a1aa;
    }

    .ec-cancel:hover {
        border-color: #3f3f46;
        background: #27272a;
        color: #f4f4f5;
        transform: translateY(-1px);
    }

    .ec-submit {
        border: 1px solid rgba(99,102,241,.55);
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff;
        box-shadow:
            0 8px 22px rgba(79,70,229,.20),
            inset 0 1px 0 rgba(255,255,255,.10);
    }

    .ec-submit:hover {
        background: linear-gradient(135deg, #818cf8, #6366f1);
        box-shadow:
            0 10px 28px rgba(79,70,229,.28),
            inset 0 1px 0 rgba(255,255,255,.12);
        transform: translateY(-1px);
    }

    .ec-submit svg,
    .ec-cancel svg {
        width: 16px;
        height: 16px;
    }

    /* ---------- Right Side ---------- */

    .ec-side {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .ec-side-card {
        border: 1px solid #27272a;
        border-radius: 18px;
        background: #18181b;
        padding: 19px;
        box-shadow:
            0 12px 35px rgba(0,0,0,.10),
            inset 0 1px 0 rgba(255,255,255,.018);
    }

    .ec-side-header {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .ec-side-icon {
        width: 37px;
        height: 37px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: rgba(99,102,241,.09);
        color: #818cf8;
    }

    .ec-side-icon svg {
        width: 17px;
        height: 17px;
    }

    .ec-side-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #f4f4f5;
    }

    .ec-side-subtitle {
        margin: 3px 0 0;
        font-size: 10.5px;
        color: #52525b;
    }

    /* Preview */

    .ec-preview {
        margin-top: 16px;
        padding: 14px;
        border: 1px solid #27272a;
        border-radius: 14px;
        background: #101012;
    }

    .ec-preview-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ec-preview-avatar {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: rgba(99,102,241,.10);
        color: #818cf8;
        font-size: 14px;
        font-weight: 750;
    }

    .ec-preview-name {
        min-width: 0;
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 12px;
        font-weight: 650;
        color: #d4d4d8;
    }

    .ec-preview-status {
        margin-top: 3px;
        font-size: 10px;
        color: #52525b;
    }

    .ec-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 13px;
        font-size: 10px;
        font-weight: 600;
        color: #34d399;
    }

    .ec-status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 3px rgba(16,185,129,.08);
    }

    /* Steps */

    .ec-steps {
        margin-top: 17px;
    }

    .ec-step {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding-bottom: 16px;
        position: relative;
    }

    .ec-step:last-child {
        padding-bottom: 0;
    }

    .ec-step-number {
        width: 25px;
        height: 25px;
        flex: 0 0 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: rgba(99,102,241,.09);
        color: #818cf8;
        font-size: 9px;
        font-weight: 750;
    }

    .ec-step:not(:last-child)::after {
        content: "";
        position: absolute;
        left: 12px;
        top: 25px;
        width: 1px;
        height: calc(100% - 25px);
        background: #27272a;
    }

    .ec-step-text {
        margin: 3px 0 0;
        font-size: 10.5px;
        line-height: 1.55;
        color: #71717a;
    }

    .ec-step-text strong {
        color: #a1a1aa;
        font-weight: 600;
    }

    /* Tip */

    .ec-tip {
        border-color: rgba(99,102,241,.16);
        background:
            linear-gradient(
                145deg,
                rgba(99,102,241,.07),
                rgba(24,24,27,.98)
            );
    }

    .ec-tip-content {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .ec-tip-icon {
        width: 28px;
        height: 28px;
        flex: 0 0 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: rgba(99,102,241,.10);
        color: #818cf8;
    }

    .ec-tip-icon svg {
        width: 15px;
        height: 15px;
    }

    .ec-tip-title {
        margin: 0;
        font-size: 11.5px;
        font-weight: 700;
        color: #a5b4fc;
    }

    .ec-tip-text {
        margin: 5px 0 0;
        font-size: 10px;
        line-height: 1.6;
        color: #71717a;
    }

    /* ---------- Errors ---------- */

    .ec-errors {
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid rgba(239,68,68,.20);
        border-radius: 14px;
        background: rgba(239,68,68,.07);
    }

    .ec-errors-title {
        margin: 0 0 7px;
        font-size: 12px;
        font-weight: 700;
        color: #fca5a5;
    }

    .ec-errors ul {
        margin: 0;
        padding-left: 17px;
        color: #f87171;
        font-size: 11px;
        line-height: 1.7;
    }

    /* ---------- Mobile ---------- */

    @media (max-width: 980px) {
        .ec-grid {
            grid-template-columns: 1fr;
        }

        .ec-side {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 720px) {
        .ec-page {
            padding: 8px 14px 35px;
        }

        .ec-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 22px;
        }

        .ec-header-left {
            width: 100%;
        }

        .ec-back-btn {
            width: 100%;
        }

        .ec-title {
            font-size: 24px;
        }

        .ec-subtitle {
            font-size: 13px;
        }

        .ec-grid {
            gap: 15px;
        }

        .ec-card-header {
            padding: 18px;
        }

        .ec-form-body {
            padding: 19px 17px;
        }

        .ec-settings {
            grid-template-columns: 1fr;
        }

        .ec-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }

        .ec-cancel,
        .ec-submit {
            width: 100%;
        }

        .ec-side {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .ec-icon-box {
            width: 46px;
            height: 46px;
            flex-basis: 46px;
            border-radius: 14px;
        }

        .ec-icon-box svg {
            width: 21px;
            height: 21px;
        }

        .ec-header-left {
            gap: 12px;
        }

        .ec-title {
            font-size: 21px;
        }

        .ec-card {
            border-radius: 16px;
        }

        .ec-card-header {
            gap: 10px;
        }

        .ec-card-header-icon {
            width: 36px;
            height: 36px;
            flex-basis: 36px;
        }

        .ec-form-body {
            padding: 17px 14px;
        }
    }
</style>


<div class="ec-page">

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="ec-header">

        <div class="ec-header-left">

            <div class="ec-icon-box">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="M9 5h6m-7 4h8M7 13h10M7 17h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"
                    />
                </svg>
            </div>

            <div>

                <div class="ec-breadcrumb">
                    <a href="{{ route('exam-categories.index') }}">
                        Exam Categories
                    </a>

                    <span>/</span>

                    <span>Create</span>
                </div>

                <h1 class="ec-title">
                    Create Exam Category
                </h1>

                <p class="ec-subtitle">
                    Organize your online exams into clear and manageable categories.
                </p>

            </div>

        </div>


        <a
            href="{{ route('exam-categories.index') }}"
            class="ec-back-btn"
        >
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                />
            </svg>

            Back to Categories
        </a>

    </div>


    {{-- =========================================================
         VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="ec-errors">

            <p class="ec-errors-title">
                Please fix the following:
            </p>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- =========================================================
         CONTENT GRID
    ========================================================== --}}
    <div class="ec-grid">


        {{-- =====================================================
             MAIN FORM
        ====================================================== --}}
        <div>

            <form
                method="POST"
                action="{{ route('exam-categories.store') }}"
            >

                @csrf

                <div class="ec-card">

                    {{-- CARD HEADER --}}
                    <div class="ec-card-header">

                        <div class="ec-card-header-icon">

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

                            <h2 class="ec-card-heading">
                                Category Details
                            </h2>

                            <p class="ec-card-description">
                                Add the basic information for this exam category.
                            </p>

                        </div>

                    </div>


                    {{-- FORM BODY --}}
                    <div class="ec-form-body">


                        {{-- CATEGORY NAME --}}
                        <div class="ec-field">

                            <div class="ec-label-row">

                                <label
                                    for="name"
                                    class="ec-label"
                                >
                                    Category Name
                                </label>

                                <span class="ec-required">
                                    Required
                                </span>

                            </div>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                maxlength="255"
                                required
                                autofocus
                                autocomplete="off"
                                placeholder="e.g. General Knowledge"
                                class="ec-input"
                            >

                            <p class="ec-help">
                                Choose a short and recognizable name that admins can easily identify.
                            </p>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="ec-field">

                            <div class="ec-label-row">

                                <label
                                    for="description"
                                    class="ec-label"
                                >
                                    Description
                                </label>

                                <span class="ec-optional">
                                    Optional
                                </span>

                            </div>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                maxlength="1000"
                                placeholder="e.g. Practice tests and mock examinations for general knowledge."
                                class="ec-textarea"
                            >{{ old('description') }}</textarea>

                            <p class="ec-help">
                                Add a short explanation so administrators understand what exams belong here.
                            </p>

                        </div>


                        {{-- SETTINGS --}}
                        <div class="ec-settings">


                            {{-- DISPLAY ORDER --}}
                            <div class="ec-setting-card">

                                <div class="ec-setting-top">

                                    <div class="ec-setting-icon">

                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M4 6h16M4 12h16M4 18h16"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="ec-setting-title">
                                            Display Order
                                        </p>

                                        <p class="ec-setting-text">
                                            Lower numbers appear first.
                                        </p>

                                    </div>

                                </div>

                                <input
                                    id="sort_order"
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                                    max="9999"
                                    class="ec-number"
                                >

                            </div>


                            {{-- ACTIVE --}}
                            <label
                                for="is_active"
                                class="ec-setting-card ec-active-card"
                            >

                                <div class="ec-active-row">

                                    <input
                                        id="is_active"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        @checked(old('is_active', true))
                                        class="ec-checkbox"
                                    >

                                    <div class="ec-active-content">

                                        <div class="ec-active-title-row">

                                            <span class="ec-active-title">
                                                Active Category
                                            </span>

                                            <span class="ec-recommended">
                                                Recommended
                                            </span>

                                        </div>

                                        <p class="ec-active-description">
                                            Active categories will appear when creating exams.
                                        </p>

                                    </div>

                                </div>

                            </label>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="ec-actions">

                            <a
                                href="{{ route('exam-categories.index') }}"
                                class="ec-cancel"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="ec-submit"
                            >

                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Create Category

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>


        {{-- =====================================================
             RIGHT SIDEBAR
        ====================================================== --}}
        <div class="ec-side">


            {{-- PREVIEW --}}
            <div class="ec-side-card">

                <div class="ec-side-header">

                    <div class="ec-side-icon">

                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M9 5h6m-7 4h8M7 13h10M7 17h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="ec-side-title">
                            Category Preview
                        </h3>

                        <p class="ec-side-subtitle">
                            Quick visual overview
                        </p>

                    </div>

                </div>


                <div class="ec-preview">

                    <div class="ec-preview-top">

                        <div class="ec-preview-avatar">
                            ?
                        </div>

                        <div style="min-width:0;">

                            <p class="ec-preview-name">
                                New Exam Category
                            </p>

                            <p class="ec-preview-status">
                                Ready to create
                            </p>

                        </div>

                    </div>


                    <div class="ec-status">

                        <span class="ec-status-dot"></span>

                        Active

                    </div>

                </div>

            </div>


            {{-- HOW IT WORKS --}}
            <div class="ec-side-card">

                <div class="ec-side-header">

                    <div class="ec-side-icon">

                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 6v12m6-6H6"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="ec-side-title">
                            How it works
                        </h3>

                        <p class="ec-side-subtitle">
                            Simple 3-step workflow
                        </p>

                    </div>

                </div>


                <div class="ec-steps">

                    <div class="ec-step">

                        <div class="ec-step-number">
                            1
                        </div>

                        <p class="ec-step-text">
                            <strong>Create a category</strong><br>
                            Example: General Knowledge, SSC or Mock Tests.
                        </p>

                    </div>


                    <div class="ec-step">

                        <div class="ec-step-number">
                            2
                        </div>

                        <p class="ec-step-text">
                            <strong>Create your exam</strong><br>
                            Select this category while setting up an exam.
                        </p>

                    </div>


                    <div class="ec-step">

                        <div class="ec-step-number">
                            3
                        </div>

                        <p class="ec-step-text">
                            <strong>Add questions</strong><br>
                            Build the question paper and publish it to students.
                        </p>

                    </div>

                </div>

            </div>


            {{-- TIP --}}
            <div class="ec-side-card ec-tip">

                <div class="ec-tip-content">

                    <div class="ec-tip-icon">

                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 18h.01M9.09 9a3 3 0 115.83 1c0 2-2.92 2.2-2.92 4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 22a10 10 0 100-20 10 10 0 000 20z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="ec-tip-title">
                            Good to know
                        </h3>

                        <p class="ec-tip-text">
                            You can deactivate a category later instead of deleting it.
                            This keeps your exam organization clean and preserves history.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts::examination>
