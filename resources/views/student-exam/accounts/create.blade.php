<x-layouts::app :title="'Student Exam Account'">

    <div class="max-w-3xl mx-auto space-y-6">

        {{-- Header --}}
        <div>
            <h1 class="text-3xl font-bold text-white">
                Student Exam Account
            </h1>

            <p class="mt-1 text-zinc-400">
                Create or manage exam portal login for this student.
            </p>
        </div>

        {{-- Student Information --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="flex items-center gap-4">

                @if($student->photo)

                    <img
                        src="{{ asset('storage/'.$student->photo) }}"
                        class="w-16 h-16 rounded-full object-cover border border-zinc-700"
                        alt="{{ $student->full_name }}"
                    >

                @else

                    <div class="w-16 h-16 rounded-full bg-zinc-800 flex items-center justify-center text-xl font-bold text-zinc-400">
                        {{ strtoupper(substr($student->first_name, 0, 1)) }}
                    </div>

                @endif

                <div>
                    <h2 class="text-xl font-bold text-white">
                        {{ $student->full_name }}
                    </h2>

                    <p class="text-sm text-zinc-500">
                        {{ $student->student_code }}
                    </p>
                </div>

            </div>

        </div>

        {{-- Account Form --}}
        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-white">
                    Exam Portal Login
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Student will use these credentials to access the exam portal.
                </p>
            </div>

            @if ($errors->any())

                <div class="mb-5 rounded-xl border border-red-500/20 bg-red-500/10 p-4">

                    <ul class="text-sm text-red-400 space-y-1">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                method="POST"
                action="{{ route('students.exam-account.store', $student) }}"
                class="space-y-5"
            >

                @csrf

                {{-- Email --}}
                <div>

                    <label
                        for="email"
                        class="block text-sm font-medium text-zinc-300 mb-2"
                    >
                        Exam Login Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $account?->email ?? $student->email) }}"
                        required
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none focus:border-zinc-400"
                        placeholder="student@example.com"
                    >

                </div>

                {{-- Password --}}
                <div>

                    <label
                        for="password"
                        class="block text-sm font-medium text-zinc-300 mb-2"
                    >
                        {{ $account ? 'New Password' : 'Password' }}
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        minlength="6"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none focus:border-zinc-400"
                        placeholder="Minimum 6 characters"
                    >

                </div>

                {{-- Confirm Password --}}
                <div>

                    <label
                        for="password_confirmation"
                        class="block text-sm font-medium text-zinc-300 mb-2"
                    >
                        Confirm Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        minlength="6"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none focus:border-zinc-400"
                        placeholder="Re-enter password"
                    >

                </div>

                {{-- Buttons --}}
                <div class="flex flex-wrap gap-3 pt-2">

                    <flux:button
                        type="submit"
                        variant="primary"
                    >
                        {{ $account ? 'Update Exam Login' : 'Create Exam Login' }}
                    </flux:button>

                    <a href="{{ route('students.show', $student) }}">

                        <flux:button
                            type="button"
                            variant="ghost"
                        >
                            Cancel
                        </flux:button>

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-layouts::app>