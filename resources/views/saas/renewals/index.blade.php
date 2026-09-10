<x-layouts.saas :title="__('Renewals')">

    <style>
        .renewals-page {
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
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .summary-card {
            padding: 17px;
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
            margin-top: 8px;
            color: #edf2f8;
            font-size: 23px;
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
            width: 100%;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
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
            min-width: 145px;
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

        .renewal-table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        .renewal-table th {
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

        .renewal-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .renewal-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .renewal-table tbody tr:hover {
            background: rgba(255,255,255,.018);
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 190px;
        }

        .library-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
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

        .plan {
            color: #dce4ef;
            font-size: 11px;
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

        .days {
            display: inline-flex;
            align-items: center;
            padding: 6px 9px;
            border-radius: 999px;
            background: rgba(255,255,255,.035);
            border: 1px solid rgba(255,255,255,.065);
            color: #aab7c9;
            font-size: 9px;
            font-weight: 750;
            white-space: nowrap;
        }

        .days.expiring {
            background: rgba(255,190,90,.08);
            border-color: rgba(255,190,90,.15);
            color: #ffc477;
        }

        .days.expired {
            background: rgba(255,130,130,.08);
            border-color: rgba(255,130,130,.14);
            color: #ff9b9b;
        }

        .days.active {
            background: rgba(85,216,138,.08);
            border-color: rgba(85,216,138,.15);
            color: #72e49e;
        }

        .renew-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    min-height: 32px;
    padding: 0 10px;
    border: 1px solid rgba(255,255,255,.09);
    border-radius: 9px;
    background: rgba(255,255,255,.055);
    color: #dce5f2;
    font-size: 10px;
    font-weight: 750;
    cursor: pointer;
    transition: .2s ease;
}

.renew-button:hover {
    background: rgba(255,255,255,.09);
    color: #fff;
    transform: translateY(-1px);
}

.renew-button svg {
    width: 13px;
    height: 13px;
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

        @media (max-width: 1000px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }
        }

        @media (max-width: 700px) {
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

    @php
        $today = now()->startOfDay();
    @endphp

    <div class="renewals-page">

        <div class="page-header">

            <div>
                <p class="eyebrow">Billing Management</p>

                <h1 class="page-title">
                    Renewals
                </h1>

                <p class="page-description">
                    Monitor active subscriptions, upcoming expiries and expired customer plans from one central view.
                </p>
            </div>

        </div>

        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">All Subscriptions</div>
                <div class="summary-value">
                    {{ number_format($summary['total']) }}
                </div>
                <div class="summary-meta">
                    Complete subscription history
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Active</div>
                <div class="summary-value">
                    {{ number_format($summary['active']) }}
                </div>
                <div class="summary-meta">
                    Trial + active plans
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Expiring Soon</div>
                <div class="summary-value">
                    {{ number_format($summary['expiring']) }}
                </div>
                <div class="summary-meta">
                    Next 30 days
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Expired</div>
                <div class="summary-value">
                    {{ number_format($summary['expired']) }}
                </div>
                <div class="summary-meta">
                    Renewal attention required
                </div>
            </div>

        </div>

        <form
            method="GET"
            action="{{ route('saas.renewals.index') }}"
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

                <select name="filter" class="filter-select">

                    <option value="">All subscriptions</option>

                    @foreach($filters as $item)

                        <option
                            value="{{ $item }}"
                            @selected($currentFilter === $item)
                        >
                            {{ ucfirst($item) }}
                        </option>

                    @endforeach

                </select>

                <button type="submit" class="filter-button">
                    Filter
                </button>

                @if($search !== '' || $currentFilter !== '')

                    <a
                        href="{{ route('saas.renewals.index') }}"
                        class="reset-link"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

        <section class="table-card">

            @if($subscriptions->count())

                <div class="table-wrap">

                    <table class="renewal-table">

                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Plan</th>
                                <th>Start Date</th>
                                <th>Expiry</th>
                                <th>Renewal Status</th>
                                <th>Amount</th>
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

                                    $endsAt = $subscription->ends_at;
                                    $daysRemaining = $endsAt
                                        ? $today->diffInDays($endsAt, false)
                                        : null;

                                    if (
                                        $subscription->status === 'cancelled'
                                    ) {
                                        $renewalLabel = 'Cancelled';
                                        $renewalClass = 'expired';
                                    } elseif (
                                        $daysRemaining !== null &&
                                        $daysRemaining < 0
                                    ) {
                                        $renewalLabel = 'Expired';
                                        $renewalClass = 'expired';
                                    } elseif (
                                        $daysRemaining !== null &&
                                        $daysRemaining <= 30
                                    ) {
                                        $renewalLabel = $daysRemaining === 0
                                            ? 'Expires today'
                                            : $daysRemaining . ' days left';

                                        $renewalClass = 'expiring';
                                    } else {
                                        $renewalLabel = 'Active';
                                        $renewalClass = 'active';
                                    }
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
                                        <span class="plan">
                                            {{ $subscription->plan_name }}
                                        </span>
                                    </td>

                                    <td>

                                        <div class="date-main">
                                            {{ $subscription->starts_at?->format('d M Y') ?: '—' }}
                                        </div>

                                        <div class="date-sub">
                                            Subscription start
                                        </div>

                                    </td>

                                    <td>

                                        <div class="date-main">
                                            {{ $endsAt?->format('d M Y') ?: '—' }}
                                        </div>

                                        <div class="date-sub">
                                            Expiry date
                                        </div>

                                    </td>

                                    <td>

                                        <span class="days {{ $renewalClass }}">
                                            {{ $renewalLabel }}
                                        </span>

                                    </td>

                                    <td>
                                        <span class="amount">
                                            ₹{{ number_format((float) $subscription->amount, 2) }}
                                        </span>
                                    </td>

                                    <td>

    <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">

        @if(in_array($subscription->status, ['trial', 'active'], true) && $endsAt && $endsAt->gte(now()->startOfDay()))

            <form
                method="POST"
                action="{{ route('saas.renewals.renew', $subscription) }}"
                onsubmit="return confirm('Renew this subscription? The renewal will be added after the current expiry date.');"
                style="margin:0;"
            >
                @csrf

                <button
                    type="submit"
                    class="renew-button"
                >
                    Renew

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M20 11a8.1 8.1 0 0 0-14.9-4"></path>
                        <path d="M4 4v5h5"></path>
                        <path d="M4 13a8.1 8.1 0 0 0 14.9 4"></path>
                        <path d="M20 20v-5h-5"></path>
                    </svg>
                </button>
            </form>

        @elseif($subscription->status === 'expired' || ($endsAt && $endsAt->lt(now()->startOfDay())))

            <form
                method="POST"
                action="{{ route('saas.renewals.renew', $subscription) }}"
                onsubmit="return confirm('Renew this expired subscription from today?');"
                style="margin:0;"
            >
                @csrf

                <button
                    type="submit"
                    class="renew-button"
                >
                    Renew

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M20 11a8 8 0 0 0-14.9-4"></path>
                        <path d="M4 4v5h5"></path>
                        <path d="M4 13a8 8 0 0 0 14.9 4"></path>
                        <path d="M20 20v-5h-5"></path>
                    </svg>
                </button>
            </form>

        @endif

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
                        Try changing the search or renewal filter.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>