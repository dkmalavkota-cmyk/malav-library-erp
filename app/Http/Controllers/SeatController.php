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
        $libraryId = auth()->user()->library_id;

        $query = Seat::with('room')
            ->where('library_id', $libraryId);

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
            'rooms' => Room::where('library_id', $libraryId)
                ->orderBy('name')
                ->get(),
            'totalSeats' => Seat::where('library_id', $libraryId)->count(),
            'availableSeats' => Seat::where('library_id', $libraryId)
                ->where('status', 'available')
                ->count(),
            'occupiedSeats' => Seat::where('library_id', $libraryId)
                ->where('status', 'occupied')
                ->count(),
            'maintenanceSeats' => Seat::where('library_id', $libraryId)
                ->where('status', 'maintenance')
                ->count(),
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
    $libraryId = auth()->user()->library_id;

    $rooms = Room::where('library_id', $libraryId)
        ->where('status', 'Active')
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

    DB::beginTransaction();

    try {
        $generatedSeats = 0;

        foreach ($rooms as $room) {

            $totalSeats = (int) $room->total_seats;

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

                $tableNo = (int) ceil($i / 15);

                $seatExists = Seat::where(
                        'library_id',
                        $libraryId
                    )
                    ->where(
                        'room_id',
                        $room->id
                    )
                    ->where(
                        'seat_number',
                        $seatNumber
                    )
                    ->exists();

                if ($seatExists) {
                    continue;
                }

                Seat::create([
                    'library_id' => $libraryId,
                    'room_id' => $room->id,
                    'table_no' => $tableNo,
                    'seat_number' => $seatNumber,
                    'status' => 'available',
                    'created_by' => Auth::id(),
                ]);

                $generatedSeats++;
            }
        }

        DB::commit();

        return redirect()
            ->route('seats.index')
            ->with(
                'success',
                $generatedSeats . ' new seats generated successfully.'
            );

    } catch (\Throwable $e) {

        DB::rollBack();

        return redirect()
            ->route('seats.index')
            ->with(
                'error',
                'Error generating seats: ' . $e->getMessage()
            );
    }
}
    /**
     * Seat Layout
     */
    public function layout()
    {
        $libraryId = auth()->user()->library_id;

        $rooms = Room::where('library_id', $libraryId)
            ->with([
                'seats' => function ($query) use ($libraryId) {

                    $query
                        ->where('library_id', $libraryId)
                        ->orderBy('table_no')
                        ->orderByRaw("
                            CASE
                                WHEN seat_number LIKE 'W%' THEN 999
                                ELSE CAST(seat_number AS UNSIGNED)
                            END
                        ")
                        ->orderBy('seat_number');

                }
            ])
            ->get();

        return view('seats.layout', compact('rooms'));
    }
}