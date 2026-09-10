<x-layouts::examination :title="'Question Bank'">

    <style>
        .qb-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 85% 0%, rgba(117,97,255,.11), transparent 32rem),
                radial-gradient(circle at 0% 70%, rgba(82,112,255,.055), transparent 28rem);
        }

        .qb-wrap {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
        }

        /* HEADER */

        .qb-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .qb-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .qb-icon {
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

        .qb-icon svg {
            width: 25px;
            height: 25px;
        }

        .qb-eyebrow {
            margin-bottom: 4px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #706c8d;
        }

        .qb-title {
            margin: 0;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
            color: #fff;
        }

        .qb-subtitle {
            margin: 5px 0 0;
            color: #707078;
            font-size: 11px;
        }

        .qb-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            height: 44px;
            padding: 0 17px;
            border: 1px solid rgba(117,97,255,.5);
            border-radius: 12px;
            background: linear-gradient(135deg,#7561ff,#5b47e6);
            color: #fff !important;
            text-decoration: none !important;
            font-size: 11px;
            font-weight: 750;
            box-shadow: 0 12px 28px rgba(93,73,233,.18);
            transition: .2s ease;
        }

        .qb-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 34px rgba(93,73,233,.27);
        }

        /* STATS */

        .qb-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 13px;
            margin-bottom: 17px;
        }

        .qb-stat {
            position: relative;
            overflow: hidden;
            min-height: 105px;
            padding: 17px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 17px;
            background: rgba(18,18,22,.92);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.015);
        }

        .qb-stat::after {
            content: "";
            position: absolute;
            width: 100px;
            height: 100px;
            right: -35px;
            bottom: -50px;
            border-radius: 50%;
            background: rgba(117,97,255,.08);
            filter: blur(10px);
        }

        .qb-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .qb-stat-label {
            font-size: 10px;
            color: #6c6c75;
        }

        .qb-stat-icon {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #8f83ef;
            background: rgba(117,97,255,.08);
        }

        .qb-stat-icon svg {
            width: 15px;
            height: 15px;
        }

        .qb-stat-number {
            position: relative;
            z-index: 1;
            margin-top: 9px;
            font-size: 25px;
            line-height: 1;
            font-weight: 780;
            letter-spacing: -.03em;
            color: #f7f7f8;
        }

        .qb-stat-number.active {
            color: #9e93ff;
        }

        .qb-stat-number.inactive {
            color: #a7a7af;
        }

        /* FILTER */

        .qb-filter-card {
            margin-bottom: 17px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 18px;
            background: #121216;
        }

        .qb-filter-title {
            margin: 0 0 11px;
            font-size: 10px;
            font-weight: 720;
            color: #cfcfd4;
        }

        .qb-filters {
            display: grid;
            grid-template-columns: minmax(220px, 1.7fr) repeat(4, 1fr) auto;
            gap: 9px;
        }

        .qb-input-wrap {
            position: relative;
        }

        .qb-input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #55555f;
            pointer-events: none;
        }

        .qb-input-icon svg {
            width: 15px;
            height: 15px;
        }

        .qb-input,
        .qb-select {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            border: 1px solid #2d2d35;
            border-radius: 10px;
            outline: none;
            background: #0c0c10;
            color: #dcdce1;
            font-family: inherit;
            font-size: 10px;
            transition: .2s ease;
        }

        .qb-input {
            padding: 0 12px 0 36px;
        }

        .qb-select {
            padding: 0 32px 0 11px;
            appearance: none;
            cursor: pointer;
        }

        .qb-input::placeholder {
            color: #4d4d56;
        }

        .qb-input:focus,
        .qb-select:focus {
            border-color: rgba(117,97,255,.65);
            box-shadow: 0 0 0 3px rgba(117,97,255,.07);
        }

        .qb-select-wrap {
            position: relative;
        }

        .qb-select-arrow {
            position: absolute;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #55555f;
            pointer-events: none;
        }

        .qb-filter-btn {
            height: 42px;
            padding: 0 14px;
            border: 1px solid rgba(117,97,255,.35);
            border-radius: 10px;
            background: rgba(117,97,255,.08);
            color: #9e93ff;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
        }

        .qb-filter-btn:hover {
            background: rgba(117,97,255,.13);
        }

        .qb-clear {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 42px;
            padding: 0 12px;
            border-radius: 10px;
            color: #6e6e77;
            text-decoration: none;
            font-size: 10px;
            font-weight: 650;
        }

        .qb-clear:hover {
            color: #aaaab2;
        }

        /* MAIN CARD */

        .qb-main {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 19px;
            background: #121216;
        }

        .qb-main-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px 19px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .qb-main-title {
            margin: 0;
            font-size: 12px;
            font-weight: 740;
            color: #eeeef0;
        }

        .qb-result-count {
            font-size: 9px;
            color: #606069;
        }

        /* QUESTION CARD */

        .qb-list {
            display: grid;
        }

        .qb-question {
            padding: 19px;
            border-bottom: 1px solid rgba(255,255,255,.055);
            transition: .18s ease;
        }

        .qb-question:last-child {
            border-bottom: 0;
        }

        .qb-question:hover {
            background: rgba(255,255,255,.012);
        }

        .qb-question-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
        }

        .qb-question-content {
            min-width: 0;
            flex: 1;
        }

        .qb-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 9px;
        }

        .qb-badge {
            display: inline-flex;
            align-items: center;
            height: 23px;
            padding: 0 8px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 7px;
            background: rgba(255,255,255,.025);
            font-size: 8px;
            font-weight: 720;
        }

        .qb-badge.subject {
            color: #aaa2ff;
            border-color: rgba(117,97,255,.17);
            background: rgba(117,97,255,.055);
        }

        .qb-badge.topic {
            color: #898991;
        }

        .qb-badge.easy {
            color: #9da9a2;
        }

        .qb-badge.medium {
            color: #b0a999;
        }

        .qb-badge.hard {
            color: #bd9b9f;
        }

        .qb-badge.active {
            color: #9ca89f;
        }

        .qb-badge.inactive {
            color: #8a8a91;
        }

        .qb-question-number {
            color: #55555e;
            font-size: 9px;
            font-weight: 650;
        }

        .qb-question-text {
            margin: 0;
            color: #e5e5e8;
            font-size: 13px;
            line-height: 1.55;
            font-weight: 580;
        }

        .qb-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 7px;
            margin-top: 13px;
        }

        .qb-option {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 9px 10px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 9px;
            background: rgba(0,0,0,.10);
            color: #777780;
            font-size: 9px;
            line-height: 1.45;
        }

        .qb-option.correct {
            border-color: rgba(117,97,255,.23);
            background: rgba(117,97,255,.045);
            color: #aaa2dd;
        }

        .qb-option-letter {
            width: 17px;
            height: 17px;
            flex: 0 0 17px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 5px;
            background: #1b1b20;
            color: #666670;
            font-size: 7px;
            font-weight: 800;
        }

        .qb-option.correct .qb-option-letter {
            background: rgba(117,97,255,.13);
            color: #9e93ff;
        }

        .qb-actions {
            display: flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
        }

        .qb-action {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #2a2a31;
            border-radius: 9px;
            background: #0e0e12;
            color: #696971;
            text-decoration: none;
            cursor: pointer;
        }

        .qb-action:hover {
            color: #a49aff;
            border-color: rgba(117,97,255,.30);
            background: rgba(117,97,255,.055);
        }

        .qb-action.delete:hover {
            color: #d7858c;
            border-color: rgba(215,133,140,.25);
            background: rgba(215,133,140,.045);
        }

        .qb-action svg {
            width: 14px;
            height: 14px;
        }

        .qb-question-footer {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 12px;
            color: #55555e;
            font-size: 8px;
        }

        .qb-question-footer span {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* EMPTY */

        .qb-empty {
            padding: 65px 25px;
            text-align: center;
        }

        .qb-empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(117,97,255,.13);
            border-radius: 17px;
            background: rgba(117,97,255,.05);
            color: #8075cc;
        }

        .qb-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .qb-empty-title {
            margin: 0;
            font-size: 13px;
            font-weight: 720;
            color: #d6d6da;
        }

        .qb-empty-text {
            max-width: 390px;
            margin: 6px auto 17px;
            color: #5e5e67;
            font-size: 10px;
            line-height: 1.6;
        }

        /* PAGINATION */

        .qb-pagination {
            padding: 15px 19px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .qb-pagination nav {
            display: flex;
            justify-content: center;
        }

        .qb-pagination svg {
            width: 13px;
            height: 13px;
        }

        /* ALERT */

        .qb-alert {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid rgba(117,97,255,.16);
            border-radius: 13px;
            background: rgba(117,97,255,.05);
            color: #aaa2d7;
            font-size: 10px;
        }

        /* RESPONSIVE */

        @media (max-width: 1150px) {
            .qb-filters {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .qb-input-wrap {
                grid-column: span 3;
            }
        }

        @media (max-width: 850px) {
            .qb-page {
                padding: 17px;
            }

            .qb-header {
                align-items: stretch;
                flex-direction: column;
            }

            .qb-primary {
                width: 100%;
            }

            .qb-stats {
                grid-template-columns: 1fr;
            }

            .qb-question-top {
                flex-direction: column;
            }

            .qb-actions {
                width: 100%;
                justify-content: flex-end;
            }

            .qb-options {
                grid-template-columns: 1fr;
            }

            .qb-filters {
                grid-template-columns: 1fr 1fr;
            }

            .qb-input-wrap {
                grid-column: span 2;
            }
        }

        @media (max-width: 520px) {
            .qb-page {
                padding: 11px;
            }

            .qb-heading {
                align-items: flex-start;
            }

            .qb-icon {
                width: 45px;
                height: 45px;
                flex-basis: 45px;
                border-radius: 13px;
            }

            .qb-title {
                font-size: 22px;
            }

            .qb-filters {
                grid-template-columns: 1fr;
            }

            .qb-input-wrap {
                grid-column: span 1;
            }

            .qb-filter-btn {
                width: 100%;
            }

            .qb-question {
                padding: 15px;
            }

            .qb-question-text {
                font-size: 12px;
            }
        }
    </style>


    <div class="qb-page">

        <div class="qb-wrap">

            {{-- ===================================================== --}}
            {{-- HEADER --}}
            {{-- ===================================================== --}}

            <div class="qb-header">

                <div class="qb-heading">

                    <div class="qb-icon">

                        <svg
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"
                            />
                        </svg>

                    </div>

                    <div>

                        <div class="qb-eyebrow">
                            Online Examination
                        </div>

                        <h1 class="qb-title">
                            Question Bank
                        </h1>

                        <p class="qb-subtitle">
                            Manage reusable questions across your subjects and topics.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('question-bank.create') }}"
                    class="qb-primary"
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
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Add Question

                </a>

                                <a
                    href="#"
                    onclick="document.getElementById('questionImportModal').classList.remove('hidden'); return false;"
                    class="qb-primary"
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
                            stroke-width="1.8"
                            d="M12 3v12m0 0 4-4m-4 4-4-4M5 19h14"
                        />
                    </svg>

                    Import Excel
                </a>

                <a
href="{{ route('question-bank.export', request()->query()) }}"
    class="qb-primary"
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
            stroke-width="1.8"
            d="M12 3v12m0 0 4-4m-4 4-4-4M5 19h14"
        />
    </svg>

    Export Excel
</a>

            </div>

            {{-- ===================================================== --}}
{{-- IMPORT EXCEL MODAL --}}
{{-- ===================================================== --}}

<div
    id="questionImportModal"
    class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-950/70 px-4 backdrop-blur-sm"
>
    <div class="w-full max-w-2xl overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl">

        {{-- Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-6 py-5">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Import Questions from Excel
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Upload multiple questions at once into your Question Bank.
                </p>
            </div>

            <button
                type="button"
                onclick="document.getElementById('questionImportModal').classList.add('hidden')"
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 hover:text-slate-900"
            >
                ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã¢â‚¬Â
            </button>

        </div>


        {{-- Body --}}
        <div class="p-6">

            {{-- Instructions --}}
            <div class="mb-5 rounded-2xl border border-indigo-100 bg-indigo-50 p-4">

                <div class="text-sm font-semibold text-indigo-900">
                    Excel Format
                </div>

                <p class="mt-2 text-xs leading-5 text-indigo-700">
                    Your Excel file should contain these columns:
                </p>

                <div class="mt-3 flex flex-wrap gap-2">

                    @foreach([
                        'question',
                        'option_1',
                        'option_2',
                        'option_3',
                        'option_4',
                        'correct_option',
                        'subject',
                        'topic',
                        'explanation',
                        'question_type',
                        'marks',
                        'negative_marks',
                        'difficulty',
                        'status'
                    ] as $column)

                        <span class="rounded-lg bg-white px-2.5 py-1 text-[11px] font-medium text-slate-600 shadow-sm ring-1 ring-indigo-100">
                            {{ $column }}
                        </span>

                    @endforeach

                </div>

            </div>


            {{-- Upload Form --}}
            <form
                method="POST"
                action="{{ route('question-bank.import') }}"
                enctype="multipart/form-data"
            >

                @csrf

                <label
                    for="questionImportFile"
                    class="group flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center transition hover:border-indigo-400 hover:bg-indigo-50/50"
                >

                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 text-2xl text-indigo-600 transition group-hover:scale-105">
                        ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÂ¢Ã¢â€šÂ¬Ã‹Å“
                    </div>

                    <div class="mt-4 text-sm font-semibold text-slate-900">
                        Click to select Excel file
                    </div>

                    <div class="mt-1 text-xs text-slate-500">
                        .xlsx, .xls or .csv ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â maximum 10 MB
                    </div>

                    <input
                        id="questionImportFile"
                        type="file"
                        name="file"
                        accept=".xlsx,.xls,.csv"
                        required
                        class="hidden"
                    >

                </label>


                {{-- Selected File --}}
                <div
                    id="selectedImportFile"
                    class="mt-3 hidden rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600"
                ></div>


                {{-- Actions --}}
                <div class="mt-6 flex items-center justify-end gap-3">

                    <button
                        type="button"
                        onclick="document.getElementById('questionImportModal').classList.add('hidden')"
                        class="rounded-xl border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>

                    <button
                        type="submit"
                        class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500"
                    >
                        Import Questions
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>


            {{-- ===================================================== --}}
            {{-- SUCCESS --}}
            {{-- ===================================================== --}}

            @if($errors->any())
    <div class=mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700>
        <div class=font-semibold>Import failed</div>
        <ul class=mt-1 list-disc pl-5>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))

                <div class="qb-alert">

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- ===================================================== --}}
            {{-- STATS --}}
            {{-- ===================================================== --}}

            <div class="qb-stats">

                <div class="qb-stat">

                    <div class="qb-stat-top">

                        <span class="qb-stat-label">
                            Total Questions
                        </span>

                        <div class="qb-stat-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M6 4h12v16H6zM9 8h6M9 12h6M9 16h4"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="qb-stat-number">
                        {{ number_format($totalQuestions) }}
                    </div>

                </div>


                <div class="qb-stat">

                    <div class="qb-stat-top">

                        <span class="qb-stat-label">
                            Active Questions
                        </span>

                        <div class="qb-stat-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="qb-stat-number active">
                        {{ number_format($activeQuestions) }}
                    </div>

                </div>


                <div class="qb-stat">

                    <div class="qb-stat-top">

                        <span class="qb-stat-label">
                            Inactive Questions
                        </span>

                        <div class="qb-stat-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M6 6l12 12M18 6L6 18"
                                />
                            </svg>

                        </div>

                    </div>

                    <div class="qb-stat-number inactive">
                        {{ number_format($inactiveQuestions) }}
                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- FILTERS --}}
            {{-- ===================================================== --}}

            <div class="qb-filter-card">

                <div class="qb-filter-title">
                    Find & Filter Questions
                </div>


                <form
                    method="GET"
                    action="{{ route('question-bank.index') }}"
                    class="qb-filters"
                >

                    {{-- SEARCH --}}

                    <div class="qb-input-wrap">

                        <span class="qb-input-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="m21 21-4.35-4.35M10.8 18a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Z"
                                />
                            </svg>

                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="qb-input"
                            placeholder="Search questions..."
                        >

                    </div>


                    {{-- SUBJECT --}}

                    <div class="qb-select-wrap">

                        <select
                            name="subject_id"
                            id="subjectFilter"
                            class="qb-select"
                        >

                            <option value="">
                                All Subjects
                            </option>

                            @foreach($subjects as $subjectOption)

                                <option
                                    value="{{ $subjectOption->id }}"
                                    @selected((string) $subjectId === (string) $subjectOption->id)
                                >
                                    {{ $subjectOption->name }}
                                </option>

                            @endforeach

                        </select>

                        <span class="qb-select-arrow">

                            <svg
                                width="13"
                                height="13"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m5 8 7 7 7-7"/>
                            </svg>

                        </span>

                    </div>


                    {{-- TOPIC --}}

                    <div class="qb-select-wrap">

                        <select
                            name="topic_id"
                            id="topicFilter"
                            class="qb-select"
                        >

                            <option value="">
                                All Topics
                            </option>

                            @foreach($topics as $topicOption)

                                <option
                                    value="{{ $topicOption->id }}"
                                    @selected((string) $topicId === (string) $topicOption->id)
                                >
                                    {{ $topicOption->name }}
                                </option>

                            @endforeach

                        </select>

                        <span class="qb-select-arrow">

                            <svg
                                width="13"
                                height="13"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m5 8 7 7 7-7"/>
                            </svg>

                        </span>

                    </div>


                    {{-- DIFFICULTY --}}

                    <div class="qb-select-wrap">

                        <select
                            name="difficulty"
                            class="qb-select"
                        >

                            <option value="">
                                All Difficulty
                            </option>

                            <option
                                value="Easy"
                                @selected($difficulty === 'Easy')
                            >
                                Easy
                            </option>

                            <option
                                value="Medium"
                                @selected($difficulty === 'Medium')
                            >
                                Medium
                            </option>

                            <option
                                value="Hard"
                                @selected($difficulty === 'Hard')
                            >
                                Hard
                            </option>

                        </select>

                        <span class="qb-select-arrow">

                            <svg
                                width="13"
                                height="13"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m5 8 7 7 7-7"/>
                            </svg>

                        </span>

                    </div>


                    {{-- STATUS --}}

                    <div class="qb-select-wrap">

                        <select
                            name="status"
                            class="qb-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="active"
                                @selected($status === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected($status === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                        <span class="qb-select-arrow">

                            <svg
                                width="13"
                                height="13"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path d="m5 8 7 7 7-7"/>
                            </svg>

                        </span>

                    </div>


                    <button
                        type="submit"
                        class="qb-filter-btn"
                    >
                        Apply
                    </button>

                </form>


                @if(
                    $search ||
                    $status ||
                    $difficulty ||
                    $subjectId ||
                    $topicId
                )

                    <div style="margin-top:8px;">

                        <a
                            href="{{ route('question-bank.index') }}"
                            class="qb-clear"
                        >
                            Clear all filters
                        </a>

                    </div>

                @endif

            </div>


            {{-- ===================================================== --}}
            {{-- QUESTION LIST --}}
            {{-- ===================================================== --}}

            <div class="qb-main">

                <div class="qb-main-head">

                    <div>

                        <h2 class="qb-main-title">
                            All Questions
                        </h2>

                    </div>

                    <div class="qb-result-count">

                        Showing
                        {{ $questions->firstItem() ?? 0 }}
                        ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã¢â‚¬Å“
                        {{ $questions->lastItem() ?? 0 }}
                        of
                        {{ $questions->total() }}

                    </div>

                </div>


                @if($questions->count())

                    <div class="qb-list">

                        @foreach($questions as $question)

                            <article class="qb-question">

                                <div class="qb-question-top">


                                    <div class="qb-question-content">


                                        {{-- META --}}

                                        <div class="qb-meta">

                                            <span class="qb-question-number">
                                                #{{ $question->id }}
                                            </span>


                                            @if($question->subject)

                                                <span class="qb-badge subject">
                                                    {{ $question->subject->name }}
                                                </span>

                                            @endif


                                            @if($question->topic)

                                                <span class="qb-badge topic">
                                                    {{ $question->topic->name }}
                                                </span>

                                            @endif


                                            @php
                                                $difficultyClass = match($question->difficulty) {
                                                    'Easy' => 'easy',
                                                    'Hard' => 'hard',
                                                    default => 'medium',
                                                };
                                            @endphp

                                            <span class="qb-badge {{ $difficultyClass }}">
                                                {{ $question->difficulty }}
                                            </span>


                                            @if($question->is_active)

                                                <span class="qb-badge active">
                                                    Active
                                                </span>

                                            @else

                                                <span class="qb-badge inactive">
                                                    Inactive
                                                </span>

                                            @endif

                                        </div>


                                        {{-- QUESTION --}}

                                        <p class="qb-question-text">
                                            {{ $question->question_text }}
                                        </p>


                                        {{-- OPTIONS --}}

                                        @if($question->options->count())

                                            <div class="qb-options">

                                                @foreach($question->options as $optionIndex => $option)

                                                    <div
                                                        class="qb-option {{ $option->is_correct ? 'correct' : '' }}"
                                                    >

                                                        <span class="qb-option-letter">
                                                            {{ chr(65 + $optionIndex) }}
                                                        </span>

                                                        <span>
                                                            {{ $option->option_text }}
                                                        </span>

                                                    </div>

                                                @endforeach

                                            </div>

                                        @endif


                                        {{-- FOOTER --}}

                                        <div class="qb-question-footer">

                                            <span>

                                                <svg
                                                    width="11"
                                                    height="11"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-width="1.8"
                                                        d="M12 6v6l4 2"
                                                    />
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="9"
                                                        stroke-width="1.8"
                                                    />
                                                </svg>

                                                {{ number_format((float) $question->marks, 2) }}
                                                marks

                                            </span>


                                            @if((float) $question->negative_marks > 0)

                                                <span>
                                                    ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã¢â‚¬Â¹ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢{{ number_format((float) $question->negative_marks, 2) }}
                                                    negative
                                                </span>

                                            @endif


                                            <span>
                                                Added {{ $question->created_at?->format('d M Y') }}
                                            </span>

                                        </div>


                                    </div>


                                    {{-- ACTIONS --}}

                                    <div class="qb-actions">


                                        <a
                                            href="{{ route('exam-questions.show', [
                                                $question->subject,
                                                $question->topic,
                                                $question
                                            ]) }}"
                                            class="qb-action"
                                            title="View"
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
                                                    d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                                />
                                                <circle
                                                    cx="12"
                                                    cy="12"
                                                    r="2.7"
                                                    stroke-width="1.8"
                                                />
                                            </svg>

                                        </a>


                                        <a
                                            href="{{ route('exam-questions.edit', [
                                                $question->subject,
                                                $question->topic,
                                                $question
                                            ]) }}"
                                            class="qb-action"
                                            title="Edit"
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
                                                    d="m15 5 4 4M4 20l4.2-1 10.1-10.1a2.8 2.8 0 0 0-4-4L4.2 15 4 20Z"
                                                />
                                            </svg>

                                        </a>


                                        <form
                                            method="POST"
                                            action="{{ route('exam-questions.destroy', [
                                                $question->subject,
                                                $question->topic,
                                                $question
                                            ]) }}"
                                            onsubmit="return confirm('Delete this question? This action cannot be undone.');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="qb-action delete"
                                                title="Delete"
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

                                        </form>


                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>


                    {{-- PAGINATION --}}

                    @if($questions->hasPages())

                        <div class="qb-pagination">

                            {{ $questions->links() }}

                        </div>

                    @endif


                @else


                    {{-- EMPTY STATE --}}

                    <div class="qb-empty">

                        <div class="qb-empty-icon">

                            <svg
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M5 4h14v16H5zM8 8h8M8 12h5M8 16h4"
                                />
                            </svg>

                        </div>


                        <h3 class="qb-empty-title">
                            No questions found
                        </h3>


                        <p class="qb-empty-text">
                            There are no questions matching your current filters.
                            Create your first question or clear the filters to see everything.
                        </p>


                        <a
                            href="{{ route('question-bank.create') }}"
                            class="qb-primary"
                        >

                            <svg
                                width="14"
                                height="14"
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

                            Add First Question

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ============================================================= --}}
    {{-- TOPIC FILTER --}}
    {{-- ============================================================= --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const subjectFilter =
                    document.getElementById(
                        'subjectFilter'
                    );

                const topicFilter =
                    document.getElementById(
                        'topicFilter'
                    );

                const topics = @json(
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


                function loadTopics() {

                    const subjectId =
                        subjectFilter.value;

                    const selectedTopic =
                        @json($topicId);


                    topicFilter.innerHTML =
                        '<option value="">All Topics</option>';


                    if (!subjectId) {

                        return;

                    }


                    const subjectTopics =
                        topics[subjectId] ?? [];


                    subjectTopics.forEach(
                        function (topic) {

                            const option =
                                document.createElement(
                                    'option'
                                );

                            option.value =
                                topic.id;

                            option.textContent =
                                topic.name;


                            if (
                                String(topic.id) ===
                                String(selectedTopic)
                            ) {

                                option.selected =
                                    true;

                            }


                            topicFilter.appendChild(
                                option
                            );

                        }
                    );

                }


                subjectFilter.addEventListener(
                    'change',
                    function () {

                        /*
                         * Subject change ke baad
                         * topic reset hoga.
                         */
                        const subjectId =
                            subjectFilter.value;

                        topicFilter.innerHTML =
                            '<option value="">All Topics</option>';


                        const subjectTopics =
                            topics[subjectId] ?? [];


                        subjectTopics.forEach(
                            function (topic) {

                                const option =
                                    document.createElement(
                                        'option'
                                    );

                                option.value =
                                    topic.id;

                                option.textContent =
                                    topic.name;

                                topicFilter.appendChild(
                                    option
                                );

                            }
                        );

                    }
                );


                loadTopics();

            }
        );

        const questionImportFile = document.getElementById('questionImportFile');
const selectedImportFile = document.getElementById('selectedImportFile');

if (questionImportFile && selectedImportFile) {
    questionImportFile.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            selectedImportFile.classList.add('hidden');
            selectedImportFile.textContent = '';
            return;
        }

        selectedImportFile.textContent =
            'Selected file: ' + file.name;

        selectedImportFile.classList.remove('hidden');
    });
}

    </script>

</x-layouts::examination>
