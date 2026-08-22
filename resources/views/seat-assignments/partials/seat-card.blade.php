@props([
    'seat'
])

@php

    $morning = $seat->morningAssignment();
    $evening = $seat->eveningAssignment();
    $fullDay = $seat->fullDayAssignment();

    $statusClass = 'available';

    if (strtolower($seat->status) === 'maintenance') {

        $statusClass = 'maintenance';

    } elseif ($fullDay || ($morning && $evening)) {

        $statusClass = 'occupied';

    } elseif ($morning || $evening) {

        $statusClass = 'partial';

    }

@endphp


<button
    type="button"

    class="seat-card {{ $statusClass }} {{ $fullDay ? 'full-day-seat' : '' }}"

    data-seat-id="{{ $seat->id }}"
    data-assignment-id="{{ $fullDay?->id ?? $morning?->id ?? $evening?->id ?? '' }}"

    data-seat-number="{{ $seat->seat_number }}"
    data-table-number="{{ $seat->table_no }}"
    data-room-name="{{ $seat->room->name ?? '' }}"

    data-seat-status="{{ $statusClass }}"
    data-status="{{ ucfirst($statusClass) }}"

    {{-- Primary Information --}}
    data-student-name="{{ $fullDay?->student?->full_name ?? $morning?->student?->full_name ?? $evening?->student?->full_name ?? '--' }}"

    data-mobile="{{ $fullDay?->student?->mobile ?? $morning?->student?->mobile ?? $evening?->student?->mobile ?? '--' }}"

    data-plan="{{ $fullDay?->membership?->plan?->name ?? $morning?->membership?->plan?->name ?? $evening?->membership?->plan?->name ?? '--' }}"

    data-shift="{{ $fullDay?->membership?->plan?->shift ?? $morning?->membership?->plan?->shift ?? $evening?->membership?->plan?->shift ?? '--' }}"

    data-joining="{{ optional($fullDay?->membership?->start_date)->format('d M Y') ?? optional($morning?->membership?->start_date)->format('d M Y') ?? optional($evening?->membership?->start_date)->format('d M Y') ?? '--' }}"

    data-expiry="{{ optional($fullDay?->membership?->end_date)->format('d M Y') ?? optional($morning?->membership?->start_date)->format('d M Y') ?? optional($evening?->membership?->start_date)->format('d M Y') ?? '--' }}"


    {{-- Morning --}}
    data-morning-student="{{ $morning?->student?->full_name ?? '' }}"
    data-morning-mobile="{{ $morning?->student?->mobile ?? '' }}"
    data-morning-plan="{{ $morning?->membership?->plan?->name ?? '' }}"
    data-morning-start="{{ optional($morning?->membership?->start_date)->format('d M Y') ?? '' }}"
    data-morning-expiry="{{ optional($morning?->membership?->end_date)->format('d M Y') ?? '' }}"


    {{-- Evening --}}
    data-evening-student="{{ $evening?->student?->full_name ?? '' }}"
    data-evening-mobile="{{ $evening?->student?->mobile ?? '' }}"
    data-evening-plan="{{ $evening?->membership?->plan?->name ?? '' }}"
    data-evening-start="{{ optional($evening?->membership?->start_date)->format('d M Y') ?? '' }}"
    data-evening-expiry="{{ optional($evening?->membership?->end_date)->format('d M Y') ?? '' }}"


    {{-- Full Day --}}
    data-full-day-student="{{ $fullDay?->student?->full_name ?? '' }}"
    data-full-day-mobile="{{ $fullDay?->student?->mobile ?? '' }}"
    data-full-day-plan="{{ $fullDay?->membership?->plan?->name ?? '' }}"
    data-full-day-start="{{ optional($fullDay?->membership?->start_date)->format('d M Y') ?? '' }}"
    data-full-day-expiry="{{ optional($fullDay?->membership?->end_date)->format('d M Y') ?? '' }}"
>


    {{-- Status Indicator --}}
    <span class="seat-status-dot"></span>


    {{-- Seat Number --}}
    <span class="seat-number">
        {{ str_pad($seat->seat_number, 2, '0', STR_PAD_LEFT) }}
    </span>


    {{-- Shift Indicators --}}
    <span class="seat-shifts">


        {{-- Morning --}}
        @if($morning)

            <span
                class="seat-shift seat-shift-morning assigned"
                title="Morning Assigned"
            >
                M
            </span>

        @else

            <span
                class="seat-shift seat-shift-morning available"
                title="Morning Available"
            >
                M
            </span>

        @endif


        {{-- Evening --}}
        @if($evening)

            <span
                class="seat-shift seat-shift-evening assigned"
                title="Evening Assigned"
            >
                E
            </span>

        @else

            <span
                class="seat-shift seat-shift-evening available"
                title="Evening Available"
            >
                E
            </span>

        @endif


        {{-- Full Day --}}
        @if($fullDay)

            <span
                class="seat-shift seat-shift-full"
                title="Full Day Assigned"
            >
                F
            </span>

        @endif


    </span>

</button>