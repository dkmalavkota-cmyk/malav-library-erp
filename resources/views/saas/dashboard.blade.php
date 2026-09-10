<x-layouts.saas :title="__('SaaS Control Center')">

    <style>
        .saas-dashboard {
            --saas-bg: #070a12;
            --saas-panel: rgba(15, 20, 32, .82);
            --saas-panel-strong: rgba(18, 24, 38, .96);
            --saas-border: rgba(148, 163, 184, .12);
            --saas-border-hover: rgba(129, 140, 248, .30);
            --saas-text: #f8fafc;
            --saas-muted: #94a3b8;
            --saas-soft: #64748b;
            min-height: 100vh;
            background:
                radial-gradient(circle at 78% 4%, rgba(99, 102, 241, .10), transparent 28rem),
                radial-gradient(circle at 15% 35%, rgba(14, 165, 233, .055), transparent 25rem),
                var(--saas-bg);
        }

        .saas-container {
            width: 100%;
            max-width: 1680px;
            margin: 0 auto;
            padding: 34px 34px 48px;
        }

        .saas-topbar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 30px;
        }

        .saas-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: #a5b4fc;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        .saas-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #818cf8;
            box-shadow: 0 0 18px rgba(129, 140, 248, .75);
        }

        .saas-title {
            margin-top: 9px;
            color: var(--saas-text);
            font-size: clamp(28px, 3vw, 40px);
            line-height: 1.05;
            font-weight: 800;
            letter-spacing: -.045em;
        }

        .saas-subtitle {
            margin-top: 10px;
            max-width: 680px;
            color: var(--saas-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .saas-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .saas-action {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid rgba(148, 163, 184, .14);
            border-radius: 12px;
            background: rgba(15, 23, 42, .72);
            color: #cbd5e1;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            transition: .2s ease;
        }

        .saas-action:hover {
            border-color: rgba(129, 140, 248, .35);
            background: rgba(30, 41, 59, .85);
            color: white;
            transform: translateY(-1px);
        }

        .saas-action.primary {
            border-color: rgba(99, 102, 241, .35);
            background: linear-gradient(135deg, rgba(79, 70, 229, .92), rgba(99, 102, 241, .72));
            color: white;
            box-shadow: 0 12px 35px rgba(79, 70, 229, .18);
        }

        .saas-action.primary:hover {
            border-color: rgba(165, 180, 252, .55);
            box-shadow: 0 16px 40px rgba(79, 70, 229, .25);
        }

        /* KPI */

        .saas-kpis {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
        }

        .saas-kpi {
            position: relative;
            overflow: hidden;
            min-height: 166px;
            padding: 21px;
            border: 1px solid var(--saas-border);
            border-radius: 18px;
            background:
                linear-gradient(145deg, rgba(20, 27, 43, .95), rgba(10, 14, 24, .94));
            box-shadow:
                0 20px 55px rgba(0, 0, 0, .18),
                inset 0 1px 0 rgba(255, 255, 255, .025);
            transition: .2s ease;
        }

        .saas-kpi:hover {
            border-color: var(--saas-border-hover);
            transform: translateY(-2px);
        }

        .saas-kpi::after {
            content: "";
            position: absolute;
            width: 120px;
            height: 120px;
            right: -55px;
            top: -55px;
            border-radius: 999px;
            background: var(--kpi-glow, rgba(99, 102, 241, .10));
            filter: blur(8px);
        }

        .kpi-indigo { --kpi-glow: rgba(99, 102, 241, .16); }
        .kpi-cyan { --kpi-glow: rgba(6, 182, 212, .13); }
        .kpi-violet { --kpi-glow: rgba(139, 92, 246, .14); }
        .kpi-emerald { --kpi-glow: rgba(16, 185, 129, .13); }

        .saas-kpi-head {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .saas-kpi-label {
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .saas-kpi-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid rgba(129, 140, 248, .15);
            border-radius: 12px;
            background: rgba(99, 102, 241, .08);
            color: #a5b4fc;
        }

        .saas-kpi-number {
            position: relative;
            z-index: 1;
            margin-top: 20px;
            color: #f8fafc;
            font-size: 32px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -.04em;
        }

        .saas-kpi-bottom {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 18px;
            color: #64748b;
            font-size: 11px;
        }

        .saas-kpi-bottom strong {
            color: #cbd5e1;
            font-weight: 700;
        }

        .saas-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 8px;
            border: 1px solid rgba(16, 185, 129, .16);
            border-radius: 999px;
            background: rgba(16, 185, 129, .07);
            color: #6ee7b7;
            font-size: 10px;
            font-weight: 800;
        }

        .saas-pill-dot {
            width: 5px;
            height: 5px;
            border-radius: 999px;
            background: #34d399;
        }

        /* Secondary stats */

        .saas-secondary {
            display: grid;
            grid-template-columns: 1.1fr 1fr 1fr;
            gap: 15px;
            margin-top: 15px;
        }

        .saas-secondary-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            min-height: 108px;
            padding: 19px 21px;
            border: 1px solid var(--saas-border);
            border-radius: 16px;
            background: rgba(13, 18, 29, .72);
        }

        .secondary-label {
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .secondary-value {
            margin-top: 7px;
            color: #f1f5f9;
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .secondary-note {
            color: #64748b;
            font-size: 11px;
            text-align: right;
        }

        /* Customers */

        .saas-section {
            margin-top: 24px;
            overflow: hidden;
            border: 1px solid var(--saas-border);
            border-radius: 20px;
            background: rgba(10, 15, 25, .82);
            box-shadow: 0 25px 70px rgba(0, 0, 0, .18);
        }

        .saas-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 21px 22px;
            border-bottom: 1px solid var(--saas-border);
            background: rgba(15, 23, 42, .36);
        }

        .saas-section-title {
            color: #f8fafc;
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -.02em;
        }

        .saas-section-desc {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
        }

        .saas-count {
            display: inline-flex;
            align-items: center;
            min-height: 30px;
            padding: 0 11px;
            border: 1px solid rgba(148, 163, 184, .12);
            border-radius: 999px;
            background: rgba(15, 23, 42, .8);
            color: #94a3b8;
            font-size: 10px;
            font-weight: 800;
        }

        /* Table */

        .saas-table-wrap {
            overflow-x: auto;
        }

        .saas-table {
            width: 100%;
            min-width: 1050px;
            border-collapse: collapse;
        }

        .saas-table th {
            padding: 13px 20px;
            border-bottom: 1px solid rgba(148, 163, 184, .09);
            background: rgba(7, 10, 18, .58);
            color: #475569;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .14em;
            text-align: left;
            text-transform: uppercase;
        }

        .saas-table td {
            padding: 17px 20px;
            border-bottom: 1px solid rgba(148, 163, 184, .07);
            vertical-align: middle;
        }

        .saas-table tbody tr {
            transition: background .18s ease;
        }

        .saas-table tbody tr:hover {
            background: rgba(99, 102, 241, .035);
        }

        .saas-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .library-avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 1px solid rgba(129, 140, 248, .18);
            border-radius: 13px;
            background: linear-gradient(145deg, rgba(99, 102, 241, .17), rgba(30, 41, 59, .4));
            color: #c7d2fe;
            font-size: 13px;
            font-weight: 800;
        }

        .library-name {
            color: #e2e8f0;
            font-size: 13px;
            font-weight: 800;
        }

        .library-meta {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 4px;
            color: #64748b;
            font-size: 10px;
        }

        .owner-line {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 10px;
        }

        .plan-name {
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 750;
        }

        .date-line {
            margin-top: 5px;
            color: #64748b;
            font-size: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 9px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .status-badge .dot {
            width: 5px;
            height: 5px;
            border-radius: 999px;
        }

        .status-trial {
            border: 1px solid rgba(245, 158, 11, .18);
            background: rgba(245, 158, 11, .07);
            color: #fbbf24;
        }

        .status-trial .dot {
            background: #f59e0b;
        }

        .status-active {
            border: 1px solid rgba(16, 185, 129, .18);
            background: rgba(16, 185, 129, .07);
            color: #6ee7b7;
        }

        .status-active .dot {
            background: #34d399;
        }

        .status-expired {
            border: 1px solid rgba(244, 63, 94, .18);
            background: rgba(244, 63, 94, .07);
            color: #fda4af;
        }

        .status-expired .dot {
            background: #fb7185;
        }

        .status-cancelled {
            border: 1px solid rgba(148, 163, 184, .14);
            background: rgba(148, 163, 184, .06);
            color: #94a3b8;
        }

        .status-cancelled .dot {
            background: #64748b;
        }

        .status-none {
            border: 1px solid rgba(148, 163, 184, .10);
            background: rgba(148, 163, 184, .04);
            color: #64748b;
        }

        .status-none .dot {
            background: #475569;
        }

        .usage-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(70px, 1fr));
            gap: 7px 15px;
        }

        .usage-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            color: #64748b;
            font-size: 10px;
        }

        .usage-item strong {
            color: #cbd5e1;
            font-size: 11px;
            font-weight: 800;
        }

        .revenue {
            color: #f1f5f9;
            font-size: 12px;
            font-weight: 800;
        }

        .revenue-note {
            margin-top: 4px;
            color: #475569;
            font-size: 9px;
        }

        /* Empty */

        .saas-empty {
            padding: 60px 20px;
            text-align: center;
        }

        .saas-empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            margin: 0 auto;
            border: 1px solid rgba(129, 140, 248, .14);
            border-radius: 15px;
            background: rgba(99, 102, 241, .07);
            color: #818cf8;
        }

        .saas-empty-title {
            margin-top: 15px;
            color: #cbd5e1;
            font-size: 13px;
            font-weight: 800;
        }

        .saas-empty-text {
            margin-top: 5px;
            color: #475569;
            font-size: 11px;
        }

        /* Mobile */

        @media (max-width: 1200px) {
            .saas-kpis {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .saas-secondary {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .saas-container {
                padding: 24px 16px 35px;
            }

            .saas-topbar {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }

            .saas-actions {
                width: 100%;
            }

            .saas-action {
                flex: 1;
                justify-content: center;
            }

            .saas-kpis {
                grid-template-columns: 1fr;
            }

            .saas-kpi {
                min-height: 145px;
            }

            .saas-section-head {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>


    <div class="saas-dashboard">

        <div class="saas-container">

            {{-- ========================================================= --}}
            {{-- HEADER --}}
            {{-- ========================================================= --}}

            <div class="saas-topbar">

                <div>
                    <div class="saas-eyebrow">
                        <span class="saas-eyebrow-dot"></span>
                        Malav Technology · SaaS
                    </div>

                    <h1 class="saas-title">
                        Control Center
                    </h1>

                    <p class="saas-subtitle">
                        A complete overview of your library customers, subscriptions,
                        platform usage and SaaS revenue.
                    </p>
                </div>

                <div class="saas-actions">

                    <a
                        href="{{ route('dashboard') }}"
                        class="saas-action"
                    >
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                        Library ERP
                    </a>

                    <a
                        href="{{ route('saas.dashboard') }}"
                        class="saas-action primary"
                    >
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 12a8 8 0 1 0 2.34-5.66"/>
                            <path d="M4 4v5h5"/>
                        </svg>
                        Refresh Overview
                    </a>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- KPI CARDS --}}
            {{-- ========================================================= --}}

            <div class="saas-kpis">

                {{-- Libraries --}}
                <div class="saas-kpi kpi-indigo">

                    <div class="saas-kpi-head">

                        <div>
                            <div class="saas-kpi-label">
                                Total Libraries
                            </div>

                            <div class="saas-kpi-number">
                                {{ number_format($summary['total_libraries']) }}
                            </div>
                        </div>

                        <div class="saas-kpi-icon">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 21h18"/>
                                <path d="M5 21V5l7-3 7 3v16"/>
                                <path d="M9 9h1"/>
                                <path d="M14 9h1"/>
                                <path d="M9 13h1"/>
                                <path d="M14 13h1"/>
                            </svg>
                        </div>

                    </div>

                    <div class="saas-kpi-bottom">
                        <span class="saas-pill">
                            <span class="saas-pill-dot"></span>
                            {{ number_format($summary['active_libraries']) }} active
                        </span>
                        <span>customer accounts</span>
                    </div>

                </div>


                {{-- Students --}}
                <div class="saas-kpi kpi-cyan">

                    <div class="saas-kpi-head">

                        <div>
                            <div class="saas-kpi-label">
                                Total Students
                            </div>

                            <div class="saas-kpi-number">
                                {{ number_format($summary['total_students']) }}
                            </div>
                        </div>

                        <div class="saas-kpi-icon">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>

                    </div>

                    <div class="saas-kpi-bottom">
                        <strong>Platform wide</strong>
                        <span>registered students</span>
                    </div>

                </div>


                {{-- Exams --}}
                <div class="saas-kpi kpi-violet">

                    <div class="saas-kpi-head">

                        <div>
                            <div class="saas-kpi-label">
                                Online Exams
                            </div>

                            <div class="saas-kpi-number">
                                {{ number_format($summary['total_exams']) }}
                            </div>
                        </div>

                        <div class="saas-kpi-icon">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="4" width="18" height="16" rx="2"/>
                                <path d="M7 8h10"/>
                                <path d="M7 12h6"/>
                                <path d="M7 16h8"/>
                            </svg>
                        </div>

                    </div>

                    <div class="saas-kpi-bottom">
                        <strong>{{ number_format($summary['total_questions']) }}</strong>
                        <span>questions in platform</span>
                    </div>

                </div>


                {{-- Revenue --}}
                <div class="saas-kpi kpi-emerald">

                    <div class="saas-kpi-head">

                        <div>
                            <div class="saas-kpi-label">
                                SaaS Revenue
                            </div>

                            <div class="saas-kpi-number">
                                ₹{{ number_format((float) $summary['total_revenue'], 2) }}
                            </div>
                        </div>

                        <div class="saas-kpi-icon">
                            <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 1v22"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H7"/>
                            </svg>
                        </div>

                    </div>

                    <div class="saas-kpi-bottom">
                        <span class="saas-pill">
                            <span class="saas-pill-dot"></span>
                            {{ number_format($summary['active_subscriptions']) }}
                        </span>
                        <span>trial / active</span>
                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- SECONDARY METRICS --}}
            {{-- ========================================================= --}}

            <div class="saas-secondary">

                <div class="saas-secondary-card">

                    <div>
                        <div class="secondary-label">
                            Exam Attempts
                        </div>

                        <div class="secondary-value">
                            {{ number_format($summary['total_attempts']) }}
                        </div>
                    </div>

                    <div class="secondary-note">
                        Total platform<br>
                        attempts
                    </div>

                </div>


                <div class="saas-secondary-card">

                    <div>
                        <div class="secondary-label">
                            Question Bank
                        </div>

                        <div class="secondary-value">
                            {{ number_format($summary['total_questions']) }}
                        </div>
                    </div>

                    <div class="secondary-note">
                        Questions<br>
                        created
                    </div>

                </div>


                <div class="saas-secondary-card">

                    <div>
                        <div class="secondary-label">
                            Subscription Base
                        </div>

                        <div class="secondary-value">
                            {{ number_format($summary['active_subscriptions']) }}
                        </div>
                    </div>

                    <div class="secondary-note">
                        Trial + active<br>
                        subscriptions
                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- REGISTERED LIBRARIES --}}
            {{-- ========================================================= --}}

            <section class="saas-section">

                <div class="saas-section-head">

                    <div>
                        <div class="saas-section-title">
                            Registered Libraries
                        </div>

                        <div class="saas-section-desc">
                            Customer accounts, subscription health and platform usage
                        </div>
                    </div>

                    <div class="saas-count">
                        {{ number_format($libraryStats->count()) }} customers
                    </div>

                </div>


                @if ($libraryStats->isEmpty())

                    <div class="saas-empty">

                        <div class="saas-empty-icon">
                            <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 21h18"/>
                                <path d="M5 21V5l7-3 7 3v16"/>
                            </svg>
                        </div>

                        <div class="saas-empty-title">
                            No customer libraries yet
                        </div>

                        <div class="saas-empty-text">
                            New SaaS registrations will appear here.
                        </div>

                    </div>

                @else

                    <div class="saas-table-wrap">

                        <table class="saas-table">

                            <thead>
                                <tr>
                                    <th>Library / Owner</th>
                                    <th>Subscription</th>
                                    <th>Usage</th>
                                    <th>Revenue</th>
                                    <th>Library Status</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($libraryStats as $item)

                                    @php
                                        $library = $item['library'];
                                        $owner = $item['owner'];
                                        $subscription = $item['latest_subscription'];

                                        $subscriptionStatus = $subscription?->status ?? 'none';

                                        $subscriptionClass = match ($subscriptionStatus) {
                                            'trial' => 'status-trial',
                                            'active' => 'status-active',
                                            'expired' => 'status-expired',
                                            'cancelled' => 'status-cancelled',
                                            default => 'status-none',
                                        };

                                        $libraryStatus = strtolower((string) ($library->status ?? 'unknown'));

                                        $libraryStatusClass = $libraryStatus === 'active'
                                            ? 'status-active'
                                            : 'status-none';
                                    @endphp

                                    <tr>

                                        {{-- Library --}}
                                        <td>

                                            <div class="library-cell">

                                                <div class="library-avatar">
                                                    {{ strtoupper(substr($library->name, 0, 1)) }}
                                                </div>

                                                <div>

                                                    <div class="library-name">
                                                        {{ $library->name }}
                                                    </div>

                                                    <div class="library-meta">
                                                        <span>CODE</span>
                                                        <strong style="color:#94a3b8;">
                                                            {{ $library->code }}
                                                        </strong>
                                                    </div>

                                                    @if ($owner)

                                                        <div class="owner-line">
                                                            {{ $owner->name }}
                                                            <span style="color:#475569;">·</span>
                                                            {{ $owner->email }}
                                                        </div>

                                                    @else

                                                        <div class="owner-line">
                                                            No owner account found
                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Subscription --}}
                                        <td>

                                            @if ($subscription)

                                                <span class="status-badge {{ $subscriptionClass }}">
                                                    <span class="dot"></span>
                                                    {{ ucfirst($subscriptionStatus) }}
                                                </span>

                                                <div class="plan-name" style="margin-top:8px;">
                                                    {{ $subscription->plan_name }}
                                                </div>

                                                <div class="date-line">
                                                    {{ $subscription->starts_at?->format('d M Y') }}
                                                    <span style="color:#334155;">→</span>
                                                    {{ $subscription->ends_at?->format('d M Y') }}
                                                </div>

                                            @else

                                                <span class="status-badge status-none">
                                                    <span class="dot"></span>
                                                    No Subscription
                                                </span>

                                                <div class="date-line">
                                                    Subscription not created yet
                                                </div>

                                            @endif

                                        </td>


                                        {{-- Usage --}}
                                        <td>

                                            <div class="usage-grid">

                                                <div class="usage-item">
                                                    <span>Students</span>
                                                    <strong>{{ number_format($item['total_students']) }}</strong>
                                                </div>

                                                <div class="usage-item">
                                                    <span>Exam users</span>
                                                    <strong>{{ number_format($item['online_exam_students']) }}</strong>
                                                </div>

                                                <div class="usage-item">
                                                    <span>Exams</span>
                                                    <strong>{{ number_format($item['total_exams']) }}</strong>
                                                </div>

                                                <div class="usage-item">
                                                    <span>Questions</span>
                                                    <strong>{{ number_format($item['total_questions']) }}</strong>
                                                </div>

                                                <div class="usage-item">
                                                    <span>Attempts</span>
                                                    <strong>{{ number_format($item['total_attempts']) }}</strong>
                                                </div>

                                            </div>

                                        </td>


                                        {{-- Revenue --}}
                                        <td>

                                            <div class="revenue">
                                                ₹{{ number_format((float) $item['total_paid'], 2) }}
                                            </div>

                                            <div class="revenue-note">
                                                total paid
                                            </div>

                                        </td>


                                        {{-- Status --}}
                                        <td>

                                            <span class="status-badge {{ $libraryStatusClass }}">
                                                <span class="dot"></span>
                                                {{ ucfirst($libraryStatus) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @endif

            </section>

        </div>

    </div>

</x-layouts.saas>