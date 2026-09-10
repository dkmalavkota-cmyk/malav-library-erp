<x-layouts.saas :title="__('Payments')">

    <style>
        .payments-page {
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

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
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
            line-height: 1.1;
            font-weight: 760;
        }

        .summary-meta {
            margin-top: 7px;
            color: #69788e;
            font-size: 10px;
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            padding: 14px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background: rgba(9,15,27,.65);
        }

        .filters {
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            width: 100%;
        }

        .search-box {
            min-width: 250px;
            flex: 1;
        }

        .search-box input,
        .filter-select {
            height: 37px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            outline: none;
            background: rgba(255,255,255,.035);
            color: #dce4ef;
            font-size: 12px;
        }

        .search-box input {
            width: 100%;
            padding: 0 12px;
        }

        .search-box input::placeholder {
            color: #66758a;
        }

        .filter-select {
            min-width: 135px;
            padding: 0 10px;
        }

        .filter-button {
            height: 37px;
            padding: 0 14px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            background: rgba(255,255,255,.055);
            color: #dce4ef;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .filter-button:hover {
            background: rgba(255,255,255,.08);
        }

        .reset-link {
            color: #718096;
            font-size: 11px;
            font-weight: 650;
            text-decoration: none;
        }

        .reset-link:hover {
            color: #cbd5e1;
        }

        .table-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 17px;
            background: rgba(9,15,27,.72);
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .payment-table {
            width: 100%;
            min-width: 980px;
            border-collapse: collapse;
        }

        .payment-table th {
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

        .payment-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .payment-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .payment-table tbody tr:hover {
            background: rgba(255,255,255,.018);
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 190px;
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
            color: #d6dfeb;
            font-size: 11px;
            font-weight: 650;
        }

        .date-main {
            color: #cfd8e5;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
        }

        .date-sub {
            margin-top: 3px;
            color: #66758a;
            font-size: 9px;
        }

        .amount {
            color: #e4ebf4;
            font-weight: 750;
            white-space: nowrap;
        }

        .method {
            color: #aebbd0;
            font-size: 11px;
            font-weight: 650;
            text-transform: capitalize;
        }

        .transaction {
            max-width: 155px;
            color: #78869a;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-size: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
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

        .status-badge.paid {
            border-color: rgba(85,216,138,.16);
            background: rgba(85,216,138,.08);
            color: #72e49e;
        }

        .status-badge.pending {
            border-color: rgba(255,190,90,.15);
            background: rgba(255,190,90,.07);
            color: #ffc477;
        }

        .status-badge.failed,
        .status-badge.refunded {
            border-color: rgba(255,130,130,.14);
            background: rgba(255,130,130,.07);
            color: #ff9b9b;
        }

        .customer-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #aebbd0;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .customer-link:hover {
            color: #f0f4fa;
        }

        .customer-link svg {
            width: 13px;
            height: 13px;
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px 16px;
            border-top: 1px solid rgba(255,255,255,.05);
        }

        .pagination-info {
            color: #66758a;
            font-size: 10px;
        }

        .pagination-links {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-links nav {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-links a,
        .pagination-links span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 30px;
            height: 30px;
            padding: 0 8px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 8px;
            background: rgba(255,255,255,.025);
            color: #8b99ad;
            font-size: 10px;
            text-decoration: none;
        }

        .pagination-links a:hover {
            background: rgba(255,255,255,.06);
            color: #e2e8f1;
        }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
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

        @media (max-width: 1100px) {
            .summary-grid {
                grid-template-columns: repeat(3, minmax(0,1fr));
            }
        }

        @media (max-width: 700px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }

            .page-title {
                font-size: 25px;
            }

            .filters {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box,
            .filter-select,
            .filter-button {
                width: 100%;
                min-width: 0;
            }
        }

        @media (max-width: 430px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="payments-page">

        <div class="page-header">

            <div>
                <p class="eyebrow">Billing Management</p>

                <h1 class="page-title">
                    Payments
                </h1>

                <p class="page-description">
                    Track SaaS revenue, payment status, transaction references and customer billing activity.
                </p>
            </div>

            <div>
    <a
        href="{{ route('saas.payments.create') }}"
        class="filter-button"
        style="display:inline-flex;align-items:center;justify-content:center;text-decoration:none;min-width:145px;"
    >
        + Record Payment
    </a>
</div>

        </div>

        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">Total Payments</div>
                <div class="summary-value">
                    {{ number_format($summary['total']) }}
                </div>
                <div class="summary-meta">All recorded transactions</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Paid</div>
                <div class="summary-value">
                    {{ number_format($summary['paid']) }}
                </div>
                <div class="summary-meta">Successful payments</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Pending</div>
                <div class="summary-value">
                    {{ number_format($summary['pending']) }}
                </div>
                <div class="summary-meta">
                    ₹{{ number_format((float) $summary['pending_amount'], 2) }} pending
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Failed / Refunded</div>
                <div class="summary-value">
                    {{ number_format($summary['failed'] + $summary['refunded']) }}
                </div>
                <div class="summary-meta">
                    {{ $summary['failed'] }} failed · {{ $summary['refunded'] }} refunded
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Revenue</div>
                <div class="summary-value">
                    ₹{{ number_format((float) $summary['revenue'], 2) }}
                </div>
                <div class="summary-meta">Successfully collected</div>
            </div>

        </div>

        <form
            method="GET"
            action="{{ route('saas.payments.index') }}"
            class="toolbar"
        >

            <div class="filters">

                <div class="search-box">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search library, code or transaction..."
                    >
                </div>

                <select name="status" class="filter-select">

                    <option value="">All statuses</option>

                    @foreach($statuses as $status)

                        <option
                            value="{{ $status }}"
                            @selected($currentStatus === $status)
                        >
                            {{ ucfirst($status) }}
                        </option>

                    @endforeach

                </select>

                <select name="method" class="filter-select">

                    <option value="">All methods</option>

                    @foreach($methods as $method)

                        <option
                            value="{{ $method }}"
                            @selected($currentMethod === $method)
                        >
                            {{ ucwords(str_replace('_', ' ', $method)) }}
                        </option>

                    @endforeach

                </select>

                <button type="submit" class="filter-button">
                    Filter
                </button>

                @if($search !== '' || $currentStatus !== '' || $currentMethod !== '')

                    <a
                        href="{{ route('saas.payments.index') }}"
                        class="reset-link"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

        <section class="table-card">

            @if($payments->count())

                <div class="table-wrap">

                    <table class="payment-table">

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Plan</th>
                                <th>Amount</th>
                                <th>Payment Date</th>
                                <th>Method</th>
                                <th>Transaction</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($payments as $payment)

                                @php
                                    $library = $payment->library;

                                    $initial = strtoupper(
                                        mb_substr(
                                            $library?->name ?: 'L',
                                            0,
                                            1
                                        )
                                    );

                                    $paymentStatus = strtolower(
                                        (string) $payment->status
                                    );
                                @endphp

                                <tr>

                                    <td>

                                        <div class="library-cell">

                                            <div class="library-avatar">
                                                {{ $initial }}
                                            </div>

                                            <div>
                                                <div class="library-name">
                                                    {{ $library?->name ?: 'Unknown Library' }}
                                                </div>

                                                <div class="library-code">
                                                    {{ $library?->code ?: '—' }}
                                                </div>
                                            </div>

                                        </div>

                                    </td>

                                    <td>
                                        <span class="plan-name">
                                            {{ $payment->subscription?->plan_name ?: '—' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="amount">
                                            {{ $payment->currency ?: 'INR' }}
                                            {{ number_format((float) $payment->amount, 2) }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="date-main">
                                            {{ $payment->paid_at?->format('d M Y') ?: '—' }}
                                        </div>

                                        <div class="date-sub">
                                            @if($payment->paid_at)
                                                Paid date
                                            @else
                                                Created {{ $payment->created_at?->format('d M Y') }}
                                            @endif
                                        </div>

                                    </td>

                                    <td>

                                        <span class="method">
                                            {{ $payment->payment_method
                                                ? ucwords(str_replace('_', ' ', $payment->payment_method))
                                                : '—'
                                            }}
                                        </span>

                                    </td>

                                    <td>

                                        <span class="transaction">
                                            {{ $payment->transaction_id ?: 'No transaction ID' }}
                                        </span>

                                    </td>

                                    <td>

                                        <span class="status-badge {{ $paymentStatus }}">
                                            {{ $payment->status }}
                                        </span>

                                    </td>

                                    <td>

                                        @if($library)

                                            <a
                                                href="{{ route('saas.libraries.show', $library) }}"
                                                class="customer-link"
                                            >
                                                Customer

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

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if($payments->hasPages())

                    <div class="pagination">

                        <div class="pagination-info">
                            Showing
                            {{ $payments->firstItem() }}
                            –
                            {{ $payments->lastItem() }}
                            of
                            {{ $payments->total() }}
                        </div>

                        <div class="pagination-links">
                            {{ $payments->onEachSide(1)->links() }}
                        </div>

                    </div>

                @endif

            @else

                <div class="empty-state">

                    <h3 class="empty-title">
                        No payments found
                    </h3>

                    <p class="empty-text">
                        Payment records will appear here when customers make SaaS payments.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>