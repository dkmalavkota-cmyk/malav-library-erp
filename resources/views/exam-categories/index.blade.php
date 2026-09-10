<x-layouts::examination :title="'Exam Categories'">

<style>
    /* =========================================================
       EXAM CATEGORY PREMIUM UI
    ========================================================== */

    .ec-page {
        --ec-bg: #111113;
        --ec-panel: #17171a;
        --ec-panel-2: #1b1b1f;
        --ec-border: rgba(255,255,255,.075);
        --ec-border-hover: rgba(124,92,255,.38);
        --ec-text: #f5f5f7;
        --ec-muted: #8d8d98;
        --ec-soft: #65656f;
        --ec-primary: #735cff;
        --ec-primary-2: #8b7cff;
        --ec-success: #20d9a0;
        --ec-warning: #f5b84b;
        --ec-danger: #ff626f;

        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 28px;
        color: var(--ec-text);
    }

    /* ---------- HEADER ---------- */

    .ec-hero {
        position: relative;
        overflow: hidden;
        border: 1px solid var(--ec-border);
        border-radius: 26px;
        padding: 30px;
        background:
            radial-gradient(circle at 85% 0%, rgba(115,92,255,.16), transparent 30%),
            radial-gradient(circle at 65% 100%, rgba(96,165,250,.06), transparent 28%),
            linear-gradient(135deg, #19191d 0%, #141416 100%);
        box-shadow:
            0 25px 70px rgba(0,0,0,.22),
            inset 0 1px 0 rgba(255,255,255,.025);
    }

    .ec-hero::before {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -100px;
        top: -100px;
        border-radius: 50%;
        background: rgba(115,92,255,.13);
        filter: blur(50px);
        pointer-events: none;
    }

    .ec-hero-inner {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;
    }

    .ec-title-wrap {
        display: flex;
        align-items: flex-start;
        gap: 18px;
    }

    .ec-title-icon {
        width: 58px;
        height: 58px;
        flex: 0 0 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        border: 1px solid rgba(115,92,255,.28);
        background: linear-gradient(
            145deg,
            rgba(115,92,255,.19),
            rgba(115,92,255,.06)
        );
        color: #9a8dff;
        box-shadow:
            0 12px 30px rgba(115,92,255,.10),
            inset 0 1px 0 rgba(255,255,255,.05);
    }

    .ec-title-icon svg {
        width: 27px;
        height: 27px;
    }

    .ec-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 7px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .11em;
        text-transform: uppercase;
        color: #8e82ff;
    }

    .ec-eyebrow-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #8e82ff;
        box-shadow: 0 0 12px rgba(142,130,255,.8);
    }

    .ec-title {
        margin: 0;
        font-size: 30px;
        line-height: 1.15;
        font-weight: 750;
        letter-spacing: -.025em;
        color: #fff;
    }

    .ec-subtitle {
        max-width: 680px;
        margin: 9px 0 0;
        font-size: 14px;
        line-height: 1.65;
        color: #85858f;
    }

    .ec-create-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 48px;
        padding: 0 19px;
        border-radius: 14px;
        border: 1px solid rgba(255,255,255,.08);
        background: linear-gradient(135deg, #7863ff, #6651ed);
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow:
            0 12px 28px rgba(103,81,237,.23),
            inset 0 1px 0 rgba(255,255,255,.18);
        transition: .22s ease;
    }

    .ec-create-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #8875ff, #715df4);
        box-shadow:
            0 16px 34px rgba(103,81,237,.30),
            inset 0 1px 0 rgba(255,255,255,.2);
    }

    .ec-create-btn svg {
        width: 18px;
        height: 18px;
    }


    /* ---------- FLASH ---------- */

    .ec-alert {
        display: flex;
        align-items: center;
        gap: 13px;
        margin-top: 18px;
        padding: 14px 17px;
        border: 1px solid rgba(32,217,160,.16);
        border-radius: 15px;
        background: linear-gradient(
            90deg,
            rgba(32,217,160,.08),
            rgba(32,217,160,.025)
        );
    }

    .ec-alert-icon {
        width: 34px;
        height: 34px;
        flex: 0 0 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: rgba(32,217,160,.10);
        color: var(--ec-success);
    }

    .ec-alert-icon svg {
        width: 17px;
        height: 17px;
    }

    .ec-alert-title {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #61e9c0;
    }

    .ec-alert-text {
        margin: 2px 0 0;
        font-size: 11px;
        color: #618f82;
    }


    /* ---------- STATS ---------- */

    .ec-stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
        margin-top: 18px;
    }

    .ec-stat {
        position: relative;
        overflow: hidden;
        min-height: 145px;
        padding: 22px;
        border: 1px solid var(--ec-border);
        border-radius: 20px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.025), transparent 60%),
            var(--ec-panel);
        box-shadow:
            0 16px 40px rgba(0,0,0,.12),
            inset 0 1px 0 rgba(255,255,255,.018);
        transition: .22s ease;
    }

    .ec-stat:hover {
        transform: translateY(-2px);
        border-color: rgba(255,255,255,.12);
    }

    .ec-stat::after {
        content: "";
        position: absolute;
        right: -45px;
        top: -50px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: var(--stat-glow);
        filter: blur(35px);
        opacity: .65;
        pointer-events: none;
    }

    .ec-stat.total {
        --stat-glow: rgba(115,92,255,.13);
    }

    .ec-stat.active {
        --stat-glow: rgba(32,217,160,.10);
    }

    .ec-stat.inactive {
        --stat-glow: rgba(245,184,75,.10);
    }

    .ec-stat-top {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 15px;
    }

    .ec-stat-label {
        margin: 0;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .09em;
        text-transform: uppercase;
        color: #71717c;
    }

    .ec-stat-number {
        margin: 9px 0 0;
        font-size: 35px;
        line-height: 1;
        font-weight: 750;
        letter-spacing: -.035em;
        color: #fff;
    }

    .ec-stat-caption {
        margin: 8px 0 0;
        font-size: 11px;
        color: #62626d;
    }

    .ec-stat-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        border: 1px solid rgba(255,255,255,.06);
    }

    .ec-stat.total .ec-stat-icon {
        color: #9385ff;
        background: rgba(115,92,255,.09);
    }

    .ec-stat.active .ec-stat-icon {
        color: #35dfae;
        background: rgba(32,217,160,.08);
    }

    .ec-stat.inactive .ec-stat-icon {
        color: #f6c263;
        background: rgba(245,184,75,.08);
    }

    .ec-stat-icon svg {
        width: 19px;
        height: 19px;
    }


    /* ---------- LIST PANEL ---------- */

    .ec-list {
        margin-top: 18px;
        overflow: hidden;
        border: 1px solid var(--ec-border);
        border-radius: 24px;
        background:
            linear-gradient(145deg, rgba(255,255,255,.018), transparent 50%),
            var(--ec-panel);
        box-shadow:
            0 24px 60px rgba(0,0,0,.16),
            inset 0 1px 0 rgba(255,255,255,.018);
    }

    .ec-list-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 21px 23px;
        border-bottom: 1px solid var(--ec-border);
    }

    .ec-list-heading {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .ec-list-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: rgba(115,92,255,.08);
        color: #8e80ff;
    }

    .ec-list-icon svg {
        width: 19px;
        height: 19px;
    }

    .ec-list-title {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #f5f5f7;
    }

    .ec-list-description {
        margin: 3px 0 0;
        font-size: 12px;
        color: #65656f;
    }

    .ec-count {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 0 11px;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 999px;
        background: rgba(255,255,255,.025);
        color: #85858f;
        font-size: 11px;
        font-weight: 700;
    }


    /* ---------- CATEGORY ROW ---------- */

    .ec-category {
        position: relative;
        display: grid;
        grid-template-columns: minmax(250px, 1.15fr) minmax(220px, 1fr) auto;
        align-items: center;
        gap: 28px;
        padding: 21px 23px;
        border-bottom: 1px solid rgba(255,255,255,.045);
        transition: .22s ease;
    }

    .ec-category:last-child {
        border-bottom: 0;
    }

    .ec-category:hover {
        background:
            linear-gradient(
                90deg,
                rgba(115,92,255,.055),
                rgba(115,92,255,.018),
                transparent
            );
    }

    .ec-category:hover::before {
        opacity: 1;
    }

    .ec-category::before {
        content: "";
        position: absolute;
        left: 0;
        top: 15px;
        bottom: 15px;
        width: 2px;
        border-radius: 0 3px 3px 0;
        background: #7965ff;
        opacity: 0;
        transition: .22s ease;
    }

    .ec-category-main {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
    }

    .ec-avatar {
        width: 50px;
        height: 50px;
        flex: 0 0 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(115,92,255,.17);
        border-radius: 16px;
        background:
            linear-gradient(145deg, rgba(115,92,255,.16), rgba(115,92,255,.045));
        color: #a296ff;
        font-size: 17px;
        font-weight: 800;
        box-shadow: inset 0 1px 0 rgba(255,255,255,.035);
    }

    .ec-category-info {
        min-width: 0;
    }

    .ec-category-name-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .ec-category-name {
        margin: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: 14px;
        font-weight: 750;
        color: #f4f4f6;
    }

    .ec-slug {
        margin: 5px 0 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
        font-size: 10px;
        color: #5f5f69;
    }

    .ec-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        min-height: 22px;
        padding: 0 8px;
        border-radius: 999px;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .ec-status.active {
        border: 1px solid rgba(32,217,160,.14);
        background: rgba(32,217,160,.07);
        color: #42dcae;
    }

    .ec-status.inactive {
        border: 1px solid rgba(255,255,255,.07);
        background: rgba(255,255,255,.035);
        color: #777781;
    }

    .ec-status-dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
    }

    .ec-status.active .ec-status-dot {
        background: #32dbaa;
        box-shadow: 0 0 8px rgba(50,219,170,.65);
    }

    .ec-status.inactive .ec-status-dot {
        background: #686872;
    }

    .ec-description {
        min-width: 0;
    }

    .ec-description-label {
        margin-bottom: 5px;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #4f4f58;
    }

    .ec-description-text {
        display: -webkit-box;
        overflow: hidden;
        margin: 0;
        color: #777781;
        font-size: 12px;
        line-height: 1.55;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .ec-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .ec-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        height: 38px;
        padding: 0 12px;
        border-radius: 11px;
        text-decoration: none;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s ease;
    }

    .ec-action svg {
        width: 14px;
        height: 14px;
    }

    .ec-action.edit {
        border: 1px solid rgba(115,92,255,.16);
        background: rgba(115,92,255,.06);
        color: #9b90ff;
    }

    .ec-action.edit:hover {
        border-color: rgba(115,92,255,.32);
        background: rgba(115,92,255,.12);
        transform: translateY(-1px);
    }

    .ec-action.delete {
        border: 1px solid rgba(255,98,111,.12);
        background: rgba(255,98,111,.045);
        color: #e87882;
    }

    .ec-action.delete:hover {
        border-color: rgba(255,98,111,.28);
        background: rgba(255,98,111,.09);
        transform: translateY(-1px);
    }


    /* ---------- EMPTY ---------- */

    .ec-empty {
        padding: 75px 25px;
        text-align: center;
    }

    .ec-empty-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(115,92,255,.15);
        border-radius: 24px;
        background:
            radial-gradient(circle at 50% 30%, rgba(115,92,255,.15), transparent 65%),
            rgba(115,92,255,.055);
        color: #9183ff;
        box-shadow: 0 20px 50px rgba(0,0,0,.15);
    }

    .ec-empty-icon svg {
        width: 31px;
        height: 31px;
    }

    .ec-empty-title {
        margin: 19px 0 0;
        font-size: 18px;
        font-weight: 750;
        color: #f3f3f5;
    }

    .ec-empty-text {
        max-width: 470px;
        margin: 8px auto 0;
        font-size: 12px;
        line-height: 1.7;
        color: #676771;
    }

    .ec-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 21px;
        min-height: 43px;
        padding: 0 17px;
        border-radius: 13px;
        background: linear-gradient(135deg, #7863ff, #6651ed);
        color: #fff;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 12px 28px rgba(103,81,237,.2);
        transition: .2s ease;
    }

    .ec-empty-btn:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, #8875ff, #715df4);
    }

    .ec-empty-btn svg {
        width: 16px;
        height: 16px;
    }


    /* ---------- MOBILE ---------- */

    .ec-mobile-list {
        display: none;
    }

    @media (max-width: 1000px) {
        .ec-page {
            padding: 22px;
        }

        .ec-category {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .ec-description {
            padding-left: 64px;
        }

        .ec-actions {
            justify-content: flex-start;
            padding-left: 64px;
        }
    }

    @media (max-width: 760px) {
        .ec-page {
            padding: 16px;
        }

        .ec-hero {
            padding: 21px;
            border-radius: 21px;
        }

        .ec-hero-inner {
            align-items: stretch;
            flex-direction: column;
        }

        .ec-title-wrap {
            gap: 13px;
        }

        .ec-title-icon {
            width: 48px;
            height: 48px;
            flex-basis: 48px;
            border-radius: 14px;
        }

        .ec-title {
            font-size: 24px;
        }

        .ec-subtitle {
            font-size: 12px;
        }

        .ec-create-btn {
            width: 100%;
        }

        .ec-stats {
            grid-template-columns: 1fr;
        }

        .ec-stat {
            min-height: 125px;
        }

        .ec-list {
            border-radius: 20px;
        }

        .ec-list-head {
            align-items: flex-start;
            padding: 17px;
        }

        .ec-list-description {
            max-width: 230px;
        }

        .ec-desktop-list {
            display: none;
        }

        .ec-mobile-list {
            display: block;
        }

        .ec-mobile-card {
            padding: 16px;
            border-bottom: 1px solid rgba(255,255,255,.05);
        }

        .ec-mobile-card:last-child {
            border-bottom: 0;
        }

        .ec-mobile-card-inner {
            padding: 15px;
            border: 1px solid rgba(255,255,255,.055);
            border-radius: 17px;
            background: rgba(255,255,255,.012);
        }

        .ec-mobile-top {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .ec-mobile-info {
            min-width: 0;
            flex: 1;
        }

        .ec-mobile-status {
            margin-top: 9px;
        }

        .ec-mobile-description {
            margin-top: 13px;
            font-size: 12px;
            line-height: 1.65;
            color: #70707a;
        }

        .ec-mobile-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-top: 14px;
        }

        .ec-mobile-actions .ec-action {
            width: 100%;
        }

        .ec-description,
        .ec-actions {
            padding-left: 0;
        }
    }
</style>


<div class="ec-page">

    {{-- =========================================================
         PREMIUM HEADER
    ========================================================== --}}
    <div class="ec-hero">

        <div class="ec-hero-inner">

            <div class="ec-title-wrap">

                <div class="ec-title-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.7"
                              d="M9 5h6m-7 4h8M7 13h10M7 17h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>
                </div>

                <div>

                    <div class="ec-eyebrow">
                        <span class="ec-eyebrow-dot"></span>
                        Online Examination
                    </div>

                    <h1 class="ec-title">
                        Exam Categories
                    </h1>

                    <p class="ec-subtitle">
                        Keep your online exams organized with clear, reusable categories
                        for subjects, mock tests and competitive examinations.
                    </p>

                </div>

            </div>


            <a
                href="{{ route('exam-categories.create') }}"
                class="ec-create-btn"
            >
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Create Category
            </a>

        </div>

    </div>


    {{-- =========================================================
         SUCCESS
    ========================================================== --}}
    @if(session('success'))

        <div class="ec-alert">

            <div class="ec-alert-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <div>
                <p class="ec-alert-title">
                    {{ session('success') }}
                </p>

                <p class="ec-alert-text">
                    Your exam category has been saved successfully.
                </p>
            </div>

        </div>

    @endif


    {{-- =========================================================
         STATISTICS
    ========================================================== --}}
    <div class="ec-stats">

        {{-- TOTAL --}}
        <div class="ec-stat total">

            <div class="ec-stat-top">

                <div>
                    <p class="ec-stat-label">
                        Total Categories
                    </p>

                    <p class="ec-stat-number">
                        {{ $categories->count() }}
                    </p>

                    <p class="ec-stat-caption">
                        All created categories
                    </p>
                </div>

                <div class="ec-stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.7"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>

            </div>

        </div>


        {{-- ACTIVE --}}
        <div class="ec-stat active">

            <div class="ec-stat-top">

                <div>
                    <p class="ec-stat-label">
                        Active Categories
                    </p>

                    <p class="ec-stat-number">
                        {{ $categories->where('is_active', true)->count() }}
                    </p>

                    <p class="ec-stat-caption">
                        Ready for exam creation
                    </p>
                </div>

                <div class="ec-stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>

            </div>

        </div>


        {{-- INACTIVE --}}
        <div class="ec-stat inactive">

            <div class="ec-stat-top">

                <div>
                    <p class="ec-stat-label">
                        Inactive Categories
                    </p>

                    <p class="ec-stat-number">
                        {{ $categories->where('is_active', false)->count() }}
                    </p>

                    <p class="ec-stat-caption">
                        Currently unavailable
                    </p>
                </div>

                <div class="ec-stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.7"
                              d="M12 8v4m0 4h.01M10.3 3.5L2.8 17a2 2 0 001.75 3h14.9a2 2 0 001.75-3L13.7 3.5a2 2 0 00-3.4 0z"/>
                    </svg>
                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
         CATEGORY LIST
    ========================================================== --}}
    <div class="ec-list">

        <div class="ec-list-head">

            <div class="ec-list-heading">

                <div class="ec-list-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.7"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </div>

                <div>
                    <h2 class="ec-list-title">
                        All Categories
                    </h2>

                    <p class="ec-list-description">
                        Categories available while creating online exams.
                    </p>
                </div>

            </div>

            <span class="ec-count">
                {{ $categories->count() }}
                {{ $categories->count() === 1 ? 'Category' : 'Categories' }}
            </span>

        </div>


        @if($categories->count())

            {{-- =================================================
                 DESKTOP
            ================================================== --}}
            <div class="ec-desktop-list">

                @foreach($categories as $category)

                    <div class="ec-category">

                        {{-- NAME --}}
                        <div class="ec-category-main">

                            <div class="ec-avatar">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>

                            <div class="ec-category-info">

                                <div class="ec-category-name-row">

                                    <h3 class="ec-category-name">
                                        {{ $category->name }}
                                    </h3>

                                    @if($category->is_active)

                                        <span class="ec-status active">
                                            <span class="ec-status-dot"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="ec-status inactive">
                                            <span class="ec-status-dot"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </div>

                                <p class="ec-slug">
                                    /{{ $category->slug }}
                                </p>

                            </div>

                        </div>


                        {{-- DESCRIPTION --}}
                        <div class="ec-description">

                            <div class="ec-description-label">
                                Description
                            </div>

                            <p class="ec-description-text">
                                {{ $category->description ?: 'No description added for this category.' }}
                            </p>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="ec-actions">

                            <a
                                href="{{ route('exam-categories.edit', $category) }}"
                                class="ec-action edit"
                            >
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.7"
                                          d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4 16.464V20z"/>
                                </svg>
                                Edit
                            </a>


                            <form
                                method="POST"
                                action="{{ route('exam-categories.destroy', $category) }}"
                                onsubmit="return confirm('Are you sure you want to delete this category?');"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="ec-action delete"
                                >
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.7"
                                              d="M6 7h12m-9 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7m3 4v6m4-6v6"/>
                                    </svg>
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- =================================================
                 MOBILE
            ================================================== --}}
            <div class="ec-mobile-list">

                @foreach($categories as $category)

                    <div class="ec-mobile-card">

                        <div class="ec-mobile-card-inner">

                            <div class="ec-mobile-top">

                                <div class="ec-avatar">
                                    {{ strtoupper(substr($category->name, 0, 1)) }}
                                </div>

                                <div class="ec-mobile-info">

                                    <div class="ec-category-name-row">

                                        <h3 class="ec-category-name">
                                            {{ $category->name }}
                                        </h3>

                                    </div>

                                    <p class="ec-slug">
                                        /{{ $category->slug }}
                                    </p>

                                    <div class="ec-mobile-status">

                                        @if($category->is_active)

                                            <span class="ec-status active">
                                                <span class="ec-status-dot"></span>
                                                Active
                                            </span>

                                        @else

                                            <span class="ec-status inactive">
                                                <span class="ec-status-dot"></span>
                                                Inactive
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            <p class="ec-mobile-description">
                                {{ $category->description ?: 'No description added for this category.' }}
                            </p>


                            <div class="ec-mobile-actions">

                                <a
                                    href="{{ route('exam-categories.edit', $category) }}"
                                    class="ec-action edit"
                                >
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.7"
                                              d="M15.232 5.232l3.536 3.536M4 20h4l10.768-10.768a2.5 2.5 0 10-3.536-3.536L4 16.464V20z"/>
                                    </svg>
                                    Edit Category
                                </a>


                                <form
                                    method="POST"
                                    action="{{ route('exam-categories.destroy', $category) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="ec-action delete"
                                    >
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="1.7"
                                                  d="M6 7h12m-9 0V5a1 1 0 011-1h4a1 1 0 011 1v2m2 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7m3 4v6m4-6v6"/>
                                        </svg>
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


        @else

            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}
            <div class="ec-empty">

                <div class="ec-empty-icon">

                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.6"
                              d="M9 5h6m-7 4h8M7 13h10M7 17h6M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2z"/>
                    </svg>

                </div>

                <h3 class="ec-empty-title">
                    No exam categories yet
                </h3>

                <p class="ec-empty-text">
                    Create your first category to organize mock tests,
                    subjects, competitive exams and other online assessments.
                </p>

                <a
                    href="{{ route('exam-categories.create') }}"
                    class="ec-empty-btn"
                >
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>

                    Create First Category
                </a>

            </div>

        @endif

    </div>

</div>

</x-layouts::examination>
