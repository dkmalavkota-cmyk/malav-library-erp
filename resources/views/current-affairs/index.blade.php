<x-layouts::examination :title="'Current Affairs'">

<style>
/* =========================================================
   CURRENT AFFAIRS — PREMIUM V2
   ========================================================= */

.ca-page {
    --bg: #08090d;
    --panel: #101116;
    --panel-2: #14151c;
    --border: #292c37;
    --border-soft: #242731;

    --text: #f7f7fa;
    --muted: #858995;
    --dim: #5d616d;

    --purple: #8b5cf6;
    --indigo: #6366f1;
    --blue: #3b82f6;
    --green: #10b981;
    --yellow: #f59e0b;
    --red: #ef4444;

    min-height: 100vh;
    color: var(--text);

    background:
        radial-gradient(
            circle at 82% -8%,
            rgba(99,102,241,.17),
            transparent 430px
        ),
        radial-gradient(
            circle at 8% 25%,
            rgba(139,92,246,.07),
            transparent 360px
        ),
        var(--bg);

    font-family: inherit;
}

.ca-page *,
.ca-page *::before,
.ca-page *::after {
    box-sizing: border-box;
}

.ca-container {
    width: min(1380px, calc(100% - 42px));
    margin: 0 auto;
    padding: 30px 0 85px;
}

/* =========================================================
   HEADER
   ========================================================= */

.ca-header {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 25px;

    min-height: 145px;
    margin-bottom: 20px;
    padding: 28px 30px;

    overflow: hidden;

    border: 1px solid rgba(139,92,246,.22);
    border-radius: 24px;

    background:
        radial-gradient(
            circle at 100% 0%,
            rgba(99,102,241,.20),
            transparent 350px
        ),
        linear-gradient(
            135deg,
            #171821,
            #0d0e13
        );

    box-shadow:
        0 30px 90px rgba(0,0,0,.28),
        inset 0 1px 0 rgba(255,255,255,.035);
}

.ca-header::before {
    content: "";
    position: absolute;
    width: 270px;
    height: 270px;
    right: -135px;
    top: -155px;

    border-radius: 50%;
    background: rgba(139,92,246,.14);
    filter: blur(40px);

    pointer-events: none;
}

.ca-header-left {
    position: relative;
    z-index: 2;
}

.ca-eyebrow {
    display: flex;
    align-items: center;
    gap: 8px;

    margin-bottom: 10px;

    color: #a5b4fc;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .16em;
    text-transform: uppercase;
}

.ca-eyebrow-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;

    background: var(--purple);

    box-shadow:
        0 0 0 4px rgba(139,92,246,.08),
        0 0 16px rgba(139,92,246,.8);
}

.ca-title-row {
    display: flex;
    align-items: center;
    gap: 15px;
}

.ca-title-icon {
    width: 52px;
    height: 52px;
    flex: 0 0 52px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(139,92,246,.28);
    border-radius: 15px;

    background:
        linear-gradient(
            135deg,
            rgba(139,92,246,.16),
            rgba(99,102,241,.08)
        );

    color: #c4b5fd;

    box-shadow:
        0 10px 30px rgba(99,102,241,.10),
        inset 0 1px 0 rgba(255,255,255,.04);
}

.ca-title-icon svg {
    width: 25px;
    height: 25px;
}

.ca-title {
    margin: 0;

    color: #fff;
    font-size: 30px;
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -.045em;
}

.ca-subtitle {
    margin: 7px 0 0;

    color: #7f828e;
    font-size: 12px;
    line-height: 1.5;
}

.ca-create-btn {
    position: relative;
    z-index: 3;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    height: 45px;
    padding: 0 18px;

    border: 1px solid rgba(167,139,250,.65);
    border-radius: 12px;

    background:
        linear-gradient(
            135deg,
            #8b5cf6,
            #6366f1
        );

    color: #fff !important;

    text-decoration: none !important;

    font-size: 11px;
    font-weight: 750;

    box-shadow:
        0 12px 32px rgba(99,102,241,.22),
        inset 0 1px 0 rgba(255,255,255,.15);

    transition: .2s ease;
}

.ca-create-btn:hover {
    transform: translateY(-2px);

    box-shadow:
        0 18px 42px rgba(99,102,241,.34),
        inset 0 1px 0 rgba(255,255,255,.18);
}

.ca-create-btn svg {
    width: 16px;
    height: 16px;
}

/* =========================================================
   MONTH BAR
   ========================================================= */

.ca-month-card {
    position: relative;
    overflow: hidden;

    margin-bottom: 18px;
    padding: 20px 22px;

    border: 1px solid #292c35;
    border-radius: 19px;

    background:
        linear-gradient(
            145deg,
            rgba(18,19,25,.98),
            rgba(12,13,17,.98)
        );

    box-shadow:
        0 20px 60px rgba(0,0,0,.16),
        inset 0 1px 0 rgba(255,255,255,.02);
}

.ca-month-card::after {
    content: "";
    position: absolute;
    width: 200px;
    height: 200px;
    right: -120px;
    bottom: -150px;

    border-radius: 50%;
    background: rgba(99,102,241,.08);
    filter: blur(30px);

    pointer-events: none;
}

.ca-month-layout {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
}

.ca-month-label {
    color: #777b87;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .16em;
    text-transform: uppercase;
}

.ca-month-title {
    margin-top: 4px;

    color: #fff;
    font-size: 20px;
    font-weight: 800;
    letter-spacing: -.025em;
}

.ca-month-desc {
    margin-top: 4px;

    color: #5e626e;
    font-size: 9px;
}

.ca-month-actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

.ca-month-btn,
.ca-month-picker {
    height: 40px;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    border: 1px solid #30333d;
    border-radius: 11px;

    background: #0b0c10;
    color: #aeb1bb;

    font-size: 10px;
    font-weight: 700;

    text-decoration: none !important;

    transition: .2s ease;
}

.ca-month-btn {
    padding: 0 13px;
}

.ca-month-picker {
    width: 150px;
    padding: 0 10px;
    color-scheme: dark;
}

.ca-month-btn:hover,
.ca-month-picker:hover {
    border-color: #4a4d59;
    background: #13151b;
    color: #fff;
}

.ca-month-btn svg {
    width: 14px;
    height: 14px;
}

.ca-month-current {
    border-color: rgba(99,102,241,.25);
    background: rgba(99,102,241,.08);
    color: #a5b4fc;
}

/* =========================================================
   STATS
   ========================================================= */

.ca-stats {
    display: grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 12px;

    margin-bottom: 22px;
}

.ca-stat {
    position: relative;
    overflow: hidden;

    min-height: 115px;
    padding: 17px;

    border: 1px solid #292c35;
    border-radius: 17px;

    background:
        linear-gradient(
            145deg,
            rgba(18,19,25,.96),
            rgba(11,12,16,.96)
        );

    box-shadow:
        0 16px 45px rgba(0,0,0,.14),
        inset 0 1px 0 rgba(255,255,255,.02);

    transition: .2s ease;
}

.ca-stat:hover {
    transform: translateY(-2px);
    border-color: #373a46;
}

.ca-stat::after {
    content: "";
    position: absolute;
    width: 90px;
    height: 90px;
    right: -45px;
    bottom: -55px;

    border-radius: 50%;
    filter: blur(20px);
}

.ca-stat.total::after {
    background: rgba(139,92,246,.13);
}

.ca-stat.active::after {
    background: rgba(16,185,129,.12);
}

.ca-stat.upcoming::after {
    background: rgba(245,158,11,.11);
}

.ca-stat.completed::after {
    background: rgba(59,130,246,.11);
}

.ca-stat-top {
    position: relative;
    z-index: 2;

    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}

.ca-stat-label {
    color: #6d717d;
    font-size: 9px;
    font-weight: 700;
}

.ca-stat-value {
    margin-top: 9px;

    color: #f7f7fa;
    font-size: 27px;
    line-height: 1;
    font-weight: 800;
    letter-spacing: -.04em;
}

.ca-stat-icon {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    font-size: 13px;
    font-weight: 800;
}

.ca-stat.total .ca-stat-icon {
    background: rgba(139,92,246,.10);
    color: #c4b5fd;
}

.ca-stat.active .ca-stat-icon {
    background: rgba(16,185,129,.09);
    color: #6ee7b7;
}

.ca-stat.upcoming .ca-stat-icon {
    background: rgba(245,158,11,.09);
    color: #fcd34d;
}

.ca-stat.completed .ca-stat-icon {
    background: rgba(59,130,246,.09);
    color: #93c5fd;
}

.ca-stat-note {
    position: relative;
    z-index: 2;

    margin-top: 8px;

    color: #4f535e;
    font-size: 8px;
}

/* =========================================================
   SECTION HEADER
   ========================================================= */

.ca-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 20px;

    margin-bottom: 12px;
}

.ca-section-kicker {
    color: #818cf8;
    font-size: 8px;
    font-weight: 800;
    letter-spacing: .14em;
    text-transform: uppercase;
}

.ca-section-title {
    margin-top: 4px;

    color: #f4f4f5;
    font-size: 18px;
    font-weight: 800;
    letter-spacing: -.025em;
}

.ca-section-desc {
    margin-top: 3px;

    color: #5d616d;
    font-size: 9px;
}

.ca-count {
    color: #656975;
    font-size: 9px;
}

/* =========================================================
   TEST GRID
   ========================================================= */

.ca-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 15px;
}

.ca-test {
    position: relative;
    overflow: hidden;

    border: 1px solid #292c35;
    border-radius: 19px;

    background:
        linear-gradient(
            145deg,
            rgba(18,19,25,.98),
            rgba(11,12,16,.98)
        );

    box-shadow:
        0 18px 55px rgba(0,0,0,.16),
        inset 0 1px 0 rgba(255,255,255,.02);

    transition:
        transform .22s ease,
        border-color .22s ease,
        box-shadow .22s ease;
}

.ca-test:hover {
    transform: translateY(-3px);

    border-color: rgba(99,102,241,.32);

    box-shadow:
        0 25px 70px rgba(0,0,0,.25),
        0 0 45px rgba(99,102,241,.045),
        inset 0 1px 0 rgba(255,255,255,.025);
}

.ca-test::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;

    width: 100%;
    height: 2px;

    background:
        linear-gradient(
            90deg,
            transparent,
            rgba(139,92,246,.7),
            rgba(99,102,241,.45),
            transparent
        );

    opacity: .65;
}

.ca-test-glow {
    position: absolute;

    width: 180px;
    height: 180px;

    right: -120px;
    top: -120px;

    border-radius: 50%;

    background: rgba(99,102,241,.09);
    filter: blur(30px);

    pointer-events: none;
}

.ca-test-body {
    position: relative;
    z-index: 2;

    padding: 19px;
}

.ca-test-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
}

.ca-test-heading {
    min-width: 0;
}

.ca-test-badges {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;

    margin-bottom: 9px;
}

.ca-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    height: 22px;
    padding: 0 8px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;
}

.ca-badge.type {
    border: 1px solid rgba(139,92,246,.18);
    background: rgba(139,92,246,.07);
    color: #c4b5fd;
}

.ca-badge.active {
    background: rgba(16,185,129,.08);
    color: #34d399;
}

.ca-badge.upcoming {
    background: rgba(245,158,11,.08);
    color: #fbbf24;
}

.ca-badge.completed {
    background: rgba(100,116,139,.10);
    color: #94a3b8;
}

.ca-badge.draft {
    background: rgba(99,102,241,.08);
    color: #a5b4fc;
}

.ca-badge-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: currentColor;
}

.ca-test-title {
    margin: 0;

    color: #f5f5f7;
    font-size: 16px;
    line-height: 1.3;
    font-weight: 800;
    letter-spacing: -.025em;

    word-break: break-word;
}

.ca-test-description {
    margin-top: 6px;

    color: #646874;
    font-size: 9px;
    line-height: 1.6;
}

.ca-test-number {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(99,102,241,.18);
    border-radius: 12px;

    background:
        linear-gradient(
            145deg,
            rgba(99,102,241,.10),
            rgba(139,92,246,.04)
        );

    color: #a5b4fc;

    font-size: 10px;
    font-weight: 800;
}

/* =========================================================
   TEST METRICS
   ========================================================= */

.ca-metrics {
    display: grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 7px;

    margin-top: 17px;
}

.ca-metric {
    min-width: 0;
    padding: 10px;

    border: 1px solid #252832;
    border-radius: 11px;

    background: rgba(255,255,255,.012);
}

.ca-metric-label {
    color: #555965;
    font-size: 7px;
    font-weight: 750;
    letter-spacing: .06em;
    text-transform: uppercase;
}

.ca-metric-value {
    margin-top: 5px;

    overflow: hidden;
    color: #dfe0e5;

    font-size: 10px;
    font-weight: 800;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* =========================================================
   SCHEDULE
   ========================================================= */

.ca-schedule {
    display: grid;
    grid-template-columns: repeat(2,minmax(0,1fr));
    gap: 8px;

    margin-top: 10px;
}

.ca-schedule-item {
    display: flex;
    align-items: center;
    gap: 8px;

    padding: 10px;

    border: 1px solid #252832;
    border-radius: 11px;

    background: rgba(255,255,255,.008);
}

.ca-schedule-icon {
    width: 27px;
    height: 27px;
    flex: 0 0 27px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(99,102,241,.08);
    color: #a5b4fc;
}

.ca-schedule-icon svg {
    width: 13px;
    height: 13px;
}

.ca-schedule-label {
    color: #555965;
    font-size: 7px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
}

.ca-schedule-value {
    margin-top: 2px;

    color: #bfc1c8;
    font-size: 8px;
    font-weight: 700;
}

/* =========================================================
   CARD FOOTER
   ========================================================= */

.ca-test-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;

    margin-top: 15px;
    padding-top: 14px;

    border-top: 1px solid #242731;
}

.ca-actions {
    display: flex;
    align-items: center;
    gap: 7px;
}

.ca-action {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    height: 34px;
    padding: 0 11px;

    border: 1px solid #30333d;
    border-radius: 9px;

    background: #0b0c10;
    color: #9fa2ad !important;

    text-decoration: none !important;

    font-size: 8px;
    font-weight: 750;

    transition: .2s ease;
}

.ca-action:hover {
    border-color: #4a4d59;
    background: #15171d;
    color: #fff !important;
}

.ca-action.primary {
    border-color: rgba(99,102,241,.25);
    background: rgba(99,102,241,.08);
    color: #a5b4fc !important;
}

.ca-action.primary:hover {
    border-color: rgba(99,102,241,.45);
    background: rgba(99,102,241,.14);
}

.ca-action svg {
    width: 12px;
    height: 12px;
}

.ca-published {
    color: #50545f;
    font-size: 8px;
}

/* =========================================================
   EMPTY STATE
   ========================================================= */

.ca-empty {
    position: relative;
    overflow: hidden;

    padding: 65px 25px;

    border: 1px dashed #30333d;
    border-radius: 19px;

    background:
        radial-gradient(
            circle at 50% 0%,
            rgba(99,102,241,.07),
            transparent 280px
        ),
        rgba(255,255,255,.008);

    text-align: center;
}

.ca-empty-icon {
    width: 62px;
    height: 62px;
    margin: 0 auto;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(139,92,246,.22);
    border-radius: 17px;

    background: rgba(99,102,241,.07);
    color: #a5b4fc;

    box-shadow:
        0 15px 40px rgba(99,102,241,.08);
}

.ca-empty-icon svg {
    width: 27px;
    height: 27px;
}

.ca-empty-title {
    margin-top: 17px;

    color: #f1f1f3;
    font-size: 15px;
    font-weight: 800;
}

.ca-empty-text {
    max-width: 460px;
    margin: 7px auto 0;

    color: #5f636e;
    font-size: 9px;
    line-height: 1.65;
}

.ca-empty-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 7px;

    height: 39px;
    margin-top: 18px;
    padding: 0 15px;
    white-space: nowrap;

    border-radius: 10px;

    background: linear-gradient(135deg,#8b5cf6,#6366f1);
    color: #fff !important;

    text-decoration: none !important;

    font-size: 9px;
    font-weight: 800;

    box-shadow: 0 10px 28px rgba(99,102,241,.20);

    transition: .2s ease;
}

.ca-empty-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 35px rgba(99,102,241,.30);
}

/* =========================================================
   INFO
   ========================================================= */

.ca-info {
    display: flex;
    align-items: flex-start;
    gap: 12px;

    margin-top: 18px;
    padding: 15px;

    border: 1px solid rgba(99,102,241,.14);
    border-radius: 14px;

    background:
        linear-gradient(
            90deg,
            rgba(99,102,241,.045),
            rgba(99,102,241,.008)
        );
}

.ca-info-icon {
    width: 29px;
    height: 29px;
    flex: 0 0 29px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(99,102,241,.09);
    color: #a5b4fc;

    font-size: 10px;
    font-weight: 800;
}

.ca-info-title {
    color: #bfc1c8;
    font-size: 9px;
    font-weight: 750;
}

.ca-info-text {
    margin-top: 3px;

    color: #555965;
    font-size: 8px;
    line-height: 1.55;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1050px) {
    .ca-grid {
        grid-template-columns: 1fr;
    }

    .ca-stats {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }
}

@media (max-width: 760px) {
    .ca-container {
        width: calc(100% - 18px);
        padding-top: 18px;
        padding-bottom: 55px;
    }

    .ca-header {
        align-items: flex-start;
        flex-direction: column;
        padding: 21px;
        border-radius: 18px;
    }

    .ca-create-btn {
        width: 100%;
    }

    .ca-month-layout {
        align-items: flex-start;
        flex-direction: column;
    }

    .ca-month-actions {
        width: 100%;
        flex-wrap: wrap;
    }

    .ca-month-btn {
        flex: 1;
    }

    .ca-month-picker {
        flex: 1;
        width: auto;
    }

    .ca-stats {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

    .ca-metrics {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }

    .ca-schedule {
        grid-template-columns: 1fr;
    }

    .ca-test-footer {
        align-items: flex-start;
        flex-direction: column;
    }

    .ca-actions {
        width: 100%;
    }

    .ca-action {
        flex: 1;
    }
}

@media (max-width: 450px) {
    .ca-title {
        font-size: 24px;
    }

    .ca-title-icon {
        width: 45px;
        height: 45px;
        flex-basis: 45px;
    }

    .ca-stats {
        grid-template-columns: 1fr;
    }

    .ca-test-body {
        padding: 16px;
    }

    .ca-test-number {
        width: 36px;
        height: 36px;
        flex-basis: 36px;
    }
}
</style>


<div class="ca-page">

    <div class="ca-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="ca-header">

            <div class="ca-header-left">

                <div class="ca-eyebrow">
                    <span class="ca-eyebrow-dot"></span>
                    Online Examination
                </div>

                <div class="ca-title-row">

                    <div class="ca-title-icon">
                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.7">
                            <rect x="5"
                                  y="3"
                                  width="14"
                                  height="18"
                                  rx="2"/>
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                            <path d="M8 15h5"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="ca-title">
                            Current Affairs
                        </h1>

                        <p class="ca-subtitle">
                            Build, schedule and manage your monthly current affairs test series.
                        </p>
                    </div>

                </div>

            </div>


            <a href="{{ route('current-affairs.create') }}"
               class="ca-create-btn">

                <svg viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2">
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>

                Create Current Affairs Test

            </a>

        </header>


        {{-- =====================================================
             MONTH SELECTOR
        ====================================================== --}}

        @php
            $selectedMonth = request('month', now()->format('Y-m'));

            try {
                $selectedDate = \Carbon\Carbon::createFromFormat('Y-m', $selectedMonth);
            } catch (\Throwable $e) {
                $selectedDate = now()->startOfMonth();
                $selectedMonth = $selectedDate->format('Y-m');
            }

            $selectedMonthLabel = $selectedDate->format('F Y');
            $previousMonth = $selectedDate->copy()->subMonth()->format('Y-m');
            $nextMonth = $selectedDate->copy()->addMonth()->format('Y-m');
            $currentMonth = now()->format('Y-m');
        @endphp


        <section class="ca-month-card">

            <div class="ca-month-layout">

                <div>

                    <div class="ca-month-label">
                        Test Series Period
                    </div>

                    <div class="ca-month-title">
                        {{ $selectedMonthLabel }}
                    </div>

                    <div class="ca-month-desc">
                        All Current Affairs tests scheduled or created during this month.
                    </div>

                </div>


                <div class="ca-month-actions">

                    <a href="{{ route('current-affairs.index', ['month' => $previousMonth]) }}"
                       class="ca-month-btn">

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path d="m15 18-6-6 6-6"/>
                        </svg>

                        Previous

                    </a>


                    <form method="GET"
                          action="{{ route('current-affairs.index') }}">

                        <input type="month"
                               name="month"
                               value="{{ $selectedMonth }}"
                               onchange="this.form.submit()"
                               class="ca-month-picker">

                    </form>


                    <a href="{{ route('current-affairs.index', ['month' => $nextMonth]) }}"
                       class="ca-month-btn">

                        Next

                        <svg viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="1.8">
                            <path d="m9 18 6-6-6-6"/>
                        </svg>

                    </a>


                    @if ($selectedMonth !== $currentMonth)

                        <a href="{{ route('current-affairs.index') }}"
                           class="ca-month-btn ca-month-current">
                            This Month
                        </a>

                    @endif

                </div>

            </div>

        </section>


        {{-- =====================================================
             STATS
        ====================================================== --}}

        <section class="ca-stats">

            <div class="ca-stat total">

                <div class="ca-stat-top">

                    <div>
                        <div class="ca-stat-label">
                            Total Tests
                        </div>

                        <div class="ca-stat-value">
                            {{ $total ?? 0 }}
                        </div>
                    </div>

                    <div class="ca-stat-icon">
                        #
                    </div>

                </div>

                <div class="ca-stat-note">
                    Tests in selected month
                </div>

            </div>


            <div class="ca-stat active">

                <div class="ca-stat-top">

                    <div>
                        <div class="ca-stat-label">
                            Active
                        </div>

                        <div class="ca-stat-value">
                            {{ $active ?? 0 }}
                        </div>
                    </div>

                    <div class="ca-stat-icon">
                        ✓
                    </div>

                </div>

                <div class="ca-stat-note">
                    Currently available
                </div>

            </div>


            <div class="ca-stat upcoming">

                <div class="ca-stat-top">

                    <div>
                        <div class="ca-stat-label">
                            Upcoming
                        </div>

                        <div class="ca-stat-value">
                            {{ $upcoming ?? 0 }}
                        </div>
                    </div>

                    <div class="ca-stat-icon">
                        ◷
                    </div>

                </div>

                <div class="ca-stat-note">
                    Scheduled for later
                </div>

            </div>


            <div class="ca-stat completed">

                <div class="ca-stat-top">

                    <div>
                        <div class="ca-stat-label">
                            Completed
                        </div>

                        <div class="ca-stat-value">
                            {{ $completed ?? 0 }}
                        </div>
                    </div>

                    <div class="ca-stat-icon">
                        ✓
                    </div>

                </div>

                <div class="ca-stat-note">
                    Periods already finished
                </div>

            </div>

        </section>


        {{-- =====================================================
             TESTS
        ====================================================== --}}

        <div class="ca-section-head">

            <div>

                <div class="ca-section-kicker">
                    Monthly Test Series
                </div>

                <div class="ca-section-title">
                    {{ $selectedMonthLabel }} Tests
                </div>

                <div class="ca-section-desc">
                    Manage every Current Affairs examination created for this period.
                </div>

            </div>


            @if (isset($exams) && $exams->count())

                <div class="ca-count">
                    {{ $exams->count() }}
                    test{{ $exams->count() === 1 ? '' : 's' }}
                </div>

            @endif

        </div>


        @if (isset($exams) && $exams->count())

            <div class="ca-grid">

                @foreach ($exams as $index => $exam)

                    @php

                        $now = now();

                        $isUpcoming = $exam->starts_at &&
                                      $exam->starts_at->gt($now);

                        $isCompleted = $exam->ends_at &&
                                       $exam->ends_at->lt($now);

                        if ($isCompleted) {
                            $status = 'completed';
                            $statusLabel = 'Completed';
                        } elseif ($isUpcoming) {
                            $status = 'upcoming';
                            $statusLabel = 'Upcoming';
                        } elseif ($exam->is_active && $exam->is_published) {
                            $status = 'active';
                            $statusLabel = 'Active';
                        } else {
                            $status = 'draft';
                            $statusLabel = 'Draft';
                        }

                        $questionCount = 0;

                        try {
                            $questionCount = $exam->questions()->count();
                        } catch (\Throwable $e) {
                            $questionCount = 0;
                        }

                        $testNumber = str_pad($index + 1, 2, '0', STR_PAD_LEFT);

                    @endphp


                    <article class="ca-test">

                        <div class="ca-test-glow"></div>

                        <div class="ca-test-body">

                            {{-- HEADER --}}

                            <div class="ca-test-head">

                                <div class="ca-test-heading">

                                    <div class="ca-test-badges">

                                        <span class="ca-badge type">
                                            Current Affairs
                                        </span>

                                        <span class="ca-badge {{ $status }}">

                                            <span class="ca-badge-dot"></span>

                                            {{ $statusLabel }}

                                        </span>

                                    </div>


                                    <h3 class="ca-test-title">
                                        {{ $exam->title }}
                                    </h3>


                                    @if ($exam->description)

                                        <p class="ca-test-description">
                                            {{ $exam->description }}
                                        </p>

                                    @endif

                                </div>


                                <div class="ca-test-number">
                                    {{ $testNumber }}
                                </div>

                            </div>


                            {{-- METRICS --}}

                            <div class="ca-metrics">

                                <div class="ca-metric">

                                    <div class="ca-metric-label">
                                        Questions
                                    </div>

                                    <div class="ca-metric-value">
                                        {{ $questionCount }}
                                    </div>

                                </div>


                                <div class="ca-metric">

                                    <div class="ca-metric-label">
                                        Marks
                                    </div>

                                    <div class="ca-metric-value">
                                        {{ $exam->total_marks }}
                                    </div>

                                </div>


                                <div class="ca-metric">

                                    <div class="ca-metric-label">
                                        Duration
                                    </div>

                                    <div class="ca-metric-value">
                                        {{ $exam->duration_minutes }} min
                                    </div>

                                </div>


                                <div class="ca-metric">

                                    <div class="ca-metric-label">
                                        Attempts
                                    </div>

                                    <div class="ca-metric-value">
                                        {{ $exam->attempt_limit ?? 1 }}
                                    </div>

                                </div>

                            </div>


                            {{-- SCHEDULE --}}

                            <div class="ca-schedule">

                                <div class="ca-schedule-item">

                                    <div class="ca-schedule-icon">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <rect x="3"
                                                  y="4"
                                                  width="18"
                                                  height="17"
                                                  rx="2"/>
                                            <path d="M16 2v4"/>
                                            <path d="M8 2v4"/>
                                            <path d="M3 10h18"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <div class="ca-schedule-label">
                                            Starts
                                        </div>

                                        <div class="ca-schedule-value">

                                            @if ($exam->starts_at)
                                                {{ $exam->starts_at->format('d M Y, h:i A') }}
                                            @else
                                                Anytime
                                            @endif

                                        </div>

                                    </div>

                                </div>


                                <div class="ca-schedule-item">

                                    <div class="ca-schedule-icon">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <circle cx="12"
                                                    cy="12"
                                                    r="9"/>
                                            <path d="M12 7v5l3 2"/>
                                        </svg>

                                    </div>

                                    <div>

                                        <div class="ca-schedule-label">
                                            Ends
                                        </div>

                                        <div class="ca-schedule-value">

                                            @if ($exam->ends_at)
                                                {{ $exam->ends_at->format('d M Y, h:i A') }}
                                            @else
                                                No expiry
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- FOOTER --}}

                            <div class="ca-test-footer">

                                <div class="ca-published">

                                    @if ($exam->is_published)
                                        Published examination
                                    @else
                                        Draft examination
                                    @endif

                                </div>


                                <div class="ca-actions">

                                    <a href="{{ route('current-affairs.show', $exam) }}"
                                       class="ca-action primary">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6z"/>
                                            <circle cx="12"
                                                    cy="12"
                                                    r="2.5"/>
                                        </svg>

                                        View

                                    </a>


                                    <a href="{{ route('current-affairs.edit', $exam) }}"
                                       class="ca-action">

                                        <svg viewBox="0 0 24 24"
                                             fill="none"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z"/>
                                        </svg>

                                        Edit

                                    </a>

                                </div>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- EMPTY STATE --}}

            <div class="ca-empty">

                <div class="ca-empty-icon">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="1.7">
                        <rect x="5"
                              y="3"
                              width="14"
                              height="18"
                              rx="2"/>
                        <path d="M8 7h8"/>
                        <path d="M8 11h8"/>
                        <path d="M8 15h5"/>
                    </svg>

                </div>


                <div class="ca-empty-title">
                    No Current Affairs Tests
                </div>


                <p class="ca-empty-text">
                    There are no Current Affairs examinations for
                    {{ $selectedMonthLabel }} yet. Create your first test
                    and start building the monthly test series.
                </p>


                <a href="{{ route('current-affairs.create') }}"
                   class="ca-empty-btn">

                    <svg viewBox="0 0 24 24"
                         fill="none"
                         stroke="currentColor"
                         stroke-width="2">
                        <path d="M12 5v14"/>
                        <path d="M5 12h14"/>
                    </svg>

                    Create First Test

                </a>

            </div>

        @endif


        {{-- =====================================================
             INFO
        ====================================================== --}}

        <div class="ca-info">

            <div class="ca-info-icon">
                i
            </div>

            <div>

                <div class="ca-info-title">
                    Flexible Current Affairs Test Series
                </div>

                <div class="ca-info-text">
                    You can create any number of Current Affairs tests in a month.
                    The system automatically groups them by their schedule, so
                    Test 01, Test 02 or additional tests can be created without
                    any hard-coded monthly limit.
                </div>

            </div>

        </div>

    </div>

</div>

</x-layouts::examination>