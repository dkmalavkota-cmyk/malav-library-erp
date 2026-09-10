<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Create Exam Account - {{ config('app.name', 'Malav Library') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @fluxAppearance
</head>

<body class="min-h-screen bg-zinc-950 text-white">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">

            {{-- Brand --}}
            <div class="mb-8 text-center">

                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600 text-xl font-bold shadow-lg shadow-indigo-600/30">
                    E
                </div>

                <h1 class="text-2xl font-bold tracking-tight">
                    Create Your Exam Account
                </h1>

                <p class="mt-2 text-sm text-zinc-400">
                    Join our online examination platform and start taking tests.
                </p>

            </div>


            {{-- Registration Card --}}
            <div class="rounded-3xl border border-zinc-800 bg-zinc-900/80 p-6 shadow-2xl shadow-black/30 backdrop-blur">

                <div class="mb-6">

                    <h2 class="text-lg font-semibold text-white">
                        Register
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Create a free account to access available examinations.
                    </p>

                </div>


                {{-- Validation Errors --}}
                @if ($errors->any())

                    <div class="mb-5 rounded-2xl border border-red-500/20 bg-red-500/10 p-4">

                        <div class="text-sm font-semibold text-red-400">
                            Please fix the following:
                        </div>

                        <ul class="mt-2 space-y-1 text-xs text-red-300">

                            @foreach ($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('exam-user.register.store') }}"
                    class="space-y-5"
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
                            placeholder="Enter your full name"
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
                            placeholder="you@example.com"
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
                            placeholder="Enter your mobile number"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


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
                            placeholder="Re-enter your password"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-indigo-600 px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500 hover:shadow-indigo-600/30 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                    >
                        Create Exam Account
                    </button>

                </form>


                {{-- Login --}}
                <div class="mt-6 border-t border-zinc-800 pt-5 text-center">

                    <p class="text-sm text-zinc-500">
                        Already have an account?
                    </p>

                    <a
                        href="{{ route('exam-user.login') }}"
                        class="mt-2 inline-block text-sm font-semibold text-indigo-400 transition hover:text-indigo-300"
                    >
                        Login to your account →
                    </a>

                </div>

            </div>


            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-zinc-600">
                Secure online examination platform
            </p>

        </div>

    </div>

</body>
</html>