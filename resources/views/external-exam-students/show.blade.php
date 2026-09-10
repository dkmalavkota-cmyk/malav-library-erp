<x-layouts::examination :title="'External Student Details'">

    <div class="min-h-full">
        <div class="mx-auto max-w-6xl px-6 py-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-indigo-400">
                        Examination Management
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        {{ $examUser->name }}
                    </h1>

                    <p class="mt-2 text-sm text-slate-400">
                        External examination student profile and access management.
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('external-exam-students.index') }}"
                       class="rounded-xl border border-white/10 bg-white/[0.03] px-4 py-2.5 text-sm font-semibold text-slate-300 hover:bg-white/[0.07] hover:text-white">
                        Back
                    </a>

                    <a href="{{ route('external-exam-students.edit', $examUser) }}"
                       class="rounded-xl bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 hover:bg-indigo-400">
                        Edit Student
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-4 text-sm text-emerald-300">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-3">

                {{-- Profile --}}
                <div class="rounded-2xl border border-white/10 bg-white/[0.025] p-6 lg:col-span-2">

                    <div class="mb-6 flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-500/15 text-2xl font-bold text-indigo-300">
                            {{ strtoupper(substr($examUser->name, 0, 1)) }}
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-white">
                                Candidate Information
                            </h2>
                            <p class="text-sm text-slate-500">
                                Student ID #{{ $examUser->id }}
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">

                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-500">
                                Full Name
                            </div>
                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $examUser->name }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-500">
                                Email
                            </div>
                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $examUser->email }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-500">
                                Mobile
                            </div>
                            <div class="mt-1 text-sm font-medium text-white">
                                {{ $examUser->mobile ?: 'Not provided' }}
                            </div>
                        </div>

                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-500">
                                Account Status
                            </div>

                            <div class="mt-1">
                                @if($examUser->is_active)
                                    <span class="rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1 text-xs font-semibold text-emerald-300">
                                        Active
                                    </span>
                                @else
                                    <span class="rounded-full border border-red-400/20 bg-red-400/10 px-3 py-1 text-xs font-semibold text-red-300">
                                        Disabled
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Access --}}
                @php
                    $access = $examUser->libraryAccess->first();
                @endphp

                <div class="rounded-2xl border border-white/10 bg-white/[0.025] p-6">

                    <h2 class="text-lg font-semibold text-white">
                        Library Access
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Examination access for this library.
                    </p>

                    <div class="mt-6">

                        <div class="text-xs uppercase tracking-wider text-slate-500">
                            Access Status
                        </div>

                        <div class="mt-2">
                            @if($access && $access->status === 'active')
                                <span class="rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1.5 text-xs font-semibold text-emerald-300">
                                    Active
                                </span>
                            @else
                                <span class="rounded-full border border-red-400/20 bg-red-400/10 px-3 py-1.5 text-xs font-semibold text-red-300">
                                    {{ ucfirst($access->status ?? 'Unavailable') }}
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="mt-6">
                        <div class="text-xs uppercase tracking-wider text-slate-500">
                            Access Type
                        </div>

                        <div class="mt-1 text-sm font-medium capitalize text-white">
                            {{ $access->access_type ?? '—' }}
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="text-xs uppercase tracking-wider text-slate-500">
                            Login Portal
                        </div>

                        <div class="mt-1 text-sm font-medium text-indigo-300">
                            /exam-user/login
                        </div>
                    </div>

                </div>

            </div>

            {{-- Categories --}}
            <div class="mt-6 rounded-2xl border border-white/10 bg-white/[0.025] p-6">

                <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Preparation Categories
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Categories currently selected by this candidate.
                        </p>
                    </div>

                    <div class="rounded-full border border-indigo-400/20 bg-indigo-400/10 px-4 py-2 text-xs font-semibold text-indigo-300">
                        {{ $examUser->selectedCategories->count() }} / 5 Selected
                    </div>
                </div>

                @if($examUser->selectedCategories->count())

                    <div class="mt-5 flex flex-wrap gap-3">
                        @foreach($examUser->selectedCategories as $category)
                            <span class="rounded-xl border border-white/10 bg-white/[0.04] px-4 py-2.5 text-sm font-medium text-slate-200">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                @else

                    <div class="mt-5 rounded-xl border border-dashed border-white/10 px-5 py-8 text-center">
                        <p class="text-sm text-slate-500">
                            This candidate has not selected any preparation categories yet.
                        </p>
                    </div>

                @endif

            </div>

            {{-- Access Actions --}}
            <div class="mt-6 rounded-2xl border border-white/10 bg-white/[0.025] p-6">

                <h2 class="text-lg font-semibold text-white">
                    Access Control
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Control whether this candidate can access examination services through your library.
                </p>

                <div class="mt-5">

                    @if($access && $access->status === 'active')

                        <form method="POST"
                              action="{{ route('external-exam-students.revoke', $examUser) }}"
                              onsubmit="return confirm('Revoke examination access for this student?');">
                            @csrf

                            <button type="submit"
                                    class="rounded-xl border border-red-400/20 bg-red-400/10 px-5 py-2.5 text-sm font-semibold text-red-300 hover:bg-red-400/15">
                                Revoke Examination Access
                            </button>
                        </form>

                    @else

                        <form method="POST"
                              action="{{ route('external-exam-students.restore', $examUser) }}">
                            @csrf

                            <button type="submit"
                                    class="rounded-xl border border-emerald-400/20 bg-emerald-400/10 px-5 py-2.5 text-sm font-semibold text-emerald-300 hover:bg-emerald-400/15">
                                Restore Examination Access
                            </button>
                        </form>

                    @endif

                </div>

            </div>

        </div>
    </div>

</x-layouts::examination>