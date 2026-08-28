<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $library->name }} - {{ $student->student_code }}
    </title>


    <style>

        /* =========================================================
           RESET
        ========================================================= */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(245, 180, 0, 0.08),
                    transparent 35%
                ),
                #090a0d;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            color: #ffffff;
        }


        /* =========================================================
           SCREEN WRAPPER
        ========================================================= */

        .screen-wrapper {
            min-height: 100vh;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 18px;

            padding: 30px 20px;
        }


        /* =========================================================
           ACTION BAR
        ========================================================= */

        .actions {
            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            width: 100%;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 42px;

            padding: 0 18px;

            border-radius: 10px;

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            cursor: pointer;

            transition:
                transform 0.2s ease,
                background 0.2s ease,
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .back-button {
            color: #d4d4d8;

            background: rgba(255,255,255,0.05);

            border: 1px solid rgba(255,255,255,0.10);
        }

        .back-button:hover {
            background: rgba(255,255,255,0.09);
            border-color: rgba(255,255,255,0.18);

            transform: translateY(-1px);
        }

        .print-button {
            color: #090909;

            background:
                linear-gradient(
                    135deg,
                    #ffd84d,
                    #f5b400
                );

            border: 1px solid rgba(255,220,90,0.65);

            box-shadow:
                0 8px 25px rgba(245,180,0,0.16);
        }

        .print-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 12px 30px rgba(245,180,0,0.24);
        }


        /* =========================================================
           CARD STAGE
        ========================================================= */

        .card-stage {
            display: flex;
            justify-content: center;
            align-items: center;
        }


        /* =========================================================
           ID CARD
           STANDARD CR80 PROPORTION
           85.60mm × 53.98mm
        ========================================================= */

        .id-card {

            width: 85.6mm;
            height: 54mm;

            position: relative;

            overflow: hidden;

            border-radius: 3.2mm;

            background:
                linear-gradient(
                    135deg,
                    #17181c 0%,
                    #0e0f12 55%,
                    #090a0c 100%
                );

            border: 0.25mm solid rgba(255,255,255,0.12);

            box-shadow:
                0 18px 45px rgba(0,0,0,0.55),
                0 0 35px rgba(245,180,0,0.06);

            display: flex;
            flex-direction: column;
        }


        /* =========================================================
           GOLD ACCENT
        ========================================================= */

        .gold-line {
            height: 1.2mm;
            width: 100%;

            flex-shrink: 0;

            background:
                linear-gradient(
                    90deg,
                    #d89b00,
                    #ffd84d,
                    #f5b400,
                    #d89b00
                );
        }


        /* =========================================================
           CARD HEADER
        ========================================================= */

        .card-header {

            height: 15.2mm;

            display: flex;
            align-items: center;

            padding:
                2.4mm
                3.5mm;

            border-bottom:
                0.2mm solid
                rgba(255,255,255,0.08);
        }


        .library-logo {

            width: 10mm;
            height: 10mm;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            border-radius: 2mm;

            background: #ffffff;

            border:
                0.25mm solid
                rgba(255,255,255,0.75);

            margin-right: 2.5mm;
        }

        .library-logo img {

            width: 100%;
            height: 100%;

            object-fit: contain;
        }


        .library-logo-fallback {

            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #ffd84d,
                    #e5a900
                );

            color: #090909;

            font-size: 5mm;
            font-weight: 900;
        }


        .library-info {

            min-width: 0;
            flex: 1;
        }


        .library-name {

            color: #ffffff;

            font-size: 4.1mm;
            line-height: 1.05;

            font-weight: 850;

            letter-spacing: 0.05mm;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .library-subtitle {

            margin-top: 1.2mm;

            color: #9297a1;

            font-size: 1.8mm;

            font-weight: 600;

            letter-spacing: 0.15mm;

            text-transform: uppercase;
        }


        .card-badge {

            flex-shrink: 0;

            padding:
                1.3mm
                2.2mm;

            border-radius: 1.5mm;

            background:
                rgba(245,180,0,0.10);

            border:
                0.2mm solid
                rgba(245,180,0,0.30);

            color: #f5c52a;

            font-size: 1.65mm;

            font-weight: 800;

            letter-spacing: 0.15mm;

            text-transform: uppercase;
        }


        /* =========================================================
           CARD BODY
        ========================================================= */

        .card-body {

            flex: 1;

            display: flex;

            padding:
                2.5mm
                3.5mm
                2.2mm;

            gap: 3mm;

            min-height: 0;
        }


        /* =========================================================
           STUDENT PHOTO
        ========================================================= */

        .photo-wrap {

            width: 20mm;
            height: 25mm;

            flex-shrink: 0;

            overflow: hidden;

            border-radius: 2mm;

            background: #17181c;

            border:
                0.35mm solid
                rgba(245,180,0,0.55);

            box-shadow:
                0 5px 15px rgba(0,0,0,0.30);
        }


        .student-photo {

            width: 100%;
            height: 100%;

            display: block;

            object-fit: cover;
        }


        .photo-placeholder {

            width: 100%;
            height: 100%;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #25272c,
                    #111216
                );

            color: #f5b400;

            font-size: 9mm;
            font-weight: 850;
        }


        /* =========================================================
           STUDENT MAIN
        ========================================================= */

        .student-content {

            flex: 1;

            min-width: 0;

            display: flex;
            flex-direction: column;
        }


        .student-label {

            color: #858a94;

            font-size: 1.65mm;

            font-weight: 700;

            letter-spacing: 0.2mm;

            text-transform: uppercase;
        }


     .student-name {
    display: block !important;

    width: 100%;

    margin-top: 1mm;

    color: #ffffff !important;

    font-size: 4mm !important;

    line-height: 1.2 !important;

    font-weight: 800 !important;

    white-space: nowrap;

    overflow: visible !important;

    text-overflow: clip;

    opacity: 1 !important;

    visibility: visible !important;
}


        .student-code {

            margin-top: 1.3mm;

            display: inline-flex;

            align-items: center;

            width: fit-content;

            padding:
                0.9mm
                1.8mm;

            border-radius: 1.2mm;

            background:
                rgba(245,180,0,0.09);

            border:
                0.2mm solid
                rgba(245,180,0,0.25);

            color: #f5c52a;

            font-size: 2.1mm;

            font-weight: 800;

            letter-spacing: 0.15mm;
        }


        /* =========================================================
           DETAILS GRID
        ========================================================= */

        .details-grid {

            margin-top: 2mm;

            display: grid;

            grid-template-columns: 1fr 1fr;

            column-gap: 3mm;

            row-gap: 1.2mm;

            padding-top: 1.8mm;

            border-top:
                0.2mm solid
                rgba(255,255,255,0.08);
        }


        .detail {

            min-width: 0;
        }


        .detail-label {

            color: #707580;

            font-size: 1.45mm;

            line-height: 1;

            font-weight: 650;

            text-transform: uppercase;

            letter-spacing: 0.1mm;
        }


        .detail-value {

            margin-top: 0.55mm;

            color: #e7e7e9;

            font-size: 1.85mm;

            line-height: 1.1;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .valid {

            color: #f5c52a;
        }


        /* =========================================================
           QR
        ========================================================= */

        .qr-panel {

            width: 20mm;

            flex-shrink: 0;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 1.2mm;

            padding:
                1.4mm;

            border-radius: 2mm;

            background:
                rgba(255,255,255,0.045);

            border:
                0.2mm solid
                rgba(255,255,255,0.09);
        }


        .qr-code {

            width: 15mm;
            height: 15mm;

            display: flex;

            align-items: center;
            justify-content: center;

            padding: 0.8mm;

            background: #ffffff;

            border-radius: 1.3mm;
        }


        .qr-code svg {

            width: 100% !important;
            height: 100% !important;

            display: block;
        }


        .qr-label {

            color: #9da1a9;

            font-size: 1.4mm;

            font-weight: 700;

            text-align: center;

            letter-spacing: 0.08mm;
        }


        /* =========================================================
           FOOTER
        ========================================================= */

        .card-footer {

            min-height: 7.4mm;

            flex-shrink: 0;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 3mm;

            padding:
                1.4mm
                3.5mm;

            background:
                rgba(0,0,0,0.30);

            border-top:
                0.2mm solid
                rgba(255,255,255,0.07);
        }


        .footer-left {

            min-width: 0;

            color: #858a94;

            font-size: 1.55mm;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .footer-right {

            flex-shrink: 0;

            color: #f5c52a;

            font-size: 1.55mm;

            font-weight: 750;

            white-space: nowrap;
        }


        /* =========================================================
           PRINT
        ========================================================= */

        @media print {

            @page {

                size: 85.6mm 54mm;

                margin: 0;
            }


            html,
            body {

                width: 85.6mm;
                height: 54mm;

                margin: 0;
                padding: 0;

                background: #ffffff !important;
            }


            .screen-wrapper {

                width: 85.6mm;
                height: 54mm;

                min-height: 54mm;

                margin: 0;
                padding: 0;

                display: block;

                background: #ffffff !important;
            }


            .no-print {

                display: none !important;
            }


            .card-stage {

                width: 85.6mm;
                height: 54mm;

                display: block;
            }


            .id-card {

                width: 85.6mm;
                height: 54mm;

                margin: 0;

                border-radius: 0;

                box-shadow: none;

                border: none;

                -webkit-print-color-adjust: exact !important;

                print-color-adjust: exact !important;
            }


            .gold-line,
            .card-header,
            .card-footer,
            .card-badge,
            .student-code,
            .qr-panel {

                -webkit-print-color-adjust: exact !important;

                print-color-adjust: exact !important;
            }

        }


        /* =========================================================
           MOBILE PREVIEW
        ========================================================= */

        @media screen and (max-width: 620px) {

            .screen-wrapper {

                padding:
                    24px
                    12px;
            }


            .id-card {

                transform-origin: center center;

                transform: scale(
                    min(
                        1,
                        calc(
                            (100vw - 24px) / 323.15
                        )
                    )
                );
            }

        }

    </style>

</head>


<body>


<div class="screen-wrapper">


    {{-- =========================================================
         ACTIONS
    ========================================================= --}}

    <div class="actions no-print">

        <a
            href="{{ route('students.show', $student) }}"
            class="action-button back-button"
        >
            ← Back to Student
        </a>


        <button
            type="button"
            onclick="window.print()"
            class="action-button print-button"
        >
            Print ID Card
        </button>

    </div>


    {{-- =========================================================
         CARD
    ========================================================= --}}

    <div class="card-stage">

        <div class="id-card">


            {{-- GOLD TOP LINE --}}
            <div class="gold-line"></div>


            {{-- =================================================
                 HEADER
            ================================================= --}}

            <div class="card-header">


                {{-- Library Logo --}}

                <div class="library-logo">

                    @if($library->logo)

                        <img
                            src="{{ asset('storage/' . $library->logo) }}"
                            alt="{{ $library->name }}"
                        >

                    @else

                        <div class="library-logo-fallback">
                            {{ strtoupper(substr($library->name, 0, 1)) }}
                        </div>

                    @endif

                </div>


                {{-- Library Information --}}

                <div class="library-info">

                    <div class="library-name">
                        {{ $library->name }}
                    </div>

                    <div class="library-subtitle">
                        Library Management System
                    </div>

                </div>


                <div class="card-badge">
                    Student ID
                </div>

            </div>


            {{-- =================================================
                 BODY
            ================================================= --}}

            <div class="card-body">


                {{-- Student Photo --}}

                <div class="photo-wrap">

                    @if($student->photo)

                        <img
                            src="{{ asset('storage/' . $student->photo) }}"
                            alt="{{ $student->full_name }}"
                            class="student-photo"
                        >

                    @else

                        <div class="photo-placeholder">
                            {{ strtoupper(substr($student->first_name, 0, 1)) }}
                        </div>

                    @endif

                </div>


                {{-- Student Information --}}

                <div class="student-content">

                    <div class="student-label">
                        Library Member
                    </div>


                   <div class="student-name">
    {{ $student->first_name }} {{ $student->last_name }}
</div>


                    <div class="student-code">
                        {{ $student->student_code }}
                    </div>


                    {{-- Details --}}

                    <div class="details-grid">


                        <div class="detail">

                            <div class="detail-label">
                                Mobile
                            </div>

                            <div class="detail-value">
                                {{ $student->mobile ?: '-' }}
                            </div>

                        </div>


                        <div class="detail">

                            <div class="detail-label">
                                Admission
                            </div>

                            <div class="detail-value">
                                {{ $student->joining_date?->format('d M Y') ?? '-' }}
                            </div>

                        </div>


                        <div class="detail">

                            <div class="detail-label">
                                Membership
                            </div>

                            <div class="detail-value">
                                {{ $assignment?->membership?->plan?->name ?? '-' }}
                            </div>

                        </div>


                        <div class="detail">

                            <div class="detail-label">
                                Shift
                            </div>

                            <div class="detail-value">
                                {{ $assignment?->membership?->plan?->shift ?? '-' }}
                            </div>

                        </div>


                        <div class="detail">

                            <div class="detail-label">
                                Room / Seat
                            </div>

                            <div class="detail-value">
                                {{ $assignment?->seat?->room?->name ?? '-' }}
                                /
                                {{ $assignment?->seat?->seat_number ?? '-' }}
                            </div>

                        </div>


                        <div class="detail">

                            <div class="detail-label">
                                Valid Till
                            </div>

                            <div class="detail-value valid">
                                {{ $assignment?->membership?->end_date?->format('d M Y') ?? '-' }}
                            </div>

                        </div>


                    </div>

                </div>


                {{-- QR Code --}}

                <div class="qr-panel">

                    <div class="qr-code">

                        {!! QrCode::size(100)->margin(0)->generate(
                            $library->code . '|' . $student->student_code
                        ) !!}

                    </div>


                    <div class="qr-label">
                        Scan for Entry
                    </div>

                </div>


            </div>


            {{-- =================================================
                 FOOTER
            ================================================= --}}

            <div class="card-footer">

                <div class="footer-left">

                    @if($library->phone)
                        {{ $library->phone }}
                    @elseif($library->whatsapp)
                        WhatsApp: {{ $library->whatsapp }}
                    @else
                        Official Student Identification Card
                    @endif

                </div>


                <div class="footer-right">

                    {{ $library->code }}

                </div>

            </div>


        </div>

    </div>

</div>


</body>

</html>