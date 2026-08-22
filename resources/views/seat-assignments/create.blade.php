<x-layouts::app :title="'Assign Seat'">

    <div class="space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-white">
                Assign Seat
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Assign a seat according to the student's membership shift.
            </p>
        </div>


        {{-- Form --}}
        <form
            action="{{ route('seat-assignments.store') }}"
            method="POST"
            class="rounded-2xl border border-zinc-700 bg-zinc-900 p-8"
        >

            @csrf


            {{-- Validation Errors --}}
            @if($errors->any())

                <div class="mb-6 rounded-xl border border-red-700 bg-red-900/30 p-4">

                    <p class="mb-2 font-semibold text-red-300">
                        Please fix the following:
                    </p>

                    <ul class="space-y-1 text-sm text-red-400">

                        @foreach($errors->all() as $error)

                            <li>
                                • {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">


                {{-- Student --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Student
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="student_id"
                        id="student_id"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-amber-500 focus:outline-none"
                    >

                        <option value="">
                            Select Student
                        </option>

                        @foreach($students as $student)

                            <option
                                value="{{ $student->id }}"
                                @selected(old('student_id') == $student->id)
                            >
                                {{ $student->first_name }}
                                {{ $student->last_name }}

                                @if($student->student_code)
                                    ({{ $student->student_code }})
                                @endif
                            </option>

                        @endforeach

                    </select>

                    @error('student_id')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Membership --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Membership
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="membership_id"
                        id="membership_id"
                        disabled
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white disabled:cursor-not-allowed disabled:opacity-60"
                    >

                        <option value="">
                            Select Student First
                        </option>


                        @foreach($memberships as $membership)

                            <option
                                value="{{ $membership->id }}"
                                data-student-id="{{ $membership->student_id }}"
                                data-shift="{{ $membership->plan->shift }}"
                                data-plan="{{ $membership->plan->name }}"
                                data-duration="{{ $membership->plan->duration_months }}"
                                @selected(old('membership_id') == $membership->id)
                            >

                                {{ $membership->plan->name }}

                                —
                                {{ $membership->plan->duration_months }}
                                {{ $membership->plan->duration_months == 1 ? 'Month' : 'Months' }}

                                —
                                {{ $membership->plan->shift }}

                            </option>

                        @endforeach

                    </select>

                    @error('membership_id')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Selected Shift --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Assigned Shift
                    </label>

                    <div
                        id="shiftDisplay"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-zinc-500"
                    >
                        Select membership first
                    </div>

                </div>


                {{-- Seat --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Seat
                        <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="seat_id"
                        id="seat_id"
                        disabled
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white disabled:cursor-not-allowed disabled:opacity-60"
                    >

                        <option value="">
                            Select Membership First
                        </option>


                        @foreach($seats as $seat)

                            @php

                                $activeAssignments = $seat->activeAssignments ?? collect();

                                $hasMorning = $activeAssignments->contains(function ($assignment) {
                                    return optional(optional($assignment->membership)->plan)->shift === 'Morning';
                                });

                                $hasEvening = $activeAssignments->contains(function ($assignment) {
                                    return optional(optional($assignment->membership)->plan)->shift === 'Evening';
                                });

                                $hasFullDay = $activeAssignments->contains(function ($assignment) {
                                    return optional(optional($assignment->membership)->plan)->shift === 'Full Day';
                                });

                            @endphp


                            <option
                                value="{{ $seat->id }}"
                                data-has-morning="{{ $hasMorning ? '1' : '0' }}"
                                data-has-evening="{{ $hasEvening ? '1' : '0' }}"
                                data-has-full-day="{{ $hasFullDay ? '1' : '0' }}"
                                @selected(old('seat_id') == $seat->id)
                            >

                                Room {{ $seat->room->name }}
                                •
                                Table {{ $seat->table_no }}
                                •
                                Seat {{ $seat->seat_number }}

                            </option>

                        @endforeach

                    </select>

                    <p
                        id="seatHelp"
                        class="mt-2 text-xs text-zinc-500"
                    >
                        Select a membership to see available seats.
                    </p>

                    @error('seat_id')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Assigned Date --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Assigned Date
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        name="assigned_date"
                        value="{{ old('assigned_date', date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-amber-500 focus:outline-none"
                    >

                    @error('assigned_date')

                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


            </div>


            {{-- Remarks --}}
            <div class="mt-6">

                <label class="mb-2 block text-sm font-medium text-zinc-300">
                    Remarks
                </label>

                <textarea
                    name="remarks"
                    rows="3"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-amber-500 focus:outline-none"
                    placeholder="Optional remarks..."
                >{{ old('remarks') }}</textarea>

            </div>


            {{-- Actions --}}
            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('seat-assignments.index') }}"
                    class="rounded-xl border border-zinc-700 px-6 py-3 font-semibold text-zinc-300 transition hover:bg-zinc-800 hover:text-white"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    id="assignButton"
                    disabled
                    class="rounded-xl bg-amber-500 px-6 py-3 font-semibold text-black transition hover:bg-amber-400 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Assign Seat
                </button>

            </div>


        </form>

    </div>


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const studentSelect = document.getElementById('student_id');
            const membershipSelect = document.getElementById('membership_id');
            const seatSelect = document.getElementById('seat_id');

            const shiftDisplay = document.getElementById('shiftDisplay');
            const seatHelp = document.getElementById('seatHelp');
            const assignButton = document.getElementById('assignButton');

            const membershipOptions = Array.from(
                membershipSelect.querySelectorAll('option[data-student-id]')
            );

            const seatOptions = Array.from(
                seatSelect.querySelectorAll('option[data-has-morning]')
            );


            function resetSeats() {

                seatSelect.value = '';
                seatSelect.disabled = true;

                seatOptions.forEach(function (option) {
                    option.hidden = true;
                });

                seatSelect.options[0].textContent =
                    'Select Membership First';

                seatHelp.textContent =
                    'Select a membership to see available seats.';

                assignButton.disabled = true;
            }


            function updateSeats(shift) {

                seatSelect.value = '';

                let availableCount = 0;


                seatOptions.forEach(function (option) {

                    const hasMorning =
                        option.dataset.hasMorning === '1';

                    const hasEvening =
                        option.dataset.hasEvening === '1';

                    const hasFullDay =
                        option.dataset.hasFullDay === '1';


                    let available = false;


                    /*
                    |--------------------------------------------------------------------------
                    | Morning
                    |--------------------------------------------------------------------------
                    */

                    if (shift === 'Morning') {

                        available =
                            !hasMorning &&
                            !hasFullDay;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Evening
                    |--------------------------------------------------------------------------
                    */

                    if (shift === 'Evening') {

                        available =
                            !hasEvening &&
                            !hasFullDay;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Full Day
                    |--------------------------------------------------------------------------
                    */

                    if (shift === 'Full Day') {

                        available =
                            !hasMorning &&
                            !hasEvening &&
                            !hasFullDay;

                    }


                    option.hidden = !available;

                    option.disabled = !available;


                    if (available) {
                        availableCount++;
                    }

                });


                seatSelect.disabled = availableCount === 0;


                if (availableCount > 0) {

                    seatSelect.options[0].textContent =
                        'Select Available Seat';

                    seatHelp.textContent =
                        availableCount +
                        ' seat(s) available for ' +
                        shift +
                        ' shift.';

                    assignButton.disabled = false;

                } else {

                    seatSelect.options[0].textContent =
                        'No Seats Available';

                    seatHelp.textContent =
                        'No seat is currently available for this shift.';

                    assignButton.disabled = true;

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Student Change
            |--------------------------------------------------------------------------
            */

            studentSelect.addEventListener('change', function () {

                const studentId = this.value;


                membershipSelect.value = '';

                membershipSelect.disabled = true;

                shiftDisplay.textContent =
                    'Select membership first';

                shiftDisplay.className =
                    'rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-zinc-500';


                membershipOptions.forEach(function (option) {

                    option.hidden =
                        option.dataset.studentId !== studentId;

                });


                resetSeats();


                if (!studentId) {

                    membershipSelect.options[0].textContent =
                        'Select Student First';

                    return;

                }


                const availableMemberships =
                    membershipOptions.filter(function (option) {

                        return option.dataset.studentId === studentId;

                    });


                membershipSelect.disabled =
                    availableMemberships.length === 0;


                membershipSelect.options[0].textContent =
                    availableMemberships.length
                        ? 'Select Membership'
                        : 'No Active Membership';


                if (availableMemberships.length === 0) {

                    shiftDisplay.textContent =
                        'This student has no active membership.';

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Membership Change
            |--------------------------------------------------------------------------
            */

            membershipSelect.addEventListener('change', function () {

                const selectedOption =
                    this.options[this.selectedIndex];


                if (!this.value || !selectedOption) {

                    shiftDisplay.textContent =
                        'Select membership first';

                    shiftDisplay.className =
                        'rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-zinc-500';

                    resetSeats();

                    return;

                }


                const shift =
                    selectedOption.dataset.shift;


                /*
                |--------------------------------------------------------------------------
                | Show Shift
                |--------------------------------------------------------------------------
                */

                shiftDisplay.textContent =
                    shift;


                shiftDisplay.className =
                    'rounded-xl border border-amber-500/40 bg-amber-500/10 px-4 py-3 font-semibold text-amber-400';


                /*
                |--------------------------------------------------------------------------
                | Filter Seats
                |--------------------------------------------------------------------------
                */

                updateSeats(shift);

            });


            /*
            |--------------------------------------------------------------------------
            | Initial state
            |--------------------------------------------------------------------------
            */

            resetSeats();


            /*
            |--------------------------------------------------------------------------
            | Restore old values after validation error
            |--------------------------------------------------------------------------
            */

            @if(old('student_id'))

                studentSelect.dispatchEvent(new Event('change'));

                @if(old('membership_id'))

                    membershipSelect.value =
                        '{{ old('membership_id') }}';

                    membershipSelect.dispatchEvent(new Event('change'));

                @endif

            @endif

        });

    </script>


</x-layouts::app>