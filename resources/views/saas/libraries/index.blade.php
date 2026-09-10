<x-layouts.saas :title="__('Libraries')">

    <style>
        .libraries-page {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .eyebrow {
            margin: 0 0 7px;
            color: #8b9bb4;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #f7f9fc;
            font-size: 30px;
            line-height: 1.15;
            font-weight: 750;
            letter-spacing: -.03em;
        }

        .page-description {
            margin: 9px 0 0;
            color: #8d9bb0;
            font-size: 14px;
            line-height: 1.6;
            max-width: 680px;
        }

        .header-count {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            padding: 10px 14px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 12px;
            background: rgba(255,255,255,.035);
            color: #dce5f3;
            font-size: 13px;
            font-weight: 650;
        }

        .header-count-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #55d88a;
            box-shadow: 0 0 0 4px rgba(85,216,138,.10);
        }

        .libraries-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .library-card {
            position: relative;
            overflow: hidden;
            padding: 21px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 18px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.055), rgba(255,255,255,.018)),
                rgba(9, 15, 27, .82);
            box-shadow: 0 16px 45px rgba(0,0,0,.18);
            transition: transform .18s ease, border-color .18s ease;
        }

        .library-card:hover {
            transform: translateY(-2px);
            border-color: rgba(255,255,255,.14);
        }

        .library-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -90px;
            top: -100px;
            border-radius: 50%;
            background: rgba(100,130,255,.08);
            pointer-events: none;
        }

        .library-top {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .library-identity {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .library-logo {
            width: 46px;
            height: 46px;
            flex: 0 0 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 13px;
            background: linear-gradient(145deg, #202c42, #121a29);
            color: #dce6f7;
            font-size: 16px;
            font-weight: 800;
        }

        .library-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .library-name {
            margin: 0;
            color: #f2f5fa;
            font-size: 17px;
            font-weight: 720;
            line-height: 1.3;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .library-code {
            margin: 5px 0 0;
            color: #77869c;
            font-size: 11px;
            font-weight: 650;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 10px;
            border-radius: 999px;
            background: rgba(85,216,138,.08);
            border: 1px solid rgba(85,216,138,.16);
            color: #72e49e;
            font-size: 11px;
            font-weight: 750;
            text-transform: capitalize;
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-badge.inactive,
        .status-badge.suspended {
            background: rgba(255,180,85,.08);
            border-color: rgba(255,180,85,.15);
            color: #ffc477;
        }

        .owner-row {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid rgba(255,255,255,.055);
        }

        .owner-avatar {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(255,255,255,.055);
            color: #cdd8e8;
            font-size: 12px;
            font-weight: 750;
        }

        .owner-info {
            min-width: 0;
        }

        .owner-label {
            margin: 0 0 2px;
            color: #69788f;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .owner-name {
            margin: 0;
            color: #d7dfeb;
            font-size: 13px;
            font-weight: 650;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .owner-email {
            margin-left: auto;
            max-width: 45%;
            color: #78869a;
            font-size: 11px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .stats-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
            margin-top: 17px;
        }

        .stat-box {
            min-width: 0;
            padding: 11px 9px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 11px;
            background: rgba(255,255,255,.025);
        }

        .stat-value {
            display: block;
            color: #edf2f8;
            font-size: 16px;
            line-height: 1.2;
            font-weight: 750;
        }

        .stat-label {
            display: block;
            margin-top: 5px;
            color: #68778d;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .subscription-row {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 15px;
            padding: 13px 14px;
            border-radius: 12px;
            background: rgba(255,255,255,.028);
            border: 1px solid rgba(255,255,255,.05);
        }

        .plan-label {
            margin: 0 0 3px;
            color: #6e7d92;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
        }

        .plan-name {
            margin: 0;
            color: #dce4ef;
            font-size: 13px;
            font-weight: 700;
        }

        .expiry {
            text-align: right;
        }

        .expiry-label {
            margin: 0 0 3px;
            color: #6e7d92;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .07em;
        }

        .expiry-date {
            margin: 0;
            color: #bfcbdc;
            font-size: 12px;
            font-weight: 650;
        }

        .card-footer {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 16px;
        }

        .revenue {
            color: #8795aa;
            font-size: 11px;
        }

        .revenue strong {
            color: #dbe4f0;
            font-size: 12px;
        }

        .view-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 35px;
            padding: 0 13px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            background: rgba(255,255,255,.045);
            color: #e2e8f2;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: background .18s ease, border-color .18s ease;
        }

        .view-button:hover {
            background: rgba(255,255,255,.075);
            border-color: rgba(255,255,255,.14);
        }

        .view-button svg {
            width: 14px;
            height: 14px;
        }

        .empty-state {
            padding: 55px 25px;
            border: 1px dashed rgba(255,255,255,.10);
            border-radius: 18px;
            background: rgba(255,255,255,.018);
            text-align: center;
        }

        .empty-state h3 {
            margin: 0;
            color: #e5ebf4;
            font-size: 17px;
        }

        .empty-state p {
            margin: 8px 0 0;
            color: #7d8ba0;
            font-size: 13px;
        }

        @media (max-width: 1100px) {
            .libraries-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .page-title {
                font-size: 25px;
            }

            .stats-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .owner-email {
                display: none;
            }
        }

        @media (max-width: 460px) {
            .library-card {
                padding: 16px;
            }

            .library-top {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .subscription-row,
            .card-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .expiry {
                text-align: left;
            }
        }
    </style>

    <div class="libraries-page">

        <div class="page-header">
            <div>
                <p class="eyebrow">Customer Management</p>
                <h1 class="page-title">Libraries</h1>
                <p class="page-description">
                    Manage every registered library, subscription, usage and customer account from one central SaaS panel.
                </p>
            </div>

            <div class="header-count">
                <span class="header-count-dot"></span>
                {{ $libraryStats->count() }} Registered Libraries
            </div>
        </div>

        @if($libraryStats->isEmpty())

            <div class="empty-state">
                <h3>No libraries registered yet</h3>
                <p>New customers will automatically appear here after registration.</p>
            </div>

        @else

            <div class="libraries-grid">

                @foreach($libraryStats as $item)

                    @php
                        $library = $item['library'];
                        $owner = $item['owner'];
                        $subscription = $item['latest_subscription'];

                        $initial = strtoupper(
                            mb_substr(
                                $library->name ?: 'L',
                                0,
                                1
                            )
                        );

                        $statusClass = strtolower((string) $library->status);
                    @endphp

                    <div class="library-card">

                        <div class="library-top">

                            <div class="library-identity">

                                <div class="library-logo">
                                    @if($library->logo)
                                        <img
                                            src="{{ asset('storage/' . $library->logo) }}"
                                            alt="{{ $library->name }}"
                                        >
                                    @else
                                        {{ $initial }}
                                    @endif
                                </div>

                                <div>
                                    <h2 class="library-name">
                                        {{ $library->name }}
                                    </h2>

                                    <p class="library-code">
                                        {{ $library->code }}
                                    </p>
                                </div>

                            </div>

                            <span class="status-badge {{ $statusClass }}">
                                {{ $library->status ?: 'Unknown' }}
                            </span>

                        </div>

                        <div class="owner-row">

                            <div class="owner-avatar">
                                {{ strtoupper(mb_substr($owner?->name ?: 'U', 0, 1)) }}
                            </div>

                            <div class="owner-info">
                                <p class="owner-label">Primary Account</p>
                                <p class="owner-name">
                                    {{ $owner?->name ?: 'Not available' }}
                                </p>
                            </div>

                            @if($owner?->email)
                                <span class="owner-email">
                                    {{ $owner->email }}
                                </span>
                            @endif

                        </div>

                        <div class="stats-grid">

                            <div class="stat-box">
                                <span class="stat-value">
                                    {{ number_format($item['total_students']) }}
                                </span>
                                <span class="stat-label">Students</span>
                            </div>

                            <div class="stat-box">
                                <span class="stat-value">
                                    {{ number_format($item['online_exam_students']) }}
                                </span>
                                <span class="stat-label">Exam Users</span>
                            </div>

                            <div class="stat-box">
                                <span class="stat-value">
                                    {{ number_format($item['total_exams']) }}
                                </span>
                                <span class="stat-label">Exams</span>
                            </div>

                            <div class="stat-box">
                                <span class="stat-value">
                                    {{ number_format($item['total_questions']) }}
                                </span>
                                <span class="stat-label">Questions</span>
                            </div>

                            <div class="stat-box">
                                <span class="stat-value">
                                    {{ number_format($item['total_attempts']) }}
                                </span>
                                <span class="stat-label">Attempts</span>
                            </div>

                        </div>

                        <div class="subscription-row">

                            <div>
                                <p class="plan-label">Current Plan</p>

                                <p class="plan-name">
                                    {{ $subscription?->plan_name ?: 'No subscription' }}
                                </p>
                            </div>

                            <div class="expiry">

                                <p class="expiry-label">Expiry</p>

                                <p class="expiry-date">
                                    @if($subscription?->ends_at)
                                        {{ $subscription->ends_at->format('d M Y') }}
                                    @else
                                        —
                                    @endif
                                </p>

                            </div>

                        </div>

                        <div class="card-footer">

                            <div class="revenue">
                                Paid:
                                <strong>
                                    ₹{{ number_format((float) $item['total_paid'], 2) }}
                                </strong>
                            </div>

                            <a
                                href="{{ route('saas.libraries.show', $library) }}"
                                class="view-button"
                            >
                                View Details

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M5 12h14"></path>
                                    <path d="m13 6 6 6-6 6"></path>
                                </svg>
                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

    </div>

</x-layouts.saas>