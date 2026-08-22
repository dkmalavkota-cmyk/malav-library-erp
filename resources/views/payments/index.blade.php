<x-layouts::app :title="'Payments'">

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Payments
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage fee collections, payments and receipts.
                </p>
            </div>

            <a href="{{ route('payments.create') }}">
                <flux:button variant="primary">
                    + Collect Fee
                </flux:button>
            </a>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="rounded-xl border border-green-700 bg-green-900/20 p-4 text-green-300">
                {{ session('success') }}
            </div>

        @endif


        {{-- Error Message --}}
        @if($errors->any())

            <div class="rounded-xl border border-red-700 bg-red-900/20 p-4 text-red-300">

                <ul class="space-y-1">

                    @foreach($errors->all() as $error)

                        <li>
                            • {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Statistics --}}
        <div class="grid gap-6 md:grid-cols-3">

            {{-- Today's Collection --}}
            <div class="rounded-2xl border border-green-700 bg-green-900/20 p-6">

                <p class="text-sm text-green-300">
                    Today's Collection
                </p>

                <h2 class="mt-2 text-3xl font-bold text-green-400">
                    ₹{{ number_format($todayCollection, 2) }}
                </h2>

            </div>


            {{-- Today's Payments --}}
            <div class="rounded-2xl border border-blue-700 bg-blue-900/20 p-6">

                <p class="text-sm text-blue-300">
                    Today's Payments
                </p>

                <h2 class="mt-2 text-3xl font-bold text-blue-400">
                    {{ $todayPayments }}
                </h2>

            </div>


            {{-- Total Collection --}}
            <div class="rounded-2xl border border-yellow-700 bg-yellow-900/20 p-6">

                <p class="text-sm text-yellow-300">
                    Total Collection
                </p>

                <h2 class="mt-2 text-3xl font-bold text-yellow-400">
                    ₹{{ number_format($totalCollection, 2) }}
                </h2>

            </div>

        </div>


        {{-- Search --}}
        <form
            method="GET"
            action="{{ route('payments.index') }}"
            class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6"
        >

            <div class="flex flex-col gap-3 md:flex-row">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search receipt, student, mobile, payment mode..."
                    class="flex-1 rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder-zinc-500 focus:border-indigo-500 focus:outline-none"
                >

                <flux:button
                    type="submit"
                    variant="primary"
                >
                    Search
                </flux:button>

                <a href="{{ route('payments.index') }}">

                    <flux:button
                        type="button"
                        variant="ghost"
                    >
                        Reset
                    </flux:button>

                </a>

            </div>

        </form>


        {{-- Payment Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-zinc-700">

                    <thead class="bg-zinc-800">

                        <tr>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                #
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Receipt
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Student
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Plan
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Amount
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Mode
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
                                Date
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-zinc-300">
    Actions
</th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-zinc-700 bg-zinc-900">

                        @forelse($payments as $payment)

                            <tr class="transition hover:bg-zinc-800/50">

                                {{-- Number --}}
                                <td class="px-6 py-4 text-zinc-400">

                                    {{ $loop->iteration + ($payments->firstItem() ?? 0) - 1 }}

                                </td>


                                {{-- Receipt --}}
                                <td class="px-6 py-4">

                                    <span class="font-semibold text-yellow-400">
                                        {{ $payment->receipt_no }}
                                    </span>

                                </td>


                                {{-- Student --}}
                                <td class="px-6 py-4">

                                    <div>

                                        <p class="font-semibold text-white">

                                            {{ $payment->student->first_name }}
                                            {{ $payment->student->last_name }}

                                        </p>

                                        <p class="text-xs text-zinc-500">

                                            {{ $payment->student->student_code }}

                                            @if($payment->student->mobile)
                                                • {{ $payment->student->mobile }}
                                            @endif

                                        </p>

                                    </div>

                                </td>


                                {{-- Plan --}}
                                <td class="px-6 py-4">

                                    <div>

                                        <p class="font-medium text-white">

                                            {{ $payment->membership->plan->name }}

                                        </p>

                                        <p class="text-xs text-zinc-500">

                                            {{ $payment->membership->plan->duration_months }}
                                            {{ $payment->membership->plan->duration_months == 1 ? 'Month' : 'Months' }}

                                            •

                                            {{ $payment->membership->plan->shift }}

                                        </p>

                                    </div>

                                </td>


                                {{-- Amount --}}
                                <td class="px-6 py-4">

                                    <span class="font-bold text-green-400">

                                        ₹{{ number_format($payment->amount, 2) }}

                                    </span>

                                </td>


                                {{-- Payment Mode --}}
                                <td class="px-6 py-4">

                                    @if($payment->payment_mode === 'Cash')

                                        <span class="rounded-full bg-green-900/40 px-3 py-1 text-xs font-semibold text-green-300">
                                            Cash
                                        </span>

                                    @elseif($payment->payment_mode === 'UPI')

                                        <span class="rounded-full bg-blue-900/40 px-3 py-1 text-xs font-semibold text-blue-300">
                                            UPI
                                        </span>

                                    @elseif($payment->payment_mode === 'Card')

                                        <span class="rounded-full bg-purple-900/40 px-3 py-1 text-xs font-semibold text-purple-300">
                                            Card
                                        </span>

                                    @else

                                        <span class="rounded-full bg-yellow-900/40 px-3 py-1 text-xs font-semibold text-yellow-300">
                                            Bank Transfer
                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td class="px-6 py-4 text-zinc-300">

                                    {{ optional($payment->payment_date)->format('d M Y') }}

                                </td>

{{-- Actions --}}
<td class="px-6 py-4">

    <a
        href="{{ route('payments.receipt', $payment) }}"
        class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-500"
    >
        Receipt
    </a>

</td>


                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="px-6 py-16 text-center"
                                >

                                    <div class="space-y-3">

                                        <div class="text-5xl">
                                            💰
                                        </div>

                                        <h3 class="text-xl font-semibold text-white">
                                            No Payments Found
                                        </h3>

                                        <p class="text-zinc-400">
                                            No fee payments have been recorded yet.
                                        </p>

                                        <a href="{{ route('payments.create') }}">

                                            <flux:button variant="primary">
                                                Collect First Payment
                                            </flux:button>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- Pagination --}}
        @if($payments->hasPages())

            <div>

                {{ $payments->links() }}

            </div>

        @endif

    </div>

</x-layouts::app>