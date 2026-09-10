<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Choose Categories - {{ config('app.name', 'Malav Library') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #07070a;
            color: #fff;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .category-page {
            min-height: 100vh;
            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(99, 102, 241, .12),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 100%,
                    rgba(124, 58, 237, .10),
                    transparent 28%
                ),
                #07070a;
        }

        /* TOPBAR */

        .topbar {
            height: 76px;
            border-bottom: 1px solid rgba(255,255,255,.07);
            background: rgba(7,7,10,.82);
            backdrop-filter: blur(20px);
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .topbar-inner {
            max-width: 1380px;
            height: 100%;
            margin: auto;
            padding: 0 28px;

            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-icon {
            width: 42px;
            height: 42px;
            border-radius: 13px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #6366f1,
                #7c3aed
            );

            font-size: 17px;
            font-weight: 850;

            box-shadow:
                0 10px 30px rgba(99,102,241,.24),
                inset 0 1px rgba(255,255,255,.2);
        }

        .brand-name {
            color: #fafafa;
            font-size: 14px;
            font-weight: 750;
            letter-spacing: -.02em;
        }

        .brand-subtitle {
            margin-top: 2px;
            color: #52525b;
            font-size: 10px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            color: #e4e4e7;
            font-size: 12px;
            font-weight: 700;
        }

        .user-email {
            margin-top: 2px;
            color: #52525b;
            font-size: 10px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.25),
                    rgba(124,58,237,.2)
                );

            border: 1px solid rgba(129,140,248,.22);

            color: #a5b4fc;
            font-size: 12px;
            font-weight: 800;
        }

        .logout-btn {
            height: 38px;
            padding: 0 14px;

            border: 1px solid #27272a;
            border-radius: 11px;

            background: rgba(255,255,255,.025);
            color: #a1a1aa;

            font-size: 11px;
            font-weight: 650;

            cursor: pointer;
            transition: .2s ease;
        }

        .logout-btn:hover {
            border-color: rgba(248,113,113,.25);
            background: rgba(239,68,68,.07);
            color: #fca5a5;
        }

        /* MAIN */

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 50px 28px 70px;
        }

        .hero {
            padding: 36px;

            border: 1px solid rgba(255,255,255,.075);
            border-radius: 25px;

            background:
                linear-gradient(
                    135deg,
                    rgba(99,102,241,.11),
                    rgba(255,255,255,.025) 45%,
                    rgba(124,58,237,.06)
                );

            box-shadow:
                0 25px 70px rgba(0,0,0,.25),
                inset 0 1px rgba(255,255,255,.045);
        }

        .hero-label {
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .hero-title {
            margin: 12px 0 0;

            color: #fafafa;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.1;
            font-weight: 850;
            letter-spacing: -.045em;
        }

        .hero-text {
            max-width: 680px;
            margin: 13px 0 0;

            color: #71717a;
            font-size: 13px;
            line-height: 1.7;
        }

        .limit {
            display: inline-flex;
            margin-top: 20px;
            padding: 8px 12px;

            border: 1px solid #27272a;
            border-radius: 999px;

            color: #a1a1aa;
            background: rgba(255,255,255,.025);

            font-size: 10px;
            font-weight: 700;
        }

        .error-box {
            margin-top: 20px;
            padding: 14px 16px;

            border: 1px solid rgba(248,113,113,.18);
            border-radius: 12px;

            background: rgba(239,68,68,.07);
            color: #fca5a5;

            font-size: 12px;
        }

        /* CATEGORY GRID */

        .section-title {
            margin-top: 38px;
            margin-bottom: 18px;

            color: #fafafa;
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.025em;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .category-card {
            position: relative;
        }

        .category-checkbox {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .category-label {
            display: block;
            min-height: 175px;

            padding: 21px;

            border: 1px solid rgba(255,255,255,.065);
            border-radius: 18px;

            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.018)
                );

            cursor: pointer;

            transition:
                transform .2s ease,
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .category-label:hover {
            transform: translateY(-2px);
            border-color: rgba(129,140,248,.20);
        }

        .category-checkbox:checked + .category-label {
            border-color: rgba(129,140,248,.55);

            box-shadow:
                0 0 0 2px rgba(99,102,241,.10),
                0 20px 45px rgba(0,0,0,.22);
        }

        .check-box {
            width: 24px;
            height: 24px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #3f3f46;
            border-radius: 8px;

            color: transparent;

            transition: .2s ease;
        }

        .category-checkbox:checked + .category-label .check-box {
            background: linear-gradient(
                135deg,
                #6366f1,
                #7c3aed
            );

            border-color: transparent;
            color: white;
        }

        .category-name {
            margin-top: 18px;

            color: #f4f4f5;
            font-size: 16px;
            font-weight: 750;
        }

        .category-description {
            margin-top: 7px;

            color: #52525b;
            font-size: 11px;
            line-height: 1.65;
        }

        /* ACTIONS */

        .actions {
            margin-top: 24px;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 18px 20px;

            border: 1px solid rgba(255,255,255,.06);
            border-radius: 16px;

            background: rgba(255,255,255,.02);
        }

        .selected-count {
            color: #71717a;
            font-size: 11px;
        }

        .selected-count strong {
            color: #e4e4e7;
        }

        .save-btn {
            height: 44px;
            padding: 0 22px;

            border: 0;
            border-radius: 11px;

            background: linear-gradient(
                135deg,
                #6366f1,
                #7c3aed
            );

            color: white;

            font-size: 11px;
            font-weight: 750;

            cursor: pointer;

            box-shadow:
                0 12px 25px rgba(99,102,241,.16);

            transition: .2s ease;
        }

        .save-btn:hover {
            transform: translateY(-1px);

            box-shadow:
                0 15px 32px rgba(99,102,241,.25);
        }

        .empty-state {
            padding: 55px 25px;

            text-align: center;

            border: 1px dashed #27272a;
            border-radius: 18px;

            color: #52525b;
            font-size: 12px;
        }

        /* RESPONSIVE */

        @media (max-width: 850px) {

            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media (max-width: 650px) {

            .topbar-inner {
                padding: 0 18px;
            }

            .container {
                padding: 30px 18px 50px;
            }

            .hero {
                padding: 26px 22px;
            }

            .category-grid {
                grid-template-columns: 1fr;
            }

            .actions {
                align-items: stretch;
                flex-direction: column;
            }

            .save-btn {
                width: 100%;
            }

            .user-info {
                display: none;
            }

            .brand-subtitle {
                display: none;
            }

        }

    </style>

</head>


<body>

<div class="category-page">

    {{-- TOP BAR --}}

    <header class="topbar">

        <div class="topbar-inner">

            <a
                href="{{ route('exam-user.dashboard') }}"
                class="brand"
            >

                <div class="brand-icon">
                    E
                </div>

                <div>

                    <div class="brand-name">
                        Online Exams
                    </div>

                    <div class="brand-subtitle">
                        Student Examination Portal
                    </div>

                </div>

            </a>


            <div class="top-actions">

                <div class="user-info">

                    <div class="user-name">
                        {{ $examUser->name }}
                    </div>

                    <div class="user-email">
                        {{ $examUser->email }}
                    </div>

                </div>


                <div class="avatar">
                    {{ $examUser->initials() }}
                </div>


                <form
                    method="POST"
                    action="{{ route('exam-user.logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </header>


    {{-- MAIN --}}

    <main class="container">

        <section class="hero">

            <div class="hero-label">
                Examination Profile
            </div>

            <h1 class="hero-title">
                Choose Your Preparation Categories
            </h1>

            <p class="hero-text">
                Select the competitive examination categories you want
                to prepare for. Your selected categories will help us
                show you the relevant examinations.
            </p>

            <div class="limit">
                Select up to 5 categories
            </div>

        </section>


        @if ($errors->any())

            <div class="error-box">
                {{ $errors->first() }}
            </div>

        @endif


        <div class="section-title">
            Select Your Categories
        </div>


        <form
            method="POST"
            action="{{ route('exam-user.categories.update') }}"
            id="category-form"
        >

            @csrf

            @method('PUT')


            @if ($categories->isEmpty())

                <div class="empty-state">
                    No active examination categories are available right now.
                </div>

            @else

                <div class="category-grid">

                    @foreach ($categories as $category)

                        <div class="category-card">

                            <input
                                type="checkbox"
                                name="categories[]"
                                value="{{ $category->id }}"
                                id="category-{{ $category->id }}"
                                class="category-checkbox"
                                @checked(
                                    in_array(
                                        $category->id,
                                        $selectedCategoryIds
                                    )
                                )
                            >

                            <label
                                for="category-{{ $category->id }}"
                                class="category-label"
                            >

                                <div class="check-box">

                                    <svg
                                        width="14"
                                        height="14"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="3"
                                    >
                                        <path d="m5 12 4 4L19 6"/>
                                    </svg>

                                </div>


                                <div class="category-name">
                                    {{ $category->name }}
                                </div>


                                <div class="category-description">

                                    @if ($category->description)

                                        {{ $category->description }}

                                    @else

                                        Prepare for
                                        {{ $category->name }}
                                        examinations.

                                    @endif

                                </div>

                            </label>

                        </div>

                    @endforeach

                </div>


                <div class="actions">

                    <div class="selected-count">

                        Selected:
                        <strong id="selected-count">0</strong>
                        / 5

                    </div>


                    <button
                        type="submit"
                        class="save-btn"
                    >
                        Save Categories
                    </button>

                </div>

            @endif

        </form>

    </main>

</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const checkboxes =
                document.querySelectorAll(
                    '.category-checkbox'
                );

            const countElement =
                document.getElementById(
                    'selected-count'
                );


            function updateCount() {

                const selected =
                    document.querySelectorAll(
                        '.category-checkbox:checked'
                    ).length;

                if (countElement) {
                    countElement.textContent = selected;
                }

            }


            checkboxes.forEach(
                function (checkbox) {

                    checkbox.addEventListener(
                        'change',
                        function () {

                            const selected =
                                document.querySelectorAll(
                                    '.category-checkbox:checked'
                                ).length;


                            if (selected > 5) {

                                this.checked = false;

                                alert(
                                    'You can select a maximum of 5 categories.'
                                );

                            }


                            updateCount();

                        }
                    );

                }
            );


            updateCount();

        }
    );

</script>

</body>

</html>