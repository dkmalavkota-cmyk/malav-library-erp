<x-layouts::app :title="'Reports'">

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex items-center justify-between">

    <div>

        <h1 class="text-3xl font-bold text-white">
            Reports & Analytics
        </h1>

        <p class="mt-1 text-sm text-zinc-400">
            Analyze library collection, expenses, students and attendance.
        </p>

    </div>

    <button
        type="button"
        onclick="window.print()"
        class="rounded-xl border border-zinc-700 bg-zinc-800 px-5 py-3 text-sm font-semibold text-white transition hover:bg-zinc-700"
    >
        🖨️ Print Report
    </button>

</div>

        {{-- Date Filter --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-white">
                    Report Period
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Select the period you want to analyze.
                </p>

            </div>


            <form
                method="GET"
                action="{{ route('reports.index') }}"
                class="grid grid-cols-1 gap-4 md:grid-cols-3"
            >

                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        From Date
                    </label>

                    <input
                        type="date"
                        name="from_date"
                        value="{{ $fromDate }}"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none focus:border-yellow-500"
                    >

                </div>


                <div>

                    <label class="mb-2 block text-sm font-medium text-zinc-400">
                        To Date
                    </label>

                    <input
                        type="date"
                        name="to_date"
                        value="{{ $toDate }}"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-white outline-none focus:border-yellow-500"
                    >

                </div>


                <div class="flex items-end gap-3">

                    <button
                        type="submit"
                        class="rounded-xl bg-yellow-400 px-6 py-3 text-sm font-semibold text-black transition hover:bg-yellow-300"
                    >
                        Generate Report
                    </button>


                    <a
                        href="{{ route('reports.index') }}"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-6 py-3 text-sm font-semibold text-zinc-200 transition hover:bg-zinc-700"
                    >
                        Reset
                    </a>

                </div>

            </form>

        </div>


        {{-- Main Statistics --}}
        <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-4">


            {{-- Collection --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Collection
                </p>

                <h2 class="mt-3 text-3xl font-bold text-green-400">
                    ₹{{ number_format($totalCollection, 2) }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    {{ $paymentCount }} payment records
                </p>

            </div>


            {{-- Expense --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Total Expense
                </p>

                <h2 class="mt-3 text-3xl font-bold text-red-400">
                    ₹{{ number_format($totalExpense, 2) }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    {{ $expenseCount }} expense records
                </p>

            </div>


            {{-- Net --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Net Collection
                </p>

                <h2 class="mt-3 text-3xl font-bold {{ $netCollection >= 0 ? 'text-sky-400' : 'text-red-400' }}">
                    ₹{{ number_format($netCollection, 2) }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Collection minus expenses
                </p>

            </div>


            {{-- Students --}}
            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    New Students
                </p>

                <h2 class="mt-3 text-3xl font-bold text-yellow-400">
                    {{ $newStudents }}
                </h2>

                <p class="mt-2 text-xs text-zinc-500">
                    Joined during selected period
                </p>

            </div>

        </div>


        {{-- Activity Statistics --}}
        <div class="grid gap-5 md:grid-cols-3">


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    New Memberships
                </p>

                <h2 class="mt-3 text-3xl font-bold text-purple-400">
                    {{ $newMemberships }}
                </h2>

            </div>


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Attendance Records
                </p>

                <h2 class="mt-3 text-3xl font-bold text-cyan-400">
                    {{ $attendanceCount }}
                </h2>

            </div>


            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                <p class="text-sm text-zinc-400">
                    Date Range
                </p>

                <h2 class="mt-3 text-lg font-semibold text-white">
                    {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }}
                    -
                    {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
                </h2>

            </div>

        </div>


        {{-- Payment & Expense Summaries --}}
        <div class="grid gap-6 lg:grid-cols-2">


            {{-- Payment Modes --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

                <div class="border-b border-zinc-700 px-6 py-5">

                    <h2 class="text-lg font-semibold text-white">
                        Collection by Payment Mode
                    </h2>

                </div>


                <div class="divide-y divide-zinc-800">

                    @forelse($paymentModes as $payment)

                        <div class="flex items-center justify-between px-6 py-4">

                            <span class="text-sm text-zinc-300">
                                {{ $payment->payment_mode }}
                            </span>

                            <span class="font-semibold text-green-400">
                                ₹{{ number_format($payment->total, 2) }}
                            </span>

                        </div>

                    @empty

                        <div class="px-6 py-10 text-center text-sm text-zinc-500">
                            No payment records found.
                        </div>

                    @endforelse

                </div>

            </div>


            {{-- Expense Categories --}}
            <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

                <div class="border-b border-zinc-700 px-6 py-5">

                    <h2 class="text-lg font-semibold text-white">
                        Expense by Category
                    </h2>

                </div>


                <div class="divide-y divide-zinc-800">

                    @forelse($expenseCategories as $expense)

                        <div class="flex items-center justify-between px-6 py-4">

                            <span class="text-sm text-zinc-300">
                                {{ $expense->category }}
                            </span>

                            <span class="font-semibold text-red-400">
                                ₹{{ number_format($expense->total, 2) }}
                            </span>

                        </div>

                    @empty

                        <div class="px-6 py-10 text-center text-sm text-zinc-500">
                            No expense records found.
                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- Recent Payments --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <div class="border-b border-zinc-700 px-6 py-5">

                <h2 class="text-lg font-semibold text-white">
                    Recent Payments
                </h2>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-zinc-700">

                        <tr class="text-left text-sm text-zinc-400">

                            <th class="px-6 py-4">
                                Receipt
                            </th>

                            <th class="px-6 py-4">
                                Student
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                            <th class="px-6 py-4">
                                Mode
                            </th>

                            <th class="px-6 py-4">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($recentPayments as $payment)

                            <tr class="border-b border-zinc-800">

                                <td class="px-6 py-4 font-medium text-yellow-400">
                                    {{ $payment->receipt_no }}
                                </td>

                                <td class="px-6 py-4 text-white">
                                    {{ $payment->student?->first_name }}
                                    {{ $payment->student?->last_name }}
                                </td>

                                <td class="px-6 py-4 text-zinc-300">
                                    {{ $payment->payment_date?->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-zinc-300">
                                    {{ $payment->payment_mode }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-green-400">
                                    ₹{{ number_format($payment->amount, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-10 text-center text-zinc-500"
                                >
                                    No payments found for this period.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Recent Expenses --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <div class="border-b border-zinc-700 px-6 py-5">

                <h2 class="text-lg font-semibold text-white">
                    Recent Expenses
                </h2>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-zinc-700">

                        <tr class="text-left text-sm text-zinc-400">

                            <th class="px-6 py-4">
                                Expense No.
                            </th>

                            <th class="px-6 py-4">
                                Title
                            </th>

                            <th class="px-6 py-4">
                                Category
                            </th>

                            <th class="px-6 py-4">
                                Date
                            </th>

                            <th class="px-6 py-4">
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($recentExpenses as $expense)

                            <tr class="border-b border-zinc-800">

                                <td class="px-6 py-4 font-medium text-yellow-400">
                                    {{ $expense->expense_no }}
                                </td>

                                <td class="px-6 py-4 text-white">
                                    {{ $expense->title }}
                                </td>

                                <td class="px-6 py-4 text-zinc-300">
                                    {{ $expense->category }}
                                </td>

                                <td class="px-6 py-4 text-zinc-300">
                                    {{ $expense->expense_date?->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-red-400">
                                    ₹{{ number_format($expense->amount, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="5"
                                    class="px-6 py-10 text-center text-zinc-500"
                                >
                                    No expenses found for this period.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <style>
    @media print {

        body {
            background: white !important;
            color: black !important;
        }

        button,
        form,
        a {
            display: none !important;
        }

        .border-zinc-700,
        .border-zinc-800 {
            border-color: #d4d4d4 !important;
        }

        .bg-zinc-900,
        .bg-zinc-950,
        .bg-zinc-800 {
            background: white !important;
        }

        .text-white,
        .text-zinc-300,
        .text-zinc-400,
        .text-zinc-500 {
            color: black !important;
        }

        .text-green-400,
        .text-red-400,
        .text-yellow-400,
        .text-sky-400,
        .text-purple-400,
        .text-cyan-400 {
            color: black !important;
        }

        table {
            width: 100% !important;
        }

        @page {
            size: A4;
            margin: 15mm;
        }
    }
</style>

</x-layouts::app>