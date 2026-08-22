<x-layouts::app :title="'Payment Receipt'">

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- Top Bar --}}
        <div class="flex items-center justify-between print:hidden">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Payment Receipt
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Receipt No: {{ $payment->receipt_no }}
                </p>
            </div>

            <div class="flex gap-3">

                <a href="{{ route('payments.index') }}">
                    <flux:button variant="ghost">
                        Back
                    </flux:button>
                </a>

                <button
                    type="button"
                    onclick="window.print()"
                    class="rounded-xl bg-indigo-600 px-5 py-2 font-semibold text-white hover:bg-indigo-500"
                >
                    Print Receipt
                </button>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- THERMAL RECEIPT --}}
        {{-- ========================================================= --}}

        <div
            id="receipt"
            class="receipt-paper mx-auto bg-white text-black"
        >

            {{-- Logo / Header --}}
            <div class="receipt-header">

                <img
                    src="{{ asset('images/malav-library-logo.png') }}"
                    alt="Malav Library"
                    class="receipt-logo"
                >

                <div class="receipt-library-name">
                    MALAV LIBRARY
                </div>

                <div class="receipt-subtitle">
                    Fee Payment Receipt
                </div>

            </div>


            {{-- Receipt Info --}}
            <div class="receipt-section receipt-meta">

                <div>
                    <span>Receipt No.</span>
                    <strong>{{ $payment->receipt_no }}</strong>
                </div>

                <div>
                    <span>Date</span>
                    <strong>
                        {{ optional($payment->payment_date)->format('d M Y') }}
                    </strong>
                </div>

            </div>


            {{-- Divider --}}
            <div class="receipt-divider"></div>


            {{-- Student Information --}}
            <div class="receipt-section">

                <div class="receipt-title">
                    STUDENT DETAILS
                </div>

                <div class="receipt-row">
                    <span>Name</span>
                    <strong>
                        {{ $payment->student->full_name }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Student ID</span>
                    <strong>
                        {{ $payment->student->student_code }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Mobile</span>
                    <strong>
                        {{ $payment->student->mobile ?: '-' }}
                    </strong>
                </div>

            </div>


            <div class="receipt-divider"></div>


            {{-- Membership --}}
            <div class="receipt-section">

                <div class="receipt-title">
                    MEMBERSHIP DETAILS
                </div>

                <div class="receipt-row">
                    <span>Plan</span>
                    <strong>
                        {{ $payment->membership->plan->name }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Shift</span>
                    <strong>
                        {{ $payment->membership->plan->shift }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Duration</span>
                    <strong>
                        {{ $payment->membership->plan->duration_months }}
                        {{ $payment->membership->plan->duration_months == 1 ? 'Month' : 'Months' }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Valid From</span>
                    <strong>
                        {{ optional($payment->membership->start_date)->format('d M Y') }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Valid Till</span>
                    <strong>
                        {{ optional($payment->membership->end_date)->format('d M Y') }}
                    </strong>
                </div>

            </div>


            <div class="receipt-divider"></div>


            {{-- Fee Summary --}}
            <div class="receipt-section">

                <div class="receipt-title">
                    PAYMENT DETAILS
                </div>

                <div class="receipt-row">
                    <span>Plan Amount</span>
                    <strong>
                        ₹{{ number_format($payment->membership->amount, 2) }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Discount</span>
                    <strong>
                        ₹{{ number_format($payment->membership->discount ?? 0, 2) }}
                    </strong>
                </div>

                <div class="receipt-row">
                    <span>Payment Mode</span>
                    <strong>
                        {{ $payment->payment_mode }}
                    </strong>
                </div>

                @if($payment->transaction_id)

                    <div class="receipt-row">
                        <span>Transaction ID</span>
                        <strong class="receipt-small-value">
                            {{ $payment->transaction_id }}
                        </strong>
                    </div>

                @endif

            </div>


            {{-- Total --}}
            <div class="receipt-total">

                <span>
                    TOTAL PAID
                </span>

                <strong>
                    ₹{{ number_format($payment->amount, 2) }}
                </strong>

            </div>


            <div class="receipt-divider"></div>


            {{-- Footer --}}
            <div class="receipt-footer">

                <strong>
                    Thank You!
                </strong>

                <span>
                    Thank you for choosing Malav Library.
                </span>

                <small>
                    This is a computer-generated receipt.
                </small>

            </div>

        </div>

    </div>


    <style>

        /* =========================================================
           SCREEN RECEIPT
        ========================================================= */

        .receipt-paper {

            width: 380px;

            min-height: 500px;

            padding: 22px 20px;

            border-radius: 12px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.25);

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #111111 !important;

        }


        .receipt-paper * {

            color: #111111 !important;

        }


        /* Header */

        .receipt-header {

            text-align: center;

            padding-bottom: 14px;

        }


        .receipt-logo {

            width: 95px;

            max-height: 45px;

            object-fit: contain;

            margin: 0 auto 7px;

        }


        .receipt-library-name {

            font-size: 21px;

            line-height: 1.1;

            font-weight: 800;

            letter-spacing: 0.5px;

        }


        .receipt-subtitle {

            margin-top: 4px;

            font-size: 11px;

            font-weight: 600;

        }


        /* Sections */

        .receipt-section {

            padding: 9px 0;

        }


        .receipt-title {

            margin-bottom: 7px;

            font-size: 10px;

            font-weight: 800;

            letter-spacing: 0.7px;

        }


        .receipt-row {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 12px;

            padding: 3px 0;

            font-size: 11px;

            line-height: 1.35;

        }


        .receipt-row span {

            flex-shrink: 0;

            font-weight: 500;

        }


        .receipt-row strong {

            text-align: right;

            font-weight: 700;

            max-width: 62%;

            word-break: break-word;

        }


        .receipt-small-value {

            font-size: 9px;

        }


        /* Receipt Meta */

        .receipt-meta {

            display: flex;

            justify-content: space-between;

            gap: 15px;

            font-size: 10px;

        }


        .receipt-meta div {

            display: flex;

            flex-direction: column;

            gap: 2px;

        }


        .receipt-meta div:last-child {

            text-align: right;

        }


        .receipt-meta span {

            font-size: 9px;

            font-weight: 500;

        }


        .receipt-meta strong {

            font-size: 10px;

        }


        /* Divider */

        .receipt-divider {

            border-top: 1px dashed #555;

            margin: 2px 0;

        }


        /* Total */

        .receipt-total {

            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-top: 10px;

            padding: 10px 0;

            font-size: 14px;

            font-weight: 800;

        }


        .receipt-total strong {

            font-size: 18px;

        }


        /* Footer */

        .receipt-footer {

            text-align: center;

            padding-top: 10px;

            display: flex;

            flex-direction: column;

            gap: 3px;

        }


        .receipt-footer strong {

            font-size: 13px;

        }


        .receipt-footer span {

            font-size: 9px;

        }


        .receipt-footer small {

            font-size: 8px;

        }


        /* =========================================================
           THERMAL PRINT
        ========================================================= */

        @media print {

            @page {

                size: 58mm auto;

                margin: 0;

            }


            html,
            body {

                width: 58mm !important;

                margin: 0 !important;

                padding: 0 !important;

                background: white !important;

            }


            body {

                color: #000 !important;

            }


            body * {

                visibility: hidden !important;

            }


            #receipt,
            #receipt * {

                visibility: visible !important;

            }


            #receipt {

                position: absolute !important;

                left: 0 !important;

                top: 0 !important;

                width: 58mm !important;

                min-height: auto !important;

                margin: 0 !important;

                padding: 4mm 3mm !important;

                border: none !important;

                border-radius: 0 !important;

                box-shadow: none !important;

                background: white !important;

                color: #000 !important;

            }


            #receipt * {

                color: #000 !important;

            }


            .receipt-logo {

                width: 22mm !important;

                max-height: 11mm !important;

                margin-bottom: 2mm !important;

            }


            .receipt-library-name {

                font-size: 15px !important;

            }


            .receipt-subtitle {

                font-size: 8px !important;

            }


            .receipt-header {

                padding-bottom: 3mm !important;

            }


            .receipt-section {

                padding: 2.5mm 0 !important;

            }


            .receipt-title {

                margin-bottom: 1.5mm !important;

                font-size: 7px !important;

            }


            .receipt-row {

                padding: 0.8mm 0 !important;

                font-size: 8px !important;

                line-height: 1.25 !important;

            }


            .receipt-row strong {

                max-width: 60% !important;

            }


            .receipt-small-value {

                font-size: 6.5px !important;

            }


            .receipt-meta {

                font-size: 7.5px !important;

            }


            .receipt-meta span {

                font-size: 6.5px !important;

            }


            .receipt-meta strong {

                font-size: 7.5px !important;

            }


            .receipt-divider {

                margin: 0.5mm 0 !important;

            }


            .receipt-total {

                margin-top: 1mm !important;

                padding: 2.5mm 0 !important;

                font-size: 10px !important;

            }


            .receipt-total strong {

                font-size: 13px !important;

            }


            .receipt-footer {

                padding-top: 2.5mm !important;

                gap: 1mm !important;

            }


            .receipt-footer strong {

                font-size: 9px !important;

            }


            .receipt-footer span {

                font-size: 6.5px !important;

            }


            .receipt-footer small {

                font-size: 6px !important;

            }


            .print\:hidden {

                display: none !important;

            }

        }

    </style>

</x-layouts::app>