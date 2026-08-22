<x-layouts::app :title="'Edit Student'">

<div class="mx-auto max-w-7xl space-y-6">

    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-3xl font-bold tracking-tight text-white">
                Edit Student
            </h1>

            <p class="mt-1 text-sm text-zinc-400">
                Update student information, photo and account status.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="rounded-full border border-yellow-500/20 bg-yellow-400/10 px-3 py-1.5 text-xs font-medium text-yellow-400">
                {{ $student->student_code }}
            </span>
        </div>

    </div>


    <form
        method="POST"
        action="{{ route('students.update', $student) }}"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="grid gap-6 xl:grid-cols-3">

            <!-- LEFT CONTENT -->
            <div class="space-y-6 xl:col-span-2">


                <!-- Personal Information -->
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-white">
                            Personal Information
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Basic information about the student.
                        </p>
                    </div>


                    <div class="grid gap-5 md:grid-cols-2">


                        <!-- First Name -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                First Name
                            </label>

                            <input
                                type="text"
                                name="first_name"
                                value="{{ old('first_name', $student->first_name) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition placeholder:text-zinc-500 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('first_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Last Name -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Last Name
                            </label>

                            <input
                                type="text"
                                name="last_name"
                                value="{{ old('last_name', $student->last_name) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('last_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Father's Name -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Father's Name
                            </label>

                            <input
                                type="text"
                                name="father_name"
                                value="{{ old('father_name', $student->father_name) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('father_name')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Mobile -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Mobile Number
                            </label>

                            <input
                                type="text"
                                name="mobile"
                                value="{{ old('mobile', $student->mobile) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('mobile')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- WhatsApp -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                WhatsApp Number
                            </label>

                            <input
                                type="text"
                                name="whatsapp"
                                value="{{ old('whatsapp', $student->whatsapp) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('whatsapp')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Email -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $student->email) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('email')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Date of Birth -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Date of Birth
                            </label>

                            <input
                                type="date"
                                name="dob"
                                value="{{ old('dob', $student->dob) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('dob')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Gender -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Gender
                            </label>

                            <select
                                name="gender"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                                <option value="">
                                    Select Gender
                                </option>

                                <option
                                    value="Male"
                                    {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}
                                >
                                    Male
                                </option>

                                <option
                                    value="Female"
                                    {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}
                                >
                                    Female
                                </option>

                                <option
                                    value="Other"
                                    {{ old('gender', $student->gender) == 'Other' ? 'selected' : '' }}
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



                <!-- Academic Information -->
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-white">
                            Academic Information
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Education and preparation details.
                        </p>
                    </div>


                    <div class="grid gap-5 md:grid-cols-2">


                        <!-- College -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                College
                            </label>

                            <input
                                type="text"
                                name="college"
                                value="{{ old('college', $student->college) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('college')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Course -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Course
                            </label>

                            <input
                                type="text"
                                name="course"
                                value="{{ old('course', $student->course) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('course')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        <!-- Preparing For -->
                        <div class="md:col-span-2">

                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Preparing For
                            </label>

                            <input
                                type="text"
                                name="preparing_for"
                                value="{{ old('preparing_for', $student->preparing_for) }}"
                                placeholder="UPSC, SSC, NEET..."
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
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



            <!-- RIGHT SIDEBAR -->
            <div class="space-y-6">


                <!-- Student Photo -->
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <div class="mb-5">
                        <h2 class="text-xl font-semibold text-white">
                            Student Photo
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Update the student's profile photo.
                        </p>
                    </div>


                    <div class="flex flex-col items-center">


                        <!-- Current Photo -->
                        <div class="flex h-40 w-40 items-center justify-center overflow-hidden rounded-full border-2 border-zinc-700 bg-zinc-800">

                            @if($student->photo)

                                <img
                                    src="{{ asset('storage/' . $student->photo) }}"
                                    alt="{{ $student->first_name }} {{ $student->last_name }}"
                                    class="h-full w-full object-cover"
                                >

                            @else

                                <div class="flex h-full w-full items-center justify-center text-sm font-medium text-zinc-500">
                                    No Photo
                                </div>

                            @endif

                        </div>


                        <!-- Upload -->
                        <div class="mt-5 w-full">

                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Change Photo
                            </label>

                            <input
                                type="file"
                                name="photo"
                                accept="image/*"
                                class="block w-full cursor-pointer rounded-xl border border-zinc-700 bg-zinc-800 px-3 py-2.5 text-sm text-zinc-400 file:mr-4 file:rounded-lg file:border-0 file:bg-yellow-400 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-black hover:file:bg-yellow-300"
                            >

                            <p class="mt-2 text-xs text-zinc-600">
                                JPG, JPEG or PNG recommended.
                            </p>

                            @error('photo')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>



                <!-- Membership -->
                <div class="rounded-2xl border border-zinc-700 bg-zinc-900 p-6">

                    <div class="mb-5">
                        <h2 class="text-xl font-semibold text-white">
                            Membership
                        </h2>

                        <p class="mt-1 text-sm text-zinc-500">
                            Manage joining date and student status.
                        </p>
                    </div>


                    <div class="space-y-5">


                        <!-- Joining Date -->
                        <div>

                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Joining Date
                            </label>

                            <input
                                type="date"
                                name="joining_date"
                                value="{{ old('joining_date', $student->joining_date) }}"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                            @error('joining_date')
                                <p class="mt-2 text-sm text-red-400">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        <!-- Status -->
                        <div>

                            <label class="mb-2 block text-sm font-medium text-zinc-400">
                                Status
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white outline-none transition focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/10"
                            >

                                <option
                                    value="Active"
                                    {{ old('status', $student->status) == 'Active' ? 'selected' : '' }}
                                >
                                    Active
                                </option>

                                <option
                                    value="Inactive"
                                    {{ old('status', $student->status) == 'Inactive' ? 'selected' : '' }}
                                >
                                    Inactive
                                </option>

                                <option
                                    value="Suspended"
                                    {{ old('status', $student->status) == 'Suspended' ? 'selected' : '' }}
                                >
                                    Suspended
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



        <!-- Actions -->
        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

            <a href="{{ route('students.index') }}">
                <flux:button variant="ghost">
                    Back to Students
                </flux:button>
            </a>


            <div class="flex gap-3">

                <a href="{{ route('students.show', $student) }}">
                    <flux:button variant="ghost">
                        View Student
                    </flux:button>
                </a>

                <flux:button
                    type="submit"
                    variant="primary"
                >
                    Update Student
                </flux:button>

            </div>

        </div>

    </form>

</div>

</x-layouts::app>