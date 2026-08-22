<x-layouts::app :title="'Add Student'">

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Page Header --}}
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold text-white">
                Add New Student
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Enter student information below.
            </p>
        </div>

    </div>


    {{-- Form --}}
    <form
        method="POST"
        action="{{ route('students.store') }}"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="grid gap-6 xl:grid-cols-3">


            {{-- ========================================================= --}}
            {{-- LEFT SIDE --}}
            {{-- ========================================================= --}}

            <div class="space-y-6 xl:col-span-2">


                {{-- Personal Information --}}
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <h2 class="mb-6 text-xl font-semibold text-white">
                        Personal Information
                    </h2>


                    <div class="grid gap-5 md:grid-cols-2">


                        {{-- First Name --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                First Name
                            </label>

                            <input
                                type="text"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('first_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Last Name --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Last Name
                            </label>

                            <input
                                type="text"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('last_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Father's Name --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Father's Name
                            </label>

                            <input
                                type="text"
                                name="father_name"
                                value="{{ old('father_name') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('father_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Mobile --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Mobile Number
                            </label>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('mobile')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- WhatsApp --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                WhatsApp Number
                            </label>

                            <input
                                type="text"
                                name="whatsapp"
                                value="{{ old('whatsapp') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('whatsapp')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Date of Birth --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Date of Birth
                            </label>

                            <input
                                type="date"
                                name="dob"
                                value="{{ old('dob') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('dob')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Gender --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Gender
                            </label>

                            <select
                                name="gender"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                                <option value="">
                                    Select Gender
                                </option>

                                <option
                                    value="Male"
                                    {{ old('gender') == 'Male' ? 'selected' : '' }}
                                >
                                    Male
                                </option>

                                <option
                                    value="Female"
                                    {{ old('gender') == 'Female' ? 'selected' : '' }}
                                >
                                    Female
                                </option>

                                <option
                                    value="Other"
                                    {{ old('gender') == 'Other' ? 'selected' : '' }}
                                >
                                    Other
                                </option>

                            </select>

                            @error('gender')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Academic Information --}}
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <h2 class="mb-6 text-xl font-semibold text-white">
                        Academic Information
                    </h2>


                    <div class="grid gap-5 md:grid-cols-2">


                        {{-- College --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                College
                            </label>

                            <input
                                type="text"
                                name="college"
                                value="{{ old('college') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('college')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Course --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Course
                            </label>

                            <input
                                type="text"
                                name="course"
                                value="{{ old('course') }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('course')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Preparing For --}}
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-sm text-zinc-400">
                                Preparing For
                            </label>

                            <input
                                type="text"
                                name="preparing_for"
                                value="{{ old('preparing_for') }}"
                                placeholder="UPSC, SSC, NEET..."
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white placeholder:text-zinc-500 focus:border-yellow-500 focus:outline-none"
                            >

                            @error('preparing_for')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================= --}}
            {{-- RIGHT SIDEBAR --}}
            {{-- ========================================================= --}}

            <div class="space-y-6">


                {{-- Student Photo --}}
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <div class="mb-5">

                        <h2 class="text-xl font-semibold text-white">
                            Student Photo
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Upload a clear profile photo.
                        </p>

                    </div>


                    <div class="flex items-center gap-4">

                        {{-- Compact Preview --}}
                        <div
                            id="photoPreview"
                            class="flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-xl border-2 border-dashed border-zinc-600 bg-zinc-800 text-center text-xs text-zinc-500"
                        >
                            No Photo
                        </div>


                        {{-- Upload --}}
                        <div class="min-w-0 flex-1">

                            <label
                                for="photo"
                                class="block cursor-pointer rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-center text-sm text-zinc-300 transition hover:border-yellow-500 hover:text-white"
                            >
                                Choose Photo
                            </label>

                            <input
                                id="photo"
                                type="file"
                                name="photo"
                                accept="image/*"
                                class="hidden"
                            >

                            <p class="mt-2 text-xs text-zinc-500">
                                JPG, JPEG or PNG
                            </p>

                        </div>

                    </div>


                    @error('photo')
                        <p class="mt-3 text-sm text-red-400">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Membership --}}
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <h2 class="mb-5 text-xl font-semibold text-white">
                        Membership
                    </h2>


                    <div class="space-y-5">


                        {{-- Joining Date --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Joining Date
                            </label>

                            <input
                                type="date"
                                name="joining_date"
                                value="{{ old('joining_date', now()->format('Y-m-d')) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                            @error('joining_date')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Status --}}
                        <div>

                            <label class="mb-2 block text-sm text-zinc-400">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white focus:border-yellow-500 focus:outline-none"
                            >

                                <option
                                    value="Active"
                                    {{ old('status', 'Active') == 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    {{ old('status') == 'Inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- FORM ACTIONS --}}
        {{-- ========================================================= --}}

        <div class="mt-6 flex flex-col gap-3 border-t border-zinc-800 pt-6 sm:flex-row sm:items-center sm:justify-between">

            {{-- Back --}}
            <a href="{{ route('students.index') }}">

                <flux:button
                    type="button"
                    variant="ghost"
                >
                    ← Back to Students
                </flux:button>

            </a>


            {{-- Save --}}
            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-xl bg-yellow-500 px-7 py-3 font-semibold text-black transition hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500/50"
            >
                Save Student
            </button>

        </div>


    </form>

</div>


{{-- Photo Preview --}}
<script>

    document
        .getElementById('photo')
        .addEventListener('change', function (event) {

            const file = event.target.files[0];

            const preview = document.getElementById('photoPreview');

            if (!file) {

                preview.innerHTML = 'No Photo';

                return;

            }


            const reader = new FileReader();


            reader.onload = function (e) {

                preview.innerHTML = `
                    <img
                        src="${e.target.result}"
                        class="h-full w-full object-cover"
                        alt="Student Photo"
                    >
                `;

            };


            reader.readAsDataURL(file);

        });

</script>


</x-layouts::app>