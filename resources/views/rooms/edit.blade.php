<x-layouts::app :title="'Edit Room'">

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-white">
                Edit Room
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Update room information.
            </p>

        </div>

        <a href="{{ route('rooms.index') }}">
            <flux:button variant="ghost">
                Back
            </flux:button>
        </a>

    </div>

    <form
        action="{{ route('rooms.update', $room) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-8">

            <div class="grid gap-6 md:grid-cols-2">

                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Room Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $room->name) }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                </div>

                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Room Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        value="{{ old('code', $room->code) }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                </div>

                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Floor
                    </label>

                    <input
                        type="text"
                        name="floor"
                        value="{{ old('floor', $room->floor) }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                </div>

                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Total Seats
                    </label>

                    <input
                        type="number"
                        name="total_seats"
                        value="{{ old('total_seats', $room->total_seats) }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                </div>

                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                        <option value="Active" {{ $room->status=='Active'?'selected':'' }}>
                            Active
                        </option>

                        <option value="Inactive" {{ $room->status=='Inactive'?'selected':'' }}>
                            Inactive
                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-6">

                <label class="mb-2 block text-sm text-zinc-300">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">{{ old('description', $room->description) }}</textarea>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('rooms.index') }}">
                    <flux:button variant="ghost">
                        Cancel
                    </flux:button>
                </a>

                <flux:button
                    type="submit"
                    variant="primary">

                    Update Room

                </flux:button>

            </div>

        </div>

    </form>

</div>

</x-layouts::app>