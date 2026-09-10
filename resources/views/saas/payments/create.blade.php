<x-layouts.saas :title="__('Record Payment')">

    <style>
        .payment-create-page {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }

        .eyebrow {
            margin: 0 0 7px;
            color: #8493aa;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-size: 30px;
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .page-description {
            margin: 8px 0 0;
            color: #8493aa;
            font-size: 13px;
            line-height: 1.6;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 11px;
            color: #d9e1ec;
            background: rgba(255,255,255,.035);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            transition: .2s ease;
        }

        .back-button:hover {
            background: rgba(255,255,255,.07);
            border-color: rgba(255,255,255,.16);
        }

        .form-card {
            width: 100%;
            max-width: 950px;
            padding: 28px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 20px;
            background:
                linear-gradient(
                    145deg,
                    rgba(255,255,255,.045),
                    rgba(255,255,255,.018)
                );
            box-shadow: 0 20px 60px rgba(0,0,0,.18);
        }

        .form-section-title {
            margin: 0 0 5px;
            font-size: 16px;
            font-weight: 800;
        }

        .form-section-description {
            margin: 0 0 24px;
            color: #8493aa;
            font-size: 12px;
            line-height: 1.6;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #d9e1ec;
            font-size: 12px;
            font-weight: 700;
        }

        .required {
            color: #fb7185;
        }

        .form-control {
            width: 100%;
            min-height: 46px;
            box-sizing: border-box;
            padding: 11px 13px;
            border: 1px solid rgba(255,255,255,.10);
            border-radius: 11px;
            outline: none;
            color: #e8edf5;
            background: rgba(255,255,255,.035);
            font: inherit;
            font-size: 13px;
            transition: .2s ease;
        }

        .form-control:focus {
            border-color: rgba(139,92,246,.65);
            box-shadow: 0 0 0 3px rgba(139,92,246,.10);
        }

        .form-control option {
            color: #111827;
            background: #ffffff;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .field-help {
            display: block;
            margin-top: 7px;
            color: #6f7e94;
            font-size: 11px;
            line-height: 1.5;
        }

        .error-box {
            padding: 15px 17px;
            border: 1px solid rgba(239,68,68,.28);
            border-radius: 13px;
            background: rgba(239,68,68,.07);
            color: #fecaca;
            font-size: 12px;
        }

        .error-box strong {
            color: #fda4af;
        }

        .error-box ul {
            margin: 8px 0 0 18px;
            padding: 0;
        }

        .error-box li + li {
            margin-top: 4px;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 11px;
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid rgba(255,255,255,.07);
        }

        .cancel-button,
        .submit-button {
            min-height: 44px;
            padding: 0 18px;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 750;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .cancel-button {
            border: 1px solid rgba(255,255,255,.09);
            color: #cbd5e1;
            background: rgba(255,255,255,.035);
        }

        .submit-button {
            border: 1px solid rgba(139,92,246,.35);
            color: #ffffff;
            background: rgba(139,92,246,.78);
            box-shadow: 0 10px 25px rgba(139,92,246,.15);
        }

        .submit-button:hover {
            background: rgba(139,92,246,.92);
        }

        @media (max-width: 760px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .form-card {
                padding: 20px;
            }

            .page-title {
                font-size: 25px;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .cancel-button,
            .submit-button {
                width: 100%;
            }
        }
    </style>


    <div class="payment-create-page">

        <div class="page-header">

            <div>
                <p class="eyebrow">Billing Management</p>

                <h1 class="page-title">
                    Record Payment
                </h1>

                <p class="page-description">
                    Record a SaaS payment against an existing customer subscription.
                </p>
            </div>

            <a
                href="{{ route('saas.payments.index') }}"
                class="back-button"
            >
                ← Back to Payments
            </a>

        </div>


        @if ($errors->any())
            <div class="error-box">

                <strong>Please fix the following:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif


        <div class="form-card">

            <h2 class="form-section-title">
                Payment Details
            </h2>

            <p class="form-section-description">
                Select the customer subscription first. The subscription amount will be suggested automatically.
            </p>


            <form
                method="POST"
                action="{{ route('saas.payments.store') }}"
            >
                @csrf

                <div class="form-grid">

                    <div class="form-group full">

                        <label
                            for="subscription_id"
                            class="form-label"
                        >
                            Customer Subscription
                            <span class="required">*</span>
                        </label>

                        <select
                            id="subscription_id"
                            name="subscription_id"
                            class="form-control"
                            required
                        >
                            <option value="">
                                Select customer subscription
                            </option>

                            @foreach ($libraries as $library)

                                @foreach ($library->subscriptions as $subscription)

                                    @php
                                        $planName = $subscription->plan?->name
                                            ?? $subscription->plan_name
                                            ?? 'Plan';

                                        $cycle = ucfirst(
                                            $subscription->billing_cycle ?? 'monthly'
                                        );

                                        $amount = (float) ($subscription->amount ?? 0);
                                    @endphp

                                    <option
                                        value="{{ $subscription->id }}"
                                        data-amount="{{ number_format($amount, 2, '.', '') }}"
                                        @selected(old('subscription_id') == $subscription->id)
                                    >
                                        {{ $library->name }}
                                        — {{ $planName }}
                                        — {{ $cycle }}
                                        — ₹{{ number_format($amount, 2) }}
                                        — {{ ucfirst($subscription->status) }}
                                    </option>

                                @endforeach

                            @endforeach

                        </select>

                        <span class="field-help">
                            Customer → plan → billing cycle → subscription status.
                        </span>

                    </div>


                    <div class="form-group">

                        <label
                            for="amount"
                            class="form-label"
                        >
                            Amount
                            <span class="required">*</span>
                        </label>

                        <input
                            type="number"
                            id="amount"
                            name="amount"
                            class="form-control"
                            value="{{ old('amount') }}"
                            min="0.01"
                            max="9999999999.99"
                            step="0.01"
                            placeholder="e.g. 799"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label
                            for="currency"
                            class="form-label"
                        >
                            Currency
                            <span class="required">*</span>
                        </label>

                        <select
                            id="currency"
                            name="currency"
                            class="form-control"
                            required
                        >
                            <option
                                value="INR"
                                @selected(old('currency', 'INR') === 'INR')
                            >
                                INR — Indian Rupee
                            </option>

                            <option
                                value="USD"
                                @selected(old('currency') === 'USD')
                            >
                                USD — US Dollar
                            </option>

                            <option
                                value="EUR"
                                @selected(old('currency') === 'EUR')
                            >
                                EUR — Euro
                            </option>

                            <option
                                value="GBP"
                                @selected(old('currency') === 'GBP')
                            >
                                GBP — British Pound
                            </option>
                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            for="payment_method"
                            class="form-label"
                        >
                            Payment Method
                            <span class="required">*</span>
                        </label>

                        <select
                            id="payment_method"
                            name="payment_method"
                            class="form-control"
                            required
                        >
                            <option value="">
                                Select payment method
                            </option>

                            <option
                                value="upi"
                                @selected(old('payment_method') === 'upi')
                            >
                                UPI
                            </option>

                            <option
                                value="bank_transfer"
                                @selected(old('payment_method') === 'bank_transfer')
                            >
                                Bank Transfer
                            </option>

                            <option
                                value="card"
                                @selected(old('payment_method') === 'card')
                            >
                                Card
                            </option>

                            <option
                                value="cash"
                                @selected(old('payment_method') === 'cash')
                            >
                                Cash
                            </option>

                            <option
                                value="cheque"
                                @selected(old('payment_method') === 'cheque')
                            >
                                Cheque
                            </option>

                            <option
                                value="other"
                                @selected(old('payment_method') === 'other')
                            >
                                Other
                            </option>
                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            for="status"
                            class="form-label"
                        >
                            Payment Status
                            <span class="required">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="form-control"
                            required
                        >
                            <option
                                value="paid"
                                @selected(old('status', 'paid') === 'paid')
                            >
                                Paid
                            </option>

                            <option
                                value="pending"
                                @selected(old('status') === 'pending')
                            >
                                Pending
                            </option>

                            <option
                                value="failed"
                                @selected(old('status') === 'failed')
                            >
                                Failed
                            </option>

                            <option
                                value="refunded"
                                @selected(old('status') === 'refunded')
                            >
                                Refunded
                            </option>
                        </select>

                    </div>


                    <div class="form-group">

                        <label
                            for="transaction_id"
                            class="form-label"
                        >
                            Transaction / Reference ID
                        </label>

                        <input
                            type="text"
                            id="transaction_id"
                            name="transaction_id"
                            class="form-control"
                            value="{{ old('transaction_id') }}"
                            maxlength="150"
                            placeholder="UPI / bank / payment reference"
                        >

                    </div>


                    <div class="form-group">

                        <label
                            for="paid_at"
                            class="form-label"
                        >
                            Paid At
                        </label>

                        <input
                            type="datetime-local"
                            id="paid_at"
                            name="paid_at"
                            class="form-control"
                            value="{{ old('paid_at') }}"
                        >

                        <span class="field-help">
                            For Paid status, leaving this blank records the current time.
                        </span>

                    </div>


                    <div class="form-group full">

                        <label
                            for="notes"
                            class="form-label"
                        >
                            Notes
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            class="form-control"
                            maxlength="5000"
                            placeholder="Optional payment notes..."
                        >{{ old('notes') }}</textarea>

                    </div>

                </div>


                <div class="form-footer">

                    <a
                        href="{{ route('saas.payments.index') }}"
                        class="cancel-button"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="submit-button"
                    >
                        Record Payment
                    </button>

                </div>

            </form>

        </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const subscription = document.getElementById('subscription_id');
            const amount = document.getElementById('amount');

            if (!subscription || !amount) {
                return;
            }

            subscription.addEventListener('change', function () {

                const option = this.options[this.selectedIndex];

                if (!option || !option.dataset.amount) {
                    return;
                }

                amount.value = option.dataset.amount;
            });

        });
    </script>

</x-layouts.saas>