<x-layouts::app :title="__('Rooms')">

    <div class="space-y-6">

        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="rounded-xl border border-green-600 bg-green-600/10 px-5 py-4 text-green-400">

                {{ session('success') }}

            </div>
        @endif

        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Room Management
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage library rooms and seating capacity.
                </p>

            </div>

            <a href="{{ route('rooms.create') }}">

                <flux:button variant="primary" icon="plus">

                    Add Room

                </flux:button>

            </a>

        </div>

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

            <form method="GET" action="{{ route('rooms.index') }}">

                <div class="flex flex-col gap-4 md:flex-row">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search Room Name or Code..."
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:border-yellow-500 focus:outline-none">

                    <flux:button
                        type="submit"
                        variant="primary">

                        Search

                    </flux:button>

                    @if(request('search'))

                        <a href="{{ route('rooms.index') }}">

                            <flux:button variant="ghost">

                                Clear

                            </flux:button>

                        </a>

                    @endif

                </div>

            </form>

        </div>

        <div class="grid gap-6 md:grid-cols-3">

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Rooms
                </p>

                <h2 class="mt-3 text-4xl font-bold text-yellow-400">
                    {{ $totalRooms }}
                </h2>

            </div>

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Active Rooms
                </p>

                <h2 class="mt-3 text-4xl font-bold text-green-400">
                    {{ $activeRooms }}
                </h2>

            </div>

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Inactive Rooms
                </p>

                <h2 class="mt-3 text-4xl font-bold text-red-400">
                    {{ $inactiveRooms }}
                </h2>

            </div>

        </div>

        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

    <table class="min-w-full">

        <thead class="border-b border-zinc-700">

            <tr class="text-left text-sm text-zinc-400">

                <th class="px-6 py-4">Room</th>
                <th class="px-6 py-4">Code</th>
                <th class="px-6 py-4">Floor</th>
                <th class="px-6 py-4">Seats</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Actions</th>

            </tr>

        </thead>

        <tbody>

        @forelse($rooms as $room)

            <tr class="border-b border-zinc-800 hover:bg-zinc-800/50">

                <td class="px-6 py-4 text-white font-medium">
                    {{ $room->name }}
                </td>

                <td class="px-6 py-4 text-yellow-400">
                    {{ $room->code }}
                </td>

                <td class="px-6 py-4 text-zinc-300">
                    {{ $room->floor ?: '-' }}
                </td>

                <td class="px-6 py-4 text-sky-400">
                    {{ $room->total_seats }}
                </td>

                <td class="px-6 py-4">

                    @if($room->status == 'Active')

                        <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs text-green-400">
                            Active
                        </span>

                    @else

                        <span class="rounded-full bg-red-500/20 px-3 py-1 text-xs text-red-400">
                            Inactive
                        </span>

                    @endif

                </td>

                <td class="px-6 py-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('rooms.show',$room) }}">
                            <flux:button size="sm" variant="ghost">
                                View
                            </flux:button>
                        </a>

                        <a href="{{ route('rooms.edit',$room) }}">
                            <flux:button size="sm" variant="primary">
                                Edit
                            </flux:button>
                        </a>

                        <form
                            action="{{ route('rooms.destroy',$room) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this room?');">

                            @csrf
                            @method('DELETE')

                            <flux:button
                                type="submit"
                                size="sm"
                                variant="danger">

                                Delete

                            </flux:button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6"
                    class="px-6 py-10 text-center text-zinc-500">

                    No rooms found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    <div class="border-t border-zinc-700 p-4">

        {{ $rooms->links() }}

    </div>

</div>

</div>

</x-layouts::app>