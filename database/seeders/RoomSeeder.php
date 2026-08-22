<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::truncate();

        Room::create([
            'name'        => 'Main Hall',
            'code'        => 'MH',
            'floor'       => 'First Floor',
            'total_seats' => 60,
            'description' => 'Main Reading Hall',
            'status'      => 'Active',
        ]);

        Room::create([
            'name'        => 'Women Study Room',
            'code'        => 'WSR',
            'floor'       => 'First Floor',
            'total_seats' => 15,
            'description' => 'Ladies Reading Room',
            'status'      => 'Active',
        ]);
    }
}