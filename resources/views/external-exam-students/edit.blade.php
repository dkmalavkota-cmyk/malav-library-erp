<x-layouts::examination :title="'Edit External Student'">

    <div class="min-h-full">
        <div class="mx-auto max-w-5xl px-6 py-8">

            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <div class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-indigo-400">
                        Examination Management
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-white">
                        Edit External Student
                    </h1>

                    <p class="mt-2 text-sm text-slate-400">
                        Update candidate information and examination account status.
                    </p>
                </div>

                <a href="{{ route('external-exam-students.show', $examUser) }}"
                   class="rounded-xl border border-white/10 bg-white/[0.03] px-4 py-2.5 text-sm font-semibold text-slate-300 transition hover:bg-white/[0.07] hover:text-white">
                    Back
                </a>
            </div>

            @if($errors->any())
                <div class="mb-6 rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4">
                    <div class="text-sm font-semibold text-red-300">
                        Please fix the following:
                    </div>

                    <ul class="mt-2 list-disc pl-5 text-sm text-red-300/80">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('external-exam-students.update', $examUser) }}">

                @csrf
                @method('PUT')

                <div class="rounded-2xl border border-white/10 bg-white/[0.025] p-6 sm:p-8">

                    <div class="mb-7 border-b border-white/10 pb-6">
                        <h2 class="text-lg font-semibold text-white">
                            Candidate Details
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Update the details used for the external examination account.
                        </p>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">

                        <div class="sm:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-300">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $examUser->name) }}"
                                   required
                                   class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-indigo-400/50 focus:ring-2 focus:ring-indigo-400/10">

                            @error('name')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-300">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $examUser->email) }}"
                                   required
                                   class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-indigo-400/50 focus:ring-2 focus:ring-indigo-400/10">

                            @error('email')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-300">
                                Mobile Number
                                <span class="font-normal text-slate-600">(Optional)</span>
                            </label>

                            <input type="text"
                                   name="mobile"
                                   value="{{ old('mobile', $examUser->mobile) }}"
                                   class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-indigo-400/50 focus:ring-2 focus:ring-indigo-400/10">

                            @error('mobile')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-300">
                                New Password
                                <span class="font-normal text-slate-600">(Optional)</span>
                            </label>

                            <input type="password"
                                   name="password"
                                   autocomplete="new-password"
                                   placeholder="Leave blank to keep current password"
                                   class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-indigo-400/50 focus:ring-2 focus:ring-indigo-400/10">

                            @error('password')
                                <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-300">
                                Confirm New Password
                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   autocomplete="new-password"
                                   placeholder="Re-enter new password"
                                   class="w-full rounded-xl border border-white/10 bg-black/20 px-4 py-3 text-sm text-white outline-none transition placeholder:text-slate-600 focus:border-indigo-400/50 focus:ring-2 focus:ring-indigo-400/10">
                        </div>

                    </div>

                    <div class="mt-7 rounded-xl border border-white/10 bg-black/20 p-5">

                        <label class="flex cursor-pointer items-start gap-4">

                            <input type="hidden" name="is_active" value="0">

                            <input type="checkbox"
                                   name="is_active"
                                   value="1"
                                   @checked(old('is_active', $examUser->is_active))
                                   class="mt-1 h-4 w-4 rounded border-white/20 bg-black/30 text-indigo-500 focus:ring-indigo-500/30">

                            <span>
                                <span class="block text-sm font-semibold text-white">
                                    Account Active
                                </span>

                                <span class="mt-1 block text-xs leading-5 text-slate-500">
                                    When disabled, this external candidate will not be able to log in to the examination portal.
                                </span>
                            </span>

                        </label>

                    </div>

                    <div class="mt-8 flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

                        <a href="{{ route('external-exam-students.show', $examUser) }}"
                           class="rounded-xl border border-white/10 bg-white/[0.03] px-5 py-3 text-center text-sm font-semibold text-slate-300 transition hover:bg-white/[0.07] hover:text-white">
                            Cancel
                        </a>

                        <button type="submit"
                                class="rounded-xl bg-indigo-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-400">
                            Save Changes
                        </button>

                    </div>

                </div>

            </form>

        </div>
    </div>

</x-layouts::examination>