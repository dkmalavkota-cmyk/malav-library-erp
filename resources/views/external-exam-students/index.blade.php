<x-layouts::examination :title="'External Exam Students'">

    <div class="min-h-full">
        <div class="mx-auto max-w-7xl px-6 py-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-indigo-400">
                        Examination Management
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        External Exam Students
                    </h1>

                    <p class="mt-2 text-sm text-slate-400">
                        Manage external candidates registered by your library.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('examination.dashboard') }}"
                       class="rounded-xl border border-white/10 bg-white/[0.03] px-4 py-2.5 text-sm font-semibold text-slate-300 transition hover:bg-white/[0.07] hover:text-white">
                        Back
                    </a>

                    <a href="{{ route('external-exam-students.create') }}"
                       class="rounded-xl bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-400">
                        + Register Student
                    </a>
                </div>
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats --}}
            <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                <div class="rounded-2xl border border-white/10 bg-white/[0.025] p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Total Students
                    </div>
                    <div class="mt-2 text-3xl font-bold text-white">
                        {{ $students->total() }}
                    </div>
                </div>

                <div class="rounded-2xl border border-white/10 bg-white/[0.025] p-5">
                    <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Current Page
                    </div>
                    <div class="mt-2 text-3xl font-bold text-white">
                        {{ $students->count() }}
                    </div>
                </div>

               <a href="{{ url('/exam-user/login') }}"
   target="_blank"
   class="group block rounded-2xl border border-indigo-400/20 bg-gradient-to-br from-indigo-500/10 to-violet-500/5 p-5 transition duration-200 hover:border-indigo-400/40 hover:bg-indigo-500/15">

    <div class="flex items-center justify-between gap-4">

        <div>
            <div class="text-xs font-semibold uppercase tracking-wider text-indigo-300">
                External Student Login
            </div>

            <div class="mt-2 text-sm font-semibold text-white">
                Examination Login Portal
            </div>

            <div class="mt-1 text-xs text-slate-500">
                Open student examination login
            </div>
        </div>

        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500 text-lg text-white transition group-hover:bg-indigo-400">
            →
        </div>

    </div>

</a>

            </div>

            {{-- Student List --}}
            <div class="overflow-hidden rounded-2xl border border-white/10 bg-white/[0.025]">

                <div class="border-b border-white/10 px-6 py-5">
                    <h2 class="text-lg font-semibold text-white">
                        Registered Candidates
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Only candidates connected to your current library are shown.
                    </p>
                </div>

                @if($students->count())

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="border-b border-white/10 bg-white/[0.02]">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Student
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Contact
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Categories
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Access
                                    </th>
                                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                        Action
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-white/5">

                                @foreach($students as $student)

                                    @php
                                        $access = $student->libraryAccess->first();
                                    @endphp

                                    <tr class="transition hover:bg-white/[0.025]">

                                        {{-- Student --}}
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-500/15 text-sm font-bold text-indigo-300">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>

                                                <div>
                                                    <div class="font-semibold text-white">
                                                        {{ $student->name }}
                                                    </div>

                                                    <div class="mt-1 text-xs text-slate-500">
                                                        ID #{{ $student->id }}
                                                    </div>
                                                </div>

                                            </div>
                                        </td>

                                        {{-- Contact --}}
                                        <td class="px-6 py-5">
                                            <div class="text-sm text-slate-300">
                                                {{ $student->email }}
                                            </div>

                                            @if($student->mobile)
                                                <div class="mt-1 text-xs text-slate-500">
                                                    {{ $student->mobile }}
                                                </div>
                                            @endif
                                        </td>

                                        {{-- Categories --}}
                                        <td class="px-6 py-5">
                                            <span class="inline-flex rounded-full border border-indigo-400/20 bg-indigo-400/10 px-3 py-1 text-xs font-semibold text-indigo-300">
                                                {{ $student->selected_categories_count }} / 5
                                            </span>
                                        </td>

                                        {{-- Access --}}
                                        <td class="px-6 py-5">

                                            @if($access && $access->status === 'active')
                                                <span class="inline-flex rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-semibold text-emerald-300">
                                                    Active
                                                </span>
                                            @else
                                                <span class="inline-flex rounded-full border border-red-400/20 bg-red-400/10 px-3 py-1 text-xs font-semibold text-red-300">
                                                    {{ ucfirst($access->status ?? 'Unavailable') }}
                                                </span>
                                            @endif

                                        </td>

                                        {{-- Action --}}
                                        <td class="px-6 py-5 text-right">
                                            <a href="{{ route('external-exam-students.show', $student) }}"
                                               class="inline-flex items-center rounded-lg border border-white/10 bg-white/[0.03] px-3.5 py-2 text-xs font-semibold text-slate-300 transition hover:bg-white/[0.07] hover:text-white">
                                                Manage →
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if($students->hasPages())
                        <div class="border-t border-white/10 px-6 py-5">
                            {{ $students->links() }}
                        </div>
                    @endif

                @else

                    <div class="px-6 py-16 text-center">
                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-500/10 text-2xl text-indigo-300">
                            E
                        </div>

                        <h3 class="mt-5 text-lg font-semibold text-white">
                            No external students yet
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">
                            Register an external candidate to give them examination access for this library.
                        </p>

                        <a href="{{ route('external-exam-students.create') }}"
                           class="mt-6 inline-flex rounded-xl bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-400">
                            Register First Student
                        </a>
                    </div>

                @endif

            </div>

        </div>
    </div>

</x-layouts::examination>