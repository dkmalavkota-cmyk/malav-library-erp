<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        {{ $title ?? 'Online Examination' }} - {{ config('app.name', 'Malav Library') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance

    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            min-height: 100%;
            background: #09090b;
        }

        body {
            overflow-x: hidden;
            color: #fafafa;
        }

        /* =========================================================
           EXAMINATION SHELL
        ========================================================= */

        .exam-shell {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 75% -10%,
                    rgba(99, 102, 241, 0.08),
                    transparent 360px
                ),
                #09090b;
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */

        .exam-sidebar {
            position: fixed !important;
            inset: 0 auto 0 0 !important;

            width: 264px !important;
            height: 100vh !important;

            z-index: 1000 !important;

            display: flex !important;
            flex-direction: column !important;

            background:
                radial-gradient(
                    circle at 15% 0%,
                    rgba(99, 102, 241, 0.11),
                    transparent 280px
                ),
                linear-gradient(
                    180deg,
                    #111116 0%,
                    #0e0e12 100%
                ) !important;

            border-right: 1px solid #27272a !important;

            box-shadow:
                12px 0 40px rgba(0, 0, 0, 0.18);

            overflow: hidden;
        }

        /* =========================================================
           BRAND
        ========================================================= */

        .exam-sidebar-brand {
            height: 82px;
            flex: 0 0 82px;

            display: flex;
            align-items: center;

            padding: 0 20px;

            border-bottom: 1px solid #27272a;
        }

        .exam-brand-link {
            display: flex;
            align-items: center;
            gap: 12px;

            width: 100%;

            text-decoration: none !important;
        }

        .exam-brand-icon {
            position: relative;

            width: 44px;
            height: 44px;
            flex: 0 0 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #6366f1 0%,
                    #7c3aed 100%
                );

            color: #fff;

            font-size: 17px;
            font-weight: 800;

            box-shadow:
                0 10px 28px rgba(99, 102, 241, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .exam-brand-icon::after {
            content: "";

            position: absolute;
            inset: 1px;

            border-radius: 13px;

            border: 1px solid rgba(255, 255, 255, 0.1);

            pointer-events: none;
        }

        .exam-brand-title {
            color: #fff;

            font-size: 14px;
            font-weight: 750;
            line-height: 1.2;

            letter-spacing: -0.01em;
        }

        .exam-brand-subtitle {
            margin-top: 5px;

            color: #71717a;

            font-size: 10px;
            font-weight: 500;
            line-height: 1.3;

            white-space: nowrap;
        }

        /* =========================================================
           NAVIGATION
        ========================================================= */

        .exam-sidebar-nav {
            flex: 1;

            overflow-y: auto;
            overflow-x: hidden;

            padding: 22px 12px;
        }

        .exam-nav-section {
            margin-bottom: 24px;
        }

        .exam-nav-label {
            margin: 0 12px 10px;

            color: #52525b;

            font-size: 10px;
            font-weight: 750;

            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .exam-nav-link {
            position: relative;

            display: flex;
            align-items: center;
            gap: 12px;

            width: 100%;
            min-height: 45px;

            margin-bottom: 5px;
            padding: 0 12px;

            border: 1px solid transparent;
            border-radius: 12px;

            color: #a1a1aa;

            text-decoration: none !important;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .18s ease,
                color .18s ease,
                border-color .18s ease,
                transform .18s ease,
                box-shadow .18s ease;
        }

        .exam-nav-link:hover {
            color: #fff;

            background: rgba(255, 255, 255, 0.035);

            border-color: #27272a;

            transform: translateX(2px);
        }

        .exam-nav-link.active {
            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    rgba(99, 102, 241, .20),
                    rgba(124, 58, 237, .12)
                );

            border-color: rgba(99, 102, 241, .28);

            box-shadow:
                inset 0 1px 0 rgba(255,255,255,.025),
                0 8px 25px rgba(0,0,0,.16);
        }

        .exam-nav-link.active::before {
            content: "";

            position: absolute;

            left: -1px;
            top: 9px;
            bottom: 9px;

            width: 3px;

            border-radius: 0 5px 5px 0;

            background:
                linear-gradient(
                    to bottom,
                    #818cf8,
                    #8b5cf6
                );

            box-shadow:
                0 0 14px rgba(129, 140, 248, .55);
        }

        .exam-nav-icon {
            width: 19px;
            height: 19px;

            flex: 0 0 19px;

            color: currentColor;
        }

        .exam-nav-link-text {
            flex: 1;
            min-width: 0;
        }

        .exam-nav-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-width: 20px;
            height: 20px;

            padding: 0 6px;

            border-radius: 999px;

            background: rgba(99, 102, 241, .12);
            color: #a5b4fc;

            font-size: 9px;
            font-weight: 700;
        }

        /* =========================================================
           SIDEBAR FOOTER
        ========================================================= */

        .exam-sidebar-footer {
            flex: 0 0 auto;

            padding: 12px;

            border-top: 1px solid #27272a;

            background: rgba(0, 0, 0, 0.08);
        }

        .exam-library-link {
            display: flex;
            align-items: center;
            gap: 12px;

            min-height: 45px;

            padding: 0 12px;

            border: 1px solid transparent;
            border-radius: 12px;

            color: #a1a1aa;

            text-decoration: none !important;

            font-size: 13px;
            font-weight: 600;

            transition:
                background .18s ease,
                color .18s ease,
                border-color .18s ease;
        }

        .exam-library-link:hover {
            color: #fff;

            background: rgba(255,255,255,.035);

            border-color: #27272a;
        }

        .exam-library-icon {
            width: 19px;
            height: 19px;

            flex: 0 0 19px;
        }

        /* =========================================================
           MAIN CONTENT
        ========================================================= */

        .exam-main {
            position: relative !important;

            margin-left: 264px !important;

            width: calc(100% - 264px) !important;

            min-width: 0 !important;
            min-height: 100vh !important;

            background:
                radial-gradient(
                    circle at 85% 0%,
                    rgba(99, 102, 241, 0.045),
                    transparent 380px
                ),
                #09090b !important;

            overflow-x: hidden;
        }

        .exam-main-content {
            position: relative;

            width: 100%;
            min-width: 0;

            min-height: 100vh;

            padding: 0;

            box-sizing: border-box;
        }

        /* =========================================================
           SCROLLBAR
        ========================================================= */

        .exam-sidebar-nav::-webkit-scrollbar {
            width: 5px;
        }

        .exam-sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .exam-sidebar-nav::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 999px;
        }

        .exam-sidebar-nav::-webkit-scrollbar-thumb:hover {
            background: #3f3f46;
        }

        /* =========================================================
           MOBILE / TABLET
        ========================================================= */

        @media (max-width: 900px) {
            .exam-sidebar {
                width: 230px !important;
            }

            .exam-main {
                margin-left: 230px !important;
                width: calc(100% - 230px) !important;
            }

            .exam-brand-subtitle {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .exam-sidebar {
                width: 72px !important;
            }

            .exam-main {
                margin-left: 72px !important;
                width: calc(100% - 72px) !important;
            }

            .exam-sidebar-brand {
                justify-content: center;
                padding: 0;
            }

            .exam-brand-link {
                justify-content: center;
            }

            .exam-brand-title,
            .exam-brand-subtitle,
            .exam-nav-label {
                display: none;
            }

            .exam-sidebar-nav {
                padding-left: 8px;
                padding-right: 8px;
            }

            .exam-nav-link {
                justify-content: center;
                padding: 0;
            }

            .exam-nav-link-text,
            .exam-nav-badge {
                display: none;
            }

            .exam-nav-link.active::before {
                display: none;
            }

            .exam-library-link {
                justify-content: center;
                padding: 0;
            }

            .exam-library-link span {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="exam-shell">

    {{-- =========================================================
         EXAMINATION SIDEBAR
    ========================================================== --}}

    <aside class="exam-sidebar">

        {{-- BRAND --}}
        <div class="exam-sidebar-brand">

            <a
                href="{{ route('examination.dashboard') }}"
                class="exam-brand-link"
            >

                <div class="exam-brand-icon">
                    E
                </div>

                <div>
                    <div class="exam-brand-title">
                        Online Examination
                    </div>

                    <div class="exam-brand-subtitle">
                        Examination Management System
                    </div>
                </div>

            </a>

        </div>


        {{-- NAVIGATION --}}
        <nav class="exam-sidebar-nav">

            {{-- MAIN --}}
            <div class="exam-nav-section">

                <div class="exam-nav-label">
                    Main
                </div>

                {{-- Dashboard --}}
                <a
                    href="{{ route('examination.dashboard') }}"
                    class="exam-nav-link
                    {{ request()->routeIs('examination.dashboard')
                        ? 'active'
                        : '' }}"
                >

                    <svg
                        class="exam-nav-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M3 12l9-9 9 9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M5 10v10h14V10"
                        />
                    </svg>

                    <span class="exam-nav-link-text">
                        Dashboard
                    </span>

                </a>


                {{-- Exams --}}
                <a
                    href="{{ route('exams.index') }}"
                    class="exam-nav-link
                    {{ request()->routeIs('exams.*')
                        ? 'active'
                        : '' }}"
                >

                    <svg
                        class="exam-nav-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M8 7h8M8 11h8M8 15h5"
                        />
                    </svg>

                    <span class="exam-nav-link-text">
                        Exams
                    </span>

                </a>

{{-- Current Affairs --}}
<a
    href="{{ route('current-affairs.index') }}"
    class="exam-nav-link
    {{ request()->routeIs('current-affairs.*')
        ? 'active'
        : '' }}"
>

    <svg
        class="exam-nav-icon"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
    >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.7"
            d="M6 3h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2z"
        />

        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="1.7"
            d="M8 7h8M8 11h8M8 15h5"
        />
    </svg>

    <span class="exam-nav-link-text">
        Current Affairs
    </span>

</a>



                {{-- Question Bank --}}
                <a
                    href="{{ url('/question-bank') }}"
                    class="exam-nav-link
                    {{ request()->is('question-bank*')
                        ? 'active'
                        : '' }}"
                >

                    <svg
                        class="exam-nav-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M4 5a2 2 0 012-2h11a3 3 0 013 3v13a2 2 0 01-2 2H6a2 2 0 01-2-2V5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M8 7h8M8 11h6M8 15h5"
                        />
                    </svg>

                    <span class="exam-nav-link-text">
                        Question Bank
                    </span>

                </a>

            </div>


            {{-- CONTENT MANAGEMENT --}}
            <div class="exam-nav-section">

                <div class="exam-nav-label">
                    Content
                </div>

                {{-- Categories --}}
                <a
                    href="{{ route('exam-categories.index') }}"
                    class="exam-nav-link
                    {{ request()->routeIs('exam-categories.*')
                        ? 'active'
                        : '' }}"
                >

                    <svg
                        class="exam-nav-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M3 7h6l2 2h10v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"
                        />
                    </svg>

                    <span class="exam-nav-link-text">
                        Categories
                    </span>

                </a>


                {{-- Subjects --}}
                <a
                    href="{{ route('exam-subjects.index') }}"
                    class="exam-nav-link
                    {{ request()->routeIs('exam-subjects.*')
                        ? 'active'
                        : '' }}"
                >

                    <svg
                        class="exam-nav-icon"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M5 4h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5a1 1 0 011-1z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.7"
                            d="M8 8h8M8 12h8M8 16h5"
                        />
                    </svg>

                    <span class="exam-nav-link-text">
                        Subjects
                    </span>

                </a>


                {{-- Assignments --}}
                @if(Route::has('exams.assignments.index'))

                    <a
                        href="{{ route('exams.assignments.index') }}"
                        class="exam-nav-link
                        {{ request()->routeIs('exams.assignments.*')
                            ? 'active'
                            : '' }}"
                    >

                        <svg
                            class="exam-nav-icon"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M8 6h13M8 12h13M8 18h13"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M3 6h.01M3 12h.01M3 18h.01"
                            />
                        </svg>

                        <span class="exam-nav-link-text">
                            Assignments
                        </span>

                    </a>

                @endif

            </div>

        </nav>


        {{-- =====================================================
             BACK TO LIBRARY
        ====================================================== --}}

        <div class="exam-sidebar-footer">
<div
    style="
        padding: 0 24px 16px;
        text-align: center;
    "
>
    <div
        style="
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.72);
            text-transform: uppercase;
        "
    >
        Malav Technologies
    </div>

    <div
        style="
            margin-top: 4px;
            font-size: 10px;
            color: rgba(255,255,255,0.38);
            letter-spacing: 0.02em;
        "
    >
        Developed with technology & care
    </div>
</div>

            <a
                href="{{ route('dashboard') }}"
                class="exam-library-link"
            >

                <svg
                    class="exam-library-icon"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                <span>
                    Library Dashboard
                </span>

            </a>

        </div>

    </aside>


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main class="exam-main">

        <div class="exam-main-content">

            {{ $slot }}

        </div>

    </main>

</div>

</body>
</html>