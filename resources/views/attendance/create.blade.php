<x-layouts::app :title="'QR Attendance'">

<div class="w-full px-6 py-8 lg:px-10">

    {{-- Header --}}
    <div class="mb-8 flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">

        <div>
            <flux:heading size="xl" class="text-3xl font-bold">
                QR Attendance
            </flux:heading>

            <flux:text class="mt-2 text-base text-zinc-400">
                Scan the student's ID card QR code to record attendance.
            </flux:text>
        </div>

        <a
            href="{{ route('attendance.index') }}"
            wire:navigate
            class="inline-flex items-center justify-center rounded-xl border border-zinc-700 bg-zinc-900 px-5 py-3 text-sm font-semibold text-zinc-200 transition hover:bg-zinc-800"
        >
            ← Back to Attendance
        </a>

    </div>


    {{-- Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-xl border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm text-red-400">

            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>

    @endif


    {{-- Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-5 py-4 text-sm text-emerald-400">

            {{ session('success') }}

        </div>

    @endif


    <div class="grid gap-6 lg:grid-cols-2">


        {{-- ===================================================== --}}
        {{-- QR SCANNER --}}
        {{-- ===================================================== --}}

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-white">
                    Scan Student QR
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Point the camera at the QR code printed on the student's ID card.
                </p>

            </div>


            {{-- Scanner Area --}}
            <div
                id="qrScanner"
                class="relative mx-auto aspect-square w-full max-w-md overflow-hidden rounded-2xl border border-zinc-700 bg-black"
            >

                <video
                    id="qrVideo"
                    class="h-full w-full object-cover"
                    playsinline
                ></video>


                {{-- Scanner Frame --}}
                <div class="pointer-events-none absolute inset-0 flex items-center justify-center">

                    <div class="relative h-56 w-56">

                        <div class="absolute left-0 top-0 h-10 w-10 border-l-4 border-t-4 border-yellow-400"></div>

                        <div class="absolute right-0 top-0 h-10 w-10 border-r-4 border-t-4 border-yellow-400"></div>

                        <div class="absolute bottom-0 left-0 h-10 w-10 border-b-4 border-l-4 border-yellow-400"></div>

                        <div class="absolute bottom-0 right-0 h-10 w-10 border-b-4 border-r-4 border-yellow-400"></div>

                        <div
                            id="scanLine"
                            class="absolute left-2 right-2 top-1/2 h-0.5 bg-yellow-400 shadow-[0_0_12px_rgba(250,204,21,0.9)]"
                        ></div>

                    </div>

                </div>


                {{-- Camera Message --}}
                <div
                    id="cameraMessage"
                    class="absolute inset-0 flex items-center justify-center bg-zinc-950/90 px-6 text-center"
                >

                    <div>

                        <div class="text-4xl">
                            📷
                        </div>

                        <p class="mt-3 font-semibold text-white">
                            Camera is not started
                        </p>

                        <p class="mt-1 text-sm text-zinc-500">
                            Click Start Camera to begin scanning.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Scanner Status --}}
            <div class="mt-5 text-center">

                <div
                    id="scannerStatus"
                    class="inline-flex rounded-full bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-400"
                >
                    Camera Off
                </div>

            </div>


            {{-- Buttons --}}
            <div class="mt-5 flex flex-col gap-3 sm:flex-row">

                <button
                    type="button"
                    id="startCamera"
                    class="flex-1 rounded-xl bg-yellow-400 px-5 py-3 font-bold text-black transition hover:bg-yellow-300"
                >
                    📷 Start Camera
                </button>


                <button
                    type="button"
                    id="stopCamera"
                    class="hidden flex-1 rounded-xl border border-zinc-700 bg-zinc-800 px-5 py-3 font-bold text-white transition hover:bg-zinc-700"
                >
                    Stop Camera
                </button>

            </div>


            <div
                id="scanError"
                class="mt-4 hidden rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-400"
            ></div>

        </div>


        {{-- ===================================================== --}}
        {{-- MANUAL BACKUP --}}
        {{-- ===================================================== --}}

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-white">
                    Manual Check-In
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    If the QR code cannot be scanned, search for the student manually.
                </p>

            </div>


            <div class="relative">

                <input
                    type="text"
                    id="studentSearch"
                    placeholder="Search name, student code or mobile..."
                    autocomplete="off"
                    class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-5 py-4 text-base text-white outline-none placeholder:text-zinc-500 focus:border-yellow-400 focus:ring-1 focus:ring-yellow-400"
                >


                <div
                    id="searchResults"
                    class="absolute left-0 right-0 top-full z-20 mt-2 hidden max-h-80 overflow-y-auto rounded-xl border border-zinc-700 bg-zinc-900 shadow-2xl"
                ></div>

            </div>


            {{-- Selected Student --}}
            <div
                id="studentDetails"
                class="mt-6 hidden rounded-2xl border border-zinc-700 bg-zinc-800/50 p-5"
            >

                <div class="flex items-center gap-4">

                    <div
                        id="studentPhoto"
                        class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-zinc-700 text-xl font-bold text-yellow-400"
                    >
                        S
                    </div>


                    <div class="min-w-0">

                        <div
                            id="studentName"
                            class="text-lg font-semibold text-white"
                        >
                            —
                        </div>

                        <div
                            id="studentCode"
                            class="mt-1 text-sm font-medium text-yellow-400"
                        >
                            —
                        </div>

                    </div>

                </div>


                <div class="mt-5 grid grid-cols-2 gap-3">

                    <div class="rounded-xl bg-zinc-900 p-3">

                        <div class="text-xs text-zinc-500">
                            Membership
                        </div>

                        <div
                            id="membershipName"
                            class="mt-1 text-sm font-semibold text-white"
                        >
                            —
                        </div>

                    </div>


                    <div class="rounded-xl bg-zinc-900 p-3">

                        <div class="text-xs text-zinc-500">
                            Shift
                        </div>

                        <div
                            id="studentShift"
                            class="mt-1 text-sm font-semibold text-yellow-400"
                        >
                            —
                        </div>

                    </div>


                    <div class="rounded-xl bg-zinc-900 p-3">

                        <div class="text-xs text-zinc-500">
                            Seat
                        </div>

                        <div
                            id="studentSeat"
                            class="mt-1 text-sm font-semibold text-white"
                        >
                            —
                        </div>

                    </div>


                    <div class="rounded-xl bg-zinc-900 p-3">

                        <div class="text-xs text-zinc-500">
                            Room
                        </div>

                        <div
                            id="studentRoom"
                            class="mt-1 text-sm font-semibold text-white"
                        >
                            —
                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('attendance.check-in') }}"
                    class="mt-5"
                >

                    @csrf

                    <input
                        type="hidden"
                        name="student_id"
                        id="studentId"
                    >


                    <button
                        type="submit"
                        class="w-full rounded-xl bg-yellow-400 px-5 py-3 font-bold text-black transition hover:bg-yellow-300"
                    >
                        ✓ Check In Student
                    </button>

                </form>

            </div>


            {{-- Empty State --}}
            <div
                id="manualEmpty"
                class="mt-8 rounded-xl border border-dashed border-zinc-700 px-5 py-10 text-center"
            >

                <div class="text-3xl">
                    🔎
                </div>

                <p class="mt-3 text-sm font-medium text-zinc-300">
                    Search for a student
                </p>

                <p class="mt-1 text-xs text-zinc-500">
                    Students with active seat assignments are available.
                </p>

            </div>

        </div>

    </div>

</div>


{{-- ============================================================= --}}
{{-- QR SCANNER SCRIPT --}}
{{-- ============================================================= --}}

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const students = @json($studentsData);

    const startButton = document.getElementById('startCamera');
    const stopButton = document.getElementById('stopCamera');

    const scannerStatus = document.getElementById('scannerStatus');
    const cameraMessage = document.getElementById('cameraMessage');
    const scanError = document.getElementById('scanError');

    const searchInput = document.getElementById('studentSearch');
    const resultsBox = document.getElementById('searchResults');

    const detailsBox = document.getElementById('studentDetails');
    const manualEmpty = document.getElementById('manualEmpty');

    const studentId = document.getElementById('studentId');

    let html5QrCode = null;
    let scannerRunning = false;
    let processingScan = false;


    /*
    |--------------------------------------------------------------------------
    | Find Student By QR Value
    |--------------------------------------------------------------------------
    */

    function findStudentByQr(value) {

        const qrValue = String(value ?? '').trim().toLowerCase();

        return students.find(student => {

            return String(student.code ?? '')
                .trim()
                .toLowerCase() === qrValue;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Show Student
    |--------------------------------------------------------------------------
    */

    function showStudent(student) {

        if (!student) {
            return;
        }


        studentId.value = student.id;


        document.getElementById('studentName').textContent =
            student.name ?? '—';


        document.getElementById('studentCode').textContent =
            student.code ?? '—';


        document.getElementById('membershipName').textContent =
            student.membership ?? '—';


        document.getElementById('studentShift').textContent =
            student.shift ?? '—';


        document.getElementById('studentSeat').textContent =
            student.seat
                ? 'Seat ' + student.seat
                : '—';


        document.getElementById('studentRoom').textContent =
            student.room ?? '—';


        const photoBox =
            document.getElementById('studentPhoto');


        if (student.photo) {

            photoBox.innerHTML = `
                <img
                    src="/storage/${student.photo}"
                    alt=""
                    class="h-full w-full object-cover"
                >
            `;

        } else {

            photoBox.textContent =
                student.name
                    ? student.name.charAt(0).toUpperCase()
                    : 'S';

        }


        detailsBox.classList.remove('hidden');

        manualEmpty.classList.add('hidden');

        searchInput.value = student.name ?? '';

        resultsBox.classList.add('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | Scanner Success
    |--------------------------------------------------------------------------
    */

    async function onScanSuccess(decodedText) {

        if (processingScan) {
            return;
        }

        processingScan = true;


        const student = findStudentByQr(decodedText);


        if (!student) {

            scanError.textContent =
                'Invalid QR code. This QR does not belong to an active library student.';

            scanError.classList.remove('hidden');

            processingScan = false;

            return;
        }


        scanError.classList.add('hidden');


        showStudent(student);


        /*
        |--------------------------------------------------------------------------
        | Stop Camera After Successful Scan
        |--------------------------------------------------------------------------
        */

        if (scannerRunning) {

            try {

                await html5QrCode.stop();

                scannerRunning = false;

                stopButton.classList.add('hidden');

                startButton.classList.remove('hidden');

                cameraMessage.classList.remove('hidden');

                scannerStatus.textContent = 'Student Found';

                scannerStatus.className =
                    'inline-flex rounded-full bg-emerald-500/10 px-4 py-2 text-sm font-medium text-emerald-400';

            } catch (error) {

                console.error(error);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Reset Processing
        |--------------------------------------------------------------------------
        */

        setTimeout(function () {

            processingScan = false;

        }, 1500);

    }


    /*
    |--------------------------------------------------------------------------
    | Scanner Error
    |--------------------------------------------------------------------------
    */

    function onScanFailure(errorMessage) {

        /*
         * QR scanner continuously reports failed frames.
         * We intentionally do nothing here.
         */

    }


    /*
    |--------------------------------------------------------------------------
    | Start Camera
    |--------------------------------------------------------------------------
    */

    startButton.addEventListener('click', async function () {

        scanError.classList.add('hidden');


        if (scannerRunning) {
            return;
        }


        try {

            html5QrCode = new Html5Qrcode('qrScanner');


            await html5QrCode.start(

                {
                    facingMode: 'environment'
                },

                {
                    fps: 10,

                    qrbox: {
                        width: 220,
                        height: 220
                    }

                },

                onScanSuccess,

                onScanFailure

            );


            scannerRunning = true;


            cameraMessage.classList.add('hidden');

            startButton.classList.add('hidden');

            stopButton.classList.remove('hidden');


            scannerStatus.textContent =
                'Camera Active — Scan QR Code';

            scannerStatus.className =
                'inline-flex rounded-full bg-yellow-500/10 px-4 py-2 text-sm font-medium text-yellow-400';


        } catch (error) {

            console.error(error);


            scanError.textContent =
                'Unable to access the camera. Please allow camera permission and try again.';

            scanError.classList.remove('hidden');


            scannerStatus.textContent =
                'Camera Error';

            scannerStatus.className =
                'inline-flex rounded-full bg-red-500/10 px-4 py-2 text-sm font-medium text-red-400';

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Stop Camera
    |--------------------------------------------------------------------------
    */

    stopButton.addEventListener('click', async function () {

        if (!html5QrCode || !scannerRunning) {
            return;
        }


        try {

            await html5QrCode.stop();

            scannerRunning = false;


            cameraMessage.classList.remove('hidden');

            stopButton.classList.add('hidden');

            startButton.classList.remove('hidden');


            scannerStatus.textContent =
                'Camera Off';

            scannerStatus.className =
                'inline-flex rounded-full bg-zinc-800 px-4 py-2 text-sm font-medium text-zinc-400';

        } catch (error) {

            console.error(error);

        }

    });


    /*
    |--------------------------------------------------------------------------
    | Manual Search
    |--------------------------------------------------------------------------
    */

    function renderResults(query) {

        resultsBox.innerHTML = '';


        if (!query.trim()) {

            resultsBox.classList.add('hidden');

            return;

        }


        const search = query.toLowerCase().trim();


        const matches = students.filter(student => {

            return (

                String(student.name ?? '')
                    .toLowerCase()
                    .includes(search)

                ||

                String(student.code ?? '')
                    .toLowerCase()
                    .includes(search)

                ||

                String(student.mobile ?? '')
                    .includes(search)

            );

        });


        if (!matches.length) {

            resultsBox.innerHTML = `
                <div class="px-5 py-5 text-sm text-zinc-500">
                    No matching student found.
                </div>
            `;

            resultsBox.classList.remove('hidden');

            return;

        }


        matches.forEach(student => {

            const item =
                document.createElement('button');


            item.type = 'button';


            item.className =
                'flex w-full items-center gap-4 border-b border-zinc-800 px-5 py-4 text-left transition last:border-b-0 hover:bg-zinc-800';


            const initial = student.name
                ? student.name.charAt(0).toUpperCase()
                : 'S';


            item.innerHTML = `

                <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-full bg-zinc-800 text-sm font-bold text-yellow-400">

                    ${
                        student.photo
                            ? `<img
                                src="/storage/${student.photo}"
                                class="h-full w-full object-cover"
                                alt=""
                            >`
                            : initial
                    }

                </div>


                <div class="min-w-0 flex-1">

                    <div class="font-medium text-white">
                        ${student.name ?? 'Unknown Student'}
                    </div>

                    <div class="mt-1 text-xs text-zinc-500">
                        ${student.code ?? '—'} · ${student.mobile ?? 'No mobile'}
                    </div>

                </div>


                <div class="text-right">

                    <div class="text-xs font-medium text-yellow-400">
                        ${student.shift ?? '—'}
                    </div>

                    <div class="mt-1 text-xs text-zinc-500">
                        Seat ${student.seat ?? '—'}
                    </div>

                </div>

            `;


            item.addEventListener('click', function () {

                showStudent(student);

            });


            resultsBox.appendChild(item);

        });


        resultsBox.classList.remove('hidden');

    }


    searchInput.addEventListener('input', function () {

        renderResults(this.value);

    });


    /*
    |--------------------------------------------------------------------------
    | Close Search Results
    |--------------------------------------------------------------------------
    */

    document.addEventListener('click', function (event) {

        if (
            !searchInput.contains(event.target)
            &&
            !resultsBox.contains(event.target)
        ) {

            resultsBox.classList.add('hidden');

        }

    });


});

</script>

</x-layouts::app>