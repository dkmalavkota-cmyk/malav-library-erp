<x-layouts.saas :title="__('Settings')">

    <style>
        .settings-page {
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
            max-width: 720px;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .overview-card {
            padding: 17px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.018)),
                rgba(9,15,27,.72);
        }

        .overview-label {
            color: #6f7e94;
            font-size: 9px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .overview-value {
            margin-top: 8px;
            color: #edf2f8;
            font-size: 14px;
            line-height: 1.3;
            font-weight: 750;
            word-break: break-word;
        }

        .overview-meta {
            margin-top: 6px;
            color: #69788e;
            font-size: 10px;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .settings-card {
            overflow: hidden;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 17px;
            background: rgba(9,15,27,.72);
        }

        .settings-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px 20px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }

        .settings-icon {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 10px;
            background: rgba(255,255,255,.035);
            color: #aebbd0;
        }

        .settings-icon svg {
            width: 16px;
            height: 16px;
        }

        .settings-card-title {
            margin: 0;
            color: #e5ebf3;
            font-size: 14px;
            font-weight: 750;
        }

        .settings-card-description {
            margin: 4px 0 0;
            color: #69788e;
            font-size: 10px;
            line-height: 1.5;
        }

        .settings-list {
            padding: 0 20px;
        }

        .setting-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px 0;
            border-bottom: 1px solid rgba(255,255,255,.045);
        }

        .setting-row:last-child {
            border-bottom: 0;
        }

        .setting-name {
            color: #cfd8e5;
            font-size: 11px;
            font-weight: 650;
        }

        .setting-help {
            margin-top: 3px;
            color: #647389;
            font-size: 9px;
            line-height: 1.4;
        }

        .setting-value {
            max-width: 220px;
            color: #aebbd0;
            font-size: 10px;
            font-weight: 700;
            text-align: right;
            word-break: break-word;
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
            white-space: nowrap;
        }

        .status-badge::before {
            content: "";
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-badge.enabled {
            border-color: rgba(85,216,138,.16);
            background: rgba(85,216,138,.08);
            color: #72e49e;
        }

        .status-badge.protected {
            border-color: rgba(112,151,255,.16);
            background: rgba(112,151,255,.08);
            color: #9bb3ff;
        }

        .status-badge.readonly {
            border-color: rgba(255,255,255,.07);
            background: rgba(255,255,255,.025);
            color: #8b99ad;
        }

        .notice-card {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 18px 20px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 15px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.035), rgba(255,255,255,.015)),
                rgba(9,15,27,.62);
        }

        .notice-icon {
            width: 35px;
            height: 35px;
            flex: 0 0 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 10px;
            background: rgba(255,255,255,.025);
            color: #8997aa;
        }

        .notice-icon svg {
            width: 16px;
            height: 16px;
        }

        .notice-title {
            margin: 0;
            color: #dce4ee;
            font-size: 12px;
            font-weight: 700;
        }

        .notice-text {
            margin: 5px 0 0;
            color: #68778d;
            font-size: 10px;
            line-height: 1.6;
        }

        @media (max-width: 950px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }

            .overview-grid {
                grid-template-columns: repeat(2, minmax(0,1fr));
            }
        }

        @media (max-width: 650px) {
            .overview-grid {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 25px;
            }

            .setting-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            .setting-value {
                max-width: 100%;
                text-align: left;
            }
        }
    </style>

    <div class="settings-page">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <p class="eyebrow">Platform Configuration</p>

                <h1 class="page-title">
                    Settings
                </h1>

                <p class="page-description">
                    Review the core SaaS platform configuration, security controls and operational settings.
                </p>
            </div>

        </div>

        {{-- Overview --}}
        <div class="overview-grid">

            <div class="overview-card">

                <div class="overview-label">
                    Application
                </div>

                <div class="overview-value">
                    Malav Library ERP
                </div>

                <div class="overview-meta">
                    SaaS platform
                </div>

            </div>

            <div class="overview-card">

                <div class="overview-label">
                    Environment
                </div>

                <div class="overview-value">
                    {{ ucfirst(app()->environment()) }}
                </div>

                <div class="overview-meta">
                    Current application environment
                </div>

            </div>

            <div class="overview-card">

                <div class="overview-label">
                    Platform Access
                </div>

                <div class="overview-value">
                    Super Admin
                </div>

                <div class="overview-meta">
                    Restricted control center
                </div>

            </div>

        </div>

        {{-- Settings Cards --}}
        <div class="settings-grid">

            {{-- Platform --}}
            <section class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M12 3l8 4.5v9L12 21l-8-4.5v-9L12 3z"></path>
                            <path d="M12 12l8-4.5"></path>
                            <path d="M12 12L4 7.5"></path>
                            <path d="M12 12v9"></path>
                        </svg>
                    </div>

                    <div>
                        <h2 class="settings-card-title">
                            Platform
                        </h2>

                        <p class="settings-card-description">
                            Core application configuration.
                        </p>
                    </div>

                </div>

                <div class="settings-list">

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Application Name
                            </div>

                            <div class="setting-help">
                                Platform identity
                            </div>
                        </div>

                        <div class="setting-value">
                            {{ config('app.name') }}
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Application URL
                            </div>

                            <div class="setting-help">
                                Primary application address
                            </div>
                        </div>

                        <div class="setting-value">
                            {{ config('app.url') }}
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Timezone
                            </div>

                            <div class="setting-help">
                                Application default timezone
                            </div>
                        </div>

                        <div class="setting-value">
                            {{ config('app.timezone') ?: 'UTC' }}
                        </div>

                    </div>

                </div>

            </section>

            {{-- Security --}}
            <section class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M12 3l7 4v5c0 4.5-2.8 7.6-7 9-4.2-1.4-7-4.5-7-9V7l7-4z"></path>
                            <path d="M9 12l2 2 4-4"></path>
                        </svg>
                    </div>

                    <div>
                        <h2 class="settings-card-title">
                            Security
                        </h2>

                        <p class="settings-card-description">
                            SaaS control center access protection.
                        </p>
                    </div>

                </div>

                <div class="settings-list">

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Authentication
                            </div>

                            <div class="setting-help">
                                Login required for access
                            </div>
                        </div>

                        <div>
                            <span class="status-badge enabled">
                                Enabled
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Super Admin Access
                            </div>

                            <div class="setting-help">
                                SaaS panel restricted by role
                            </div>
                        </div>

                        <div>
                            <span class="status-badge protected">
                                Protected
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Tenant Isolation
                            </div>

                            <div class="setting-help">
                                Customer data remains library scoped
                            </div>
                        </div>

                        <div>
                            <span class="status-badge protected">
                                Library Scoped
                            </span>
                        </div>

                    </div>

                </div>

            </section>

            {{-- Billing --}}
            <section class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            <path d="M7 15h3"></path>
                        </svg>
                    </div>

                    <div>
                        <h2 class="settings-card-title">
                            Billing
                        </h2>

                        <p class="settings-card-description">
                            Subscription and payment infrastructure.
                        </p>
                    </div>

                </div>

                <div class="settings-list">

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Subscription Management
                            </div>

                            <div class="setting-help">
                                Plans and customer subscriptions
                            </div>
                        </div>

                        <div>
                            <span class="status-badge enabled">
                                Available
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Payment Records
                            </div>

                            <div class="setting-help">
                                SaaS payment ledger
                            </div>
                        </div>

                        <div>
                            <span class="status-badge enabled">
                                Available
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Renewal Management
                            </div>

                            <div class="setting-help">
                                Expiry and renewal tracking
                            </div>
                        </div>

                        <div>
                            <span class="status-badge enabled">
                                Available
                            </span>
                        </div>

                    </div>

                </div>

            </section>

            {{-- System --}}
            <section class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-icon">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.7 1.7 0 00.3 1.9l.1.1-1.8 1.8-.1-.1a1.7 1.7 0 00-1.9-.3 1.7 1.7 0 00-1 1.6v.2h-2.5V20a1.7 1.7 0 00-1-1.6 1.7 1.7 0 00-1.9.3l-.1.1-1.8-1.8.1-.1A1.7 1.7 0 008 15a1.7 1.7 0 00-1.6-1H6v-2.5h.2A1.7 1.7 0 008 10a1.7 1.7 0 00-.3-1.9l-.1-.1 1.8-1.8.1.1a1.7 1.7 0 001.9.3 1.7 1.7 0 001-1.6v-.2h2.5V5a1.7 1.7 0 001 1.6 1.7 1.7 0 001.9-.3l.1-.1 1.8 1.8-.1.1a1.7 1.7 0 00-.3 1.9 1.7 1.7 0 001.6 1h.2V14h-.2a1.7 1.7 0 00-1.6 1z"></path>
                        </svg>
                    </div>

                    <div>
                        <h2 class="settings-card-title">
                            System
                        </h2>

                        <p class="settings-card-description">
                            Platform-level operational controls.
                        </p>
                    </div>

                </div>

                <div class="settings-list">

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Configuration Mode
                            </div>

                            <div class="setting-help">
                                Current settings interface
                            </div>
                        </div>

                        <div>
                            <span class="status-badge readonly">
                                Read Only
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                Customer Data
                            </div>

                            <div class="setting-help">
                                Existing customer records
                            </div>
                        </div>

                        <div>
                            <span class="status-badge protected">
                                Protected
                            </span>
                        </div>

                    </div>

                    <div class="setting-row">

                        <div>
                            <div class="setting-name">
                                SaaS Control Center
                            </div>

                            <div class="setting-help">
                                Central administration interface
                            </div>
                        </div>

                        <div>
                            <span class="status-badge enabled">
                                Active
                            </span>
                        </div>

                    </div>

                </div>

            </section>

        </div>

        {{-- Notice --}}
        <div class="notice-card">

            <div class="notice-icon">
                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <circle cx="12" cy="12" r="9"></circle>
                    <path d="M12 11v5"></path>
                    <path d="M12 8h.01"></path>
                </svg>
            </div>

            <div>

                <h3 class="notice-title">
                    Advanced configuration is intentionally read-only
                </h3>

                <p class="notice-text">
                    Payment gateways, subscription plans, platform branding,
                    email configuration and system-wide defaults can be added
                    here later without modifying existing customer records.
                </p>

            </div>

        </div>

    </div>

</x-layouts.saas>