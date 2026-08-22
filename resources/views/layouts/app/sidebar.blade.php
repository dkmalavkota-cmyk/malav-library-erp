<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    <flux:sidebar
        sticky
        collapsible="mobile"
        class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900"
    >

        <flux:sidebar.header>

            <x-app-logo
                :sidebar="true"
                href="{{ route('dashboard') }}"
                wire:navigate
            />

            <flux:sidebar.collapse class="lg:hidden" />

        </flux:sidebar.header>


        <flux:spacer />


        <flux:sidebar.nav>

            {{-- ========================================================= --}}
            {{-- MAIN MENU --}}
            {{-- ========================================================= --}}

            <flux:sidebar.group heading="Main Menu" class="grid">

                <flux:sidebar.item
                    icon="home"
                    :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')"
                    wire:navigate
                >
                    Dashboard
                </flux:sidebar.item>

            </flux:sidebar.group>


            {{-- ========================================================= --}}
            {{-- LIBRARY MANAGEMENT --}}
            {{-- ========================================================= --}}

            <flux:sidebar.group heading="Library Management" class="grid">


                {{-- Students --}}

                <flux:sidebar.item
                    icon="users"
                    :href="route('students.index')"
                    :current="request()->routeIs('students.*')"
                    wire:navigate
                >
                    Students
                </flux:sidebar.item>


                {{-- Memberships --}}

                <flux:sidebar.item
                    icon="identification"
                    :href="route('memberships.index')"
                    :current="request()->routeIs('memberships.*')"
                    wire:navigate
                >
                    Memberships
                </flux:sidebar.item>


                {{-- Seat Assignments --}}

                <flux:sidebar.item
                    icon="squares-2x2"
                    :href="route('seat-assignments.index')"
                    :current="request()->routeIs('seat-assignments.*')"
                    wire:navigate
                >
                    Seat Assignments
                </flux:sidebar.item>


                {{-- Payments --}}

                <flux:sidebar.item
                    icon="banknotes"
                    :href="route('payments.index')"
                    :current="request()->routeIs('payments.*')"
                    wire:navigate
                >
                    Payments
                </flux:sidebar.item>


                {{-- Attendance --}}

                <flux:sidebar.item
                    icon="qr-code"
                    :href="route('attendance.index')"
                    :current="request()->routeIs('attendance.*')"
                    wire:navigate
                >
                    Attendance
                </flux:sidebar.item>


            </flux:sidebar.group>


            {{-- ========================================================= --}}
            {{-- LIBRARY SETUP --}}
            {{-- ========================================================= --}}

            <flux:sidebar.group heading="Library Setup" class="grid">


                {{-- Rooms --}}

                <flux:sidebar.item
                    icon="building-office"
                    :href="route('rooms.index')"
                    :current="request()->routeIs('rooms.*')"
                    wire:navigate
                >
                    Rooms
                </flux:sidebar.item>


                {{-- Seats --}}

                <flux:sidebar.item
                    icon="squares-2x2"
                    :href="route('seats.index')"
                    :current="request()->routeIs('seats.*')"
                    wire:navigate
                >
                    Seats
                </flux:sidebar.item>


                {{-- Membership Plans --}}

                <flux:sidebar.item
                    icon="clipboard-document-list"
                    :href="route('membership-plans.index')"
                    :current="request()->routeIs('membership-plans.*')"
                    wire:navigate
                >
                    Membership Plans
                </flux:sidebar.item>


                {{-- Membership Services --}}

                <flux:sidebar.item
                    icon="wrench-screwdriver"
                    :href="route('services.index')"
                    :current="request()->routeIs('services.*')"
                    wire:navigate
                >
                    Membership Services
                </flux:sidebar.item>


            </flux:sidebar.group>


            {{-- ========================================================= --}}
            {{-- REPORTS --}}
            {{-- ========================================================= --}}

            <flux:sidebar.group heading="Reports" class="grid">


                {{-- Reports --}}

                <flux:sidebar.item
                    icon="chart-bar"
                    :href="route('reports.index')"
                    :current="request()->routeIs('reports.*')"
                    wire:navigate
                >
                    Reports
                </flux:sidebar.item>


                {{-- Expenses --}}

                <flux:sidebar.item
                    icon="receipt-percent"
                    :href="route('expenses.index')"
                    :current="request()->routeIs('expenses.*')"
                    wire:navigate
                >
                    Expenses
                </flux:sidebar.item>


            </flux:sidebar.group>


        </flux:sidebar.nav>


        {{-- Desktop User Menu --}}

        <x-desktop-user-menu
            class="hidden lg:block"
            :name="auth()->user()->name"
        />

    </flux:sidebar>


    <!-- Mobile User Menu -->

    <flux:header class="lg:hidden">

        <flux:sidebar.toggle
            class="lg:hidden"
            icon="bars-2"
            inset="left"
        />

        <flux:spacer />


        <flux:dropdown position="top" align="end">

            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down"
            />


            <flux:menu>

                <flux:menu.radio.group>

                    <div class="p-0 text-sm font-normal">

                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                            <flux:avatar
                                :name="auth()->user()->name"
                                :initials="auth()->user()->initials()"
                            />


                            <div class="grid flex-1 text-start text-sm leading-tight">

                                <flux:heading class="truncate">
                                    {{ auth()->user()->name }}
                                </flux:heading>

                                <flux:text class="truncate">
                                    {{ auth()->user()->email }}
                                </flux:text>

                            </div>

                        </div>

                    </div>

                </flux:menu.radio.group>


                <flux:menu.separator />


                <flux:menu.radio.group>

                    <flux:menu.item
                        :href="route('profile.edit')"
                        icon="cog"
                        wire:navigate
                    >
                        {{ __('Settings') }}
                    </flux:menu.item>

                </flux:menu.radio.group>


                <flux:menu.separator />


                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="w-full"
                >

                    @csrf

                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer"
                        data-test="logout-button"
                    >
                        {{ __('Log out') }}
                    </flux:menu.item>

                </form>


            </flux:menu>

        </flux:dropdown>

    </flux:header>


    {{ $slot }}


    @persist('toast')

        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>

    @endpersist


    @fluxScripts

</body>

</html>