<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student ID Card - {{ $student->student_code }}</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 40px;
            background: #272727;
            font-family: Arial, Helvetica, sans-serif;
            color: #000000;
        }

        /* =========================
           CARD
        ========================== */

        .id-card {
            width: 54mm;
            min-height: 86mm;
            margin: 0 auto;

            background: #ffffff;

            border-radius: 4mm;
            overflow: hidden;

            box-shadow:
                0 10px 35px rgba(0,0,0,0.35);

            position: relative;
        }


        /* =========================
           HEADER
        ========================== */

        .card-header {
            height: 17mm;

            background: #111111;

            border-bottom: 1.5mm solid #FFC107;

            display: flex;
            align-items: center;

            padding: 2.5mm 3mm;
        }

        .logo {
            width: 10mm;
            height: 10mm;

            object-fit: contain;

            margin-right: 2.5mm;
        }

        .header-text {
            line-height: 1.1;
        }

        .library-name {
            font-size: 4mm;
            font-weight: 800;

            color: #ffffff;

            letter-spacing: 0.1mm;
        }

        .library-subtitle {
            margin-top: 1mm;

            font-size: 2.1mm;

            color: #bdbdbd;
        }


        /* =========================
           BODY
        ========================== */

        .card-body {
            padding: 3mm;
        }


        /* =========================
           STUDENT TOP
        ========================== */
.student-top {
    display: flex;
    gap: 2.5mm;
    align-items: center;
    margin-bottom: 1.5mm;
}


        /* PHOTO SMALL */

        .student-photo {
            width: 20mm;
            height: 25mm;

            object-fit: cover;

            border-radius: 1.5mm;

            border: 0.3mm solid #dddddd;

            background: #f5f5f5;

            flex-shrink: 0;
        }

        .student-placeholder {
            width: 20mm;
            height: 25mm;

            border-radius: 2mm;

            border: 0.4mm solid #dddddd;

            background: #f5f5f5;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 9mm;
            font-weight: bold;

            color: #999999;

            flex-shrink: 0;
        }


        /* STUDENT DETAILS */

        .student-info {
            flex: 1;

            min-width: 0;
        }

        .student-label {
            font-size: 2.1mm;

            color: #777777;

            text-transform: uppercase;

            letter-spacing: 0.2mm;

            margin-bottom: 1mm;
        }

        .student-name {
            font-size: 4.2mm;

            line-height: 1.1;

            font-weight: 800;

            color: #000000;

            word-break: break-word;

            margin-bottom: 2.5mm;
        }

        .student-code-label {
            font-size: 2mm;

            color: #777777;

            margin-bottom: 0.7mm;
        }

        .student-code {
            font-size: 3.6mm;

            font-weight: 800;

            color: #E3A900;
        }


        /* =========================
           DETAILS
        ========================== */

        .details {
            border-top: 0.3mm solid #dddddd;

            margin-top: 1mm;
        }

        .detail-row {
            display: flex;

            align-items: center;

            justify-content: space-between;

            min-height: 4.8mm;

            padding: 0.7mm 0;

            border-bottom: 0.2mm solid #eeeeee;

            gap: 2mm;
        }

        .detail-label {
            font-size: 2.1mm;

            color: #222222;

            font-weight: 500;

            white-space: nowrap;
        }

        .detail-value {
            font-size: 2.1mm;

            color: #000000;

            font-weight: 700;

            text-align: right;

            max-width: 60%;

            word-break: break-word;
        }

        .expiry {
            color: #dc2626 !important;
        }


        /* =========================
           QR SECTION
        ========================== */

        .qr-section {
            display: flex;

            align-items: center;

            gap: 3mm;

            margin-top: 3mm;

            padding: 2mm;

            border: 0.4mm solid #FFC107;

            border-radius: 2mm;

            background: #ffffff;
        }

        .qr-code {
            width: 18mm;
            height: 18mm;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-code svg {
            width: 18mm !important;
            height: 18mm !important;
        }

        .qr-title {
            font-size: 3mm;

            font-weight: 800;

            color: #111111;

            margin-bottom: 1mm;
        }

        .qr-text {
            font-size: 1.9mm;

            line-height: 1.35;

            color: #555555;
        }


        /* =========================
           FOOTER
        ========================== */

        .card-footer {
            background: #111111;

            border-top: 1mm solid #FFC107;

            padding: 2.5mm 3mm;

            text-align: center;
        }

        .footer-title {
            color: #FFC107;

            font-size: 3.2mm;

            font-weight: 800;

            letter-spacing: 0.3mm;

            margin-bottom: 1mm;
        }

        .footer-text {
            color: #ffffff;

            font-size: 1.8mm;
        }


        /* =========================
           PRINT
        ========================== */

        .print-button {
            display: block;

            margin: 20px auto;

            padding: 10px 22px;

            border: none;

            border-radius: 8px;

            background: #FFC107;

            color: #000000;

            font-weight: 700;

            cursor: pointer;
        }

        .back-button {
            display: block;

            margin: 0 auto 20px;

            text-align: center;

            color: #ffffff;

            text-decoration: none;

            font-size: 14px;
        }


        @media print {

            @page {
                size: 54mm 70mm;
                margin: 0;
            }

            html,
            body {
                width: 54mm;
                height: 86mm;

                margin: 0;
                padding: 0;

                background: #ffffff;
            }

            .no-print {
                display: none !important;
            }

            .id-card {
    width: 54mm;
    min-height: 70mm;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 4mm;
    overflow: hidden;
    box-shadow: 0 10px 35px rgba(0,0,0,0.35);
    position: relative;
}

            .card-header,
            .card-footer {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            .expiry {
                color: #dc2626 !important;

                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

    </style>
</head>


<body>


    <!-- =========================
         PRINT / BACK BUTTONS
    ========================== -->

    <div class="no-print">

        <a
            href="{{ route('students.show', $student) }}"
            class="back-button"
        >
            ← Back to Student
        </a>

        <button
            onclick="window.print()"
            class="print-button"
        >
            Print ID Card
        </button>

    </div>


    <!-- =========================
         ID CARD
    ========================== -->

    <div class="id-card">


        <!-- HEADER -->

        <div class="card-header">

            <img
                src="{{ asset('images/logo/malav-library-logo.png') }}"
                class="logo"
                alt="Malav Library"
            >

            <div class="header-text">

                <div class="library-name">
                    MALAV LIBRARY
                </div>

                <div class="library-subtitle">
                    Library Management System
                </div>

            </div>

        </div>


        <!-- BODY -->

        <div class="card-body">


            <!-- STUDENT TOP -->

            <div class="student-top">


                @if($student->photo)

                    <img
                        src="{{ asset('storage/'.$student->photo) }}"
                        class="student-photo"
                        alt="{{ $student->full_name }}"
                    >

                @else

                    <div class="student-placeholder">

                        {{ strtoupper(substr($student->first_name, 0, 1)) }}

                    </div>

                @endif


                <div class="student-info">

                    <div class="student-label">
                        Student
                    </div>

                    <div class="student-name">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </div>

                    <div class="student-code-label">
                        Student Code
                    </div>

                    <div class="student-code">
                        {{ $student->student_code }}
                    </div>

                </div>

            </div>


            <!-- DETAILS -->

            <div class="details">


                <!-- MOBILE -->

                <div class="detail-row">

                    <span class="detail-label">
                        Mobile
                    </span>

                    <span class="detail-value">
                        {{ $student->mobile ?: '-' }}
                    </span>

                </div>


                <!-- ADMISSION DATE -->

                <div class="detail-row">

                    <span class="detail-label">
                        Admission Date
                    </span>

                    <span class="detail-value">
                        {{ $student->joining_date?->format('d M Y') ?? '-' }}
                    </span>

                </div>


                <!-- SEAT -->

                <div class="detail-row">

                    <span class="detail-label">
                        Seat No.
                    </span>

                    <span class="detail-value">
                        {{ $assignment?->seat?->seat_number ?? '-' }}
                    </span>

                </div>


                <!-- ROOM -->

                <div class="detail-row">

                    <span class="detail-label">
                        Room
                    </span>

                    <span class="detail-value">
                        {{ $assignment?->seat?->room?->name ?? '-' }}
                    </span>

                </div>


                <!-- MEMBERSHIP -->

                <div class="detail-row">

                    <span class="detail-label">
                        Membership
                    </span>

                    <span class="detail-value">
                        {{ $assignment?->membership?->plan?->name ?? '-' }}
                    </span>

                </div>


                <!-- SHIFT -->

                <div class="detail-row">

                    <span class="detail-label">
                        Shift
                    </span>

                    <span class="detail-value">
                        {{ $assignment?->membership?->plan?->shift ?? '-' }}
                    </span>

                </div>


                <!-- VALID TILL -->

                <div class="detail-row">

                    <span class="detail-label">
                        Valid Till
                    </span>

                    <span class="detail-value expiry">

                        {{ $assignment?->membership?->end_date?->format('d M Y') ?? '-' }}

                    </span>

                </div>


            </div>


            <!-- QR -->

            <div class="qr-section">


                <div class="qr-code">

                    {!! QrCode::size(100)->margin(0)->generate($student->student_code) !!}

                </div>


                <div>

                    <div class="qr-title">
                        Library Entry ID
                    </div>

                    <div class="qr-text">
                        Scan this QR code at the reception
                        for attendance and library entry.
                    </div>

                </div>


            </div>


        </div>


        <!-- FOOTER -->

        <div class="card-footer">

            <div class="footer-title">
                MALAV LIBRARY
            </div>

            <div class="footer-text">
                This card is property of Malav Library.
            </div>

        </div>


    </div>


</body>

</html>