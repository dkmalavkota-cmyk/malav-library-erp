<x-layouts::examination :title="'Question Paper'">

<style>
    .qp-page {
        --qp-bg: #09090b;
        --qp-card: #111113;
        --qp-card-2: #151518;
        --qp-border: #27272a;
        --qp-border-hover: #3f3f46;
        --qp-text: #fafafa;
        --qp-muted: #a1a1aa;
        --qp-dim: #71717a;
        --qp-accent: #818cf8;
        --qp-accent-bg: rgba(99,102,241,.10);

        min-height: 100vh;
        background:
            radial-gradient(
                circle at 85% 0%,
                rgba(99,102,241,.08),
                transparent 30rem
            ),
            var(--qp-bg);
        color: var(--qp-text);
    }

    .qp-container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
        padding: 32px 0 55px;
    }

    /* HEADER */

    .qp-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 25px;
    }

    .qp-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 12px;
        color: #71717a;
        font-size: 12px;
    }

    .qp-breadcrumb a {
        color: #a1a1aa;
        text-decoration: none;
    }

    .qp-breadcrumb a:hover {
        color: #fff;
    }

    .qp-heading {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .qp-main-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 14px;
        background: rgba(99,102,241,.10);
        border: 1px solid rgba(129,140,248,.18);
        color: #a5b4fc;
    }

    .qp-main-icon svg {
        width: 21px;
        height: 21px;
    }

    .qp-title {
        margin: 0;
        color: #fff;
        font-size: 29px;
        line-height: 1.15;
        font-weight: 700;
        letter-spacing: -.025em;
    }

    .qp-subtitle {
        margin: 6px 0 0;
        color: #71717a;
        font-size: 13px;
        line-height: 1.5;
    }

    .qp-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 42px;
        padding: 0 15px;
        border: 1px solid #27272a;
        border-radius: 11px;
        background: #111113;
        color: #d4d4d8 !important;
        text-decoration: none !important;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .qp-back:hover {
        background: #18181b;
        border-color: #3f3f46;
        color: #fff !important;
    }

    /* FLASH */

    .qp-alert {
        margin-bottom: 18px;
        padding: 13px 15px;
        border: 1px solid rgba(16,185,129,.20);
        border-radius: 12px;
        background: rgba(16,185,129,.06);
        color: #6ee7b7;
        font-size: 12px;
    }

    .qp-error {
        margin-bottom: 18px;
        padding: 13px 15px;
        border: 1px solid rgba(239,68,68,.20);
        border-radius: 12px;
        background: rgba(239,68,68,.06);
        color: #fca5a5;
        font-size: 12px;
    }

    .qp-error ul {
        margin: 5px 0 0;
        padding-left: 18px;
    }

    /* EXAM SUMMARY */

    .qp-summary {
        display: grid;
        grid-template-columns: minmax(0, 1.7fr) repeat(4, minmax(120px, .7fr));
        gap: 10px;
        margin-bottom: 18px;
    }

    .qp-summary-card {
        min-height: 82px;
        padding: 15px;
        border: 1px solid var(--qp-border);
        border-radius: 15px;
        background: rgba(17,17,19,.94);
    }

    .qp-summary-main {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .qp-summary-icon {
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 11px;
        background: var(--qp-accent-bg);
        color: #a5b4fc;
    }

    .qp-summary-icon svg {
        width: 18px;
        height: 18px;
    }

    .qp-summary-label {
        color: #71717a;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .qp-summary-value {
        margin-top: 4px;
        color: #f4f4f5;
        font-size: 16px;
        font-weight: 650;
    }

    .qp-summary-number {
        color: #f4f4f5;
        font-size: 21px;
        line-height: 1;
        font-weight: 700;
    }

    .qp-summary-small {
        margin-top: 6px;
        color: #52525b;
        font-size: 10px;
    }

    /* MAIN GRID */

    .qp-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
        gap: 18px;
        align-items: start;
    }

    .qp-card {
        overflow: hidden;
        border: 1px solid var(--qp-border);
        border-radius: 17px;
        background: rgba(17,17,19,.95);
        box-shadow:
            0 20px 45px rgba(0,0,0,.13),
            inset 0 1px 0 rgba(255,255,255,.015);
    }

    .qp-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--qp-border);
    }

    .qp-card-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .qp-section-icon {
        width: 36px;
        height: 36px;
        flex: 0 0 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(14,165,233,.09);
        color: #7dd3fc;
    }

    .qp-section-icon.green {
        background: rgba(16,185,129,.09);
        color: #6ee7b7;
    }

    .qp-section-icon svg {
        width: 17px;
        height: 17px;
    }

    .qp-card-title {
        margin: 0;
        color: #f4f4f5;
        font-size: 14px;
        font-weight: 650;
    }

    .qp-card-description {
        margin: 3px 0 0;
        color: #71717a;
        font-size: 11px;
    }

    .qp-count-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 30px;
        height: 24px;
        padding: 0 8px;
        border-radius: 999px;
        background: #1c1c20;
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 700;
    }

    .qp-card-body {
        padding: 17px;
    }

    /* AVAILABLE QUESTIONS */

    .qp-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 13px;
    }

    .qp-select-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #a1a1aa;
        font-size: 11px;
        cursor: pointer;
    }

    .qp-select-all input {
        width: 15px !important;
        height: 15px !important;
        margin: 0 !important;
        accent-color: #6366f1;
        cursor: pointer;
    }

    .qp-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 36px;
        padding: 0 13px;
        border: 1px solid #6366f1;
        border-radius: 9px;
        background: #6366f1;
        color: #fff;
        font-family: inherit;
        font-size: 11px;
        font-weight: 650;
        cursor: pointer;
        transition: .2s ease;
    }

    .qp-add-btn:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        transform: translateY(-1px);
    }

    .qp-add-btn:disabled {
        opacity: .45;
        cursor: not-allowed;
        transform: none;
    }

    .qp-question-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
        max-height: 650px;
        overflow-y: auto;
        padding-right: 2px;
    }

    .qp-question-list::-webkit-scrollbar {
        width: 5px;
    }

    .qp-question-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .qp-question-list::-webkit-scrollbar-thumb {
        background: #27272a;
        border-radius: 999px;
    }

    .qp-question-item {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 13px;
        border: 1px solid #27272a;
        border-radius: 12px;
        background: #0d0d0f;
        transition: .18s ease;
    }

    .qp-question-item:hover {
        border-color: #3f3f46;
        background: #101012;
    }

    .qp-question-checkbox {
        width: 16px !important;
        height: 16px !important;
        flex: 0 0 16px;
        margin: 2px 0 0 !important;
        accent-color: #6366f1;
        cursor: pointer;
    }

    .qp-question-content {
        min-width: 0;
        flex: 1;
    }

    .qp-question-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
    }

    .qp-question-text {
        margin: 0;
        color: #e4e4e7;
        font-size: 12px;
        line-height: 1.6;
        font-weight: 500;
    }

    .qp-question-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }

    .qp-meta {
        display: inline-flex;
        align-items: center;
        min-height: 20px;
        padding: 0 7px;
        border-radius: 6px;
        background: #18181b;
        color: #71717a;
        font-size: 9px;
        font-weight: 600;
    }

    .qp-meta.subject {
        background: rgba(99,102,241,.08);
        color: #a5b4fc;
    }

    .qp-meta.topic {
        background: rgba(14,165,233,.08);
        color: #7dd3fc;
    }

    .qp-meta.marks {
        background: rgba(16,185,129,.08);
        color: #6ee7b7;
    }

    /* EMPTY */

    .qp-empty {
        padding: 40px 20px;
        text-align: center;
        border: 1px dashed #27272a;
        border-radius: 13px;
        background: #0d0d0f;
    }

    .qp-empty-icon {
        width: 42px;
        height: 42px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #18181b;
        color: #71717a;
    }

    .qp-empty-icon svg {
        width: 19px;
        height: 19px;
    }

    .qp-empty-title {
        margin: 0;
        color: #a1a1aa;
        font-size: 13px;
        font-weight: 600;
    }

    .qp-empty-text {
        margin: 5px auto 0;
        max-width: 340px;
        color: #52525b;
        font-size: 11px;
        line-height: 1.6;
    }

    /* CURRENT PAPER */

    .qp-current-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .qp-current-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px;
        border: 1px solid #27272a;
        border-radius: 12px;
        background: #0d0d0f;
    }

    .qp-drag {
        width: 24px;
        height: 28px;
        flex: 0 0 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #52525b;
        cursor: grab;
    }

    .qp-drag svg {
        width: 15px;
        height: 15px;
    }

    .qp-current-number {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: rgba(99,102,241,.09);
        color: #a5b4fc;
        font-size: 10px;
        font-weight: 700;
    }

    .qp-current-content {
        min-width: 0;
        flex: 1;
    }

    .qp-current-text {
        margin: 0;
        color: #d4d4d8;
        font-size: 11px;
        line-height: 1.55;
    }

    .qp-current-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 7px;
    }

    .qp-remove {
        width: 29px;
        height: 29px;
        flex: 0 0 29px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #27272a;
        border-radius: 8px;
        background: #111113;
        color: #71717a;
        cursor: pointer;
        transition: .2s ease;
    }

    .qp-remove:hover {
        border-color: rgba(239,68,68,.30);
        background: rgba(239,68,68,.07);
        color: #f87171;
    }

    .qp-remove svg {
        width: 14px;
        height: 14px;
    }

    /* PAPER FOOTER */

    .qp-paper-footer {
        margin-top: 14px;
        padding-top: 14px;
        border-top: 1px solid #27272a;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .qp-paper-total-label {
        color: #71717a;
        font-size: 10px;
    }

    .qp-paper-total {
        margin-top: 3px;
        color: #f4f4f5;
        font-size: 15px;
        font-weight: 700;
    }

    .qp-warning {
        color: #fbbf24;
        font-size: 10px;
        text-align: right;
    }

    /* RESPONSIVE */

    @media (max-width: 1050px) {
        .qp-summary {
            grid-template-columns: repeat(4, minmax(0,1fr));
        }

        .qp-summary-card:first-child {
            grid-column: 1 / -1;
        }

        .qp-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 700px) {
        .qp-container {
            width: min(100% - 22px, 650px);
            padding-top: 22px;
        }

        .qp-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 15px;
        }

        .qp-back {
            width: 100%;
        }

        .qp-title {
            font-size: 24px;
        }

        .qp-summary {
            grid-template-columns: repeat(2, minmax(0,1fr));
        }

        .qp-summary-card:first-child {
            grid-column: 1 / -1;
        }

        .qp-card-header,
        .qp-card-body {
            padding: 15px;
        }

        .qp-toolbar {
            align-items: stretch;
            flex-direction: column;
        }

        .qp-add-btn {
            width: 100%;
        }
    }

    @media (max-width: 420px) {
        .qp-summary {
            grid-template-columns: 1fr 1fr;
        }

        .qp-main-icon {
            width: 40px;
            height: 40px;
            flex-basis: 40px;
        }

        .qp-question-item {
            padding: 11px;
        }
    }
</style>


<div class="qp-page">

    <div class="qp-container">

        {{-- HEADER --}}
        <div class="qp-header">

            <div>

                <div class="qp-breadcrumb">
                    <a href="{{ route('exams.index') }}">
                        Exams
                    </a>

                    <span>â€º</span>

                    <a href="{{ route('exams.show', $exam) }}">
                        {{ $exam->title }}
                    </a>

                    <span>â€º</span>

                    <span>Question paper</span>
                </div>


                <div class="qp-heading">

                    <div class="qp-main-icon">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <rect x="5" y="3" width="14" height="18" rx="2"/>
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                            <path d="M8 15h5"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="qp-title">
                            Question Paper
                        </h1>

                        <p class="qp-subtitle">
                            Build the question paper for
                            <strong style="color:#d4d4d8;">
                                {{ $exam->title }}
                            </strong>
                        </p>
                    </div>

                </div>

            </div>


            <a
                href="{{ route('exams.show', $exam) }}"
                class="qp-back"
            >
                <svg width="15"
                     height="15"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8">
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>

                Back to exam
            </a>

        </div>


        {{-- FLASH MESSAGE --}}
        @if(session('success'))
            <div class="qp-alert">
                {{ session('success') }}
            </div>
        @endif


        {{-- ERRORS --}}
        @if($errors->any())

            <div class="qp-error">

                <strong>
                    Please check the following:
                </strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        {{-- EXAM SUMMARY --}}
        <div class="qp-summary">

            <div class="qp-summary-card">

                <div class="qp-summary-main">

                    <div class="qp-summary-icon">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path d="M4 5h16"/>
                            <path d="M4 9h16"/>
                            <path d="M4 13h10"/>
                            <path d="M4 17h16"/>
                        </svg>
                    </div>

                    <div>

                        <div class="qp-summary-label">
                            Exam
                        </div>

                        <div class="qp-summary-value">
                            {{ $exam->title }}
                        </div>

                        @if($exam->category)
                            <div class="qp-summary-small">
                                {{ $exam->category->name }}
                            </div>
                        @endif

                    </div>

                </div>

            </div>


            <div class="qp-summary-card">

                <div class="qp-summary-label">
                    Questions
                </div>

                <div class="qp-summary-number">
                    {{ $questionCount }}
                </div>

                <div class="qp-summary-small">
                    Added to paper
                </div>

            </div>


            <div class="qp-summary-card">

                <div class="qp-summary-label">
                    Paper marks
                </div>

                <div class="qp-summary-number">
                    {{ number_format($questionMarks, 2) }}
                </div>

                <div class="qp-summary-small">
                    of {{ number_format($exam->total_marks, 2) }}
                </div>

            </div>


            <div class="qp-summary-card">

                <div class="qp-summary-label">
                    Remaining
                </div>

                <div class="qp-summary-number">
                    {{ number_format($remainingMarks, 2) }}
                </div>

                <div class="qp-summary-small">
                    Marks available
                </div>

            </div>


            <div class="qp-summary-card">

                <div class="qp-summary-label">
                    Duration
                </div>

                <div class="qp-summary-number">
                    {{ $exam->duration_minutes }}
                </div>

                <div class="qp-summary-small">
                    Minutes
                </div>

            </div>

        </div>


        {{-- MAIN --}}
        <div class="qp-grid">


            {{-- =====================================================
                 AVAILABLE QUESTION BANK
            ====================================================== --}}

            <section class="qp-card">

                <div class="qp-card-header">

                    <div class="qp-card-heading">

                        <div class="qp-section-icon">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <path d="M4 5h16"/>
                                <path d="M4 10h16"/>
                                <path d="M4 15h10"/>
                                <path d="M4 20h16"/>
                            </svg>

                        </div>

                        <div>

                            <h2 class="qp-card-title">
                                Question Bank
                            </h2>

                            <p class="qp-card-description">
                                Select questions to add to this exam.
                            </p>

                        </div>

                    </div>


                    <span class="qp-count-badge">
                        {{ $availableQuestions->count() }}
                    </span>

                </div>


                <div class="qp-card-body">

                    @if($availableQuestions->count() > 0)

                        <form
                            method="POST"
                            action="{{ route('exam-question-paper.store', $exam) }}"
                            id="qp-add-form"
                        >

                            @csrf


                            <div class="qp-toolbar">

                                <label class="qp-select-all">

                                    <input
                                        type="checkbox"
                                        id="qp-select-all"
                                    >

                                    <span>
                                        Select all
                                    </span>

                                </label>


                                <button
                                    type="submit"
                                    class="qp-add-btn"
                                    id="qp-add-btn"
                                    disabled
                                >

                                    <svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path d="M12 5v14"/>
                                        <path d="M5 12h14"/>
                                    </svg>

                                    Add selected questions
                                </button>

                            </div>


                            <div class="qp-question-list">

                                @foreach($availableQuestions as $question)

                                    <label class="qp-question-item">

                                        <input
                                            type="checkbox"
                                            name="question_ids[]"
                                            value="{{ $question->id }}"
                                            class="qp-question-checkbox"
                                        >


                                        <div class="qp-question-content">

                                            <div class="qp-question-top">

                                                <p class="qp-question-text">
                                                    {{ $question->question_text }}
                                                </p>

                                            </div>


                                            <div class="qp-question-meta">

                                                @if($question->subject)
                                                    <span class="qp-meta subject">
                                                        {{ $question->subject->name }}
                                                    </span>
                                                @endif

                                                @if($question->topic)
                                                    <span class="qp-meta topic">
                                                        {{ $question->topic->name }}
                                                    </span>
                                                @endif

                                                <span class="qp-meta marks">
                                                    {{ number_format((float)$question->marks, 2) }}
                                                    marks
                                                </span>

                                                <span class="qp-meta">
                                                    {{ $question->difficulty }}
                                                </span>

                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </form>

                    @else

                        <div class="qp-empty">

                            <div class="qp-empty-icon">

                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path d="M5 4h14v16H5z"/>
                                    <path d="M8 8h8"/>
                                    <path d="M8 12h8"/>
                                    <path d="M8 16h5"/>
                                </svg>

                            </div>

                            <p class="qp-empty-title">
                                No questions available
                            </p>

                            <p class="qp-empty-text">
                                All active Question Bank questions are already
                                attached to this exam, or no questions have
                                been created yet.
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- =====================================================
                 CURRENT QUESTION PAPER
            ====================================================== --}}

            <section class="qp-card">

                <div class="qp-card-header">

                    <div class="qp-card-heading">

                        <div class="qp-section-icon green">

                            <svg viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <path d="M5 4h14v16H5z"/>
                                <path d="M8 8h8"/>
                                <path d="M8 12h8"/>
                                <path d="M8 16h5"/>
                            </svg>

                        </div>

                        <div>

                            <h2 class="qp-card-title">
                                Current Question Paper
                            </h2>

                            <p class="qp-card-description">
                                Questions currently included in this exam.
                            </p>

                        </div>

                    </div>


                    <span class="qp-count-badge">
                        {{ $questionCount }}
                    </span>

                </div>


                <div class="qp-card-body">

                    @if($selectedQuestions->count() > 0)

                        <div
                            class="qp-current-list"
                            id="qp-current-list"
                        >

                            @foreach($selectedQuestions as $index => $question)

                                <div
                                    class="qp-current-item"
                                    draggable="true"
                                    data-question-id="{{ $question->id }}"
                                >

                                    <div class="qp-drag">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path d="M9 5h.01"/>
                                            <path d="M15 5h.01"/>
                                            <path d="M9 12h.01"/>
                                            <path d="M15 12h.01"/>
                                            <path d="M9 19h.01"/>
                                            <path d="M15 19h.01"/>
                                        </svg>

                                    </div>


                                    <div class="qp-current-number">
                                        {{ $index + 1 }}
                                    </div>


                                    <div class="qp-current-content">

                                        <p class="qp-current-text">
                                            {{ $question->question_text }}
                                        </p>


                                        <div class="qp-current-meta">

                                            @if($question->subject)
                                                <span class="qp-meta subject">
                                                    {{ $question->subject->name }}
                                                </span>
                                            @endif

                                            @if($question->topic)
                                                <span class="qp-meta topic">
                                                    {{ $question->topic->name }}
                                                </span>
                                            @endif

                                            <span class="qp-meta marks">
                                                {{ number_format((float)($question->pivot->marks ?? $question->marks), 2) }}
                                                marks
                                            </span>

                                        </div>

                                    </div>


                                    <form
                                        method="POST"
                                        action="{{ route('exam-question-paper.destroy', [$exam, $question]) }}"
                                        onsubmit="return confirm('Remove this question from the exam?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="qp-remove"
                                            title="Remove question"
                                        >

                                            <svg
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="M5 7h14"/>
                                                <path d="M10 11v6"/>
                                                <path d="M14 11v6"/>
                                                <path d="M9 7V4h6v3"/>
                                                <path d="M7 7l1 14h8l1-14"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            @endforeach

                        </div>


                        <div class="qp-paper-footer">

                            <div>

                                <div class="qp-paper-total-label">
                                    Total question paper marks
                                </div>

                                <div class="qp-paper-total">
                                    {{ number_format($questionMarks, 2) }}
                                    / {{ number_format($exam->total_marks, 2) }}
                                </div>

                            </div>


                            @if($remainingMarks > 0)

                                <div class="qp-warning">
                                    {{ number_format($remainingMarks, 2) }}
                                    marks still available
                                </div>

                            @elseif($remainingMarks == 0)

                                <div style="color:#6ee7b7;font-size:10px;text-align:right;">
                                    Total marks completed
                                </div>

                            @endif

                        </div>


                    @else

                        <div class="qp-empty">

                            <div class="qp-empty-icon">

                                <svg viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path d="M5 4h14v16H5z"/>
                                    <path d="M8 8h8"/>
                                    <path d="M8 12h5"/>
                                </svg>

                            </div>

                            <p class="qp-empty-title">
                                Question paper is empty
                            </p>

                            <p class="qp-empty-text">
                                Select questions from the Question Bank
                                and click "Add selected questions".
                            </p>

                        </div>

                    @endif

                </div>

            </section>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectAll = document.getElementById('qp-select-all');
    const checkboxes = Array.from(
        document.querySelectorAll('.qp-question-checkbox')
    );
    const addButton = document.getElementById('qp-add-btn');

    function updateSelectionState() {

        if (!addButton) {
            return;
        }

        const selectedCount = checkboxes.filter(
            checkbox => checkbox.checked
        ).length;

        addButton.disabled = selectedCount === 0;

        if (selectAll) {
            selectAll.checked =
                checkboxes.length > 0 &&
                selectedCount === checkboxes.length;

            selectAll.indeterminate =
                selectedCount > 0 &&
                selectedCount < checkboxes.length;
        }
    }


    if (selectAll) {

        selectAll.addEventListener('change', function () {

            checkboxes.forEach(function (checkbox) {
                checkbox.checked = selectAll.checked;
            });

            updateSelectionState();
        });
    }


    checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            updateSelectionState
        );

    });


    updateSelectionState();


    /*
    |--------------------------------------------------------------------------
    | Drag & Drop Question Ordering
    |--------------------------------------------------------------------------
    */

    const list = document.getElementById('qp-current-list');

    if (!list) {
        return;
    }

    let draggedItem = null;

    list.querySelectorAll('.qp-current-item').forEach(function (item) {

        item.addEventListener('dragstart', function () {
            draggedItem = item;
            item.style.opacity = '0.45';
        });


        item.addEventListener('dragend', function () {
            item.style.opacity = '1';
            draggedItem = null;
        });


        item.addEventListener('dragover', function (event) {

            event.preventDefault();

            if (!draggedItem || draggedItem === item) {
                return;
            }

            const rect = item.getBoundingClientRect();

            const after =
                event.clientY >
                rect.top + rect.height / 2;

            if (after) {
                item.after(draggedItem);
            } else {
                item.before(draggedItem);
            }

        });

    });


    list.addEventListener('drop', function () {

        const questionIds = Array.from(
            list.querySelectorAll('.qp-current-item')
        ).map(function (item) {
            return item.dataset.questionId;
        });


        if (!questionIds.length) {
            return;
        }


        fetch(
            "{{ route('exam-question-paper.reorder', $exam) }}",
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        )?.getAttribute('content')
                        || '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    question_ids: questionIds
                })
            }
        )
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {

            if (!data.success) {
                console.error(
                    'Question reorder failed.'
                );
            }

        })
        .catch(function (error) {

            console.error(
                'Question reorder error:',
                error
            );

        });

    });

});
</script>

</x-layouts::examination>
