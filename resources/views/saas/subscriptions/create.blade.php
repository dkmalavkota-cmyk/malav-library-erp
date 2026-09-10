<x-layouts.saas :title="__('Create Subscription')">

    <style>
        .subscription-create {
            max-width: 1180px;
            margin: 0 auto;
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
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #f5f7fb;
            font-size: 29px;
            line-height: 1.15;
            font-weight: 780;
            letter-spacing: -.035em;
        }

        .page-description {
            margin: 8px 0 0;
            color: #7f8da2;
            font-size: 13px;
            line-height: 1.6;
            max-width: 700px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 38px;
            padding: 0 14px;
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 10px;
            background: rgba(255,255,255,.035);
            color: #aebbd0;
            font-size: 11px;
            font-weight: 700;
            text-decoration: none;
        }

        .back-button:hover {
            background: rgba(255,255,255,.06);
            color: #f1f5f9;
        }

        .form-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.55fr) minmax(300px, .8fr);
            gap: 18px;
            align-items: start;
        }

        .panel {
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 18px;
            background:
                linear-gradient(145deg, rgba(255,255,255,.045), rgba(255,255,255,.015)),
                rgba(9,15,27,.74);
            box-shadow: 0 18px 55px rgba(0,0,0,.14);
            overflow: hidden;
        }

        .panel-header {
            padding: 19px 21px;
            border-bottom: 1px solid rgba(255,255,255,.055);
        }

        .panel-title {
            margin: 0;
            color: #e8edf5;
            font-size: 14px;
            font-weight: 760;
        }

        .panel-subtitle {
            margin: 5px 0 0;
            color: #69788e;
            font-size: 10px;
            line-height: 1.5;
        }

        .panel-body {
            padding: 21px;
        }

        .field-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 17px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field-label {
            display: block;
            margin: 0 0 8px;
            color: #aeb9ca;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .03em;
        }

        .required {
            color: #d5dce7;
        }

        .field-control {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 11px;
            outline: none;
            background: rgba(255,255,255,.035);
            color: #dce4ef;
            font-size: 12px;
            transition: border-color .18s, background .18s, box-shadow .18s;
        }

        .field-control:focus {
            border-color: rgba(255,255,255,.18);
            background: rgba(255,255,255,.05);
            box-shadow: 0 0 0 3px rgba(255,255,255,.025);
        }

        select.field-control option {
            background: #111827;
            color: #e5e7eb;
        }

        textarea.field-control {
            height: 105px;
            padding: 12px;
            resize: vertical;
        }

        .error {
            margin-top: 6px;
            color: #ff9d9d;
            font-size: 10px;
        }

        .cycle-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 10px;
        }

        .cycle-option {
            position: relative;
        }

        .cycle-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .cycle-card {
            display: block;
            padding: 13px 14px;
            border: 1px solid rgba(255,255,255,.075);
            border-radius: 12px;
            background: rgba(255,255,255,.025);
            cursor: pointer;
            transition: .18s ease;
        }

        .cycle-card:hover {
            background: rgba(255,255,255,.045);
            border-color: rgba(255,255,255,.13);
        }

        .cycle-option input:checked + .cycle-card {
            border-color: rgba(255,255,255,.22);
            background: rgba(255,255,255,.07);
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.035);
        }

        .cycle-name {
            color: #e4eaf3;
            font-size: 12px;
            font-weight: 760;
        }

        .cycle-description {
            margin-top: 4px;
            color: #6f7e93;
            font-size: 9px;
        }

        .plan-preview {
            min-height: 310px;
        }

        .selected-plan {
            padding: 21px;
        }

        .preview-label {
            color: #69788e;
            font-size: 9px;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .preview-plan-name {
            margin-top: 9px;
            color: #f2f5fa;
            font-size: 22px;
            font-weight: 780;
            letter-spacing: -.025em;
        }

        .price-box {
            margin-top: 20px;
            padding: 17px;
            border: 1px solid rgba(255,255,255,.065);
            border-radius: 14px;
            background: rgba(255,255,255,.025);
        }

        .price-label {
            color: #6f7e93;
            font-size: 9px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .price {
            margin-top: 7px;
            color: #f4f7fb;
            font-size: 28px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -.04em;
        }

        .price-period {
            color: #7d8ba0;
            font-size: 10px;
            font-weight: 600;
        }

        .preview-meta {
            display: flex;
            flex-direction: column;
            gap: 9px;
            margin-top: 17px;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            color: #7c8a9e;
            font-size: 10px;
        }

        .meta-row strong {
            color: #cbd5e1;
            font-weight: 700;
        }

        .date-preview {
            margin-top: 17px;
            padding: 13px;
            border: 1px solid rgba(255,255,255,.06);
            border-radius: 12px;
            background: rgba(255,255,255,.02);
        }

        .date-preview-label {
            color: #69788e;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: .08em;
            font-weight: 750;
        }

        .date-preview-value {
            margin-top: 6px;
            color: #dce5ef;
            font-size: 12px;
            font-weight: 700;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding-top: 3px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 40px;
            padding: 0 17px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 750;
            cursor: pointer;
            text-decoration: none;
        }

        .button-secondary {
            border: 1px solid rgba(255,255,255,.07);
            background: rgba(255,255,255,.035);
            color: #aebbd0;
        }

        .button-primary {
            border: 1px solid rgba(255,255,255,.12);
            background: #e7ebf1;
            color: #101827;
            box-shadow: 0 8px 25px rgba(0,0,0,.16);
        }

        .button-primary:hover {
            background: #f3f5f8;
        }

        .form-error {
            padding: 12px 14px;
            border: 1px solid rgba(255,120,120,.14);
            border-radius: 11px;
            background: rgba(255,90,90,.055);
            color: #ffaaaa;
            font-size: 11px;
        }

        @media (max-width: 900px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 620px) {
            .field-grid,
            .cycle-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }

            .page-title {
                font-size: 25px;
            }

            .actions {
                flex-direction: column-reverse;
            }

            .button {
                width: 100%;
            }
        }
    </style>

    <div class="subscription-create">

        <div class="page-header">
            <div>
                <p class="eyebrow">Billing Management</p>

                <h1 class="page-title">
                    Create Subscription
                </h1>

                <p class="page-description">
                    Activate a plan for a library and define its billing period, start date and subscription status.
                </p>
            </div>

            <a href="{{ route('saas.subscriptions.index') }}" class="back-button">
                ← Back to Subscriptions
            </a>
        </div>

        @if($errors->any())
            <div class="form-error">
                Please check the form and correct the highlighted fields.
            </div>
        @endif

        <form method="POST" action="{{ route('saas.subscriptions.store') }}">
            @csrf

            <div class="form-grid">

                <section class="panel">

                    <div class="panel-header">
                        <h2 class="panel-title">Subscription Details</h2>

                        <p class="panel-subtitle">
                            Select the customer, plan and billing configuration.
                        </p>
                    </div>

                    <div class="panel-body">

                        <div class="field-grid">

                            <div class="field full">
                                <label class="field-label">
                                    Library <span class="required">*</span>
                                </label>

                                <select
                                    name="library_id"
                                    id="library_id"
                                    class="field-control"
                                    required
                                >
                                    <option value="">Select library</option>

                                    @foreach($libraries as $library)
                                        <option
                                            value="{{ $library->id }}"
                                            @selected(old('library_id') == $library->id)
                                        >
                                            {{ $library->name }} — {{ $library->code }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('library_id')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field full">
                                <label class="field-label">
                                    Plan <span class="required">*</span>
                                </label>

                                <select
                                    name="plan_id"
                                    id="plan_id"
                                    class="field-control"
                                    required
                                >
                                    <option value="">Select plan</option>

                                    @foreach($plans as $plan)
                                        <option
                                            value="{{ $plan->id }}"
                                            data-monthly="{{ $plan->monthly_price }}"
                                            data-yearly="{{ $plan->yearly_price }}"
                                            data-limit="{{ $plan->student_limit ?? 'Unlimited' }}"
                                            @selected(old('plan_id') == $plan->id)
                                        >
                                            {{ $plan->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('plan_id')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="field-label">
                                    Billing Cycle <span class="required">*</span>
                                </label>

                                <div class="cycle-grid">

                                    <div class="cycle-option">
                                        <input
                                            type="radio"
                                            name="billing_cycle"
                                            id="billing_monthly"
                                            value="monthly"
                                            @checked(old('billing_cycle', 'monthly') === 'monthly')
                                        >

                                        <label for="billing_monthly" class="cycle-card">
                                            <div class="cycle-name">Monthly</div>
                                            <div class="cycle-description">Renews every month</div>
                                        </label>
                                    </div>

                                    <div class="cycle-option">
                                        <input
                                            type="radio"
                                            name="billing_cycle"
                                            id="billing_yearly"
                                            value="yearly"
                                            @checked(old('billing_cycle') === 'yearly')
                                        >

                                        <label for="billing_yearly" class="cycle-card">
                                            <div class="cycle-name">Yearly</div>
                                            <div class="cycle-description">Renews every year</div>
                                        </label>
                                    </div>

                                </div>

                                @error('billing_cycle')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="field-label">
                                    Start Date <span class="required">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="starts_at"
                                    id="starts_at"
                                    class="field-control"
                                    value="{{ old('starts_at', now()->format('Y-m-d')) }}"
                                    required
                                >

                                @error('starts_at')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="field-label">
                                    Status <span class="required">*</span>
                                </label>

                                <select
                                    name="status"
                                    class="field-control"
                                    required
                                >
                                    <option
                                        value="active"
                                        @selected(old('status', 'active') === 'active')
                                    >
                                        Active
                                    </option>

                                    <option
                                        value="trial"
                                        @selected(old('status') === 'trial')
                                    >
                                        Trial
                                    </option>
                                </select>

                                @error('status')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field">
                                <label class="field-label">
                                    Notes
                                </label>

                                <textarea
                                    name="notes"
                                    class="field-control"
                                    placeholder="Optional billing or customer notes..."
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>
                </section>

                <aside class="panel plan-preview">

                    <div class="panel-header">
                        <h2 class="panel-title">Plan Preview</h2>

                        <p class="panel-subtitle">
                            Pricing and subscription period preview.
                        </p>
                    </div>

                    <div class="selected-plan">

                        <div class="preview-label">
                            Selected Plan
                        </div>

                        <div class="preview-plan-name" id="preview_plan_name">
                            Select a plan
                        </div>

                        <div class="price-box">
                            <div class="price-label">
                                Subscription Price
                            </div>

                            <div class="price">
                                <span id="preview_price">₹0.00</span>
                                <span class="price-period" id="preview_period">
                                    / month
                                </span>
                            </div>
                        </div>

                        <div class="preview-meta">

                            <div class="meta-row">
                                <span>Billing Cycle</span>
                                <strong id="preview_cycle">Monthly</strong>
                            </div>

                            <div class="meta-row">
                                <span>Student Limit</span>
                                <strong id="preview_limit">—</strong>
                            </div>

                        </div>

                        <div class="date-preview">
                            <div class="date-preview-label">
                                Subscription Expiry
                            </div>

                            <div class="date-preview-value" id="preview_expiry">
                                Select start date
                            </div>
                        </div>

                    </div>

                </aside>

            </div>

            <div class="actions">

                <a
                    href="{{ route('saas.subscriptions.index') }}"
                    class="button button-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="button button-primary"
                >
                    Create Subscription
                    <span>→</span>
                </button>

            </div>

        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const planSelect = document.getElementById('plan_id');
            const startDate = document.getElementById('starts_at');

            const monthlyRadio = document.getElementById('billing_monthly');
            const yearlyRadio = document.getElementById('billing_yearly');

            const planName = document.getElementById('preview_plan_name');
            const price = document.getElementById('preview_price');
            const period = document.getElementById('preview_period');
            const cycle = document.getElementById('preview_cycle');
            const limit = document.getElementById('preview_limit');
            const expiry = document.getElementById('preview_expiry');

            function formatPrice(value) {
                return '₹' + Number(value || 0).toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function formatDate(date) {
                return date.toLocaleDateString('en-IN', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
            }

            function updatePreview() {

                const option = planSelect.options[planSelect.selectedIndex];

                if (!option || !option.value) {
                    planName.textContent = 'Select a plan';
                    price.textContent = '₹0.00';
                    period.textContent = '/ month';
                    limit.textContent = '—';
                } else {

                    const isYearly = yearlyRadio.checked;

                    planName.textContent = option.textContent.trim();

                    price.textContent = formatPrice(
                        isYearly
                            ? option.dataset.yearly
                            : option.dataset.monthly
                    );

                    period.textContent = isYearly
                        ? '/ year'
                        : '/ month';

                    limit.textContent = option.dataset.limit || 'Unlimited';
                }

                const isYearly = yearlyRadio.checked;

                cycle.textContent = isYearly
                    ? 'Yearly'
                    : 'Monthly';

                updateExpiry();
            }

            function updateExpiry() {

                if (!startDate.value) {
                    expiry.textContent = 'Select start date';
                    return;
                }

                const date = new Date(startDate.value + 'T00:00:00');

                if (yearlyRadio.checked) {
                    date.setFullYear(date.getFullYear() + 1);
                } else {
                    date.setMonth(date.getMonth() + 1);
                }

                expiry.textContent = formatDate(date);
            }

            planSelect.addEventListener('change', updatePreview);
            startDate.addEventListener('change', updateExpiry);

            monthlyRadio.addEventListener('change', updatePreview);
            yearlyRadio.addEventListener('change', updatePreview);

            updatePreview();
        });
    </script>

</x-layouts.saas>