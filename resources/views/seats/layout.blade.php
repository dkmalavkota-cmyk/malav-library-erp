<x-layouts::app :title="'Library Seat Layout'">

<div class="max-w-7xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-white">
                📚 Library Seat Layout
            </h1>

            <p class="text-zinc-400 mt-2">
                Visual overview of all seats inside the library.
            </p>

        </div>

        <div class="flex items-center gap-3">

            <a href="{{ route('seats.index') }}"
               class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition">

                ← Back

            </a>

        </div>

    </div>


    <!-- Statistics -->

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-8">

        <div class="rounded-2xl bg-zinc-900 border border-zinc-800 p-6">

            <p class="text-zinc-400 text-sm">

                Total Seats

            </p>

            <h2 class="text-3xl font-bold text-white mt-2">

                {{ \App\Models\Seat::count() }}

            </h2>

        </div>


        <div class="rounded-2xl bg-green-900/20 border border-green-700 p-6">

            <p class="text-green-400 text-sm">

                Available

            </p>

            <h2 class="text-3xl font-bold text-green-400 mt-2">

                {{ \App\Models\Seat::where('status','available')->count() }}

            </h2>

        </div>



        <div class="rounded-2xl bg-red-900/20 border border-red-700 p-6">

            <p class="text-red-400 text-sm">

                Occupied

            </p>

            <h2 class="text-3xl font-bold text-red-400 mt-2">

                {{ \App\Models\Seat::where('status','occupied')->count() }}

            </h2>

        </div>



        <div class="rounded-2xl bg-yellow-900/20 border border-yellow-700 p-6">

            <p class="text-yellow-400 text-sm">

                Maintenance

            </p>

            <h2 class="text-3xl font-bold text-yellow-400 mt-2">

                {{ \App\Models\Seat::where('status','maintenance')->count() }}

            </h2>

        </div>

    </div>




    <!-- Legend -->

    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-5 mb-10">

        <div class="flex flex-wrap gap-8">

            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded-full bg-green-500"></div>

                <span class="text-white">

                    Available

                </span>

            </div>



            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded-full bg-red-500"></div>

                <span class="text-white">

                    Occupied

                </span>

            </div>



            <div class="flex items-center gap-2">

                <div class="w-4 h-4 rounded-full bg-yellow-400"></div>

                <span class="text-white">

                    Maintenance

                </span>

            </div>

        </div>

    </div>




    @foreach($rooms as $room)

        <div class="bg-zinc-900 border border-zinc-800 rounded-3xl p-8 mb-10">

            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-2xl font-bold text-white">

                        {{ $room->name }}

                    </h2>

                    <p class="text-zinc-400 mt-1">

                        Total Seats :
                        {{ $room->seats->count() }}

                    </p>

                </div>

            </div>

            @php

                $tables = $room->seats->groupBy('table_no');

            @endphp

                        @foreach($tables as $tableNo => $tableSeats)

                <div class="mb-10">

                    <!-- Table Header -->
                    <div class="flex items-center justify-between mb-4">

                        <h3 class="text-lg font-bold text-indigo-400">
                            Table {{ $tableNo }}
                        </h3>

                        <span class="text-sm text-zinc-400">
                            {{ $tableSeats->count() }} Seats
                        </span>

                    </div>

                    <!-- Seat Grid -->
                    <div class="grid grid-cols-4 gap-4">

                        @foreach($tableSeats as $seat)

                            @php

                                $color = 'bg-green-600 hover:bg-green-700';

                                if($seat->status == 'occupied'){
                                    $color = 'bg-red-600 hover:bg-red-700';
                                }

                                if($seat->status == 'maintenance'){
                                    $color = 'bg-yellow-500 hover:bg-yellow-600';
                                }

                            @endphp

                            <button
                                class="{{ $color }} rounded-xl h-16 transition duration-300 hover:scale-105 shadow-lg">

                                <div class="flex flex-col items-center justify-center h-full">

                                    <span class="text-white font-bold text-lg">

                                        {{ $seat->seat_number }}

                                    </span>

                                    <span class="text-white/80 text-xs">

                                        Seat

                                    </span>

                                </div>

                            </button>

                        @endforeach

                    </div>

                </div>

            @endforeach