<x-layouts::app :title="'Change Seat'">

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-white">
                Change Seat
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Change the seat assigned to this student.
            </p>
        </div>


        {{-- Current Assignment --}}
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6">

            <h2 class="mb-5 text-lg font-semibold text-white">
                Current Assignment
            </h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-4">

                <div>
                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Student
                    </p>

                    <p class="mt-1 font-semibold text-white">
                        {{ $seatAssignment->student->full_name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Membership
                    </p>

                    <p class="mt-1 font-semibold text-white">
                        {{ $seatAssignment->membership->plan->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Shift
                    </p>

                    <p class="mt-1 font-semibold text-orange-400">
                        {{ $seatAssignment->membership->plan->shift }}
                    </p>
                </div>


                <div>
                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Current Seat
                    </p>

                    <p class="mt-1 font-semibold text-indigo-400">
                        Room {{ $seatAssignment->seat->room->name }}
                        •
                        Table {{ $seatAssignment->seat->table_no }}
                        •
                        Seat {{ $seatAssignment->seat->seat_number }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Change Seat Form --}}
        <form
            action="{{ route('seat-assignments.update-change', $seatAssignment) }}"
            method="POST"
            class="rounded-2xl border border-zinc-800 bg-zinc-900 p-6"
        >

            @csrf
            @method('PATCH')


            <div class="mb-6">

                <label class="mb-2 block text-sm font-medium text-zinc-300">
                    Select New Seat
                </label>

                <select
                    name="seat_id"
                    required
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                >

                    <option value="">
                        Select New Seat
                    </option>


                    @foreach($seats as $seat)

                        @php

                            $assignments = $seat->activeAssignments;

                            $hasMorning = $assignments->contains(function ($assignment) {
                                return $assignment->membership?->plan?->shift === 'Morning';
                            });

                            $hasEvening = $assignments->contains(function ($assignment) {
                                return $assignment->membership?->plan?->shift === 'Evening';
                            });

                            $hasFullDay = $assignments->contains(function ($assignment) {
                                return $assignment->membership?->plan?->shift === 'Full Day';
                            });

                            $shift = $seatAssignment->membership->plan->shift;

                            $compatible = false;

                            if ($seat->id === $seatAssignment->seat_id) {

                                $compatible = false;

                            } elseif ($hasFullDay) {

                                $compatible = false;

                            } elseif ($shift === 'Morning' && !$hasMorning) {

                                $compatible = true;

                            } elseif ($shift === 'Evening' && !$hasEvening) {

                                $compatible = true;

                            } elseif (
                                $shift === 'Full Day'
                                && !$hasMorning
                                && !$hasEvening
                                && !$hasFullDay
                            ) {

                                $compatible = true;

                            }

                        @endphp


                        @if($compatible)

                            <option value="{{ $seat->id }}">

                                Room {{ $seat->room->name }}
                                •
                                Table {{ $seat->table_no }}
                                •
                                Seat {{ $seat->seat_number }}

                            </option>

                        @endif

                    @endforeach

                </select>

            </div>


            {{-- Remarks --}}
            <div class="mb-6">

                <label class="mb-2 block text-sm font-medium text-zinc-300">
                    Remarks
                </label>

                <textarea
                    name="remarks"
                    rows="3"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                    placeholder="Optional remarks..."
                ></textarea>

            </div>


            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3">

                <a
                    href="{{ route('seat-assignments.index') }}"
                    class="rounded-xl border border-zinc-700 px-5 py-3 font-semibold text-zinc-300 transition hover:bg-zinc-800 hover:text-white"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="rounded-xl bg-indigo-600 px-6 py-3 font-semibold text-white transition hover:bg-indigo-500"
                >
                    Change Seat
                </button>

            </div>

        </form>

    </div>

</x-layouts::app>