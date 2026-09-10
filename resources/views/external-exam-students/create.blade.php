<x-layouts::examination :title="'Register External Student'">

    <div class="min-h-screen bg-zinc-950 px-6 py-8 text-white">

        <div class="mx-auto max-w-3xl">

            {{-- Header --}}
            <div class="mb-8 flex items-start justify-between gap-4">

                <div>
                    <div class="mb-2 text-xs font-semibold uppercase tracking-widest text-indigo-400">
                        Examination Management
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight">
                        Register External Student
                    </h1>

                    <p class="mt-2 text-sm text-zinc-500">
                        Create an examination account for an external candidate.
                    </p>
                </div>

                <a
                    href="{{ route('external-exam-students.index') }}"
                    class="rounded-xl border border-zinc-700 bg-zinc-900 px-4 py-2.5 text-sm font-semibold text-zinc-300 transition hover:border-zinc-600 hover:text-white"
                >
                    Back
                </a>

            </div>


            {{-- Errors --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-500/20 bg-red-500/10 p-4">

                    <div class="text-sm font-semibold text-red-400">
                        Please fix the following:
                    </div>

                    <ul class="mt-2 space-y-1 text-xs text-red-300">

                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- Form --}}
            <div class="rounded-3xl border border-zinc-800 bg-zinc-900/70 p-6 shadow-2xl shadow-black/20">

                <div class="mb-7 border-b border-zinc-800 pb-5">

                    <h2 class="text-lg font-semibold">
                        Candidate Details
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        These credentials will be used at
                        <span class="text-zinc-300">/exam-user/login</span>.
                    </p>

                </div>


                <form
                    method="POST"
                    action="{{ route('external-exam-students.store') }}"
                    class="space-y-6"
                >

                    @csrf


                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-zinc-200"
                        >
                            Full Name
                        </label>

                        <input
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Enter candidate full name"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-zinc-200"
                        >
                            Email Address
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder="candidate@example.com"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    {{-- Mobile --}}
                    <div>

                        <label
                            for="mobile"
                            class="mb-2 block text-sm font-medium text-zinc-200"
                        >
                            Mobile Number
                            <span class="text-xs font-normal text-zinc-500">
                                (Optional)
                            </span>
                        </label>

                        <input
                            id="mobile"
                            type="text"
                            name="mobile"
                            value="{{ old('mobile') }}"
                            autocomplete="tel"
                            placeholder="Enter mobile number"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- Password --}}
                        <div>

                            <label
                                for="password"
                                class="mb-2 block text-sm font-medium text-zinc-200"
                            >
                                Password
                            </label>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimum 8 characters"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            >

                        </div>


                        {{-- Confirm Password --}}
                        <div>

                            <label
                                for="password_confirmation"
                                class="mb-2 block text-sm font-medium text-zinc-200"
                            >
                                Confirm Password
                            </label>

                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Re-enter password"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                            >

                        </div>

                    </div>


                    {{-- Access Info --}}
                    <div class="rounded-2xl border border-indigo-500/15 bg-indigo-500/5 p-4">

                        <div class="flex gap-3">

                            <div class="mt-0.5 text-indigo-400">
                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.7"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>
                            </div>

                            <div>

                                <div class="text-sm font-semibold text-indigo-300">
                                    Examination Access
                                </div>

                                <p class="mt-1 text-xs leading-5 text-zinc-500">
                                    This candidate will automatically receive active
                                    examination access for your library. They can then
                                    log in using the credentials you provide and select
                                    up to 5 preparation categories.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-zinc-800 pt-6 sm:flex-row sm:justify-end">

                        <a
                            href="{{ route('external-exam-students.index') }}"
                            class="inline-flex items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900 px-5 py-3 text-sm font-semibold text-zinc-300 transition hover:border-zinc-600 hover:text-white"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                        >
                            Register External Student
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-layouts::examination>