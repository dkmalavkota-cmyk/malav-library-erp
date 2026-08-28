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
        $libraryId = auth()->user()->library_id;

        $search = $request->search;

        $rooms = Room::where('library_id', $libraryId)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('rooms.index', [
            'rooms' => $rooms,
            'search' => $search,
            'totalRooms' => Room::where('library_id', $libraryId)->count(),
            'activeRooms' => Room::where('library_id', $libraryId)
                ->where('status', 'Active')
                ->count(),
            'inactiveRooms' => Room::where('library_id', $libraryId)
                ->where('status', 'Inactive')
                ->count(),
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

            'library_id' => auth()->user()->library_id,
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
        abort_unless(
            $room->library_id === auth()->user()->library_id,
            404
        );

        return view('rooms.show', compact('room'));
    }

    /**
     * Edit room.
     */
    public function edit(Room $room)
    {
        abort_unless(
            $room->library_id === auth()->user()->library_id,
            404
        );

        return view('rooms.edit', compact('room'));
    }

    /**
     * Update room.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        abort_unless(
            $room->library_id === auth()->user()->library_id,
            404
        );

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
        abort_unless(
            $room->library_id === auth()->user()->library_id,
            404
        );

        $room->delete();

        return redirect()
            ->route('rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}