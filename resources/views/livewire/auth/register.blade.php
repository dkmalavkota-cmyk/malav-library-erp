<x-layouts::auth :title="__('Register')">

    <style>
        .mt-register-page {
            min-height: 100vh;
            background: #f5f7fb;
            color: #172033;
            padding: 40px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mt-register-shell {
            width: 100%;
            max-width: 1120px;
            background: #ffffff;
            border: 1px solid #e5e9f2;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(15, 23, 42, 0.10);
            display: grid;
            grid-template-columns: 42% 58%;
        }

        /* LEFT BRAND PANEL */
        .mt-brand-panel {
            position: relative;
            overflow: hidden;
            padding: 48px;
            background: linear-gradient(145deg, #172554 0%, #1e40af 55%, #2563eb 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .mt-brand-panel::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            top: -120px;
            right: -100px;
        }

        .mt-brand-panel::after {
            content: "";
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.08);
            bottom: -190px;
            left: -150px;
        }

        .mt-brand-content,
        .mt-brand-footer {
            position: relative;
            z-index: 2;
        }

        .mt-logo {
            display: flex;
            align-items: center;
            gap: 13px;
            margin-bottom: 70px;
        }

        .mt-logo-mark {
            width: 46px;
            height: 46px;
            border-radius: 13px;
            background: #ffffff;
            color: #1d4ed8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            font-weight: 800;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .mt-logo-name {
            font-size: 19px;
            font-weight: 750;
            line-height: 1.2;
            letter-spacing: -0.02em;
        }

        .mt-logo-sub {
            margin-top: 4px;
            font-size: 11px;
            color: rgba(255,255,255,0.68);
        }

        .mt-badge {
            display: inline-flex;
            align-items: center;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.11);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.9);
            font-size: 11px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .mt-brand-title {
            font-size: 38px;
            line-height: 1.12;
            letter-spacing: -0.04em;
            font-weight: 750;
            margin: 0;
        }

        .mt-brand-description {
            margin-top: 18px;
            max-width: 390px;
            font-size: 14px;
            line-height: 1.8;
            color: rgba(255,255,255,0.72);
        }

        .mt-feature-list {
            margin-top: 36px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .mt-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 13px;
            color: rgba(255,255,255,0.9);
        }

        .mt-feature-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(255,255,255,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .mt-brand-footer {
            margin-top: 55px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.13);
            font-size: 11px;
            color: rgba(255,255,255,0.55);
        }

        /* RIGHT FORM */
        .mt-form-panel {
            padding: 48px 55px;
            background: #ffffff;
        }

        .mt-form-header {
            margin-bottom: 30px;
        }

        .mt-form-label-small {
            color: #2563eb;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 9px;
        }

        .mt-form-title {
            margin: 0;
            color: #111827;
            font-size: 30px;
            line-height: 1.2;
            font-weight: 750;
            letter-spacing: -0.035em;
        }

        .mt-form-description {
            margin-top: 9px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .mt-form {
            display: flex;
            flex-direction: column;
            gap: 19px;
        }

        .mt-field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .mt-field label {
            color: #334155;
            font-size: 12px;
            font-weight: 650;
        }

        .mt-input {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border-radius: 10px;
            border: 1px solid #dbe1ea;
            background: #ffffff;
            color: #172033;
            font-size: 13px;
            outline: none;
            transition: all 0.18s ease;
            box-sizing: border-box;
        }

        .mt-input::placeholder {
            color: #94a3b8;
        }

        .mt-input:hover {
            border-color: #b8c2d1;
        }

        .mt-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
        }

        .mt-password-wrap {
            position: relative;
        }

        .mt-password-wrap .mt-input {
            padding-right: 48px;
        }

        .mt-password-toggle {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #64748b;
            cursor: pointer;
            font-size: 12px;
            padding: 5px;
        }

        .mt-password-toggle:hover {
            color: #2563eb;
        }

        .mt-two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .mt-submit {
            width: 100%;
            height: 49px;
            margin-top: 5px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 8px 20px rgba(37,99,235,0.20);
            transition: all 0.2s ease;
        }

        .mt-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 11px 25px rgba(37,99,235,0.27);
        }

        .mt-login {
            margin-top: 25px;
            padding-top: 22px;
            border-top: 1px solid #edf0f5;
            text-align: center;
            font-size: 12px;
            color: #64748b;
        }

        .mt-login a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
            margin-left: 4px;
        }

        .mt-login a:hover {
            text-decoration: underline;
        }

        .mt-support {
            margin-top: 20px;
            padding: 13px 15px;
            border-radius: 11px;
            background: #f8fafc;
            border: 1px solid #e8edf4;
            text-align: center;
        }

        .mt-support-title {
            font-size: 10px;
            color: #94a3b8;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }

        .mt-support-details {
            margin-top: 5px;
            display: flex;
            justify-content: center;
            gap: 18px;
            flex-wrap: wrap;
            font-size: 11px;
            color: #475569;
        }

        .mt-error {
            margin-top: 5px;
            color: #dc2626;
            font-size: 11px;
        }

        .mt-session {
            margin-bottom: 20px;
        }

        @media (max-width: 900px) {
            .mt-register-page {
                padding: 20px 14px;
                align-items: flex-start;
            }

            .mt-register-shell {
                grid-template-columns: 1fr;
                max-width: 620px;
            }

            .mt-brand-panel {
                padding: 30px;
            }

            .mt-logo {
                margin-bottom: 35px;
            }

            .mt-brand-title {
                font-size: 30px;
            }

            .mt-feature-list {
                margin-top: 25px;
            }

            .mt-brand-footer {
                margin-top: 30px;
            }

            .mt-form-panel {
                padding: 34px 28px;
            }
        }

        @media (max-width: 520px) {
            .mt-two-columns {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .mt-form-panel {
                padding: 30px 20px;
            }

            .mt-form-title {
                font-size: 26px;
            }
        }
    </style>


    <div class="mt-register-page">

        <div class="mt-register-shell">

            {{-- LEFT BRANDING --}}
            <section class="mt-brand-panel">

                <div class="mt-brand-content">

                    <div class="mt-logo">
                        <div class="mt-logo-mark">M</div>

                        <div>
                            <div class="mt-logo-name">
                                Malav Technologies
                            </div>

                            <div class="mt-logo-sub">
                                Smart Library Management Platform
                            </div>
                        </div>
                    </div>


                    <div class="mt-badge">
                        ✦ &nbsp; Next-Generation Library ERP
                    </div>

                    <h2 class="mt-brand-title">
                        Run your library<br>
                        <span style="color:#bfdbfe;">smarter.</span>
                    </h2>

                    <p class="mt-brand-description">
                        One powerful platform to manage students, memberships,
                        attendance, payments, examinations and everyday library
                        operations with ease.
                    </p>


                    <div class="mt-feature-list">

                        <div class="mt-feature">
                            <div class="mt-feature-icon">✓</div>
                            <span>Complete Library Management</span>
                        </div>

                        <div class="mt-feature">
                            <div class="mt-feature-icon">✓</div>
                            <span>Premium Online Examination System</span>
                        </div>

                        <div class="mt-feature">
                            <div class="mt-feature-icon">✓</div>
                            <span>Secure Multi-Library Architecture</span>
                        </div>

                        <div class="mt-feature">
                            <div class="mt-feature-icon">✓</div>
                            <span>Simple, Fast & Modern Dashboard</span>
                        </div>

                    </div>

                </div>


                <div class="mt-brand-footer">
                    © {{ date('Y') }} Malav Technologies · All rights reserved.
                </div>

            </section>


            {{-- RIGHT REGISTRATION FORM --}}
            <section class="mt-form-panel">

                <div class="mt-form-header">

                    <div class="mt-form-label-small">
                        Get Started
                    </div>

                    <h1 class="mt-form-title">
                        Create your library account
                    </h1>

                    <p class="mt-form-description">
                        Register your library and start managing your operations
                        from one powerful platform.
                    </p>

                </div>


                <x-auth-session-status
                    class="mt-session"
                    :status="session('status')"
                />


                <form
                    method="POST"
                    action="{{ route('register.store') }}"
                    class="mt-form"
                >
                    @csrf


                    {{-- Library --}}
                    <div class="mt-field">
                        <label for="library_name">
                            Library Name
                        </label>

                        <input
                            id="library_name"
                            name="library_name"
                            type="text"
                            value="{{ old('library_name') }}"
                            class="mt-input"
                            placeholder="Enter your library name"
                            required
                            autofocus
                            autocomplete="organization"
                        >

                        @error('library_name')
                            <div class="mt-error">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Owner Name --}}
                    <div class="mt-field">
                        <label for="name">
                            Your Name
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            class="mt-input"
                            placeholder="Enter your full name"
                            required
                            autocomplete="name"
                        >

                        @error('name')
                            <div class="mt-error">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Email --}}
                    <div class="mt-field">
                        <label for="email">
                            Email Address
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            class="mt-input"
                            placeholder="you@example.com"
                            required
                            autocomplete="email"
                        >

                        @error('email')
                            <div class="mt-error">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Passwords --}}
                    <div class="mt-two-columns">

                        <div class="mt-field">
                            <label for="password">
                                Password
                            </label>

                            <div class="mt-password-wrap">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="mt-input"
                                    placeholder="Create password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="mt-password-toggle"
                                    onclick="togglePassword('password', this)"
                                >
                                    Show
                                </button>
                            </div>

                            @error('password')
                                <div class="mt-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mt-field">
                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <div class="mt-password-wrap">
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    class="mt-input"
                                    placeholder="Repeat password"
                                    required
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    class="mt-password-toggle"
                                    onclick="togglePassword('password_confirmation', this)"
                                >
                                    Show
                                </button>
                            </div>
                        </div>

                    </div>


                    <button
                        type="submit"
                        class="mt-submit"
                        data-test="register-user-button"
                    >
                        Create Library Account
                    </button>

                </form>


                {{-- Login --}}
                <div class="mt-login">

                    Already have an account?

                    <a
                        href="{{ route('login') }}"
                        wire:navigate
                    >
                        Log in
                    </a>

                </div>


                {{-- Support --}}
                <div class="mt-support">

                    <div class="mt-support-title">
                        Need Help?
                    </div>

                    <div class="mt-support-details">
                        <span>📞 +91 95098 27100</span>
                        <span>✉ Info@malavtechnologies.com</span>
                    </div>

                </div>

            </section>

        </div>

    </div>


    <script>
        function togglePassword(id, button) {
            const input = document.getElementById(id);

            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = 'Hide';
            } else {
                input.type = 'password';
                button.textContent = 'Show';
            }
        }
    </script>

</x-layouts::auth>