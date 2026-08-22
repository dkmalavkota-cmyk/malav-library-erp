@csrf

<div class="grid gap-6 md:grid-cols-2">

    {{-- Plan Name --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-300">
            Plan Name <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            name="name"
            value="{{ old('name', $membershipPlan->name ?? '') }}"
            placeholder="Silver Membership"
            required
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
        >

        @error('name')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>


    {{-- Duration --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-300">
            Duration <span class="text-red-500">*</span>
        </label>

        <select
            name="duration_months"
            required
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
        >

            @foreach([1, 3, 6, 12] as $month)

                <option
                    value="{{ $month }}"
                    @selected(old('duration_months', $membershipPlan->duration_months ?? '') == $month)
                >
                    {{ $month }} Month{{ $month > 1 ? 's' : '' }}
                </option>

            @endforeach

        </select>

        @error('duration_months')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>


    {{-- Shift --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-300">
            Shift <span class="text-red-500">*</span>
        </label>

        <select
            name="shift"
            required
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
        >

            <option
                value="Morning"
                @selected(old('shift', $membershipPlan->shift ?? '') == 'Morning')
            >
                Morning (6:00 AM - 2:00 PM)
            </option>

            <option
                value="Evening"
                @selected(old('shift', $membershipPlan->shift ?? '') == 'Evening')
            >
                Evening (2:00 PM - 10:00 PM)
            </option>

            <option
                value="Full Day"
                @selected(old('shift', $membershipPlan->shift ?? '') == 'Full Day')
            >
                Full Day (6:00 AM - 10:00 PM)
            </option>

        </select>

        @error('shift')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>


    {{-- Price --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-300">
            Plan Price <span class="text-red-500">*</span>
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            name="price"
            value="{{ old('price', $membershipPlan->price ?? '') }}"
            placeholder="1200"
            required
            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
        >

        @error('price')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

        <p class="mt-1 text-xs text-zinc-500">
            Enter the total price for this selected duration.
        </p>
    </div>


    {{-- Badge Color --}}
    <div>
        <label class="mb-2 block text-sm font-medium text-zinc-300">
            Badge Color
        </label>

        <input
            type="color"
            name="badge_color"
            value="{{ old('badge_color', $membershipPlan->badge_color ?? '#3B82F6') }}"
            class="h-12 w-full rounded-xl border border-zinc-700 bg-zinc-800"
        >

        @error('badge_color')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
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

            <option
                value="1"
                @selected(old('is_active', $membershipPlan->is_active ?? 1) == 1)
            >
                Active
            </option>

            <option
                value="0"
                @selected(old('is_active', $membershipPlan->is_active ?? 1) == 0)
            >
                Inactive
            </option>

        </select>

        @error('is_active')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

</div>


{{-- Description --}}
<div class="mt-6">

    <label class="mb-2 block text-sm font-medium text-zinc-300">
        Description
    </label>

    <textarea
        rows="4"
        name="description"
        placeholder="Basic library access..."
        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
    >{{ old('description', $membershipPlan->description ?? '') }}</textarea>

    @error('description')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror



</div>

{{-- Included Services --}}
<div class="mt-6">

    <div class="mb-3">

        <label class="block text-sm font-medium text-zinc-300">
            Included Services / Features
        </label>

        <p class="mt-1 text-xs text-zinc-500">
            Select the services and benefits included in this membership plan.
        </p>

    </div>


    @if($services->count())

        <div class="grid gap-3 md:grid-cols-2">

            @foreach($services as $service)

                <label
                    class="flex cursor-pointer items-start gap-3 rounded-xl border border-zinc-700 bg-zinc-800 p-4 transition hover:border-yellow-500"
                >

                    <input
                        type="checkbox"
                        name="services[]"
                        value="{{ $service->id }}"
                        class="mt-1 h-4 w-4 rounded border-zinc-600 bg-zinc-700 text-yellow-500 focus:ring-yellow-500"

                        @checked(
                            in_array(
                                $service->id,
                                old(
                                    'services',
                                    isset($membershipPlan)
                                        ? $membershipPlan->services->pluck('id')->toArray()
                                        : []
                                )
                            )
                        )
                    >

                    <div>

                        <p class="font-medium text-white">
                            {{ $service->name }}
                        </p>

                        @if($service->description)

                            <p class="mt-1 text-xs text-zinc-400">
                                {{ $service->description }}
                            </p>

                        @endif

                    </div>

                </label>

            @endforeach

        </div>

    @else

        <div class="rounded-xl border border-dashed border-zinc-700 bg-zinc-800/50 p-6 text-center">

            <p class="text-sm text-zinc-400">
                No active services available.
            </p>

            <a
                href="{{ route('services.create') }}"
                class="mt-3 inline-block text-sm font-medium text-yellow-400 hover:text-yellow-300"
            >
                + Create a Service
            </a>

        </div>

    @endif

</div>


{{-- Buttons --}}
<div class="mt-8 flex gap-3">

    <flux:button
        type="submit"
        variant="primary"
    >
        Save Plan
    </flux:button>

    <a href="{{ route('membership-plans.index') }}">
        <flux:button variant="ghost">
            Cancel
        </flux:button>
    </a>

</div>