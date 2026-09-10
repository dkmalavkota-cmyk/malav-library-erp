<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pricing | Malav Library ERP</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: #e8edf5;
            background:
                radial-gradient(circle at 12% 8%, rgba(124,58,237,.14), transparent 28%),
                radial-gradient(circle at 88% 18%, rgba(37,99,235,.11), transparent 28%),
                #070a11;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            font: inherit;
        }

        .shell {
            width: min(1240px, calc(100% - 40px));
            margin: 0 auto;
        }

        /* -----------------------------
           TOPBAR
        ------------------------------ */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-mark {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: linear-gradient(135deg, #7c3aed, #2563eb);
            color: #fff;
            font-size: 12px;
            font-weight: 900;
            box-shadow: 0 12px 30px rgba(124,58,237,.25);
        }

        .brand-text strong {
            display: block;
            font-size: 14px;
            letter-spacing: -.01em;
        }

        .brand-text span {
            display: block;
            margin-top: 2px;
            color: #7d8aa0;
            font-size: 10px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .top-link {
            padding: 9px 13px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            color: #aeb9ca;
            background: rgba(255,255,255,.025);
            font-size: 12px;
            font-weight: 750;
            transition: .2s ease;
        }

        .top-link:hover {
            color: #fff;
            background: rgba(255,255,255,.06);
            border-color: rgba(255,255,255,.13);
        }

        /* -----------------------------
           HERO
        ------------------------------ */

        .hero {
            padding: 68px 0 38px;
            text-align: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border: 1px solid rgba(139,92,246,.24);
            border-radius: 999px;
            background: rgba(139,92,246,.08);
            color: #c4b5fd;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #a78bfa;
        }

        .hero h1 {
            max-width: 850px;
            margin: 19px auto 0;
            font-size: clamp(38px, 5.5vw, 62px);
            line-height: 1;
            letter-spacing: -.055em;
            font-weight: 850;
        }

        .hero h1 span {
            background: linear-gradient(90deg, #c4b5fd, #93c5fd);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero p {
            max-width: 690px;
            margin: 20px auto 0;
            color: #8794a9;
            font-size: 14px;
            line-height: 1.75;
        }

        .billing-switch {
            display: inline-flex;
            margin-top: 25px;
            padding: 4px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 13px;
            background: rgba(255,255,255,.035);
        }

        .billing-button {
            min-width: 105px;
            padding: 10px 14px;
            border: 0;
            border-radius: 9px;
            color: #8491a5;
            background: transparent;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s ease;
        }

        .billing-button.active {
            color: #fff;
            background: rgba(124,58,237,.72);
            box-shadow: 0 7px 20px rgba(124,58,237,.16);
        }

        /* -----------------------------
           PRICING GRID
        ------------------------------ */

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            align-items: stretch;
            padding: 18px 0 55px;
        }

        .plan-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            padding: 24px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 22px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.055),
                    rgba(255,255,255,.018)
                );
            box-shadow: 0 20px 55px rgba(0,0,0,.18);
        }

        .plan-card.featured {
            border-color: rgba(139,92,246,.42);
            background:
                linear-gradient(
                    145deg,
                    rgba(124,58,237,.13),
                    rgba(255,255,255,.025)
                );
            transform: translateY(-7px);
            box-shadow:
                0 25px 70px rgba(0,0,0,.24),
                0 0 0 1px rgba(139,92,246,.06);
        }

        .popular {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 6px 9px;
            border-radius: 999px;
            background: rgba(124,58,237,.18);
            color: #c4b5fd;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .plan-name {
            margin: 0;
            padding-right: 75px;
            font-size: 18px;
            font-weight: 850;
            letter-spacing: -.02em;
        }

        .plan-description {
            min-height: 42px;
            margin: 9px 0 0;
            color: #7f8da3;
            font-size: 11px;
            line-height: 1.55;
        }

        .price {
            margin-top: 22px;
        }

        .price-row {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .price-amount {
            font-size: 37px;
            line-height: 1;
            font-weight: 850;
            letter-spacing: -.045em;
        }

        .price-period {
            color: #7d8ba0;
            font-size: 11px;
        }

        .yearly-price,
        .yearly-saving {
            display: none;
        }

        .yearly-price.active,
        .yearly-saving.active {
            display: block;
        }

        .price-note {
            min-height: 18px;
            margin-top: 8px;
            color: #718097;
            font-size: 10px;
        }

        .price-note strong {
            color: #a78bfa;
        }

        .student-limit {
            margin-top: 18px;
            padding: 10px 11px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 11px;
            color: #b8c3d2;
            background: rgba(255,255,255,.025);
            font-size: 11px;
            font-weight: 700;
        }

        /* -----------------------------
           FEATURE GROUPS
        ------------------------------ */

        .feature-area {
            margin-top: 18px;
        }

        .feature-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            margin-bottom: 9px;
        }

        .feature-heading span:first-child {
            color: #d9e0eb;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .055em;
            text-transform: uppercase;
        }

        .feature-heading span:last-child {
            color: #66748a;
            font-size: 9px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .features li {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #9aa7ba;
            font-size: 10.5px;
            line-height: 1.4;
        }

        .check {
            flex: 0 0 auto;
            width: 16px;
            height: 16px;
            display: grid;
            place-items: center;
            margin-top: -1px;
            border-radius: 50%;
            color: #c4b5fd;
            background: rgba(124,58,237,.12);
            font-size: 9px;
            font-weight: 900;
        }

        .check.off {
            color: #4d596b;
            background: rgba(255,255,255,.035);
        }

        .feature-divider {
            height: 1px;
            margin: 16px 0 14px;
            background: rgba(255,255,255,.06);
        }

        /* -----------------------------
           CTA
        ------------------------------ */

        .plan-cta {
            width: 100%;
            margin-top: auto;
            padding-top: 22px;
        }

        .cta {
            width: 100%;
            min-height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 800;
            transition: .2s ease;
        }

        .cta.primary {
            color: #fff;
            background: linear-gradient(135deg, #7c3aed, #5b21b6);
            box-shadow: 0 12px 25px rgba(124,58,237,.18);
        }

        .cta.primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(124,58,237,.25);
        }

        .cta.secondary {
            border: 1px solid rgba(255,255,255,.09);
            color: #d1d9e5;
            background: rgba(255,255,255,.035);
        }

        .cta.secondary:hover {
            background: rgba(255,255,255,.07);
        }

        /* -----------------------------
           LOWER INFORMATION
        ------------------------------ */

        .included {
            margin: 15px 0 65px;
            padding: 28px;
            border: 1px solid rgba(255,255,255,.07);
            border-radius: 20px;
            background: rgba(255,255,255,.022);
        }

        .included-top {
            text-align: center;
        }

        .included-top h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -.03em;
        }

        .included-top p {
            max-width: 650px;
            margin: 9px auto 0;
            color: #758298;
            font-size: 11px;
            line-height: 1.65;
        }

        .included-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
            margin-top: 22px;
        }

        .included-item {
            padding: 14px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 13px;
            background: rgba(255,255,255,.018);
        }

        .included-item strong {
            display: block;
            color: #d8e0eb;
            font-size: 11px;
        }

        .included-item span {
            display: block;
            margin-top: 4px;
            color: #6f7c91;
            font-size: 10px;
            line-height: 1.5;
        }

        .trust {
            padding: 0 0 55px;
            text-align: center;
        }

        .trust p {
            margin: 0;
            color: #657389;
            font-size: 11px;
        }

        .footer {
            padding: 25px 0 35px;
            border-top: 1px solid rgba(255,255,255,.06);
            color: #657389;
            text-align: center;
            font-size: 10px;
        }

        /* -----------------------------
           RESPONSIVE
        ------------------------------ */

        @media (max-width: 1100px) {
            .pricing-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .included-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .plan-card.featured {
                transform: none;
            }
        }

        @media (max-width: 650px) {
            .shell {
                width: min(100% - 28px, 560px);
            }

            .topbar {
                padding: 17px 0;
            }

            .top-link.login {
                display: none;
            }

            .hero {
                padding: 52px 0 30px;
            }

            .hero h1 {
                font-size: 39px;
            }

            .hero p {
                font-size: 13px;
            }

            .pricing-grid {
                grid-template-columns: 1fr;
                padding-top: 12px;
            }

            .plan-card {
                padding: 22px;
            }

            .included {
                padding: 22px;
            }

            .included-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<div class="shell">

    {{-- TOPBAR --}}
    <header class="topbar">

        <a href="{{ route('home') }}" class="brand">

            <div class="brand-mark">
                ML
            </div>

            <div class="brand-text">
                <strong>Malav Library ERP</strong>
                <span>Smart Library Management Platform</span>
            </div>

        </a>

        <div class="top-actions">

            <a
                href="{{ route('login') }}"
                class="top-link login"
            >
                Login
            </a>

            <a
                href="{{ route('register') }}"
                class="top-link"
            >
                Get Started
            </a>

        </div>

    </header>


    {{-- HERO --}}
    <section class="hero">

        <div class="badge">
            <span class="badge-dot"></span>
            Simple & Transparent Pricing
        </div>

        <h1>
            One platform to
            <span>run your library.</span>
        </h1>

        <p>
            Manage students, memberships, seats, attendance, payments,
            expenses and reports — with a powerful online examination
            system when your library needs more.
        </p>

        <div class="billing-switch">

            <button
                type="button"
                class="billing-button active"
                data-cycle="monthly"
            >
                Monthly
            </button>

            <button
                type="button"
                class="billing-button"
                data-cycle="yearly"
            >
                Yearly
            </button>

        </div>

    </section>


    {{-- PRICING --}}
    <section class="pricing-grid">

        @foreach ($plans as $index => $plan)

            @php
                $isTrial = strtolower($plan->name) === 'free trial';

                $isFeatured = in_array(
                    strtolower($plan->name),
                    ['professional', 'premium']
                );

                $monthly = (float) $plan->monthly_price;
                $yearly = (float) $plan->yearly_price;

                $monthlyEquivalent = $yearly > 0
                    ? $yearly / 12
                    : 0;

                $saving = ($monthly * 12) - $yearly;
            @endphp

            <article class="plan-card {{ $isFeatured ? 'featured' : '' }}">

                @if ($isFeatured && strtolower($plan->name) === 'professional')
                    <div class="popular">
                        Most Popular
                    </div>
                @endif


                <h2 class="plan-name">
                    {{ $plan->name }}
                </h2>

                <p class="plan-description">
                    {{ $plan->description ?: 'Everything you need to manage your library efficiently.' }}
                </p>


                {{-- PRICE --}}
                <div class="price">

                    <div class="monthly-price">

                        <div class="price-row">

                            <span class="price-amount">
                                {{ $monthly == 0 ? 'Free' : '₹' . number_format($monthly, 0) }}
                            </span>

                            @if ($monthly > 0)
                                <span class="price-period">
                                    / month
                                </span>
                            @endif

                        </div>

                    </div>


                    <div class="yearly-price">

                        <div class="price-row">

                            <span class="price-amount">
                                {{ $yearly == 0 ? 'Free' : '₹' . number_format($monthlyEquivalent, 0) }}
                            </span>

                            @if ($yearly > 0)
                                <span class="price-period">
                                    / month
                                </span>
                            @endif

                        </div>

                    </div>


                    @if ($yearly > 0 && $monthly > 0)

                        <div class="price-note yearly-saving">
                            Save <strong>₹{{ number_format($saving, 0) }}</strong>
                            per year
                        </div>

                    @elseif ($isTrial)

                        <div class="price-note">
                            No payment required
                        </div>

                    @else

                        <div class="price-note">
                            Flexible billing
                        </div>

                    @endif

                </div>


                {{-- STUDENT LIMIT --}}
                <div class="student-limit">

                    @if ($plan->student_limit)
                        Up to {{ number_format($plan->student_limit) }} students
                    @else
                        Unlimited students
                    @endif

                </div>


                {{-- CORE ERP --}}
                <div class="feature-area">

                    <div class="feature-heading">
                        <span>Core Library ERP</span>
                        <span>Included modules</span>
                    </div>

                    <ul class="features">

                        <li>
                            <span class="check {{ $plan->student_management_access ? '' : 'off' }}">
                                {{ $plan->student_management_access ? '✓' : '—' }}
                            </span>
                            Student Management
                        </li>

                        <li>
                            <span class="check {{ $plan->membership_access ? '' : 'off' }}">
                                {{ $plan->membership_access ? '✓' : '—' }}
                            </span>
                            Memberships & Plans
                        </li>

                        <li>
                            <span class="check {{ $plan->seat_management_access ? '' : 'off' }}">
                                {{ $plan->seat_management_access ? '✓' : '—' }}
                            </span>
                            Rooms, Seats & Assignments
                        </li>

                        <li>
                            <span class="check {{ $plan->attendance_access ? '' : 'off' }}">
                                {{ $plan->attendance_access ? '✓' : '—' }}
                            </span>
                            Attendance & QR Kiosk
                        </li>

                        <li>
                            <span class="check {{ $plan->payment_access ? '' : 'off' }}">
                                {{ $plan->payment_access ? '✓' : '—' }}
                            </span>
                            Payments & Receipts
                        </li>

                        <li>
                            <span class="check {{ $plan->expense_access ? '' : 'off' }}">
                                {{ $plan->expense_access ? '✓' : '—' }}
                            </span>
                            Expense Management
                        </li>

                        <li>
                            <span class="check {{ $plan->id_card_access ? '' : 'off' }}">
                                {{ $plan->id_card_access ? '✓' : '—' }}
                            </span>
                            Student ID Cards
                        </li>

                        <li>
                            <span class="check {{ $plan->reports_access ? '' : 'off' }}">
                                {{ $plan->reports_access ? '✓' : '—' }}
                            </span>
                            Reports & Insights
                        </li>

                    </ul>

                </div>


                {{-- EXAM --}}
                <div class="feature-divider"></div>

                <div class="feature-area">

                    <div class="feature-heading">
                        <span>Online Examination</span>
                        <span>Premium tools</span>
                    </div>

                    <ul class="features">

                        <li>
                            <span class="check {{ $plan->exam_access ? '' : 'off' }}">
                                {{ $plan->exam_access ? '✓' : '—' }}
                            </span>
                            Online Examination
                        </li>

                        <li>
                            <span class="check {{ $plan->question_bank_access ? '' : 'off' }}">
                                {{ $plan->question_bank_access ? '✓' : '—' }}
                            </span>
                            Question Bank
                        </li>

                        <li>
                            <span class="check {{ $plan->current_affairs_access ? '' : 'off' }}">
                                {{ $plan->current_affairs_access ? '✓' : '—' }}
                            </span>
                            Current Affairs
                        </li>

                        <li>
                            <span class="check {{ $plan->major_test_access ? '' : 'off' }}">
                                {{ $plan->major_test_access ? '✓' : '—' }}
                            </span>
                            Major Tests
                        </li>

                        <li>
                            <span class="check {{ $plan->assigned_test_access ? '' : 'off' }}">
                                {{ $plan->assigned_test_access ? '✓' : '—' }}
                            </span>
                            Assigned Tests
                        </li>

                        <li>
                            <span class="check {{ $plan->public_exam_access ? '' : 'off' }}">
                                {{ $plan->public_exam_access ? '✓' : '—' }}
                            </span>
                            Public Exams
                        </li>

                        <li>
                            <span class="check {{ $plan->advanced_reports_access ? '' : 'off' }}">
                                {{ $plan->advanced_reports_access ? '✓' : '—' }}
                            </span>
                            Advanced Reports
                        </li>

                    </ul>

                </div>


                {{-- CTA --}}
                <div class="plan-cta">

                    <a
                        href="{{ route('register') }}"
                        class="cta {{ $isTrial ? 'primary' : 'secondary' }}"
                    >
                        {{ $isTrial ? 'Start Free Trial' : 'Choose ' . $plan->name }}
                    </a>

                </div>

            </article>

        @endforeach

    </section>


    {{-- INCLUDED --}}
    <section class="included">

        <div class="included-top">

            <h2>Everything your library needs</h2>

            <p>
                Start with the core library management tools and add
                examination capabilities as your operation grows.
            </p>

        </div>


        <div class="included-grid">

            <div class="included-item">
                <strong>Student Management</strong>
                <span>Profiles, student records and ID cards.</span>
            </div>

            <div class="included-item">
                <strong>Memberships</strong>
                <span>Plans, services, renewals and member management.</span>
            </div>

            <div class="included-item">
                <strong>Seat Management</strong>
                <span>Rooms, seats and student seat assignments.</span>
            </div>

            <div class="included-item">
                <strong>Attendance</strong>
                <span>Daily attendance with convenient kiosk workflows.</span>
            </div>

            <div class="included-item">
                <strong>Payments</strong>
                <span>Track payments, receipts and financial records.</span>
            </div>

            <div class="included-item">
                <strong>Expenses</strong>
                <span>Keep library operating expenses organised.</span>
            </div>

            <div class="included-item">
                <strong>Reports</strong>
                <span>Get a clear view of important library activity.</span>
            </div>

            <div class="included-item">
                <strong>Online Examination</strong>
                <span>Build exams, question banks and student assessments.</span>
            </div>

        </div>

    </section>


    <section class="trust">

        <p>
            Start with a 5-day free trial. Upgrade whenever your library grows.
        </p>

    </section>


    <footer class="footer">

        © {{ date('Y') }} Malav Library ERP. All rights reserved.

    </footer>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.billing-button');

    buttons.forEach(function (button) {

        button.addEventListener('click', function () {

            const cycle = this.dataset.cycle;

            buttons.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');


            document.querySelectorAll('.monthly-price')
                .forEach(function (item) {

                    item.style.display =
                        cycle === 'monthly'
                            ? 'block'
                            : 'none';

                });


            document.querySelectorAll('.yearly-price')
                .forEach(function (item) {

                    item.classList.toggle(
                        'active',
                        cycle === 'yearly'
                    );

                });


            document.querySelectorAll('.yearly-saving')
                .forEach(function (item) {

                    item.classList.toggle(
                        'active',
                        cycle === 'yearly'
                    );

                });

        });

    });

});
</script>

</body>
</html>