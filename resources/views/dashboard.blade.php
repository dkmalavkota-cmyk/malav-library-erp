<x-layouts::app :title="__('Dashboard')">

    <div class="space-y-7">

        {{-- =========================================================
             PREMIUM DASHBOARD HEADER
        ========================================================== --}}
        <div class="relative overflow-hidden rounded-3xl border border-zinc-700/70 bg-zinc-900/80">

            {{-- Background accents --}}
            <div class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-indigo-500/5 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-28 left-1/3 h-56 w-56 rounded-full bg-emerald-500/5 blur-3xl"></div>

            <div class="relative flex flex-col gap-7 p-6 sm:p-7 lg:flex-row lg:items-center lg:justify-between">

                {{-- Header Content --}}
                <div>

                    <div class="mb-3 flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-emerald-400 shadow-[0_0_12px_rgba(52,211,153,0.7)]"></span>

                        <span class="text-[11px] font-semibold uppercase tracking-[0.2em] text-zinc-500">
                            Library Overview
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        Dashboard
                    </h1>

                    <p class="mt-2 text-sm text-zinc-400">
                        Welcome back, {{ auth()->user()->name }} ðŸ‘‹
                    </p>

                    <div class="mt-5 flex flex-wrap items-center gap-2">
                        <span class="rounded-lg border border-zinc-700/80 bg-zinc-800/70 px-3 py-1.5 text-[11px] font-medium text-zinc-400">
                            Library Management
                        </span>

                        <span class="rounded-lg border border-emerald-500/15 bg-emerald-500/5 px-3 py-1.5 text-[11px] font-medium text-emerald-400">
                            System Online
                        </span>
                    </div>

                </div>



                {{-- =================================================
                     DATE + LIVE CLOCK
                ================================================== --}}
                <div class="shrink-0">

                    <div class="flex items-center overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-950/60 shadow-lg">

                        {{-- Date --}}
                        <div class="px-5 py-4 sm:px-6">

                            <div class="flex items-center gap-2">
                                <svg
                                    class="h-4 w-4 text-zinc-500"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M8 2v3M16 2v3M3.5 9.5h17M5 4.5h14A2.5 2.5 0 0 1 21.5 7v12A2.5 2.5 0 0 1 19 21.5H5A2.5 2.5 0 0 1 2.5 19V7A2.5 2.5 0 0 1 5 4.5Z"
                                    />
                                </svg>

                                <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-zinc-500">
                                    Today
                                </span>
                            </div>

                            <p class="mt-1.5 text-sm font-semibold text-white">
                                {{ now()->format('D, d M Y') }}
                            </p>

                        </div>


                        {{-- Divider --}}
                        <div class="h-12 w-px bg-zinc-800"></div>


                        {{-- Live Time --}}
                        <div class="min-w-[135px] px-5 py-4 sm:px-6">

                            <div class="flex items-center gap-1.5">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 shadow-[0_0_7px_rgba(52,211,153,0.8)]"></span>

                                <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-emerald-400">
                                    Live
                                </span>

                            </div>

                            <div class="mt-1 flex items-baseline gap-1.5">

                                <span
                                    id="dashboard-clock"
                                    class="text-xl font-bold tracking-tight text-white tabular-nums"
                                >
                                    {{ now()->format('h:i:s') }}
                                </span>

                                <span
                                    id="dashboard-period"
                                    class="text-xs font-bold text-sky-400"
                                >
                                    {{ now()->format('A') }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <br>


        {{-- =========================================================
             MAIN STATISTICS
        ========================================================== --}}
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

            {{-- Total Students --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-yellow-400/5 blur-3xl transition group-hover:bg-yellow-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Total Students
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-yellow-400">
                            {{ $totalStudents }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-yellow-500/15 bg-yellow-500/10">
                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                </div>

                <p class="relative mt-3 text-xs text-zinc-500">
                    Registered students
                </p>

            </div>


            {{-- Active Memberships --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-emerald-400/5 blur-3xl transition group-hover:bg-emerald-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Active Memberships
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-emerald-400">
                            {{ $activeMemberships }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-emerald-500/15 bg-emerald-500/10">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 3l7 4v5c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V7l7-4Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>

                </div>

                <p class="relative mt-3 text-xs text-zinc-500">
                    Currently active
                </p>

            </div>


            {{-- Today's Attendance --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-sky-500/30 hover:shadow-xl hover:shadow-sky-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-sky-400/5 blur-3xl transition group-hover:bg-sky-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Today's Attendance
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-sky-400">
                            {{ $todayAttendance }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-sky-500/15 bg-sky-500/10">
                        <svg class="h-5 w-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M8 3v3M16 3v3M4 9h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="m8 15 2 2 5-5"/>
                        </svg>
                    </div>

                </div>

                <p class="relative mt-3 text-xs text-zinc-500">
                    Check-ins today
                </p>

            </div>


            {{-- Today's Collection --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-emerald-400/5 blur-3xl transition group-hover:bg-emerald-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-400">
                            Today's Collection
                        </p>

                        <h2 class="mt-3 truncate text-3xl font-bold tracking-tight text-emerald-400">
                            â‚¹{{ number_format($todayCollection, 2) }}
                        </h2>
                    </div>

                    <div class="ml-3 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-500/15 bg-emerald-500/10">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 3v18M16 7.5c0-1.4-1.8-2.5-4-2.5S8 6.1 8 7.5 9.8 10 12 10s4 1.1 4 2.5S14.2 15 12 15s-4-1.1-4-2.5"/>
                        </svg>
                    </div>

                </div>

                <p class="relative mt-3 text-xs text-zinc-500">
                    Payments received today
                </p>

            </div>

        </div>


        {{-- =========================================================
             LIBRARY STATISTICS
        ========================================================== --}}
        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">

            {{-- Total Seats --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-zinc-500 hover:shadow-xl">

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Total Seats
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-white">
                            {{ $totalSeats }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-zinc-700 bg-zinc-800">
                        <svg class="h-5 w-5 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M4 5h16v14H4zM8 9h8M8 13h5"/>
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Library capacity
                </p>

            </div>


            {{-- Occupied Seats --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-red-500/30 hover:shadow-xl hover:shadow-red-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-red-400/5 blur-3xl transition group-hover:bg-red-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Occupied Seats
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-red-400">
                            {{ $occupiedSeats }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-red-500/15 bg-red-500/10">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M5 11h14M7 11V8a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v3M5 11v6h14v-6M8 17v2M16 17v2"/>
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Currently assigned
                </p>

            </div>


            {{-- Available Seats --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-green-500/30 hover:shadow-xl hover:shadow-green-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-green-400/5 blur-3xl transition group-hover:bg-green-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-zinc-400">
                            Available Seats
                        </p>

                        <h2 class="mt-3 text-3xl font-bold tracking-tight text-green-400">
                            {{ $availableSeats }}
                        </h2>
                    </div>

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-green-500/15 bg-green-500/10">
                        <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M5 12.5 10 17l9-10"/>
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Ready for assignment
                </p>

            </div>


            {{-- Today's Expense --}}
            <div class="group relative overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900/90 p-5 transition duration-300 hover:-translate-y-0.5 hover:border-red-500/30 hover:shadow-xl hover:shadow-red-500/5">

                <div class="absolute -right-10 -top-10 h-28 w-28 rounded-full bg-red-400/5 blur-3xl transition group-hover:bg-red-400/10"></div>

                <div class="relative flex items-start justify-between">

                    <div class="min-w-0">
                        <p class="text-sm font-medium text-zinc-400">
                            Today's Expense
                        </p>

                        <h2 class="mt-3 truncate text-3xl font-bold tracking-tight text-red-400">
                            â‚¹{{ number_format($todayExpense, 2) }}
                        </h2>
                    </div>

                    <div class="ml-3 flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-red-500/15 bg-red-500/10">
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 3v18M16 7.5c0-1.4-1.8-2.5-4-2.5S8 6.1 8 7.5 9.8 10 12 10s4 1.1 4 2.5S14.2 15 12 15s-4-1.1-4-2.5"/>
                        </svg>
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Expenses recorded today
                </p>

            </div>

        </div>
        <br>


        {{-- =========================================================
             MEMBERSHIP ATTENTION
        ========================================================== --}}
        <div class="relative overflow-hidden rounded-2xl border border-orange-500/20 bg-zinc-900/90 shadow-lg">

            <div class="absolute -right-20 -top-20 h-48 w-48 rounded-full bg-orange-500/5 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 p-6 sm:p-7 md:flex-row md:items-center md:justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-orange-500/20 bg-orange-500/10">
                        <svg class="h-6 w-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M12 9v4M12 17h.01M10.3 3.7 2.8 17a2 2 0 0 0 1.75 3h14.9a2 2 0 0 0 1.75-3L13.7 3.7a2 2 0 0 0-3.4 0Z"/>
                        </svg>
                    </div>

                    <div>

                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold uppercase tracking-[0.16em] text-orange-400">
                                Membership Attention
                            </span>
                        </div>

                        <div class="mt-1 flex items-baseline gap-3">
                            <h2 class="text-2xl font-bold text-white">
                                {{ $expiringMemberships }}
                            </h2>

                            <span class="text-xs text-zinc-600">
                                expiring soon
                            </span>
                        </div>

                        <p class="mt-0.5 text-sm text-zinc-500">
                            Active memberships expiring within the next 7 days.
                        </p>

                    </div>

                </div>

                <a href="{{ route('memberships.index') }}" class="shrink-0">
                    <flux:button variant="ghost">
                        View Memberships
                    </flux:button>
                </a>

            </div>

        </div>
        <br>


        {{-- =========================================================
             PREMIUM ONLINE EXAMINATION
        ========================================================== --}}
        <div class="group relative overflow-hidden rounded-3xl border border-indigo-500/30 bg-gradient-to-br from-zinc-900 via-zinc-900 to-indigo-950/30 shadow-xl shadow-indigo-950/10">

            {{-- Ambient glow --}}
            <div class="pointer-events-none absolute -right-24 -top-28 h-72 w-72 rounded-full bg-indigo-500/10 blur-3xl transition duration-500 group-hover:bg-indigo-500/15"></div>
            <div class="pointer-events-none absolute -bottom-24 left-1/3 h-56 w-56 rounded-full bg-violet-500/5 blur-3xl"></div>

            <div class="relative p-6 sm:p-7 lg:p-8">

                <div class="flex flex-col gap-7 lg:flex-row lg:items-center lg:justify-between">

                    {{-- Examination Content --}}
                    <div class="max-w-3xl">

                        <div class="flex items-start gap-4">

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl border border-indigo-400/20 bg-indigo-500/10">
                                <svg class="h-7 w-7 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                          d="M6 3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                          d="M8 7h8M8 11h8M8 15h5"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                          d="M17 15h.01"/>
                                </svg>
                            </div>

                            <div>

                                <div class="flex flex-wrap items-center gap-2">

                                    <span class="rounded-full border border-indigo-400/20 bg-indigo-500/10 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-indigo-400">
                                        Premium Feature
                                    </span>

                                    <span class="rounded-full border border-zinc-700 bg-zinc-800/70 px-2.5 py-1 text-[10px] font-medium uppercase tracking-wider text-zinc-500">
                                        Online
                                    </span>

                                </div>

                                <h2 class="mt-2 text-2xl font-bold tracking-tight text-white sm:text-3xl">
                                    Online Examination System
                                </h2>

                            </div>

                        </div>


                        <p class="mt-4 max-w-2xl text-sm leading-6 text-zinc-400">
                            Manage online exams, question banks, subjects, test series,
                            assignments and student results from a dedicated examination dashboard.
                        </p>


                        <div class="mt-5 flex flex-wrap gap-2">

                            <span class="rounded-lg border border-zinc-800 bg-zinc-950/50 px-3 py-1.5 text-xs text-zinc-400">
                                Exams
                            </span>

                            <span class="rounded-lg border border-zinc-800 bg-zinc-950/50 px-3 py-1.5 text-xs text-zinc-400">
                                Question Bank
                            </span>

                            <span class="rounded-lg border border-zinc-800 bg-zinc-950/50 px-3 py-1.5 text-xs text-zinc-400">
                                Test Series
                            </span>

                            <span class="rounded-lg border border-zinc-800 bg-zinc-950/50 px-3 py-1.5 text-xs text-zinc-400">
                                Results
                            </span>

                        </div>

                    </div>


                    {{-- Examination CTA --}}
                    <div class="shrink-0 lg:min-w-[255px]">

                        <a href="{{ route('examination.dashboard') }}" class="block">

                            <div class="flex items-center justify-between gap-4 rounded-2xl border border-indigo-400/20 bg-indigo-500/10 px-5 py-4 transition duration-300 hover:border-indigo-400/40 hover:bg-indigo-500/15">

                                <div>
                                    <p class="text-sm font-semibold text-white">
                                        Open Examination
                                    </p>

                                    <p class="mt-1 text-xs text-zinc-500">
                                        Manage your exam system
                                    </p>
                                </div>

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500 text-white shadow-lg shadow-indigo-500/20 transition duration-300 group-hover:translate-x-0.5">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                              d="M5 12h14M13 6l6 6-6 6"/>
                                    </svg>
                                </div>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>
        <br>


        {{-- =========================================================
             QUICK ACTIONS
        ========================================================== --}}
        <div class="rounded-2xl border border-zinc-700/80 bg-zinc-900/80 p-6 shadow-lg sm:p-7">

            <div class="mb-5">

                <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-zinc-500">
                    Shortcuts
                </p>

                <h2 class="mt-1 text-xl font-semibold text-white">
                    Quick Actions
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Quickly access commonly used library functions.
                </p>

            </div>


            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Add Student --}}
                <a href="{{ route('students.create') }}" class="group">

                    <div class="flex min-h-[104px] items-center gap-4 rounded-xl border border-zinc-700/80 bg-zinc-800/50 p-4 transition duration-300 hover:-translate-y-0.5 hover:border-yellow-500/30 hover:bg-zinc-800 hover:shadow-lg hover:shadow-yellow-500/5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-yellow-500/15 bg-yellow-500/10">
                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="M15 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M8.5 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8ZM19 8v6M16 11h6"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-white">
                                Add Student
                            </p>

                            <p class="mt-1 text-xs text-zinc-500">
                                Register a new student
                            </p>
                        </div>

                    </div>

                </a>


                {{-- Memberships --}}
                <a href="{{ route('memberships.index') }}" class="group">

                    <div class="flex min-h-[104px] items-center gap-4 rounded-xl border border-zinc-700/80 bg-zinc-800/50 p-4 transition duration-300 hover:-translate-y-0.5 hover:border-emerald-500/30 hover:bg-zinc-800 hover:shadow-lg hover:shadow-emerald-500/5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-emerald-500/15 bg-emerald-500/10">
                            <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="M8 8h8M8 12h5"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-white">
                                Memberships
                            </p>

                            <p class="mt-1 text-xs text-zinc-500">
                                Manage memberships
                            </p>
                        </div>

                    </div>

                </a>


                {{-- Attendance --}}
                <a href="{{ route('attendance.index') }}" class="group">

                    <div class="flex min-h-[104px] items-center gap-4 rounded-xl border border-zinc-700/80 bg-zinc-800/50 p-4 transition duration-300 hover:-translate-y-0.5 hover:border-sky-500/30 hover:bg-zinc-800 hover:shadow-lg hover:shadow-sky-500/5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-sky-500/15 bg-sky-500/10">
                            <svg class="h-5 w-5 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="M8 3v3M16 3v3M4 9h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="m8 15 2 2 5-5"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-white">
                                Attendance
                            </p>

                            <p class="mt-1 text-xs text-zinc-500">
                                Manage today's attendance
                            </p>
                        </div>

                    </div>

                </a>


                {{-- Expenses --}}
                <a href="{{ route('expenses.index') }}" class="group">

                    <div class="flex min-h-[104px] items-center gap-4 rounded-xl border border-zinc-700/80 bg-zinc-800/50 p-4 transition duration-300 hover:-translate-y-0.5 hover:border-red-500/30 hover:bg-zinc-800 hover:shadow-lg hover:shadow-red-500/5">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-red-500/15 bg-red-500/10">
                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                      d="M12 3v18M16 7.5c0-1.4-1.8-2.5-4-2.5S8 6.1 8 7.5 9.8 10 12 10s4 1.1 4 2.5S14.2 15 12 15s-4-1.1-4-2.5"/>
                            </svg>
                        </div>

                        <div>
                            <p class="font-semibold text-white">
                                Expenses
                            </p>

                            <p class="mt-1 text-xs text-zinc-500">
                                Manage library expenses
                            </p>
                        </div>

                    </div>

                </a>

            </div>

        </div>


        {{-- =========================================================
             REPORTS & ANALYTICS
        ========================================================== --}}
        <div class="relative overflow-hidden rounded-2xl border border-yellow-500/20 bg-gradient-to-r from-zinc-900 via-zinc-900 to-yellow-950/10 p-6 shadow-lg sm:p-7">

            <div class="pointer-events-none absolute -right-20 -top-20 h-48 w-48 rounded-full bg-yellow-400/5 blur-3xl"></div>

            <div class="relative flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

                <div class="flex items-start gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-yellow-500/20 bg-yellow-500/10">
                        <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="M4 19V5M4 19h17"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                  d="m7 15 4-4 3 2 5-6"/>
                        </svg>
                    </div>

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-yellow-400">
                            Insights
                        </p>

                        <h2 class="mt-1 text-xl font-semibold text-white">
                            Reports & Analytics
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            View collection, expenses, attendance and membership reports.
                        </p>

                    </div>

                </div>


                <a href="{{ route('reports.index') }}" class="shrink-0">
                    <flux:button variant="primary">
                        Open Reports
                    </flux:button>
                </a>

            </div>

        </div>

    </div>


    {{-- =========================================================
         LIVE CLOCK
    ========================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const clock = document.getElementById('dashboard-clock');
            const period = document.getElementById('dashboard-period');

            if (!clock || !period) {
                return;
            }

            function updateDashboardClock() {

                const now = new Date();

                const hours = now.getHours();

                const minutes = String(
                    now.getMinutes()
                ).padStart(2, '0');

                const seconds = String(
                    now.getSeconds()
                ).padStart(2, '0');

                const formattedHours = String(
                    hours % 12 || 12
                ).padStart(2, '0');

                clock.textContent =
                    `${formattedHours}:${minutes}:${seconds}`;

                period.textContent =
                    hours >= 12 ? 'PM' : 'AM';
            }

            updateDashboardClock();

            setInterval(
                updateDashboardClock,
                1000
            );

        });
    </script>

</x-layouts::app>
