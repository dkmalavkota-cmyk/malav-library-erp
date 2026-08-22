<x-layouts::app :title="'Memberships'">

    <div class="space-y-6">

        @if(session('success'))

            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="rounded-xl border border-green-600 bg-green-600/10 px-5 py-4 text-green-400"
            >

                {{ session('success') }}

            </div>

        @endif


        <!-- Header -->

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Membership Management
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage student memberships.
                </p>

            </div>


            <a href="{{ route('memberships.create') }}">

                <flux:button
                    variant="primary"
                    icon="plus"
                >
                    Add Membership
                </flux:button>

            </a>

        </div>


        <!-- Statistics -->

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Memberships
                </p>

                <h2 class="mt-3 text-4xl font-bold text-yellow-400">
                    {{ $totalMemberships }}
                </h2>

            </div>


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Active
                </p>

                <h2 class="mt-3 text-4xl font-bold text-green-400">
                    {{ $activeMemberships }}
                </h2>

            </div>


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Expired
                </p>

                <h2 class="mt-3 text-4xl font-bold text-red-400">
                    {{ $expiredMemberships }}
                </h2>

            </div>


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Today's Memberships
                </p>

                <h2 class="mt-3 text-4xl font-bold text-sky-400">
                    {{ $todayMemberships }}
                </h2>

            </div>

        </div>


        <!-- Table -->

        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <table class="min-w-full">

                <thead class="border-b border-zinc-700">

                    <tr class="text-left text-sm text-zinc-400">

                        <th class="px-6 py-4">
                            Student
                        </th>

                        <th class="px-6 py-4">
                            Plan
                        </th>

                        <th class="px-6 py-4">
                            Start
                        </th>

                        <th class="px-6 py-4">
                            End
                        </th>

                        <th class="px-6 py-4">
                            Amount
                        </th>

                        <th class="px-6 py-4">
                            Status
                        </th>

                        <th class="px-6 py-4 text-right">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($memberships as $membership)

                        <tr class="border-b border-zinc-800">

                            {{-- Student --}}

                            <td class="px-6 py-4 text-white">

                                {{ $membership->student?->first_name ?? 'Unknown Student' }}

                                {{ $membership->student?->last_name ?? '' }}

                            </td>


                            {{-- Plan --}}

                            <td class="px-6 py-4 text-zinc-300">

                                {{ $membership->plan?->name ?? 'Unknown Plan' }}

                            </td>


                            {{-- Start Date --}}

                            <td class="px-6 py-4 text-zinc-300">

                                {{ $membership->start_date?->format('d M Y') }}

                            </td>


                            {{-- End Date --}}

                            <td class="px-6 py-4 text-zinc-300">

                                {{ $membership->end_date?->format('d M Y') }}

                            </td>


                            {{-- Amount --}}

                            <td class="px-6 py-4 text-zinc-300">

                                ₹{{ number_format($membership->final_amount, 2) }}

                            </td>


                            {{-- Status --}}

                            <td class="px-6 py-4">

                                @if($membership->status === 'Active')

                                    <span
                                        class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-medium text-green-400"
                                    >
                                        Active
                                    </span>

                                @else

                                    <span
                                        class="rounded-full bg-red-500/20 px-3 py-1 text-xs font-medium text-red-400"
                                    >
                                        {{ $membership->status }}
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="px-6 py-4 text-right">

                                @if($membership->status === 'Expired')

                                    <a href="{{ route('memberships.renew', $membership) }}">

                                        <flux:button
                                            size="sm"
                                            variant="primary"
                                            icon="arrow-path"
                                        >
                                            Renew
                                        </flux:button>

                                    </a>

                                @else

                                    <span class="text-xs text-zinc-600">
                                        —
                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-10 text-center text-zinc-500"
                            >
                                No memberships found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            <!-- Pagination -->

            <div class="border-t border-zinc-700 p-4">

                {{ $memberships->links() }}

            </div>

        </div>

    </div>

</x-layouts::app>