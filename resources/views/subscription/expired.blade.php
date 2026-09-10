<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Subscription Expired</title>

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
            background:
                radial-gradient(circle at top left, rgba(68, 87, 125, .18), transparent 34%),
                radial-gradient(circle at bottom right, rgba(34, 51, 78, .22), transparent 36%),
                #070c15;
            color: #e8edf5;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .page {
            width: 100%;
            max-width: 760px;
        }

        .card {
            position: relative;
            overflow: hidden;
            padding: 48px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 24px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.012)),
                rgba(9,15,27,.92);
            box-shadow:
                0 28px 80px rgba(0,0,0,.42),
                inset 0 1px 0 rgba(255,255,255,.025);
        }

        .glow {
            position: absolute;
            width: 220px;
            height: 220px;
            top: -120px;
            right: -90px;
            border-radius: 50%;
            background: rgba(116, 139, 175, .10);
            filter: blur(12px);
            pointer-events: none;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 38px;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 11px;
            background: linear-gradient(145deg, #26354d, #141e2e);
            color: #eaf0f8;
            font-size: 14px;
            font-weight: 800;
        }

        .brand-text {
            color: #cfd8e5;
            font-size: 12px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .status-icon {
            width: 58px;
            height: 58px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 17px;
            background: rgba(255,255,255,.045);
            color: #b9c5d5;
        }

        .status-icon svg {
            width: 28px;
            height: 28px;
        }

        .eyebrow {
            margin: 0 0 9px;
            color: #78879d;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #f3f6fa;
            font-size: 34px;
            line-height: 1.15;
            letter-spacing: -.035em;
        }

        .description {
            max-width: 600px;
            margin: 14px 0 0;
            color: #8997aa;
            font-size: 14px;
            line-height: 1.7;
        }

        .details {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 32px;
        }

        .detail {
            padding: 15px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 13px;
            background: rgba(255,255,255,.025);
        }

        .detail-label {
            color: #69788d;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .detail-value {
            margin-top: 7px;
            color: #dce4ef;
            font-size: 12px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 32px;
        }

        .primary-button,
        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 16px;
            border-radius: 11px;
            font-size: 11px;
            font-weight: 750;
            text-decoration: none;
            transition: .2s ease;
        }

        .primary-button {
            border: 1px solid rgba(255,255,255,.10);
            background: linear-gradient(135deg, #2c3d58, #19263a);
            color: #f0f4fa;
            box-shadow: 0 10px 25px rgba(0,0,0,.18);
        }

        .secondary-button {
            border: 1px solid rgba(255,255,255,.075);
            background: rgba(255,255,255,.035);
            color: #aebacd;
        }

        .primary-button:hover,
        .secondary-button:hover {
            transform: translateY(-1px);
        }

        .primary-button:hover {
            background: linear-gradient(135deg, #344965, #1d2b41);
        }

        .secondary-button:hover {
            background: rgba(255,255,255,.06);
            color: #e4eaf2;
        }

        .button-icon {
            width: 14px;
            height: 14px;
        }

        .footer-note {
            margin-top: 27px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,.055);
            color: #65748a;
            font-size: 10px;
            line-height: 1.6;
        }

        @media (max-width: 620px) {
            body {
                padding: 14px;
            }

            .card {
                padding: 30px 22px;
                border-radius: 19px;
            }

            h1 {
                font-size: 28px;
            }

            .details {
                grid-template-columns: 1fr;
            }

            .actions {
                flex-direction: column;
                align-items: stretch;
            }

            .primary-button,
            .secondary-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <div class="card">

        <div class="glow"></div>

        <div class="brand">
            <div class="brand-mark">ME</div>

            <div class="brand-text">
                Malav Library ERP
            </div>
        </div>

        <div class="status-icon">
            <svg
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                stroke-linecap="round"
                stroke-linejoin="round"
            >
                <circle cx="12" cy="12" r="9"></circle>
                <path d="M12 7v5"></path>
                <path d="M12 16h.01"></path>
            </svg>
        </div>

        <p class="eyebrow">
            Subscription Status
        </p>

        <h1>
            Your subscription has expired
        </h1>

        <p class="description">
            Your library subscription is no longer active.
            Please renew your plan to continue using premium
            library and examination features.
        </p>

        @if($subscription)

            <div class="details">

                <div class="detail">
                    <div class="detail-label">
                        Library
                    </div>

                    <div class="detail-value">
                        {{ $library?->name ?? 'Library' }}
                    </div>
                </div>

                <div class="detail">
                    <div class="detail-label">
                        Plan
                    </div>

                    <div class="detail-value">
                        {{ $subscription->plan_name ?? '—' }}
                    </div>
                </div>

                <div class="detail">
                    <div class="detail-label">
                        Expired On
                    </div>

                    <div class="detail-value">
                        {{ $subscription->ends_at?->format('d M Y') ?? '—' }}
                    </div>
                </div>

            </div>

        @endif

        <div class="actions">

            @if($library)
                <a
                    href="{{ route('dashboard') }}"
                    class="primary-button"
                >
                    Go to Dashboard

                    <svg
                        class="button-icon"
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

            <a
                href="{{ route('logout') }}"
                class="secondary-button"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            >
                Sign Out
            </a>

        </div>

        <div class="footer-note">
            To renew your subscription, please contact your library
            administrator or the SaaS administrator.
        </div>

    </div>

</div>

<form
    id="logout-form"
    method="POST"
    action="{{ route('logout') }}"
    style="display:none;"
>
    @csrf
</form>

</body>
</html>