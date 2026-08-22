<x-layouts::app :title="'Seat Management'">

<div class="max-w-7xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Seat Management
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Manage library seats and monitor availability.
            </p>
        </div>

        <form action="{{ route('seats.generate') }}" method="POST">
            @csrf

            <flux:button
                type="submit"
                variant="primary">

                Generate Seats

            </flux:button>

        </form>

    </div>

    <!-- Flash Message -->

    @if(session('success'))

        <div class="rounded-xl border border-green-600 bg-green-900/30 p-4 text-green-300">

            {{ session('success') }}

        </div>

    @endif

    <!-- Dashboard Cards -->

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <p class="text-sm text-zinc-400">
                Total Seats
            </p>

            <h2 class="mt-2 text-3xl font-bold text-white">

                {{ $totalSeats }}

            </h2>

        </div>

        <div class="rounded-2xl border border-green-700 bg-green-900/20 p-6">

            <p class="text-sm text-green-300">
                Available
            </p>

            <h2 class="mt-2 text-3xl font-bold text-green-400">

                {{ $availableSeats }}

            </h2>

        </div>

        <div class="rounded-2xl border border-red-700 bg-red-900/20 p-6">

            <p class="text-sm text-red-300">
                Occupied
            </p>

            <h2 class="mt-2 text-3xl font-bold text-red-400">

                {{ $occupiedSeats }}

            </h2>

        </div>

        <div class="rounded-2xl border border-yellow-700 bg-yellow-900/20 p-6">

            <p class="text-sm text-yellow-300">
                Maintenance
            </p>

            <h2 class="mt-2 text-3xl font-bold text-yellow-400">

                {{ $maintenanceSeats }}

            </h2>

        </div>

    </div>

    <!-- Search -->

    <form
        method="GET"
        action="{{ route('seats.index') }}"
        class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

        <div class="grid gap-4 md:grid-cols-4">

            <div>

                <label class="mb-2 block text-sm text-zinc-400">
                    Search Seat
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Seat Number..."
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

            </div>

            <div>

                <label class="mb-2 block text-sm text-zinc-400">
                    Room
                </label>

                <select
                    name="room"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                    <option value="">
                        All Rooms
                    </option>

                    @foreach($rooms as $room)

                        <option
                            value="{{ $room->id }}"
                            @selected(request('room')==$room->id)>

                            {{ $room->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="mb-2 block text-sm text-zinc-400">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                    <option value="">All Status</option>

                    <option value="available"
                        @selected(request('status')=='available')>

                        Available

                    </option>

                    <option value="occupied"
                        @selected(request('status')=='occupied')>

                        Occupied

                    </option>

                    <option value="maintenance"
                        @selected(request('status')=='maintenance')>

                        Maintenance

                    </option>

                </select>

            </div>

            <div class="flex items-end gap-3">

                <flux:button
                    type="submit"
                    variant="primary">

                    Search

                </flux:button>

                <a href="{{ route('seats.index') }}">

                    <flux:button variant="ghost">

                        Reset

                    </flux:button>

                </a>

            </div>

        </div>

    </form>

    <!-- Table -->

    <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-zinc-700">

                <thead class="bg-zinc-800">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            #
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            Room
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            Table
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            Seat
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                            Remarks
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-zinc-700 bg-zinc-900">

                                    @forelse($seats as $seat)

                        <tr class="hover:bg-zinc-800/50">

                            <td class="px-6 py-4 text-white">
                                {{ $loop->iteration + ($seats->firstItem() ?? 0) - 1 }}
                            </td>

                            <td class="px-6 py-4 text-white">
                                {{ $seat->room->name }}
                            </td>

                            <td class="px-6 py-4 text-white">
                                Table {{ $seat->table_no }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-white">
                                {{ $seat->seat_number }}
                            </td>

                            <td class="px-6 py-4">

                                @if($seat->status == 'available')

                                    <span class="rounded-full bg-green-600 px-3 py-1 text-xs font-semibold text-white">
                                        Available
                                    </span>

                                @elseif($seat->status == 'occupied')

                                    <span class="rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white">
                                        Occupied
                                    </span>

                                @else

                                    <span class="rounded-full bg-yellow-600 px-3 py-1 text-xs font-semibold text-white">
                                        Maintenance
                                    </span>

                                @endif

                            </td>

                            <td class="px-6 py-4 text-zinc-300">

                                {{ $seat->remarks ?: '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-12 text-center">

                                <div class="space-y-3">

                                    <div class="text-6xl">
                                        💺
                                    </div>

                                    <h3 class="text-xl font-semibold text-white">
                                        No Seats Found
                                    </h3>

                                    <p class="text-zinc-400">
                                        Click the <strong>Generate Seats</strong> button to automatically create all library seats.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <!-- Pagination -->

    @if($seats->hasPages())

        <div>

            {{ $seats->links() }}

        </div>

    @endif

</div>

</x-layouts::app>