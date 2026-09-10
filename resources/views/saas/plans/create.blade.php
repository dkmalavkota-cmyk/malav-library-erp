<x-layouts.saas>
    <style>
        .plan-form-page {
            min-height: 100vh;
            padding: 34px 38px 54px;
            background:
                radial-gradient(circle at 82% 0%, rgba(99,102,241,.09), transparent 360px),
                radial-gradient(circle at 8% 24%, rgba(59,130,246,.045), transparent 320px);
        }

        .plan-form-wrap {
            max-width: 1180px;
            margin: 0 auto;
        }

        .plan-form-top {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .plan-form-eyebrow {
            color: #818cf8;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .16em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .plan-form-title {
            margin: 0;
            color: #f8fafc;
            font-size: clamp(26px, 3vw, 34px);
            line-height: 1.05;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .plan-form-subtitle {
            margin: 9px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.65;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 13px;
            border: 1px solid rgba(148,163,184,.10);
            border-radius: 11px;
            color: #94a3b8;
            background: rgba(15,23,42,.42);
            text-decoration: none;
            font-size: 10px;
            font-weight: 800;
            transition: .18s ease;
        }

        .back-link:hover {
            color: #eef2ff;
            border-color: rgba(129,140,248,.20);
            background: rgba(99,102,241,.07);
        }

        .form-card {
            overflow: hidden;
            border: 1px solid rgba(148,163,184,.11);
            border-radius: 20px;
            background:
                radial-gradient(circle at 100% 0%, rgba(99,102,241,.055), transparent 300px),
                linear-gradient(145deg, rgba(15,23,42,.82), rgba(7,10,18,.90));
            box-shadow: 0 22px 65px rgba(0,0,0,.16), inset 0 1px rgba(255,255,255,.025);
        }

        .form-section {
            padding: 23px 24px;
            border-bottom: 1px solid rgba(148,163,184,.08);
        }

        .form-section:last-child {
            border-bottom: 0;
        }

        .section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
            margin-bottom: 18px;
        }

        .section-number {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            border: 1px solid rgba(129,140,248,.15);
            color: #a5b4fc;
            background: rgba(99,102,241,.07);
            font-size: 9px;
            font-weight: 900;
        }

        .section-title {
            color: #e2e8f0;
            font-size: 12px;
            font-weight: 850;
        }

        .section-note {
            margin-top: 2px;
            color: #475569;
            font-size: 9px;
        }

        .fields {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 15px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .required {
            color: #818cf8;
        }

        .field-input,
        .field-textarea {
            width: 100%;
            border: 1px solid rgba(148,163,184,.10);
            border-radius: 11px;
            outline: none;
            color: #e2e8f0;
            background: rgba(2,6,23,.48);
            font-size: 11px;
            font-weight: 650;
            transition: .18s ease;
            box-sizing: border-box;
        }

        .field-input {
            height: 43px;
            padding: 0 13px;
        }

        .field-textarea {
            min-height: 92px;
            padding: 12px 13px;
            resize: vertical;
            line-height: 1.55;
        }

        .field-input::placeholder,
        .field-textarea::placeholder {
            color: #334155;
        }

        .field-input:focus,
        .field-textarea:focus {
            border-color: rgba(129,140,248,.34);
            background: rgba(15,23,42,.58);
            box-shadow: 0 0 0 3px rgba(99,102,241,.06);
        }

        .field-help {
            margin-top: 6px;
            color: #475569;
            font-size: 9px;
            line-height: 1.5;
        }

        .error-box {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid rgba(248,113,113,.18);
            border-radius: 12px;
            background: rgba(239,68,68,.055);
            color: #fecaca;
            font-size: 10px;
            line-height: 1.6;
        }

        .error-box strong {
            display: block;
            margin-bottom: 3px;
            font-weight: 850;
        }

        .field-error {
            margin-top: 5px;
            color: #fca5a5;
            font-size: 9px;
        }

        .pricing-preview {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 14px;
        }

        .price-preview {
            padding: 13px 14px;
            border: 1px solid rgba(148,163,184,.08);
            border-radius: 12px;
            background: rgba(15,23,42,.32);
        }

        .preview-label {
            color: #475569;
            font-size: 8px;
            font-weight: 850;
            letter-spacing: .11em;
            text-transform: uppercase;
        }

        .preview-value {
            margin-top: 5px;
            color: #c7d2fe;
            font-size: 18px;
            font-weight: 850;
        }

        .feature-group {
            margin-bottom: 22px;
        }

        .feature-group:last-child {
            margin-bottom: 0;
        }

        .feature-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
            padding-bottom: 9px;
            border-bottom: 1px solid rgba(148,163,184,.07);
        }

        .feature-group-title {
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .04em;
        }

        .feature-group-label {
            color: #475569;
            font-size: 8px;
            font-weight: 750;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0,1fr));
            gap: 10px;
        }

        .feature-toggle {
            position: relative;
        }

        .feature-toggle input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .feature-label {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 57px;
            padding: 0 13px;
            border: 1px solid rgba(148,163,184,.09);
            border-radius: 13px;
            background: rgba(2,6,23,.34);
            cursor: pointer;
            transition: .18s ease;
        }

        .feature-label:hover {
            border-color: rgba(129,140,248,.18);
            background: rgba(99,102,241,.045);
        }

        .feature-check {
            width: 20px;
            height: 20px;
            flex: 0 0 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(148,163,184,.13);
            border-radius: 6px;
            color: transparent;
            background: rgba(15,23,42,.62);
            font-size: 11px;
            font-weight: 900;
        }

        .feature-toggle input:checked + .feature-label {
            border-color: rgba(129,140,248,.23);
            background: rgba(99,102,241,.075);
        }

        .feature-toggle input:checked + .feature-label .feature-check {
            color: #c7d2fe;
            border-color: rgba(129,140,248,.28);
            background: rgba(99,102,241,.15);
        }

        .feature-copy {
            min-width: 0;
        }

        .feature-name {
            display: block;
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 800;
        }

        .feature-desc {
            display: block;
            margin-top: 3px;
            color: #475569;
            font-size: 8px;
        }

        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 14px;
            border: 1px solid rgba(148,163,184,.09);
            border-radius: 13px;
            background: rgba(2,6,23,.34);
        }

        .status-copy strong {
            display: block;
            color: #cbd5e1;
            font-size: 10px;
            font-weight: 850;
        }

        .status-copy span {
            display: block;
            margin-top: 3px;
            color: #475569;
            font-size: 9px;
        }

        .switch {
            position: relative;
            width: 43px;
            height: 24px;
            flex: 0 0 43px;
        }

        .switch input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .switch-track {
            position: absolute;
            inset: 0;
            border-radius: 999px;
            border: 1px solid rgba(148,163,184,.13);
            background: #111827;
            cursor: pointer;
            transition: .18s ease;
        }

        .switch-track::after {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #64748b;
            transition: .18s ease;
        }

        .switch input:checked + .switch-track {
            border-color: rgba(129,140,248,.28);
            background: rgba(99,102,241,.20);
        }

        .switch input:checked + .switch-track::after {
            transform: translateX(19px);
            background: #a5b4fc;
        }

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            padding: 17px 24px;
            background: rgba(2,6,23,.25);
        }

        .btn {
            min-height: 41px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 0 15px;
            border-radius: 11px;
            font-size: 10px;
            font-weight: 850;
            text-decoration: none;
            cursor: pointer;
            transition: .18s ease;
        }

        .btn-secondary {
            border: 1px solid rgba(148,163,184,.10);
            color: #94a3b8;
            background: rgba(15,23,42,.38);
        }

        .btn-secondary:hover {
            color: #e2e8f0;
            border-color: rgba(148,163,184,.18);
        }

        .btn-primary {
            border: 1px solid rgba(129,140,248,.28);
            color: #eef2ff;
            background: linear-gradient(135deg, rgba(99,102,241,.28), rgba(79,70,229,.13));
            box-shadow: 0 10px 28px rgba(79,70,229,.10), inset 0 1px rgba(255,255,255,.04);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            border-color: rgba(129,140,248,.48);
            background: linear-gradient(135deg, rgba(99,102,241,.35), rgba(79,70,229,.17));
        }

        @media (max-width: 800px) {
            .plan-form-page { padding: 24px 16px 40px; }

            .plan-form-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .fields,
            .feature-grid,
            .pricing-preview {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }
        }

        @media (max-width: 500px) {
            .form-section { padding: 19px 16px; }
            .form-footer { padding: 15px 16px; }
            .form-footer .btn { flex: 1; }
        }
    </style>

    @php
        $coreFeatures = [
            'student_management_access' => [
                'name' => 'Students',
                'desc' => 'Student records and management',
            ],
            'membership_access' => [
                'name' => 'Memberships',
                'desc' => 'Membership creation and renewals',
            ],
            'seat_management_access' => [
                'name' => 'Seat Management',
                'desc' => 'Rooms, seats and seat assignments',
            ],
            'attendance_access' => [
                'name' => 'Attendance',
                'desc' => 'Attendance and kiosk / scan',
            ],
            'payment_access' => [
                'name' => 'Payments',
                'desc' => 'Library payment collection',
            ],
            'expense_access' => [
                'name' => 'Expenses',
                'desc' => 'Library expense management',
            ],
            'id_card_access' => [
                'name' => 'Student ID Cards',
                'desc' => 'Generate student ID cards',
            ],
            'reports_access' => [
                'name' => 'Reports',
                'desc' => 'Library management reports',
            ],
        ];

        $examFeatures = [
            'exam_access' => [
                'name' => 'Online Examination',
                'desc' => 'Online exam management',
            ],
            'question_bank_access' => [
                'name' => 'Question Bank',
                'desc' => 'Create and manage questions',
            ],
            'current_affairs_access' => [
                'name' => 'Current Affairs',
                'desc' => 'Current-affairs test module',
            ],
            'major_test_access' => [
                'name' => 'Major Tests',
                'desc' => 'Library-wide examinations',
            ],
            'assigned_test_access' => [
                'name' => 'Assigned Tests',
                'desc' => 'Tests for selected students',
            ],
            'public_exam_access' => [
                'name' => 'Public Exams',
                'desc' => 'External candidate exams',
            ],
            'advanced_reports_access' => [
                'name' => 'Advanced Reports',
                'desc' => 'Extended exam analytics',
            ],
        ];
    @endphp

    <div class="plan-form-page">
        <div class="plan-form-wrap">

            <div class="plan-form-top">
                <div>
                    <div class="plan-form-eyebrow">Billing / Plans</div>
                    <h1 class="plan-form-title">Create Subscription Plan</h1>
                    <p class="plan-form-subtitle">
                        Configure pricing, library ERP modules and examination features for a new SaaS plan.
                    </p>
                </div>

                <a href="{{ route('saas.plans.index') }}" class="back-link">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                    Back to Plans
                </a>
            </div>

            @if($errors->any())
                <div class="error-box">
                    <strong>Please fix the following:</strong>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('saas.plans.store') }}" class="form-card">
                @csrf

                <div class="form-section">
                    <div class="section-heading">
                        <span class="section-number">01</span>
                        <div>
                            <div class="section-title">Plan Information</div>
                            <div class="section-note">Basic identity and customer-facing description</div>
                        </div>
                    </div>

                    <div class="fields">
                        <div class="field">
                            <label class="field-label" for="name">
                                Plan Name <span class="required">*</span>
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="field-input"
                                value="{{ old('name') }}"
                                placeholder="e.g. Business"
                                maxlength="100"
                                required
                            >

                            @error('name')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="field-label" for="student_limit">
                                Student Limit
                            </label>

                            <input
                                id="student_limit"
                                name="student_limit"
                                type="number"
                                class="field-input"
                                value="{{ old('student_limit') }}"
                                min="1"
                                max="4294967295"
                                placeholder="Leave blank for unlimited"
                            >

                            <div class="field-help">
                                Leave blank when the plan should allow unlimited students.
                            </div>

                            @error('student_limit')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field full">
                            <label class="field-label" for="description">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                class="field-textarea"
                                maxlength="1000"
                                placeholder="Short description shown to Super Admins and later on the pricing page."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-heading">
                        <span class="section-number">02</span>
                        <div>
                            <div class="section-title">Pricing</div>
                            <div class="section-note">Actual sale prices used for subscriptions</div>
                        </div>
                    </div>

                    <div class="fields">
                        <div class="field">
                            <label class="field-label" for="monthly_price">
                                Monthly Price (₹) <span class="required">*</span>
                            </label>

                            <input
                                id="monthly_price"
                                name="monthly_price"
                                type="number"
                                class="field-input"
                                value="{{ old('monthly_price', '0') }}"
                                min="0"
                                max="99999999.99"
                                step="0.01"
                                placeholder="799"
                                required
                            >

                            @error('monthly_price')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label class="field-label" for="yearly_price">
                                Yearly Price (₹) <span class="required">*</span>
                            </label>

                            <input
                                id="yearly_price"
                                name="yearly_price"
                                type="number"
                                class="field-input"
                                value="{{ old('yearly_price', '0') }}"
                                min="0"
                                max="99999999.99"
                                step="0.01"
                                placeholder="7000"
                                required
                            >

                            @error('yearly_price')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="pricing-preview">
                        <div class="price-preview">
                            <div class="preview-label">Monthly</div>
                            <div class="preview-value">
                                ₹<span id="monthlyPreview">{{ number_format((float) old('monthly_price', 0), 2) }}</span>
                            </div>
                        </div>

                        <div class="price-preview">
                            <div class="preview-label">Yearly</div>
                            <div class="preview-value">
                                ₹<span id="yearlyPreview">{{ number_format((float) old('yearly_price', 0), 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-heading">
                        <span class="section-number">03</span>
                        <div>
                            <div class="section-title">Feature Access</div>
                            <div class="section-note">Control the modules available under this subscription plan</div>
                        </div>
                    </div>

                    <div class="feature-group">
                        <div class="feature-group-header">
                            <div class="feature-group-title">Core Library ERP</div>
                            <div class="feature-group-label">Library Management</div>
                        </div>

                        <div class="feature-grid">
                            @foreach($coreFeatures as $key => $feature)
                                <div class="feature-toggle">
                                    <input
                                        id="{{ $key }}"
                                        type="hidden"
                                        name="{{ $key }}"
                                        value="0"
                                    >

                                    <input
                                        id="{{ $key }}_checkbox"
                                        type="checkbox"
                                        name="{{ $key }}"
                                        value="1"
                                        {{ old($key, true) ? 'checked' : '' }}
                                    >

                                    <label for="{{ $key }}_checkbox" class="feature-label">
                                        <span class="feature-check">✓</span>

                                        <span class="feature-copy">
                                            <span class="feature-name">{{ $feature['name'] }}</span>
                                            <span class="feature-desc">{{ $feature['desc'] }}</span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="feature-group">
                        <div class="feature-group-header">
                            <div class="feature-group-title">Online Examination</div>
                            <div class="feature-group-label">Premium Examination System</div>
                        </div>

                        <div class="feature-grid">
                            @foreach($examFeatures as $key => $feature)
                                <div class="feature-toggle">
                                    <input
                                        id="{{ $key }}"
                                        type="hidden"
                                        name="{{ $key }}"
                                        value="0"
                                    >

                                    <input
                                        id="{{ $key }}_checkbox"
                                        type="checkbox"
                                        name="{{ $key }}"
                                        value="1"
                                        {{ old($key) ? 'checked' : '' }}
                                    >

                                    <label for="{{ $key }}_checkbox" class="feature-label">
                                        <span class="feature-check">✓</span>

                                        <span class="feature-copy">
                                            <span class="feature-name">{{ $feature['name'] }}</span>
                                            <span class="feature-desc">{{ $feature['desc'] }}</span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="field-help" style="margin-top:12px;">
                        Feature access is enforced server-side. Disabled modules should not be available to customers on this plan.
                    </div>
                </div>

                <div class="form-section">
                    <div class="section-heading">
                        <span class="section-number">04</span>
                        <div>
                            <div class="section-title">Plan Status</div>
                            <div class="section-note">Inactive plans cannot be selected for new subscriptions</div>
                        </div>
                    </div>
                    <div class="status-row">
                        <div class="status-copy">
                            <strong>Make this plan active</strong>
                            <span>Active plans are available for assignment and future checkout flows.</span>
                        </div>

                        <label class="switch" aria-label="Plan active status">
                            <input
                                type="hidden"
                                name="is_active"
                                value="0"
                            >

                            <input
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                            >

                            <span class="switch-track"></span>
                        </label>
                    </div>

                    <div class="status-row">
                        <div class="status-copy">
                            <strong>Show on public pricing</strong>
                            <span>When enabled, this plan can appear on the public pricing page.</span>
                        </div>

                        <label class="switch" aria-label="Public pricing visibility">
                            <input
                                type="hidden"
                                name="is_public"
                                value="0"
                            >

                            <input
                                type="checkbox"
                                name="is_public"
                                value="1"
                                {{ old('is_public', true) ? 'checked' : '' }}
                            >

                            <span class="switch-track"></span>
                        </label>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="{{ route('saas.plans.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M12 5v14"/>
                            <path d="M5 12h14"/>
                        </svg>
                        Create Plan
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const monthly = document.getElementById('monthly_price');
            const yearly = document.getElementById('yearly_price');
            const monthlyPreview = document.getElementById('monthlyPreview');
            const yearlyPreview = document.getElementById('yearlyPreview');

            function formatPrice(value) {
                const number = parseFloat(value || 0);

                return number.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function updatePreview() {
                monthlyPreview.textContent = formatPrice(monthly.value);
                yearlyPreview.textContent = formatPrice(yearly.value);
            }

            monthly.addEventListener('input', updatePreview);
            yearly.addEventListener('input', updatePreview);

            updatePreview();
        });
    </script>
</x-layouts.saas>