<x-layouts::app :title="'Student ID Cards'">

<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Student ID Cards
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                View and print student library ID cards.
            </p>
        </div>

        <a href="{{ route('students.index') }}">
            <flux:button variant="ghost">
                ← Students
            </flux:button>
        </a>

    </div>


    {{-- Search --}}
    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

        <form
            method="GET"
            action="{{ route('students.id-cards') }}"
            class="flex flex-col md:flex-row gap-3"
        >

            <div class="flex-1">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search student code, name or mobile..."
                    class="w-full rounded-lg border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white placeholder-zinc-500 focus:border-yellow-500 focus:ring-yellow-500"
                >

            </div>

            <flux:button type="submit" variant="primary">
                Search
            </flux:button>

            @if(request('search'))

                <a href="{{ route('students.id-cards') }}">

                    <flux:button type="button" variant="ghost">
                        Clear
                    </flux:button>

                </a>

            @endif

        </form>

    </div>


    {{-- Students --}}
    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="border-b border-zinc-700 bg-zinc-800">

                    <tr>

                        <th class="px-5 py-4 text-left font-semibold text-zinc-300">
                            Student
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-zinc-300">
                            Membership
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-zinc-300">
                            Seat
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-zinc-300">
                            Shift
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-zinc-300">
                            Valid Till
                        </th>

                        <th class="px-5 py-4 text-right font-semibold text-zinc-300">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-zinc-800">

                    @forelse($students as $student)

                        @php
                            $assignment = $student->seatAssignments->first();
                        @endphp

                        <tr class="hover:bg-zinc-800/60 transition">


                            {{-- Student --}}

                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    @if($student->photo)

                                        <img
                                            src="{{ asset('storage/'.$student->photo) }}"
                                            alt="{{ $student->full_name }}"
                                            class="w-11 h-11 rounded-full object-cover border border-zinc-700"
                                        >

                                    @else

                                        <div class="w-11 h-11 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center text-sm font-bold text-zinc-400">

                                            {{ strtoupper(substr($student->first_name, 0, 1)) }}

                                        </div>

                                    @endif


                                    <div>

                                        <p class="font-semibold text-white">
                                            {{ $student->full_name }}
                                        </p>

                                        <p class="text-xs text-zinc-500 mt-0.5">
                                            {{ $student->student_code }}
                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Membership --}}

                            <td class="px-5 py-4">

                                <p class="text-white">

                                    {{ $assignment?->membership?->plan?->name ?? '-' }}

                                </p>

                            </td>


                            {{-- Seat --}}

                            <td class="px-5 py-4">

                                <p class="text-white">

                                    {{ $assignment?->seat?->seat_number ?? '-' }}

                                </p>

                                @if($assignment?->seat?->room?->name)

                                    <p class="text-xs text-zinc-500 mt-0.5">
                                        {{ $assignment->seat->room->name }}
                                    </p>

                                @endif

                            </td>


                            {{-- Shift --}}

                            <td class="px-5 py-4">

                                @if($assignment?->membership?->plan?->shift)

                                    <span class="inline-flex rounded-full bg-zinc-800 px-2.5 py-1 text-xs font-medium text-zinc-300">

                                        {{ $assignment->membership->plan->shift }}

                                    </span>

                                @else

                                    <span class="text-zinc-500">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Valid Till --}}

                            <td class="px-5 py-4">

                                @if($assignment?->membership?->end_date)

                                    <span class="text-white">

                                        {{ $assignment->membership->end_date->format('d M Y') }}

                                    </span>

                                @else

                                    <span class="text-zinc-500">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="px-5 py-4 text-right">

                                <a
                                    href="{{ route('students.id-card', $student) }}"
                                    target="_blank"
                                >

                                    <flux:button
                                        size="sm"
                                        variant="primary"
                                    >
                                        ID Card
                                    </flux:button>

                                </a>

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-5 py-12 text-center"
                            >

                                <div class="text-zinc-400">

                                    <p class="text-lg font-semibold text-white">
                                        No students found
                                    </p>

                                    <p class="mt-1 text-sm">
                                        Try searching with another student name, code or mobile number.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}

        @if($students->hasPages())

            <div class="border-t border-zinc-700 px-5 py-4">

                {{ $students->links() }}

            </div>

        @endif

    </div>

</div>

</x-layouts::app>