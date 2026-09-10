<x-layouts::examination :title="'Subject Details'">

    <style>
        .ess-page {
            min-height: 100%;
            padding: 28px;
            color: #f5f5f7;
            background:
                radial-gradient(circle at 85% 0%, rgba(117,97,255,.11), transparent 32rem),
                radial-gradient(circle at 0% 70%, rgba(82,112,255,.055), transparent 28rem);
        }

        .ess-wrap {
            width: 100%;
            max-width: 1450px;
            margin: 0 auto;
        }

        .ess-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 18px;
        }

        .ess-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
        }

        .ess-icon {
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

        .ess-icon svg {
            width: 25px;
            height: 25px;
        }

        .ess-eyebrow {
            margin-bottom: 4px;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #706c8d;
        }

        .ess-title {
            margin: 0;
            color: #fff;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
        }

        .ess-subtitle {
            margin: 5px 0 0;
            color: #707078;
            font-size: 11px;
        }

        .ess-header-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .ess-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 40px;
            padding: 0 13px;
            border: 1px solid #2a2a31;
            border-radius: 10px;
            background: #0e0e12;
            color: #85858d;
            text-decoration: none;
            font-size: 9px;
            font-weight: 700;
            transition: .2s ease;
        }

        .ess-btn:hover {
            color: #aaa2ff;
            border-color: rgba(117,97,255,.3);
            background: rgba(117,97,255,.045);
        }

        .ess-btn.primary {
            border-color: rgba(117,97,255,.45);
            background: linear-gradient(135deg,#7561ff,#5b47e6);
            color: #fff !important;
            box-shadow: 0 9px 24px rgba(93,73,233,.16);
        }

        .ess-btn.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 29px rgba(93,73,233,.24);
        }

        .ess-btn svg {
            width: 14px;
            height: 14px;
        }

        .ess-alert {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid rgba(117,97,255,.17);
            border-radius: 13px;
            background: rgba(117,97,255,.05);
            color: #aaa2d7;
            font-size: 10px;
        }

        .ess-alert svg {
            width: 15px;
            height: 15px;
        }

        .ess-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(290px, .75fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .ess-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 18px;
            background: #121216;
            box-shadow: inset 0 1px 0 rgba(255,255,255,.015);
        }

        .ess-card-head {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 16px 18px;
            border-bottom: 1px solid rgba(255,255,255,.065);
        }

        .ess-card-head-icon {
            width: 31px;
            height: 31px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: #9e93ff;
            background: rgba(117,97,255,.08);
        }

        .ess-card-head-icon svg {
            width: 15px;
            height: 15px;
        }

        .ess-card-title {
            margin: 0;
            color: #e9e9ed;
            font-size: 11px;
            font-weight: 740;
        }

        .ess-card-subtitle {
            margin-top: 3px;
            color: #5f5f68;
            font-size: 8px;
        }

        .ess-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .ess-info-item {
            padding: 17px 18px;
            border-bottom: 1px solid rgba(255,255,255,.045);
        }

        .ess-info-item:nth-child(odd) {
            border-right: 1px solid rgba(255,255,255,.045);
        }

        .ess-info-label {
            color: #55555e;
            font-size: 8px;
            font-weight: 720;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .ess-info-value {
            margin-top: 6px;
            color: #d8d8dd;
            font-size: 10px;
            line-height: 1.5;
            word-break: break-word;
        }

        .ess-info-value.large {
            color: #fff;
            font-size: 14px;
            font-weight: 730;
        }

        .ess-info-full {
            grid-column: span 2;
            padding: 17px 18px;
        }

        .ess-description {
            margin-top: 6px;
            color: #8b8b94;
            font-size: 9px;
            line-height: 1.65;
        }

        .ess-overview-body {
            padding: 15px;
        }

        .ess-overview-stat {
            padding: 15px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 13px;
            background: rgba(255,255,255,.016);
            margin-bottom: 9px;
        }

        .ess-overview-stat:last-child {
            margin-bottom: 0;
        }

        .ess-overview-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .ess-overview-label {
            color: #686871;
            font-size: 9px;
        }

        .ess-overview-icon {
            width: 27px;
            height: 27px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #8f83ef;
            background: rgba(117,97,255,.07);
        }

        .ess-overview-icon svg {
            width: 14px;
            height: 14px;
        }

        .ess-overview-number {
            margin-top: 8px;
            color: #9e93ff;
            font-size: 25px;
            line-height: 1;
            font-weight: 780;
        }

        .ess-overview-status {
            margin-top: 9px;
        }

        .ess-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 23px;
            padding: 0 8px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 7px;
            font-size: 8px;
            font-weight: 720;
        }

        .ess-status-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .ess-status.active {
            color: #9da9a2;
            background: rgba(157,169,162,.045);
            border-color: rgba(157,169,162,.12);
        }

        .ess-status.inactive {
            color: #8a8a91;
            background: rgba(138,138,145,.035);
        }

        .ess-topics {
            margin-bottom: 16px;
        }

        .ess-topics-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 16px 18px;
            border-bottom: 1px solid rgba(255,255,255,.065);
        }

        .ess-topics-actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .ess-table-wrap {
            overflow-x: auto;
        }

        .ess-table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
        }

        .ess-table th {
            padding: 11px 18px;
            border-bottom: 1px solid rgba(255,255,255,.05);
            background: rgba(255,255,255,.015);
            color: #5f5f68;
            font-size: 8px;
            font-weight: 720;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
        }

        .ess-table th:last-child {
            text-align: right;
        }

        .ess-table td {
            padding: 14px 18px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #85858d;
            font-size: 9px;
            vertical-align: middle;
        }

        .ess-table tbody tr {
            transition: .18s ease;
        }

        .ess-table tbody tr:hover {
            background: rgba(255,255,255,.012);
        }

        .ess-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .ess-topic-name {
            color: #dedee2;
            font-size: 10px;
            font-weight: 700;
        }

        .ess-topic-description {
            max-width: 380px;
            margin-top: 3px;
            color: #55555e;
            font-size: 8px;
            line-height: 1.45;
        }

        .ess-order {
            color: #696970;
            font-variant-numeric: tabular-nums;
        }

        .ess-table-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
        }

        .ess-mini-action {
            width: 31px;
            height: 31px;
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

        .ess-mini-action:hover {
            color: #a49aff;
            border-color: rgba(117,97,255,.3);
            background: rgba(117,97,255,.055);
        }

        .ess-mini-action svg {
            width: 13px;
            height: 13px;
        }

        .ess-empty {
            padding: 55px 20px;
            text-align: center;
        }

        .ess-empty-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(117,97,255,.13);
            border-radius: 15px;
            background: rgba(117,97,255,.05);
            color: #8075cc;
        }

        .ess-empty-icon svg {
            width: 23px;
            height: 23px;
        }

        .ess-empty-title {
            margin: 0;
            color: #d6d6da;
            font-size: 12px;
            font-weight: 720;
        }

        .ess-empty-text {
            max-width: 390px;
            margin: 6px auto 15px;
            color: #5e5e67;
            font-size: 9px;
            line-height: 1.6;
        }

        .ess-view-all {
            padding: 13px;
            border-top: 1px solid rgba(255,255,255,.045);
            text-align: center;
        }

        .ess-view-all a {
            color: #8f83ef;
            font-size: 9px;
            font-weight: 700;
            text-decoration: none;
        }

        .ess-view-all a:hover {
            color: #aaa2ff;
        }

        .ess-danger {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 17px 18px;
            border: 1px solid rgba(215,133,140,.15);
            border-radius: 16px;
            background: rgba(215,133,140,.025);
        }

        .ess-danger-title {
            color: #d8d8dc;
            font-size: 10px;
            font-weight: 720;
        }

        .ess-danger-text {
            margin-top: 4px;
            color: #606069;
            font-size: 8px;
            line-height: 1.5;
        }

        .ess-delete {
            height: 38px;
            padding: 0 13px;
            border: 1px solid rgba(215,133,140,.24);
            border-radius: 9px;
            background: rgba(215,133,140,.045);
            color: #c9858c;
            font-family: inherit;
            font-size: 9px;
            font-weight: 700;
            cursor: pointer;
            transition: .18s ease;
        }

        .ess-delete:hover {
            border-color: rgba(215,133,140,.4);
            background: rgba(215,133,140,.08);
        }

        @media (max-width: 900px) {
            .ess-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .ess-page {
                padding: 17px;
            }

            .ess-header {
                align-items: stretch;
                flex-direction: column;
            }

            .ess-header-actions {
                width: 100%;
            }

            .ess-header-actions .ess-btn {
                flex: 1;
            }

            .ess-info {
                grid-template-columns: 1fr;
            }

            .ess-info-item:nth-child(odd) {
                border-right: 0;
            }

            .ess-info-full {
                grid-column: span 1;
            }

            .ess-topics-head {
                align-items: flex-start;
                flex-direction: column;
            }

            .ess-topics-actions {
                width: 100%;
            }

            .ess-topics-actions .ess-btn {
                flex: 1;
            }

            .ess-danger {
                align-items: flex-start;
                flex-direction: column;
            }

            .ess-delete {
                width: 100%;
            }
        }

        @media (max-width: 520px) {
            .ess-page {
                padding: 11px;
            }

            .ess-heading {
                align-items: flex-start;
            }

            .ess-icon {
                width: 45px;
                height: 45px;
                flex-basis: 45px;
                border-radius: 13px;
            }

            .ess-title {
                font-size: 22px;
            }

            .ess-header-actions {
                flex-direction: column;
            }

            .ess-header-actions .ess-btn {
                width: 100%;
                flex: none;
            }
        }
    </style>

    <div class="ess-page">
        <div class="ess-wrap">

            {{-- HEADER --}}
            <div class="ess-header">

                <div class="ess-heading">

                    <div class="ess-icon">
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
                        <div class="ess-eyebrow">Exam Subject</div>

                        <h1 class="ess-title">
                            {{ $examSubject->name }}
                        </h1>

                        <p class="ess-subtitle">
                            Subject details, topics and question-bank structure.
                        </p>
                    </div>

                </div>


                <div class="ess-header-actions">

                    <a
                        href="{{ route('exam-subjects.index') }}"
                        class="ess-btn"
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

                    <a
                        href="{{ route('exam-subjects.edit', $examSubject) }}"
                        class="ess-btn primary"
                    >
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="m15 5 4 4M4 20l4.2-1 10.1-10.1a2.8 2.8 0 0 0-4-4L4.2 15 4 20Z"
                            />
                        </svg>

                        Edit Subject
                    </a>

                </div>

            </div>


            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="ess-alert">

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


            {{-- SUBJECT OVERVIEW --}}
            <div class="ess-grid">

                <div class="ess-card">

                    <div class="ess-card-head">

                        <div class="ess-card-head-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5v-16Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="ess-card-title">
                                Subject Information
                            </h2>

                            <div class="ess-card-subtitle">
                                Core configuration and metadata
                            </div>
                        </div>

                    </div>


                    <div class="ess-info">

                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Subject Name
                            </div>

                            <div class="ess-info-value large">
                                {{ $examSubject->name }}
                            </div>

                        </div>


                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Status
                            </div>

                            <div class="ess-info-value">

                                @if($examSubject->is_active)

                                    <span class="ess-status active">
                                        <span class="ess-status-dot"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="ess-status inactive">
                                        <span class="ess-status-dot"></span>
                                        Inactive
                                    </span>

                                @endif

                            </div>

                        </div>


                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Slug
                            </div>

                            <div class="ess-info-value">
                                {{ $examSubject->slug }}
                            </div>

                        </div>


                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Display Order
                            </div>

                            <div class="ess-info-value">
                                {{ $examSubject->sort_order }}
                            </div>

                        </div>


                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Created
                            </div>

                            <div class="ess-info-value">
                                {{ $examSubject->created_at?->format('d M Y, h:i A') }}
                            </div>

                        </div>


                        <div class="ess-info-item">

                            <div class="ess-info-label">
                                Last Updated
                            </div>

                            <div class="ess-info-value">
                                {{ $examSubject->updated_at?->format('d M Y, h:i A') }}
                            </div>

                        </div>


                        <div class="ess-info-full">

                            <div class="ess-info-label">
                                Description
                            </div>

                            <div class="ess-description">
                                {{ $examSubject->description ?: 'No description added for this subject.' }}
                            </div>

                        </div>

                    </div>

                </div>


                {{-- OVERVIEW --}}
                <div class="ess-card">

                    <div class="ess-card-head">

                        <div class="ess-card-head-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 19V5m0 14h16M8 16v-4M12 16V8M16 16V6"
                                />
                            </svg>
                        </div>

                        <div>
                            <h2 class="ess-card-title">
                                Subject Overview
                            </h2>

                            <div class="ess-card-subtitle">
                                Quick structure summary
                            </div>
                        </div>

                    </div>


                    <div class="ess-overview-body">

                        <div class="ess-overview-stat">

                            <div class="ess-overview-top">

                                <span class="ess-overview-label">
                                    Topics
                                </span>

                                <div class="ess-overview-icon">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.7"
                                            d="M4 6h16M4 12h16M4 18h10"
                                        />
                                    </svg>
                                </div>

                            </div>

                            <div class="ess-overview-number">
                                {{ $examSubject->topics()->count() }}
                            </div>

                        </div>


                        <div class="ess-overview-stat">

                            <div class="ess-overview-top">

                                <span class="ess-overview-label">
                                    Subject Status
                                </span>

                                <div class="ess-overview-icon">
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

                            <div class="ess-overview-status">

                                @if($examSubject->is_active)

                                    <span class="ess-status active">
                                        <span class="ess-status-dot"></span>
                                        Active
                                    </span>

                                @else

                                    <span class="ess-status inactive">
                                        <span class="ess-status-dot"></span>
                                        Inactive
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- TOPICS --}}
            <div class="ess-card ess-topics">

                <div class="ess-topics-head">

                    <div>
                        <h2 class="ess-card-title">
                            Topics
                        </h2>

                        <div class="ess-card-subtitle">
                            Organize questions into structured topics under this subject.
                        </div>
                    </div>


                    <div class="ess-topics-actions">

                        <a
                            href="{{ route('exam-topics.index', $examSubject) }}"
                            class="ess-btn"
                        >
                            Manage Topics
                        </a>

                        <a
                            href="{{ route('exam-topics.create', $examSubject) }}"
                            class="ess-btn primary"
                        >
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Add Topic
                        </a>

                    </div>

                </div>


                @php
                    $topics = $examSubject->topics()
                        ->orderBy('sort_order')
                        ->orderBy('name')
                        ->get();
                @endphp


                @if($topics->count())

                    <div class="ess-table-wrap">

                        <table class="ess-table">

                            <thead>
                                <tr>
                                    <th>Topic</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($topics as $topic)

                                    <tr>

                                        <td>

                                            <div class="ess-topic-name">
                                                {{ $topic->name }}
                                            </div>

                                            @if($topic->description)
                                                <div class="ess-topic-description">
                                                    {{ Str::limit($topic->description, 100) }}
                                                </div>
                                            @endif

                                        </td>


                                        <td>
                                            <span class="ess-order">
                                                {{ $topic->sort_order }}
                                            </span>
                                        </td>


                                        <td>

                                            @if($topic->is_active)

                                                <span class="ess-status active">
                                                    <span class="ess-status-dot"></span>
                                                    Active
                                                </span>

                                            @else

                                                <span class="ess-status inactive">
                                                    <span class="ess-status-dot"></span>
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>


                                        <td>

                                            <div class="ess-table-actions">

                                                <a
                                                    href="{{ route('exam-topics.show', [$examSubject, $topic]) }}"
                                                    class="ess-mini-action"
                                                    title="View Topic"
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


                                                <a
                                                    href="{{ route('exam-topics.edit', [$examSubject, $topic]) }}"
                                                    class="ess-mini-action"
                                                    title="Edit Topic"
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

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    @if($topics->count() > 5)

                        <div class="ess-view-all">
                            <a href="{{ route('exam-topics.index', $examSubject) }}">
                                View all {{ $topics->count() }} topics →
                            </a>
                        </div>

                    @endif

                @else

                    <div class="ess-empty">

                        <div class="ess-empty-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M4 6h16M4 12h16M4 18h10"
                                />
                            </svg>
                        </div>

                        <h3 class="ess-empty-title">
                            No topics yet
                        </h3>

                        <p class="ess-empty-text">
                            Create topics to start organizing questions for this subject.
                        </p>

                        <a
                            href="{{ route('exam-topics.create', $examSubject) }}"
                            class="ess-btn primary"
                        >
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 5v14M5 12h14"
                                />
                            </svg>

                            Add First Topic
                        </a>

                    </div>

                @endif

            </div>


            {{-- DELETE --}}
            <div class="ess-danger">

                <div>
                    <div class="ess-danger-title">
                        Delete Subject
                    </div>

                    <div class="ess-danger-text">
                        Permanently remove this subject and its associated topics.
                        Make sure it is no longer required before deleting.
                    </div>
                </div>


                <form
                    action="{{ route('exam-subjects.destroy', $examSubject) }}"
                    method="POST"
                    onsubmit="return confirm('Delete this subject permanently? All associated topics may also be deleted.');"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="ess-delete"
                    >
                        Delete Subject
                    </button>

                </form>

            </div>

        </div>
    </div>

</x-layouts::examination>