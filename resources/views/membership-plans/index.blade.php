<x-layouts::app :title="__('Membership Plans')">

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

<!-- Header -->

<div class="flex items-center justify-between">

    <div>

        <h1 class="text-3xl font-bold text-white">
            Membership Plans
        </h1>

        <p class="mt-1 text-sm text-zinc-400">
            Manage library membership plans, pricing and duration.
        </p>

    </div>

    <a href="{{ route('membership-plans.create') }}">

        <flux:button
            variant="primary"
            icon="plus">

            Add Plan

        </flux:button>

    </a>

</div>

<!-- Search -->

<div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

<form
    method="GET"
    action="{{ route('membership-plans.index') }}">

<div class="flex flex-col gap-4 md:flex-row">

<input
type="text"
name="search"
value="{{ request('search') }}"
placeholder="Search by Plan Name or Code..."
class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:border-yellow-500 focus:outline-none">

<select
name="status"
class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none">

<option value="">All Status</option>

<option value="1"
{{ request('status')==='1' ? 'selected' : '' }}>
Active
</option>

<option value="0"
{{ request('status')==='0' ? 'selected' : '' }}>
Inactive
</option>

</select>

<flux:button
type="submit"
variant="primary">

Search

</flux:button>

@if(request()->filled('search') || request()->filled('status'))

<a href="{{ route('membership-plans.index') }}">

<flux:button variant="ghost">

Clear

</flux:button>

</a>

@endif

</div>

</form>

</div>

<!-- Cards -->

<div class="grid gap-6 md:grid-cols-3">

<div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

<p class="text-sm text-zinc-400">

Total Plans

</p>

<h2 class="mt-3 text-4xl font-bold text-yellow-400">

{{ $totalPlans }}

</h2>

</div>

<div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

<p class="text-sm text-zinc-400">

Active Plans

</p>

<h2 class="mt-3 text-4xl font-bold text-green-400">

{{ $activePlans }}

</h2>

</div>

<div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

<p class="text-sm text-zinc-400">

Inactive Plans

</p>

<h2 class="mt-3 text-4xl font-bold text-red-400">

{{ $inactivePlans }}

</h2>

</div>

</div>

<!-- Table -->

<div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

<table class="min-w-full">

<thead class="border-b border-zinc-700">

<tr class="text-left text-sm text-zinc-400">

<th class="px-6 py-4">Code</th>

<th class="px-6 py-4">Plan</th>

<th class="px-6 py-4">Duration</th>

<th class="px-6 py-4">Price</th>

<th class="px-6 py-4">Joining Fee</th>

<th class="px-6 py-4">Status</th>

<th class="px-6 py-4 text-center">

Actions

</th>

</tr>

</thead>

<tbody>

@forelse($plans as $plan)

<tr class="border-b border-zinc-800 hover:bg-zinc-800/50">

<td class="px-6 py-4 font-semibold text-yellow-400">

{{ $plan->code }}

</td>

<td class="px-6 py-4">

<div class="flex items-center gap-3">

<div
class="h-4 w-4 rounded-full"
style="background: {{ $plan->badge_color }}"></div>

<div>

<p class="font-semibold text-white">

{{ $plan->name }}

</p>

<p class="text-xs text-zinc-500">

{{ $plan->description }}

</p>

</div>

</div>

</td>

<td class="px-6 py-4 text-zinc-300">

{{ $plan->duration_months }} Month(s)

</td>

<td class="px-6 py-4 font-semibold text-green-400">

₹{{ number_format($plan->price,2) }}

</td>

<td class="px-6 py-4 text-zinc-300">

₹{{ number_format($plan->joining_fee,2) }}

</td>

<td class="px-6 py-4">

@if($plan->is_active)

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

<div class="flex items-center justify-center gap-2">

<a href="{{ route('membership-plans.show', $plan) }}">

<flux:button
size="sm"
variant="ghost">

View

</flux:button>

</a>

<a href="{{ route('membership-plans.edit', $plan) }}">

<flux:button
size="sm"
variant="primary">

Edit

</flux:button>

</a>

<form
action="{{ route('membership-plans.destroy', $plan) }}"
method="POST"
onsubmit="return confirm('Delete this membership plan?')">

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

<td
colspan="7"
class="px-6 py-12 text-center text-zinc-500">

No Membership Plans Found.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="border-t border-zinc-700 p-4">

{{ $plans->links() }}

</div>

</div>

</div>

</x-layouts::app>