<x-layouts::examination :title="'Create Exam'">

<style>
/* =========================================================
   PREMIUM CREATE EXAM — V2
   ========================================================= */

.ce-page {
    --bg: #08090d;
    --panel: #101116;
    --panel-2: #14151c;
    --panel-3: #0c0d12;
    --border: #272936;
    --border-hover: #3a3d4b;

    --text: #f7f7fa;
    --muted: #8b8e9b;
    --dim: #5e6270;

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
            circle at 78% -10%,
            rgba(99,102,241,.18),
            transparent 430px
        ),
        radial-gradient(
            circle at 12% 25%,
            rgba(139,92,246,.07),
            transparent 350px
        ),
        var(--bg);

    font-family: inherit;
}

.ce-page *,
.ce-page *::before,
.ce-page *::after {
    box-sizing: border-box;
}

/* =========================================================
   CONTAINER
   ========================================================= */

.ce-container {
    width: min(1380px, calc(100% - 42px));
    margin: 0 auto;
    padding: 30px 0 90px;
}

/* =========================================================
   TOP HEADER
   ========================================================= */

.ce-header {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;

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
            transparent 340px
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

.ce-header::before {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    right: -130px;
    top: -150px;

    border-radius: 50%;

    background: rgba(139,92,246,.13);
    filter: blur(40px);

    pointer-events: none;
}

.ce-header-left {
    position: relative;
    z-index: 2;
}

.ce-eyebrow {
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

.ce-eyebrow-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: var(--purple);

    box-shadow:
        0 0 0 4px rgba(139,92,246,.08),
        0 0 16px rgba(139,92,246,.8);
}

.ce-title-row {
    display: flex;
    align-items: center;
    gap: 15px;
}

.ce-title-icon {
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

.ce-title-icon svg {
    width: 24px;
    height: 24px;
}

.ce-title {
    margin: 0;

    color: #fff;
    font-size: 30px;
    line-height: 1.1;
    font-weight: 800;
    letter-spacing: -.045em;
}

.ce-subtitle {
    margin: 7px 0 0;

    color: #7f828e;
    font-size: 12px;
    line-height: 1.5;
}

.ce-back {
    position: relative;
    z-index: 3;

    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    height: 43px;
    padding: 0 17px;

    border: 1px solid #30323d;
    border-radius: 12px;

    background: rgba(7,8,11,.75);
    color: #d4d4d8 !important;

    text-decoration: none !important;

    font-size: 11px;
    font-weight: 700;

    transition: .2s ease;
}

.ce-back:hover {
    transform: translateY(-2px);

    border-color: #6366f1;

    background: rgba(99,102,241,.08);

    color: #fff !important;

    box-shadow:
        0 10px 25px rgba(0,0,0,.25);
}

.ce-back svg {
    width: 16px;
    height: 16px;
}

/* =========================================================
   PROGRESS
   ========================================================= */

.ce-progress {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;

    margin-bottom: 22px;
    padding: 10px;

    border: 1px solid #252731;
    border-radius: 17px;

    background: rgba(16,17,22,.72);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.025);
}

.ce-progress-item {
    display: flex;
    align-items: center;
    gap: 10px;

    min-width: 0;
    padding: 10px 12px;

    border-radius: 11px;

    color: #676b78;

    transition: .2s ease;
}

.ce-progress-item.active {
    background: rgba(99,102,241,.09);
    color: #c7d2fe;
}

.ce-progress-number {
    width: 27px;
    height: 27px;
    flex: 0 0 27px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid #2e313d;
    border-radius: 8px;

    font-size: 9px;
    font-weight: 800;
}

.ce-progress-item.active .ce-progress-number {
    border-color: rgba(129,140,248,.35);
    background: rgba(99,102,241,.13);
    color: #a5b4fc;
}

.ce-progress-text {
    min-width: 0;
}

.ce-progress-title {
    display: block;

    font-size: 10px;
    font-weight: 750;
    white-space: nowrap;
}

.ce-progress-desc {
    display: block;

    margin-top: 2px;

    color: #50535e;
    font-size: 8px;
}

/* =========================================================
   MAIN LAYOUT
   ========================================================= */

.ce-layout {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 330px;
    gap: 20px;

    align-items: start;
}

.ce-main {
    min-width: 0;
}

/* =========================================================
   SIDEBAR
   ========================================================= */

.ce-sidebar {
    position: sticky;
    top: 20px;

    min-width: 0;
}

.ce-preview-card {
    overflow: hidden;

    border: 1px solid #292c37;
    border-radius: 20px;

    background:
        linear-gradient(
            145deg,
            #13151c,
            #0c0d12
        );

    box-shadow:
        0 25px 70px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.025);
}

.ce-preview-head {
    padding: 18px 19px;

    border-bottom: 1px solid #252832;
}

.ce-preview-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.ce-preview-title {
    margin: 0;

    color: #f4f4f5;
    font-size: 13px;
    font-weight: 750;
}

.ce-preview-live {
    display: inline-flex;
    align-items: center;
    gap: 5px;

    padding: 5px 8px;

    border-radius: 999px;

    background: rgba(16,185,129,.08);
    color: #34d399;

    font-size: 8px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: .05em;
}

.ce-preview-live-dot {
    width: 5px;
    height: 5px;
    border-radius: 50%;
    background: #10b981;
}

.ce-preview-body {
    padding: 18px;
}

.ce-preview-name {
    min-height: 50px;

    color: #fff;
    font-size: 17px;
    line-height: 1.3;
    font-weight: 800;
    letter-spacing: -.025em;
    word-break: break-word;
}

.ce-preview-category {
    display: inline-flex;
    align-items: center;

    margin-top: 9px;
    padding: 5px 9px;

    border: 1px solid rgba(99,102,241,.16);
    border-radius: 999px;

    background: rgba(99,102,241,.08);
    color: #a5b4fc;

    font-size: 9px;
    font-weight: 700;
}

.ce-preview-description {
    margin: 13px 0 0;

    color: #666a76;
    font-size: 10px;
    line-height: 1.6;
}

.ce-preview-stats {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 8px;

    margin-top: 17px;
}

.ce-preview-stat {
    padding: 12px;

    border: 1px solid #252832;
    border-radius: 12px;

    background: rgba(255,255,255,.012);
}

.ce-preview-stat-label {
    color: #5d616d;
    font-size: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
}

.ce-preview-stat-value {
    margin-top: 5px;

    color: #e9e9ed;
    font-size: 13px;
    font-weight: 800;
}

.ce-preview-footer {
    margin-top: 15px;
    padding-top: 15px;

    border-top: 1px solid #242731;
}

.ce-preview-status {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-bottom: 9px;
}

.ce-preview-status-label {
    color: #666a76;
    font-size: 9px;
}

.ce-status-badge {
    padding: 5px 8px;

    border-radius: 999px;

    background: rgba(16,185,129,.08);
    color: #34d399;

    font-size: 8px;
    font-weight: 800;
}

.ce-preview-tip {
    padding: 11px;

    border: 1px solid rgba(99,102,241,.13);
    border-radius: 11px;

    background: rgba(99,102,241,.035);

    color: #686c78;
    font-size: 9px;
    line-height: 1.55;
}

.ce-preview-tip strong {
    color: #a5b4fc;
}

/* =========================================================
   FORM CARDS
   ========================================================= */

.ce-card {
    margin-bottom: 18px;
    overflow: hidden;

    border: 1px solid #292c35;
    border-radius: 19px;

    background:
        linear-gradient(
            145deg,
            rgba(18,19,25,.98),
            rgba(12,13,17,.98)
        );

    box-shadow:
        0 20px 60px rgba(0,0,0,.17),
        inset 0 1px 0 rgba(255,255,255,.02);

    transition:
        border-color .2s ease,
        box-shadow .2s ease;
}

.ce-card:hover {
    border-color: #343743;

    box-shadow:
        0 25px 70px rgba(0,0,0,.22),
        inset 0 1px 0 rgba(255,255,255,.025);
}

.ce-card-header {
    display: flex;
    align-items: center;
    gap: 13px;

    padding: 20px 22px;

    border-bottom: 1px solid #252831;

    background:
        linear-gradient(
            90deg,
            rgba(255,255,255,.018),
            transparent
        );
}

.ce-section-number {
    width: 39px;
    height: 39px;
    flex: 0 0 39px;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 1px solid rgba(139,92,246,.25);
    border-radius: 11px;

    background: rgba(99,102,241,.09);
    color: #a5b4fc;

    font-size: 10px;
    font-weight: 800;
}

.ce-section-number.green {
    border-color: rgba(16,185,129,.22);
    background: rgba(16,185,129,.07);
    color: #6ee7b7;
}

.ce-section-number.blue {
    border-color: rgba(59,130,246,.22);
    background: rgba(59,130,246,.07);
    color: #93c5fd;
}

.ce-section-number.purple {
    border-color: rgba(168,85,247,.22);
    background: rgba(168,85,247,.07);
    color: #d8b4fe;
}

.ce-card-heading {
    min-width: 0;
}

.ce-card-title {
    margin: 0;

    color: #f4f4f5;
    font-size: 14px;
    font-weight: 750;
    letter-spacing: -.015em;
}

.ce-card-description {
    margin: 4px 0 0;

    color: #656975;
    font-size: 10px;
    line-height: 1.45;
}

.ce-card-body {
    padding: 22px;
}

/* =========================================================
   FORM
   ========================================================= */

.ce-group {
    margin-bottom: 19px;
}

.ce-group:last-child {
    margin-bottom: 0;
}

.ce-label-row {
    display: flex;
    align-items: center;
    justify-content: space-between;

    gap: 10px;
    margin-bottom: 8px;
}

.ce-label {
    display: block;

    color: #dedfe4;
    font-size: 11px;
    font-weight: 700;
}

.ce-required {
    color: #818cf8;
    font-size: 8px;
    font-weight: 700;
}

.ce-optional {
    color: #555964;
    font-size: 8px;
    font-weight: 600;
}

.ce-input {
    width: 100% !important;
    margin: 0 !important;

    border: 1px solid #30333d !important;
    border-radius: 12px !important;

    background: #0b0c11 !important;
    color: #f4f4f5 !important;

    outline: none !important;

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.018) !important;

    font-family: inherit !important;
    font-size: 11px !important;

    transition:
        border-color .2s ease,
        background .2s ease,
        box-shadow .2s ease !important;
}

.ce-page input.ce-input,
.ce-page select.ce-input {
    height: 45px !important;
    padding: 0 13px !important;
}

.ce-page textarea.ce-input {
    min-height: 105px !important;
    padding: 12px 13px !important;

    resize: vertical !important;
    line-height: 1.55 !important;
}

.ce-input:hover {
    border-color: #414550 !important;
    background: #0e0f14 !important;
}

.ce-input:focus {
    border-color: #6366f1 !important;

    background: #0c0d12 !important;

    box-shadow:
        0 0 0 3px rgba(99,102,241,.09),
        0 8px 25px rgba(0,0,0,.18) !important;
}

.ce-input::placeholder {
    color: #484c57 !important;
    opacity: 1 !important;
}

.ce-helper {
    margin: 7px 0 0;

    color: #555965;
    font-size: 9px;
    line-height: 1.5;
}

.ce-select-wrap {
    position: relative;
}

.ce-select-wrap select {
    appearance: none !important;
    -webkit-appearance: none !important;
    cursor: pointer !important;

    padding-right: 40px !important;
}

.ce-select-arrow {
    position: absolute;

    top: 50%;
    right: 13px;

    width: 15px;
    height: 15px;

    transform: translateY(-50%);

    color: #686c77;
    pointer-events: none;
}

.ce-no-category {
    margin-top: 9px;
    padding: 10px 12px;

    border: 1px solid rgba(245,158,11,.18);
    border-radius: 10px;

    background: rgba(245,158,11,.045);
    color: #fbbf24;

    font-size: 9px;
}

/* =========================================================
   BASIC INFO GRID
   ========================================================= */

.ce-basic-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 320px;
    gap: 16px;
}

.ce-basic-left,
.ce-basic-right {
    min-width: 0;
}

/* =========================================================
   SETTINGS
   ========================================================= */

.ce-settings-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0,1fr));
    gap: 11px;
}

.ce-setting-box {
    position: relative;

    padding: 13px;

    border: 1px solid #282b34;
    border-radius: 13px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.015),
            rgba(255,255,255,.005)
        );

    transition: .2s ease;
}

.ce-setting-box:hover {
    border-color: #3a3d48;
    background: rgba(255,255,255,.02);
}

.ce-setting-icon {
    width: 27px;
    height: 27px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 10px;

    border-radius: 8px;

    background: rgba(99,102,241,.08);
    color: #a5b4fc;

    font-size: 10px;
    font-weight: 800;
}

.ce-setting-box.green .ce-setting-icon {
    background: rgba(16,185,129,.08);
    color: #6ee7b7;
}

.ce-setting-box.yellow .ce-setting-icon {
    background: rgba(245,158,11,.08);
    color: #fcd34d;
}

.ce-setting-box.blue .ce-setting-icon {
    background: rgba(59,130,246,.08);
    color: #93c5fd;
}

.ce-number-wrap {
    position: relative;
}

.ce-number-wrap .ce-input {
    padding-right: 42px !important;
}

.ce-number-suffix {
    position: absolute;

    top: 50%;
    right: 12px;

    transform: translateY(-50%);

    color: #5d616d;
    font-size: 8px;
    font-weight: 800;

    pointer-events: none;
}

/* =========================================================
   NEGATIVE MARKING
   ========================================================= */

.ce-negative {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    margin-top: 15px;
    padding: 15px;

    border: 1px solid rgba(245,158,11,.16);
    border-radius: 14px;

    background:
        linear-gradient(
            135deg,
            rgba(245,158,11,.045),
            rgba(12,13,17,.9)
        );
}

.ce-check-label {
    display: flex;
    align-items: flex-start;
    gap: 10px;

    cursor: pointer;
}

.ce-check-label input[type="checkbox"],
.ce-publish-option input[type="checkbox"] {
    width: 17px !important;
    height: 17px !important;
    flex: 0 0 17px;

    margin: 2px 0 0 !important;

    accent-color: #6366f1;

    cursor: pointer;
}

.ce-check-title {
    display: block;

    color: #e4e4e7;
    font-size: 11px;
    font-weight: 700;
}

.ce-check-text {
    display: block;

    margin-top: 3px;

    color: #5a5e69;
    font-size: 9px;
    line-height: 1.5;
}

.ce-negative-value {
    width: 180px;
    flex: 0 0 180px;
}

.ce-small-label {
    display: block;

    margin-bottom: 7px;

    color: #777b87;
    font-size: 8px;
    font-weight: 750;
    text-transform: uppercase;
    letter-spacing: .05em;
}

/* =========================================================
   INFO STRIP
   ========================================================= */

.ce-info-strip {
    display: flex;
    align-items: center;
    gap: 10px;

    margin-top: 15px;
    padding: 11px 13px;

    border: 1px solid rgba(99,102,241,.15);
    border-radius: 11px;

    background:
        linear-gradient(
            90deg,
            rgba(99,102,241,.055),
            rgba(99,102,241,.012)
        );
}

.ce-info-icon {
    width: 26px;
    height: 26px;
    flex: 0 0 26px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 7px;

    background: rgba(99,102,241,.09);
    color: #a5b4fc;

    font-size: 10px;
    font-weight: 800;
}

.ce-info-text {
    margin: 0;

    color: #696d79;
    font-size: 9px;
    line-height: 1.5;
}

.ce-info-text strong {
    color: #a5b4fc;
}

/* =========================================================
   SCHEDULE
   ========================================================= */

.ce-schedule-grid {
    display: grid;
    grid-template-columns: repeat(2,minmax(0,1fr));
    gap: 13px;
}

.ce-schedule-box {
    padding: 15px;

    border: 1px solid #282b34;
    border-radius: 14px;

    background: rgba(255,255,255,.012);
}

.ce-schedule-heading {
    display: flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 13px;
}

.ce-schedule-icon {
    width: 30px;
    height: 30px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(59,130,246,.08);
    color: #93c5fd;
}

.ce-schedule-heading strong {
    display: block;

    color: #e4e4e7;
    font-size: 10px;
    font-weight: 750;
}

.ce-schedule-heading span {
    display: block;

    margin-top: 2px;

    color: #555965;
    font-size: 8px;
}

/* =========================================================
   PUBLISHING
   ========================================================= */

.ce-publish-grid {
    display: grid;
    grid-template-columns: repeat(2,minmax(0,1fr));
    gap: 13px;
}

.ce-publish-option {
    position: relative;

    display: flex;
    align-items: flex-start;
    gap: 10px;

    min-height: 100px;
    padding: 15px;

    border: 1px solid #292c35;
    border-radius: 14px;

    background:
        linear-gradient(
            145deg,
            #111219,
            #0c0d12
        );

    cursor: pointer;

    transition: .2s ease;
}

.ce-publish-option:hover {
    transform: translateY(-2px);

    border-color: #40434e;

    box-shadow:
        0 12px 30px rgba(0,0,0,.2);
}

.ce-publish-option:has(input:checked) {
    border-color: rgba(99,102,241,.40);

    background:
        linear-gradient(
            145deg,
            rgba(99,102,241,.075),
            rgba(12,13,18,.98)
        );
}

.ce-option-heading {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 7px;
}

.ce-option-title {
    color: #f4f4f5;
    font-size: 11px;
    font-weight: 750;
}

.ce-badge {
    display: inline-flex;
    align-items: center;

    height: 19px;
    padding: 0 7px;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 800;
}

.ce-badge.green {
    background: rgba(16,185,129,.09);
    color: #34d399;
}

.ce-badge.gray {
    background: #1d1f26;
    color: #777b86;
}

.ce-option-description {
    display: block;

    margin-top: 6px;

    color: #555965;
    font-size: 9px;
    line-height: 1.55;
}

/* =========================================================
   ERROR
   ========================================================= */

.ce-error {
    display: flex;
    gap: 12px;

    margin-bottom: 18px;
    padding: 13px 15px;

    border: 1px solid rgba(239,68,68,.22);
    border-radius: 13px;

    background: rgba(239,68,68,.045);
}

.ce-error-icon {
    width: 29px;
    height: 29px;
    flex: 0 0 29px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(239,68,68,.10);
    color: #f87171;

    font-size: 11px;
    font-weight: 800;
}

.ce-error-title {
    margin: 0 0 4px;

    color: #fca5a5;
    font-size: 10px;
    font-weight: 750;
}

.ce-error ul {
    margin: 0;
    padding-left: 15px;

    color: #f87171;
    font-size: 9px;
    line-height: 1.65;
}

/* =========================================================
   ACTION BAR
   ========================================================= */

.ce-actions {
    position: sticky;
    bottom: 14px;
    z-index: 30;

    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;

    margin-top: 5px;
    padding: 12px;

    border: 1px solid #30333d;
    border-radius: 17px;

    background:
        linear-gradient(
            135deg,
            rgba(21,22,29,.95),
            rgba(11,12,16,.95)
        );

    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);

    box-shadow:
        0 25px 70px rgba(0,0,0,.40),
        inset 0 1px 0 rgba(255,255,255,.03);
}

.ce-actions-copy {
    padding-left: 5px;
}

.ce-actions-title {
    margin: 0;

    color: #d4d4d8;
    font-size: 10px;
    font-weight: 700;
}

.ce-actions-text {
    margin: 3px 0 0;

    color: #555965;
    font-size: 8px;
}

.ce-action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}

.ce-cancel,
.ce-submit {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 7px !important;

    height: 43px !important;
    padding: 0 17px !important;

    margin: 0 !important;

    border-radius: 11px !important;

    font-family: inherit !important;
    font-size: 10px !important;
    font-weight: 750 !important;

    text-decoration: none !important;

    cursor: pointer !important;

    transition: .2s ease !important;
}

.ce-cancel {
    min-width: 95px !important;

    border: 1px solid #30333d !important;

    background: #0b0c10 !important;

    color: #9b9eaa !important;
}

.ce-cancel:hover {
    border-color: #484b56 !important;
    background: #17181e !important;
    color: #fff !important;
}

.ce-submit {
    min-width: 140px !important;

    border: 1px solid rgba(167,139,250,.65) !important;

    background:
        linear-gradient(
            135deg,
            #8b5cf6,
            #6366f1
        ) !important;

    color: #fff !important;

    box-shadow:
        0 10px 30px rgba(99,102,241,.22),
        inset 0 1px 0 rgba(255,255,255,.15) !important;
}

.ce-submit:hover {
    transform: translateY(-2px) !important;

    box-shadow:
        0 15px 38px rgba(99,102,241,.34),
        inset 0 1px 0 rgba(255,255,255,.18) !important;
}

.ce-submit svg,
.ce-cancel svg,
.ce-back svg {
    flex: 0 0 auto;
}

/* =========================================================
   CHARACTER COUNT
   ========================================================= */

.ce-description-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;

    margin-top: 6px;
}

.ce-description-meta .ce-helper {
    margin: 0;
}

.ce-counter {
    color: #4e525d;
    font-size: 8px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 1120px) {

    .ce-layout {
        grid-template-columns: minmax(0,1fr) 285px;
    }

    .ce-basic-grid {
        grid-template-columns: 1fr;
    }

    .ce-settings-grid {
        grid-template-columns: repeat(2,minmax(0,1fr));
    }
}

@media (max-width: 900px) {

    .ce-container {
        width: min(100% - 28px, 760px);
    }

    .ce-layout {
        grid-template-columns: 1fr;
    }

    .ce-sidebar {
        position: static;
        order: -1;
    }

    .ce-preview-card {
        margin-bottom: 18px;
    }

    .ce-progress-desc {
        display: none;
    }
}

@media (max-width: 720px) {

    .ce-container {
        width: calc(100% - 18px);
        padding-top: 18px;
        padding-bottom: 55px;
    }

    .ce-header {
        align-items: flex-start;
        flex-direction: column;

        padding: 21px;

        border-radius: 18px;
    }

    .ce-title {
        font-size: 25px;
    }

    .ce-title-icon {
        width: 45px;
        height: 45px;
        flex-basis: 45px;
    }

    .ce-back {
        width: 100%;
    }

    .ce-progress {
        grid-template-columns: repeat(2,1fr);
    }

    .ce-card {
        border-radius: 15px;
    }

    .ce-card-header {
        padding: 17px;
    }

    .ce-card-body {
        padding: 17px;
    }

    .ce-settings-grid,
    .ce-schedule-grid,
    .ce-publish-grid {
        grid-template-columns: 1fr;
    }

    .ce-negative {
        align-items: flex-start;
        flex-direction: column;
    }

    .ce-negative-value {
        width: 100%;
        flex-basis: auto;
    }

    .ce-actions {
        align-items: stretch;
        flex-direction: column;
        gap: 9px;
        bottom: 7px;
    }

    .ce-actions-copy {
        display: none;
    }

    .ce-action-buttons {
        width: 100%;
    }

    .ce-cancel,
    .ce-submit {
        flex: 1;
    }
}

@media (max-width: 420px) {

    .ce-progress-title {
        font-size: 9px;
    }

    .ce-title {
        font-size: 22px;
    }

    .ce-title-row {
        align-items: flex-start;
    }

    .ce-section-number {
        width: 34px;
        height: 34px;
        flex-basis: 34px;
    }
}
</style>


<div class="ce-page">

    <div class="ce-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header class="ce-header">

            <div class="ce-header-left">

                <div class="ce-eyebrow">
                    <span class="ce-eyebrow-dot"></span>
                    Online Examination
                </div>

                <div class="ce-title-row">

                    <div class="ce-title-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <rect
                                x="5"
                                y="3"
                                width="14"
                                height="18"
                                rx="2"
                            />
                            <path d="M8 7h8"/>
                            <path d="M8 11h8"/>
                            <path d="M8 15h5"/>
                        </svg>

                    </div>

                    <div>

                        <h1 class="ce-title">
                            Create Exam
                        </h1>

                        <p class="ce-subtitle">
                            Build your examination, configure rules and prepare it for your students.
                        </p>

                    </div>

                </div>

            </div>


            <a
                href="{{ route('exams.index') }}"
                class="ce-back"
            >

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path d="M19 12H5"/>
                    <path d="M12 19l-7-7 7-7"/>
                </svg>

                Back to Exams

            </a>

        </header>


        {{-- =====================================================
             PROGRESS
        ====================================================== --}}

        <div class="ce-progress">

            <div class="ce-progress-item active">

                <span class="ce-progress-number">
                    01
                </span>

                <span class="ce-progress-text">
                    <span class="ce-progress-title">
                        Basic Information
                    </span>
                    <span class="ce-progress-desc">
                        Identity & category
                    </span>
                </span>

            </div>


            <div class="ce-progress-item active">

                <span class="ce-progress-number">
                    02
                </span>

                <span class="ce-progress-text">
                    <span class="ce-progress-title">
                        Exam Settings
                    </span>
                    <span class="ce-progress-desc">
                        Marks & attempts
                    </span>
                </span>

            </div>


            <div class="ce-progress-item active">

                <span class="ce-progress-number">
                    03
                </span>

                <span class="ce-progress-text">
                    <span class="ce-progress-title">
                        Schedule
                    </span>
                    <span class="ce-progress-desc">
                        Access timing
                    </span>
                </span>

            </div>


            <div class="ce-progress-item active">

                <span class="ce-progress-number">
                    04
                </span>

                <span class="ce-progress-text">
                    <span class="ce-progress-title">
                        Publishing
                    </span>
                    <span class="ce-progress-desc">
                        Availability
                    </span>
                </span>

            </div>

        </div>


        {{-- =====================================================
             ERRORS
        ====================================================== --}}

        @if ($errors->any())

            <div class="ce-error">

                <div class="ce-error-icon">
                    !
                </div>

                <div>

                    <p class="ce-error-title">
                        Please check the following details
                    </p>

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        @endif


        {{-- =====================================================
             MAIN LAYOUT
        ====================================================== --}}

        <div class="ce-layout">

            <div class="ce-main">

                <form
                    method="POST"
                    action="{{ route('exams.store') }}"
                    id="createExamForm"
                >

                    @csrf


                    {{-- =================================================
                         01 BASIC INFORMATION
                    ================================================== --}}

                    <section class="ce-card">

                        <div class="ce-card-header">

                            <div class="ce-section-number">
                                01
                            </div>

                            <div class="ce-card-heading">

                                <h2 class="ce-card-title">
                                    Basic Information
                                </h2>

                                <p class="ce-card-description">
                                    Give your examination a clear identity and category.
                                </p>

                            </div>

                        </div>


                        <div class="ce-card-body">

                            <div class="ce-basic-grid">

                                <div class="ce-basic-left">

                                    {{-- TITLE --}}

                                    <div class="ce-group">

                                        <div class="ce-label-row">

                                            <label
                                                for="title"
                                                class="ce-label"
                                            >
                                                Exam Title
                                            </label>

                                            <span class="ce-required">
                                                Required
                                            </span>

                                        </div>

                                        <input
                                            id="title"
                                            name="title"
                                            type="text"
                                            value="{{ old('title') }}"
                                            placeholder="e.g. General Knowledge Mock Test"
                                            required
                                            autofocus
                                            class="ce-input"
                                        >

                                        <p class="ce-helper">
                                            Use a short and meaningful name that students can easily recognize.
                                        </p>

                                    </div>


                                    {{-- DESCRIPTION --}}

                                    <div class="ce-group">

                                        <div class="ce-label-row">

                                            <label
                                                for="description"
                                                class="ce-label"
                                            >
                                                Description
                                            </label>

                                            <span class="ce-optional">
                                                Optional
                                            </span>

                                        </div>

                                        <textarea
                                            id="description"
                                            name="description"
                                            class="ce-input"
                                            maxlength="500"
                                            placeholder="Add a short description for students..."
                                        >{{ old('description') }}</textarea>

                                        <div class="ce-description-meta">

                                            <p class="ce-helper">
                                                Briefly explain what this examination covers.
                                            </p>

                                            <span
                                                class="ce-counter"
                                                id="descriptionCounter"
                                            >
                                                0 / 500
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                <div class="ce-basic-right">

                                    {{-- CATEGORY --}}

                                    <div class="ce-group">

                                        <div class="ce-label-row">

                                            <label
                                                for="exam_category_id"
                                                class="ce-label"
                                            >
                                                Exam Category
                                            </label>

                                            <span class="ce-required">
                                                Required
                                            </span>

                                        </div>


                                        <div class="ce-select-wrap">

                                            <select
                                                id="exam_category_id"
                                                name="exam_category_id"
                                                required
                                                class="ce-input"
                                            >

                                                <option value="">
                                                    Select exam category
                                                </option>

                                                @foreach($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        @selected(old('exam_category_id') == $category->id)
                                                    >
                                                        {{ $category->name }}
                                                    </option>

                                                @endforeach

                                            </select>


                                            <svg
                                                class="ce-select-arrow"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="m6 9 6 6 6-6"/>
                                            </svg>

                                        </div>


                                        @if($categories->isEmpty())

                                            <div class="ce-no-category">
                                                No active exam categories are available. Please create an exam category first.
                                            </div>

                                        @else

                                            <p class="ce-helper">
                                                Choose the category under which this examination should appear.
                                            </p>

                                       
                                        @endif

                                    </div>


                                    {{-- EXAM TYPE --}}

                                    <div class="ce-group">

                                        <div class="ce-label-row">

                                            <label
                                                for="exam_type"
                                                class="ce-label"
                                            >
                                                Exam Type
                                            </label>

                                            <span class="ce-required">
                                                Required
                                            </span>

                                        </div>


                                        <div class="ce-select-wrap">

                                            <select
                                                id="exam_type"
                                                name="exam_type"
                                                required
                                                class="ce-input"
                                            >

                                                <option value="">
                                                    Select exam type
                                                </option>

                                                <option
                                                    value="regular"
                                                   @selected(old('exam_type', request('exam_type', 'regular')) === 'regular')
                                                >
                                                    Regular / Competitive Exam
                                                </option>

                                                <option
                                                    value="current_affairs"
@selected(old('exam_type', request('exam_type')) === 'current_affairs')
                                                    >
                                                    Current Affairs
                                                </option>

                                                <option
                                                    value="major_test"
                                                    @selected(old('exam_type') === 'major_test')
                                                >
                                                    Major Test
                                                </option>

                                            </select>


                                            <svg
                                                class="ce-select-arrow"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path d="m6 9 6 6 6-6"/>
                                            </svg>

                                        </div>


                                        <p class="ce-helper">
                                            Choose whether this is a regular competitive exam, current affairs test, or major test.
                                        </p>

                                    </div>


                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         02 EXAM SETTINGS
                    ================================================== --}}

                    <section class="ce-card">

                        <div class="ce-card-header">

                            <div class="ce-section-number green">
                                02
                            </div>

                            <div class="ce-card-heading">

                                <h2 class="ce-card-title">
                                    Exam Settings
                                </h2>

                                <p class="ce-card-description">
                                    Configure duration, scoring and attempt limits.
                                </p>

                            </div>

                        </div>


                        <div class="ce-card-body">

                            <div class="ce-settings-grid">


                                {{-- DURATION --}}

                                <div class="ce-setting-box">

                                    <div class="ce-setting-icon">
                                        ⏱
                                    </div>

                                    <div class="ce-label-row">

                                        <label
                                            for="duration_minutes"
                                            class="ce-label"
                                        >
                                            Duration
                                        </label>

                                    </div>

                                    <div class="ce-number-wrap">

                                        <input
                                            id="duration_minutes"
                                            name="duration_minutes"
                                            type="number"
                                            min="1"
                                            value="{{ old('duration_minutes', 60) }}"
                                            required
                                            class="ce-input"
                                        >

                                        <span class="ce-number-suffix">
                                            MIN
                                        </span>

                                    </div>

                                </div>


                                {{-- TOTAL MARKS --}}

                                <div class="ce-setting-box blue">

                                    <div class="ce-setting-icon">
                                        M
                                    </div>

                                    <div class="ce-label-row">

                                        <label
                                            for="total_marks"
                                            class="ce-label"
                                        >
                                            Total Marks
                                        </label>

                                    </div>

                                    <input
                                        id="total_marks"
                                        name="total_marks"
                                        type="number"
                                        min="0"
                                        value="{{ old('total_marks', 100) }}"
                                        required
                                        class="ce-input"
                                    >

                                </div>


                                {{-- PASSING MARKS --}}

                                <div class="ce-setting-box green">

                                    <div class="ce-setting-icon">
                                        ✓
                                    </div>

                                    <div class="ce-label-row">

                                        <label
                                            for="passing_marks"
                                            class="ce-label"
                                        >
                                            Passing Marks
                                        </label>

                                    </div>

                                    <input
                                        id="passing_marks"
                                        name="passing_marks"
                                        type="number"
                                        min="0"
                                        value="{{ old('passing_marks', 40) }}"
                                        required
                                        class="ce-input"
                                    >

                                </div>


                                {{-- ATTEMPTS --}}

                                <div class="ce-setting-box yellow">

                                    <div class="ce-setting-icon">
                                        ↻
                                    </div>

                                    <div class="ce-label-row">

                                        <label
                                            for="attempt_limit"
                                            class="ce-label"
                                        >
                                            Attempt Limit
                                        </label>

                                    </div>

                                    <input
                                        id="attempt_limit"
                                        name="attempt_limit"
                                        type="number"
                                        min="1"
                                        value="{{ old('attempt_limit', 1) }}"
                                        required
                                        class="ce-input"
                                    >

                                </div>

                            </div>


                            {{-- NEGATIVE MARKING --}}

                            <div class="ce-negative">

                                <label
                                    for="negative_marking"
                                    class="ce-check-label"
                                >

                                    <input
                                        id="negative_marking"
                                        type="checkbox"
                                        name="negative_marking"
                                        value="1"
                                        @checked(old('negative_marking'))
                                    >

                                    <span>

                                        <span class="ce-check-title">
                                            Enable Negative Marking
                                        </span>

                                        <span class="ce-check-text">
                                            Deduct marks when a student selects an incorrect answer.
                                        </span>

                                    </span>

                                </label>


                                <div class="ce-negative-value">

                                    <label
                                        for="negative_marks"
                                        class="ce-small-label"
                                    >
                                        Deduction Per Wrong Answer
                                    </label>

                                    <input
                                        id="negative_marks"
                                        name="negative_marks"
                                        type="number"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('negative_marks', 0.25) }}"
                                        class="ce-input"
                                    >

                                </div>

                            </div>


                            <div class="ce-info-strip">

                                <div class="ce-info-icon">
                                    i
                                </div>

                                <p class="ce-info-text">
                                    <strong>Tip:</strong>
                                    Keep passing marks within total marks and choose an attempt limit according to your examination rules.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         03 SCHEDULE
                    ================================================== --}}

                    <section class="ce-card">

                        <div class="ce-card-header">

                            <div class="ce-section-number blue">
                                03
                            </div>

                            <div class="ce-card-heading">

                                <h2 class="ce-card-title">
                                    Exam Schedule
                                </h2>

                                <p class="ce-card-description">
                                    Control when students can access this examination.
                                </p>

                            </div>

                        </div>


                        <div class="ce-card-body">

                            <div class="ce-schedule-grid">


                                {{-- START --}}

                                <div class="ce-schedule-box">

                                    <div class="ce-schedule-heading">

                                        <div class="ce-schedule-icon">
                                            <svg
                                                width="15"
                                                height="15"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <rect
                                                    x="3"
                                                    y="4"
                                                    width="18"
                                                    height="17"
                                                    rx="2"
                                                />
                                                <path d="M16 2v4"/>
                                                <path d="M8 2v4"/>
                                                <path d="M3 10h18"/>
                                            </svg>
                                        </div>

                                        <div>

                                            <strong>
                                                Starts At
                                            </strong>

                                            <span>
                                                Exam opening time
                                            </span>

                                        </div>

                                    </div>


                                    <input
                                        id="starts_at"
                                        name="starts_at"
                                        type="datetime-local"
                                        value="{{ old('starts_at') }}"
                                        class="ce-input"
                                    >

                                    <p class="ce-helper">
                                        Leave empty if the exam should remain open from the beginning.
                                    </p>

                                </div>


                                {{-- END --}}

                                <div class="ce-schedule-box">

                                    <div class="ce-schedule-heading">

                                        <div class="ce-schedule-icon">
                                            <svg
                                                width="15"
                                                height="15"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <circle cx="12" cy="12" r="9"/>
                                                <path d="M12 7v5l3 2"/>
                                            </svg>
                                        </div>

                                        <div>

                                            <strong>
                                                Ends At
                                            </strong>

                                            <span>
                                                Exam closing time
                                            </span>

                                        </div>

                                    </div>


                                    <input
                                        id="ends_at"
                                        name="ends_at"
                                        type="datetime-local"
                                        value="{{ old('ends_at') }}"
                                        class="ce-input"
                                    >

                                    <p class="ce-helper">
                                        Leave empty if students should have unlimited access time.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         04 PUBLISHING
                    ================================================== --}}

                    <section class="ce-card">

                        <div class="ce-card-header">

                            <div class="ce-section-number purple">
                                04
                            </div>

                            <div class="ce-card-heading">

                                <h2 class="ce-card-title">
                                    Publishing & Availability
                                </h2>

                                <p class="ce-card-description">
                                    Decide the initial state of your examination.
                                </p>

                            </div>

                        </div>


                        <div class="ce-card-body">

                            <div class="ce-publish-grid">


                                {{-- ACTIVE --}}

                                <label
                                    for="is_active"
                                    class="ce-publish-option"
                                >

                                    <input
                                        id="is_active"
                                        type="checkbox"
                                        name="is_active"
                                        value="1"
                                        @checked(old('is_active', true))
                                    >

                                    <span>

                                        <span class="ce-option-heading">

                                            <span class="ce-option-title">
                                                Active Exam
                                            </span>

                                            <span class="ce-badge green">
                                                Enabled
                                            </span>

                                        </span>

                                        <span class="ce-option-description">
                                            Keep the exam active so it can be managed and prepared before assigning it to students.
                                        </span>

                                    </span>

                                </label>


                                {{-- PUBLISHED --}}

                                <label
                                    for="is_published"
                                    class="ce-publish-option"
                                >

                                    <input
                                        id="is_published"
                                        type="checkbox"
                                        name="is_published"
                                        value="1"
                                        @checked(old('is_published'))
                                    >

                                    <span>

                                        <span class="ce-option-heading">

                                            <span class="ce-option-title">
                                                Publish Exam
                                            </span>

                                            <span class="ce-badge gray">
                                                Optional
                                            </span>

                                        </span>

                                        <span class="ce-option-description">
                                            Publish only when the exam details and questions are completely ready for students.
                                        </span>

                                    </span>

                                </label>

                            </div>


                            <div class="ce-info-strip">

                                <div class="ce-info-icon">
                                    ✓
                                </div>

                                <p class="ce-info-text">
                                    <strong>Recommended:</strong>
                                    Create the exam first, then add questions from your reusable Question Bank before publishing.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         ACTION BAR
                    ================================================== --}}

                    <div class="ce-actions">

                        <div class="ce-actions-copy">

                            <p class="ce-actions-title">
                                Ready to create this examination?
                            </p>

                            <p class="ce-actions-text">
                                Questions can be added after the exam is created.
                            </p>

                        </div>


                        <div class="ce-action-buttons">

                            <a
                                href="{{ route('exams.index') }}"
                                class="ce-cancel"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                class="ce-submit"
                            >

                                <svg
                                    width="14"
                                    height="14"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M12 5v14"/>
                                    <path d="M5 12h14"/>
                                </svg>

                                Create Exam

                            </button>

                        </div>

                    </div>


                </form>

            </div>


            {{-- =====================================================
                 RIGHT LIVE PREVIEW
            ====================================================== --}}

            <aside class="ce-sidebar">

                <div class="ce-preview-card">

                    <div class="ce-preview-head">

                        <div class="ce-preview-label">

                            <h3 class="ce-preview-title">
                                Exam Preview
                            </h3>

                            <span class="ce-preview-live">

                                <span class="ce-preview-live-dot"></span>

                                Live

                            </span>

                        </div>

                    </div>


                    <div class="ce-preview-body">

                        <div
                            class="ce-preview-name"
                            id="previewTitle"
                        >
                            Untitled Examination
                        </div>


                        <span
                            class="ce-preview-category"
                            id="previewCategory"
                        >
                            No category selected
                        </span>


                        <p
                            class="ce-preview-description"
                            id="previewDescription"
                        >
                            Your examination description will appear here.
                        </p>


                        <div class="ce-preview-stats">

                            <div class="ce-preview-stat">

                                <div class="ce-preview-stat-label">
                                    Duration
                                </div>

                                <div
                                    class="ce-preview-stat-value"
                                    id="previewDuration"
                                >
                                    60 min
                                </div>

                            </div>


                            <div class="ce-preview-stat">

                                <div class="ce-preview-stat-label">
                                    Total Marks
                                </div>

                                <div
                                    class="ce-preview-stat-value"
                                    id="previewTotalMarks"
                                >
                                    100
                                </div>

                            </div>


                            <div class="ce-preview-stat">

                                <div class="ce-preview-stat-label">
                                    Passing
                                </div>

                                <div
                                    class="ce-preview-stat-value"
                                    id="previewPassing"
                                >
                                    40 / 100
                                </div>

                            </div>


                            <div class="ce-preview-stat">

                                <div class="ce-preview-stat-label">
                                    Attempts
                                </div>

                                <div
                                    class="ce-preview-stat-value"
                                    id="previewAttempts"
                                >
                                    1
                                </div>

                            </div>

                        </div>


                        <div class="ce-preview-footer">

                            <div class="ce-preview-status">

                                <span class="ce-preview-status-label">
                                    Initial Status
                                </span>

                                <span
                                    class="ce-status-badge"
                                    id="previewStatus"
                                >
                                    Active
                                </span>

                            </div>


                            <div class="ce-preview-tip">

                                <strong>Next step:</strong>
                                After creation, you can add questions from the Question Bank and publish the examination when it is ready.

                            </div>

                        </div>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const titleInput = document.getElementById('title');
    const categoryInput = document.getElementById('exam_category_id');
    const descriptionInput = document.getElementById('description');

    const durationInput = document.getElementById('duration_minutes');
    const totalMarksInput = document.getElementById('total_marks');
    const passingMarksInput = document.getElementById('passing_marks');
    const attemptsInput = document.getElementById('attempt_limit');

    const activeInput = document.getElementById('is_active');
    const publishedInput = document.getElementById('is_published');

    const previewTitle = document.getElementById('previewTitle');
    const previewCategory = document.getElementById('previewCategory');
    const previewDescription = document.getElementById('previewDescription');

    const previewDuration = document.getElementById('previewDuration');
    const previewTotalMarks = document.getElementById('previewTotalMarks');
    const previewPassing = document.getElementById('previewPassing');
    const previewAttempts = document.getElementById('previewAttempts');

    const previewStatus = document.getElementById('previewStatus');
    const descriptionCounter = document.getElementById('descriptionCounter');


    function updatePreview() {

        /* TITLE */

        const title = titleInput.value.trim();

        previewTitle.textContent =
            title !== ''
                ? title
                : 'Untitled Examination';


        /* CATEGORY */

        if (categoryInput.value !== '') {

            const selected =
                categoryInput.options[
                    categoryInput.selectedIndex
                ];

            previewCategory.textContent =
                selected.textContent.trim();

        } else {

            previewCategory.textContent =
                'No category selected';

        }


        /* DESCRIPTION */

        const description =
            descriptionInput.value.trim();

        previewDescription.textContent =
            description !== ''
                ? description
                : 'Your examination description will appear here.';


        /* DURATION */

        const duration =
            durationInput.value || 0;

        previewDuration.textContent =
            duration + ' min';


        /* TOTAL MARKS */

        const total =
            Number(totalMarksInput.value || 0);

        previewTotalMarks.textContent =
            total;


        /* PASSING MARKS */

        const passing =
            Number(passingMarksInput.value || 0);

        previewPassing.textContent =
            passing + ' / ' + total;


        /* ATTEMPTS */

        previewAttempts.textContent =
            attemptsInput.value || 1;


        /* STATUS */

        if (publishedInput.checked) {

            previewStatus.textContent =
                'Published';

            previewStatus.style.background =
                'rgba(99,102,241,.10)';

            previewStatus.style.color =
                '#a5b4fc';

        } else if (activeInput.checked) {

            previewStatus.textContent =
                'Active';

            previewStatus.style.background =
                'rgba(16,185,129,.08)';

            previewStatus.style.color =
                '#34d399';

        } else {

            previewStatus.textContent =
                'Inactive';

            previewStatus.style.background =
                'rgba(239,68,68,.08)';

            previewStatus.style.color =
                '#f87171';

        }


        /* DESCRIPTION COUNTER */

        if (descriptionCounter) {

            descriptionCounter.textContent =
                descriptionInput.value.length + ' / 500';

        }

    }


    const watchedInputs = [

        titleInput,
        categoryInput,
        descriptionInput,

        durationInput,
        totalMarksInput,
        passingMarksInput,
        attemptsInput,

        activeInput,
        publishedInput

    ];


    watchedInputs.forEach(function (input) {

        if (!input) return;

        input.addEventListener(
            'input',
            updatePreview
        );

        input.addEventListener(
            'change',
            updatePreview
        );

    });


    /* INITIAL PREVIEW */

    updatePreview();


    /* =====================================================
       PREVENT PUBLISHING WITHOUT ACTIVE EXAM
    ====================================================== */

    publishedInput.addEventListener('change', function () {

        if (publishedInput.checked && !activeInput.checked) {

            activeInput.checked = true;

            updatePreview();

        }

    });


    /* =====================================================
       PASSING MARKS SHOULD NOT EXCEED TOTAL MARKS
    ====================================================== */

    totalMarksInput.addEventListener('input', function () {

        const total =
            Number(totalMarksInput.value || 0);

        const passing =
            Number(passingMarksInput.value || 0);

        if (passing > total && total >= 0) {

            passingMarksInput.value =
                total;

        }

        updatePreview();

    });


    /* =====================================================
       FORM SUBMIT LOADING STATE
    ====================================================== */

    const form =
        document.getElementById('createExamForm');

    const submitButton =
        form.querySelector('.ce-submit');


    form.addEventListener('submit', function () {

        submitButton.disabled = true;

        submitButton.style.opacity = '.75';

        submitButton.style.cursor =
            'not-allowed';

        submitButton.innerHTML = `
            <svg
                width="14"
                height="14"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                style="animation:ceSpin .8s linear infinite"
            >
                <path d="M12 3a9 9 0 1 0 9 9"/>
            </svg>

            Creating...
        `;

    });

});
</script>


<style>
@keyframes ceSpin {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}
</style>


</x-layouts::examination>