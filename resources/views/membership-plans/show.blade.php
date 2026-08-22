<x-layouts::app :title="'Membership Plan Details'">

<div class="max-w-5xl mx-auto space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-3xl font-bold text-white">

                {{ $membershipPlan->name }}

            </h1>

            <p class="mt-1 text-zinc-400">

                Membership Plan Details

            </p>

        </div>

        <a href="{{ route('membership-plans.edit', $membershipPlan) }}">

            <flux:button variant="primary">

                Edit Plan

            </flux:button>

        </a>

    </div>

    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

        <div class="grid gap-6 md:grid-cols-2">

            <div>

                <p class="text-sm text-zinc-500">Plan Name</p>

                <h3 class="mt-1 text-lg font-semibold text-white">

                    {{ $membershipPlan->name }}

                </h3>

            </div>

            <div>

                <p class="text-sm text-zinc-500">Plan Code</p>

                <h3 class="mt-1 text-lg font-semibold text-yellow-400">

                    {{ $membershipPlan->code }}

                </h3>

            </div>

            <div>

                <p class="text-sm text-zinc-500">Duration</p>

                <h3 class="mt-1 text-lg font-semibold text-white">

                    {{ $membershipPlan->duration_months }} Month(s)

                </h3>

            </div>

            <div>

                <p class="text-sm text-zinc-500">Price</p>

                <h3 class="mt-1 text-lg font-semibold text-green-400">

                    ₹{{ number_format($membershipPlan->price,2) }}

                </h3>

            </div>

            <div>

                <p class="text-sm text-zinc-500">Joining Fee</p>

                <h3 class="mt-1 text-lg font-semibold text-white">

                    ₹{{ number_format($membershipPlan->joining_fee,2) }}

                </h3>

            </div>

            <div>

                <p class="text-sm text-zinc-500">Status</p>

                @if($membershipPlan->is_active)

                    <span class="mt-2 inline-flex rounded-full bg-green-500/20 px-4 py-2 text-sm text-green-400">

                        Active

                    </span>

                @else

                    <span class="mt-2 inline-flex rounded-full bg-red-500/20 px-4 py-2 text-sm text-red-400">

                        Inactive

                    </span>

                @endif

            </div>

            <div class="md:col-span-2">

                <p class="text-sm text-zinc-500">

                    Description

                </p>

                <div class="mt-2 rounded-xl border border-zinc-700 bg-zinc-800 p-4 text-zinc-300">

                    {{ $membershipPlan->description ?: 'No description available.' }}

                </div>

            </div>

        </div>

    </div>

    <div class="flex gap-3">

        <a href="{{ route('membership-plans.edit', $membershipPlan) }}">

            <flux:button variant="primary">

                Edit

            </flux:button>

        </a>

        <a href="{{ route('membership-plans.index') }}">

            <flux:button variant="ghost">

                Back

            </flux:button>

        </a>

    </div>

</div>

</x-layouts::app>