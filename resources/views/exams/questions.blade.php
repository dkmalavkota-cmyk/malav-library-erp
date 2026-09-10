<x-layouts::examination :title="Question Paper —  . $exam->title>

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
        padding: 32px 0 60px;
        color: var(--qp-text);
        background:
            radial-gradient(
                circle at 85% 0%,
                rgba(99,102,241,.08),
                transparent 30rem
            ),
            var(--qp-bg);
    }

    .qp-container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
    }

    /* HEADER */

    .qp-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 26px;
    }

    .qp-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 13px;
        color: #52525b;
        font-size: 12px;
    }

    .qp-breadcrumb a {
        color: #a1a1aa;
        text-decoration: none;
    }

    .qp-breadcrumb a:hover {
        color: #fff;
    }

    .qp-title-row {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .qp-title-icon {
        width: 46px;
        height: 46px;
        flex: 0 0 46px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(129,140,248,.20);
        border-radius: 14px;
        background: rgba(99,102,241,.10);
        color: #a5b4fc;
    }

    .qp-title-icon svg {
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
    }

    .qp-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 42px;
        padding: 0 15px;
        border: 1px solid var(--qp-border);
        border-radius: 11px;
        background: var(--qp-card);
        color: #d4d4d8 !important;
        text-decoration: none !important;
        font-size: 12px;
        font-weight: 600;
        transition: .2s ease;
    }

    .qp-back:hover {
        border-color: var(--qp-border-hover);
        background: #18181b;
        color: #fff !important;
        transform: translateY(-1px);
    }

    /* SUMMARY */

    .qp-summary {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
        margin-bottom: 18px;
    }

    .qp-stat {
        padding: 17px;
        border: 1px solid var(--qp-border);
        border-radius: 15px;
        background: rgba(17,17,19,.92);
    }

    .qp-stat-label {
        margin-bottom: 7px;
        color: #71717a;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .05em;
    }

    .qp-stat-value {
        color: #f4f4f5;
        font-size: 21px;
        font-weight: 700;
        letter-spacing: -.02em;
    }

    .qp-stat-note {
        margin-top: 4px;
        color: #52525b;
        font-size: 10px;
    }

    /* LAYOUT */

    .qp-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 360px;
        gap: 18px;
        align-items: start;
    }

    .qp-card {
        overflow: hidden;
        border: 1px solid var(--qp-border);
        border-radius: 17px;
        background: rgba(17,17,19,.95);
        box-shadow:
            0 20px 50px rgba(0,0,0,.12),
            inset 0 1px 0 rgba(255,255,255,.015);
    }

    .qp-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--qp-border);
    }

    .qp-card-heading {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .qp-section-icon {
        width: 35px;
        height: 35px;
        flex: 0 0 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--qp-accent-bg);
        color: #a5b4fc;
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

    .qp-card-desc {
        margin: 3px 0 0;
        color: #71717a;
        font-size: 11px;
    }

    .qp-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 27px;
        height: 25px;
        padding: 0 8px;
        border-radius: 999px;
        background: #1c1c20;
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 700;
    }

    .qp-card-body {
        padding: 18px;
    }

    /* FILTER */

    .qp-filter {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 10px;
        margin-bottom: 15px;
    }

    .qp-field label {
        display: block;
        margin-bottom: 6px;
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 600;
    }

    .qp-select,
    .qp-search {
        box-sizing: border-box;
        width: 100%;
        height: 40px;
        padding: 0 12px;
        border: 1px solid #2f2f33;
        border-radius: 10px;
        outline: none;
        background: #0d0d0f;
        color: #f4f4f5;
        font-family: inherit;
        font-size: 12px;
        transition: .2s ease;
    }

    .qp-select:focus,
    .qp-search:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99,102,241,.10);
    }

    .qp-search-wrap {
        position: relative;
    }

    .qp-search-wrap svg {
        position: absolute;
        left: 11px;
        top: 50%;
        width: 15px;
        height: 15px;
        transform: translateY(-50%);
        color: #52525b;
        pointer-events: none;
    }

    .qp-search {
        padding-left: 34px;
    }

    .qp-filter-btn {
        align-self: end;
        height: 40px;
        padding: 0 14px;
        border: 1px solid #2f2f33;
        border-radius: 10px;
        background: #18181b;
        color: #d4d4d8;
        font-family: inherit;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
    }

    .qp-filter-btn:hover {
        border-color: #3f3f46;
        color: #fff;
    }

    /* QUESTION BANK */

    .qp-question-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .qp-question {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 13px;
        border: 1px solid #27272a;
        border-radius: 12px;
        background: #0d0d0f;
        transition: .2s ease;
    }

    .qp-question:hover {
        border-color: #3f3f46;
        background: #101012;
    }

    .qp-question-check {
        width: 17px !important;
        height: 17px !important;
        flex: 0 0 17px;
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
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 7px;
    }

    .qp-question-number {
        color: #71717a;
        font-size: 10px;
        font-weight: 700;
    }

    .qp-question-marks {
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 600;
    }

    .qp-question-text {
        margin: 0;
        color: #e4e4e7;
        font-size: 12px;
        line-height: 1.55;
    }

    .qp-question-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 9px;
    }

    .qp-tag {
        display: inline-flex;
        align-items: center;
        min-height: 20px;
        padding: 0 7px;
        border-radius: 999px;
        background: #18181b;
        color: #71717a;
        font-size: 9px;
        font-weight: 600;
    }

    .qp-tag.easy {
        background: rgba(16,185,129,.08);
        color: #6ee7b7;
    }

    .qp-tag.medium {
        background: rgba(245,158,11,.08);
        color: #fbbf24;
    }

    .qp-tag.hard {
        background: rgba(239,68,68,.08);
        color: #fca5a5;
    }

    /* ADD BUTTON */

    .qp-add-area {
        display: flex;
        justify-content: flex-end;
        margin-top: 14px;
    }

    .qp-add-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 40px;
        padding: 0 15px;
        border: 1px solid #fff;
        border-radius: 10px;
        background: #fff;
        color: #09090b;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .qp-add-btn:hover {
        background: #e4e4e7;
        transform: translateY(-1px);
    }

    .qp-add-btn svg {
        width: 14px;
        height: 14px;
    }

    /* CURRENT PAPER */

    .qp-paper-list {
        display: flex;
        flex-direction: column;
        gap: 9px;
    }

    .qp-paper-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px;
        border: 1px solid #27272a;
        border-radius: 11px;
        background: #0d0d0f;
    }

    .qp-paper-index {
        width: 25px;
        height: 25px;
        flex: 0 0 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: #18181b;
        color: #a1a1aa;
        font-size: 10px;
        font-weight: 700;
    }

    .qp-paper-content {
        min-width: 0;
        flex: 1;
    }

    .qp-paper-text {
        margin: 0;
        color: #d4d4d8;
        font-size: 11px;
        line-height: 1.5;
    }

    .qp-paper-meta {
        display: flex;
        gap: 8px;
        margin-top: 6px;
        color: #52525b;
        font-size: 9px;
    }

    .qp-remove {
        width: 27px;
        height: 27px;
        flex: 0 0 27px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #27272a;
        border-radius: 8px;
        background: #111113;
        color: #71717a;
        cursor: pointer;
    }

    .qp-remove:hover {
        border-color: rgba(239,68,68,.35);
        color: #f87171;
    }

    .qp-remove svg {
        width: 13px;
        height: 13px;
    }

    /* EMPTY */

    .qp-empty {
        padding: 38px 20px;
        text-align: center;
        border: 1px dashed #27272a;
        border-radius: 12px;
        background: #0d0d0f;
    }

    .qp-empty-icon {
        width: 40px;
        height: 40px;
        margin: 0 auto 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: #18181b;
        color: #52525b;
    }

    .qp-empty-icon svg {
        width: 18px;
        height: 18px;
    }

    .qp-empty-title {
        margin: 0;
        color: #a1a1aa;
        font-size: 12px;
        font-weight: 600;
    }

    .qp-empty-text {
        margin: 5px 0 0;
        color: #52525b;
        font-size: 10px;
        line-height: 1.5;
    }

    /* NOTICE */

    .qp-notice {
        margin-top: 13px;
        padding: 11px 12px;
        border: 1px solid rgba(99,102,241,.16);
        border-radius: 11px;
        background: rgba(99,102,241,.05);
        color: #818cf8;
        font-size: 10px;
        line-height: 1.5;
    }

    /* RESPONSIVE */

    @media (max-width: 900px) {
        .qp-layout {
            grid-template-columns: 1fr;
        }

        .qp-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 650px) {
        .qp-page {
            padding-top: 22px;
        }

        .qp-container {
            width: min(100% - 22px, 600px);
        }

        .qp-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .qp-back {
            width: 100%;
        }

        .qp-title {
            font-size: 24px;
        }

        .qp-summary {
            grid-template-columns: 1fr 1fr;
        }

        .qp-filter {
            grid-template-columns: 1fr;
        }

        .qp-filter-btn {
            width: 100%;
        }
    }
</style>


<div class="qp-page">

    <div class="qp-container">

        {{-- HEADER --}}
        <div class="qp-header">

            <div>

                <div class="qp-breadcrumb">
                    <a href="{{ route('exams.index') }}">Exams</a>
                    <span>â€º</span>
                    <a href="{{ route('exams.show', $exam) }}">
                        {{ $exam->title }}
                    </a>
                    <span>â€º</span>
                    <span>Question Paper</span>
                </div>

                <div class="qp-title-row">

                    <div class="qp-title-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
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
                            <strong style="color:#a1a1aa;">
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
                <svg
                    width="15"
                    height="15"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>

                Back to exam
            </a>

        </div>


        {{-- SUMMARY --}}
        <div class="qp-summary">

            <div class="qp-stat">
                <div class="qp-stat-label">Duration</div>
                <div class="qp-stat-value">
                    {{ $exam->duration_minutes }}
                    <span style="font-size:11px;color:#71717a;">min</span>
                </div>
                <div class="qp-stat-note">Exam duration</div>
            </div>

            <div class="qp-stat">
                <div class="qp-stat-label">Total Marks</div>
                <div class="qp-stat-value">
                    {{ $exam->total_marks }}
                </div>
                <div class="qp-stat-note">Maximum score</div>
            </div>

            <div class="qp-stat">
                <div class="qp-stat-label">Passing Marks</div>
                <div class="qp-stat-value">
                    {{ $exam->passing_marks }}
                </div>
                <div class="qp-stat-note">Required to pass</div>
            </div>

            <div class="qp-stat">
                <div class="qp-stat-label">Questions Added</div>
                <div class="qp-stat-value">
                    {{ isset($selectedQuestions) ? $selectedQuestions->count() : 0 }}
                </div>
                <div class="qp-stat-note">Questions in paper</div>
            </div>

        </div>


        {{-- MAIN --}}
        <div class="qp-layout">


            {{-- QUESTION BANK --}}
            <section class="qp-card">

                <div class="qp-card-header">

                    <div class="qp-card-heading">

                        <div class="qp-section-icon">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v17H6.5A2.5 2.5 0 0 0 4 22z"/>
                                <path d="M4 5.5V19"/>
                                <path d="M8 7h8"/>
                                <path d="M8 11h7"/>
                            </svg>
                        </div>

                        <div>
                            <h2 class="qp-card-title">
                                Question Bank
                            </h2>

                            <p class="qp-card-desc">
                                Select questions from your existing question bank.
                            </p>
                        </div>

                    </div>

                    <span class="qp-count">
                        {{ isset($questions) ? $questions->count() : 0 }}
                    </span>

                </div>


                <div class="qp-card-body">

                    {{-- FILTER --}}
                    <div class="qp-filter">

                        <div class="qp-field">
                            <label for="subject_filter">
                                Subject
                            </label>

                            <select
                                id="subject_filter"
                                class="qp-select"
                            >
                                <option value="">
                                    All subjects
                                </option>

                                @if(isset($subjects))

                                    @foreach($subjects as $subject)

                                        <option value="{{ $subject->id }}">
                                            {{ $subject->name }}
                                        </option>

                                    @endforeach

                                @endif

                            </select>
                        </div>


                        <div class="qp-field">
                            <label for="topic_filter">
                                Topic
                            </label>

                            <select
                                id="topic_filter"
                                class="qp-select"
                            >
                                <option value="">
                                    All topics
                                </option>

                                @if(isset($topics))

                                    @foreach($topics as $topic)

                                        <option value="{{ $topic->id }}">
                                            {{ $topic->name }}
                                        </option>

                                    @endforeach

                                @endif

                            </select>
                        </div>


                        <div class="qp-field">

                            <label>
                                Search
                            </label>

                            <div class="qp-search-wrap">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <circle cx="11" cy="11" r="7"/>
                                    <path d="m20 20-4-4"/>
                                </svg>

                                <input
                                    type="search"
                                    class="qp-search"
                                    id="question_search"
                                    placeholder="Search question..."
                                >

                            </div>

                        </div>

                    </div>


                    {{-- QUESTIONS --}}
                    @if(isset($questions) && $questions->count())

                        <form
                            method="POST"
                            action="{{ route('exam-question-paper.store', $exam) }}"
                            id="question-paper-form"
                        >

                            @csrf

                            <div class="qp-question-list">

                                @foreach($questions as $question)

                                    <label
                                        class="qp-question"
                                        data-subject="{{ $question->subject_id }}"
                                        data-topic="{{ $question->topic_id }}"
                                        data-question="{{ strtolower($question->question_text) }}"
                                    >

                                        <input
                                            type="checkbox"
                                            name="question_ids[]"
                                            value="{{ $question->id }}"
                                            class="qp-question-check"
                                            @if(isset($selectedQuestions) && $selectedQuestions->contains('id', $question->id))
                                                checked
                                            @endif
                                        >

                                        <div class="qp-question-content">

                                            <div class="qp-question-top">

                                                <span class="qp-question-number">
                                                    Question #{{ $loop->iteration }}
                                                </span>

                                                <span class="qp-question-marks">
                                                    {{ $question->marks }} marks
                                                </span>

                                            </div>

                                            <p class="qp-question-text">
                                                {{ $question->question_text }}
                                            </p>

                                            <div class="qp-question-meta">

                                                @if($question->subject)
                                                    <span class="qp-tag">
                                                        {{ $question->subject->name }}
                                                    </span>
                                                @endif

                                                @if($question->topic)
                                                    <span class="qp-tag">
                                                        {{ $question->topic->name }}
                                                    </span>
                                                @endif

                                                @if($question->difficulty)
                                                    <span class="qp-tag {{ strtolower($question->difficulty) }}">
                                                        {{ $question->difficulty }}
                                                    </span>
                                                @endif

                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>


                            <div class="qp-add-area">

                                <button
                                    type="submit"
                                    class="qp-add-btn"
                                >
                                    <svg
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

                        </form>

                    @else

                        <div class="qp-empty">

                            <div class="qp-empty-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 8v4"/>
                                    <path d="M12 16h.01"/>
                                </svg>

                            </div>

                            <p class="qp-empty-title">
                                No questions available
                            </p>

                            <p class="qp-empty-text">
                                Create questions in the Question Bank first,
                                then return here to add them to this exam.
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- CURRENT PAPER --}}
            <aside class="qp-card">

                <div class="qp-card-header">

                    <div class="qp-card-heading">

                        <div class="qp-section-icon">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path d="M8 6h13"/>
                                <path d="M8 12h13"/>
                                <path d="M8 18h13"/>
                                <path d="M3 6h.01"/>
                                <path d="M3 12h.01"/>
                                <path d="M3 18h.01"/>
                            </svg>

                        </div>

                        <div>

                            <h2 class="qp-card-title">
                                Current Paper
                            </h2>

                            <p class="qp-card-desc">
                                Questions currently assigned.
                            </p>

                        </div>

                    </div>

                    <span class="qp-count">
                        {{ isset($selectedQuestions) ? $selectedQuestions->count() : 0 }}
                    </span>

                </div>


                <div class="qp-card-body">

                    @if(isset($selectedQuestions) && $selectedQuestions->count())

                        <div class="qp-paper-list">

                            @foreach($selectedQuestions as $question)

                                <div class="qp-paper-item">

                                    <div class="qp-paper-index">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div class="qp-paper-content">

                                        <p class="qp-paper-text">
                                            {{ \Illuminate\Support\Str::limit($question->question_text, 100) }}
                                        </p>

                                        <div class="qp-paper-meta">

                                            <span>
                                                {{ $question->marks }} marks
                                            </span>

                                            @if($question->topic)
                                                <span>
                                                    {{ $question->topic->name }}
                                                </span>
                                            @endif

                                        </div>

                                    </div>


                                    <form
                                        method="POST"
                                        action="{{ route('exam-question-paper.destroy', [$exam, $question]) }}"
                                        onsubmit="return confirm('Remove this question from the exam?')"
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
                                                <path d="M4 7h16"/>
                                                <path d="M10 11v6"/>
                                                <path d="M14 11v6"/>
                                                <path d="M6 7l1 14h10l1-14"/>
                                                <path d="M9 7V4h6v3"/>
                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            @endforeach

                        </div>


                        <div class="qp-notice">
                            Questions are taken from the central Question Bank.
                            Removing a question here does not delete it from
                            the Question Bank.
                        </div>

                    @else

                        <div class="qp-empty">

                            <div class="qp-empty-icon">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.7"
                                >
                                    <path d="M4 5h16"/>
                                    <path d="M4 12h16"/>
                                    <path d="M4 19h16"/>
                                </svg>

                            </div>

                            <p class="qp-empty-title">
                                No questions added yet
                            </p>

                            <p class="qp-empty-text">
                                Select questions from the Question Bank
                                and add them to this paper.
                            </p>

                        </div>

                    @endif

                </div>

            </aside>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const subjectFilter = document.getElementById('subject_filter');
    const topicFilter = document.getElementById('topic_filter');
    const searchInput = document.getElementById('question_search');

    const questions = document.querySelectorAll('.qp-question');

    function filterQuestions() {

        const subject = subjectFilter ? subjectFilter.value : '';
        const topic = topicFilter ? topicFilter.value : '';
        const search = searchInput
            ? searchInput.value.toLowerCase().trim()
            : '';

        questions.forEach(function (question) {

            const questionSubject =
                question.dataset.subject || '';

            const questionTopic =
                question.dataset.topic || '';

            const questionText =
                question.dataset.question || '';

            const subjectMatch =
                !subject || questionSubject === subject;

            const topicMatch =
                !topic || questionTopic === topic;

            const searchMatch =
                !search || questionText.includes(search);

            question.style.display =
                subjectMatch &&
                topicMatch &&
                searchMatch
                    ? 'flex'
                    : 'none';
        });
    }

    if (subjectFilter) {
        subjectFilter.addEventListener(
            'change',
            filterQuestions
        );
    }

    if (topicFilter) {
        topicFilter.addEventListener(
            'change',
            filterQuestions
        );
    }

    if (searchInput) {
        searchInput.addEventListener(
            'input',
            filterQuestions
        );
    }

});
</script>

</x-layouts::examination>
