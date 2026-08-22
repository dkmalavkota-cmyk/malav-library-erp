<x-layouts::app :title="'Add Service'">

    <div class="max-w-4xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Add Service
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Create a service or feature for membership plans.
                </p>

            </div>

            <a href="{{ route('services.index') }}">
                <flux:button variant="ghost">
                    Back
                </flux:button>
            </a>

        </div>


        {{-- Errors --}}
        @if($errors->any())

            <div class="rounded-xl border border-red-700 bg-red-900/20 p-5">

                <ul class="space-y-1 text-red-300">

                    @foreach($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Form --}}
        <form
            action="{{ route('services.store') }}"
            method="POST"
        >

            @csrf


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <div class="space-y-6">


                    {{-- Service Name --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-300">

                            Service / Feature Name
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="100 Printouts / Month"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder-zinc-500 focus:border-yellow-500 focus:outline-none"
                        >

                    </div>


                    {{-- Description --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Describe what this service includes..."
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder-zinc-500 focus:border-yellow-500 focus:outline-none"
                        >{{ old('description') }}</textarea>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                            Status
                        </label>

                        <select
                            name="is_active"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
                        >

                            <option value="1" @selected(old('is_active', 1) == 1)>
                                Active
                            </option>

                            <option value="0" @selected(old('is_active') === '0')>
                                Inactive
                            </option>

                        </select>

                    </div>


                </div>


                {{-- Buttons --}}
                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('services.index') }}">

                        <flux:button type="button" variant="ghost">
                            Cancel
                        </flux:button>

                    </a>


                    <flux:button
                        type="submit"
                        variant="primary"
                    >
                        Save Service
                    </flux:button>

                </div>

            </div>

        </form>

    </div>

</x-layouts::app>