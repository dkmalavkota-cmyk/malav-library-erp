<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')

    <style>
        html,
        body {
            margin: 0;
            min-height: 100%;
            background: #07090d;
        }

        .erp-login-page {
            min-height: 100vh;
            min-height: 100dvh;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 12% 88%, rgba(245, 158, 11, 0.12), transparent 25%),
                radial-gradient(circle at 88% 10%, rgba(245, 158, 11, 0.10), transparent 25%),
                linear-gradient(135deg, #05070a 0%, #0a0d12 48%, #05070a 100%);
            color: white;
        }

        .erp-login-page::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .28;
            background-image:
                radial-gradient(circle, rgba(245, 158, 11, .35) 1px, transparent 1.2px);
            background-size: 16px 16px;
            mask-image: linear-gradient(
                to bottom right,
                transparent 0%,
                transparent 8%,
                black 20%,
                transparent 38%,
                transparent 62%,
                black 80%,
                transparent 94%
            );
        }

        .erp-glow {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 999px;
            border: 1px solid rgba(245, 158, 11, .12);
            opacity: .8;
            pointer-events: none;
        }

        .erp-glow-left {
            left: -230px;
            top: -170px;
            box-shadow:
                0 0 0 45px rgba(245, 158, 11, .025),
                0 0 0 90px rgba(245, 158, 11, .018),
                0 0 0 135px rgba(245, 158, 11, .012);
        }

        .erp-glow-right {
            right: -250px;
            bottom: -190px;
            box-shadow:
                0 0 0 45px rgba(245, 158, 11, .025),
                0 0 0 90px rgba(245, 158, 11, .018),
                0 0 0 135px rgba(245, 158, 11, .012);
        }

        .erp-login-content {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            min-height: 100dvh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            box-sizing: border-box;
        }

        @media (max-height: 850px) {
            .erp-login-content {
                align-items: flex-start;
                padding-top: 28px;
                padding-bottom: 28px;
            }
        }

        @media (max-width: 640px) {
            .erp-login-content {
                padding: 28px 16px;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <div class="erp-login-page">

        <div class="erp-glow erp-glow-left"></div>
        <div class="erp-glow erp-glow-right"></div>

        {{ $slot }}

    </div>

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts

</body>
</html>