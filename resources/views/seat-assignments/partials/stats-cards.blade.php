<div class="seat-stats">

    {{-- Total Seats --}}
    <div class="seat-stat-card total">
        <div class="seat-stat-value">
            {{ $totalSeats }}
        </div>

        <div class="seat-stat-label">
            Total Seats
        </div>
    </div>


    {{-- Available Physical Seats --}}
    <div class="seat-stat-card available">
        <div class="seat-stat-value">
            {{ $availableSeats }}
        </div>

        <div class="seat-stat-label">
            Fully Available
        </div>
    </div>


    {{-- Fully Occupied --}}
    <div class="seat-stat-card occupied">
        <div class="seat-stat-value">
            {{ $occupiedSeats }}
        </div>

        <div class="seat-stat-label">
            Fully Occupied
        </div>
    </div>


    {{-- Morning Assignments --}}
    <div class="seat-stat-card morning">
        <div class="seat-stat-value">
            {{ $morningSeats }}
        </div>

        <div class="seat-stat-label">
            Morning
        </div>
    </div>


    {{-- Evening Assignments --}}
    <div class="seat-stat-card evening">
        <div class="seat-stat-value">
            {{ $eveningSeats }}
        </div>

        <div class="seat-stat-label">
            Evening
        </div>
    </div>


    {{-- Full Day Assignments --}}
    <div class="seat-stat-card full">
        <div class="seat-stat-value">
            {{ $fullDaySeats }}
        </div>

        <div class="seat-stat-label">
            Full Day
        </div>
    </div>

</div>