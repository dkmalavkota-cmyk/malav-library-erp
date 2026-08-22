<x-layouts::app :title="'Edit Membership Plan'">

<div class="max-w-5xl mx-auto space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-white">
            Edit Membership Plan
        </h1>

        <p class="mt-1 text-zinc-400">
            Update membership plan details.
        </p>

    </div>

    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

        <form
            method="POST"
            action="{{ route('membership-plans.update', $membershipPlan) }}">

            @csrf
            @method('PUT')

            @include('membership-plans.form')

        </form>

    </div>

</div>

</x-layouts::app>