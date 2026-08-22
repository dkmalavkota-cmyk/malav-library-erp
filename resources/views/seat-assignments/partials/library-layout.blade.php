<div class="library-layout-card">

    <div class="library-layout-header">
        <div>
            <h2>Library Seat Map</h2>
            <p>Click any seat to view details</p>
        </div>
    </div>

    <div class="library-layout-body">

        @foreach($rooms as $room)

            <div class="seat-map-grid">

               @foreach(
    $room->seats
        ->sortBy([
            ['table_no', 'asc'],
            ['seat_number', 'asc'],
        ]) as $seat
)

                    @include('seat-assignments.partials.seat-card', [
                        'seat' => $seat
                    ])

                @endforeach

            </div>

        @endforeach

    </div>

</div>