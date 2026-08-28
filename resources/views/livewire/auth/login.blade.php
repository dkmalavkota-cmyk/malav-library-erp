<x-layouts::auth.simple :title="__('Library ERP - Login')">

    <style>
        .login-shell {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
        }

        .login-brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-brand-name {
            color: #ffffff;
            font-size: 34px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -0.8px;
        }

        .login-brand-product {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-top: 10px;
        }

        .login-brand-line {
            width: 34px;
            height: 1px;
            background: rgba(245, 158, 11, .55);
        }

        .login-brand-product span {
            color: #fbbf24;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 3px;
        }

        .login-brand-tagline {
            margin-top: 10px;
            color: #71717a;
            font-size: 14px;
        }

        .login-card {
            position: relative;
            width: 100%;
            box-sizing: border-box;
            overflow: hidden;
            border: 1px solid rgba(245, 158, 11, .20);
            border-radius: 22px;
            background: rgba(13, 17, 23, .96);
            box-shadow:
                0 30px 80px rgba(0, 0, 0, .50),
                0 0 40px rgba(245, 158, 11, .035);
        }

        .login-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 25%;
            width: 50%;
            height: 1px;
            background: linear-gradient(
                90deg,
                transparent,
                #f59e0b,
                transparent
            );
        }

        .login-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 25px 30px;
            border-bottom: 1px solid rgba(255, 255, 255, .07);
        }

        .login-user-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            border: 1px solid rgba(245, 158, 11, .35);
            background: rgba(245, 158, 11, .08);
            color: #fbbf24;
        }

        .login-card-title {
            color: #ffffff;
            font-size: 21px;
            line-height: 1.2;
            font-weight: 750;
        }

        .login-card-subtitle {
            margin-top: 4px;
            color: #71717a;
            font-size: 13px;
        }

        .login-form {
            padding: 28px 30px 26px;
        }

        .login-field {
            margin-bottom: 21px;
        }

        .login-label-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .login-label {
            color: #d4d4d8;
            font-size: 13px;
            font-weight: 650;
        }

        .login-forgot {
            color: #fbbf24;
            font-size: 12px;
            font-weight: 650;
            text-decoration: none;
        }

        .login-forgot:hover {
            color: #fcd34d;
        }

        .login-input-wrap {
            position: relative;
            width: 100%;
        }

        .login-input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 19px;
            height: 19px;
            color: #71717a;
            pointer-events: none;
        }

        .login-input {
            width: 100%;
            height: 50px;
            box-sizing: border-box;
            border-radius: 11px;
            border: 1px solid #292d35;
            background: #0a0d12;
            color: #ffffff;
            padding: 0 15px 0 47px;
            font-size: 14px;
            outline: none;
            transition: all .2s ease;
        }

        .login-input::placeholder {
            color: #52525b;
        }

        .login-input:hover {
            border-color: #3f3f46;
        }

        .login-input:focus {
            border-color: rgba(245, 158, 11, .75);
            box-shadow: 0 0 0 4px rgba(245, 158, 11, .08);
        }

        .login-password-input {
            padding-right: 48px;
        }

        .login-eye {
            position: absolute;
            right: 0;
            top: 0;
            width: 48px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 0;
            background: transparent;
            color: #71717a;
            cursor: pointer;
        }

        .login-eye:hover {
            color: #fbbf24;
        }

        .login-error {
            margin-top: 7px;
            color: #f87171;
            font-size: 12px;
        }

        .login-remember {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: -2px;
            margin-bottom: 22px;
        }

        .login-checkbox {
            width: 17px;
            height: 17px;
            accent-color: #f59e0b;
            cursor: pointer;
        }

        .login-remember-text {
            color: #a1a1aa;
            font-size: 13px;
            cursor: pointer;
        }

        .login-button {
            width: 100%;
            height: 50px;
            border: 0;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: linear-gradient(
                135deg,
                #f59e0b,
                #fbbf24,
                #f59e0b
            );
            background-size: 200% 100%;
            color: #09090b;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(245, 158, 11, .14);
            transition: all .2s ease;
        }

        .login-button:hover {
            background-position: 100% 0;
            transform: translateY(-1px);
            box-shadow: 0 12px 30px rgba(245, 158, 11, .22);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-security {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 21px;
            padding-top: 19px;
            border-top: 1px solid rgba(255, 255, 255, .06);
            color: #71717a;
            font-size: 12px;
        }

        .login-security svg {
            width: 16px;
            height: 16px;
            color: #10b981;
        }

        .login-support {
            text-align: center;
            margin-top: 25px;
        }

        .login-support-link {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
        }

        .login-whatsapp-row {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #a1a1aa;
            font-size: 12px;
            transition: color .2s ease;
        }

        .login-support-link:hover .login-whatsapp-row {
            color: #ffffff;
        }

        .login-whatsapp-icon {
            width: 18px;
            height: 18px;
            color: #22c55e;
        }

        .login-phone {
            margin-top: 5px;
            color: #fbbf24;
            font-size: 16px;
            font-weight: 750;
            letter-spacing: .5px;
        }

        .login-footer {
            margin-top: 18px;
            text-align: center;
            color: #52525b;
            font-size: 11px;
            line-height: 1.8;
        }

        .login-footer a {
            color: #71717a;
            text-decoration: none;
        }

        .login-footer a:hover {
            color: #fbbf24;
        }

        .login-footer strong {
            color: #a1a1aa;
            font-weight: 650;
        }

        @media (max-width: 700px) {
            .login-shell {
                max-width: 100%;
            }

            .login-brand-name {
                font-size: 29px;
            }

            .login-card-header {
                padding: 22px;
            }

            .login-form {
                padding: 24px 22px 23px;
            }
        }

        @media (max-width: 420px) {
            .login-brand-name {
                font-size: 25px;
            }

            .login-brand-tagline {
                font-size: 13px;
            }

            .login-card {
                border-radius: 18px;
            }

            .login-card-header {
                padding: 20px;
            }

            .login-form {
                padding: 22px 18px;
            }
        }
    </style>


    <div class="erp-login-content">

        <div class="login-shell">

            {{-- ===================================================== --}}
            {{-- BRAND --}}
            {{-- ===================================================== --}}

            <div class="login-brand">

                <div class="login-brand-name">
                    Malav Technologies
                </div>

                <div class="login-brand-product">

                    <span class="login-brand-line"></span>

                    <span>LIBRARY ERP</span>

                    <span class="login-brand-line"></span>

                </div>

                <div class="login-brand-tagline">
                    Smart library management, simplified.
                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- LOGIN CARD --}}
            {{-- ===================================================== --}}

            <div class="login-card">

                {{-- Header --}}
                <div class="login-card-header">

                    <div class="login-user-icon">

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.6"
                            width="24"
                            height="24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4.5 20.25a8.25 8.25 0 0115 0"
                            />
                        </svg>

                    </div>

                    <div>

                        <div class="login-card-title">
                            Welcome back
                        </div>

                        <div class="login-card-subtitle">
                            Sign in to continue to your ERP
                        </div>

                    </div>

                </div>


                {{-- Form --}}
                <div class="login-form">

                    <x-auth-session-status
                        class="mb-5"
                        :status="session('status')"
                    />

                    <form
                        method="POST"
                        action="{{ route('login.store') }}"
                    >

                        @csrf


                        {{-- EMAIL --}}
                        <div class="login-field">

                            <div class="login-label-row">

                                <label
                                    for="email"
                                    class="login-label"
                                >
                                    Email address
                                </label>

                            </div>

                            <div class="login-input-wrap">

                                <svg
                                    class="login-input-icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615A2.25 2.25 0 012.25 6.993V6.75"
                                    />
                                </svg>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                    placeholder="Enter your email"
                                    class="login-input"
                                >

                            </div>

                            @error('email')
                                <div class="login-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PASSWORD --}}
                        <div
                            class="login-field"
                            x-data="{ showPassword: false }"
                        >

                            <div class="login-label-row">

                                <label
                                    for="password"
                                    class="login-label"
                                >
                                    Password
                                </label>

                                @if (Route::has('password.request'))

                                    <a
                                        href="{{ route('password.request') }}"
                                        wire:navigate
                                        class="login-forgot"
                                    >
                                        Forgot password?
                                    </a>

                                @endif

                            </div>


                            <div class="login-input-wrap">

                                <svg
                                    class="login-input-icon"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V6.75a4.5 4.5 0 00-9 0v3.75m-.75 0h10.5A2.25 2.25 0 0119.5 12.75v6.75a2.25 2.25 0 01-2.25 2.25h-10.5A2.25 2.25 0 014.5 19.5v-6.75a2.25 2.25 0 012.25-2.25z"
                                    />
                                </svg>


                                <input
                                    id="password"
                                    name="password"
                                    x-bind:type="showPassword ? 'text' : 'password'"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Enter your password"
                                    class="login-input login-password-input"
                                >


                                <button
                                    type="button"
                                    class="login-eye"
                                    x-on:click="showPassword = !showPassword"
                                    aria-label="Toggle password visibility"
                                >

                                    <svg
                                        x-show="!showPassword"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        width="19"
                                        height="19"
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


                                    <svg
                                        x-show="showPassword"
                                        x-cloak
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        width="19"
                                        height="19"
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
                                <div class="login-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- REMEMBER --}}
                        <div class="login-remember">

                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                                value="1"
                                {{ old('remember') ? 'checked' : '' }}
                                class="login-checkbox"
                            >

                            <label
                                for="remember"
                                class="login-remember-text"
                            >
                                Remember me
                            </label>

                        </div>


                        {{-- LOGIN BUTTON --}}
                        <button
                            type="submit"
                            data-test="login-button"
                            class="login-button"
                        >

                            <span>
                                Sign In to Library ERP
                            </span>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                                width="19"
                                height="19"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"
                                />
                            </svg>

                        </button>


                        {{-- SECURITY --}}
                        <div class="login-security">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.7"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 12.75L11.25 15 15 9.75m6.75 2.25a8.25 8.25 0 11-16.5 0 8.25 8.25 0 0116.5 0z"
                                />
                            </svg>

                            <span>
                                Secure access to your library workspace
                            </span>

                        </div>

                    </form>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- SUPPORT --}}
            {{-- ===================================================== --}}

            <div class="login-support">

                <a
                    href="https://wa.me/919509827100"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="login-support-link"
                >

                    <div class="login-whatsapp-row">

                        <svg
                            class="login-whatsapp-icon"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <path
                                d="M20.52 3.48A11.8 11.8 0 0012.1 0C5.58 0 .28 5.3.28 11.82c0 2.08.54 4.1 1.57 5.88L.2 24l6.45-1.62a11.8 11.8 0 005.45 1.34h.01c6.52 0 11.82-5.3 11.82-11.82 0-3.16-1.23-6.13-3.41-8.42zM12.11 21.7h-.01a9.84 9.84 0 01-5.02-1.38l-.36-.21-3.83.96 1.02-3.74-.23-.38a9.85 9.85 0 01-1.51-5.13C2.17 6.37 6.62 1.92 12.1 1.92a9.83 9.83 0 016.99 2.9 9.83 9.83 0 012.9 7c0 5.45-4.44 9.88-9.88 9.88zm5.42-7.4c-.3-.15-1.78-.88-2.05-.98-.28-.1-.48-.15-.68.15-.2.3-.78.98-.96 1.18-.18.2-.35.22-.65.08-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.51-1.79-1.69-2.09-.18-.3-.02-.46.13-.61.14-.14.3-.35.45-.53.15-.18.2-.3.3-.5.1-.2.05-.38-.02-.53-.08-.15-.68-1.64-.93-2.25-.24-.59-.49-.51-.68-.52h-.58c-.2 0-.53.08-.8.38-.28.3-1.06 1.03-1.06 2.5 0 1.48 1.08 2.9 1.23 3.1.15.2 2.12 3.24 5.14 4.54.72.31 1.28.49 1.72.63.72.23 1.38.2 1.9.12.58-.09 1.78-.73 2.03-1.43.25-.7.25-1.3.18-1.43-.08-.13-.28-.2-.58-.35z"
                            />
                        </svg>

                        <span>
                            Need help? Chat with us on WhatsApp
                        </span>

                    </div>

                    <div class="login-phone">
                        +91-9509827100
                    </div>

                </a>


                <div class="login-footer">

                    <div>
                        © {{ now()->year }} Malav Technologies
                    </div>

                    <a
                        href="https://malavtechnologies.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Powered by
                        <strong>Malav Technologies</strong>
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-layouts::auth.simple>