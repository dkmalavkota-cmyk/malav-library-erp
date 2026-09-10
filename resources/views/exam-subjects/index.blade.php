<x-layouts::examination :title="'Exam Subjects'">

    <style>
        .es-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 85% 0%, rgba(117,97,255,.11), transparent 32rem),
                radial-gradient(circle at 0% 70%, rgba(82,112,255,.055), transparent 28rem);
        }

        .es-wrap {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
        }

        .es-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .es-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .es-icon {
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

        .es-icon svg {
            width: 25px;
            height: 25px;
        }

        .es-eyebrow {
            margin-bottom: 4px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #706c8d;
        }

        .es-title {
            margin: 0;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
            color: #fff;
        }

        .es-subtitle {
            margin: 5px 0 0;
            color: #707078;
            font-size: 11px;
        }

        .es-primary {
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

        .es-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 34px rgba(93,73,233,.27);
        }

        .es-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid rgba(117,97,255,.18);
            border-radius: 13px;
            background: rgba(117,97,255,.055);
            color: #aaa2d7;
            font-size: 10px;
        }

        .es-alert.error {
            border-color: rgba(215,133,140,.18);
            background: rgba(215,133,140,.045);
            color: #d7a0a5;
        }

        .es-alert svg {
            width: 15px;
            height: 15px;
            flex: 0 0 15px;
        }

        .es-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 13px;
            margin-bottom: 17px;
        }

        .es-stat {
            position: relative;
            overflow: hidden;
            min-height: 105px;
            padding: 17px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 17px;
            background: rgba(18,18,22,.92);
            box-shadow: inset 0 1px 0 rgba(255,255,255,.015);
        }

        .es-stat::after {
            content: "";
            position: absolute;
            width: 105px;
            height: 105px;
            right: -38px;
            bottom: -52px;
            border-radius: 50%;
            background: rgba(117,97,255,.08);
            filter: blur(10px);
        }

        .es-stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .es-stat-label {
            font-size: 10px;
            color: #6c6c75;
        }

        .es-stat-icon {
            width: 29px;
            height: 29px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #8f83ef;
            background: rgba(117,97,255,.08);
        }

        .es-stat-icon svg {
            width: 15px;
            height: 15px;
        }

        .es-stat-number {
            position: relative;
            z-index: 1;
            margin-top: 9px;
            font-size: 25px;
            line-height: 1;
            font-weight: 780;
            letter-spacing: -.03em;
            color: #f7f7f8;
        }

        .es-stat-number.active {
            color: #9e93ff;
        }

        .es-stat-number.inactive {
            color: #a7a7af;
        }

        .es-filter {
            margin-bottom: 17px;
            padding: 15px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 18px;
            background: #121216;
        }

        .es-filter-title {
            margin: 0 0 11px;
            font-size: 10px;
            font-weight: 720;
            color: #cfcfd4;
        }

        .es-filters {
            display: grid;
            grid-template-columns: minmax(220px, 1fr) 180px auto auto;
            gap: 9px;
        }

        .es-input {
            width: 100%;
            height: 42px;
            box-sizing: border-box;
            padding: 0 12px 0 36px;
            border: 1px solid #2d2d35;
            border-radius: 10px;
            outline: none;
            background: #0c0c10;
            color: #dcdce1;
            font-family: inherit;
            font-size: 10px;
            transition: .2s ease;
        }

        .es-input::placeholder {
            color: #4d4d56;
        }

        .es-input:focus {
            border-color: rgba(117,97,255,.65);
            box-shadow: 0 0 0 3px rgba(117,97,255,.07);
        }

        .es-input-wrap {
            position: relative;
        }

        .es-input-wrap svg {
            position: absolute;
            left: 12px;
            top: 50%;
            width: 15px;
            height: 15px;
            transform: translateY(-50%);
            color: #55555f;
            pointer-events: none;
        }

        .es-select {
            width: 100%;
            height: 42px;
            padding: 0 11px;
            border: 1px solid #2d2d35;
            border-radius: 10px;
            outline: none;
            background: #0c0c10;
            color: #dcdce1;
            font-family: inherit;
            font-size: 10px;
            cursor: pointer;
        }

        .es-select:focus {
            border-color: rgba(117,97,255,.65);
            box-shadow: 0 0 0 3px rgba(117,97,255,.07);
        }

        .es-filter-btn {
            height: 42px;
            padding: 0 15px;
            border: 1px solid rgba(117,97,255,.35);
            border-radius: 10px;
            background: rgba(117,97,255,.08);
            color: #9e93ff;
            font-family: inherit;
            font-size: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: .2s ease;
        }

        .es-filter-btn:hover {
            background: rgba(117,97,255,.13);
        }

        .es-clear {
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

        .es-clear:hover {
            color: #aaaab2;
        }

        .es-main {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 19px;
            background: #121216;
        }

        .es-main-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 17px 19px;
            border-bottom: 1px solid rgba(255,255,255,.07);
        }

        .es-main-title {
            margin: 0;
            font-size: 12px;
            font-weight: 740;
            color: #eeeef0;
        }

        .es-main-sub {
            margin-top: 4px;
            font-size: 9px;
            color: #606069;
        }

        .es-count {
            font-size: 9px;
            color: #606069;
        }

        .es-table-wrap {
            overflow-x: auto;
        }

        .es-table {
            width: 100%;
            min-width: 820px;
            border-collapse: collapse;
        }

        .es-table thead {
            background: rgba(255,255,255,.018);
        }

        .es-table th {
            padding: 12px 19px;
            border-bottom: 1px solid rgba(255,255,255,.055);
            color: #606069;
            font-size: 8px;
            font-weight: 720;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .es-table th:last-child {
            text-align: right;
        }

        .es-table td {
            padding: 16px 19px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #85858d;
            font-size: 9px;
            vertical-align: middle;
        }

        .es-table tbody tr {
            transition: .18s ease;
        }

        .es-table tbody tr:hover {
            background: rgba(255,255,255,.012);
        }

        .es-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .es-subject-cell {
            display: flex;
            align-items: center;
            gap: 11px;
            min-width: 220px;
        }

        .es-subject-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(117,97,255,.17);
            border-radius: 11px;
            background: rgba(117,97,255,.055);
            color: #9e93ff;
            font-size: 11px;
            font-weight: 800;
        }

        .es-subject-name {
            color: #e3e3e7;
            font-size: 10px;
            font-weight: 700;
        }

        .es-subject-desc {
            max-width: 360px;
            margin-top: 3px;
            color: #55555e;
            font-size: 8px;
            line-height: 1.45;
        }

        .es-topic-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-width: 30px;
            padding: 5px 8px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 7px;
            background: rgba(255,255,255,.025);
            color: #9b9ba3;
            font-size: 8px;
            font-weight: 700;
        }

        .es-topic-count svg {
            width: 11px;
            height: 11px;
            color: #77717f;
        }

        .es-order {
            color: #686870;
            font-variant-numeric: tabular-nums;
        }

        .es-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 23px;
            padding: 0 8px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 7px;
            background: rgba(255,255,255,.025);
            font-size: 8px;
            font-weight: 720;
        }

        .es-status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .es-status.active {
            color: #9da9a2;
            border-color: rgba(157,169,162,.12);
            background: rgba(157,169,162,.045);
        }

        .es-status.inactive {
            color: #8a8a91;
            border-color: rgba(138,138,145,.10);
            background: rgba(138,138,145,.035);
        }

        .es-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 5px;
        }

        .es-action {
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
            transition: .18s ease;
        }

        .es-action:hover {
            color: #a49aff;
            border-color: rgba(117,97,255,.30);
            background: rgba(117,97,255,.055);
        }

        .es-action.delete:hover {
            color: #d7858c;
            border-color: rgba(215,133,140,.25);
            background: rgba(215,133,140,.045);
        }

        .es-action svg {
            width: 14px;
            height: 14px;
        }

        .es-empty {
            padding: 65px 25px;
            text-align: center;
        }

        .es-empty-icon {
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

        .es-empty-icon svg {
            width: 25px;
            height: 25px;
        }

        .es-empty-title {
            margin: 0;
            color: #d6d6da;
            font-size: 13px;
            font-weight: 720;
        }

        .es-empty-text {
            max-width: 410px;
            margin: 6px auto 17px;
            color: #5e5e67;
            font-size: 10px;
            line-height: 1.6;
        }

        .es-pagination {
            padding: 15px 19px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .es-pagination nav {
            display: flex;
            justify-content: center;
        }

        .es-pagination svg {
            width: 13px;
            height: 13px;
        }

        @media (max-width: 1050px) {
            .es-filters {
                grid-template-columns: 1fr 1fr auto;
            }

            .es-input-wrap {
                grid-column: span 2;
            }
        }

        @media (max-width: 800px) {
            .es-page {
                padding: 17px;
            }

            .es-header {
                align-items: stretch;
                flex-direction: column;
            }

            .es-primary {
                width: 100%;
            }

            .es-stats {
                grid-template-columns: 1fr;
            }

            .es-filters {
                grid-template-columns: 1fr 1fr;
            }

            .es-input-wrap {
                grid-column: span 2;
            }

            .es-filter-btn {
                width: 100%;
            }

            .es-clear {
                width: 100%;
            }
        }

        @media (max-width: 520px) {
            .es-page {
                padding: 11px;
            }

            .es-heading {
                align-items: flex-start;
            }

            .es-icon {
                width: 45px;
                height: 45px;
                flex-basis: 45px;
                border-radius: 13px;
            }

            .es-title {
                font-size: 22px;
            }

            .es-filters {
                grid-template-columns: 1fr;
            }

            .es-input-wrap {
                grid-column: span 1;
            }

            .es-filter-btn,
            .es-clear {
                grid-column: span 1;
            }

            .es-main-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="es-page">
        <div class="es-wrap">

            {{-- HEADER --}}
            <div class="es-header">
                <div class="es-heading">

                    <div class="es-icon">
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
                        <div class="es-eyebrow">Online Examination</div>

                        <h1 class="es-title">
                            Exam Subjects
                        </h1>

                        <p class="es-subtitle">
                            Organize subjects and build a structured examination question bank.
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('exam-subjects.create') }}"
                    class="es-primary"
                >
                    <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Add Subject
                </a>
            </div>


            {{-- FLASH --}}
            @if(session('success'))
                <div class="es-alert">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="m5 12 4 4L19 6"
                        />
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="es-alert error">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v4m0 4h.01M10.3 4.9 2.9 18a2 2 0 0 0 1.75 3h14.7a2 2 0 0 0 1.75-3L13.7 4.9a2 2 0 0 0-3.4 0Z"
                        />
                    </svg>

                    <span>{{ session('error') }}</span>
                </div>
            @endif


            {{-- STATS --}}
            <div class="es-stats">

                <div class="es-stat">
                    <div class="es-stat-top">
                        <span class="es-stat-label">Total Subjects</span>

                        <div class="es-stat-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="es-stat-number">
                        {{ number_format($totalSubjects) }}
                    </div>
                </div>


                <div class="es-stat">
                    <div class="es-stat-top">
                        <span class="es-stat-label">Active Subjects</span>

                        <div class="es-stat-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="es-stat-number active">
                        {{ number_format($activeSubjects) }}
                    </div>
                </div>


                <div class="es-stat">
                    <div class="es-stat-top">
                        <span class="es-stat-label">Inactive Subjects</span>

                        <div class="es-stat-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M6 6l12 12M18 6 6 18"
                                />
                            </svg>
                        </div>
                    </div>

                    <div class="es-stat-number inactive">
                        {{ number_format($inactiveSubjects) }}
                    </div>
                </div>

            </div>


            {{-- FILTER --}}
            <div class="es-filter">

                <div class="es-filter-title">
                    Find & Filter Subjects
                </div>

                <form
                    method="GET"
                    action="{{ route('exam-subjects.index') }}"
                    class="es-filters"
                >

                    <div class="es-input-wrap">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="m21 21-4.35-4.35M10.8 18a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Z"
                            />
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            class="es-input"
                            placeholder="Search subject name or description..."
                        >
                    </div>


                    <select name="status" class="es-select">
                        <option value="">All Status</option>

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


                    <button type="submit" class="es-filter-btn">
                        Apply Filters
                    </button>


                    @if($search || $status)
                        <a
                            href="{{ route('exam-subjects.index') }}"
                            class="es-clear"
                        >
                            Clear
                        </a>
                    @endif

                </form>

            </div>


            {{-- MAIN --}}
            <div class="es-main">

                <div class="es-main-head">

                    <div>
                        <h2 class="es-main-title">
                            All Subjects
                        </h2>

                        <div class="es-main-sub">
                            Subjects available for your examination system
                        </div>
                    </div>

                    <div class="es-count">
                        Showing {{ $subjects->count() }}
                        @if(method_exists($subjects, 'total'))
                            of {{ $subjects->total() }}
                        @endif
                    </div>

                </div>


                @if($subjects->count())

                    <div class="es-table-wrap">

                        <table class="es-table">

                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Topics</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($subjects as $subject)

                                    <tr>

                                        {{-- SUBJECT --}}
                                        <td>
                                            <div class="es-subject-cell">

                                                <div class="es-subject-avatar">
                                                    {{ strtoupper(substr($subject->name, 0, 1)) }}
                                                </div>

                                                <div>
                                                    <div class="es-subject-name">
                                                        {{ $subject->name }}
                                                    </div>

                                                    @if($subject->description)
                                                        <div class="es-subject-desc">
                                                            {{ Str::limit($subject->description, 110) }}
                                                        </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </td>


                                        {{-- TOPICS --}}
                                        <td>
                                            @php
                                                $topicCount = $subject->topics?->count() ?? 0;
                                            @endphp

                                            <span class="es-topic-count">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.7"
                                                        d="M4 6h16M4 12h16M4 18h10"
                                                    />
                                                </svg>

                                                {{ $topicCount }}
                                            </span>
                                        </td>


                                        {{-- ORDER --}}
                                        <td>
                                            <span class="es-order">
                                                {{ $subject->sort_order }}
                                            </span>
                                        </td>


                                        {{-- STATUS --}}
                                        <td>

                                            @if($subject->is_active)

                                                <span class="es-status active">
                                                    <span class="es-status-dot"></span>
                                                    Active
                                                </span>

                                            @else

                                                <span class="es-status inactive">
                                                    <span class="es-status-dot"></span>
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTIONS --}}
                                        <td>

                                            <div class="es-actions">

                                                {{-- VIEW --}}
                                                <a
                                                    href="{{ route('exam-subjects.show', $subject) }}"
                                                    class="es-action"
                                                    title="View Subject"
                                                >
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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


                                                {{-- EDIT --}}
                                                <a
                                                    href="{{ route('exam-subjects.edit', $subject) }}"
                                                    class="es-action"
                                                    title="Edit Subject"
                                                >
                                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="m15 5 4 4M4 20l4.2-1 10.1-10.1a2.8 2.8 0 0 0-4-4L4.2 15 4 20Z"
                                                        />
                                                    </svg>
                                                </a>


                                                {{-- DELETE --}}
                                                <form
                                                    action="{{ route('exam-subjects.destroy', $subject) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Delete this subject permanently?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="es-action delete"
                                                        title="Delete Subject"
                                                    >
                                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}
                    @if($subjects->hasPages())

                        <div class="es-pagination">
                            {{ $subjects->links() }}
                        </div>

                    @endif


                @else

                    {{-- EMPTY --}}
                    <div class="es-empty">

                        <div class="es-empty-icon">
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

                        <h3 class="es-empty-title">
                            No subjects found
                        </h3>

                        <p class="es-empty-text">
                            No examination subjects match your current filters.
                            Create your first subject to start building your question bank.
                        </p>

                        <a
                            href="{{ route('exam-subjects.create') }}"
                            class="es-primary"
                        >
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Add First Subject
                        </a>

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-layouts::examination>