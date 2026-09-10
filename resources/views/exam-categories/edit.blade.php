<x-layouts::examination :title="'Edit Exam Category'">

    <div class="mx-auto max-w-4xl space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-start gap-4">

                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl border border-indigo-400/20 bg-indigo-500/10 text-indigo-400">

                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M15.232 5.232l3.536 3.536M4 20h4l10.732-10.732a2.5 2.5 0 00-3.536-3.536L4.464 16.464A2 2 0 004 17.878V20z"/>
                    </svg>

                </div>

                <div>

                    <h1 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        Edit Exam Category
                    </h1>

                    <p class="mt-1 text-sm text-zinc-400">
                        Update category details and availability.
                    </p>

                </div>

            </div>


            <a href="{{ route('exam-categories.index') }}">

                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                >
                    Back to Categories
                </flux:button>

            </a>

        </div>


        {{-- ERRORS --}}
        @if($errors->any())

            <div class="rounded-2xl border border-red-500/20 bg-red-500/10 p-5">

                <div class="flex items-start gap-3">

                    <div class="mt-0.5 text-red-400">
                        âš 
                    </div>

                    <div>

                        <h3 class="font-semibold text-red-300">
                            Please fix the following errors
                        </h3>

                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-400">

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


        {{-- MAIN CARD --}}
        <form
            method="POST"
            action="{{ route('exam-categories.update', $examCategory) }}"
        >

            @csrf
            @method('PUT')


            <div class="grid gap-6 lg:grid-cols-3">

                {{-- FORM --}}
                <div class="lg:col-span-2">

                    <div class="overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-900 shadow-xl shadow-black/10">

                        <div class="border-b border-zinc-800 px-6 py-5">

                            <h2 class="text-lg font-semibold text-white">
                                Category Details
                            </h2>

                            <p class="mt-1 text-sm text-zinc-500">
                                Make changes to this exam category.
                            </p>

                        </div>


                        <div class="space-y-6 p-6">

                            {{-- NAME --}}
                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <label
                                        for="name"
                                        class="text-sm font-medium text-zinc-300"
                                    >
                                        Category Name
                                    </label>

                                    <span class="text-xs text-zinc-600">
                                        Required
                                    </span>

                                </div>

                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $examCategory->name) }}"
                                    maxlength="100"
                                    required
                                    class="block w-full rounded-xl border border-zinc-700 bg-zinc-800/70 px-4 py-3 text-sm text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                    placeholder="e.g. General Knowledge"
                                >

                            </div>


                            {{-- DESCRIPTION --}}
                            <div>

                                <div class="mb-2 flex items-center justify-between">

                                    <label
                                        for="description"
                                        class="text-sm font-medium text-zinc-300"
                                    >
                                        Description
                                    </label>

                                    <span class="text-xs text-zinc-600">
                                        Optional
                                    </span>

                                </div>

                                <textarea
                                    id="description"
                                    name="description"
                                    rows="5"
                                    maxlength="500"
                                    class="block w-full resize-y rounded-xl border border-zinc-700 bg-zinc-800/70 px-4 py-3 text-sm leading-6 text-white outline-none transition placeholder:text-zinc-600 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                    placeholder="Describe what type of exams belong to this category..."
                                >{{ old('description', $examCategory->description) }}</textarea>

                            </div>


                            {{-- SETTINGS --}}
                            <div class="grid gap-4 sm:grid-cols-2">

                                {{-- SORT --}}
                                <div class="rounded-xl border border-zinc-800 bg-zinc-950/40 p-4">

                                    <label
                                        for="sort_order"
                                        class="block text-sm font-medium text-zinc-300"
                                    >
                                        Display Order
                                    </label>

                                    <p class="mt-1 text-xs leading-5 text-zinc-600">
                                        Lower numbers appear first.
                                    </p>

                                    <input
                                        id="sort_order"
                                        type="number"
                                        name="sort_order"
                                        value="{{ old('sort_order', $examCategory->sort_order ?? 0) }}"
                                        min="0"
                                        max="9999"
                                        class="mt-3 block w-full rounded-xl border border-zinc-700 bg-zinc-800/70 px-4 py-3 text-sm text-white outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10"
                                    >

                                </div>


                                {{-- ACTIVE --}}
                                <label class="cursor-pointer rounded-xl border border-zinc-800 bg-zinc-950/40 p-4">

                                    <div class="flex items-start gap-3">

                                        <input
                                            type="checkbox"
                                            name="is_active"
                                            value="1"
                                            @checked(old('is_active', $examCategory->is_active))
                                            class="mt-1 h-4 w-4 rounded border-zinc-600 bg-zinc-800 text-indigo-500 focus:ring-indigo-500"
                                        >

                                        <div>

                                            <div class="text-sm font-medium text-zinc-300">
                                                Active Category
                                            </div>

                                            <p class="mt-1 text-xs leading-5 text-zinc-600">
                                                Active categories are available while creating exams.
                                            </p>

                                        </div>

                                    </div>

                                </label>

                            </div>


                            {{-- ACTIONS --}}
                            <div class="flex flex-col-reverse gap-3 border-t border-zinc-800 pt-5 sm:flex-row sm:justify-end">

                                <a
                                    href="{{ route('exam-categories.index') }}"
                                    class="inline-flex min-h-11 items-center justify-center rounded-xl border border-zinc-700 bg-zinc-800/60 px-5 text-sm font-semibold text-zinc-300 transition hover:bg-zinc-800 hover:text-white"
                                >
                                    Cancel
                                </a>


                                <button
                                    type="submit"
                                    class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-indigo-500 px-6 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-400"
                                >

                                    <svg class="h-4 w-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>

                                    Save Changes

                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SIDEBAR --}}
                <div class="space-y-4">

                    {{-- CURRENT INFO --}}
                    <div class="rounded-2xl border border-zinc-800 bg-zinc-900 p-5">

                        <h3 class="font-semibold text-white">
                            Category Information
                        </h3>

                        <p class="mt-1 text-xs text-zinc-500">
                            Current category details.
                        </p>


                        <div class="mt-5 space-y-4">

                            <div class="flex items-start justify-between gap-4 border-b border-zinc-800 pb-3">

                                <span class="text-xs text-zinc-500">
                                    Category ID
                                </span>

                                <span class="text-xs font-semibold text-zinc-300">
                                    #{{ $examCategory->id }}
                                </span>

                            </div>


                            <div class="flex items-start justify-between gap-4 border-b border-zinc-800 pb-3">

                                <span class="text-xs text-zinc-500">
                                    Slug
                                </span>

                                <span class="max-w-[150px] break-all text-right text-xs font-medium text-indigo-300">
                                    {{ $examCategory->slug }}
                                </span>

                            </div>


                            <div class="flex items-start justify-between gap-4 border-b border-zinc-800 pb-3">

                                <span class="text-xs text-zinc-500">
                                    Status
                                </span>

                                @if($examCategory->is_active)

                                    <span class="rounded-full border border-emerald-500/20 bg-emerald-500/10 px-2.5 py-1 text-xs font-semibold text-emerald-400">
                                        Active
                                    </span>

                                @else

                                    <span class="rounded-full border border-zinc-700 bg-zinc-800 px-2.5 py-1 text-xs font-semibold text-zinc-400">
                                        Inactive
                                    </span>

                                @endif

                            </div>


                            <div class="flex items-start justify-between gap-4">

                                <span class="text-xs text-zinc-500">
                                    Created
                                </span>

                                <span class="text-right text-xs font-medium text-zinc-300">
                                    {{ $examCategory->created_at?->format('d M Y') ?? 'â€”' }}
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- TIP --}}
                    <div class="rounded-2xl border border-indigo-500/20 bg-indigo-500/5 p-5">

                        <div class="flex items-start gap-3">

                            <div class="mt-0.5 text-indigo-400">
                                <svg class="h-5 w-5"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 18h.01M9.09 9a3 3 0 115.83 1c0 2-2.92 2.2-2.92 4"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M12 22a10 10 0 100-20 10 10 0 000 20z"/>
                                </svg>
                            </div>

                            <div>

                                <h3 class="text-sm font-semibold text-indigo-300">
                                    Quick Tip
                                </h3>

                                <p class="mt-2 text-xs leading-5 text-zinc-500">
                                    If a category is no longer needed, deactivate it instead of deleting it.
                                    Existing exams can continue keeping their category history.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</x-layouts::examination>
