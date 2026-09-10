<x-layouts::examination :title="'Question Bank'">

    <div class="space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-2 text-sm text-zinc-500">

                    <a
                        href="{{ route('exam-subjects.index') }}"
                        class="transition hover:text-yellow-400"
                    >
                        Subjects
                    </a>

                    <span class="text-zinc-700">/</span>

                    <a
                        href="{{ route('exam-topics.index', $subject) }}"
                        class="transition hover:text-yellow-400"
                    >
                        {{ $subject->name }}
                    </a>

                    <span class="text-zinc-700">/</span>

                    <span class="text-zinc-400">
                        {{ $topic->name }}
                    </span>

                </div>


                <div class="mt-3 flex items-start gap-3">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-yellow-500/20 bg-yellow-500/10">
                        <flux:icon
                            name="document-text"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>

                    <div class="min-w-0">

                        <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                            Question Bank
                        </h1>

                        <p class="mt-1 truncate text-sm text-zinc-400">
                            {{ $subject->name }}
                            <span class="mx-1 text-zinc-700">/</span>
                            {{ $topic->name }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="flex flex-wrap items-center gap-2">

                <a href="{{ route('exam-topics.index', $subject) }}">
                    <flux:button
                        variant="ghost"
                        icon="arrow-left"
                    >
                        Topics
                    </flux:button>
                </a>

                <a href="{{ route('exam-questions.create', [$subject, $topic]) }}">
                    <flux:button
                        variant="primary"
                        icon="plus"
                    >
                        Add Question
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
                class="rounded-2xl border border-green-500/20 bg-green-500/10 p-5"
            >
                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-500/15">
                        <flux:icon
                            name="check"
                            class="h-5 w-5 text-green-400"
                        />
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
                class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5"
            >
                <div class="flex items-center gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-500/15">
                        <flux:icon
                            name="x-mark"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>

                    <p class="text-sm font-medium text-red-400">
                        {{ session('error') }}
                    </p>

                </div>
            </div>

        @endif


        {{-- Validation Errors --}}
        @if($errors->any())

            <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-red-500/15">
                        <flux:icon
                            name="exclamation-triangle"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>

                    <div>

                        <p class="font-semibold text-red-400">
                            Please fix the following errors:
                        </p>

                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-300">

                            @foreach($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- Search & Filters --}}
        <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">

            <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-sm font-semibold text-white">
                        Search & Filters
                    </h2>

                    <p class="mt-1 text-xs text-zinc-500">
                        Find questions by text, difficulty or status.
                    </p>
                </div>

                <span class="w-fit rounded-full border border-zinc-700 bg-zinc-800 px-3 py-1.5 text-xs text-zinc-400">
                    {{ $totalQuestions }} total
                </span>

            </div>


            <form
                method="GET"
                action="{{ route('exam-questions.index', [$subject, $topic]) }}"
            >

                <div class="grid gap-3 lg:grid-cols-4">

                    {{-- Search --}}
                    <div class="relative lg:col-span-2">

                        <flux:icon
                            name="magnifying-glass"
                            class="pointer-events-none absolute left-3 top-1/2 z-10 h-4 w-4 -translate-y-1/2 text-zinc-500"
                        />

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search question or explanation..."
                            class="w-full rounded-xl border border-zinc-700 bg-zinc-800 py-3 pl-10 pr-4 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                        >

                    </div>


                    {{-- Status --}}
                    <select
                        name="status"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >
                        <option value="">
                            All Status
                        </option>

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


                    {{-- Difficulty --}}
                    <select
                        name="difficulty"
                        class="rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >
                        <option value="">
                            All Difficulty
                        </option>

                        <option
                            value="Easy"
                            @selected($difficulty === 'Easy')
                        >
                            Easy
                        </option>

                        <option
                            value="Medium"
                            @selected($difficulty === 'Medium')
                        >
                            Medium
                        </option>

                        <option
                            value="Hard"
                            @selected($difficulty === 'Hard')
                        >
                            Hard
                        </option>
                    </select>

                </div>


                <div class="mt-4 flex flex-wrap items-center gap-2">

                    <flux:button
                        type="submit"
                        variant="primary"
                        icon="magnifying-glass"
                    >
                        Search
                    </flux:button>

                    @if($search || $status || $difficulty)

                        <a href="{{ route('exam-questions.index', [$subject, $topic]) }}">
                            <flux:button
                                type="button"
                                variant="ghost"
                            >
                                Clear Filters
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
                            Total Questions
                        </p>

                        <p class="mt-3 text-3xl font-bold text-white">
                            {{ $totalQuestions }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-500/10">
                        <flux:icon
                            name="document-text"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Questions in this topic
                </p>

            </div>


            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm text-zinc-400">
                            Active Questions
                        </p>

                        <p class="mt-3 text-3xl font-bold text-green-400">
                            {{ $activeQuestions }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-green-500/10">
                        <flux:icon
                            name="check-circle"
                            class="h-5 w-5 text-green-400"
                        />
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Available for exams
                </p>

            </div>


            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm text-zinc-400">
                            Inactive Questions
                        </p>

                        <p class="mt-3 text-3xl font-bold text-red-400">
                            {{ $inactiveQuestions }}
                        </p>
                    </div>

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-red-500/10">
                        <flux:icon
                            name="x-circle"
                            class="h-5 w-5 text-red-400"
                        />
                    </div>

                </div>

                <p class="mt-3 text-xs text-zinc-500">
                    Currently disabled
                </p>

            </div>

        </div>


        {{-- Question List --}}
        <div class="space-y-4">

            @forelse($questions as $question)

                <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900 transition hover:border-zinc-700">

                    {{-- Question Header --}}
                    <div class="p-5 sm:p-6">

                        <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                            <div class="min-w-0 flex-1">

                                <div class="flex flex-wrap items-center gap-2">

                                    <span class="inline-flex min-w-10 items-center justify-center rounded-full border border-yellow-500/15 bg-yellow-500/10 px-3 py-1.5 text-xs font-bold text-yellow-400">
                                        Q{{ $questions->firstItem() + $loop->index }}
                                    </span>


                                    @if($question->difficulty === 'Easy')

                                        <span class="rounded-full bg-green-500/10 px-3 py-1.5 text-xs font-semibold text-green-400">
                                            Easy
                                        </span>

                                    @elseif($question->difficulty === 'Hard')

                                        <span class="rounded-full bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-400">
                                            Hard
                                        </span>

                                    @else

                                        <span class="rounded-full bg-yellow-500/10 px-3 py-1.5 text-xs font-semibold text-yellow-400">
                                            Medium
                                        </span>

                                    @endif


                                    @if($question->is_active)

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-500/10 px-3 py-1.5 text-xs font-semibold text-green-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-400"></span>
                                            Active
                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-500/10 px-3 py-1.5 text-xs font-semibold text-red-400">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-400"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </div>


                                {{-- Question Text --}}
                                <div class="mt-4 text-base font-semibold leading-7 text-white sm:text-lg">
                                    {!! nl2br(e($question->question_text)) !!}
                                </div>

                            </div>


                            {{-- Marks --}}
                            <div class="flex shrink-0 gap-2">

                                <div class="min-w-24 rounded-xl border border-zinc-800 bg-zinc-950/50 px-4 py-3 text-center">

                                    <p class="text-[11px] uppercase tracking-wider text-zinc-500">
                                        Marks
                                    </p>

                                    <p class="mt-1 text-base font-bold text-white">
                                        {{ number_format((float) $question->marks, 2) }}
                                    </p>

                                </div>


                                <div class="min-w-24 rounded-xl border border-red-500/10 bg-red-500/5 px-4 py-3 text-center">

                                    <p class="text-[11px] uppercase tracking-wider text-zinc-500">
                                        Negative
                                    </p>

                                    <p class="mt-1 text-base font-bold text-red-400">
                                        {{ number_format((float) $question->negative_marks, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- Options --}}
                        @if($question->options->count())

                            <div class="mt-6 grid gap-3 md:grid-cols-2">

                                @foreach($question->options as $index => $option)

                                    <div
                                        class="{{ $option->is_correct
                                            ? 'border-green-500/30 bg-green-500/5'
                                            : 'border-zinc-800 bg-zinc-950/40' }}
                                            rounded-xl border p-3"
                                    >

                                        <div class="flex items-start gap-3">

                                            <div
                                                class="{{ $option->is_correct
                                                    ? 'bg-green-600 text-white'
                                                    : 'bg-zinc-800 text-zinc-400' }}
                                                    flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs font-bold"
                                            >
                                                {{ chr(65 + $index) }}
                                            </div>


                                            <div class="min-w-0 flex-1 text-sm leading-6 {{ $option->is_correct ? 'text-green-100' : 'text-zinc-400' }}">
                                                {{ $option->option_text }}
                                            </div>


                                            @if($option->is_correct)

                                                <div class="flex shrink-0 items-center gap-1.5 text-xs font-semibold text-green-400">
                                                    <flux:icon
                                                        name="check-circle"
                                                        class="h-4 w-4"
                                                    />

                                                    Correct
                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- Explanation --}}
                        @if($question->explanation)

                            <div class="mt-5 rounded-xl border border-blue-500/15 bg-blue-500/5 p-4">

                                <div class="flex items-center gap-2">

                                    <flux:icon
                                        name="information-circle"
                                        class="h-4 w-4 text-blue-400"
                                    />

                                    <p class="text-xs font-semibold uppercase tracking-wider text-blue-400">
                                        Explanation
                                    </p>

                                </div>

                                <p class="mt-2 text-sm leading-6 text-zinc-300">
                                    {!! nl2br(e($question->explanation)) !!}
                                </p>

                            </div>

                        @endif


                        {{-- Footer --}}
                        <div class="mt-6 flex flex-col gap-4 border-t border-zinc-800 pt-5 sm:flex-row sm:items-center sm:justify-between">

                            <div class="flex flex-wrap items-center gap-3 text-xs text-zinc-500">

                                <span>
                                    Order:
                                    <span class="font-medium text-zinc-300">
                                        {{ $question->sort_order }}
                                    </span>
                                </span>

                                @if($question->created_at)

                                    <span class="text-zinc-700">|</span>

                                    <span>
                                        Created:
                                        <span class="font-medium text-zinc-300">
                                            {{ $question->created_at->format('d M Y') }}
                                        </span>
                                    </span>

                                @endif

                            </div>


                            <div class="flex flex-wrap items-center gap-2">

                                {{-- View --}}
                                <a
                                    href="{{ route('exam-questions.show', [$subject, $topic, $question]) }}"
                                >
                                    <flux:button
                                        size="sm"
                                        variant="ghost"
                                    >
                                        View
                                    </flux:button>
                                </a>


                                {{-- Edit --}}
                                <a
                                    href="{{ route('exam-questions.edit', [$subject, $topic, $question]) }}"
                                >
                                    <flux:button
                                        size="sm"
                                        variant="primary"
                                        icon="pencil-square"
                                    >
                                        Edit
                                    </flux:button>
                                </a>


                                {{-- Delete --}}
                                <form
                                    action="{{ route('exam-questions.destroy', [$subject, $topic, $question]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Delete this question permanently?');"
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

                        </div>

                    </div>

                </div>

            @empty

                {{-- Empty State --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-900 px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-zinc-800 bg-zinc-800/60">
                        <flux:icon
                            name="document-text"
                            class="h-7 w-7 text-zinc-500"
                        />
                    </div>


                    <h2 class="mt-5 text-xl font-semibold text-white">
                        No questions found
                    </h2>


                    @if($search || $status || $difficulty)

                        <p class="mt-2 text-sm text-zinc-500">
                            No questions match your current filters.
                        </p>

                        <a
                            href="{{ route('exam-questions.index', [$subject, $topic]) }}"
                            class="mt-5 inline-flex"
                        >
                            <flux:button variant="ghost">
                                Clear Filters
                            </flux:button>
                        </a>

                    @else

                        <p class="mt-2 text-sm text-zinc-500">
                            This topic does not have any questions yet.
                        </p>

                        <a
                            href="{{ route('exam-questions.create', [$subject, $topic]) }}"
                            class="mt-5 inline-flex"
                        >
                            <flux:button
                                variant="primary"
                                icon="plus"
                            >
                                Add First Question
                            </flux:button>
                        </a>

                    @endif

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($questions->hasPages())

            <div class="rounded-2xl border border-zinc-800 bg-zinc-900 px-5 py-4">
                {{ $questions->links() }}
            </div>

        @endif


        {{-- Bottom Navigation --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <a href="{{ route('exam-topics.index', $subject) }}">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    Back to Topics
                </flux:button>
            </a>

            <a href="{{ route('exam-questions.create', [$subject, $topic]) }}">
                <flux:button
                    variant="primary"
                    icon="plus"
                >
                    Add Question
                </flux:button>
            </a>

        </div>

    </div>

</x-layouts::examination>