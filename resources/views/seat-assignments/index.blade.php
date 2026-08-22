<x-layouts::app :title="'Seat Management'">

<div
    class="seat-page"
    x-data="seatManager()"
>

    {{-- Header --}}
    
            <div class="seat-header">

    <div class="seat-header-left">

        <div>

            <h1>
                Interactive Seat Management
            </h1>

            <p>
                Assign, change and manage library seats from one screen.
            </p>

        </div>

    </div>

    <div class="seat-header-right flex items-center gap-3">

        <input
            type="text"
            placeholder="Search Student, Seat, Mobile..."
            class="seat-search"
        >

       

        {{-- List View --}}
        <a
            href="{{ route('seat-assignments.index') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-zinc-700 px-5 py-3 text-sm font-semibold text-zinc-300 transition hover:bg-zinc-800 hover:text-white"
        >
            List View
        </a>

    </div>

</div>



      
    
{{-- Stats --}}
@include('seat-assignments.partials.stats-cards')


    {{-- Main Layout --}}
    <div class="seat-main-grid">

        <div>

            @include('seat-assignments.partials.library-layout')

        </div>

        <div>

            @include('seat-assignments.partials.seat-information')

        </div>

    </div>



   {{-- Bottom Legend --}}
@include('seat-assignments.partials.legend')

{{-- Assign Seat Modal --}}
@include('seat-assignments.partials.assign-seat-modal')

</div>

<script>

(function () {

    function initSeatPage() {

        const seats = document.querySelectorAll('.seat-card');

        if (!seats.length) {
            return;
        }

        seats.forEach(function (seat) {

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Click Events
            |--------------------------------------------------------------------------
            */

            if (seat.dataset.clickInitialized === 'true') {
                return;
            }

            seat.dataset.clickInitialized = 'true';


            /*
            |--------------------------------------------------------------------------
            | Seat Click
            |--------------------------------------------------------------------------
            */

            seat.addEventListener('click', function (event) {

                event.preventDefault();

                event.stopPropagation();


                const currentSeat = this;


                /*
                |--------------------------------------------------------------------------
                | Basic Seat Information
                |--------------------------------------------------------------------------
                */

                const infoSeatNumber =
                    document.getElementById('info-seat-number');

                if (infoSeatNumber) {

                    infoSeatNumber.textContent =
                        currentSeat.dataset.seatNumber || '--';

                }


                /*
                |--------------------------------------------------------------------------
                | Hide All Shift Sections
                |--------------------------------------------------------------------------
                */

                const morningInfo =
                    document.getElementById('morning-info');

                const eveningInfo =
                    document.getElementById('evening-info');

                const fullDayInfo =
                    document.getElementById('full-day-info');


                if (morningInfo) {
                    morningInfo.classList.add('hidden');
                }

                if (eveningInfo) {
                    eveningInfo.classList.add('hidden');
                }

                if (fullDayInfo) {
                    fullDayInfo.classList.add('hidden');
                }


                /*
                |--------------------------------------------------------------------------
                | Morning Information
                |--------------------------------------------------------------------------
                */

                if (
                    currentSeat.dataset.morningStudent &&
                    morningInfo
                ) {

                    morningInfo.classList.remove('hidden');

                    const student =
                        document.getElementById('morning-student');

                    const mobile =
                        document.getElementById('morning-mobile');

                    const plan =
                        document.getElementById('morning-plan');

                    const start =
                        document.getElementById('morning-start');

                    const expiry =
                        document.getElementById('morning-expiry');


                    if (student) {
                        student.textContent =
                            currentSeat.dataset.morningStudent;
                    }

                    if (mobile) {
                        mobile.textContent =
                            currentSeat.dataset.morningMobile || '--';
                    }

                    if (plan) {
                        plan.textContent =
                            currentSeat.dataset.morningPlan || '--';
                    }

                    if (start) {
                        start.textContent =
                            currentSeat.dataset.morningStart || '--';
                    }

                    if (expiry) {
                        expiry.textContent =
                            currentSeat.dataset.morningExpiry || '--';
                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Evening Information
                |--------------------------------------------------------------------------
                */

                if (
                    currentSeat.dataset.eveningStudent &&
                    eveningInfo
                ) {

                    eveningInfo.classList.remove('hidden');

                    const student =
                        document.getElementById('evening-student');

                    const mobile =
                        document.getElementById('evening-mobile');

                    const plan =
                        document.getElementById('evening-plan');

                    const start =
                        document.getElementById('evening-start');

                    const expiry =
                        document.getElementById('evening-expiry');


                    if (student) {
                        student.textContent =
                            currentSeat.dataset.eveningStudent;
                    }

                    if (mobile) {
                        mobile.textContent =
                            currentSeat.dataset.eveningMobile || '--';
                    }

                    if (plan) {
                        plan.textContent =
                            currentSeat.dataset.eveningPlan || '--';
                    }

                    if (start) {
                        start.textContent =
                            currentSeat.dataset.eveningStart || '--';
                    }

                    if (expiry) {
                        expiry.textContent =
                            currentSeat.dataset.eveningExpiry || '--';
                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Full Day Information
                |--------------------------------------------------------------------------
                */

                if (
                    currentSeat.dataset.fullDayStudent &&
                    fullDayInfo
                ) {

                    fullDayInfo.classList.remove('hidden');

                    const student =
                        document.getElementById('full-day-student');

                    const mobile =
                        document.getElementById('full-day-mobile');

                    const plan =
                        document.getElementById('full-day-plan');

                    const start =
                        document.getElementById('full-day-start');

                    const expiry =
                        document.getElementById('full-day-expiry');


                    if (student) {
                        student.textContent =
                            currentSeat.dataset.fullDayStudent;
                    }

                    if (mobile) {
                        mobile.textContent =
                            currentSeat.dataset.fullDayMobile || '--';
                    }

                    if (plan) {
                        plan.textContent =
                            currentSeat.dataset.fullDayPlan || '--';
                    }

                    if (start) {
                        start.textContent =
                            currentSeat.dataset.fullDayStart || '--';
                    }

                    if (expiry) {
                        expiry.textContent =
                            currentSeat.dataset.fullDayExpiry || '--';
                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Seat Status
                |--------------------------------------------------------------------------
                */

                const statusElement =
                    document.getElementById('info-status');

                const seatStatus =
                    currentSeat.dataset.seatStatus || 'available';


                if (statusElement) {

                    if (seatStatus === 'available') {

                        statusElement.textContent =
                            'Available';

                        statusElement.className =
                            'inline-flex rounded-full bg-emerald-500/20 px-5 py-2 text-sm font-bold uppercase tracking-wider text-emerald-400';

                    }

                    else if (seatStatus === 'partial') {

                        statusElement.textContent =
                            'Partially Occupied';

                        statusElement.className =
                            'inline-flex rounded-full bg-amber-500/20 px-5 py-2 text-sm font-bold uppercase tracking-wider text-amber-400';

                    }

                    else if (seatStatus === 'occupied') {

                        statusElement.textContent =
                            'Fully Occupied';

                        statusElement.className =
                            'inline-flex rounded-full bg-red-500/20 px-5 py-2 text-sm font-bold uppercase tracking-wider text-red-400';

                    }

                    else if (seatStatus === 'maintenance') {

                        statusElement.textContent =
                            'Maintenance';

                        statusElement.className =
                            'inline-flex rounded-full bg-zinc-500/20 px-5 py-2 text-sm font-bold uppercase tracking-wider text-zinc-400';

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Action Elements
                |--------------------------------------------------------------------------
                */

                const actionBox =
                    document.getElementById('seat-actions');

                const occupiedActions =
                    document.getElementById('occupiedActions');

                const assignBtn =
                    document.getElementById('assignSeatBtn');

                const changeSeatBtn =
                    document.getElementById('changeSeatBtn');

                const releaseForm =
                    document.getElementById('releaseSeatForm');


                /*
                |--------------------------------------------------------------------------
                | Show Action Box
                |--------------------------------------------------------------------------
                */

                if (actionBox) {
                    actionBox.classList.remove('hidden');
                }


                /*
                |--------------------------------------------------------------------------
                | Assignment ID
                |--------------------------------------------------------------------------
                */

                const assignmentId =
                    currentSeat.dataset.assignmentId || '';


                /*
                |--------------------------------------------------------------------------
                | Release Seat
                |--------------------------------------------------------------------------
                */

                if (releaseForm) {

                    if (assignmentId) {

                        releaseForm.action =
                            `/seat-assignments/${assignmentId}/release`;

                        releaseForm.classList.remove('hidden');

                    }

                    else {

                        releaseForm.action = '#';

                        releaseForm.classList.add('hidden');

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Assign Button
                |--------------------------------------------------------------------------
                */

                if (assignBtn) {

                    assignBtn.onclick = function (event) {

                        event.preventDefault();

                        event.stopPropagation();

                        openAssignSeatModal(
                            currentSeat.dataset.seatId,
                            currentSeat.dataset.seatNumber
                        );

                    };

                }


                /*
                |--------------------------------------------------------------------------
                | Change Seat Button
                |--------------------------------------------------------------------------
                */

                if (changeSeatBtn) {

                    changeSeatBtn.onclick = function (event) {

                        event.preventDefault();

                        event.stopPropagation();


                        const id =
                            currentSeat.dataset.assignmentId;


                        if (!id) {

                            alert(
                                'Active seat assignment not found.'
                            );

                            return;

                        }


                        window.location.href =
                            `/seat-assignments/${id}/change`;

                    };

                }


                /*
                |--------------------------------------------------------------------------
                | Seat Status Actions
                |--------------------------------------------------------------------------
                */

                if (seatStatus === 'available') {

                    if (assignBtn) {
                        assignBtn.classList.remove('hidden');
                    }

                    if (occupiedActions) {
                        occupiedActions.classList.add('hidden');
                    }

                }

                else if (seatStatus === 'partial') {

                    if (assignBtn) {
                        assignBtn.classList.remove('hidden');
                    }

                    if (occupiedActions) {
                        occupiedActions.classList.remove('hidden');
                    }

                }

                else if (seatStatus === 'occupied') {

                    if (assignBtn) {
                        assignBtn.classList.add('hidden');
                    }

                    if (occupiedActions) {
                        occupiedActions.classList.remove('hidden');
                    }

                }

                else {

                    if (assignBtn) {
                        assignBtn.classList.add('hidden');
                    }

                    if (occupiedActions) {
                        occupiedActions.classList.add('hidden');
                    }

                }

            });

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Load
    |--------------------------------------------------------------------------
    */

    initSeatPage();


    /*
    |--------------------------------------------------------------------------
    | Live Navigation / Page Navigation
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'livewire:navigated',
        function () {

            setTimeout(function () {

                initSeatPage();

            }, 50);

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Fallback Navigation Event
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'turbo:load',
        function () {

            setTimeout(function () {

                initSeatPage();

            }, 50);

        }
    );


})();

</script>

<script>

function openAssignSeatModal(seatId, seatNumber)
{
    document.getElementById('modalSeatNumber').value = seatNumber;

    document.getElementById('seatId').value = seatId;

    const modal = document.getElementById('assignSeatModal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeAssignSeatModal()
{
    const modal = document.getElementById('assignSeatModal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

</script>

<style>
/* =========================================================
   SEAT MANAGEMENT PAGE
========================================================= */

.seat-page {
    width: 100%;
    max-width: 100%;
    padding: 28px;
    box-sizing: border-box;
    color: #fff;
}

/* =========================================================
   HEADER
========================================================= */

.seat-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 28px;
}

.seat-header-left h1 {
    margin: 0;
    font-size: 30px;
    line-height: 1.2;
    font-weight: 700;
    color: #fff;
}

.seat-header-left p {
    margin: 8px 0 0;
    color: #a1a1aa;
    font-size: 14px;
}

.seat-header-right {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.seat-search {
    width: 300px;
    height: 44px;
    padding: 0 16px;
    border: 1px solid #3f3f46;
    border-radius: 12px;
    background: #18181b;
    color: #fff;
    outline: none;
}

.seat-search:focus {
    border-color: #6366f1;
}

.seat-search::placeholder {
    color: #71717a;
}


/* =========================================================
   STATS
========================================================= */

.seat-stats {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 14px;
    width: 100%;
    margin-bottom: 28px;
}

.seat-stat-card {
    min-height: 105px;
    padding: 20px;
    border: 1px solid #3f3f46;
    border-radius: 16px;
    background: #18181b;
    display: flex;
    flex-direction: column;
    justify-content: center;
    box-sizing: border-box;
}

.seat-stat-value {
    font-size: 28px;
    line-height: 1;
    font-weight: 700;
    color: #fff;
}

.seat-stat-label {
    margin-top: 9px;
    font-size: 13px;
    color: #a1a1aa;
}

.seat-stat-card.total {
    border-color: #52525b;
}

.seat-stat-card.available {
    border-color: #059669;
    background: rgba(5, 150, 105, 0.08);
}

.seat-stat-card.available .seat-stat-value {
    color: #10b981;
}

.seat-stat-card.occupied {
    border-color: #dc2626;
    background: rgba(220, 38, 38, 0.08);
}

.seat-stat-card.occupied .seat-stat-value {
    color: #ef4444;
}

.seat-stat-card.morning {
    border-color: #16a34a;
    background: rgba(22, 163, 74, 0.08);
}

.seat-stat-card.morning .seat-stat-value {
    color: #22c55e;
}

.seat-stat-card.evening {
    border-color: #ea580c;
    background: rgba(234, 88, 12, 0.08);
}

.seat-stat-card.evening .seat-stat-value {
    color: #f97316;
}

.seat-stat-card.full {
    border-color: #4f46e5;
    background: rgba(79, 70, 229, 0.08);
}

.seat-stat-card.full .seat-stat-value {
    color: #818cf8;
}


/* =========================================================
   MAIN CONTENT
========================================================= */

.seat-main-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 340px;
    gap: 18px;
    align-items: start;
    width: 100%;
}


/* =========================================================
   LIBRARY MAP
========================================================= */

.library-layout-card {
    width: 100%;
    border: 1px solid #3f3f46;
    border-radius: 20px;
    background: #18181b;
    overflow: hidden;
}

.library-layout-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 22px;
    border-bottom: 1px solid #27272a;
}

.library-layout-header h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #fff;
}

.library-layout-header p {
    margin: 5px 0 0;
    color: #71717a;
    font-size: 13px;
}

.library-layout-body {
    padding: 22px;
    overflow-x: auto;
}


/* =========================================================
   SEAT GRID
========================================================= */
.seat-map-grid {
    display: grid;
    grid-template-columns: repeat(10, minmax(0, 1fr));
    gap: 8px;
    width: 100%;
    margin-bottom: 24px;
    min-width: 0;
}

.seat-card {
    position: relative;
    width: 100%;
    min-width: 52px;
    height: 72px;
    padding: 8px 5px;
    border: 1px solid #52525b;
    border-radius: 12px;
    background: #27272a;
    color: #fff;
    cursor: pointer;
    transition: all 0.18s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.seat-card:hover {
    transform: translateY(-2px);
    border-color: #818cf8;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

.seat-card.available {
    border-color: #3f3f46;
    background: #18181b;
}

.seat-card.occupied {
    border-color: #ef4444;
    background: rgba(239, 68, 68, 0.10);
}

.seat-card.maintenance {
    border-color: #eab308;
    background: rgba(234, 179, 8, 0.10);
}

.seat-number {
    font-size: 13px;
    font-weight: 700;
    line-height: 1;
}

.seat-status-dot {
    position: absolute;
    top: 6px;
    right: 6px;
    width: 6px;
    height: 6px;
    border-radius: 999px;
    background: #22c55e;
}

.seat-card.occupied .seat-status-dot {
    background: #ef4444;
}

.seat-card.maintenance .seat-status-dot {
    background: #eab308;
}


/* =========================================================
   SEAT INFORMATION
========================================================= */

.seat-main-grid > div:last-child {
    position: sticky;
    top: 24px;
}

.seat-main-grid > div:last-child > * {
    width: 100%;
    box-sizing: border-box;
}


/* =========================================================
   LEGEND
========================================================= */

.seat-page .seat-legend,
.seat-page .legend {
    margin-top: 22px;
}


/* =========================================================
   ASSIGN SEAT MODAL
========================================================= */

/*
   IMPORTANT:
   Modal ko sidebar/content ke andar confined nahi hone dena.
*/

#assignSeatModal {
    position: fixed !important;
    inset: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    max-width: none !important;
    max-height: none !important;

    margin: 0 !important;
    padding: 24px !important;

    display: none;
    align-items: center !important;
    justify-content: center !important;

    background: rgba(0, 0, 0, 0.78) !important;

    z-index: 999999 !important;

    box-sizing: border-box !important;
}

#assignSeatModal.flex {
    display: flex !important;
}

#assignSeatModal.hidden {
    display: none !important;
}


/*
   Modal ke andar actual form/card
*/

#assignSeatModal > div {
    width: min(680px, calc(100vw - 48px)) !important;
    max-width: 680px !important;

    max-height: calc(100vh - 48px) !important;

    overflow-y: auto !important;
    overflow-x: hidden !important;

    margin: auto !important;

    border-radius: 20px !important;
    box-sizing: border-box !important;
}


/* Modal scrollbar */

#assignSeatModal > div::-webkit-scrollbar {
    width: 7px;
}

#assignSeatModal > div::-webkit-scrollbar-track {
    background: #18181b;
}

#assignSeatModal > div::-webkit-scrollbar-thumb {
    background: #52525b;
    border-radius: 20px;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 1200px) {

    .seat-stats {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .seat-main-grid {
        grid-template-columns: 1fr;
    }

    .seat-main-grid > div:last-child {
        position: static;
    }
}


@media (max-width: 768px) {

    .seat-page {
        padding: 18px;
    }

    .seat-header {
        flex-direction: column;
        align-items: stretch;
    }

    .seat-header-right {
        width: 100%;
    }

    .seat-search {
        width: 100%;
    }

    .seat-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .seat-map-grid {
        grid-template-columns: repeat(8, minmax(42px, 1fr));
    }

    #assignSeatModal {
        padding: 12px !important;
    }

    #assignSeatModal > div {
        width: calc(100vw - 24px) !important;
        max-height: calc(100vh - 24px) !important;
    }
}


@media (max-width: 480px) {

    .seat-page {
        padding: 14px;
    }

    .seat-stats {
        grid-template-columns: 1fr;
    }

    .seat-header-left h1 {
        font-size: 24px;
    }
}


/* =========================================================
   PREMIUM FULL DAY SEAT
========================================================= */

.seat-card.full-day-seat {
    position: relative;

    background: linear-gradient(
        145deg,
        rgba(239, 68, 68, 0.22),
        rgba(127, 29, 29, 0.40)
    ) !important;

    border: 2px solid #ef4444 !important;

    box-shadow:
        0 0 0 1px rgba(239, 68, 68, 0.20),
        0 0 18px rgba(239, 68, 68, 0.20),
        inset 0 0 12px rgba(239, 68, 68, 0.10);

    transform: translateY(-1px);
}


/* Full Day status dot */

.seat-card.full-day-seat .seat-status-dot {
    background: #ef4444 !important;

    box-shadow:
        0 0 8px rgba(239, 68, 68, 0.85);
}


/* Full Day F badge */

.seat-card.full-day-seat .mt-2 span {
    display: flex !important;

    align-items: center;
    justify-content: center;

    width: 32px;
    height: 24px;

    margin-top: 6px;

    border-radius: 6px;

    background: #ef4444 !important;
    color: #ffffff !important;

    font-size: 13px !important;
    font-weight: 900 !important;

    box-shadow:
        0 3px 10px rgba(239, 68, 68, 0.40);
}


/* Full Day seat number */

.seat-card.full-day-seat .seat-number {
    color: #ffffff !important;
    font-weight: 800 !important;
}


/* Hover */

.seat-card.full-day-seat:hover {
    background: linear-gradient(
        145deg,
        rgba(239, 68, 68, 0.32),
        rgba(127, 29, 29, 0.52)
    ) !important;

    border-color: #f87171 !important;

    box-shadow:
        0 0 0 1px rgba(239, 68, 68, 0.35),
        0 0 24px rgba(239, 68, 68, 0.35);
}

/* =========================================================
   PREMIUM SEAT CARD DESIGN
   ========================================================= */

.seat-card {
    position: relative;
    min-height: 78px;
    width: 100%;
    border-radius: 16px;
    border: 1px solid rgba(63, 63, 70, 0.9);
    background: linear-gradient(
        145deg,
        rgba(39, 39, 42, 0.98),
        rgba(24, 24, 27, 0.98)
    );
    padding: 12px 8px 9px;
    color: white;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    transition:
        transform 0.18s ease,
        border-color 0.18s ease,
        background 0.18s ease,
        box-shadow 0.18s ease;
}

/* Hover */

.seat-card:hover {
    transform: translateY(-2px);
    border-color: rgba(161, 161, 170, 0.8);
    background: linear-gradient(
        145deg,
        rgba(63, 63, 70, 0.98),
        rgba(39, 39, 42, 0.98)
    );
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.28);
}


/* Selected */

.seat-card.selected {
    border-color: rgb(250 204 21);
    background: linear-gradient(
        145deg,
        rgba(113, 63, 18, 0.45),
        rgba(39, 39, 42, 0.98)
    );
    box-shadow:
        0 0 0 2px rgba(250, 204, 21, 0.16),
        0 12px 28px rgba(0, 0, 0, 0.35);
}


/* =========================================================
   STATUS DOT
   ========================================================= */

.seat-status-dot {
    position: absolute;
    top: 9px;
    right: 9px;
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: rgb(34 197 94);
    box-shadow: 0 0 8px rgba(34, 197, 94, 0.45);
}


/* Available */

.seat-card.available .seat-status-dot {
    background: rgb(34 197 94);
}


/* Partial */

.seat-card.partial .seat-status-dot {
    background: rgb(250 204 21);
    box-shadow: 0 0 8px rgba(250, 204, 21, 0.4);
}


/* Occupied */

.seat-card.occupied .seat-status-dot {
    background: rgb(239 68 68);
    box-shadow: 0 0 8px rgba(239, 68, 68, 0.4);
}


/* Maintenance */

.seat-card.maintenance .seat-status-dot {
    background: rgb(113 113 122);
    box-shadow: none;
}


/* =========================================================
   SEAT NUMBER
   ========================================================= */

.seat-number {
    display: block;
    font-size: 17px;
    line-height: 1;
    font-weight: 800;
    letter-spacing: -0.02em;
    color: rgb(244 244 245);
}


/* =========================================================
   SHIFT CONTAINER
   ========================================================= */

.seat-shifts {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    min-height: 21px;
}


/* =========================================================
   SHIFT BADGES
   ========================================================= */

.seat-shift {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 22px;
    height: 20px;
    padding: 0 5px;
    border-radius: 6px;
    font-size: 9px;
    line-height: 1;
    font-weight: 800;
    letter-spacing: 0.04em;
}


/* Morning assigned */

.seat-shift-morning.assigned {
    background: rgba(34, 197, 94, 0.95);
    color: white;
    box-shadow: 0 3px 8px rgba(34, 197, 94, 0.18);
}


/* Morning available */

.seat-shift-morning.available {
    border: 1px solid rgba(34, 197, 94, 0.3);
    background: rgba(34, 197, 94, 0.06);
    color: rgb(74 222 128);
}


/* Evening assigned */

.seat-shift-evening.assigned {
    background: rgba(249, 115, 22, 0.95);
    color: white;
    box-shadow: 0 3px 8px rgba(249, 115, 22, 0.18);
}


/* Evening available */

.seat-shift-evening.available {
    border: 1px solid rgba(249, 115, 22, 0.3);
    background: rgba(249, 115, 22, 0.06);
    color: rgb(251 146 60);
}


/* Full day */

.seat-shift-full {
    min-width: 22px;
    background: rgba(239, 68, 68, 0.95);
    color: white;
    box-shadow: 0 3px 8px rgba(239, 68, 68, 0.18);
}


/* =========================================================
   OCCUPIED / PARTIAL STATES
   ========================================================= */

.seat-card.occupied {
    border-color: rgba(127, 29, 29, 0.7);
    background: linear-gradient(
        145deg,
        rgba(69, 10, 10, 0.72),
        rgba(24, 24, 27, 0.98)
    );
}


.seat-card.partial {
    border-color: rgba(133, 77, 14, 0.65);
    background: linear-gradient(
        145deg,
        rgba(66, 44, 10, 0.45),
        rgba(24, 24, 27, 0.98)
    );
}


/* Maintenance */

.seat-card.maintenance {
    opacity: 0.55;
    cursor: not-allowed;
    border-color: rgba(82, 82, 91, 0.7);
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media (max-width: 768px) {

    .seat-card {
        min-height: 70px;
        border-radius: 13px;
        padding: 10px 6px 8px;
    }

    .seat-number {
        font-size: 15px;
    }

    .seat-shift {
        min-width: 20px;
        height: 19px;
        font-size: 8px;
    }

    .seat-status-dot {
        top: 7px;
        right: 7px;
        width: 6px;
        height: 6px;
    }

}

/* =========================================================
   SEAT MANAGEMENT — FINAL LAYOUT BALANCE
   ========================================================= */

.library-layout {
    display: grid;
    grid-template-columns: minmax(0, 1.65fr) minmax(360px, 0.85fr);
    gap: 24px;
    align-items: start;
}

/* Seat map card */

.library-layout-card {
    min-width: 0;
    overflow: hidden;
}

.library-layout-body {
    padding: 24px;
    overflow-x: auto;
}

/* Seat grid */

.seat-map-grid {
    display: grid;
    grid-template-columns: repeat(10, minmax(58px, 1fr));
    gap: 10px;
    min-width: 680px;
}

/* Seat card */

.seat-card {
    min-width: 58px;
    min-height: 82px;
}

/* Shift badges */

.seat-shifts {
    gap: 5px;
}

.seat-shift {
    min-width: 23px;
    height: 21px;
    font-size: 9px;
}

/* Information panel */

.library-layout > :last-child {
    min-width: 0;
}

/* Keep information panel visible while scrolling */

.library-layout > .seat-information-card {
    position: sticky;
    top: 24px;
}

/* =========================================================
   TABLET
   ========================================================= */

@media (max-width: 1200px) {

    .library-layout {
        grid-template-columns: minmax(0, 1.4fr) minmax(320px, 0.8fr);
        gap: 18px;
    }

    .library-layout-body {
        padding: 18px;
    }

    .seat-map-grid {
        gap: 8px;
    }

}


/* =========================================================
   MOBILE
   ========================================================= */

@media (max-width: 900px) {

    .library-layout {
        grid-template-columns: 1fr;
    }

    .library-layout > .seat-information-card {
        position: static;
    }

    .seat-map-grid {
        min-width: 680px;
    }

}


</style>


</x-layouts::app>