<x-layouts::examination :title="'Edit Exam Topic'">

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-2 text-sm text-zinc-500">

                    <a
                        href="{{ route('exam-subjects.index') }}"
                        class="transition hover:text-yellow-400"
                    >
                        Subjects
                    </a>

                    <span class="text-zinc-700">/</span>

                    <a
                        href="{{ route('exam-topics.index', $examSubject) }}"
                        class="transition hover:text-yellow-400"
                    >
                        Topics
                    </a>

                    <span class="text-zinc-700">/</span>

                    <span class="text-zinc-400">
                        Edit
                    </span>

                </div>

                <div class="mt-3 flex items-center gap-3">

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-yellow-500/20 bg-yellow-500/10">
                        <flux:icon
                            name="pencil-square"
                            class="h-5 w-5 text-yellow-400"
                        />
                    </div>

                    <div>
                        <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                            Edit Exam Topic
                        </h1>

                        <p class="mt-1 text-sm text-zinc-400">
                            Update topic information and management settings.
                        </p>
                    </div>

                </div>
            </div>


            <a href="{{ route('exam-topics.index', $examSubject) }}">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    Topics
                </flux:button>
            </a>

        </div>


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

                    <div class="min-w-0">

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


        {{-- Form --}}
        <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900">

            {{-- Form Header --}}
            <div class="border-b border-zinc-800 bg-zinc-950/40 px-6 py-5">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-white">
                            Topic Information
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Update the basic details for this examination topic.
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center gap-1.5 rounded-full border border-blue-500/20 bg-blue-500/10 px-3 py-1.5 text-xs font-semibold text-blue-400">
                        <flux:icon
                            name="hashtag"
                            class="h-3.5 w-3.5"
                        />
                        ID: {{ $examTopic->id }}
                    </span>

                </div>

            </div>


            <form
                method="POST"
                action="{{ route('exam-topics.update', [$examSubject, $examTopic]) }}"
                class="space-y-6 p-6"
            >

                @csrf
                @method('PUT')


                {{-- Subject Context --}}
                <div class="rounded-2xl border border-yellow-500/10 bg-yellow-500/5 p-5">

                    <div class="flex items-center gap-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-zinc-800 text-base font-bold text-yellow-400">
                            {{ strtoupper(substr($examSubject->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-500">
                                Subject
                            </p>

                            <p class="mt-1 truncate text-lg font-semibold text-white">
                                {{ $examSubject->name }}
                            </p>

                            <p class="mt-1 text-xs text-zinc-500">
                                This topic belongs to this examination subject.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Topic Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Topic Name
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $examTopic->name) }}"
                        placeholder="e.g. Algebra"
                        required
                        autofocus
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >

                    @error('name')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label
                        for="description"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Optional description about this topic..."
                        class="w-full resize-y rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >{{ old('description', $examTopic->description) }}</textarea>

                    <p class="mt-2 text-xs text-zinc-500">
                        Add a short description to help admins identify the topic.
                    </p>

                    @error('description')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Display Order --}}
                <div>

                    <label
                        for="sort_order"
                        class="mb-2 block text-sm font-medium text-zinc-300"
                    >
                        Display Order
                    </label>

                    <input
                        id="sort_order"
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $examTopic->sort_order) }}"
                        min="0"
                        max="9999"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-sm text-white outline-none transition focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500"
                    >

                    <p class="mt-2 text-xs text-zinc-500">
                        Lower numbers appear first.
                    </p>

                    @error('sort_order')
                        <p class="mt-2 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-800/40 p-5">

                    <label class="flex cursor-pointer items-start gap-4">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', $examTopic->is_active))
                            class="mt-1 h-4 w-4 rounded border-zinc-600 bg-zinc-800 text-yellow-500 focus:ring-yellow-500"
                        >

                        <span class="min-w-0">

                            <span class="flex items-center gap-2 text-sm font-semibold text-white">
                                Active Topic

                                @if($examTopic->is_active)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-500/10 px-2 py-0.5 text-[10px] font-semibold text-green-400">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-500/10 px-2 py-0.5 text-[10px] font-semibold text-red-400">
                                        Inactive
                                    </span>
                                @endif
                            </span>

                            <span class="mt-1 block text-sm leading-6 text-zinc-500">
                                Active topics can be used while creating examination content and questions.
                            </span>

                        </span>

                    </label>

                </div>


                {{-- Existing Information --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-800/30 p-5">

                    <div class="mb-4">
                        <h3 class="text-sm font-semibold text-white">
                            Topic Information
                        </h3>

                        <p class="mt-1 text-xs text-zinc-500">
                            System-generated details for this topic.
                        </p>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-500">
                                Current Slug
                            </p>

                            <p class="mt-2 break-all rounded-lg bg-zinc-900 px-3 py-2 text-sm text-zinc-300">
                                {{ $examTopic->slug }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-zinc-500">
                                Created
                            </p>

                            <p class="mt-2 rounded-lg bg-zinc-900 px-3 py-2 text-sm text-zinc-300">
                                {{ $examTopic->created_at?->format('d M Y, h:i A') }}
                            </p>
                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-zinc-800 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a
                        href="{{ route('exam-topics.index', $examSubject) }}"
                        class="w-full sm:w-auto"
                    >
                        <flux:button
                            type="button"
                            variant="ghost"
                            class="w-full sm:w-auto"
                        >
                            Cancel
                        </flux:button>
                    </a>

                    <flux:button
                        type="submit"
                        variant="primary"
                        icon="check"
                        class="w-full sm:w-auto"
                    >
                        Update Topic
                    </flux:button>

                </div>

            </form>

        </div>


        {{-- Question Bank Shortcut --}}
        <div class="rounded-2xl border border-blue-500/10 bg-blue-500/5 p-5">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-500/10">
                        <flux:icon
                            name="document-text"
                            class="h-5 w-5 text-blue-400"
                        />
                    </div>

                    <div>
                        <p class="text-sm font-semibold text-white">
                            Manage Topic Questions
                        </p>

                        <p class="mt-1 text-sm leading-6 text-zinc-500">
                            Open the question bank for this topic and manage its examination questions.
                        </p>
                    </div>

                </div>

                <a href="{{ route('exam-questions.index', [$examSubject, $examTopic]) }}">
                    <flux:button
                        size="sm"
                        variant="ghost"
                        icon="arrow-right"
                    >
                        Questions
                    </flux:button>
                </a>

            </div>

        </div>

    </div>

</x-layouts::examination>