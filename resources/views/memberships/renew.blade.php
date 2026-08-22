<x-layouts::app :title="'Renew Membership'">

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Renew Membership
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Renew the membership for the selected student.
                </p>
            </div>

            <a href="{{ route('memberships.index') }}">
                <flux:button variant="ghost">
                    Back
                </flux:button>
            </a>

        </div>


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-4">

                <p class="font-semibold text-red-400">
                    Please fix the following errors:
                </p>

                <ul class="mt-2 list-disc pl-5 text-sm text-red-300">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Current Membership --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <h2 class="mb-5 text-lg font-semibold text-white">
                Current Membership
            </h2>

            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">


                {{-- Student --}}

                <div>

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Student
                    </p>

                    <p class="mt-1 font-semibold text-white">

                        {{ $membership->student?->first_name }}
                        {{ $membership->student?->last_name }}

                    </p>

                    <p class="mt-1 text-sm text-zinc-500">
                        {{ $membership->student?->student_code }}
                    </p>

                </div>


                {{-- Current Plan --}}

                <div>

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Current Plan
                    </p>

                    <p class="mt-1 font-semibold text-white">
                        {{ $membership->plan?->name }}
                    </p>

                </div>


                {{-- Current Period --}}

                <div>

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Current Period
                    </p>

                    <p class="mt-1 font-semibold text-zinc-300">

                        {{ $membership->start_date?->format('d M Y') }}

                        →

                        {{ $membership->end_date?->format('d M Y') }}

                    </p>

                </div>


                {{-- Previous Amount --}}

                <div>

                    <p class="text-xs uppercase tracking-wide text-zinc-500">
                        Previous Amount
                    </p>

                    <p class="mt-1 font-semibold text-yellow-400">

                        ₹{{ number_format($membership->final_amount, 2) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Renewal Form --}}

        <form
            action="{{ route('memberships.renew.store', $membership) }}"
            method="POST"
            class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6"
        >

            @csrf


            {{-- Renewal Details --}}

            <h2 class="text-lg font-semibold text-white">
                New Membership Period
            </h2>


            <div class="mt-6 grid gap-6 md:grid-cols-2">


                {{-- Plan --}}

                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Membership Plan
                    </label>

                    <input
                        type="text"
                        value="{{ $membership->plan?->name }}"
                        readonly
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
                    >

                </div>


                {{-- Duration --}}

                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                        Duration
                    </label>

                    <input
                        type="text"
                        value="{{ $membership->plan?->duration_months }} {{ $membership->plan?->duration_months == 1 ? 'Month' : 'Months' }}"
                        readonly
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
                    >

                </div>


                {{-- Start Date --}}

                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        New Start Date
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        id="start_date"
                        value="{{ old('start_date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                    >

                </div>


                {{-- End Date --}}

                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        New End Date
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        id="end_date"
                        value="{{ old('end_date') }}"
                        readonly
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white"
                    >

                    <p class="mt-2 text-xs text-zinc-500">
                        Automatically calculated from the selected plan duration.
                    </p>

                </div>


                {{-- Amount --}}

                <div>

                    <label
                        for="amount"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Membership Amount
                    </label>

                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        value="{{ old('amount', $membership->plan?->price ?? $membership->final_amount) }}"
                        min="0"
                        step="0.01"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                    >

                </div>


                {{-- Discount --}}

                <div>

                    <label
                        for="discount"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Discount
                    </label>

                    <input
                        type="number"
                        name="discount"
                        id="discount"
                        value="{{ old('discount', 0) }}"
                        min="0"
                        step="0.01"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                    >

                </div>


                {{-- Final Payable --}}

                <div class="md:col-span-2">

                    <div class="rounded-2xl border border-yellow-500/20 bg-yellow-500/5 p-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-sm text-zinc-400">
                                    Final Payable Amount
                                </p>

                                <p class="mt-1 text-xs text-zinc-600">
                                    Amount after discount
                                </p>

                            </div>

                            <div
                                id="finalAmountDisplay"
                                class="text-3xl font-bold text-yellow-400"
                            >
                                ₹0.00
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Payment Details --}}

            <div class="mt-10 border-t border-zinc-800 pt-8">

                <h2 class="text-lg font-semibold text-white">
                    Payment Details
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Record the payment received for this renewal.
                </p>


                <div class="mt-6 grid gap-6 md:grid-cols-2">


                    {{-- Payment Mode --}}

                    <div>

                        <label
                            for="payment_mode"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Payment Mode
                        </label>

                        <select
                            name="payment_mode"
                            id="payment_mode"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                        >

                            <option value="">
                                Select Payment Mode
                            </option>

                            <option
                                value="Cash"
                                @selected(old('payment_mode') === 'Cash')
                            >
                                Cash
                            </option>

                            <option
                                value="UPI"
                                @selected(old('payment_mode') === 'UPI')
                            >
                                UPI
                            </option>

                            <option
                                value="Card"
                                @selected(old('payment_mode') === 'Card')
                            >
                                Card
                            </option>

                            <option
                                value="Bank Transfer"
                                @selected(old('payment_mode') === 'Bank Transfer')
                            >
                                Bank Transfer
                            </option>

                        </select>

                    </div>


                    {{-- Payment Date --}}

                    <div>

                        <label
                            for="payment_date"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Payment Date
                        </label>

                        <input
                            type="date"
                            name="payment_date"
                            id="payment_date"
                            value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                        >

                    </div>


                    {{-- Transaction ID --}}

                    <div class="md:col-span-2">

                        <label
                            for="transaction_id"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Transaction ID
                        </label>

                        <input
                            type="text"
                            name="transaction_id"
                            id="transaction_id"
                            value="{{ old('transaction_id') }}"
                            maxlength="255"
                            placeholder="Required for UPI / Card / Bank Transfer"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                        >

                        <p class="mt-2 text-xs text-zinc-500">
                            Leave blank for cash payments.
                        </p>

                    </div>


                    {{-- Remarks --}}

                    <div class="md:col-span-2">

                        <label
                            for="remarks"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Remarks
                        </label>

                        <textarea
                            name="remarks"
                            id="remarks"
                            rows="3"
                            placeholder="Optional renewal remarks..."
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none focus:border-indigo-500"
                        >{{ old('remarks') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Buttons --}}

            <div class="mt-8 flex items-center justify-end gap-3">

                <a href="{{ route('memberships.index') }}">

                    <flux:button
                        type="button"
                        variant="ghost"
                    >
                        Cancel
                    </flux:button>

                </a>


                <flux:button
                    type="submit"
                    variant="primary"
                >
                    Renew & Record Payment
                </flux:button>

            </div>

        </form>

    </div>


    {{-- JavaScript --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const startDate =
                document.getElementById('start_date');

            const endDate =
                document.getElementById('end_date');

            const amount =
                document.getElementById('amount');

            const discount =
                document.getElementById('discount');

            const finalAmountDisplay =
                document.getElementById('finalAmountDisplay');


            const duration =
                {{ (int) ($membership->plan?->duration_months ?? 1) }};


            /*
            |--------------------------------------------------------------------------
            | Calculate End Date
            |--------------------------------------------------------------------------
            */

            function calculateEndDate()
            {

                if (!startDate.value) {

                    endDate.value = '';

                    return;

                }


                const date =
                    new Date(
                        startDate.value + 'T00:00:00'
                    );


                date.setMonth(
                    date.getMonth() + duration
                );


                date.setDate(
                    date.getDate() - 1
                );


                const year =
                    date.getFullYear();


                const month =
                    String(
                        date.getMonth() + 1
                    ).padStart(2, '0');


                const day =
                    String(
                        date.getDate()
                    ).padStart(2, '0');


                endDate.value =
                    year + '-' +
                    month + '-' +
                    day;

            }


            /*
            |--------------------------------------------------------------------------
            | Calculate Final Amount
            |--------------------------------------------------------------------------
            */

            function calculateFinalAmount()
            {

                const planAmount =
                    parseFloat(amount.value) || 0;


                const discountAmount =
                    parseFloat(discount.value) || 0;


                const finalAmount =
                    Math.max(
                        planAmount - discountAmount,
                        0
                    );


                finalAmountDisplay.textContent =
                    '₹' +
                    finalAmount.toFixed(2);

            }


            /*
            |--------------------------------------------------------------------------
            | Events
            |--------------------------------------------------------------------------
            */

            startDate.addEventListener(
                'change',
                calculateEndDate
            );


            amount.addEventListener(
                'input',
                calculateFinalAmount
            );


            discount.addEventListener(
                'input',
                calculateFinalAmount
            );


            /*
            |--------------------------------------------------------------------------
            | Initial Calculation
            |--------------------------------------------------------------------------
            */

            calculateEndDate();

            calculateFinalAmount();

        });

    </script>

</x-layouts::app>