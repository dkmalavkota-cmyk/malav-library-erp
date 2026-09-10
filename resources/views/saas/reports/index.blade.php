<x-layouts.saas :title="__('Reports')">

    <style>
        .reports-page {
            display: flex;
            flex-direction: column;
            gap: 22px;
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
            color: #8493aa;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #f5f7fb;
            font-size: 29px;
            line-height: 1.15;
            font-weight: 760;
            letter-spacing: -.03em;
        }

        .page-description {
            margin: 8px 0 0;
            color: #7f8da2;
            font-size: 13px;
            line-height: 1.6;
            max-width: 720px;
        }

        .header-stat {
            min-width: 170px;
            padding: 14px 16px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.018)),
                rgba(9,15,27,.72);
        }

        .header-stat-label {
            color: #6f7e94;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .header-stat-value {
            margin-top: 7px;
            color: #edf2f8;
            font-size: 20px;
            line-height: 1;
            font-weight: 760;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 12px;
        }

        .summary-card {
            padding: 16px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.018)),
                rgba(9,15,27,.72);
        }

        .summary-label {
            color: #6f7e94;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 7px;
            color: #edf2f8;
            font-size: 21px;
            line-height: 1;
            font-weight: 760;
        }

        .summary-meta {
            margin-top: 7px;
            color: #69788e;
            font-size: 10px;
            line-height: 1.4;
        }

        .report-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 17px;
            background: rgba(9,15,27,.72);
        }

        .report-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .report-title {
            margin: 0;
            color: #e5ebf3;
            font-size: 14px;
            font-weight: 750;
        }

        .report-description {
            margin: 5px 0 0;
            color: #69788e;
            font-size: 10px;
            line-height: 1.5;
        }

        .report-count {
            padding: 6px 9px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 999px;
            background: rgba(255,255,255,.025);
            color: #7b899d;
            font-size: 9px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .report-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .report-table th {
            padding: 13px 15px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            color: #68778d;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .report-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .report-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .report-table tbody tr:hover {
            background: rgba(255,255,255,.018);
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 200px;
        }

        .library-avatar {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 10px;
            background: linear-gradient(145deg,#202c42,#121a29);
            color: #dce5f2;
            font-size: 12px;
            font-weight: 800;
        }

        .library-name {
            color: #e2e8f1;
            font-size: 12px;
            font-weight: 700;
        }

        .library-code {
            margin-top: 3px;
            color: #65748a;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .plan-name {
            color: #dfe6f0;
            font-size: 11px;
            font-weight: 700;
        }

        .plan-status {
            margin-top: 5px;
            color: #68778d;
            font-size: 9px;
            text-transform: capitalize;
        }

        .metric-value {
            color: #dce4ee;
            font-size: 12px;
            font-weight: 750;
        }

        .metric-label {
            margin-top: 3px;
            color: #647389;
            font-size: 9px;
        }

        .amount {
            color: #e2e9f3;
            font-weight: 750;
            white-space: nowrap;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 999px;
            background: rgba(255,255,255,.035);
            color: #9aa8bb;
            font-size: 9px;
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

        .status-badge.active {
            border-color: rgba(85,216,138,.16);
            background: rgba(85,216,138,.08);
            color: #72e49e;
        }

        .status-badge.trial {
            border-color: rgba(112,151,255,.16);
            background: rgba(112,151,255,.08);
            color: #9bb3ff;
        }

        .status-badge.expired {
            border-color: rgba(255,180,85,.15);
            background: rgba(255,180,85,.08);
            color: #ffc477;
        }

        .status-badge.cancelled {
            border-color: rgba(255,130,130,.14);
            background: rgba(255,130,130,.07);
            color: #ff9b9b;
        }

        .status-badge.unknown {
            color: #7c899d;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            background: rgba(255,255,255,.025);
            color: #68778d;
        }

        .empty-icon svg {
            width: 19px;
            height: 19px;
        }

        .empty-title {
            margin: 0;
            color: #e3e9f2;
            font-size: 16px;
            font-weight: 700;
        }

        .empty-text {
            margin: 7px 0 0;
            color: #6d7b90;
            font-size: 12px;
        }

        @media (max-width: 1250px) {
            .summary-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }
        }

        @media (max-width: 800px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .page-title {
                font-size: 25px;
            }

            .header-stat {
                width: 100%;
            }
        }

        @media (max-width: 430px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="reports-page">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <p class="eyebrow">Business Intelligence</p>

                <h1 class="page-title">
                    Reports
                </h1>

                <p class="page-description">
                    Review customer performance, subscription health, platform usage and recorded SaaS revenue from one central report.
                </p>
            </div>

            <div class="header-stat">
                <div class="header-stat-label">
                    Recorded Revenue
                </div>

                <div class="header-stat-value">
                    ₹{{ number_format((float) $summary['revenue'], 2) }}
                </div>
            </div>

        </div>

        {{-- Summary --}}
        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">Libraries</div>

                <div class="summary-value">
                    {{ number_format($summary['libraries']) }}
                </div>

                <div class="summary-meta">
                    Customer accounts
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Students</div>

                <div class="summary-value">
                    {{ number_format($summary['students']) }}
                </div>

                <div class="summary-meta">
                    Across all customers
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Exams</div>

                <div class="summary-value">
                    {{ number_format($summary['exams']) }}
                </div>

                <div class="summary-meta">
                    Total exam inventory
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Questions</div>

                <div class="summary-value">
                    {{ number_format($summary['questions']) }}
                </div>

                <div class="summary-meta">
                    Platform question bank
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Attempts</div>

                <div class="summary-value">
                    {{ number_format($summary['attempts']) }}
                </div>

                <div class="summary-meta">
                    Total exam attempts
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Subscriptions</div>

                <div class="summary-value">
                    {{ number_format($summary['subscriptions']) }}
                </div>

                <div class="summary-meta">
                    {{ number_format($summary['active_subscriptions']) }} active
                </div>
            </div>

        </div>

        {{-- Subscription Health --}}
        <div class="summary-grid" style="grid-template-columns: repeat(3,minmax(0,1fr));">

            <div class="summary-card">
                <div class="summary-label">Active Subscriptions</div>

                <div class="summary-value">
                    {{ number_format($summary['active_subscriptions']) }}
                </div>

                <div class="summary-meta">
                    Active and trial accounts
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Expired Subscriptions</div>

                <div class="summary-value">
                    {{ number_format($summary['expired_subscriptions']) }}
                </div>

                <div class="summary-meta">
                    Accounts requiring renewal
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Pending Revenue</div>

                <div class="summary-value">
                    ₹{{ number_format((float) $summary['pending_revenue'], 2) }}
                </div>

                <div class="summary-meta">
                    Payments awaiting completion
                </div>
            </div>

        </div>

        {{-- Customer Performance --}}
        <section class="report-card">

            <div class="report-header">

                <div>
                    <h2 class="report-title">
                        Customer Performance
                    </h2>

                    <p class="report-description">
                        Library-wise subscription, student, examination and revenue overview.
                    </p>
                </div>

                <div class="report-count">
                    {{ $libraryReports->count() }} customers
                </div>

            </div>

            @if($libraryReports->count())

                <div class="table-wrap">

                    <table class="report-table">

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Plan</th>
                                <th>Students</th>
                                <th>Exams</th>
                                <th>Questions</th>
                                <th>Attempts</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($libraryReports as $report)

                                @php
                                    $library = $report['library'];
                                    $subscription = $report['subscription'];

                                    $initial = strtoupper(
                                        mb_substr(
                                            $library->name ?: 'L',
                                            0,
                                            1
                                        )
                                    );

                                    $subscriptionStatus = strtolower(
                                        (string) ($subscription?->status ?? 'unknown')
                                    );
                                @endphp

                                <tr>

                                    {{-- Customer --}}
                                    <td>

                                        <div class="library-cell">

                                            <div class="library-avatar">
                                                {{ $initial }}
                                            </div>

                                            <div>
                                                <div class="library-name">
                                                    {{ $library->name ?: 'Unnamed Library' }}
                                                </div>

                                                <div class="library-code">
                                                    {{ $library->code ?: '—' }}
                                                </div>
                                            </div>

                                        </div>

                                    </td>

                                    {{-- Plan --}}
                                    <td>

                                        @if($subscription)

                                            <div class="plan-name">
                                                {{ $subscription->plan_name }}
                                            </div>

                                            <div class="plan-status">
                                                {{ $subscription->status }}
                                            </div>

                                        @else

                                            <span class="metric-label">
                                                No subscription
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Students --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($report['students']) }}
                                        </div>

                                        <div class="metric-label">
                                            Registered
                                        </div>

                                    </td>

                                    {{-- Exams --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($report['exams']) }}
                                        </div>

                                        <div class="metric-label">
                                            Created
                                        </div>

                                    </td>

                                    {{-- Questions --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($report['questions']) }}
                                        </div>

                                        <div class="metric-label">
                                            Question bank
                                        </div>

                                    </td>

                                    {{-- Attempts --}}
                                    <td>

                                        <div class="metric-value">
                                            {{ number_format($report['attempts']) }}
                                        </div>

                                        <div class="metric-label">
                                            Exam attempts
                                        </div>

                                    </td>

                                    {{-- Revenue --}}
                                    <td>

                                        <div class="amount">
                                            ₹{{ number_format((float) $report['revenue'], 2) }}
                                        </div>

                                        <div style="margin-top:5px;">
                                            <span class="status-badge {{ $subscriptionStatus }}">
                                                {{ $subscriptionStatus }}
                                            </span>
                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M4 19V5"></path>
                            <path d="M4 19h16"></path>
                            <path d="M8 16v-5"></path>
                            <path d="M12 16V8"></path>
                            <path d="M16 16v-3"></path>
                        </svg>
                    </div>

                    <h3 class="empty-title">
                        No customer reports available
                    </h3>

                    <p class="empty-text">
                        Report data will appear here once customer activity is recorded.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>