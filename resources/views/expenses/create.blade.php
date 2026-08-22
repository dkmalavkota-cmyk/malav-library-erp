<x-layouts::app :title="'Add Expense'">

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>

                <h1 class="text-3xl font-bold text-white">
                    Add Expense
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Record a new library expense.
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


        {{-- Form --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <form
                method="POST"
                action="{{ route('expenses.store') }}"
                class="space-y-6"
            >

                @csrf


                {{-- Basic Information --}}
                <div>

                    <h2 class="text-lg font-semibold text-white">
                        Expense Information
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Enter the basic details of the expense.
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
                            value="{{ old('title') }}"
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
                                value="{{ old('amount') }}"
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
                            value="{{ old('expense_date', today()->format('Y-m-d')) }}"
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
                                {{ old('category') === 'Electricity' ? 'selected' : '' }}>
                                Electricity
                            </option>

                            <option value="Rent"
                                {{ old('category') === 'Rent' ? 'selected' : '' }}>
                                Rent
                            </option>

                            <option value="Internet"
                                {{ old('category') === 'Internet' ? 'selected' : '' }}>
                                Internet
                            </option>

                            <option value="Cleaning"
                                {{ old('category') === 'Cleaning' ? 'selected' : '' }}>
                                Cleaning
                            </option>

                            <option value="Maintenance"
                                {{ old('category') === 'Maintenance' ? 'selected' : '' }}>
                                Maintenance
                            </option>

                            <option value="Stationery"
                                {{ old('category') === 'Stationery' ? 'selected' : '' }}>
                                Stationery
                            </option>

                            <option value="Newspaper"
                                {{ old('category') === 'Newspaper' ? 'selected' : '' }}>
                                Newspaper
                            </option>

                            <option value="Water"
                                {{ old('category') === 'Water' ? 'selected' : '' }}>
                                Water
                            </option>

                            <option value="Salary"
                                {{ old('category') === 'Salary' ? 'selected' : '' }}>
                                Salary
                            </option>

                            <option value="Other"
                                {{ old('category') === 'Other' ? 'selected' : '' }}>
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
                                {{ old('payment_mode') === 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="UPI"
                                {{ old('payment_mode') === 'UPI' ? 'selected' : '' }}>
                                UPI
                            </option>

                            <option value="Card"
                                {{ old('payment_mode') === 'Card' ? 'selected' : '' }}>
                                Card
                            </option>

                            <option value="Bank Transfer"
                                {{ old('payment_mode') === 'Bank Transfer' ? 'selected' : '' }}>
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
                        >{{ old('description') }}</textarea>

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
                        Save Expense
                    </flux:button>

                </div>

            </form>

        </div>

    </div>

</x-layouts::app>