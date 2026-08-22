<x-layouts::app :title="__('Students')">

    <div class="space-y-6">

        @if(session('success'))

    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="rounded-xl border border-green-600 bg-green-600/10 px-5 py-4 text-green-400">

        {{ session('success') }}

    </div>

@endif



        <!-- Page Header -->
        <div class="flex items-center justify-between">

            <div>
                <h1 class="text-3xl font-bold text-white">
                    Student Management
                </h1>

                <p class="mt-1 text-sm text-zinc-400">
                    Manage all library students, memberships and seat assignments.
                </p>
            </div>

           <a href="{{ route('students.create') }}">
    <flux:button variant="primary" icon="plus">
        Add Student
    </flux:button>
</a>



        </div>

        <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-5">

    <form method="GET" action="{{ route('students.index') }}">

        <div class="flex flex-col gap-4 md:flex-row">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by Student Code, Name or Mobile..."
                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:border-yellow-500 focus:outline-none">

            
            <select
    name="status"
    class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none">

    <option value="">All Status</option>

    <option value="Active"
        {{ request('status') == 'Active' ? 'selected' : '' }}>
        Active
    </option>

    <option value="Inactive"
        {{ request('status') == 'Inactive' ? 'selected' : '' }}>
        Inactive
    </option>

    <option value="Suspended"
        {{ request('status') == 'Suspended' ? 'selected' : '' }}>
        Suspended
    </option>

</select>
            
                <flux:button
                type="submit"
                variant="primary">

                Search

            </flux:button>

            @if(request('search'))

                <a href="{{ route('students.index') }}">
                    <flux:button variant="ghost">
                        Clear
                    </flux:button>
                </a>

            @endif

        </div>

    </form>

</div>
        
        
        
        <!-- Statistics -->
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">
                <p class="text-sm text-zinc-400">Total Students</p>
                <h2 class="mt-3 text-4xl font-bold text-yellow-400">{{ $totalStudents }}</h2>
            </div>

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">
                <p class="text-sm text-zinc-400">Active Students</p>
                <h2 class="mt-3 text-4xl font-bold text-green-400">{{ $activeStudents }}</h2>

            </div>

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">
                <p class="text-sm text-zinc-400">Expired Memberships</p>
                <h2 class="mt-3 text-4xl font-bold text-red-400">0</h2>
            </div>

            <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">
                <p class="text-sm text-zinc-400">Today's Joinings</p>
               <h2 class="mt-3 text-4xl font-bold text-sky-400">{{ $todayJoinings }}</h2>
            </div>

        </div>

        <div class="overflow-hidden rounded-2xl border border-zinc-700 bg-zinc-900">

    <table class="min-w-full">

        <thead class="border-b border-zinc-700">

            <tr class="text-left text-sm text-zinc-400">

                <th class="px-6 py-4">Code</th>
                <th class="px-6 py-4">Photo</th>
                <th class="px-6 py-4">Student</th>
                <th class="px-6 py-4">Mobile</th>
                <th class="px-6 py-4">Course</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4 text-center">Actions</th>

            </tr>

        </thead>

        <tbody>

            @forelse($students as $student)

                <tr class="border-b border-zinc-800 hover:bg-zinc-800/50">

                    <td class="px-6 py-4 font-medium text-yellow-400">
                        {{ $student->student_code }}
                    </td>

                    <td class="px-6 py-4">

    @if($student->photo)

        <img
            src="{{ asset('storage/' . $student->photo) }}"
            class="h-12 w-12 rounded-full object-cover border border-zinc-700">

    @else

        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-zinc-800 text-sm text-zinc-400">
            NA
        </div>

    @endif

</td>




                    <td class="px-6 py-4 text-white">
                        {{ $student->first_name }} {{ $student->last_name }}
                    </td>

                    <td class="px-6 py-4 text-zinc-300">
                        {{ $student->mobile }}
                    </td>

                    <td class="px-6 py-4 text-zinc-300">
                        {{ $student->course }}
                    </td>

                    <td class="px-6 py-4">

                        @if($student->status === 'Active')
                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs text-green-400">
                                Active
                            </span>
                        @else
                            <span class="rounded-full bg-red-500/20 px-3 py-1 text-xs text-red-400">
                                {{ $student->status }}
                            </span>
                        @endif

                    </td>

                   <td class="px-6 py-4">

    <div class="flex items-center justify-center gap-2">

    <a href="{{ route('students.show', $student) }}">
        <flux:button size="sm" variant="ghost">
            View
        </flux:button>
    </a>

    <a href="{{ route('attendance.student-history', $student) }}">
        <flux:button size="sm" variant="ghost">
            Attendance
        </flux:button>
    </a>

    <a href="{{ route('students.edit', $student) }}">
        <flux:button size="sm" variant="primary">
            Edit
        </flux:button>
    </a>

    <form action="{{ route('students.destroy', $student) }}"
          method="POST"
          onsubmit="return confirm('Delete this student permanently?');">

        @csrf
        @method('DELETE')

        <flux:button
            type="submit"
            size="sm"
            variant="danger">

            Delete

        </flux:button>

    </form>

</div>

    

</td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="px-6 py-10 text-center text-zinc-500">
                        No students found.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="border-t border-zinc-700 p-4">
        {{ $students->links() }}
    </div>

</div>



    </div>

</x-layouts::app>