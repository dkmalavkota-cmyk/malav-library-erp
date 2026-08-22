<x-layouts::app :title="'Add Room'">

<div class="max-w-5xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-white">
                Add New Room
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Create a new library room.
            </p>

        </div>

        <a href="{{ route('rooms.index') }}">

            <flux:button variant="ghost">

                Back

            </flux:button>

        </a>

    </div>

    <form
        action="{{ route('rooms.store') }}"
        method="POST">

        @csrf

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-8">

            <div class="grid gap-6 md:grid-cols-2">

                <!-- Room Name -->
                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Room Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Room Code -->
                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Room Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        value="{{ old('code') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                    @error('code')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Floor -->
                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Floor
                    </label>

                    <input
                        type="text"
                        name="floor"
                        value="{{ old('floor') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                </div>

                <!-- Total Seats -->
                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Total Seats
                    </label>

                    <input
                        type="number"
                        name="total_seats"
                        value="{{ old('total_seats') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                    @error('total_seats')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Status -->
                <div>

                    <label class="mb-2 block text-sm text-zinc-300">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">

                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>

                    </select>

                </div>

            </div>

            <!-- Description -->

            <div class="mt-6">

                <label class="mb-2 block text-sm text-zinc-300">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white">{{ old('description') }}</textarea>

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

                    Save Room

                </flux:button>

            </div>

        </div>

    </form>

</div>

</x-layouts::app>