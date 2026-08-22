<div class="rounded-3xl border border-zinc-800 bg-zinc-900 shadow-2xl overflow-hidden">

    {{-- Header --}}
    <div class="border-b border-zinc-800 px-6 py-5">

        <div class="flex items-center gap-3">

            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600 text-xl text-white shadow-lg">
                🪑
            </div>

            <div>
                <h2 class="text-xl font-bold text-white">
                    Seat Information
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    Live seat details
                </p>
            </div>

        </div>

    </div>


    {{-- Seat Number --}}
    <div class="border-b border-zinc-800 p-6">

        <div class="flex items-center justify-between">

            <span class="text-sm font-medium uppercase tracking-wide text-zinc-400">
                Seat Number
            </span>

            <div
                id="info-seat-number"
                class="rounded-xl bg-indigo-600 px-5 py-2 text-lg font-bold text-white shadow-lg"
            >
                --
            </div>

        </div>

    </div>


    {{-- Seat Occupancy --}}
    <div class="p-6">

        <div
            id="seat-occupancy-summary"
            class="rounded-2xl border border-zinc-800 bg-zinc-950 p-4 text-center"
        >

            <div class="text-xs uppercase tracking-wide text-zinc-500">
                Seat Status
            </div>

            <div
                id="info-status"
                class="mt-2 inline-flex rounded-full bg-zinc-800 px-5 py-2 text-sm font-bold uppercase tracking-wider text-zinc-400"
            >
                Select a seat
            </div>

        </div>

    </div>


    {{-- Morning --}}
    <div
        id="morning-info"
        class="hidden border-t border-zinc-800"
    >

        <div class="border-b border-zinc-800 bg-green-500/5 px-6 py-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-green-500 text-xs font-bold text-white">
                        M
                    </span>

                    <div>
                        <h3 class="font-semibold text-white">
                            Morning
                        </h3>

                        <p class="text-xs text-zinc-500">
                            6:00 AM - 2:00 PM
                        </p>
                    </div>

                </div>

                <span class="rounded-full bg-green-500/15 px-3 py-1 text-xs font-semibold text-green-400">
                    Assigned
                </span>

            </div>

        </div>


        <div class="space-y-4 p-6">

            <div class="flex items-start gap-4">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/15 text-lg">
                    👤
                </div>

                <div class="flex-1">

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Student
                    </p>

                    <h3
                        id="morning-student"
                        class="mt-1 text-base font-semibold text-white"
                    >
                        --
                    </h3>

                </div>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Mobile
                </span>

                <span
                    id="morning-mobile"
                    class="text-sm font-medium text-zinc-200"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Plan
                </span>

                <span
                    id="morning-plan"
                    class="text-sm font-semibold text-white"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Joining
                </span>

                <span
                    id="morning-start"
                    class="text-sm text-zinc-300"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Expiry
                </span>

                <span
                    id="morning-expiry"
                    class="text-sm font-medium text-white"
                >
                    --
                </span>

            </div>

        </div>

    </div>


    {{-- Evening --}}
    <div
        id="evening-info"
        class="hidden border-t border-zinc-800"
    >

        <div class="border-b border-zinc-800 bg-orange-500/5 px-6 py-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-500 text-xs font-bold text-white">
                        E
                    </span>

                    <div>
                        <h3 class="font-semibold text-white">
                            Evening
                        </h3>

                        <p class="text-xs text-zinc-500">
                            2:00 PM - 10:00 PM
                        </p>
                    </div>

                </div>

                <span class="rounded-full bg-orange-500/15 px-3 py-1 text-xs font-semibold text-orange-400">
                    Assigned
                </span>

            </div>

        </div>


        <div class="space-y-4 p-6">

            <div class="flex items-start gap-4">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/15 text-lg">
                    👤
                </div>

                <div class="flex-1">

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Student
                    </p>

                    <h3
                        id="evening-student"
                        class="mt-1 text-base font-semibold text-white"
                    >
                        --
                    </h3>

                </div>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Mobile
                </span>

                <span
                    id="evening-mobile"
                    class="text-sm font-medium text-zinc-200"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Plan
                </span>

                <span
                    id="evening-plan"
                    class="text-sm font-semibold text-white"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Joining
                </span>

                <span
                    id="evening-start"
                    class="text-sm text-zinc-300"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Expiry
                </span>

                <span
                    id="evening-expiry"
                    class="text-sm font-medium text-white"
                >
                    --
                </span>

            </div>

        </div>

    </div>


    {{-- Full Day --}}
    <div
        id="full-day-info"
        class="hidden border-t border-zinc-800"
    >

        <div class="border-b border-zinc-800 bg-blue-500/5 px-6 py-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-600 text-xs font-bold text-white">
                        F
                    </span>

                    <div>
                        <h3 class="font-semibold text-white">
                            Full Day
                        </h3>

                        <p class="text-xs text-zinc-500">
                            6:00 AM - 10:00 PM
                        </p>
                    </div>

                </div>

                <span class="rounded-full bg-blue-500/15 px-3 py-1 text-xs font-semibold text-blue-400">
                    Assigned
                </span>

            </div>

        </div>


        <div class="space-y-4 p-6">

            <div class="flex items-start gap-4">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/15 text-lg">
                    👤
                </div>

                <div class="flex-1">

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Student
                    </p>

                    <h3
                        id="full-day-student"
                        class="mt-1 text-base font-semibold text-white"
                    >
                        --
                    </h3>

                </div>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Mobile
                </span>

                <span
                    id="full-day-mobile"
                    class="text-sm font-medium text-zinc-200"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Plan
                </span>

                <span
                    id="full-day-plan"
                    class="text-sm font-semibold text-white"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Joining
                </span>

                <span
                    id="full-day-start"
                    class="text-sm text-zinc-300"
                >
                    --
                </span>

            </div>


            <div class="flex items-center justify-between">

                <span class="text-sm text-zinc-400">
                    Expiry
                </span>

                <span
                    id="full-day-expiry"
                    class="text-sm font-medium text-white"
                >
                    --
                </span>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div
        id="seat-actions"
        class="hidden border-t border-zinc-800 bg-zinc-950 p-6"
    >

        <button
            id="assignSeatBtn"
            type="button"
            class="w-full rounded-xl bg-indigo-600 px-4 py-3 font-semibold text-white transition hover:bg-indigo-500"
        >
            Assign Seat
        </button>


        <div
            id="occupiedActions"
            class="hidden mt-3 space-y-2"
        >

           <button
    id="changeSeatBtn"
    type="button"
    class="w-full rounded-xl bg-amber-500 px-4 py-3 font-semibold text-white transition hover:bg-amber-400"
>
    Change Seat
</button>

           <form
    id="releaseSeatForm"
    method="POST"
    class="w-full"
>
    @csrf
    @method('PATCH')

    <button
        type="submit"
        onclick="return confirm('Are you sure you want to release this seat?');"
        class="w-full rounded-xl bg-red-600 px-4 py-3 font-semibold text-white transition hover:bg-red-500"
    >
        Release Seat
    </button>
</form>

        </div>

    </div>

</div>