<x-layouts::app :title="'Add Membership Plan'">

<div class="max-w-5xl mx-auto space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-white">

            Add Membership Plan

        </h1>

        <p class="mt-1 text-zinc-400">

            Create a new membership plan for your library.

        </p>

    </div>

    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

        <form
            method="POST"
            action="{{ route('membership-plans.store') }}">

            @include('membership-plans.form')

        </form>

    </div>

</div>

</x-layouts::app>