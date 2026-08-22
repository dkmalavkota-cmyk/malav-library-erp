<x-layouts::app :title="'Edit Expense'">

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Edit Expense
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Update expense information.
                </p>

            </div>

            <a href="{{ route('expenses.index') }}">

                <flux:button variant="ghost">
                    ← Back to Expenses
                </flux:button>

            </a>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-4">

                <div class="font-semibold text-red-400">
                    Please fix the following errors:
                </div>

                <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-300">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Expense Number --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <p class="text-sm text-zinc-500">
                        Expense Number
                    </p>

                    <p class="mt-1 text-lg font-semibold text-yellow-400">
                        {{ $expense->expense_no }}
                    </p>

                </div>

                <div>

                    <span class="rounded-full bg-zinc-800 px-3 py-1.5 text-xs text-zinc-400">
                        Expense ID: {{ $expense->id }}
                    </span>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <form
                method="POST"
                action="{{ route('expenses.update', $expense) }}"
                class="space-y-6"
            >

                @csrf

                @method('PUT')


                {{-- Basic Information --}}
                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Expense Information
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Update the details of this expense.
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    {{-- Title --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Expense Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $expense->title) }}"
                            placeholder="e.g. Electricity Bill, Cleaning, Newspaper"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none placeholder:text-zinc-600 focus:border-yellow-500"
                        >

                    </div>


                    {{-- Amount --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Amount
                        </label>

                        <div class="relative">

                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="amount"
                                value="{{ old('amount', $expense->amount) }}"
                                step="0.01"
                                min="0"
                                placeholder="0.00"
                                required
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 py-3 pl-9 pr-4 text-white outline-none placeholder:text-zinc-600 focus:border-yellow-500"
                            >

                        </div>

                    </div>


                    {{-- Date --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Expense Date
                        </label>

                        <input
                            type="date"
                            name="expense_date"
                            value="{{ old('expense_date', $expense->expense_date?->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none focus:border-yellow-500"
                        >

                    </div>


                    {{-- Category --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Category
                        </label>

                        <select
                            name="category"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none focus:border-yellow-500"
                        >

                            <option value="">
                                Select Category
                            </option>

                            <option value="Electricity"
                                {{ old('category', $expense->category) === 'Electricity' ? 'selected' : '' }}>
                                Electricity
                            </option>

                            <option value="Rent"
                                {{ old('category', $expense->category) === 'Rent' ? 'selected' : '' }}>
                                Rent
                            </option>

                            <option value="Internet"
                                {{ old('category', $expense->category) === 'Internet' ? 'selected' : '' }}>
                                Internet
                            </option>

                            <option value="Cleaning"
                                {{ old('category', $expense->category) === 'Cleaning' ? 'selected' : '' }}>
                                Cleaning
                            </option>

                            <option value="Maintenance"
                                {{ old('category', $expense->category) === 'Maintenance' ? 'selected' : '' }}>
                                Maintenance
                            </option>

                            <option value="Stationery"
                                {{ old('category', $expense->category) === 'Stationery' ? 'selected' : '' }}>
                                Stationery
                            </option>

                            <option value="Newspaper"
                                {{ old('category', $expense->category) === 'Newspaper' ? 'selected' : '' }}>
                                Newspaper
                            </option>

                            <option value="Water"
                                {{ old('category', $expense->category) === 'Water' ? 'selected' : '' }}>
                                Water
                            </option>

                            <option value="Salary"
                                {{ old('category', $expense->category) === 'Salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="Other"
                                {{ old('category', $expense->category) === 'Other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>


                    {{-- Payment Mode --}}
                    <div>

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Payment Mode
                        </label>

                        <select
                            name="payment_mode"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none focus:border-yellow-500"
                        >

                            <option value="">
                                Select Payment Mode
                            </option>

                            <option value="Cash"
                                {{ old('payment_mode', $expense->payment_mode) === 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="UPI"
                                {{ old('payment_mode', $expense->payment_mode) === 'UPI' ? 'selected' : '' }}>
                                UPI
                            </option>

                            <option value="Card"
                                {{ old('payment_mode', $expense->payment_mode) === 'Card' ? 'selected' : '' }}>
                                Card
                            </option>

                            <option value="Bank Transfer"
                                {{ old('payment_mode', $expense->payment_mode) === 'Bank Transfer' ? 'selected' : '' }}>
                                Bank Transfer
                            </option>

                        </select>

                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label class="mb-2 block text-sm font-medium text-zinc-400">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            placeholder="Add any additional details about this expense..."
                            class="w-full resize-none rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none placeholder:text-zinc-600 focus:border-yellow-500"
                        >{{ old('description', $expense->description) }}</textarea>

                    </div>

                </div>


                {{-- Footer --}}
                <div class="flex items-center justify-end gap-3 border-t border-zinc-800 pt-6">

                    <a href="{{ route('expenses.index') }}">

                        <flux:button variant="ghost">
                            Cancel
                        </flux:button>

                    </a>


                    <flux:button
                        type="submit"
                        variant="primary"
                    >
                        Update Expense
                    </flux:button>

                </div>

            </form>

        </div>

    </div>

</x-layouts::app>