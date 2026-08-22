<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Seat::truncate();

        // ==========================
        // Main Hall (60 Seats)
        // ==========================

        $mainHall = Room::where('code', 'MH')->first();

        if ($mainHall) {

            for ($i = 1; $i <= 60; $i++) {

                Seat::create([
                    'room_id'     => $mainHall->id,
                    'seat_number' => 'MH-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'status'      => 'available',
                ]);
            }
        }

        // ==========================
        // Women Study Room (15 Seats)
        // ==========================

        $womenRoom = Room::where('code', 'WSR')->first();

        if ($womenRoom) {

            for ($i = 1; $i <= 15; $i++) {

                Seat::create([
                    'room_id'     => $womenRoom->id,
                    'seat_number' => 'WSR-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                    'status'      => 'available',
                ]);
            }
        }
    }
}