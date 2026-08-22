<div class="mt-8 rounded-3xl border border-zinc-800 bg-zinc-900 p-6 shadow-xl">

    <div class="grid gap-8 lg:grid-cols-2">

        {{-- Seat Status --}}
        <div>

            <h3 class="mb-4 text-lg font-semibold text-white">
                Seat Status
            </h3>

            <div class="space-y-3">

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="h-3 w-3 rounded-full bg-emerald-500"></span>

                        <span class="text-zinc-200">
                            Available
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Empty Seat
                    </span>

                </div>

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="h-3 w-3 rounded-full bg-red-500"></span>

                        <span class="text-zinc-200">
                            Occupied
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Student Assigned
                    </span>

                </div>

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="h-3 w-3 rounded-full bg-yellow-500"></span>

                        <span class="text-zinc-200">
                            Maintenance
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Not Available
                    </span>

                </div>

            </div>

        </div>

        {{-- Shift Badges --}}
        <div>

            <h3 class="mb-4 text-lg font-semibold text-white">
                Shift Badges
            </h3>

            <div class="space-y-3">

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="rounded bg-green-600 px-2 py-1 text-xs font-bold text-white">
                            M
                        </span>

                        <span class="text-zinc-200">
                            Morning Shift
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Morning Only
                    </span>

                </div>

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="rounded bg-orange-500 px-2 py-1 text-xs font-bold text-white">
                            E
                        </span>

                        <span class="text-zinc-200">
                            Evening Shift
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Evening Only
                    </span>

                </div>

                <div class="flex items-center justify-between rounded-xl bg-zinc-800/50 px-4 py-3">

                    <div class="flex items-center gap-3">

                        <span class="rounded bg-blue-600 px-2 py-1 text-xs font-bold text-white">
                            F
                        </span>

                        <span class="text-zinc-200">
                            Full Day
                        </span>

                    </div>

                    <span class="text-sm text-zinc-400">
                        Morning + Evening
                    </span>

                </div>

            </div>

        </div>

    </div>

</div>