<x-layouts::app :title="'Attendance History'">

    <div class="w-full px-6 py-8 lg:px-10">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <a
                        href="{{ route('attendance.index') }}"
                        class="rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-2 text-sm text-zinc-300 transition hover:bg-zinc-800"
                    >
                        ← Back
                    </a>

                    <div>

                        <h1 class="text-3xl font-bold text-white">
                            Attendance History
                        </h1>

                        <p class="mt-1 text-sm text-zinc-400">
                            Complete attendance history of this student.
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Student Information --}}
        <div class="mb-8 rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="flex flex-col gap-6 sm:flex-row sm:items-center">

                {{-- Photo --}}
                <div class="h-24 w-24 shrink-0 overflow-hidden rounded-2xl bg-zinc-800">

    @if ($student->photo)

        <img
            src="{{ asset('storage/' . $student->photo) }}"
            alt="{{ $student->full_name }}"
            class="block h-24 w-24 object-cover"
        >

    @else

        <div class="flex h-24 w-24 items-center justify-center text-3xl font-bold text-yellow-400">
            {{ strtoupper(substr($student->first_name ?? 'S', 0, 1)) }}
        </div>

    @endif

</div>


                {{-- Student Details --}}
                <div class="min-w-0 flex-1">

                    <h2 class="text-2xl font-bold text-white">
                        {{ $student->full_name }}
                    </h2>

                    <div class="mt-2 flex flex-wrap gap-3">

                        <span class="rounded-lg bg-yellow-400/10 px-3 py-1.5 text-sm font-medium text-yellow-400">
                            {{ $student->student_code }}
                        </span>

                        @if ($student->mobile)

                            <span class="rounded-lg bg-zinc-800 px-3 py-1.5 text-sm text-zinc-400">
                                {{ $student->mobile }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Total Visits --}}
                <div class="rounded-2xl bg-zinc-800 px-6 py-5 text-center">

                    <div class="text-xs uppercase tracking-wide text-zinc-500">
                        Total Visits
                    </div>

                    <div class="mt-2 text-3xl font-bold text-cyan-400">
                        {{ $attendance->count() }}
                    </div>

                </div>

            </div>

        </div>


        {{-- Attendance Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            {{-- Table Header --}}
            <div class="border-b border-zinc-700 px-6 py-5">

                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Attendance Records
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Check-in and check-out history.
                    </p>

                </div>

            </div>


            {{-- Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead>

                        <tr class="border-b border-zinc-700 text-left">

                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-zinc-500">
                                Date
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

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-zinc-800">

                        @forelse ($attendance as $record)

                            <tr class="transition hover:bg-zinc-800/50">

                                {{-- Date --}}
                                <td class="px-6 py-5">

                                    <div class="font-medium text-white">
                                        {{ $record->attendance_date?->format('d M Y') }}
                                    </div>

                                </td>


                                {{-- Seat --}}
                                <td class="px-6 py-5">

                                    @if ($record->seat)

                                        <div class="font-medium text-white">
                                            Seat {{ $record->seat->seat_number }}
                                        </div>

                                        @if ($record->seat->room)

                                            <div class="mt-1 text-xs text-zinc-500">
                                                {{ $record->seat->room->name }}
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

                                        $shiftClasses = match ($record->shift) {

                                            'Morning' =>
                                                'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',

                                            'Evening' =>
                                                'bg-orange-500/10 text-orange-400 border-orange-500/20',

                                            'Full Day' =>
                                                'bg-indigo-500/10 text-indigo-400 border-indigo-500/20',

                                            default =>
                                                'bg-zinc-800 text-zinc-400 border-zinc-700',

                                        };

                                    @endphp

                                    <span
                                        class="inline-flex items-center rounded-lg border px-3 py-1.5 text-xs font-medium {{ $shiftClasses }}"
                                    >
                                        {{ $record->shift ?? '—' }}
                                    </span>

                                </td>


                                {{-- Check In --}}
                                <td class="px-6 py-5">

                                    @if ($record->check_in)

                                        <div class="font-medium text-white">
                                            {{ \Carbon\Carbon::parse($record->check_in)->format('h:i A') }}
                                        </div>

                                    @else

                                        <span class="text-zinc-500">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Check Out --}}
                                <td class="px-6 py-5">

                                    @if ($record->check_out)

                                        <div class="font-medium text-white">
                                            {{ \Carbon\Carbon::parse($record->check_out)->format('h:i A') }}
                                        </div>

                                    @else

                                        <span class="text-emerald-400">
                                            Still Inside
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-6 py-5">

                                    @if ($record->check_in && !$record->check_out)

                                        <span class="inline-flex items-center rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">
                                            Checked In
                                        </span>

                                    @else

                                        <span class="inline-flex items-center rounded-full bg-zinc-700 px-3 py-1.5 text-xs font-semibold text-zinc-300">
                                            Checked Out
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-zinc-800 text-2xl text-zinc-500">
                                        ✓
                                    </div>

                                    <div class="mt-4 text-base font-medium text-zinc-300">
                                        No attendance records found
                                    </div>

                                    <div class="mt-1 text-sm text-zinc-500">
                                        Attendance records will appear here.
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