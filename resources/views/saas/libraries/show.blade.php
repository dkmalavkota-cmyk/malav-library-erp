<x-layouts.saas :title="$library->name">

    <style>
        .details-page {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            width: fit-content;
            color: #8291a7;
            font-size: 12px;
            font-weight: 650;
            text-decoration: none;
        }

        .back-link:hover {
            color: #dce5f1;
        }

        .back-link svg {
            width: 15px;
            height: 15px;
        }

        .hero-card {
            position: relative;
            overflow: hidden;
            padding: 25px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 20px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.055), rgba(255,255,255,.018)),
                rgba(9,15,27,.85);
            box-shadow: 0 18px 50px rgba(0,0,0,.2);
        }

        .hero-card::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            right: -140px;
            top: -180px;
            border-radius: 50%;
            background: rgba(105,125,255,.09);
            pointer-events: none;
        }

        .hero-main {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .identity {
            display: flex;
            align-items: center;
            gap: 16px;
            min-width: 0;
        }

        .logo {
            width: 64px;
            height: 64px;
            flex: 0 0 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 17px;
            background: linear-gradient(145deg,#202c42,#111927);
            color: #e4ebf7;
            font-size: 23px;
            font-weight: 800;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .eyebrow {
            margin: 0 0 6px;
            color: #8393ab;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .title {
            margin: 0;
            color: #f5f7fb;
            font-size: 27px;
            font-weight: 760;
            letter-spacing: -.03em;
        }

        .code {
            margin: 6px 0 0;
            color: #75859b;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .1em;
        }

        .status {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border: 1px solid rgba(85,216,138,.16);
            border-radius: 999px;
            background: rgba(85,216,138,.08);
            color: #70e39c;
            font-size: 11px;
            font-weight: 750;
            text-transform: capitalize;
        }

        .status::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0,1fr));
            gap: 12px;
            margin-top: 22px;
        }

        .stat {
            padding: 16px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 13px;
            background: rgba(255,255,255,.025);
        }

        .stat-value {
            display: block;
            color: #edf2f8;
            font-size: 21px;
            font-weight: 760;
        }

        .stat-label {
            display: block;
            margin-top: 5px;
            color: #6f7e94;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 18px;
        }

        .panel {
            padding: 20px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 18px;
            background: rgba(10,16,28,.72);
        }

        .panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 17px;
        }

        .panel-title {
            margin: 0;
            color: #edf2f7;
            font-size: 15px;
            font-weight: 730;
        }

        .panel-subtitle {
            margin: 4px 0 0;
            color: #6f7e94;
            font-size: 11px;
        }

        .info-list {
            display: flex;
            flex-direction: column;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 0;
            border-bottom: 1px solid rgba(255,255,255,.045);
        }

        .info-row:last-child {
            border-bottom: 0;
        }

        .info-label {
            color: #6e7d92;
            font-size: 11px;
            font-weight: 650;
        }

        .info-value {
            color: #d8e0eb;
            font-size: 12px;
            font-weight: 650;
            text-align: right;
            word-break: break-word;
        }

        .subscription-card {
            padding: 17px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 14px;
            background: rgba(255,255,255,.025);
        }

        .plan {
            color: #f0f4fa;
            font-size: 18px;
            font-weight: 750;
        }

        .plan-status {
            display: inline-block;
            margin-top: 7px;
            padding: 5px 9px;
            border-radius: 999px;
            background: rgba(105,130,255,.09);
            color: #9cadff;
            font-size: 10px;
            font-weight: 750;
            text-transform: capitalize;
        }

        .subscription-dates {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 17px;
        }

        .date-box {
            padding: 12px;
            border-radius: 11px;
            background: rgba(255,255,255,.025);
        }

        .date-label {
            color: #68778d;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .date-value {
            margin-top: 5px;
            color: #d7dfeb;
            font-size: 12px;
            font-weight: 650;
        }

        .amount-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            padding: 13px;
            border-radius: 11px;
            background: rgba(255,255,255,.025);
        }

        .amount-label {
            color: #718096;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .amount {
            color: #e7edf6;
            font-size: 14px;
            font-weight: 750;
        }

        .payments-panel {
            grid-column: 1 / -1;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
        }

        .payment-table th {
            padding: 10px 12px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            color: #68778d;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .07em;
            text-align: left;
            text-transform: uppercase;
        }

        .payment-table td {
            padding: 13px 12px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e2;
            font-size: 12px;
        }

        .payment-table tr:last-child td {
            border-bottom: 0;
        }

        .payment-status {
            display: inline-flex;
            padding: 5px 8px;
            border-radius: 999px;
            background: rgba(255,255,255,.05);
            color: #9aa8bb;
            font-size: 9px;
            font-weight: 750;
            text-transform: capitalize;
        }

        .payment-status.paid {
            background: rgba(85,216,138,.08);
            color: #72e49e;
        }

        .payment-status.failed,
        .payment-status.refunded {
            background: rgba(255,130,130,.08);
            color: #ff9b9b;
        }

        .empty {
            padding: 25px 10px;
            color: #6f7e94;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 1050px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .payments-panel {
                grid-column: auto;
            }
        }

        @media (max-width: 800px) {
            .stats-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }

            .hero-main {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 520px) {
            .hero-card,
            .panel {
                padding: 16px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .identity {
                align-items: flex-start;
            }

            .title {
                font-size: 22px;
            }

            .payment-table {
                min-width: 650px;
            }

            .payments-panel {
                overflow-x: auto;
            }
        }
    </style>

    <div class="details-page">

        <a href="{{ route('saas.libraries.index') }}" class="back-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6"></path>
            </svg>
            Back to Libraries
        </a>

        @php
            $initial = strtoupper(
                mb_substr($library->name ?: 'L', 0, 1)
            );
        @endphp

        <section class="hero-card">

            <div class="hero-main">

                <div class="identity">

                    <div class="logo">
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
                        <p class="eyebrow">Library Customer</p>

                        <h1 class="title">
                            {{ $library->name }}
                        </h1>

                        <p class="code">
                            {{ $library->code }}
                        </p>
                    </div>

                </div>

                <span class="status">
                    {{ $library->status ?: 'Unknown' }}
                </span>

            </div>

            <div class="stats-grid">

                <div class="stat">
                    <span class="stat-value">
                        {{ number_format($stats['total_students']) }}
                    </span>
                    <span class="stat-label">Students</span>
                </div>

                <div class="stat">
                    <span class="stat-value">
                        {{ number_format($stats['online_exam_students']) }}
                    </span>
                    <span class="stat-label">Exam Users</span>
                </div>

                <div class="stat">
                    <span class="stat-value">
                        {{ number_format($stats['total_exams']) }}
                    </span>
                    <span class="stat-label">Exams</span>
                </div>

                <div class="stat">
                    <span class="stat-value">
                        {{ number_format($stats['total_questions']) }}
                    </span>
                    <span class="stat-label">Questions</span>
                </div>

                <div class="stat">
                    <span class="stat-value">
                        {{ number_format($stats['total_attempts']) }}
                    </span>
                    <span class="stat-label">Attempts</span>
                </div>

            </div>

        </section>

        <div class="content-grid">

            <section class="panel">

                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Customer Information</h2>
                        <p class="panel-subtitle">Library and primary account details</p>
                    </div>
                </div>

                <div class="info-list">

                    <div class="info-row">
                        <span class="info-label">Owner Name</span>
                        <span class="info-value">
                            {{ $owner?->name ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Owner Email</span>
                        <span class="info-value">
                            {{ $owner?->email ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Phone</span>
                        <span class="info-value">
                            {{ $library->phone ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">WhatsApp</span>
                        <span class="info-value">
                            {{ $library->whatsapp ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Email</span>
                        <span class="info-value">
                            {{ $library->email ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Website</span>
                        <span class="info-value">
                            {{ $library->website ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Address</span>
                        <span class="info-value">
                            {{ $library->address ?: 'Not available' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">City / State</span>
                        <span class="info-value">
                            {{ $library->city ?: '—' }}
                            /
                            {{ $library->state ?: '—' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Country</span>
                        <span class="info-value">
                            {{ $library->country ?: '—' }}
                        </span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Customer Since</span>
                        <span class="info-value">
                            {{ $library->created_at?->format('d M Y') ?: '—' }}
                        </span>
                    </div>

                </div>

            </section>

            <section class="panel">

                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Subscription</h2>
                        <p class="panel-subtitle">Current SaaS plan</p>
                    </div>
                </div>

                @if($latestSubscription)

                    <div class="subscription-card">

                        <div class="plan">
                            {{ $latestSubscription->plan_name }}
                        </div>

                        <span class="plan-status">
                            {{ $latestSubscription->status }}
                        </span>

                        <div class="subscription-dates">

                            <div class="date-box">
                                <div class="date-label">Started</div>
                                <div class="date-value">
                                    {{ $latestSubscription->starts_at?->format('d M Y') ?: '—' }}
                                </div>
                            </div>

                            <div class="date-box">
                                <div class="date-label">Expires</div>
                                <div class="date-value">
                                    {{ $latestSubscription->ends_at?->format('d M Y') ?: '—' }}
                                </div>
                            </div>

                        </div>

                        <div class="amount-box">
                            <span class="amount-label">Plan Amount</span>
                            <span class="amount">
                                ₹{{ number_format((float) $latestSubscription->amount, 2) }}
                            </span>
                        </div>

                    </div>

                @else

                    <div class="empty">
                        No subscription record available.
                    </div>

                @endif

                <div class="amount-box" style="margin-top: 14px;">
                    <span class="amount-label">Total Paid</span>
                    <span class="amount">
                        ₹{{ number_format((float) $stats['total_paid'], 2) }}
                    </span>
                </div>

            </section>

            <section class="panel payments-panel">

                <div class="panel-header">
                    <div>
                        <h2 class="panel-title">Payment History</h2>
                        <p class="panel-subtitle">All SaaS payments recorded for this customer</p>
                    </div>
                </div>

                @if($library->saasPayments->isNotEmpty())

                    <table class="payment-table">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Transaction</th>
                                <th>Plan</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($library->saasPayments as $payment)

                                <tr>

                                    <td>
                                        {{ $payment->paid_at?->format('d M Y') ?: $payment->created_at?->format('d M Y') }}
                                    </td>

                                    <td>
                                        ₹{{ number_format((float) $payment->amount, 2) }}
                                    </td>

                                    <td>
                                        {{ $payment->payment_method ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $payment->transaction_id ?: '—' }}
                                    </td>

                                    <td>
                                        {{ $payment->subscription?->plan_name ?: '—' }}
                                    </td>

                                    <td>
                                        <span class="payment-status {{ strtolower((string) $payment->status) }}">
                                            {{ $payment->status }}
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                @else

                    <div class="empty">
                        No payment history available yet.
                    </div>

                @endif

            </section>

        </div>

    </div>

</x-layouts.saas>