<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display listing.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $rooms = Room::when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%");

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('rooms.index', [
            'rooms' => $rooms,
            'search' => $search,
            'totalRooms' => Room::count(),
            'activeRooms' => Room::where('status', 'Active')->count(),
            'inactiveRooms' => Room::where('status', 'Inactive')->count(),
        ]);
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store room.
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create([

            ...$request->validated(),

            'created_by' => auth()->id(),

        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room created successfully.');
    }

    /**
     * Show room.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Edit room.
     */
    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update room.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update([

            ...$request->validated(),

            'updated_by' => auth()->id(),

        ]);

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    /**
     * Delete room.
     */
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}