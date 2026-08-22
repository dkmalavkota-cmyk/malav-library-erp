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
            $query->where('seat_number', 'like', '%' . $request->search . '%');
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
     */
    public function generate()
    {
        $mainHall = Room::where('name', 'Main Hall')->first();
        $womenRoom = Room::where('name', 'Women Study Room')->first();

        if (! $mainHall || ! $womenRoom) {
            return redirect()
                ->route('seats.index')
                ->with('success', 'Please create Main Hall and Women Study Room first.');
        }

        if (Seat::count() > 0) {
            return redirect()
                ->route('seats.index')
                ->with('success', 'Seats have already been generated.');
        }

        DB::beginTransaction();

        try {

            // ============================
            // Main Hall (1 - 60)
            // ============================

            $tableWiseSeats = [
    'A' => range(1, 16),
    'B' => range(17, 31),
    'C' => range(32, 46),
    'D' => range(47, 60),
];

           foreach ($tableWiseSeats as $tableCode => $seatNumbers) {

    foreach ($seatNumbers as $seatNumber) {

        Seat::create([
            'room_id'     => $mainHall->id,
            'table_no'    => $tableCode,
            'seat_number' => (string) $seatNumber,
            'status'      => 'available',
            'created_by'  => Auth::id(),
        ]);

    }

}

            // ============================
            // Women Study Room (W01 - W15)
            // ============================

            for ($i = 1; $i <= 15; $i++) {

                Seat::create([
                    'room_id'     => $womenRoom->id,
                    'table_no'    => 1,
                    'seat_number' => 'W' . str_pad($i, 2, '0', STR_PAD_LEFT),
                    'status'      => 'available',
                    'created_by'  => Auth::id(),
                ]);
            }

            DB::commit();

            return redirect()
                ->route('seats.index')
                ->with('success', '75 seats generated successfully.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->route('seats.index')
                ->with('success', 'Error: ' . $e->getMessage());
        }
    }

    /**
 * Seat Layout
 */
public function layout()
{
    $rooms = Room::with([
        'seats' => function ($query) {

            $query->orderBy('table_no')
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