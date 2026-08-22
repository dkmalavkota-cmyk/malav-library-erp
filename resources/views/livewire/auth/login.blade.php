<x-layouts::auth :title="__('Malav Library ERP - Login')">

    <div class="w-full">

        {{-- Login Card --}}
        <div
            class="w-full overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-900 shadow-2xl shadow-black/30"
        >

            {{-- Header --}}
            <div class="border-b border-zinc-800 px-10 pt-8 pb-6">

                <h2 class="text-3xl font-bold leading-tight text-white">
                    Welcome Back 👋
                </h2>

                <p class="mt-3 text-base text-zinc-500">
                    Sign in to your Malav Library ERP account.
                </p>

            </div>


            {{-- Form Area --}}
            <div class="px-10 py-8">

                {{-- Session Status --}}
                <x-auth-session-status
                    class="mb-6"
                    :status="session('status')"
                />


                <form
                    method="POST"
                    action="{{ route('login.store') }}"
                    class="space-y-6"
                >

                    @csrf


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-medium text-zinc-300"
                        >
                            Email address
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="admin@malavlibrary.com"
                            class="block w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3.5 text-sm text-white outline-none transition placeholder:text-zinc-500 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div x-data="{ showPassword: false }">

                        <div class="mb-2 flex items-center justify-between gap-4">

                            <label
                                for="password"
                                class="text-sm font-medium text-zinc-300"
                            >
                                Password
                            </label>

                            @if (Route::has('password.request'))

                                <a
                                    href="{{ route('password.request') }}"
                                    wire:navigate
                                    class="shrink-0 text-sm font-medium text-yellow-400 transition hover:text-yellow-300"
                                >
                                    Forgot password?
                                </a>

                            @endif

                        </div>


                        {{-- Password Input --}}
                        <div class="relative">

                            <input
                                id="password"
                                name="password"
                                x-bind:type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="current-password"
                                placeholder="Enter your password"
                                class="block w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3.5 pr-12 text-sm text-white outline-none transition placeholder:text-zinc-500 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >


                            {{-- Password Visibility Button --}}
                            <button
                                type="button"
                                x-on:click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-zinc-500 transition hover:text-yellow-400"
                                aria-label="Toggle password visibility"
                            >

                                {{-- Eye --}}
                                <svg
                                    x-show="!showPassword"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.644C3.423 7.51 7.36 5 12 5c4.64 0 8.577 2.51 9.964 6.678.046.138.046.286 0 .444C20.577 16.49 16.64 19 12 19c-4.64 0-8.577-2.51-9.964-6.678z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>


                                {{-- Eye Off --}}
                                <svg
                                    x-show="showPassword"
                                    x-cloak
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.8"
                                    stroke="currentColor"
                                    class="h-5 w-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.168 19 12 19c1.68 0 3.25-.36 4.64-1.003"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M6.228 6.228A10.45 10.45 0 0112 5c4.832 0 8.774 2.662 10.066 7a10.45 10.45 0 01-1.597 3.203"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 3l18 18"
                                    />
                                </svg>

                            </button>

                        </div>


                        @error('password')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Remember Me --}}
                    <div class="flex items-center">

                        <label class="inline-flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                                class="h-4 w-4 rounded border-zinc-600 bg-zinc-800 text-yellow-400 focus:ring-yellow-400/20"
                            >

                            <span class="text-sm text-zinc-400">
                                Remember me
                            </span>

                        </label>

                    </div>


                    {{-- Login Button --}}
                    <button
                        type="submit"
                        data-test="login-button"
                        class="flex w-full items-center justify-center rounded-xl bg-yellow-400 px-5 py-3.5 text-sm font-bold text-black shadow-lg shadow-yellow-400/10 transition duration-200 hover:bg-yellow-300 hover:shadow-yellow-400/20 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:ring-offset-zinc-900 active:scale-[0.99]"
                    >
                        Sign In to ERP
                    </button>

                </form>


                {{-- Security Note --}}
                <div
                    class="mt-7 flex items-center justify-center gap-2 border-t border-zinc-800 pt-5"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.7"
                        stroke="currentColor"
                        class="h-4 w-4 shrink-0 text-emerald-500"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75m6.75 2.25a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0z"
                        />
                    </svg>

                    <span class="text-xs text-zinc-500">
                        Secure access to Malav Library ERP
                    </span>

                </div>

            </div>

        </div>

    </div>

</x-layouts::auth>