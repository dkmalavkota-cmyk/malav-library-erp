<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* ============================================================
           PREMIUM SAAS SHELL
        ============================================================ */

        .saas-shell {
            --sidebar-width: 280px;
            min-height: 100vh;
            background: #070a12;
            color: #f8fafc;
        }

        /* ============================================================
           SIDEBAR
        ============================================================ */

        .saas-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            width: var(--sidebar-width);
            display: flex;
            flex-direction: column;
            overflow: hidden;

            background:
                radial-gradient(
                    circle at 10% 0%,
                    rgba(99, 102, 241, .10),
                    transparent 280px
                ),
                linear-gradient(
                    180deg,
                    #0a0e18 0%,
                    #080b13 55%,
                    #070a10 100%
                );

            border-right: 1px solid rgba(148, 163, 184, .10);

            box-shadow:
                18px 0 60px rgba(0, 0, 0, .18),
                inset -1px 0 rgba(255, 255, 255, .015);

            transition: transform .25s ease;
        }

        /* Brand */

        .saas-brand {
            height: 84px;
            flex-shrink: 0;

            display: flex;
            align-items: center;

            padding: 0 20px;

            border-bottom: 1px solid rgba(148, 163, 184, .09);
        }

        .saas-brand-link {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .saas-brand-mark {
            width: 43px;
            height: 43px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    145deg,
                    rgba(99, 102, 241, .24),
                    rgba(79, 70, 229, .07)
                );

            border: 1px solid rgba(129, 140, 248, .20);

            color: #a5b4fc;

            box-shadow:
                0 10px 30px rgba(79, 70, 229, .10),
                inset 0 1px rgba(255, 255, 255, .04);
        }

        .saas-brand-name {
            color: #f8fafc;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: -.015em;
            line-height: 1.2;
        }

        .saas-brand-sub {
            margin-top: 5px;

            color: #6366f1;

            font-size: 9px;
            font-weight: 800;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        /* Navigation */

        .saas-nav {
            flex: 1;
            overflow-y: auto;

            padding: 22px 13px;

            scrollbar-width: thin;
            scrollbar-color: rgba(100, 116, 139, .18) transparent;
        }

        .saas-nav::-webkit-scrollbar {
            width: 5px;
        }

        .saas-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .saas-nav::-webkit-scrollbar-thumb {
            background: rgba(100, 116, 139, .18);
            border-radius: 999px;
        }

        .saas-nav-section {
            margin-bottom: 24px;
        }

        .saas-nav-label {
            padding: 0 11px 8px;

            color: #475569;

            font-size: 9px;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .saas-nav-items {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .saas-nav-link {
            position: relative;

            display: flex;
            align-items: center;
            gap: 11px;

            min-height: 43px;

            padding: 0 12px;

            border: 1px solid transparent;
            border-radius: 12px;

            color: #7f8da3;

            font-size: 12px;
            font-weight: 700;

            text-decoration: none;

            transition:
                color .18s ease,
                background .18s ease,
                border-color .18s ease,
                transform .18s ease;
        }

        .saas-nav-link:hover {
            color: #e2e8f0;

            background: rgba(30, 41, 59, .50);

            border-color: rgba(148, 163, 184, .07);

            transform: translateX(1px);
        }

        .saas-nav-link.active {
            color: #eef2ff;

            background:
                linear-gradient(
                    90deg,
                    rgba(79, 70, 229, .16),
                    rgba(99, 102, 241, .045)
                );

            border-color: rgba(129, 140, 248, .14);

            box-shadow:
                inset 0 1px rgba(255, 255, 255, .025);
        }

        .saas-nav-link.active::before {
            content: "";

            position: absolute;
            left: -1px;
            top: 9px;
            bottom: 9px;

            width: 3px;

            border-radius: 0 4px 4px 0;

            background: #818cf8;

            box-shadow: 0 0 14px rgba(129, 140, 248, .65);
        }

        .saas-nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #64748b;

            transition: color .18s ease;
        }

        .saas-nav-link:hover .saas-nav-icon {
            color: #a8b4c7;
        }

        .saas-nav-link.active .saas-nav-icon {
            color: #a5b4fc;
        }

        .saas-nav-text {
            min-width: 0;
            flex: 1;
        }

        .saas-nav-count {
            min-width: 22px;
            height: 20px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 0 6px;

            border-radius: 999px;

            background: rgba(99, 102, 241, .08);

            border: 1px solid rgba(129, 140, 248, .10);

            color: #818cf8;

            font-size: 9px;
            font-weight: 800;
        }

        .saas-nav-soon {
            color: #334155;

            font-size: 8px;
            font-weight: 800;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        /* Sidebar bottom */

        .saas-sidebar-bottom {
            flex-shrink: 0;

            padding: 13px;

            border-top: 1px solid rgba(148, 163, 184, .09);
        }

        .saas-exit {
            display: flex;
            align-items: center;
            gap: 10px;

            min-height: 40px;

            padding: 0 11px;

            border: 1px solid transparent;
            border-radius: 11px;

            color: #64748b;

            font-size: 11px;
            font-weight: 700;

            text-decoration: none;

            transition: .18s ease;
        }

        .saas-exit:hover {
            color: #cbd5e1;
            background: rgba(30, 41, 59, .42);
            border-color: rgba(148, 163, 184, .07);
        }

        /* Admin profile */

        .saas-admin {
            margin-top: 9px;

            display: flex;
            align-items: center;
            gap: 11px;

            padding: 11px;

            border: 1px solid rgba(148, 163, 184, .08);
            border-radius: 14px;

            background:
                linear-gradient(
                    145deg,
                    rgba(15, 23, 42, .80),
                    rgba(8, 12, 20, .70)
                );
        }

        .saas-admin-avatar {
            width: 36px;
            height: 36px;
            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;

            background:
                linear-gradient(
                    145deg,
                    rgba(99, 102, 241, .22),
                    rgba(79, 70, 229, .07)
                );

            border: 1px solid rgba(129, 140, 248, .14);

            color: #c7d2fe;

            font-size: 10px;
            font-weight: 800;
        }

        .saas-admin-info {
            min-width: 0;
        }

        .saas-admin-name {
            overflow: hidden;

            color: #dbe4f0;

            font-size: 11px;
            font-weight: 800;

            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .saas-admin-role {
            margin-top: 3px;

            color: #475569;

            font-size: 9px;
            font-weight: 700;
        }

        /* Main */

        .saas-main {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
        }

        /* Mobile header */

        .saas-mobile-header {
            display: none;

            height: 64px;

            align-items: center;

            padding: 0 16px;

            border-bottom: 1px solid rgba(148, 163, 184, .09);

            background: rgba(7, 10, 18, .94);

            backdrop-filter: blur(16px);
        }

        .saas-mobile-menu {
            width: 39px;
            height: 39px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 1px solid rgba(148, 163, 184, .10);
            border-radius: 11px;

            background: rgba(15, 23, 42, .75);

            color: #94a3b8;
        }

        .saas-mobile-title {
            margin-left: 11px;

            color: #f8fafc;

            font-size: 12px;
            font-weight: 800;
        }

        /* ============================================================
           RESPONSIVE
        ============================================================ */

        @media (max-width: 1100px) {
            .saas-shell {
                --sidebar-width: 250px;
            }
        }

        @media (max-width: 850px) {

            .saas-sidebar {
                width: 280px;
                transform: translateX(-100%);
            }

            .saas-sidebar.open {
                transform: translateX(0);
            }

            .saas-main {
                margin-left: 0;
            }

            .saas-mobile-header {
                display: flex;
            }

            .saas-mobile-overlay {
                display: block !important;
            }
        }

        .saas-mobile-overlay {
            display: none;

            position: fixed;
            inset: 0;
            z-index: 90;

            background: rgba(0, 0, 0, .68);

            backdrop-filter: blur(3px);
        }
    </style>
</head>


<body>

<div
    class="saas-shell"
    x-data="{ sidebarOpen: false }"
>

    {{-- Mobile overlay --}}
    <div
        x-cloak
        x-show="sidebarOpen"
        x-transition.opacity
        class="saas-mobile-overlay"
        @click="sidebarOpen = false"
    ></div>


    {{-- ============================================================
         SIDEBAR
    ============================================================= --}}

    <aside
        class="saas-sidebar"
        :class="{ 'open': sidebarOpen }"
    >

        {{-- Brand --}}
        <div class="saas-brand">

            <a
                href="{{ route('saas.dashboard') }}"
                class="saas-brand-link"
            >

                <div class="saas-brand-mark">

                    <svg
                        width="21"
                        height="21"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M4 19V5"/>
                        <path d="M4 19h16"/>
                        <path d="m7 15 3-4 3 2 5-7"/>
                    </svg>

                </div>

                <div>

                    <div class="saas-brand-name">
                        Malav Technology
                    </div>

                    <div class="saas-brand-sub">
                        SaaS Control Center
                    </div>

                </div>

            </a>

        </div>


        {{-- Navigation --}}
        <nav class="saas-nav">

            {{-- Overview --}}
            <div class="saas-nav-section">

                <div class="saas-nav-label">
                    Overview
                </div>

                <div class="saas-nav-items">

                    <a
                        href="{{ route('saas.dashboard') }}"
                        class="saas-nav-link {{ request()->routeIs('saas.dashboard') ? 'active' : '' }}"
                    >

                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="3" width="7" height="7" rx="1.2"/>
                                <rect x="14" y="3" width="7" height="7" rx="1.2"/>
                                <rect x="3" y="14" width="7" height="7" rx="1.2"/>
                                <rect x="14" y="14" width="7" height="7" rx="1.2"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Dashboard
                        </span>

                    </a>

                </div>

            </div>


            {{-- Customer Management --}}
            <div class="saas-nav-section">

                <div class="saas-nav-label">
                    Customer Management
                </div>

                <div class="saas-nav-items">

                    <a
href="{{ route('saas.libraries.index') }}"
class="saas-nav-link {{ request()->routeIs('saas.libraries.*') ? 'active' : '' }}"                    >

                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 21h18"/>
                                <path d="M5 21V5l7-3 7 3v16"/>
                                <path d="M9 9h1"/>
                                <path d="M14 9h1"/>
                                <path d="M9 13h1"/>
                                <path d="M14 13h1"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Libraries
                        </span>

                        <span class="saas-nav-count">
{{ $summary['total_libraries'] ?? \App\Models\Library::count() }}
                    </span>

                    </a>


                    <a
href="{{ route('saas.customers.index') }}"
class="saas-nav-link {{ request()->routeIs('saas.customers.*') ? 'active' : '' }}"                    >

                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Customers
                        </span>

                    </a>

                </div>

            </div>


            {{-- Billing --}}
            <div class="saas-nav-section">

                <div class="saas-nav-label">
                    Billing
                </div>

                <div class="saas-nav-items">
<a
    href="{{ route('saas.plans.index') }}"
    class="saas-nav-link {{ request()->routeIs('saas.plans.*') ? 'active' : '' }}"
>
    <span class="saas-nav-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="4" width="18" height="16" rx="2"/>
            <path d="M7 8h10"/>
            <path d="M7 12h6"/>
            <path d="M7 16h4"/>
        </svg>
    </span>

    <span class="saas-nav-text">
        Plans
    </span>
</a>


<a
    href="{{ route('saas.subscriptions.index') }}"
    class="saas-nav-link {{ request()->routeIs('saas.subscriptions.*') ? 'active' : '' }}"
>
    <span class="saas-nav-icon">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <rect x="3" y="4" width="18" height="16" rx="2"/>
            <path d="M7 8h10"/>
            <path d="M7 12h6"/>
            <path d="M7 16h4"/>
        </svg>
    </span>

    <span class="saas-nav-text">
        Subscriptions
    </span>
</a>

                       


<a href="{{ route('saas.payments.index') }}" class="saas-nav-link {{ request()->routeIs('saas.payments.*') ? 'active' : '' }}">
                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M12 1v22"/>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H7"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Payments
                        </span>

                    </a>


<a href="{{ route('saas.renewals.index') }}" class="saas-nav-link {{ request()->routeIs('saas.renewals.*') ? 'active' : '' }}">
                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M3 12a9 9 0 1 0 3-6.7"/>
                                <path d="M3 4v6h6"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Renewals
                        </span>

                    </a>

                </div>

            </div>


            {{-- Analytics --}}
            <div class="saas-nav-section">

                <div class="saas-nav-label">
                    Analytics
                </div>

                <div class="saas-nav-items">


                <a href="{{ route('saas.analytics.index') }}" class="saas-nav-link {{ request()->routeIs('saas.analytics.*') ? 'active' : '' }}">
                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 19V5"/>
                                <path d="M4 19h16"/>
                                <path d="m7 15 3-4 3 2 5-7"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Usage Analytics
                        </span>

                    </a>


<a href="{{ route('saas.reports.index') }}" class="saas-nav-link {{ request()->routeIs('saas.reports.*') ? 'active' : '' }}">
                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M4 19V5"/>
                                <path d="M4 19h16"/>
                                <path d="M7 16v-4"/>
                                <path d="M11 16V8"/>
                                <path d="M15 16v-7"/>
                                <path d="M19 16V6"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Reports
                        </span>

                    </a>

                </div>

            </div>


            {{-- Platform --}}
            <div class="saas-nav-section">

                <div class="saas-nav-label">
                    Platform
                </div>

                <div class="saas-nav-items">

<a href="{{ route('saas.settings.index') }}" class="saas-nav-link {{ request()->routeIs('saas.settings.*') ? 'active' : '' }}">
                        <span class="saas-nav-icon">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <circle cx="12" cy="12" r="3"/>
                                <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.41 1.41-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.04 1.56V20h-2v-.09a1.7 1.7 0 0 0-1.04-1.56 1.7 1.7 0 0 0-1.88.34l-.06.06-1.41-1.41.06-.06A1.7 1.7 0 0 0 9.4 15a1.7 1.7 0 0 0-1.56-1.04H7v-2h.84A1.7 1.7 0 0 0 9.4 10.9a1.7 1.7 0 0 0-.34-1.88L9 8.96l1.41-1.41.06.06a1.7 1.7 0 0 0 1.88.34A1.7 1.7 0 0 0 13.4 6.4V6h2v.4a1.7 1.7 0 0 0 1.04 1.56 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.41 1.41-.06.06a1.7 1.7 0 0 0-.34 1.88 1.7 1.7 0 0 0 1.56 1.04H21v2h-.46A1.7 1.7 0 0 0 19.4 15Z"/>
                            </svg>
                        </span>

                        <span class="saas-nav-text">
                            Settings
                        </span>

                    </a>

                </div>

            </div>

        </nav>


        {{-- Sidebar bottom --}}
        <div class="saas-sidebar-bottom">

            <a
                href="{{ route('dashboard') }}"
                class="saas-exit"
            >
                <span class="saas-nav-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </span>

                Exit to Library ERP
            </a>


            <div class="saas-admin">

                <div class="saas-admin-avatar">
                    {{ auth()->user()->initials() }}
                </div>

                <div class="saas-admin-info">

                    <div class="saas-admin-name">
                        {{ auth()->user()->name }}
                    </div>

                    <div class="saas-admin-role">
                        Super Admin Â· Platform Owner
                    </div>

                </div>

            </div>

        </div>

    </aside>


    {{-- ============================================================
         MAIN
    ============================================================= --}}

    <div class="saas-main">

        {{-- Mobile header --}}
        <div class="saas-mobile-header">

            <button
                type="button"
                class="saas-mobile-menu"
                @click="sidebarOpen = true"
            >
                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M4 6h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 18h16"/>
                </svg>
            </button>

            <div class="saas-mobile-title">
                SaaS Control Center
            </div>

        </div>


        {{-- Page --}}
        <main>
            {{ $slot }}
        </main>

    </div>

</div>


@persist('toast')
    <flux:toast.group>
        <flux:toast />
    </flux:toast.group>
@endpersist

<script src="{{ asset('flux/flux.js') }}"></script>

</body>
</html>
