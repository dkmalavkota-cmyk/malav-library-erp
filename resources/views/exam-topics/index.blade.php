<x-layouts::examination :title="'Exam Topics'">

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div>
                <div class="flex items-center gap-2 text-sm text-zinc-500">
                    <a
                        href="{{ route('exam-subjects.index') }}"
                        class="transition hover:text-yellow-400"
                    >
                        Subjects
                    </a>

                    <span class="text-zinc-700">/</span>

                    <span class="text-zinc-400">
                        Topics
                    </span>
                </div>

                <div class="mt-2 flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-yellow-500/20 bg-yellow-500/10">
                        <flux:icon name="list-bullet" class="h-5 w-5 text-yellow-400" />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                            {{ $examSubject->name }}
                        </h1>

                        <p class="mt-1 text-sm text-zinc-400">
                            Manage examination topics under this subject.
                        </p>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">

                <a href="{{ route('exam-subjects.show', $examSubject) }}">
                    <flux:button variant="ghost" icon="arrow-left">
                        Subject
                    </flux:button>
                </a>

                <a href="{{ route('exam-topics.create', $examSubject) }}">
                    <flux:button variant="primary" icon="plus">
                        Add Topic
                    </flux:button>
                </a>

            </div>

        </div>


        {{-- Flash Messages --}}
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 3500)"
                x-show="show"
                x-transition
                class="rounded-2xl border border-green-500/20 bg-green-500/10 px-5 py-4"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-500/15">
                        <flux:icon name="check" class="h-5 w-5 text-green-400" />
                    </div>

                    <p class="text-sm font-medium text-green-400">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => show = false, 4500)"
                x-show="show"
                x-transition
                class="rounded-2xl border border-red-500/20 bg-red-500/10 px-5 py-4"
            >
                <div class="flex items-center gap-3">
                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-500/15">
                        <flux:icon name="x-mark" class="h-5 w-5 text-red-400" />
                    </div>

                    <p class="text-sm font-medium text-red-400">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        @endif


        {{-- Subject Context --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900/80">

            <div class="flex flex-col gap-4 p-5 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-zinc-800 text-lg font-bold text-yellow-400">
                        {{ strtoupper(substr($examSubject->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-zinc-500">
                            Current Subject
                        </p>

                        <h2 class="mt-1 text-lg font-semibold text-white">
                            {{ $examSubject->name }}
                        </h2>
                    </div>
                </div>

                <a href="{{ route('exam-subjects.show', $examSubject) }}">
                    <flux:button size="sm" variant="ghost">
                        View Subject
                    </flux:button>
                </a>

            </div>

        </div>


        {{-- Search & Filters --}}
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">

            <div class="mb-4">
                <h2 class="text-sm font-semibold text-white">
                    Find Topics
                </h2>

                <p class="mt-1 text-xs text-zinc-500">
                    Search topics or filter them by status.
                </p>
            </div>

            <form
                method="GET"
                action="{{ route('exam-topics.index', $examSubject) }}"
            >
                <div class="grid gap-3 md:grid-cols-[1fr_auto_auto_auto]">

                    <div class="relative">
                        <flux:icon
                            name="magnifying-glass"
                            class="pointer-events-none absolute left-3 top-1/2 z-10 h-4 w-4 -translate-y-1/2 text-zinc-500"
                        />

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search topic name or description..."
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 py-3 pl-10 pr-4 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                        >
                    </div>

                    <select
                        name="status"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >
                        <option value="">All Status</option>

                        <option
                            value="active"
                            @selected($status === 'active')
                        >
                            Active
                        </option>

                        <option
                            value="inactive"
                            @selected($status === 'inactive')
                        >
                            Inactive
                        </option>
                    </select>

                    <flux:button
                        type="submit"
                        variant="primary"
                        icon="magnifying-glass"
                    >
                        Search
                    </flux:button>

                    @if($search || $status)
                        <a href="{{ route('exam-topics.index', $examSubject) }}">
                            <flux:button
                                type="button"
                                variant="ghost"
                            >
                                Clear
                            </flux:button>
                        </a>
                    @endif

                </div>
            </form>

        </div>


        {{-- Statistics --}}
        <div class="grid gap-4 sm:grid-cols-3">

            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-zinc-400">
                            Total Topics
                        </p>

                        <p class="mt-3 text-3xl font-bold text-white">
                            {{ $totalTopics }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-500/10">
                        <flux:icon name="list-bullet" class="h-5 w-5 text-yellow-400" />
                    </div>
                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Topics available in this subject
                </p>
            </div>


            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-zinc-400">
                            Active Topics
                        </p>

                        <p class="mt-3 text-3xl font-bold text-green-400">
                            {{ $activeTopics }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500/10">
                        <flux:icon name="check-circle" class="h-5 w-5 text-green-400" />
                    </div>
                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Currently available for use
                </p>
            </div>


            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-zinc-400">
                            Inactive Topics
                        </p>

                        <p class="mt-3 text-3xl font-bold text-red-400">
                            {{ $inactiveTopics }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-500/10">
                        <flux:icon name="x-circle" class="h-5 w-5 text-red-400" />
                    </div>
                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Currently disabled
                </p>
            </div>

        </div>


        {{-- Topics Table --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">

            <div class="flex flex-col gap-3 border-b border-zinc-800 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-white">
                        Topics
                    </h2>

                    <p class="mt-1 text-xs text-zinc-500">
                        Manage topics and their question banks.
                    </p>
                </div>

                <a href="{{ route('exam-topics.create', $examSubject) }}">
                    <flux:button
                        size="sm"
                        variant="primary"
                        icon="plus"
                    >
                        Add Topic
                    </flux:button>
                </a>

            </div>


            <div class="overflow-x-auto">

                <table class="min-w-full">

                    <thead class="border-b border-zinc-800 bg-zinc-950/50">

                        <tr class="text-left text-xs font-semibold uppercase tracking-wider text-zinc-500">

                            <th class="px-5 py-4">
                                Topic
                            </th>

                            <th class="px-5 py-4">
                                Questions
                            </th>

                            <th class="px-5 py-4">
                                Order
                            </th>

                            <th class="px-5 py-4">
                                Status
                            </th>

                            <th class="px-5 py-4 text-right">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-zinc-800">

                        @forelse($topics as $topic)

                            <tr class="group transition hover:bg-zinc-800/40">

                                {{-- Topic --}}
                                <td class="px-5 py-5">

                                    <div class="flex min-w-[240px] items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-zinc-700 bg-zinc-800 text-sm font-bold text-yellow-400">
                                            {{ strtoupper(substr($topic->name, 0, 1)) }}
                                        </div>

                                        <div class="min-w-0">
                                            <p class="font-semibold text-white">
                                                {{ $topic->name }}
                                            </p>

                                            @if($topic->description)
                                                <p class="mt-1 max-w-xl truncate text-xs text-zinc-500">
                                                    {{ Str::limit($topic->description, 120) }}
                                                </p>
                                            @else
                                                <p class="mt-1 text-xs text-zinc-600">
                                                    No description
                                                </p>
                                            @endif
                                        </div>

                                    </div>

                                </td>


                                {{-- Questions --}}
                                <td class="px-5 py-5">

                                    <a
                                        href="{{ route('exam-questions.index', [$examSubject, $topic]) }}"
                                        class="inline-flex items-center gap-2 rounded-lg border border-blue-500/20 bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-400 transition hover:border-blue-500/40 hover:bg-blue-500/15"
                                    >
                                        <flux:icon name="document-text" class="h-4 w-4" />

                                        {{ $topic->questions_count ?? 0 }}
                                    </a>

                                </td>


                                {{-- Order --}}
                                <td class="px-5 py-5">
                                    <span class="inline-flex min-w-8 items-center justify-center rounded-lg bg-zinc-800 px-2.5 py-1.5 text-xs font-semibold text-zinc-300">
                                        {{ $topic->sort_order }}
                                    </span>
                                </td>


                                {{-- Status --}}
                                <td class="px-5 py-5">

                                    @if($topic->is_active)

                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-green-500/20 bg-green-500/10 px-3 py-1.5 text-xs font-semibold text-green-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-5 py-5">

                                    <div class="flex flex-wrap items-center justify-end gap-2">

                                        <a
                                            href="{{ route('exam-questions.index', [$examSubject, $topic]) }}"
                                        >
                                            <flux:button
                                                size="sm"
                                                variant="ghost"
                                                icon="document-text"
                                            >
                                                Questions
                                            </flux:button>
                                        </a>

                                        <a
                                            href="{{ route('exam-topics.show', [$examSubject, $topic]) }}"
                                        >
                                            <flux:button
                                                size="sm"
                                                variant="ghost"
                                            >
                                                View
                                            </flux:button>
                                        </a>

                                        <a
                                            href="{{ route('exam-topics.edit', [$examSubject, $topic]) }}"
                                        >
                                            <flux:button
                                                size="sm"
                                                variant="primary"
                                            >
                                                Edit
                                            </flux:button>
                                        </a>

                                        <form
                                            action="{{ route('exam-topics.destroy', [$examSubject, $topic]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Delete this topic permanently? All questions under this topic will also be deleted.');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <flux:button
                                                type="submit"
                                                size="sm"
                                                variant="danger"
                                            >
                                                Delete
                                            </flux:button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="px-5 py-16 text-center"
                                >

                                    <div class="mx-auto flex max-w-md flex-col items-center">

                                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl border border-zinc-800 bg-zinc-800/60">
                                            <flux:icon
                                                name="list-bullet"
                                                class="h-7 w-7 text-zinc-500"
                                            />
                                        </div>

                                        <h3 class="mt-5 text-lg font-semibold text-white">
                                            No topics found
                                        </h3>

                                        <p class="mt-2 text-sm text-zinc-500">
                                            @if($search || $status)
                                                Try changing your search or filter.
                                            @else
                                                Add the first topic for {{ $examSubject->name }}.
                                            @endif
                                        </p>

                                        @if($search || $status)

                                            <a
                                                href="{{ route('exam-topics.index', $examSubject) }}"
                                                class="mt-5"
                                            >
                                                <flux:button variant="ghost">
                                                    Clear Filters
                                                </flux:button>
                                            </a>

                                        @else

                                            <a
                                                href="{{ route('exam-topics.create', $examSubject) }}"
                                                class="mt-5"
                                            >
                                                <flux:button
                                                    variant="primary"
                                                    icon="plus"
                                                >
                                                    Add First Topic
                                                </flux:button>
                                            </a>

                                        @endif

                                    </div>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($topics->hasPages())

                <div class="border-t border-zinc-800 px-5 py-4">
                    {{ $topics->links() }}
                </div>

            @endif

        </div>

    </div>

</x-layouts::examination>