<x-layouts::app :title="'Student Profile'">

<div class="max-w-7xl mx-auto space-y-6">

    {{-- ========================================================= --}}
    {{-- HEADER --}}
    {{-- ========================================================= --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Student Profile
            </h1>

            <p class="mt-1 text-zinc-400">
                {{ $student->student_code }}
            </p>
        </div>

        <div class="flex flex-wrap gap-3">

            <a href="{{ route('students.edit', $student) }}">
                <flux:button variant="primary">
                    Edit Student
                </flux:button>
            </a>

            <a
                href="{{ route('students.id-card', $student) }}"
                target="_blank"
            >
                <flux:button>
                    ID Card
                </flux:button>
            </a>

            <a href="{{ route('students.index') }}">
                <flux:button variant="ghost">
                    Back
                </flux:button>
            </a>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- STUDENT PROFILE --}}
    {{-- ========================================================= --}}

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- LEFT CARD --}}

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="flex flex-col items-center">

                @if($student->photo)

                    <img
                        src="{{ asset('storage/'.$student->photo) }}"
                        class="w-40 h-40 rounded-full object-cover border border-zinc-700"
                        alt="{{ $student->full_name }}"
                    >

                @else

                    <div class="w-40 h-40 rounded-full bg-zinc-800 flex items-center justify-center text-5xl font-bold text-zinc-500">

                        {{ strtoupper(substr($student->first_name, 0, 1)) }}

                    </div>

                @endif


                <h2 class="mt-5 text-2xl font-bold text-white text-center">

                    {{ $student->full_name }}

                </h2>

                <p class="text-zinc-400">

                    {{ $student->student_code }}

                </p>


                <div class="mt-4">

                    @if($student->status === 'Active')

                        <span class="inline-flex rounded-full bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-400">
                            Active
                        </span>

                    @elseif($student->status === 'Suspended')

                        <span class="inline-flex rounded-full bg-red-500/10 px-3 py-1 text-xs font-semibold text-red-400">
                            Suspended
                        </span>

                    @else

                        <span class="inline-flex rounded-full bg-zinc-500/10 px-3 py-1 text-xs font-semibold text-zinc-400">
                            Inactive
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- RIGHT CARD --}}

        <div class="lg:col-span-2 rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <p class="text-zinc-500 text-sm">
                        Father Name
                    </p>

                    <p class="text-white">
                        {{ $student->father_name ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Mobile
                    </p>

                    <p class="text-white">
                        {{ $student->mobile }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        WhatsApp
                    </p>

                    <p class="text-white">
                        {{ $student->whatsapp ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Email
                    </p>

                    <p class="text-white">
                        {{ $student->email ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Gender
                    </p>

                    <p class="text-white">
                        {{ $student->gender }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Date of Birth
                    </p>

                    <p class="text-white">
                        {{ $student->dob?->format('d M Y') ?? '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        College
                    </p>

                    <p class="text-white">
                        {{ $student->college ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Course
                    </p>

                    <p class="text-white">
                        {{ $student->course ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Preparing For
                    </p>

                    <p class="text-white">
                        {{ $student->preparing_for ?: '-' }}
                    </p>
                </div>


                <div>
                    <p class="text-zinc-500 text-sm">
                        Joining Date
                    </p>

                    <p class="text-white">
                        {{ $student->joining_date?->format('d M Y') ?? '-' }}
                    </p>
                </div>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- ADMISSION STATUS --}}
    {{-- ========================================================= --}}

    <div>

        <div class="mb-4">

            <h2 class="text-xl font-bold text-white">
                Admission Status
            </h2>

            <p class="mt-1 text-sm text-zinc-500">
                Current membership, seat and payment information.
            </p>

        </div>


        <div class="grid md:grid-cols-3 gap-5">


            {{-- MEMBERSHIP CARD --}}

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-zinc-500">
                            Membership
                        </p>

                        @if($membership)

                            <h3 class="mt-2 text-lg font-bold text-white">
                                {{ $membership->plan?->name ?? 'Membership' }}
                            </h3>

                        @else

                            <h3 class="mt-2 text-lg font-bold text-zinc-500">
                                Not Created
                            </h3>

                        @endif

                    </div>

                    <div class="rounded-xl bg-indigo-500/10 p-2 text-indigo-400">

                        <flux:icon.identification class="size-5" />

                    </div>

                </div>


                @if($membership)

                    <div class="mt-4 space-y-2 text-sm">

                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Shift
                            </span>

                            <span class="text-white">
                                {{ $membership->plan?->shift ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Start
                            </span>

                            <span class="text-white">
                                {{ $membership->start_date?->format('d M Y') ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Valid Till
                            </span>

                            <span class="text-white">
                                {{ $membership->end_date?->format('d M Y') ?? '-' }}
                            </span>

                        </div>

                    </div>

                @endif


                <div class="mt-5">

                    <a href="{{ route('memberships.create') }}">

                        <flux:button
                            size="sm"
                            variant="{{ $membership ? 'ghost' : 'primary' }}"
                            class="w-full"
                        >
                            {{ $membership ? 'Manage Membership' : 'Create Membership' }}
                        </flux:button>

                    </a>

                </div>

            </div>


            {{-- SEAT CARD --}}

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-zinc-500">
                            Seat Assignment
                        </p>

                        @if($assignment)

                            <h3 class="mt-2 text-lg font-bold text-white">
                                Seat {{ $assignment->seat?->seat_number ?? '-' }}
                            </h3>

                        @else

                            <h3 class="mt-2 text-lg font-bold text-zinc-500">
                                Not Assigned
                            </h3>

                        @endif

                    </div>

                    <div class="rounded-xl bg-amber-500/10 p-2 text-amber-400">

                        <flux:icon.squares-2x2 class="size-5" />

                    </div>

                </div>


                @if($assignment)

                    <div class="mt-4 space-y-2 text-sm">

                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Room
                            </span>

                            <span class="text-white">
                                {{ $assignment->seat?->room?->name ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Assigned
                            </span>

                            <span class="text-white">
                                {{ $assignment->assigned_date?->format('d M Y') ?? '-' }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Status
                            </span>

                            <span class="text-green-400">
                                Active
                            </span>

                        </div>

                    </div>

                @endif


                <div class="mt-5">

    @if($assignment)

        <a href="{{ route('seat-assignments.change', $assignment) }}">

            <flux:button
                size="sm"
                variant="ghost"
                class="w-full"
            >
                Manage Seat
            </flux:button>

        </a>

    @else

        <a href="{{ route('seat-assignments.create', ['student_id' => $student->id]) }}">

            <flux:button
                size="sm"
                variant="primary"
                class="w-full"
            >
                Assign Seat
            </flux:button>

        </a>

    @endif

</div>

            </div>


            {{-- PAYMENT CARD --}}

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="text-sm text-zinc-500">
                            Payment
                        </p>

                        @if($payment)

                            <h3 class="mt-2 text-lg font-bold text-white">
                                ₹{{ number_format($payment->amount, 2) }}
                            </h3>

                        @else

                            <h3 class="mt-2 text-lg font-bold text-zinc-500">
                                Not Paid
                            </h3>

                        @endif

                    </div>

                    <div class="rounded-xl bg-green-500/10 p-2 text-green-400">

                        <flux:icon.banknotes class="size-5" />

                    </div>

                </div>


                @if($payment)

                    <div class="mt-4 space-y-2 text-sm">

                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Receipt
                            </span>

                            <span class="text-white">
                                {{ $payment->receipt_no }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Mode
                            </span>

                            <span class="text-white">
                                {{ $payment->payment_mode }}
                            </span>

                        </div>


                        <div class="flex justify-between">

                            <span class="text-zinc-500">
                                Date
                            </span>

                            <span class="text-white">
                                {{ $payment->payment_date?->format('d M Y') ?? '-' }}
                            </span>

                        </div>

                    </div>


                    <div class="mt-5">

                        <a
                            href="{{ route('payments.receipt', $payment) }}"
                            target="_blank"
                        >

                            <flux:button
                                size="sm"
                                variant="ghost"
                                class="w-full"
                            >
                                View Receipt
                            </flux:button>

                        </a>

                    </div>

                @else

                    <div class="mt-5">

                        <a href="{{ route('payments.create') }}">

                            <flux:button
                                size="sm"
                                variant="primary"
                                class="w-full"
                            >
                                Collect Fee
                            </flux:button>

                        </a>

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- QUICK ACTIONS --}}
    {{-- ========================================================= --}}

    <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

        <div class="mb-5">

            <h2 class="text-xl font-bold text-white">
                Admission Actions
            </h2>

            <p class="mt-1 text-sm text-zinc-500">
                Manage this student's admission process.
            </p>

        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">


            <a href="{{ route('memberships.create') }}">

                <flux:button
                    variant="ghost"
                    class="w-full"
                >
                    Membership
                </flux:button>

            </a>


            <a href="{{ route('seat-assignments.create') }}">

                <flux:button
                    variant="ghost"
                    class="w-full"
                >
                    Assign Seat
                </flux:button>

            </a>


            <a href="{{ route('payments.create') }}">

                <flux:button
                    variant="ghost"
                    class="w-full"
                >
                    Collect Fee
                </flux:button>

            </a>


            <a
                href="{{ route('students.id-card', $student) }}"
                target="_blank"
            >

                <flux:button
                    variant="ghost"
                    class="w-full"
                >
                    ID Card
                </flux:button>

            </a>


        </div>

    </div>

</div>

</x-layouts::app>