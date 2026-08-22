<x-layouts::app :title="'Collect Fee'">

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-400 text-lg font-black text-black shadow-lg shadow-emerald-400/10">
                        ₹
                    </div>

                    <div>

                        <h1 class="text-3xl font-bold tracking-tight text-white">
                            Collect Membership Fee
                        </h1>

                        <p class="mt-1 text-sm text-zinc-400">
                            Collect payment and generate a payment receipt.
                        </p>

                    </div>

                </div>

            </div>


            <a href="{{ route('payments.index') }}">

                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    Back to Payments
                </flux:button>

            </a>

        </div>


        {{-- =========================================================
            ERRORS
        ========================================================== --}}
        @if($errors->any())

            <div class="rounded-2xl border border-red-500/30 bg-red-500/10 p-5">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 text-red-400">
                        ⚠
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-300">
                            Please fix the following errors
                        </h3>

                        <ul class="mt-2 space-y-1 text-sm text-red-400">

                            @foreach($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
            FORM
        ========================================================== --}}
        <form
            action="{{ route('payments.store') }}"
            method="POST"
            id="paymentForm"
        >

            @csrf


            <div class="grid gap-6 xl:grid-cols-3">


                {{-- =================================================
                    LEFT CONTENT
                ================================================== --}}
                <div class="space-y-6 xl:col-span-2">


                    {{-- =============================================
                        MEMBERSHIP SELECTION
                    ============================================== --}}
                    <div class="overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900">

                        <div class="border-b border-zinc-800 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-400/10 text-yellow-400">
                                    👤
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Membership Details
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Select the active membership for payment.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="space-y-6">


                                {{-- Membership --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Student / Membership
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <select
                                        name="membership_id"
                                        id="membership_id"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                        <option value="">
                                            Select Student / Membership
                                        </option>

                                        @foreach($memberships as $membership)

                                            <option
                                                value="{{ $membership->id }}"

                                                data-student="{{ $membership->student->first_name }} {{ $membership->student->last_name }}"

                                                data-code="{{ $membership->student->student_code }}"

                                                data-plan="{{ $membership->plan->name }}"

                                                data-duration="{{ $membership->plan->duration_months }}"

                                                data-shift="{{ $membership->plan->shift }}"

                                                data-price="{{ $membership->amount }}"

                                                data-final="{{ $membership->final_amount }}"

                                                data-start="{{ optional($membership->start_date)->format('d M Y') }}"

                                                data-end="{{ optional($membership->end_date)->format('d M Y') }}"
                                            >

                                                {{ $membership->student->student_code }}
                                                —
                                                {{ $membership->student->first_name }}
                                                {{ $membership->student->last_name }}
                                                —
                                                {{ $membership->plan->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('membership_id')

                                        <p class="mt-2 text-xs text-red-400">
                                            {{ $message }}
                                        </p>

                                    @enderror

                                </div>


                                {{-- Student / Plan Information --}}
                                <div class="grid gap-5 md:grid-cols-2">


                                    {{-- Student --}}
                                    <div>

                                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                                            Student
                                        </label>

                                        <input
                                            type="text"
                                            id="student_display"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none"
                                            placeholder="Select membership"
                                        >

                                    </div>


                                    {{-- Plan --}}
                                    <div>

                                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                                            Membership Plan
                                        </label>

                                        <input
                                            type="text"
                                            id="plan_display"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none"
                                            placeholder="Select membership"
                                        >

                                    </div>


                                    {{-- Duration --}}
                                    <div>

                                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                                            Duration
                                        </label>

                                        <input
                                            type="text"
                                            id="duration_display"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none"
                                            placeholder="—"
                                        >

                                    </div>


                                    {{-- Shift --}}
                                    <div>

                                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                                            Shift
                                        </label>

                                        <input
                                            type="text"
                                            id="shift_display"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none"
                                            placeholder="—"
                                        >

                                    </div>


                                    {{-- Membership Period --}}
                                    <div class="md:col-span-2">

                                        <label class="mb-2 block text-sm font-medium text-zinc-300">
                                            Membership Period
                                        </label>

                                        <input
                                            type="text"
                                            id="period_display"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 font-medium text-white outline-none"
                                            placeholder="Select membership"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                        PAYMENT DETAILS
                    ============================================== --}}
                    <div class="overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900">

                        <div class="border-b border-zinc-800 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-400/10 text-sky-400">
                                    💳
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Payment Details
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Enter how and when the payment was received.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="grid gap-6 md:grid-cols-2">


                                {{-- Payment Mode --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Payment Mode
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <select
                                        name="payment_mode"
                                        id="payment_mode"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                        <option value="">
                                            Select Payment Mode
                                        </option>

                                        <option value="Cash">
                                            Cash
                                        </option>

                                        <option value="UPI">
                                            UPI
                                        </option>

                                        <option value="Card">
                                            Card
                                        </option>

                                        <option value="Bank Transfer">
                                            Bank Transfer
                                        </option>

                                    </select>

                                </div>


                                {{-- Payment Date --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Payment Date
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        name="payment_date"
                                        value="{{ date('Y-m-d') }}"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                </div>


                                {{-- Transaction --}}
                                <div class="md:col-span-2">

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Transaction ID
                                    </label>

                                    <input
                                        type="text"
                                        name="transaction_id"
                                        id="transaction_id"
                                        placeholder="UPI / Card / Bank transaction reference"
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                    <p class="mt-2 text-xs text-zinc-500">
                                        Optional for Cash payments. Recommended for digital payments.
                                    </p>

                                </div>


                                {{-- Remarks --}}
                                <div class="md:col-span-2">

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Remarks
                                    </label>

                                    <textarea
                                        name="remarks"
                                        rows="3"
                                        placeholder="Add any payment-related note..."
                                        class="w-full resize-none rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    ></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    RIGHT SUMMARY
                ================================================== --}}
                <div class="xl:col-span-1">

                    <div class="sticky top-6 overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900">


                        {{-- Summary Header --}}
                        <div class="border-b border-zinc-800 px-6 py-6">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-400 text-xl font-black text-black">
                                    ✓
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Payment Summary
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Review the amount before collecting.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Summary Body --}}
                        <div class="space-y-5 p-6">


                            {{-- Selected Student --}}
                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/40 p-4">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Student
                                </p>

                                <p
                                    id="summary_student"
                                    class="mt-2 font-semibold text-white"
                                >
                                    —
                                </p>

                                <p
                                    id="summary_code"
                                    class="mt-1 text-xs text-zinc-500"
                                >
                                    —
                                </p>

                            </div>


                            {{-- Plan --}}
                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/40 p-4">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Membership
                                </p>

                                <p
                                    id="summary_plan"
                                    class="mt-2 font-semibold text-white"
                                >
                                    —
                                </p>

                            </div>


                            {{-- Plan Amount --}}
                            <div class="flex items-center justify-between">

                                <span class="text-sm text-zinc-400">
                                    Plan Amount
                                </span>

                                <span
                                    id="plan_amount_display"
                                    class="font-semibold text-white"
                                >
                                    ₹0.00
                                </span>

                            </div>


                            {{-- Discount --}}
                            <div>

                                <label class="mb-2 block text-sm text-zinc-400">
                                    Offer Discount
                                </label>

                                <div class="relative">

                                    <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500">
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        name="discount"
                                        id="discount"
                                        min="0"
                                        step="0.01"
                                        value="{{ old('discount', 0) }}"
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 pl-9 text-right text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                </div>

                            </div>


                            {{-- Payable --}}
                            <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Final Payable
                                </p>

                                <p
                                    id="payable_display"
                                    class="mt-2 text-3xl font-black text-emerald-400"
                                >
                                    ₹0.00
                                </p>

                            </div>


                            {{-- Payment Mode --}}
                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/30 p-4">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Payment Mode
                                </p>

                                <p
                                    id="summary_payment_mode"
                                    class="mt-2 font-semibold text-white"
                                >
                                    Not selected
                                </p>

                            </div>


                            {{-- Info --}}
                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/30 p-4">

                                <div class="flex items-start gap-3">

                                    <span class="text-yellow-400">
                                        💡
                                    </span>

                                    <p class="text-xs leading-5 text-zinc-500">
                                        Once payment is collected, a unique receipt number will be generated automatically.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Actions --}}
                        <div class="border-t border-zinc-800 p-6">

                            <div class="flex flex-col gap-3">

                                <flux:button
                                    type="submit"
                                    variant="primary"
                                    icon="check"
                                    class="w-full"
                                >
                                    Collect Fee
                                </flux:button>


                                <a
                                    href="{{ route('payments.index') }}"
                                    class="w-full"
                                >

                                    <flux:button
                                        type="button"
                                        variant="ghost"
                                        class="w-full"
                                    >
                                        Cancel
                                    </flux:button>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Hidden Amount --}}
            <input
                type="hidden"
                name="amount"
                id="amount"
                value="0"
            >

        </form>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const membershipSelect =
                document.getElementById('membership_id');

            const discountInput =
                document.getElementById('discount');

            const amountInput =
                document.getElementById('amount');

            const paymentMode =
                document.getElementById('payment_mode');


            function money(value)
            {
                return '₹' + Number(value || 0).toFixed(2);
            }


            function updatePaymentDetails()
            {

                const option =
                    membershipSelect.options[
                        membershipSelect.selectedIndex
                    ];


                if (!option || !option.value) {

                    document.getElementById('student_display').value = '';

                    document.getElementById('plan_display').value = '';

                    document.getElementById('duration_display').value = '';

                    document.getElementById('shift_display').value = '';

                    document.getElementById('period_display').value = '';


                    document.getElementById('plan_amount_display').textContent =
                        money(0);


                    document.getElementById('payable_display').textContent =
                        money(0);


                    document.getElementById('summary_student').textContent =
                        '—';


                    document.getElementById('summary_code').textContent =
                        '—';


                    document.getElementById('summary_plan').textContent =
                        '—';


                    amountInput.value = 0;

                    return;
                }


                const student =
                    option.dataset.student || '';


                const code =
                    option.dataset.code || '';


                const plan =
                    option.dataset.plan || '';


                const duration =
                    option.dataset.duration || '';


                const shift =
                    option.dataset.shift || '';


                const price =
                    parseFloat(
                        option.dataset.final ||
                        option.dataset.price ||
                        0
                    );


                const start =
                    option.dataset.start || '';


                const end =
                    option.dataset.end || '';


                document.getElementById('student_display').value =
                    student;


                document.getElementById('plan_display').value =
                    plan;


                document.getElementById('duration_display').value =
                    duration +
                    (
                        Number(duration) === 1
                            ? ' Month'
                            : ' Months'
                    );


                document.getElementById('shift_display').value =
                    shift;


                document.getElementById('period_display').value =
                    start + ' → ' + end;


                document.getElementById('plan_amount_display').textContent =
                    money(price);


                document.getElementById('summary_student').textContent =
                    student || '—';


                document.getElementById('summary_code').textContent =
                    code || '—';


                document.getElementById('summary_plan').textContent =
                    plan || '—';


                calculatePayable();

            }


            function calculatePayable()
            {

                const option =
                    membershipSelect.options[
                        membershipSelect.selectedIndex
                    ];


                if (!option || !option.value) {
                    return;
                }


                const price =
                    parseFloat(
                        option.dataset.final ||
                        option.dataset.price ||
                        0
                    );


                let discount =
                    parseFloat(
                        discountInput.value || 0
                    );


                if (discount < 0) {

                    discount = 0;

                }


                if (discount > price) {

                    discount = price;

                    discountInput.value =
                        price.toFixed(2);

                }


                const payable =
                    Math.max(
                        price - discount,
                        0
                    );


                document.getElementById('payable_display').textContent =
                    money(payable);


                amountInput.value =
                    payable.toFixed(2);

            }


            membershipSelect.addEventListener(
                'change',
                updatePaymentDetails
            );


            discountInput.addEventListener(
                'input',
                calculatePayable
            );


            paymentMode.addEventListener(
                'change',
                function () {

                    const value =
                        paymentMode.value;


                    document.getElementById(
                        'summary_payment_mode'
                    ).textContent =
                        value || 'Not selected';

                }
            );


            updatePaymentDetails();

        });

    </script>

</x-layouts::app>