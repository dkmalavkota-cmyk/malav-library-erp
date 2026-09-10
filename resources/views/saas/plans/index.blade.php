<x-layouts.saas>
    <style>
        .plans-page {
            min-height: 100vh;
            padding: 34px 38px 52px;
            background:
                radial-gradient(circle at 78% 4%, rgba(99,102,241,.09), transparent 360px),
                radial-gradient(circle at 12% 18%, rgba(59,130,246,.05), transparent 300px);
        }

        .plans-wrap {
            max-width: 1500px;
            margin: 0 auto;
        }

        .plans-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            margin-bottom: 26px;
        }

        .plans-eyebrow {
            color: #818cf8;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .16em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .plans-title {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(26px, 3vw, 36px);
            line-height: 1.05;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .plans-subtitle {
            margin: 10px 0 0;
            max-width: 720px;
            color: #718096;
            font-size: 13px;
            line-height: 1.65;
        }

        .plans-create {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            min-height: 44px;
            padding: 0 17px;
            border: 1px solid rgba(129,140,248,.32);
            border-radius: 12px;
            color: #eef2ff;
            background: linear-gradient(135deg, rgba(99,102,241,.22), rgba(79,70,229,.10));
            box-shadow: 0 12px 30px rgba(0,0,0,.16), inset 0 1px rgba(255,255,255,.05);
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
            transition: .18s ease;
            white-space: nowrap;
        }

        .plans-create:hover {
            transform: translateY(-1px);
            border-color: rgba(129,140,248,.52);
            background: linear-gradient(135deg, rgba(99,102,241,.30), rgba(79,70,229,.14));
        }

        .plans-summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        .plans-stat {
            position: relative;
            overflow: hidden;
            padding: 18px 19px;
            min-height: 94px;
            border: 1px solid rgba(148,163,184,.10);
            border-radius: 16px;
            background: linear-gradient(145deg, rgba(15,23,42,.72), rgba(8,12,20,.64));
            box-shadow: inset 0 1px rgba(255,255,255,.025);
        }

        .plans-stat::after {
            content: "";
            position: absolute;
            width: 90px;
            height: 90px;
            right: -38px;
            top: -38px;
            border-radius: 50%;
            background: rgba(99,102,241,.07);
        }

        .plans-stat-label {
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .plans-stat-value {
            margin-top: 8px;
            color: #f8fafc;
            font-size: 27px;
            line-height: 1;
            font-weight: 850;
            letter-spacing: -.03em;
        }

        .plans-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 16px;
        }

        .plan-card {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 21px;
            border: 1px solid rgba(148,163,184,.11);
            border-radius: 20px;
            background:
                radial-gradient(circle at 100% 0%, rgba(99,102,241,.07), transparent 250px),
                linear-gradient(145deg, rgba(15,23,42,.82), rgba(7,10,18,.88));
            box-shadow: 0 18px 50px rgba(0,0,0,.14), inset 0 1px rgba(255,255,255,.025);
            transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
        }

        .plan-card:hover {
            transform: translateY(-2px);
            border-color: rgba(129,140,248,.22);
            box-shadow: 0 22px 60px rgba(0,0,0,.20), inset 0 1px rgba(255,255,255,.03);
        }

        .plan-card.recommended {
            border-color: rgba(129,140,248,.30);
            box-shadow: 0 20px 65px rgba(79,70,229,.12), inset 0 1px rgba(255,255,255,.04);
        }

        .plan-card.premium {
            border-color: rgba(56,189,248,.20);
        }

        .plan-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .plan-identity {
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .plan-icon {
            width: 43px;
            height: 43px;
            flex: 0 0 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(129,140,248,.16);
            border-radius: 13px;
            color: #a5b4fc;
            background: rgba(99,102,241,.08);
        }

        .plan-card.premium .plan-icon {
            color: #7dd3fc;
            border-color: rgba(56,189,248,.16);
            background: rgba(56,189,248,.07);
        }

        .plan-name-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px;
        }

        .plan-name {
            color: #f8fafc;
            font-size: 18px;
            font-weight: 850;
            letter-spacing: -.02em;
        }

        .plan-description {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        .plan-badge,
        .plan-status {
            display: inline-flex;
            align-items: center;
            min-height: 25px;
            padding: 0 9px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .plan-badge.recommended {
            color: #c7d2fe;
            border: 1px solid rgba(129,140,248,.22);
            background: rgba(99,102,241,.10);
        }

        .plan-badge.full {
            color: #bae6fd;
            border: 1px solid rgba(56,189,248,.20);
            background: rgba(56,189,248,.08);
        }

        .plan-status.active {
            color: #bbf7d0;
            border: 1px solid rgba(74,222,128,.16);
            background: rgba(34,197,94,.07);
        }

        .plan-status.inactive {
            color: #cbd5e1;
            border: 1px solid rgba(148,163,184,.14);
            background: rgba(100,116,139,.08);
        }

        .plan-pricing {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 20px;
        }

        .price-box {
            padding: 14px 15px;
            border: 1px solid rgba(148,163,184,.09);
            border-radius: 14px;
            background: rgba(2,6,23,.42);
        }

        .price-label {
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .price-main {
            display: flex;
            align-items: baseline;
            gap: 5px;
            margin-top: 6px;
        }

        .price {
            color: #f8fafc;
            font-size: 24px;
            line-height: 1;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .price-unit {
            color: #64748b;
            font-size: 9px;
            font-weight: 700;
        }

        .price-mrp {
            margin-top: 6px;
            color: #475569;
            font-size: 9px;
        }

        .price-mrp s {
            color: #64748b;
        }

        .discount {
            margin-left: 5px;
            color: #86efac;
            font-weight: 800;
        }

        .plan-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .meta-box {
            padding: 12px 14px;
            border: 1px solid rgba(148,163,184,.08);
            border-radius: 13px;
            background: rgba(15,23,42,.38);
        }

        .meta-label {
            color: #475569;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .11em;
            text-transform: uppercase;
        }

        .meta-value {
            margin-top: 5px;
            color: #dbe4f0;
            font-size: 13px;
            font-weight: 800;
        }

        .features-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 19px;
            padding-bottom: 9px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }

        .features-title {
            color: #94a3b8;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        .features-count {
            color: #818cf8;
            font-size: 10px;
            font-weight: 900;
        }

        .features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 14px;
            padding-top: 11px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
        }

        .feature-item.enabled {
            color: #cbd5e1;
        }

        .feature-mark {
            width: 19px;
            height: 19px;
            flex: 0 0 19px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            border: 1px solid rgba(148,163,184,.08);
            color: #334155;
            background: rgba(15,23,42,.45);
            font-size: 9px;
            font-weight: 900;
        }

        .feature-item.enabled .feature-mark {
            color: #a5b4fc;
            border-color: rgba(129,140,248,.13);
            background: rgba(99,102,241,.07);
        }

        .plan-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 9px;
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid rgba(148,163,184,.08);
        }

        .plan-action {
            min-height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 12px;
            border-radius: 10px;
            border: 1px solid rgba(148,163,184,.10);
            color: #94a3b8;
            background: rgba(15,23,42,.35);
            font-size: 10px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: .18s ease;
        }

        .plan-action:hover {
            color: #eef2ff;
            border-color: rgba(129,140,248,.20);
            background: rgba(99,102,241,.07);
        }

        .plan-action.danger:hover {
            color: #fecaca;
            border-color: rgba(248,113,113,.18);
            background: rgba(239,68,68,.06);
        }

        .plans-empty {
            padding: 70px 24px;
            text-align: center;
            border: 1px dashed rgba(148,163,184,.14);
            border-radius: 20px;
            color: #64748b;
        }

        .plans-empty strong {
            display: block;
            margin-bottom: 7px;
            color: #cbd5e1;
            font-size: 15px;
        }

        @media (max-width: 1050px) {
            .plans-page { padding: 28px 22px 44px; }
            .plans-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 700px) {
            .plans-page { padding: 22px 15px 34px; }
            .plans-top { align-items: flex-start; flex-direction: column; }
            .plans-summary { grid-template-columns: 1fr 1fr; }
            .plans-pricing,
            .plan-pricing { grid-template-columns: 1fr; }
            .features-list { grid-template-columns: 1fr; }
        }

        @media (max-width: 430px) {
            .plans-summary { grid-template-columns: 1fr; }
            .plan-head { flex-direction: column; }
            .plan-status { align-self: flex-start; }
        }
    </style>

    @php
        $featureMap = [
            'exam_access' => 'Online Examination',
            'question_bank_access' => 'Question Bank',
            'current_affairs_access' => 'Current Affairs',
            'major_test_access' => 'Major Tests',
            'assigned_test_access' => 'Assigned Tests',
            'public_exam_access' => 'Public Exams',
            'advanced_reports_access' => 'Advanced Reports',
        ];

        $totalPlans = $plans->count();
        $activePlans = $plans->where('is_active', true)->count();
        $inactivePlans = $plans->where('is_active', false)->count();
        $totalSubscriptions = $plans->sum('subscriptions_count');
    @endphp

    <div class="plans-page">
        <div class="plans-wrap">

            <div class="plans-top">
                <div>
                    <div class="plans-eyebrow">Billing</div>
                    <h1 class="plans-title">Subscription Plans</h1>
                    <p class="plans-subtitle">
                        Manage pricing, student limits and feature access for every library subscription.
                    </p>
                </div>

                <a href="{{ route('saas.plans.create') }}" class="plans-create">
                    <span style="font-size:18px;line-height:1;">+</span>
                    Create Plan
                </a>
            </div>

            <div class="plans-summary">
                <div class="plans-stat">
                    <div class="plans-stat-label">Total Plans</div>
                    <div class="plans-stat-value">{{ $totalPlans }}</div>
                </div>

                <div class="plans-stat">
                    <div class="plans-stat-label">Active Plans</div>
                    <div class="plans-stat-value">{{ $activePlans }}</div>
                </div>

                <div class="plans-stat">
                    <div class="plans-stat-label">Inactive Plans</div>
                    <div class="plans-stat-value">{{ $inactivePlans }}</div>
                </div>

                <div class="plans-stat">
                    <div class="plans-stat-label">Subscriptions</div>
                    <div class="plans-stat-value">{{ $totalSubscriptions }}</div>
                </div>
            </div>

            @if(session('success'))
                <div style="margin-bottom:16px;padding:12px 14px;border:1px solid rgba(74,222,128,.16);border-radius:12px;background:rgba(34,197,94,.06);color:#bbf7d0;font-size:11px;font-weight:700;">
                    {{ session('success') }}
                </div>
            @endif

            @if($plans->isEmpty())
                <div class="plans-empty">
                    <strong>No subscription plans yet</strong>
                    Create your first plan to start configuring SaaS pricing.
                </div>
            @else
                <div class="plans-grid">

                    @foreach($plans as $plan)
                        @php
                            $enabledCount = collect($featureMap)
                                ->filter(fn ($label, $key) => (bool) $plan->{$key})
                                ->count();

                            $isRecommended = $plan->name === 'Professional';
                            $isPremium = $plan->name === 'Premium';

                            $monthlyMrp = (float) $plan->monthly_price * 2;
                            $yearlyMrp = (float) $plan->yearly_price * 2;
                        @endphp

                        <section class="plan-card {{ $isRecommended ? 'recommended' : '' }} {{ $isPremium ? 'premium' : '' }}">

                            <div class="plan-head">
                                <div class="plan-identity">
                                    <div class="plan-icon">
                                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            @if($isPremium)
                                                <path d="M12 3 14.7 8.3 20.5 9l-4.2 4.1 1 5.8L12 16.2 6.7 19l1-5.8L3.5 9l5.8-.7L12 3Z"/>
                                            @else
                                                <rect x="4" y="4" width="16" height="16" rx="3"/>
                                                <path d="M8 9h8"/>
                                                <path d="M8 13h5"/>
                                            @endif
                                        </svg>
                                    </div>

                                    <div style="min-width:0;">
                                        <div class="plan-name-row">
                                            <span class="plan-name">{{ $plan->name }}</span>

                                            @if($isRecommended)
                                                <span class="plan-badge recommended">Recommended</span>
                                            @elseif($isPremium)
                                                <span class="plan-badge full">Full Access</span>
                                            @endif
                                        </div>

                                        <div class="plan-description">
                                            {{ $plan->description ?: 'Configure pricing, limits and access for this subscription plan.' }}
                                        </div>
                                    </div>
                                </div>

                                <span class="plan-status {{ $plan->is_active ? 'active' : 'inactive' }}">
                                    {{ $plan->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>

                            <div class="plan-pricing">
                                <div class="price-box">
                                    <div class="price-label">Monthly</div>
                                    <div class="price-main">
                                        <span class="price">₹{{ number_format((float) $plan->monthly_price, 0) }}</span>
                                        <span class="price-unit">/month</span>
                                    </div>

                                    @if((float) $plan->monthly_price > 0)
                                        <div class="price-mrp">
                                            MRP <s>₹{{ number_format($monthlyMrp, 0) }}</s>
                                            <span class="discount">50% OFF</span>
                                        </div>
                                    @else
                                        <div class="price-mrp">No payment required</div>
                                    @endif
                                </div>

                                <div class="price-box">
                                    <div class="price-label">Yearly</div>
                                    <div class="price-main">
                                        <span class="price">₹{{ number_format((float) $plan->yearly_price, 0) }}</span>
                                        <span class="price-unit">/year</span>
                                    </div>

                                    @if((float) $plan->yearly_price > 0)
                                        <div class="price-mrp">
                                            MRP <s>₹{{ number_format($yearlyMrp, 0) }}</s>
                                            <span class="discount">50% OFF</span>
                                        </div>
                                    @else
                                        <div class="price-mrp">Free trial</div>
                                    @endif
                                </div>
                            </div>

                            <div class="plan-meta">
                                <div class="meta-box">
                                    <div class="meta-label">Student Limit</div>
                                    <div class="meta-value">
                                        {{ $plan->student_limit ? number_format($plan->student_limit) : 'Unlimited' }}
                                    </div>
                                </div>

                                <div class="meta-box">
                                    <div class="meta-label">Subscriptions</div>
                                    <div class="meta-value">
                                        {{ number_format($plan->subscriptions_count) }}
                                    </div>
                                </div>
                            </div>

                            <div class="features-head">
                                <span class="features-title">Included Features</span>
                                <span class="features-count">{{ $enabledCount }}/{{ count($featureMap) }}</span>
                            </div>

                            <div class="features-list">
                                @foreach($featureMap as $key => $label)
                                    <div class="feature-item {{ $plan->{$key} ? 'enabled' : '' }}">
                                        <span class="feature-mark">
                                            {{ $plan->{$key} ? '✓' : '×' }}
                                        </span>
                                        <span>{{ $label }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="plan-actions">
                                <a href="{{ route('saas.plans.edit', $plan) }}" class="plan-action">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                        <path d="M12 20h9"/>
                                        <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"/>
                                    </svg>
                                    Edit Plan
                                </a>

                                <form method="POST" action="{{ route('saas.plans.toggle', $plan) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="plan-action {{ $plan->is_active ? 'danger' : '' }}" style="width:100%;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                            @if($plan->is_active)
                                                <rect x="5" y="5" width="14" height="14" rx="2"/>
                                            @else
                                                <path d="m5 12 4 4L19 6"/>
                                            @endif
                                        </svg>
                                        {{ $plan->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                            </div>

                        </section>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</x-layouts.saas>
