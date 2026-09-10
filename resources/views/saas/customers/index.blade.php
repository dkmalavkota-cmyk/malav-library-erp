<x-layouts.saas :title="__('Customers')">

    <style>
        .customers-page {
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
            max-width: 700px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
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
            flex: 1;
        }

        .search-box {
            min-width: 280px;
            flex: 1;
        }

        .search-box input {
            width: 100%;
            height: 37px;
            padding: 0 12px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            outline: none;
            background: rgba(255,255,255,.035);
            color: #dce4ef;
            font-size: 12px;
        }

        .search-box input::placeholder {
            color: #66758a;
        }

        .search-box input:focus {
            border-color: rgba(112,151,255,.28);
            background: rgba(255,255,255,.045);
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
            white-space: nowrap;
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

        .customer-table {
            width: 100%;
            min-width: 1000px;
            border-collapse: collapse;
        }

        .customer-table th {
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

        .customer-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,.045);
            color: #cbd5e1;
            font-size: 12px;
            vertical-align: middle;
        }

        .customer-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .customer-table tbody tr:hover {
            background: rgba(255,255,255,.018);
        }

        .library-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 210px;
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

        .owner-name {
            color: #dce4ee;
            font-size: 11px;
            font-weight: 700;
        }

        .owner-email,
        .contact-line {
            margin-top: 3px;
            color: #69788e;
            font-size: 9px;
        }

        .contact-email {
            color: #aab7ca;
            font-size: 10px;
            font-weight: 600;
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

        .status-badge.inactive {
            border-color: rgba(255,255,255,.07);
            background: rgba(255,255,255,.025);
            color: #7c899d;
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

        @media (max-width: 1100px) {
            .summary-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
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

    <div class="customers-page">

        {{-- Header --}}
        <div class="page-header">
            <div>
                <p class="eyebrow">Customer Management</p>

                <h1 class="page-title">
                    Customers
                </h1>

                <p class="page-description">
                    Manage customer libraries, owners, subscription status and account information from one central SaaS panel.
                </p>
            </div>
        </div>

        {{-- Summary --}}
        <div class="summary-grid">

            <div class="summary-card">
                <div class="summary-label">Customers</div>

                <div class="summary-value">
                    {{ number_format($customers->total()) }}
                </div>

                <div class="summary-meta">
                    Registered library accounts
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Showing</div>

                <div class="summary-value">
                    {{ number_format($customers->count()) }}
                </div>

                <div class="summary-meta">
                    Customers on this page
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Search</div>

                <div class="summary-value">
                    {{ $search !== '' ? 'Active' : 'All' }}
                </div>

                <div class="summary-meta">
                    {{ $search !== '' ? 'Filtered customer results' : 'All customers visible' }}
                </div>
            </div>

            <div class="summary-card">
                <div class="summary-label">Management</div>

                <div class="summary-value">
                    SaaS
                </div>

                <div class="summary-meta">
                    Central customer control
                </div>
            </div>

        </div>

        {{-- Toolbar --}}
        <form
            method="GET"
            action="{{ url('/saas/customers') }}"
            class="toolbar"
        >

            <div class="filters">

                <div class="search-box">
                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Search library name, code, email or phone..."
                    >
                </div>

                <button
                    type="submit"
                    class="filter-button"
                >
                    Search
                </button>

                @if($search !== '')
                    <a
                        href="{{ url('/saas/customers') }}"
                        class="reset-link"
                    >
                        Reset
                    </a>
                @endif

            </div>

            <div class="results-count">
                {{ $customers->total() }}
                customer{{ $customers->total() === 1 ? '' : 's' }}
            </div>

        </form>

        {{-- Customer Table --}}
        <section class="table-card">

            @if($customers->count())

                <div class="table-wrap">

                    <table class="customer-table">

                        <thead>
                            <tr>
                                <th>Library</th>
                                <th>Owner</th>
                                <th>Contact</th>
                                <th>Library Status</th>
                                <th>Subscription</th>
                                <th>Expires</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($customers as $customer)

                                @php
                                    $owner = $customer->users->first();
                                    $subscription = $customer->subscriptions->first();

                                    $initial = strtoupper(
                                        mb_substr(
                                            $customer->name ?: 'L',
                                            0,
                                            1
                                        )
                                    );

                                    $libraryStatus = strtolower(
                                        (string) $customer->status
                                    );

                                    $subscriptionStatus = strtolower(
                                        (string) ($subscription?->status ?? '')
                                    );
                                @endphp

                                <tr>

                                    {{-- Library --}}
                                    <td>

                                        <div class="library-cell">

                                            <div class="library-avatar">
                                                {{ $initial }}
                                            </div>

                                            <div>
                                                <div class="library-name">
                                                    {{ $customer->name ?: 'Unnamed Library' }}
                                                </div>

                                                <div class="library-code">
                                                    {{ $customer->code ?: '—' }}
                                                </div>
                                            </div>

                                        </div>

                                    </td>

                                    {{-- Owner --}}
                                    <td>

                                        @if($owner)

                                            <div class="owner-name">
                                                {{ $owner->name ?: '—' }}
                                            </div>

                                            <div class="owner-email">
                                                {{ $owner->email ?: 'No email' }}
                                            </div>

                                        @else

                                            <span class="owner-email">
                                                No owner found
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Contact --}}
                                    <td>

                                        @if($customer->email)

                                            <div class="contact-email">
                                                {{ $customer->email }}
                                            </div>

                                        @endif

                                        @if($customer->phone)

                                            <div class="contact-line">
                                                {{ $customer->phone }}
                                            </div>

                                        @endif

                                        @if(!$customer->email && !$customer->phone)

                                            <span class="contact-line">
                                                No contact details
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Library Status --}}
                                    <td>

                                        <span class="status-badge {{ $libraryStatus }}">
                                            {{ $customer->status ?: 'unknown' }}
                                        </span>

                                    </td>

                                    {{-- Subscription --}}
                                    <td>

                                        @if($subscription)

                                            <div class="owner-name">
                                                {{ $subscription->plan_name }}
                                            </div>

                                            <div style="margin-top: 5px;">
                                                <span class="status-badge {{ $subscriptionStatus }}">
                                                    {{ $subscription->status }}
                                                </span>
                                            </div>

                                        @else

                                            <span class="contact-line">
                                                No subscription
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Expiry --}}
                                    <td>

                                        @if($subscription && $subscription->ends_at)

                                            <div class="date-main">
                                                {{ $subscription->ends_at->format('d M Y') }}
                                            </div>

                                            <div class="date-sub">
                                                @if($subscription->ends_at->isPast())
                                                    Expired
                                                @else
                                                    {{ $subscription->ends_at->diffForHumans() }}
                                                @endif
                                            </div>

                                        @else

                                            <span class="date-sub">
                                                —
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Action --}}
                                    <td>

                                        <a
                                            href="{{ route('saas.libraries.show', $customer) }}"
                                            class="view-link"
                                        >
                                            View Customer

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

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($customers->hasPages())

                    <div class="pagination">

                        <div class="pagination-info">
                            Showing
                            {{ $customers->firstItem() }}
                            –
                            {{ $customers->lastItem() }}
                            of
                            {{ $customers->total() }}
                        </div>

                        <div class="pagination-links">
                            {{ $customers->onEachSide(1)->links() }}
                        </div>

                    </div>

                @endif

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
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l7-4 7 4v14"></path>
                            <path d="M9 21v-6h6v6"></path>
                            <path d="M9 10h.01"></path>
                            <path d="M12 10h.01"></path>
                            <path d="M15 10h.01"></path>
                        </svg>
                    </div>

                    <h3 class="empty-title">
                        No customers found
                    </h3>

                    <p class="empty-text">
                        Try changing your search or check again later.
                    </p>

                </div>

            @endif

        </section>

    </div>

</x-layouts.saas>