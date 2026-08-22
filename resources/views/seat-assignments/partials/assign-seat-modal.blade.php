<div
    id="assignSeatModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70 p-4 backdrop-blur-sm"
>

    <div
        class="flex max-h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900 shadow-2xl"
    >

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="flex shrink-0 items-center justify-between border-b border-zinc-800 px-6 py-5">

            <div>

                <h2 class="text-2xl font-bold text-white">
                    Assign Seat
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    Assign a student to the selected seat.
                </p>

            </div>

            <button
                type="button"
                onclick="closeAssignSeatModal()"
                class="flex h-9 w-9 items-center justify-center rounded-lg text-xl text-zinc-400 transition hover:bg-zinc-800 hover:text-white"
            >
                ×
            </button>

        </div>


        {{-- =========================================================
            FORM
        ========================================================== --}}
        <form
            action="{{ route('seat-assignments.store') }}"
            method="POST"
            class="flex min-h-0 flex-1 flex-col"
        >

            @csrf


            {{-- BODY --}}
            <div class="min-h-0 flex-1 space-y-5 overflow-y-auto p-6">


                {{-- =================================================
                    SEAT NUMBER
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Seat Number
                    </label>

                    <input
                        id="modalSeatNumber"
                        type="text"
                        readonly
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 font-medium text-white outline-none"
                    >

                    <input
                        type="hidden"
                        id="seatId"
                        name="seat_id"
                    >

                </div>


                {{-- =================================================
                    STUDENT
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Student
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="studentSelect"
                        name="student_id"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                    >

                        <option value="">
                            Select Student
                        </option>

                        @foreach($students as $student)

                            <option value="{{ $student->id }}">
                                {{ $student->full_name }}
                                ({{ $student->student_code }})
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                    MEMBERSHIP
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Membership
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        id="membershipSelect"
                        name="membership_id"
                        required
                        disabled
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10 disabled:cursor-not-allowed disabled:opacity-60"
                    >

                        <option value="">
                            Select Student First
                        </option>

                    </select>


                    <p
                        id="membershipHelp"
                        class="mt-2 text-xs text-zinc-500"
                    >
                        Select a student to load their active memberships.
                    </p>

                </div>


                {{-- =================================================
                    ASSIGNED DATE
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Assigned Date
                    </label>

                    <input
                        type="date"
                        name="assigned_date"
                        value="{{ date('Y-m-d') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                    >

                </div>


                {{-- =================================================
                    REMARKS
                ================================================== --}}
                <div>

                    <label
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Remarks
                    </label>

                    <textarea
                        name="remarks"
                        rows="3"
                        class="w-full resize-none rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                        placeholder="Optional remarks..."
                    ></textarea>

                </div>

            </div>


            {{-- =====================================================
                FOOTER
            ====================================================== --}}
            <div class="flex shrink-0 items-center justify-end gap-3 border-t border-zinc-800 px-6 py-5">

                <button
                    type="button"
                    onclick="closeAssignSeatModal()"
                    class="rounded-xl border border-zinc-700 px-5 py-2.5 font-medium text-zinc-300 transition hover:bg-zinc-800 hover:text-white"
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    id="assignSeatSubmit"
                    disabled
                    class="rounded-xl bg-indigo-600 px-6 py-2.5 font-semibold text-white transition hover:bg-indigo-500 disabled:cursor-not-allowed disabled:opacity-50"
                >
                    Assign Seat
                </button>

            </div>

        </form>

    </div>

</div>


{{-- ===============================================================
    MEMBERSHIP DATA
================================================================ --}}
@php
    $assignSeatMemberships = $memberships->map(function ($membership) {
        return [
            'id' => $membership->id,
            'student_id' => $membership->student_id,
            'plan' => $membership->plan?->name ?? 'Plan Not Found',
            'shift' => $membership->plan?->shift ?? '',
            'status' => $membership->status ?? '',
        ];
    })->values()->toArray();
@endphp

<script>
    window.assignSeatMemberships = {!! json_encode($assignSeatMemberships) !!};
</script>



{{-- ===============================================================
    ASSIGN SEAT JAVASCRIPT
================================================================ --}}
<script>

(function () {

    function initAssignSeatMemberships() {

        const studentSelect =
            document.getElementById('studentSelect');

        const membershipSelect =
            document.getElementById('membershipSelect');

        const membershipHelp =
            document.getElementById('membershipHelp');

        const submitButton =
            document.getElementById('assignSeatSubmit');


        if (
            !studentSelect ||
            !membershipSelect
        ) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Avoid duplicate initialization
        |--------------------------------------------------------------------------
        */

        if (studentSelect.dataset.initialized === 'true') {
            return;
        }

        studentSelect.dataset.initialized = 'true';


        /*
        |--------------------------------------------------------------------------
        | Membership data
        |--------------------------------------------------------------------------
        */

        const memberships =
            window.assignSeatMemberships || [];


        /*
        |--------------------------------------------------------------------------
        | Reset membership dropdown
        |--------------------------------------------------------------------------
        */

        function resetMembershipDropdown() {

            membershipSelect.innerHTML = '';

            const option =
                document.createElement('option');

            option.value = '';

            option.textContent =
                'Select Student First';

            membershipSelect.appendChild(option);

            membershipSelect.value = '';

            membershipSelect.disabled = true;


            if (submitButton) {

                submitButton.disabled = true;

            }


            if (membershipHelp) {

                membershipHelp.textContent =
                    'Select a student to load their active memberships.';

                membershipHelp.className =
                    'mt-2 text-xs text-zinc-500';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Load memberships
        |--------------------------------------------------------------------------
        */

        function loadMemberships(studentId) {

            membershipSelect.innerHTML = '';


            /*
            |--------------------------------------------------------------------------
            | No student selected
            |--------------------------------------------------------------------------
            */

            if (!studentId) {

                resetMembershipDropdown();

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Find memberships
            |--------------------------------------------------------------------------
            */

            const studentMemberships =
                memberships.filter(function (membership) {

                    return String(membership.student_id) ===
                        String(studentId);

                });


            /*
            |--------------------------------------------------------------------------
            | No memberships
            |--------------------------------------------------------------------------
            */

            if (studentMemberships.length === 0) {

                const option =
                    document.createElement('option');

                option.value = '';

                option.textContent =
                    'No Active Membership Found';

                membershipSelect.appendChild(option);

                membershipSelect.disabled = true;


                if (submitButton) {

                    submitButton.disabled = true;

                }


                if (membershipHelp) {

                    membershipHelp.textContent =
                        'This student does not have an active membership.';

                    membershipHelp.className =
                        'mt-2 text-xs text-red-400';

                }

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Placeholder
            |--------------------------------------------------------------------------
            */

            const placeholder =
                document.createElement('option');

            placeholder.value = '';

            placeholder.textContent =
                'Select Membership';

            membershipSelect.appendChild(
                placeholder
            );


            /*
            |--------------------------------------------------------------------------
            | Add memberships
            |--------------------------------------------------------------------------
            */

            studentMemberships.forEach(function (membership) {

                const option =
                    document.createElement('option');

                option.value =
                    membership.id;


                let label =
                    membership.plan;


                if (membership.shift) {

                    label +=
                        ' (' +
                        membership.shift +
                        ')';

                }


                option.textContent =
                    label;


                membershipSelect.appendChild(
                    option
                );

            });


            /*
            |--------------------------------------------------------------------------
            | Enable dropdown
            |--------------------------------------------------------------------------
            */

            membershipSelect.disabled = false;


            if (submitButton) {

                submitButton.disabled = true;

            }


            if (membershipHelp) {

                membershipHelp.textContent =
                    studentMemberships.length === 1
                        ? '1 active membership available.'
                        : studentMemberships.length +
                          ' active memberships available.';

                membershipHelp.className =
                    'mt-2 text-xs text-emerald-400';

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Student changed
        |--------------------------------------------------------------------------
        */

        studentSelect.addEventListener(
            'change',
            function () {

                loadMemberships(
                    this.value
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Membership changed
        |--------------------------------------------------------------------------
        */

        membershipSelect.addEventListener(
            'change',
            function () {

                if (submitButton) {

                    submitButton.disabled =
                        !this.value;

                }

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Initial state
        |--------------------------------------------------------------------------
        */

        resetMembershipDropdown();

    }


    /*
    |--------------------------------------------------------------------------
    | Normal page load
    |--------------------------------------------------------------------------
    */

    if (
        document.readyState === 'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            initAssignSeatMemberships
        );

    } else {

        initAssignSeatMemberships();

    }


    /*
    |--------------------------------------------------------------------------
    | Livewire navigation
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'livewire:navigated',
        function () {

            initAssignSeatMemberships();

        }
    );


})();

</script>