<x-layouts::app :title="'Attendance'">

    <div class="w-full px-6 py-8 lg:px-10">

        {{-- Page Header --}}
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

            <div>
                <flux:heading size="xl" class="text-3xl font-bold">
                    Attendance Management
                </flux:heading>

                <flux:text class="mt-2 text-base text-zinc-400">
                    Manage daily library attendance, check-ins and check-outs.
                </flux:text>
            </div>

            <div class="flex items-center gap-3">

                <div class="rounded-xl border border-zinc-700 bg-zinc-900 px-5 py-3 text-right">
                    <div class="text-xs uppercase tracking-wide text-zinc-500">
                        Today
                    </div>

                    <div class="mt-1 text-lg font-semibold text-white">
                        {{ today()->format('d M Y') }}
                    </div>
                </div>

            </div>

        </div>


        {{-- Success Message --}}
        @if (session('success'))

            <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-400">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error Message --}}
        @if ($errors->any())

            <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm text-red-400">

                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach

            </div>

        @endif


        {{-- Statistics --}}
       <div
    class="mb-8 flex flex-wrap gap-5"
    style="display: grid; grid-template-columns: repeat(5, minmax(0, 1fr));"
>

            {{-- Today's Attendance --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <div class="text-sm text-zinc-400">
                    Today's Attendance
                </div>

                <div class="mt-4 text-4xl font-bold text-cyan-400">
                    {{ $presentToday }}
                </div>

                <div class="mt-2 text-sm text-zinc-500">
                    Total check-ins today
                </div>

            </div>


            {{-- Currently Inside --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <div class="text-sm text-zinc-400">
                    Currently Inside
                </div>

                <div class="mt-4 text-4xl font-bold text-emerald-400">
                    {{ $checkedIn }}
                </div>

                <div class="mt-2 text-sm text-zinc-500">
                    Students currently in library
                </div>

            </div>


            {{-- Checked Out --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <div class="text-sm text-zinc-400">
                    Checked Out
                </div>

                <div class="mt-4 text-4xl font-bold text-orange-400">
                    {{ $checkedOut }}
                </div>

                <div class="mt-2 text-sm text-zinc-500">
                    Completed visits today
                </div>

            </div>


            {{-- Total Records --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <div class="text-sm text-zinc-400">
                    Attendance Records
                </div>

                <div class="mt-4 text-4xl font-bold text-yellow-400">
                    {{ $todayAttendance->count() }}
                </div>

                <div class="mt-2 text-sm text-zinc-500">
                    Today's attendance entries
                </div>

            </div>

            {{-- Total Active Students --}}
<div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

    <div class="text-sm text-zinc-400">
        Active Students
    </div>

    <div class="mt-4 text-4xl font-bold text-sky-400">
        {{ $totalActiveStudents }}
    </div>

    <div class="mt-2 text-sm text-zinc-500">
        Currently active members
    </div>

</div>

        </div>


        {{-- Quick Check-In Placeholder --}}
        <div class="mb-8 rounded-2xl border border-yellow-500/30 bg-zinc-900 p-6">

            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                <div>

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-yellow-400/10 text-xl">
                            ✓
                        </div>

                        <div>
                            <div class="text-lg font-semibold text-white">
                                Quick Check-In
                            </div>

                            <div class="text-sm text-zinc-400">
                                Search a student and record today's attendance.
                            </div>
                        </div>

                    </div>

                </div>

                <div>

                   <a href="{{ route('attendance.kiosk') }}">
    <flux:button
        variant="primary"
        icon="qr-code"
    >
        Open Attendance Kiosk
    </flux:button>
</a>

                </div>

            </div>

        </div>

        {{-- Attendance Filters --}}
<div class="mb-8 rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

    <div class="mb-5">

        <h3 class="text-lg font-semibold text-white">
            Attendance Filters
        </h3>

        <p class="mt-1 text-sm text-zinc-500">
            Search and filter attendance records.
        </p>

    </div>


    <form
        method="GET"
        action="{{ route('attendance.index') }}"
        class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5"
    >


        {{-- Search --}}
        <div class="lg:col-span-2">

            <label class="mb-2 block text-sm font-medium text-zinc-400">
                Search Student
            </label>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Name, Student Code or Mobile"
                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none placeholder:text-zinc-600 focus:border-yellow-500"
            >

        </div>


        {{-- Date --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-zinc-400">
                Date
            </label>

            <input
                type="date"
                name="date"
                value="{{ request('date', today()->format('Y-m-d')) }}"
                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
            >

        </div>


        {{-- Shift --}}
        <div>

            <label class="mb-2 block text-sm font-medium text-zinc-400">
                Shift
            </label>

            <select
                name="shift"
                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
            >

                <option value="">All Shifts</option>

                <option
                    value="Morning"
                    {{ request('shift') === 'Morning' ? 'selected' : '' }}
                >
                    Morning
                </option>

                <option
                    value="Evening"
                    {{ request('shift') === 'Evening' ? 'selected' : '' }}
                >
                    Evening
                </option>

                <option
                    value="Full Day"
                    {{ request('shift') === 'Full Day' ? 'selected' : '' }}
                >
                    Full Day
                </option>

            </select>

        </div>


        {{-- Status --}}
<div>

    <label class="mb-2 block text-sm font-medium text-zinc-400">
        Status
    </label>

    <select
        name="status"
        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
    >

        <option value="">
            All Status
        </option>

        <option
            value="Present"
            {{ request('status') === 'Present' ? 'selected' : '' }}
        >
            Present
        </option>

        <option
            value="Checked In"
            {{ request('status') === 'Checked In' ? 'selected' : '' }}
        >
            Checked In
        </option>

        <option
            value="Checked Out"
            {{ request('status') === 'Checked Out' ? 'selected' : '' }}
        >
            Checked Out
        </option>

    </select>

</div>

        {{-- Buttons --}}
        <div class="flex items-end gap-3 md:col-span-2 lg:col-span-5">

            <button
                type="submit"
                class="rounded-xl bg-yellow-400 px-6 py-3 text-sm font-semibold text-black transition hover:bg-yellow-300"
            >
                Apply Filters
            </button>


            <a
                href="{{ route('attendance.index') }}"
                class="rounded-xl border border-zinc-700 bg-zinc-800 px-6 py-3 text-sm font-semibold text-zinc-200 transition hover:bg-zinc-700"
            >
                Reset
            </a>

        </div>


    </form>

</div>


        {{-- Today's Attendance --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            {{-- Table Header --}}
            <div class="border-b border-zinc-700 px-6 py-5">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Today's Attendance
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Recent check-in and check-out activity.
                        </p>
                    </div>

                    <div class="rounded-lg bg-zinc-800 px-3 py-2 text-sm text-zinc-400">
                        {{ $todayAttendance->count() }} Records
                    </div>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>
                        <tr class="border-b border-zinc-700 text-left">

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Student
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Seat
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Shift
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Check In
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Check Out
                            </th>

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Status
                            </th>

                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Action
                            </th>

                        </tr>
                    </thead>


                    <tbody class="divide-y divide-zinc-800">

                        @forelse ($todayAttendance as $attendance)

                            <tr class="transition hover:bg-zinc-800/50">

                                {{-- Student --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-zinc-800 text-sm font-semibold text-yellow-400">

                                            @if ($attendance->student?->photo)

                                                <img
                                                    src="{{ asset('storage/' . $attendance->student->photo) }}"
                                                    alt="{{ $attendance->student->full_name }}"
                                                    class="h-full w-full object-cover"
                                                >

                                            @else

                                                {{ strtoupper(substr($attendance->student?->first_name ?? 'S', 0, 1)) }}

                                            @endif

                                        </div>

                                        <div>

                                            <div class="font-medium text-white">
                                                {{ $attendance->student?->full_name ?? 'Unknown Student' }}
                                            </div>

                                            <div class="mt-1 text-xs text-zinc-500">
                                                {{ $attendance->student?->student_code ?? '—' }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Seat --}}
                                <td class="px-6 py-5">

                                    @if ($attendance->seat)

                                        <div class="font-medium text-white">
                                            Seat {{ $attendance->seat->seat_number }}
                                        </div>

                                        @if ($attendance->seat->room)
                                            <div class="mt-1 text-xs text-zinc-500">
                                                {{ $attendance->seat->room->name }}
                                            </div>
                                        @endif

                                    @else

                                        <span class="text-zinc-500">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Shift --}}
                                <td class="px-6 py-5">

                                    @php
                                        $shiftClasses = match ($attendance->shift) {
                                            'Morning' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
                                            'Evening' => 'bg-orange-500/10 text-orange-400 border-orange-500/20',
                                            'Full Day' => 'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',
                                            default => 'bg-zinc-800 text-zinc-400 border-zinc-700',
                                        };
                                    @endphp

                                    <span class="inline-flex items-center rounded-lg border px-3 py-1.5 text-xs font-medium {{ $shiftClasses }}">
                                        {{ $attendance->shift ?? '—' }}
                                    </span>

                                </td>


                                {{-- Check In --}}
                                <td class="px-6 py-5">

                                    @if ($attendance->check_in)

                                        <div class="font-medium text-white">
                                            {{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') }}
                                        </div>

                                    @else

                                        <span class="text-zinc-500">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Check Out --}}
                                <td class="px-6 py-5">

                                    @if ($attendance->check_out)

                                        <div class="font-medium text-white">
                                            {{ \Carbon\Carbon::parse($attendance->check_out)->format('h:i A') }}
                                        </div>

                                    @else

                                        <span class="text-zinc-500">
                                            Still Inside
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-5">

                                    @if ($attendance->check_in && !$attendance->check_out)

                                        <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">
                                            Inside
                                        </span>

                                    @else

                                        <span class="inline-flex items-center rounded-full bg-zinc-700 px-3 py-1.5 text-xs font-semibold text-zinc-300">
                                            Checked Out
                                        </span>

                                    @endif

                                </td>


                                {{-- Action --}}
                                <td class="px-6 py-5 text-right">

                                    @if ($attendance->check_in && !$attendance->check_out)

                                        <form
                                            method="POST"
                                            action="{{ route('attendance.check-out', $attendance) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center rounded-lg bg-red-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-red-600"
                                            >
                                                Check Out
                                            </button>

                                        </form>

                                    @else

                                        <span class="text-sm text-zinc-600">
                                            Completed
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-16 text-center">

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-800 text-2xl text-zinc-500">
                                        ✓
                                    </div>

                                    <div class="mt-4 text-base font-medium text-zinc-300">
                                        No attendance records today
                                    </div>

                                    <div class="mt-1 text-sm text-zinc-500">
                                        Student check-ins will appear here.
                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-layouts::app>