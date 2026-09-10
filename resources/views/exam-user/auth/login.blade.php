<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Exam Login - {{ config('app.name', 'Malav Library') }}</title>

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
                    Online Examination
                </h1>

                <p class="mt-2 text-sm text-zinc-400">
                    Login to access your tests and examination results.
                </p>

            </div>


            {{-- Login Card --}}
            <div class="rounded-3xl border border-zinc-800 bg-zinc-900/80 p-6 shadow-2xl shadow-black/30 backdrop-blur">

                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white">
                        Welcome Back
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Enter your account details to continue.
                    </p>
                </div>


                {{-- Errors --}}
                @if ($errors->any())

                    <div class="mb-5 rounded-2xl border border-red-500/20 bg-red-500/10 p-4">

                        <div class="text-sm font-semibold text-red-400">
                            Login failed
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


                {{-- Success Message --}}
                @if (session('success'))

                    <div class="mb-5 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-4">

                        <p class="text-sm text-emerald-400">
                            {{ session('success') }}
                        </p>

                    </div>

                @endif


                <form
                    method="POST"
                    action="{{ route('exam-user.login.store') }}"
                    class="space-y-5"
                >

                    @csrf


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
                            autofocus
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    {{-- Password --}}
                    <div>

                        <div class="mb-2 flex items-center justify-between">

                            <label
                                for="password"
                                class="block text-sm font-medium text-zinc-200"
                            >
                                Password
                            </label>

                        </div>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-950 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20"
                        >

                    </div>


                    {{-- Remember --}}
                    <div class="flex items-center gap-2">

                        <input
                            id="remember"
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="h-4 w-4 rounded border-zinc-700 bg-zinc-950 text-indigo-600 focus:ring-indigo-500"
                        >

                        <label
                            for="remember"
                            class="text-sm text-zinc-400"
                        >
                            Remember me
                        </label>

                    </div>


                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="w-full rounded-xl bg-indigo-600 px-4 py-3.5 text-sm font-semibold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-500 hover:shadow-indigo-600/30 focus:outline-none focus:ring-2 focus:ring-indigo-500/40"
                    >
                        Login to Exam Portal
                    </button>

                </form>


                {{-- Register --}}
                <div class="mt-6 border-t border-zinc-800 pt-5 text-center">

                    <p class="text-sm text-zinc-500">
                        Don't have an exam account?
                    </p>

                    <a
                        href="{{ route('exam-user.register') }}"
                        class="mt-2 inline-block text-sm font-semibold text-indigo-400 transition hover:text-indigo-300"
                    >
                        Create a Free Account →
                    </a>

                </div>

            </div>


            {{-- Footer --}}
            <p class="mt-6 text-center text-xs text-zinc-600">
                Secure Online Examination Platform
            </p>

        </div>

    </div>

</body>
</html>