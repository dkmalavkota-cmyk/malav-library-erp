<x-layouts::app :title="'Services'">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Services & Features
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage services and features included in membership plans.
                </p>
            </div>

            <a href="{{ route('services.create') }}">
                <flux:button variant="primary">
                    + Add Service
                </flux:button>
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="rounded-xl border border-green-700 bg-green-900/20 p-4 text-green-300">
                {{ session('success') }}
            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="rounded-xl border border-red-700 bg-red-900/20 p-4">

                <ul class="space-y-1 text-red-300">

                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Search --}}
        <form
            method="GET"
            action="{{ route('services.index') }}"
            class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5"
        >

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search service or code..."
                    class="flex-1 rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder-zinc-500 focus:border-yellow-500 focus:outline-none"
                >

                <flux:button type="submit" variant="primary">
                    Search
                </flux:button>

                @if(request('search'))

                    <a href="{{ route('services.index') }}">
                        <flux:button type="button" variant="ghost">
                            Reset
                        </flux:button>
                    </a>

                @endif

            </div>

        </form>


        {{-- Stats --}}
        <div class="grid gap-6 md:grid-cols-3">

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Services
                </p>

                <p class="mt-2 text-3xl font-bold text-white">
                    {{ $services->total() }}
                </p>

            </div>


            <div class="rounded-2xl border border-green-700 bg-green-900/20 p-6">

                <p class="text-sm text-green-300">
                    Active Services
                </p>

                <p class="mt-2 text-3xl font-bold text-green-400">
                    {{ \App\Models\Service::where('is_active', true)->count() }}
                </p>

            </div>


            <div class="rounded-2xl border border-red-700 bg-red-900/20 p-6">

                <p class="text-sm text-red-300">
                    Inactive Services
                </p>

                <p class="mt-2 text-3xl font-bold text-red-400">
                    {{ \App\Models\Service::where('is_active', false)->count() }}
                </p>

            </div>

        </div>


        {{-- Services Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-zinc-700">

                    <thead class="bg-zinc-800">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Service
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Code
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Description
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Status
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-zinc-700">

                        @forelse($services as $service)

                            <tr class="hover:bg-zinc-800/50">

                                <td class="px-6 py-4 text-zinc-400">
                                    {{ $loop->iteration + ($services->firstItem() ?? 0) - 1 }}
                                </td>


                                <td class="px-6 py-4">

                                    <div class="font-semibold text-white">
                                        {{ $service->name }}
                                    </div>

                                </td>


                                <td class="px-6 py-4">

                                    <span class="rounded-lg bg-zinc-800 px-3 py-1 text-xs font-medium text-yellow-400">
                                        {{ $service->code }}
                                    </span>

                                </td>


                                <td class="max-w-md px-6 py-4 text-sm text-zinc-400">

                                    {{ $service->description ?: '-' }}

                                </td>


                                <td class="px-6 py-4">

                                    @if($service->is_active)

                                        <span class="rounded-full bg-green-600/20 px-3 py-1 text-xs font-semibold text-green-400">
                                            Active
                                        </span>

                                    @else

                                        <span class="rounded-full bg-red-600/20 px-3 py-1 text-xs font-semibold text-red-400">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                <td class="px-6 py-4">

                                    <span class="text-sm text-zinc-500">
                                        —
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="text-5xl">
                                        ⚙️
                                    </div>

                                    <h3 class="mt-4 text-xl font-semibold text-white">
                                        No Services Found
                                    </h3>

                                    <p class="mt-2 text-sm text-zinc-400">
                                        Create your first service to use it in membership plans.
                                    </p>

                                    <a
                                        href="{{ route('services.create') }}"
                                        class="mt-5 inline-block"
                                    >
                                        <flux:button variant="primary">
                                            Add Service
                                        </flux:button>
                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        @if($services->hasPages())

            <div>
                {{ $services->links() }}
            </div>

        @endif

    </div>

</x-layouts::app>