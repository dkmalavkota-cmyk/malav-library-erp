<x-layouts::app :title="'Add Membership'">

    <div class="mx-auto max-w-7xl space-y-6">

        {{-- =========================================================
            PAGE HEADER
        ========================================================== --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-yellow-400 text-xl font-black text-black shadow-lg shadow-yellow-400/10">
                        +
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold tracking-tight text-white">
                            Add New Membership
                        </h1>

                        <p class="mt-1 text-sm text-zinc-400">
                            Create and activate a membership for a student.
                        </p>
                    </div>

                </div>
            </div>

            <a href="{{ route('memberships.index') }}">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    Back to Memberships
                </flux:button>
            </a>

        </div>


        {{-- =========================================================
            VALIDATION ERRORS
        ========================================================== --}}
        @if ($errors->any())

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

                            @foreach ($errors->all() as $error)

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
            action="{{ route('memberships.store') }}"
            method="POST"
            class="space-y-6"
        >

            @csrf


            <div class="grid gap-6 xl:grid-cols-3">


                {{-- =================================================
                    LEFT SIDE
                ================================================== --}}
                <div class="space-y-6 xl:col-span-2">


                    {{-- =============================================
                        STUDENT & PLAN
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
                                        Select the student and membership plan.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="grid gap-6 md:grid-cols-2">


                                {{-- Student --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Student
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <select
                                        name="student_id"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                        <option value="">
                                            Select Student
                                        </option>

                                        @foreach($students as $student)

                                            <option
                                                value="{{ $student->id }}"
                                                {{ old('student_id') == $student->id ? 'selected' : '' }}
                                            >
                                                {{ $student->student_code }}
                                                —
                                                {{ $student->first_name }}
                                                {{ $student->last_name }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('student_id')
                                        <p class="mt-2 text-xs text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- Membership Plan --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Membership Plan
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <select
                                        name="membership_plan_id"
                                        id="membership_plan_id"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                        <option value="">
                                            Select Membership Plan
                                        </option>

                                        @foreach($plans as $plan)

                                            <option
                                                value="{{ $plan->id }}"
                                                data-price="{{ $plan->price }}"
                                                data-joining-fee="{{ $plan->joining_fee }}"
                                                data-duration="{{ $plan->duration_months }}"
                                                {{ old('membership_plan_id') == $plan->id ? 'selected' : '' }}
                                            >

                                                {{ $plan->name }}

                                                @if($plan->shift)
                                                    — {{ $plan->shift }}
                                                @endif

                                            </option>

                                        @endforeach

                                    </select>

                                    @error('membership_plan_id')
                                        <p class="mt-2 text-xs text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                        MEMBERSHIP PERIOD
                    ============================================== --}}
                    <div class="overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900">

                        <div class="border-b border-zinc-800 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-400/10 text-sky-400">
                                    📅
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Membership Period
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Set the membership start date and duration.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <div class="grid gap-6 md:grid-cols-2">


                                {{-- Start Date --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Start Date
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        name="start_date"
                                        id="start_date"
                                        value="{{ old('start_date', date('Y-m-d')) }}"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                    @error('start_date')
                                        <p class="mt-2 text-xs text-red-400">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- End Date --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        End Date
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <input
                                        type="date"
                                        name="end_date"
                                        id="end_date"
                                        value="{{ old('end_date') }}"
                                        readonly
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800/70 px-4 py-3 font-medium text-yellow-400 outline-none"
                                    >

                                    <p class="mt-2 text-xs text-zinc-500">
                                        Automatically calculated from the selected plan.
                                    </p>

                                </div>


                                {{-- Plan Price --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Plan Price
                                    </label>

                                    <div class="relative">

                                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-zinc-500">
                                            ₹
                                        </span>

                                        <input
                                            type="text"
                                            id="plan_price"
                                            value="₹0.00"
                                            readonly
                                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 pl-9 font-semibold text-white outline-none"
                                        >

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div>

                                    <label class="mb-2 block text-sm font-medium text-zinc-300">
                                        Membership Status
                                        <span class="text-red-400">*</span>
                                    </label>

                                    <select
                                        name="status"
                                        required
                                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                                    >

                                        <option value="Active">
                                            Active
                                        </option>

                                        <option value="Expired">
                                            Expired
                                        </option>

                                        <option value="Cancelled">
                                            Cancelled
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =============================================
                        FEE
                    ============================================== --}}
                    <div class="overflow-hidden rounded-2xl border border-emerald-500/20 bg-zinc-900">

                        <div class="border-b border-zinc-800 px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-400/10 text-emerald-400">
                                    ₹
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Membership Fee
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Final amount payable for this membership.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-6">

                            <label class="mb-2 block text-sm font-medium text-zinc-300">
                                Total Fee
                            </label>

                            <div class="relative">

                                <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-xl font-bold text-emerald-400">
                                    ₹
                                </span>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="final_amount"
                                    id="final_amount"
                                    value="{{ old('final_amount') }}"
                                    readonly
                                    required
                                    class="w-full rounded-xl border border-emerald-500/40 bg-emerald-500/5 px-4 py-4 pl-10 text-2xl font-bold text-emerald-400 outline-none"
                                >

                            </div>

                            <p class="mt-2 text-xs text-zinc-500">
                                This amount is automatically taken from the selected membership plan.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    RIGHT SIDE SUMMARY
                ================================================== --}}
                <div class="xl:col-span-1">

                    <div class="sticky top-6 overflow-hidden rounded-2xl border border-zinc-700/80 bg-zinc-900">


                        {{-- Summary Header --}}
                        <div class="border-b border-zinc-800 bg-zinc-900 px-6 py-6">

                            <div class="flex items-center gap-3">

                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-yellow-400 text-xl text-black">
                                    ✓
                                </div>

                                <div>

                                    <h2 class="text-lg font-semibold text-white">
                                        Membership Summary
                                    </h2>

                                    <p class="text-sm text-zinc-500">
                                        Review before saving.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Summary Body --}}
                        <div class="space-y-5 p-6">


                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/40 p-4">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Selected Plan
                                </p>

                                <p
                                    id="summary_plan"
                                    class="mt-2 text-lg font-semibold text-white"
                                >
                                    —
                                </p>

                            </div>


                            <div class="grid grid-cols-2 gap-4">

                                <div class="rounded-xl border border-zinc-800 bg-zinc-800/40 p-4">

                                    <p class="text-xs text-zinc-500">
                                        Duration
                                    </p>

                                    <p
                                        id="summary_duration"
                                        class="mt-2 font-semibold text-white"
                                    >
                                        —
                                    </p>

                                </div>


                                <div class="rounded-xl border border-zinc-800 bg-zinc-800/40 p-4">

                                    <p class="text-xs text-zinc-500">
                                        Status
                                    </p>

                                    <p class="mt-2 font-semibold text-green-400">
                                        Active
                                    </p>

                                </div>

                            </div>


                            <div class="rounded-2xl border border-emerald-500/20 bg-emerald-500/5 p-5">

                                <p class="text-xs uppercase tracking-wider text-zinc-500">
                                    Total Payable
                                </p>

                                <p
                                    id="summary_total"
                                    class="mt-2 text-3xl font-black text-emerald-400"
                                >
                                    ₹0.00
                                </p>

                            </div>


                            <div class="rounded-xl border border-zinc-800 bg-zinc-800/30 p-4">

                                <div class="flex items-start gap-3">

                                    <span class="text-yellow-400">
                                        💡
                                    </span>

                                    <p class="text-xs leading-5 text-zinc-500">
                                        The membership end date will be calculated automatically according to the selected plan duration.
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
                                    Save Membership
                                </flux:button>

                                <a
                                    href="{{ route('memberships.index') }}"
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

        </form>

    </div>


    {{-- =============================================================
        JAVASCRIPT
    ============================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const planSelect = document.getElementById('membership_plan_id');

            const startDate = document.getElementById('start_date');

            const endDate = document.getElementById('end_date');

            const planPrice = document.getElementById('plan_price');

            const finalAmount = document.getElementById('final_amount');

            const summaryPlan = document.getElementById('summary_plan');

            const summaryDuration = document.getElementById('summary_duration');

            const summaryTotal = document.getElementById('summary_total');


            function updateMembershipDetails() {

                const option = planSelect.options[planSelect.selectedIndex];


                if (!option || !option.value) {

                    planPrice.value = '₹0.00';

                    finalAmount.value = '';

                    summaryPlan.textContent = '—';

                    summaryDuration.textContent = '—';

                    summaryTotal.textContent = '₹0.00';

                    endDate.value = '';

                    return;

                }


                const price = parseFloat(option.dataset.price || 0);

                const duration = parseInt(option.dataset.duration || 0);


                const total = price;


                planPrice.value =
                    '₹' + price.toFixed(2);


                finalAmount.value =
                    total.toFixed(2);


                summaryPlan.textContent =
                    option.text.trim();


                summaryDuration.textContent =
                    duration +
                    (duration === 1 ? ' Month' : ' Months');


                summaryTotal.textContent =
                    '₹' + total.toFixed(2);


                /*
                 * Calculate End Date
                 *
                 * Example:
                 * Start: 20 Aug
                 * Duration: 1 Month
                 * End: 19 Sep
                 */

                if (startDate.value && duration > 0) {

                    const date = new Date(
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

            }


            planSelect.addEventListener(
                'change',
                updateMembershipDetails
            );


            startDate.addEventListener(
                'change',
                updateMembershipDetails
            );


            updateMembershipDetails();

        });

    </script>

</x-layouts::app>