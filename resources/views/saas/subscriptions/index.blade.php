<x-layouts.saas :title="__('Subscriptions')">

    <style>
        .subscriptions-page {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .create-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    min-height: 40px;
    padding: 0 15px;
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 11px;
    background: linear-gradient(135deg, #26354d, #182337);
    color: #eef4fb;
    font-size: 11px;
    font-weight: 750;
    text-decoration: none;
    box-shadow: 0 8px 22px rgba(0,0,0,.18);
    transition: .2s ease;
}

.create-button svg {
    width: 15px;
    height: 15px;
}

.create-button:hover {
    transform: translateY(-1px);
    background: linear-gradient(135deg, #30425f, #1d2a40);
    color: #fff;
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
            max-width: 700px;
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
            font-size: 22px;
            line-height: 1;
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
        }

        .search-box {
            min-width: 230px;
        }

        .search-box input,
        .status-select {
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

        .status-select {
            min-width: 140px;
            padding: 0 10px;
        }

        .filter-button {
            height: 37px;
            padding: 0 13px;
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

        .results-count {
            color: #69788e;
            font-size: 11px;
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

        .subscription-table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        .subscription-table th {
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

        .subscription-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .subscription-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .subscription-table tbody tr:hover {
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
            color: #dfe6f0;
            font-weight: 700;
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

        .view-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #aebbd0;
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .view-link:hover {
            color: #f0f4fa;
        }

        .view-link svg {
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

        .pagination-links span[aria-current="page"] {
            background: rgba(112,151,255,.12);
            border-color: rgba(112,151,255,.2);
            color: #b9c7ff;
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

            .search-box {
                min-width: 100%;
            }

            .filters {
                width: 100%;
            }

            .status-select {
                flex: 1;
            }

            .pagination {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 430px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="subscriptions-page">

        <div class="page-header">

    <div>
        <p class="eyebrow">Billing Management</p>

        <h1 class="page-title">
            Subscriptions
        </h1>

        <p class="page-description">
            Track customer plans, trial periods, expiry dates and subscription value from one central SaaS panel.
        </p>
    </div>

    <a
        href="{{ route('saas.subscriptions.create') }}"
        class="create-button"
    >
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
        >
            <path d="M12 5v14"></path>
            <path d="M5 12h14"></path>
        </svg>

        Create Subscription
    </a>

</div>

        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">Total</div>
                <div class="summary-value">
                    {{ number_format($summary['total']) }}
                </div>
                <div class="summary-meta">All subscription records</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Active</div>
                <div class="summary-value">
                    {{ number_format($summary['active']) }}
                </div>
                <div class="summary-meta">Paid / active customers</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Trial</div>
                <div class="summary-value">
                    {{ number_format($summary['trial']) }}
                </div>
                <div class="summary-meta">Customers in trial</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Expired</div>
                <div class="summary-value">
                    {{ number_format($summary['expired']) }}
                </div>
                <div class="summary-meta">Subscriptions ended</div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Plan Value</div>
                <div class="summary-value">
                    ₹{{ number_format((float) $summary['total_value'], 2) }}
                </div>
                <div class="summary-meta">Recorded subscription value</div>
            </div>

        </div>

        <form
            method="GET"
            action="{{ route('saas.subscriptions.index') }}"
            class="toolbar"
        >

            <div class="filters">

                <div class="search-box">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search library name or code..."
                    >
                </div>

                <select name="status" class="status-select">

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

                <button type="submit" class="filter-button">
                    Filter
                </button>

                @if($search !== '' || $currentStatus !== '')
                    <a
                        href="{{ route('saas.subscriptions.index') }}"
                        class="reset-link"
                    >
                        Reset
                    </a>
                @endif

            </div>

            <div class="results-count">
                {{ $subscriptions->total() }} subscription{{ $subscriptions->total() === 1 ? '' : 's' }}
            </div>

        </form>

        <section class="table-card">

            @if($subscriptions->count())

                <div class="table-wrap">

                    <table class="subscription-table">

                        <thead>
                            <tr>
                                <th>Library</th>
                                <th>Plan</th>
                                <th>Started</th>
                                <th>Expires</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($subscriptions as $subscription)

                                @php
                                    $library = $subscription->library;

                                    $initial = strtoupper(
                                        mb_substr(
                                            $library?->name ?: 'L',
                                            0,
                                            1
                                        )
                                    );

                                    $subscriptionStatus = strtolower(
                                        (string) $subscription->status
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
                                            {{ $subscription->plan_name }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="date-main">
                                            {{ $subscription->starts_at?->format('d M Y') ?: '—' }}
                                        </div>

                                        <div class="date-sub">
                                            Start date
                                        </div>

                                    </td>

                                    <td>

                                        <div class="date-main">
                                            {{ $subscription->ends_at?->format('d M Y') ?: '—' }}
                                        </div>

                                        <div class="date-sub">
                                            Expiry date
                                        </div>

                                    </td>

                                    <td>
                                        <span class="amount">
                                            ₹{{ number_format((float) $subscription->amount, 2) }}
                                        </span>
                                    </td>

                                    <td>

                                        <span class="status-badge {{ $subscriptionStatus }}">
                                            {{ $subscription->status }}
                                        </span>

                                    </td>

                                    <td>

                                       <td>

    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">

        <a
            href="{{ route('saas.subscriptions.edit', $subscription) }}"
            class="view-link"
        >
            Manage

            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <path d="M12 20h9"></path>
                <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
            </svg>
        </a>

        @if($library)

            <a
                href="{{ route('saas.libraries.show', $library) }}"
                class="view-link"
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

    </div>

</td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if($subscriptions->hasPages())

                    <div class="pagination">

                        <div class="pagination-info">
                            Showing
                            {{ $subscriptions->firstItem() }}
                            –
                            {{ $subscriptions->lastItem() }}
                            of
                            {{ $subscriptions->total() }}
                        </div>

                        <div class="pagination-links">
                            {{ $subscriptions->onEachSide(1)->links() }}
                        </div>

                    </div>

                @endif

            @else

                <div class="empty-state">

                    <h3 class="empty-title">
                        No subscriptions found
                    </h3>

                    <p class="empty-text">
                        Try changing your search or status filter.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>