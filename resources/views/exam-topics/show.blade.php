<x-layouts::examination :title="$examTopic->name . ' - Questions'">

    <div class="space-y-6">

        {{-- Hero --}}
        <div class="relative overflow-hidden rounded-3xl border border-yellow-500/15 bg-zinc-900">

            <div class="absolute inset-0 bg-[radial-gradient(circle_at_85%_10%,rgba(234,179,8,0.12),transparent_32%),radial-gradient(circle_at_10%_90%,rgba(59,130,246,0.08),transparent_35%)]"></div>

            <div class="relative p-6 sm:p-8">

                {{-- Breadcrumb --}}
                <div class="flex flex-wrap items-center gap-2 text-sm text-zinc-500">

                    <a
                        href="{{ route('exam-subjects.index') }}"
                        class="transition hover:text-yellow-400"
                    >
                        Subjects
                    </a>

                    <span class="text-zinc-700">/</span>

                    <a
                        href="{{ route('exam-subjects.show', $examSubject) }}"
                        class="transition hover:text-yellow-400"
                    >
                        {{ $examSubject->name }}
                    </a>

                    <span class="text-zinc-700">/</span>

                    <span class="text-zinc-400">
                        {{ $examTopic->name }}
                    </span>

                </div>


                {{-- Title + Actions --}}
                <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

                    <div class="min-w-0">

                        <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-yellow-500/15 bg-yellow-500/10 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-yellow-400">
                            <flux:icon
                                name="document-text"
                                class="h-4 w-4"
                            />
                            Question Bank
                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ $examTopic->name }}
                        </h1>

                        @if($examTopic->description)
                            <p class="mt-3 max-w-3xl text-sm leading-6 text-zinc-400">
                                {{ $examTopic->description }}
                            </p>
                        @else
                            <p class="mt-3 text-sm text-zinc-500">
                                Manage examination questions under this topic.
                            </p>
                        @endif

                    </div>


                    <div class="flex flex-wrap items-center gap-2">

                        <a href="{{ route('exam-subjects.show', $examSubject) }}">
                            <flux:button
                                variant="ghost"
                                icon="arrow-left"
                            >
                                Subject
                            </flux:button>
                        </a>

                        <a href="{{ route('exam-topics.edit', [$examSubject, $examTopic]) }}">
                            <flux:button
                                variant="ghost"
                                icon="pencil-square"
                            >
                                Edit Topic
                            </flux:button>
                        </a>

                        <a href="{{ route('exam-questions.create', [$examSubject, $examTopic]) }}">
                            <flux:button
                                variant="primary"
                                icon="plus"
                            >
                                Add Question
                            </flux:button>
                        </a>

                    </div>

                </div>

            </div>

        </div>


        {{-- Topic Summary --}}
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
                    Available for exam content
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


        {{-- Questions --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">

            <div class="flex flex-col gap-4 border-b border-zinc-800 px-5 py-5 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-white">
                        Questions
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500">
                        Questions created under {{ $examTopic->name }}.
                    </p>
                </div>

                <div class="flex items-center gap-2">

                    <span class="rounded-full border border-zinc-700 bg-zinc-800 px-3 py-1.5 text-xs font-semibold text-zinc-300">
                        {{ $totalQuestions }}
                        {{ $totalQuestions === 1 ? 'question' : 'questions' }}
                    </span>

                    <a href="{{ route('exam-questions.create', [$examSubject, $examTopic]) }}">
                        <flux:button
                            size="sm"
                            variant="primary"
                            icon="plus"
                        >
                            Add Question
                        </flux:button>
                    </a>

                </div>

            </div>


            @if($questions->count())

                <div class="divide-y divide-zinc-800">

                    @foreach($questions as $index => $question)

                        <div class="p-5 transition hover:bg-zinc-800/30 sm:p-6">

                            <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">

                                <div class="min-w-0 flex-1">

                                    {{-- Question Meta --}}
                                    <div class="mb-4 flex flex-wrap items-center gap-2">

                                        <span class="inline-flex min-w-10 items-center justify-center rounded-full border border-yellow-500/15 bg-yellow-500/10 px-3 py-1.5 text-xs font-bold text-yellow-400">
                                            Q{{ $index + 1 }}
                                        </span>

                                        @if($question->difficulty)
                                            <span class="rounded-full bg-yellow-500/10 px-3 py-1.5 text-xs font-semibold text-yellow-400">
                                                {{ ucfirst($question->difficulty) }}
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
                                    <div class="text-base font-semibold leading-7 text-white sm:text-lg">
                                        {{ $question->question_text }}
                                    </div>


                                    {{-- Options --}}
                                    @if($question->options->count())

                                        <div class="mt-5 grid gap-3 md:grid-cols-2">

                                            @foreach($question->options as $optionIndex => $option)

                                                <div
                                                    class="{{ $option->is_correct
                                                        ? 'border-green-500/30 bg-green-500/5'
                                                        : 'border-zinc-800 bg-zinc-950/40' }}
                                                        flex items-center gap-3 rounded-xl border p-3"
                                                >

                                                    <span
                                                        class="{{ $option->is_correct
                                                            ? 'bg-green-600 text-white'
                                                            : 'bg-zinc-800 text-zinc-400' }}
                                                            flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs font-bold"
                                                    >
                                                        {{ chr(65 + $optionIndex) }}
                                                    </span>

                                                    <span class="min-w-0 text-sm {{ $option->is_correct ? 'text-green-100' : 'text-zinc-400' }}">
                                                        {{ $option->option_text }}
                                                    </span>

                                                    @if($option->is_correct)
                                                        <flux:icon
                                                            name="check-circle"
                                                            class="ml-auto h-4 w-4 shrink-0 text-green-400"
                                                        />
                                                    @endif

                                                </div>

                                            @endforeach

                                        </div>

                                    @endif

                                </div>


                                {{-- Marks --}}
                                <div class="flex shrink-0 gap-2 lg:w-40 lg:flex-col">

                                    <div class="flex-1 rounded-xl border border-zinc-800 bg-zinc-950/50 p-3 text-center">
                                        <p class="text-[11px] uppercase tracking-wider text-zinc-500">
                                            Marks
                                        </p>

                                        <p class="mt-1 text-base font-bold text-white">
                                            {{ number_format((float) $question->marks, 2) }}
                                        </p>
                                    </div>

                                    <div class="flex-1 rounded-xl border border-red-500/10 bg-red-500/5 p-3 text-center">
                                        <p class="text-[11px] uppercase tracking-wider text-zinc-500">
                                            Negative
                                        </p>

                                        <p class="mt-1 text-base font-bold text-red-400">
                                            {{ number_format((float) $question->negative_marks, 2) }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>


            @else

                {{-- Empty State --}}
                <div class="px-6 py-16 text-center">

                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-zinc-800 bg-zinc-800/60">
                        <flux:icon
                            name="document-text"
                            class="h-7 w-7 text-zinc-500"
                        />
                    </div>

                    <h3 class="mt-5 text-lg font-semibold text-white">
                        No questions yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-zinc-500">
                        Start building the question bank for
                        <span class="text-zinc-300">{{ $examTopic->name }}</span>.
                    </p>

                    <a
                        href="{{ route('exam-questions.create', [$examSubject, $examTopic]) }}"
                        class="mt-6 inline-flex"
                    >
                        <flux:button
                            variant="primary"
                            icon="plus"
                        >
                            Add First Question
                        </flux:button>
                    </a>

                </div>

            @endif

        </div>


        {{-- Bottom Navigation --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <a href="{{ route('exam-topics.index', $examSubject) }}">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    All Topics
                </flux:button>
            </a>

            <div class="flex flex-wrap gap-2">

                <a href="{{ route('exam-topics.edit', [$examSubject, $examTopic]) }}">
                    <flux:button
                        variant="ghost"
                        icon="pencil-square"
                    >
                        Edit Topic
                    </flux:button>
                </a>

                <a href="{{ route('exam-questions.create', [$examSubject, $examTopic]) }}">
                    <flux:button
                        variant="primary"
                        icon="plus"
                    >
                        Add Question
                    </flux:button>
                </a>

            </div>

        </div>

    </div>

</x-layouts::examination>