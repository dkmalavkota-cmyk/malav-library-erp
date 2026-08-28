<!DOCTYPE html>
<html lang="en" class="dark">

@php
    $library = auth()->user()?->library;
    $libraryName = $library?->name ?? 'Library';
    $libraryInitial = strtoupper(substr($libraryName, 0, 1));
@endphp

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $libraryName }} - Attendance Kiosk</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
   
</head>


<body class="min-h-screen bg-zinc-950 text-white">

<div
    id="fullscreenPrompt"
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-zinc-950 px-6"
>

    <div class="w-full max-w-md rounded-3xl border border-zinc-800 bg-zinc-900 p-8 text-center shadow-2xl">

       <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-yellow-400 text-4xl font-black text-black">
    {{ $libraryInitial }}
</div>

        <h2 class="mt-6 text-2xl font-bold">
    {{ $libraryName }}
</h2>

        <p class="mt-2 text-zinc-400">
            Attendance Kiosk
        </p>

        <button
            id="startKioskButton"
            type="button"
            class="mt-7 w-full rounded-2xl bg-yellow-400 px-6 py-4 text-lg font-bold text-black transition active:scale-95"
        >
            Start Attendance Kiosk
        </button>

        <p class="mt-4 text-xs text-zinc-500">
            Tap once to start the attendance screen.
        </p>

    </div>

</div>

<div class="flex min-h-screen flex-col">

    {{-- Header --}}
    <header class="border-b border-zinc-800 bg-zinc-900 px-5 py-4">

        <div class="mx-auto flex w-full max-w-5xl items-center justify-between">

            <div class="flex items-center gap-3">

               <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-400 text-2xl font-black text-black">
    {{ $libraryInitial }}
</div>

                <div>
                  <h1 class="text-xl font-extrabold tracking-tight">
    {{ strtoupper($libraryName) }}
</h1>
                    <p class="text-xs text-zinc-400">
                        Attendance Kiosk
                    </p>
                </div>

            </div>

            <div
                id="connectionStatus"
                class="rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-400"
            >
                ● Ready
            </div>

        </div>

    </header>


    {{-- Main --}}
    <main class="flex flex-1 items-center justify-center px-4 py-6">

        <div class="w-full max-w-3xl">


            {{-- Scanner Card --}}
            <div
                id="scannerCard"
                class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-900 shadow-2xl"
            >

                {{-- Scanner Header --}}
                <div class="px-5 pt-6 text-center">

                    <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-yellow-400/10 text-3xl">
                        📱
                    </div>

                    <h2 class="text-2xl font-bold sm:text-3xl">
                        Scan Your ID Card
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm text-zinc-400">
                        Place the QR code on your {{ $libraryName }} ID card
                        in front of the camera.
                    </p>

                </div>


                {{-- QR Scanner --}}
                <div class="mx-auto mt-5 w-full max-w-xl px-4">

                    <div
                        id="reader"
                        class="min-h-[280px] overflow-hidden rounded-2xl border-2 border-zinc-700 bg-black"
                    ></div>

                </div>


                {{-- Status --}}
                <div class="px-5 py-5 text-center">

                    <div
                        id="scannerStatus"
                        class="text-lg font-bold text-yellow-400"
                    >
                        Starting camera...
                    </div>

                    <p
                        id="scannerHelp"
                        class="mt-1 text-sm text-zinc-500"
                    >
                        Please allow camera access if your browser asks.
                    </p>

                </div>


                {{-- Instruction --}}
                <div class="border-t border-zinc-800 px-5 py-4">

                    <div class="mx-auto flex max-w-xl items-center justify-center gap-3 text-center">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-yellow-400 text-lg text-black">
                            ✓
                        </div>

                        <p class="text-sm text-zinc-400">
                            Scan your ID card once.
                            Your attendance will be recorded automatically.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Result Card --}}
            <div
                id="resultCard"
                class="hidden overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-900 shadow-2xl"
            >

                {{-- Result Header --}}
                <div
                    id="resultHeader"
                    class="px-5 py-8 text-center"
                >

                    <div
                        id="resultIcon"
                        class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-emerald-500/10 text-5xl"
                    >
                        ✓
                    </div>

                    <h2
                        id="resultTitle"
                        class="mt-5 text-3xl font-extrabold"
                    >
                        Welcome
                    </h2>

                    <p
                        id="resultMessage"
                        class="mt-2 text-lg text-zinc-400"
                    >
                        Attendance recorded successfully.
                    </p>

                </div>


                {{-- Student Information --}}
                <div class="border-t border-zinc-800 px-5 py-6">

                    <div class="mx-auto flex max-w-xl items-center gap-4">

                        <div
                            id="studentPhoto"
                            class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-zinc-800 text-2xl font-bold text-yellow-400"
                        >
                            S
                        </div>

                        <div class="min-w-0">

                            <div
                                id="studentName"
                                class="truncate text-xl font-bold"
                            >
                                Student
                            </div>

                            <div
                                id="studentCode"
                                class="mt-1 text-sm font-semibold text-yellow-400"
                            >
                                ML000000
                            </div>

                        </div>

                    </div>


                    {{-- Seat / Shift --}}
                    <div class="mx-auto mt-5 grid max-w-xl grid-cols-2 gap-3">

                        <div class="rounded-2xl bg-zinc-800 p-4">

                            <div class="text-xs uppercase tracking-wide text-zinc-500">
                                Seat
                            </div>

                            <div
                                id="studentSeat"
                                class="mt-1 font-bold"
                            >
                                —
                            </div>

                        </div>


                        <div class="rounded-2xl bg-zinc-800 p-4">

                            <div class="text-xs uppercase tracking-wide text-zinc-500">
                                Shift
                            </div>

                            <div
                                id="studentShift"
                                class="mt-1 font-bold text-yellow-400"
                            >
                                —
                            </div>

                        </div>

                    </div>

                </div>


                {{-- Reset Message --}}
                <div class="border-t border-zinc-800 px-5 py-5 text-center">

                    <p class="text-sm font-medium text-zinc-500">
                        Ready for next student...
                    </p>

                </div>

            </div>


            {{-- Error --}}
           <div
    id="errorCard"
    class="fixed inset-x-4 top-1/2 z-[9999] hidden -translate-y-1/2"
>
    <div
        class="mx-auto w-full max-w-md rounded-3xl border border-red-500/40 bg-zinc-900 p-8 text-center shadow-2xl"
    >

        <div
            class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-red-500/10 text-4xl text-red-400"
        >
            ✕
        </div>

        <h2
            class="mt-5 text-2xl font-extrabold text-red-400"
        >
            Attendance Denied
        </h2>

        <p
            id="errorMessage"
            class="mt-3 text-lg font-semibold text-zinc-200"
        >
            Unable to process QR code.
        </p>

        <p class="mt-4 text-sm text-zinc-500">
            Please contact the library reception.
        </p>

    </div>
</div>

        </div>

    </main>


    {{-- Footer --}}
    <footer class="border-t border-zinc-800 bg-zinc-900 px-5 py-3 text-center">

       <p class="text-xs text-zinc-600">
    {{ $libraryName }} • Smart Attendance System
</p>

    </footer>

</div>

</body>



<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | Data
    |--------------------------------------------------------------------------
    */

    const students = @json($studentsData);

    /*
|--------------------------------------------------------------------------
| Fullscreen Kiosk
|--------------------------------------------------------------------------
*/

function enterKioskFullscreen()
{
    const element = document.documentElement;

    if (!document.fullscreenElement) {

        element.requestFullscreen()
            .catch(function (error) {

                console.log(
                    'Fullscreen request:',
                    error
                );

            });

    }
}


    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const reader =
        document.getElementById('reader');

    const scannerCard =
        document.getElementById('scannerCard');

    const resultCard =
        document.getElementById('resultCard');

    const errorCard =
        document.getElementById('errorCard');

    const errorMessage =
        document.getElementById('errorMessage');

    const scannerStatus =
        document.getElementById('scannerStatus');

    const connectionStatus =
        document.getElementById('connectionStatus');

        const fullscreenPrompt =
    document.getElementById('fullscreenPrompt');

const startKioskButton =
    document.getElementById('startKioskButton');


    /*
    |--------------------------------------------------------------------------
    | State
    |--------------------------------------------------------------------------
    */

    let scanner = null;

    let processing = false;

  let lastScannedCode = null;
let lastScanTime = 0;
let scanCooldown = 2500;

    /*
|--------------------------------------------------------------------------
| Attendance Sound
|--------------------------------------------------------------------------
*/

function playAttendanceSound(type)
{
    try {

        const AudioContext =
            window.AudioContext ||
            window.webkitAudioContext;

        if (!AudioContext) {
            return;
        }

        const context =
            new AudioContext();

        const oscillator =
            context.createOscillator();

        const gain =
            context.createGain();


        oscillator.connect(gain);

        gain.connect(context.destination);


        if (type === 'checkin') {

            oscillator.frequency.value = 880;

        } else if (type === 'checkout') {

            oscillator.frequency.value = 660;

        } else {

            oscillator.frequency.value = 300;

        }


        oscillator.type = 'sine';


        gain.gain.setValueAtTime(
            0.0001,
            context.currentTime
        );

        gain.gain.exponentialRampToValueAtTime(
            0.25,
            context.currentTime + 0.02
        );

        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            context.currentTime + 0.20
        );


        oscillator.start();

        oscillator.stop(
            context.currentTime + 0.20
        );

    } catch (error) {

        console.log(
            'Attendance sound error:',
            error
        );

    }
}



    /*
    |--------------------------------------------------------------------------
    | Find Student
    |--------------------------------------------------------------------------
    */

    function findStudent(qrValue)
    {

        const value =
            String(qrValue)
                .trim()
                .toLowerCase();


        return students.find(function (student) {

            return String(student.code)
                .trim()
                .toLowerCase() === value;

        });

    }



    /*
    |--------------------------------------------------------------------------
    | Show Error
    |--------------------------------------------------------------------------
    */

    function showError(message)
{
    errorMessage.textContent = message;

    if (scanner) {

        scanner.stop()
            .catch(function (error) {
                console.log(
                    'Scanner stop error:',
                    error
                );
            });

    }

    scannerCard.classList.add('hidden');

    resultCard.classList.add('hidden');

    errorCard.classList.remove('hidden');

    playAttendanceSound('error');

    setTimeout(function () {

        errorCard.classList.add('hidden');

        scannerCard.classList.remove('hidden');

        processing = false;

        startScanner();

    }, 3500);
}

    /*
    |--------------------------------------------------------------------------
    | Show Student Result
    |--------------------------------------------------------------------------
    */

    function showStudent(student)
    {

        document
            .getElementById('studentName')
            .textContent =
            student.name ?? 'Student';


        document
            .getElementById('studentCode')
            .textContent =
            student.code ?? '—';


        document
            .getElementById('studentSeat')
            .textContent =
            student.seat
                ? 'Seat ' + student.seat
                : '—';


        document
            .getElementById('studentShift')
            .textContent =
            student.shift ?? '—';


        const photo =
            document.getElementById('studentPhoto');


        if (student.photo) {

            photo.innerHTML = `
                <img
                    src="/storage/${student.photo}"
                    class="h-full w-full object-cover"
                    alt=""
                >
            `;

        } else {

            photo.textContent =
                student.name
                    ? student.name.charAt(0).toUpperCase()
                    : 'S';

        }


        resultCard.classList.remove('hidden');

    }



  async function processQr(decodedText)
{
    const now = Date.now();

    const scannedCode =
        String(decodedText).trim().toLowerCase();


    /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Scan
    |--------------------------------------------------------------------------
    */

    if (
        scannedCode === lastScannedCode &&
        (now - lastScanTime) < scanCooldown
    ) {
        return;
    }


    lastScannedCode = scannedCode;
    lastScanTime = now;


    /*
    |--------------------------------------------------------------------------
    | Prevent Multiple Processing
    |--------------------------------------------------------------------------
    */

    if (processing) {
        return;
    }

    processing = true;

    const student = findStudent(decodedText);

    if (!student) {

        showError(
'Invalid QR code. Please use your {{ addslashes($libraryName) }} ID card.'
        );

        processing = false;

        return;
    }

    /*
    |--------------------------------------------------------------------------
    | Send QR to Laravel
    |--------------------------------------------------------------------------
    */

    try {

        const response = await fetch(
            "{{ route('attendance.kiosk.scan') }}",
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN':
                        document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content')
                },

                body: JSON.stringify({
                    code: student.code
                })
            }
        );


        const data = await response.json();


        /*
        |--------------------------------------------------------------------------
        | Laravel Error
        |--------------------------------------------------------------------------
        */

        if (!response.ok || !data.success) {

            showError(
                data.message ||
                'Unable to process attendance.'
            );

            processing = false;

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Stop Scanner
        |--------------------------------------------------------------------------
        */

        if (scanner) {

            try {

                await scanner.stop();

            } catch (error) {

                console.log(error);

            }

        }


               /*
        |--------------------------------------------------------------------------
        | Hide Scanner
        |--------------------------------------------------------------------------
        */

        scannerCard.classList.add('hidden');


        /*
        |--------------------------------------------------------------------------
        | Show Student
        |--------------------------------------------------------------------------
        */

        showStudent(
            data.student
        );


        /*
        |--------------------------------------------------------------------------
        | Check-In / Check-Out Message
        |--------------------------------------------------------------------------
        */

        if (data.action === 'checkin') {

            playAttendanceSound('checkin');

            document
                .getElementById('resultIcon')
                .textContent = '✓';

            document
                .getElementById('resultIcon')
                .className =
                'mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-emerald-500/10 text-5xl text-emerald-400';

            document
                .getElementById('resultTitle')
                .textContent =
                'Welcome ' +
                data.student.name;

            document
                .getElementById('resultTitle')
                .className =
                'mt-5 text-3xl font-extrabold text-emerald-400';

            document
                .getElementById('resultMessage')
                .textContent =
                'Check-in recorded at ' +
                data.time;

            document
                .getElementById('resultMessage')
                .className =
                'mt-2 text-lg text-zinc-300';


        } else if (data.action === 'checkout') {

            playAttendanceSound('checkout');

            document
                .getElementById('resultIcon')
                .textContent = '✓';

            document
                .getElementById('resultIcon')
                .className =
                'mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-blue-500/10 text-5xl text-blue-400';

            document
                .getElementById('resultTitle')
                .textContent =
                'Goodbye ' +
                data.student.name;

            document
                .getElementById('resultTitle')
                .className =
                'mt-5 text-3xl font-extrabold text-blue-400';

            document
                .getElementById('resultMessage')
                .textContent =
                'Check-out recorded at ' +
                data.time;

            document
                .getElementById('resultMessage')
                .className =
                'mt-2 text-lg text-zinc-300';

        }


        /*
        |--------------------------------------------------------------------------
        | Show Result
        |--------------------------------------------------------------------------
        */

        resultCard.classList.remove('hidden');


        /*
        |--------------------------------------------------------------------------
        | Reset Scanner
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            resultCard.classList.add('hidden');

            scannerCard.classList.remove('hidden');

            processing = false;

            startScanner();

        }, 3000);


    } catch (error) {

        console.error(error);


        showError(
            'Unable to connect to the attendance server.'
        );


        processing = false;

    }
}


/*
|--------------------------------------------------------------------------
| Start Scanner
|--------------------------------------------------------------------------
*/

async function startScanner()
{
    try {

        /*
        |--------------------------------------------------------------------------
        | Stop Existing Scanner
        |--------------------------------------------------------------------------
        */

        if (scanner) {

            try {
                await scanner.stop();
            } catch (error) {
                console.log('Previous scanner stop:', error);
            }

            scanner.clear();

            scanner = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Reset Status
        |--------------------------------------------------------------------------
        */

        scannerStatus.textContent =
            'Starting camera...';

        scannerStatus.className =
            'text-lg font-semibold text-yellow-400';

        connectionStatus.textContent =
            '● Starting Camera';

        connectionStatus.className =
            'rounded-full bg-yellow-500/10 px-4 py-2 text-sm font-semibold text-yellow-400';


        /*
        |--------------------------------------------------------------------------
        | Get Available Cameras
        |--------------------------------------------------------------------------
        */

        const cameras =
            await Html5Qrcode.getCameras();


        if (!cameras || cameras.length === 0) {

            throw new Error(
                'No camera found on this device.'
            );

        }


        console.log('Available cameras:', cameras);


        /*
        |--------------------------------------------------------------------------
        | Select Camera
        |--------------------------------------------------------------------------
        */

        let cameraId =
            cameras[0].id;


        /*
        |--------------------------------------------------------------------------
        | Prefer Back Camera
        |--------------------------------------------------------------------------
        */

        const backCamera =
            cameras.find(function (camera) {

                const label =
                    (camera.label || '').toLowerCase();

                return (
                    label.includes('back') ||
                    label.includes('rear') ||
                    label.includes('environment')
                );

            });


        if (backCamera) {

            cameraId =
                backCamera.id;

        }


        console.log(
            'Selected camera:',
            cameraId
        );


        /*
        |--------------------------------------------------------------------------
        | Create Scanner
        |--------------------------------------------------------------------------
        */

        scanner =
            new Html5Qrcode('reader');


        /*
        |--------------------------------------------------------------------------
        | Start Camera
        |--------------------------------------------------------------------------
        */

        await scanner.start(

            cameraId,

            {
                fps: 10,

                qrbox: {
                    width: 240,
                    height: 240
                },

                aspectRatio: 1.0
            },

            processQr,

            function () {
                // Ignore continuous QR scan failures.
            }

        );


        /*
        |--------------------------------------------------------------------------
        | Camera Ready
        |--------------------------------------------------------------------------
        */

        scannerStatus.textContent =
            'Ready — Scan your ID card';

        scannerStatus.className =
            'text-lg font-semibold text-emerald-400';


        connectionStatus.textContent =
            '● Camera Ready';

        connectionStatus.className =
            'rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-semibold text-emerald-400';


        console.log(
            'Attendance camera started successfully.'
        );

    }
    catch (error) {

        console.error(
            'Attendance camera error:',
            error
        );


        scannerStatus.textContent =
            'Camera could not be started';

        scannerStatus.className =
            'text-lg font-semibold text-red-400';


        connectionStatus.textContent =
            '● Camera Error';

        connectionStatus.className =
            'rounded-full bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-400';


        showError(
            error.message ||
            'Camera could not be started. Please allow camera access.'
        );

    }
}



/*
|--------------------------------------------------------------------------
| Start Kiosk
|--------------------------------------------------------------------------
*/

startKioskButton.addEventListener(
    'click',
    async function () {

        try {

            await document.documentElement.requestFullscreen();

        } catch (error) {

            console.log(
                'Fullscreen unavailable:',
                error
            );

        }

        fullscreenPrompt.classList.add('hidden');

    }
);


/*
|--------------------------------------------------------------------------
| Start Attendance Kiosk
|--------------------------------------------------------------------------
*/

startScanner();

});

</script>


</body>
</html>

 