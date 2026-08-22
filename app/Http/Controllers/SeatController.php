<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeatController extends Controller
{
    /**
     * Display Seat List
     */
    public function index(Request $request)
    {
        $query = Seat::with('room');

        // Search
        if ($request->filled('search')) {
            $query->where(
                'seat_number',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Room Filter
        if ($request->filled('room')) {
            $query->where('room_id', $request->room);
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $seats = $query
            ->orderBy('room_id')
            ->orderBy('table_no')
            ->orderBy('seat_number')
            ->paginate(20)
            ->withQueryString();

        return view('seats.index', [
            'seats' => $seats,
            'rooms' => Room::orderBy('name')->get(),
            'totalSeats' => Seat::count(),
            'availableSeats' => Seat::where('status', 'available')->count(),
            'occupiedSeats' => Seat::where('status', 'occupied')->count(),
            'maintenanceSeats' => Seat::where('status', 'maintenance')->count(),
        ]);
    }

    /**
     * Generate Library Seats
     *
     * Seats are generated dynamically according to
     * the active rooms and their configured capacity.
     */
    public function generate()
    {
        /*
         * Get all active rooms having seat capacity.
         *
         * Room names are intentionally NOT hard-coded.
         */
        $rooms = Room::where('status', 'Active')
            ->where('total_seats', '>', 0)
            ->orderBy('id')
            ->get();

        if ($rooms->isEmpty()) {
            return redirect()
                ->route('seats.index')
                ->with(
                    'success',
                    'Please create at least one active room with seat capacity first.'
                );
        }

        /*
         * Prevent accidental duplicate generation.
         *
         * Once seats exist, Generate Seats will not create
         * another duplicate set.
         */
        if (Seat::exists()) {
            return redirect()
                ->route('seats.index')
                ->with(
                    'success',
                    'Seats have already been generated.'
                );
        }

        DB::beginTransaction();

        try {

            $generatedSeats = 0;

            foreach ($rooms as $room) {

                $totalSeats = (int) $room->total_seats;

                /*
                 * Women/Ladies rooms use:
                 * W01, W02, W03...
                 *
                 * Other rooms use:
                 * 1, 2, 3...
                 */
                $isWomenRoom = str_contains(
                    strtolower($room->name),
                    'women'
                );

                for ($i = 1; $i <= $totalSeats; $i++) {

                    $seatNumber = $isWomenRoom
                        ? 'W' . str_pad(
                            $i,
                            2,
                            '0',
                            STR_PAD_LEFT
                        )
                        : (string) $i;

                    /*
                     * Every 15 seats belong to one table.
                     *
                     * 1-15   = Table 1
                     * 16-30  = Table 2
                     * 31-45  = Table 3
                     * 46-60  = Table 4
                     */
                    $tableNo = (int) ceil($i / 15);

                    Seat::create([
                        'room_id'     => $room->id,
                        'table_no'    => $tableNo,
                        'seat_number' => $seatNumber,
                        'status'      => 'available',
                        'created_by'  => Auth::id(),
                    ]);

                    $generatedSeats++;
                }
            }

            DB::commit();

            return redirect()
                ->route('seats.index')
                ->with(
                    'success',
                    $generatedSeats . ' seats generated successfully.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return redirect()
                ->route('seats.index')
                ->with(
                    'success',
                    'Error generating seats: ' . $e->getMessage()
                );
        }
    }

    /**
     * Seat Layout
     */
    public function layout()
    {
        $rooms = Room::with([
            'seats' => function ($query) {

                $query
                    ->orderBy('table_no')
                    ->orderByRaw("
                        CASE
                            WHEN seat_number LIKE 'W%' THEN 999
                            ELSE CAST(seat_number AS UNSIGNED)
                        END
                    ")
                    ->orderBy('seat_number');

            }
        ])->get();

        return view('seats.layout', compact('rooms'));
    }
}