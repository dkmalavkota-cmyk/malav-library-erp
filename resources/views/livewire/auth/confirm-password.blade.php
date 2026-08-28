<x-layouts::auth :title="__('Confirm password')">

    <style>
        /* =========================================================
           PREMIUM CONFIRM PASSWORD PAGE
           ========================================================= */

        .confirm-page {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background glow */
        .confirm-page::before {
            content: "";
            position: absolute;
            width: 520px;
            height: 520px;
            top: -250px;
            left: -220px;
            border-radius: 50%;
            border: 1px solid rgba(245, 180, 0, 0.14);
            box-shadow:
                0 0 0 55px rgba(245, 180, 0, 0.025),
                0 0 0 110px rgba(245, 180, 0, 0.018);
            pointer-events: none;
        }

        .confirm-page::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            right: -250px;
            bottom: -260px;
            border-radius: 50%;
            border: 1px solid rgba(245, 180, 0, 0.13);
            box-shadow:
                0 0 0 55px rgba(245, 180, 0, 0.025),
                0 0 0 110px rgba(245, 180, 0, 0.018);
            pointer-events: none;
        }

        .confirm-card {
            width: 100%;
            max-width: 520px;
            position: relative;
            z-index: 2;

            background:
                linear-gradient(
                    145deg,
                    rgba(24, 25, 29, 0.98),
                    rgba(12, 13, 16, 0.98)
                );

            border: 1px solid rgba(255, 255, 255, 0.10);
            border-radius: 22px;

            box-shadow:
                0 30px 80px rgba(0, 0, 0, 0.55),
                0 0 45px rgba(245, 180, 0, 0.035);

            overflow: hidden;
        }

        /* Gold top accent */
        .confirm-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 15%;
            right: 15%;
            height: 1px;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(245, 180, 0, 0.85),
                transparent
            );
        }

        .confirm-header {
            padding: 30px 34px 25px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .lock-wrapper {
            width: 62px;
            height: 62px;
            margin: 0 auto 18px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 17px;

            background:
                linear-gradient(
                    145deg,
                    rgba(245, 180, 0, 0.12),
                    rgba(245, 180, 0, 0.035)
                );

            border: 1px solid rgba(245, 180, 0, 0.42);

            box-shadow:
                0 0 25px rgba(245, 180, 0, 0.08),
                inset 0 0 20px rgba(245, 180, 0, 0.035);
        }

        .lock-icon {
            width: 27px;
            height: 27px;
            color: #f5b400;
        }

        .confirm-title {
            margin: 0;
            color: #ffffff;
            font-size: 26px;
            line-height: 1.2;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .confirm-description {
            margin: 9px auto 0;
            max-width: 390px;
            color: #8f96a3;
            font-size: 14px;
            line-height: 1.6;
        }

        .confirm-body {
            padding: 28px 34px 30px;
        }

        /* =========================================================
           PASSKEY
           ========================================================= */

        .passkey-area {
            width: 100%;
        }

        .passkey-area button {
            width: 100% !important;
            min-height: 48px !important;

            border-radius: 11px !important;

            background:
                linear-gradient(
                    180deg,
                    rgba(255, 255, 255, 0.075),
                    rgba(255, 255, 255, 0.045)
                ) !important;

            border: 1px solid rgba(245, 180, 0, 0.28) !important;

            color: #f4f4f5 !important;

            font-weight: 600 !important;

            transition:
                background 0.2s ease,
                border-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease !important;
        }

        .passkey-area button:hover {
            background:
                linear-gradient(
                    180deg,
                    rgba(245, 180, 0, 0.13),
                    rgba(245, 180, 0, 0.055)
                ) !important;

            border-color: rgba(245, 180, 0, 0.55) !important;

            box-shadow:
                0 8px 25px rgba(245, 180, 0, 0.08) !important;

            transform: translateY(-1px);
        }

        /* =========================================================
           SEPARATOR
           ========================================================= */

        .confirm-separator {
            display: flex;
            align-items: center;
            gap: 14px;
            margin: 23px 0;
        }

        .confirm-separator-line {
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.09);
        }

        .confirm-separator-text {
            color: #737985;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* =========================================================
           PASSWORD FORM
           ========================================================= */

        .password-form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .password-form label {
            color: #e8e9ec !important;
        }

        .password-form input {
            min-height: 48px !important;
            border-radius: 11px !important;

            background: rgba(255, 255, 255, 0.045) !important;

            border: 1px solid rgba(255, 255, 255, 0.11) !important;

            color: #ffffff !important;

            box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.025);

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease !important;
        }

        .password-form input:focus {
            background: rgba(255, 255, 255, 0.06) !important;

            border-color: rgba(245, 180, 0, 0.62) !important;

            box-shadow:
                0 0 0 3px rgba(245, 180, 0, 0.08),
                0 0 22px rgba(245, 180, 0, 0.035) !important;

            outline: none !important;
        }

        .password-form input::placeholder {
            color: #686e79 !important;
        }

        /* Confirm button */
        .confirm-button {
            width: 100% !important;
            min-height: 50px !important;

            border-radius: 11px !important;

            background:
                linear-gradient(
                    135deg,
                    #f7c51a 0%,
                    #f5b400 55%,
                    #e6a500 100%
                ) !important;

            color: #090909 !important;

            border: 1px solid rgba(255, 214, 73, 0.65) !important;

            font-size: 14px !important;
            font-weight: 700 !important;

            box-shadow:
                0 10px 28px rgba(245, 180, 0, 0.16),
                inset 0 1px 0 rgba(255, 255, 255, 0.22) !important;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                filter 0.2s ease !important;
        }

        .confirm-button:hover {
            transform: translateY(-1px);

            filter: brightness(1.05);

            box-shadow:
                0 14px 34px rgba(245, 180, 0, 0.23),
                inset 0 1px 0 rgba(255, 255, 255, 0.25) !important;
        }

        .confirm-button:active {
            transform: translateY(0);
        }

        /* =========================================================
           FOOTER
           ========================================================= */

        .confirm-footer {
            min-height: 56px;
            padding: 15px 25px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;

            border-top: 1px solid rgba(255, 255, 255, 0.07);

            color: #6f7682;
            font-size: 12px;
        }

        .security-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;

            background: #10d98b;

            box-shadow:
                0 0 10px rgba(16, 217, 139, 0.45);
        }

        /* =========================================================
           MOBILE
           ========================================================= */

        @media (max-width: 640px) {

            .confirm-page {
                padding: 24px 14px;
                align-items: center;
            }

            .confirm-card {
                max-width: 100%;
                border-radius: 18px;
            }

            .confirm-header {
                padding: 25px 22px 21px;
            }

            .confirm-body {
                padding: 23px 22px 25px;
            }

            .lock-wrapper {
                width: 56px;
                height: 56px;
                border-radius: 15px;
                margin-bottom: 15px;
            }

            .lock-icon {
                width: 24px;
                height: 24px;
            }

            .confirm-title {
                font-size: 23px;
            }

            .confirm-description {
                font-size: 13px;
            }

            .confirm-separator {
                margin: 20px 0;
            }

            .confirm-footer {
                font-size: 11px;
            }
        }
    </style>


    <div class="confirm-page">

        <div class="confirm-card">

            {{-- =====================================================
                 HEADER
                 ===================================================== --}}
            <div class="confirm-header">

                <div class="lock-wrapper">

                    <svg
                        class="lock-icon"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <rect
                            x="4"
                            y="10"
                            width="16"
                            height="10"
                            rx="2"
                        />

                        <path d="M8 10V7a4 4 0 0 1 8 0v3" />

                        <path d="M12 14v2" />
                    </svg>

                </div>

                <h1 class="confirm-title">
                    Confirm your identity
                </h1>

                <p class="confirm-description">
                    This is a secure area. Please confirm your password
                    before continuing.
                </p>

            </div>


            {{-- =====================================================
                 BODY
                 ===================================================== --}}
            <div class="confirm-body">

                {{-- Passkey --}}
                <div class="passkey-area">

                    <x-passkey-verify
                        options-route="passkey.confirm-options"
                        submit-route="passkey.confirm"
                        :label="__('Confirm with passkey')"
                        :loading-label="__('Confirming...')"
                        :separator="__('Or confirm with password')"
                    />

                </div>


                {{-- Password separator --}}
                


                {{-- Password --}}
                <form
                    method="POST"
                    action="{{ route('password.confirm.store') }}"
                    class="password-form"
                >

                    @csrf

                    <flux:input
                        name="password"
                        :label="__('Password')"
                        type="password"
                        required
                        autocomplete="current-password"
                        :placeholder="__('Enter your password')"
                        viewable
                    />


                    <flux:button
                        variant="primary"
                        type="submit"
                        class="confirm-button"
                        data-test="confirm-password-button"
                    >
                        Confirm & Continue
                    </flux:button>

                </form>

            </div>


            {{-- =====================================================
                 SECURITY FOOTER
                 ===================================================== --}}
            <div class="confirm-footer">

                <span class="security-dot"></span>

                <span>
                    Your account security is protected.
                </span>

            </div>

        </div>

    </div>

</x-layouts::auth>