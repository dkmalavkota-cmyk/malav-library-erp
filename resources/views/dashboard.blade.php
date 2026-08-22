<x-layouts::app :title="__('Dashboard')">

    <div class="space-y-6">

        {{-- Page Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Dashboard
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Welcome back, {{ auth()->user()->name }} 👋
                </p>

            </div>


            <div class="rounded-xl border border-zinc-700 bg-zinc-900 px-5 py-3">

                <p class="text-xs uppercase tracking-wider text-zinc-500">
                    Today
                </p>

                <p class="mt-1 text-lg font-semibold text-white">
                    {{ now()->format('d M Y') }}
                </p>

            </div>

        </div>


        {{-- Main Statistics --}}
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">


            {{-- Total Students --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Students
                </p>

                <h2 class="mt-3 text-4xl font-bold text-yellow-400">
                    {{ $totalStudents }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Registered students
                </p>

            </div>


            {{-- Active Memberships --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Active Memberships
                </p>

                <h2 class="mt-3 text-4xl font-bold text-green-400">
                    {{ $activeMemberships }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Currently active
                </p>

            </div>


            {{-- Today's Attendance --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Today's Attendance
                </p>

                <h2 class="mt-3 text-4xl font-bold text-sky-400">
                    {{ $todayAttendance }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Check-ins today
                </p>

            </div>


            {{-- Today's Collection --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Today's Collection
                </p>

                <h2 class="mt-3 text-4xl font-bold text-emerald-400">
                    ₹{{ number_format($todayCollection, 2) }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Payments received today
                </p>

            </div>

        </div>


        {{-- Library Statistics --}}
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">


            {{-- Total Seats --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Seats
                </p>

                <h2 class="mt-3 text-4xl font-bold text-white">
                    {{ $totalSeats }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Library capacity
                </p>

            </div>


            {{-- Occupied Seats --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Occupied Seats
                </p>

                <h2 class="mt-3 text-4xl font-bold text-red-400">
                    {{ $occupiedSeats }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Currently assigned
                </p>

            </div>


            {{-- Available Seats --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Available Seats
                </p>

                <h2 class="mt-3 text-4xl font-bold text-green-400">
                    {{ $availableSeats }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Ready for assignment
                </p>

            </div>


            {{-- Today's Expense --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Today's Expense
                </p>

                <h2 class="mt-3 text-4xl font-bold text-red-400">
                    ₹{{ number_format($todayExpense, 2) }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Expenses recorded today
                </p>

            </div>

        </div>


        {{-- Membership Alert --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>

                    <p class="text-sm text-zinc-400">
                        Memberships Expiring Soon
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-orange-400">
                        {{ $expiringMemberships }}
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Active memberships expiring within the next 7 days.
                    </p>

                </div>


                <a href="{{ route('memberships.index') }}">

                    <flux:button
                        variant="ghost"
                    >
                        View Memberships
                    </flux:button>

                </a>

            </div>

        </div>


        {{-- Quick Actions --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-5">

                <h2 class="text-xl font-semibold text-white">
                    Quick Actions
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Quickly access commonly used library functions.
                </p>

            </div>


            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">


                <a href="{{ route('students.create') }}">

                    <div class="rounded-xl border border-zinc-700 bg-zinc-800 p-5 transition hover:border-yellow-500/50 hover:bg-zinc-800/80">

                        <p class="font-semibold text-white">
                            Add Student
                        </p>

                        <p class="mt-1 text-sm text-zinc-500">
                            Register a new student
                        </p>

                    </div>

                </a>


                <a href="{{ route('memberships.index') }}">

                    <div class="rounded-xl border border-zinc-700 bg-zinc-800 p-5 transition hover:border-green-500/50 hover:bg-zinc-800/80">

                        <p class="font-semibold text-white">
                            Memberships
                        </p>

                        <p class="mt-1 text-sm text-zinc-500">
                            Manage memberships
                        </p>

                    </div>

                </a>


                <a href="{{ route('attendance.index') }}">

                    <div class="rounded-xl border border-zinc-700 bg-zinc-800 p-5 transition hover:border-sky-500/50 hover:bg-zinc-800/80">

                        <p class="font-semibold text-white">
                            Attendance
                        </p>

                        <p class="mt-1 text-sm text-zinc-500">
                            Manage today's attendance
                        </p>

                    </div>

                </a>


                <a href="{{ route('expenses.index') }}">

                    <div class="rounded-xl border border-zinc-700 bg-zinc-800 p-5 transition hover:border-red-500/50 hover:bg-zinc-800/80">

                        <p class="font-semibold text-white">
                            Expenses
                        </p>

                        <p class="mt-1 text-sm text-zinc-500">
                            Manage library expenses
                        </p>

                    </div>

                </a>

            </div>

        </div>


        {{-- Reports Shortcut --}}
        <div class="rounded-2xl border border-yellow-500/30 bg-zinc-900 p-6">

            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

                <div>

                    <h2 class="text-xl font-semibold text-white">
                        Reports & Analytics
                    </h2>

                    <p class="mt-1 text-sm text-zinc-400">
                        View collection, expenses, attendance and membership reports.
                    </p>

                </div>


                <a href="{{ route('reports.index') }}">

                    <flux:button variant="primary">
                        Open Reports
                    </flux:button>

                </a>

            </div>

        </div>


    </div>

</x-layouts::app>