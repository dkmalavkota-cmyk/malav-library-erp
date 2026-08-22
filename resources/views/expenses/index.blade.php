<x-layouts::app :title="'Expenses'">

    <div class="space-y-6">

        {{-- Success Message --}}
        @if(session('success'))

            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3000)"
                x-show="show"
                x-transition
                class="rounded-xl border border-green-600 bg-green-600/10 px-5 py-4 text-green-400"
            >

                {{ session('success') }}

            </div>

        @endif


        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Expense Management
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage library expenses and operating costs.
                </p>

            </div>


            <a href="{{ route('expenses.create') }}">

                <flux:button
                    variant="primary"
                    icon="plus"
                >
                    Add Expense
                </flux:button>

            </a>

        </div>


        {{-- Statistics --}}
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">


            {{-- Today's Expense --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Today's Expense
                </p>

                <h2 class="mt-3 text-4xl font-bold text-red-400">
                    ₹{{ number_format($todayExpense, 2) }}
                </h2>

                <p class="mt-2 text-sm text-zinc-500">
                    {{ $todayExpenseCount }} expense entries today
                </p>

            </div>


            {{-- This Month --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    This Month
                </p>

                <h2 class="mt-3 text-4xl font-bold text-orange-400">
                    ₹{{ number_format($monthExpense, 2) }}
                </h2>

                <p class="mt-2 text-sm text-zinc-500">
                    Current month expenses
                </p>

            </div>


            {{-- Total Expense --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Expense
                </p>

                <h2 class="mt-3 text-4xl font-bold text-yellow-400">
                    ₹{{ number_format($totalExpense, 2) }}
                </h2>

                <p class="mt-2 text-sm text-zinc-500">
                    All recorded expenses
                </p>

            </div>


            {{-- Entries --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Entries
                </p>

                <h2 class="mt-3 text-4xl font-bold text-sky-400">
                    {{ $expenses->total() }}
                </h2>

                <p class="mt-2 text-sm text-zinc-500">
                    Expense records
                </p>

            </div>

        </div>


        {{-- Filters --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-white">
                    Search & Filters
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Find expenses quickly.
                </p>

            </div>


            <form
                method="GET"
                action="{{ route('expenses.index') }}"
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5"
            >


                {{-- Search --}}
                <div class="lg:col-span-2">

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Expense No, Title or Category"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none placeholder:text-zinc-600 focus:border-yellow-500"
                    >

                </div>


                {{-- Date --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        Date
                    </label>

                    <input
                        type="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
                    >

                </div>


                {{-- Category --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        Category
                    </label>

                    <select
                        name="category"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category }}"
                                {{ request('category') === $category ? 'selected' : '' }}
                            >
                                {{ $category }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Payment Mode --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        Payment Mode
                    </label>

                    <select
                        name="payment_mode"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none focus:border-yellow-500"
                    >

                        <option value="">
                            All Modes
                        </option>

                        <option
                            value="Cash"
                            {{ request('payment_mode') === 'Cash' ? 'selected' : '' }}
                        >
                            Cash
                        </option>

                        <option
                            value="UPI"
                            {{ request('payment_mode') === 'UPI' ? 'selected' : '' }}
                        >
                            UPI
                        </option>

                        <option
                            value="Card"
                            {{ request('payment_mode') === 'Card' ? 'selected' : '' }}
                        >
                            Card
                        </option>

                        <option
                            value="Bank Transfer"
                            {{ request('payment_mode') === 'Bank Transfer' ? 'selected' : '' }}
                        >
                            Bank Transfer
                        </option>

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-3 md:col-span-2 lg:col-span-5">

                    <button
                        type="submit"
                        class="rounded-xl bg-yellow-400 px-6 py-3 text-sm font-semibold text-black transition hover:bg-yellow-300"
                    >
                        Apply Filters
                    </button>


                    <a
                        href="{{ route('expenses.index') }}"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-6 py-3 text-sm font-semibold text-zinc-200 transition hover:bg-zinc-700"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        {{-- Expense Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <div class="border-b border-zinc-700 px-6 py-5">

                <h2 class="text-lg font-semibold text-white">
                    Expense Records
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    All recorded library expenses.
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-zinc-700">

                        <tr class="text-left text-sm text-zinc-400">

                            <th class="px-6 py-4">
                                Expense No.
                            </th>

                            <th class="px-6 py-4">
                                Expense
                            </th>

                            <th class="px-6 py-4">
                                Category
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                            <th class="px-6 py-4">
                                Payment
                            </th>

                            <th class="px-6 py-4">
                                Amount
                            </th>

                            <th class="px-6 py-4 text-center">
    Action
</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($expenses as $expense)

                            <tr class="border-b border-zinc-800 hover:bg-zinc-800/50">


                                {{-- Expense No --}}
                                <td class="px-6 py-4">

                                    <span class="font-medium text-yellow-400">
                                        {{ $expense->expense_no }}
                                    </span>

                                </td>


                                {{-- Expense --}}
                                <td class="px-6 py-4">

                                    <div class="font-medium text-white">
                                        {{ $expense->title }}
                                    </div>

                                    @if($expense->description)

                                        <div class="mt-1 max-w-xs truncate text-xs text-zinc-500">
                                            {{ $expense->description }}
                                        </div>

                                    @endif

                                </td>


                                {{-- Category --}}
                                <td class="px-6 py-4">

                                    <span class="rounded-full bg-zinc-800 px-3 py-1 text-xs text-zinc-300">
                                        {{ $expense->category }}
                                    </span>

                                </td>


                                {{-- Date --}}
                                <td class="px-6 py-4 text-zinc-300">

                                    {{ $expense->expense_date?->format('d M Y') }}

                                </td>


                                {{-- Payment Mode --}}
                                <td class="px-6 py-4">

                                    @php

                                        $paymentClass = match ($expense->payment_mode) {

                                            'Cash' =>
                                                'bg-green-500/10 text-green-400',

                                            'UPI' =>
                                                'bg-sky-500/10 text-sky-400',

                                            'Card' =>
                                                'bg-purple-500/10 text-purple-400',

                                            'Bank Transfer' =>
                                                'bg-orange-500/10 text-orange-400',

                                            default =>
                                                'bg-zinc-800 text-zinc-400',

                                        };

                                    @endphp

                                    <span
                                        class="rounded-full px-3 py-1 text-xs {{ $paymentClass }}"
                                    >
                                        {{ $expense->payment_mode }}
                                    </span>

                                </td>


                                {{-- Amount --}}
                                <td class="px-6 py-4 font-semibold text-red-400">

                                    ₹{{ number_format($expense->amount, 2) }}

                                </td>

                               <td class="px-6 py-4 text-center">

    <div class="flex items-center justify-center gap-2">

        {{-- Edit --}}
        <a href="{{ route('expenses.edit', $expense) }}">

            <flux:button
                size="sm"
                variant="ghost"
            >
                Edit
            </flux:button>

        </a>


        {{-- Delete --}}
        <form
            action="{{ route('expenses.destroy', $expense) }}"
            method="POST"
            onsubmit="return confirm('Are you sure you want to delete this expense?');"
        >

            @csrf

            @method('DELETE')

            <flux:button
                type="submit"
                size="sm"
                variant="danger"
            >
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
                                    class="px-6 py-12 text-center text-zinc-500"
                                >

                                    No expense records found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            <div class="border-t border-zinc-700 p-4">

                {{ $expenses->links() }}

            </div>

        </div>

    </div>

</x-layouts::app>