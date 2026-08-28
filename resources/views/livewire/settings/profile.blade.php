<section class="w-full">

    @include('partials.settings-heading')

    <flux:heading class="sr-only">
        {{ __('Profile settings') }}
    </flux:heading>

    <x-settings.layout
        :heading="__('Profile')"
        :subheading="__('Manage your account and library information')"
    >

        {{-- ========================================================= --}}
        {{-- PREMIUM PROFILE HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-6 rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5 shadow-xl shadow-black/10">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-yellow-500/30 bg-yellow-400/10 text-yellow-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                            />
                        </svg>
                    </div>

                    <div>
                        <flux:heading size="lg">
                            Profile & Library
                        </flux:heading>

                        <flux:text class="mt-0.5 text-sm text-zinc-400">
                            Manage your account, branding and library settings.
                        </flux:text>
                    </div>

                </div>

                <div class="flex items-center gap-2 rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1.5">
                    <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                    <span class="text-xs font-semibold text-emerald-400">
                        {{ ucfirst($libraryStatus ?? 'Active') }}
                    </span>
                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- PERSONAL + BASIC INFORMATION --}}
        {{-- ========================================================= --}}

        <div class="grid gap-5 lg:grid-cols-2">

            {{-- PERSONAL PROFILE --}}
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                <div class="mb-5 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-500/10 text-blue-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M15.75 6.75a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a7.5 7.5 0 0115 0"
                            />
                        </svg>
                    </div>

                    <div>
                        <flux:heading>
                            Personal Information
                        </flux:heading>

                        <flux:text class="text-xs text-zinc-500">
                            Administrator account details
                        </flux:text>
                    </div>

                </div>

                <form wire:submit="updateProfileInformation" class="space-y-4">

                    <flux:input
                        wire:model="name"
                        :label="__('Name')"
                        type="text"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <div>

                        <flux:input
                            wire:model="email"
                            :label="__('Email')"
                            type="email"
                            required
                            autocomplete="email"
                        />

                        @if ($this->hasUnverifiedEmail)

                            <flux:text class="mt-2 text-xs text-amber-400">
                                {{ __('Your email address is unverified.') }}

                                <flux:link
                                    class="cursor-pointer text-xs"
                                    wire:click.prevent="resendVerificationNotification"
                                >
                                    {{ __('Resend verification email') }}
                                </flux:link>
                            </flux:text>

                        @endif

                    </div>

                    <div class="pt-1">
                        <flux:button
                            variant="primary"
                            type="submit"
                        >
                            Save Profile
                        </flux:button>
                    </div>

                </form>

            </div>


            {{-- BASIC INFORMATION --}}
            <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                <div class="mb-5 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-yellow-400/10 text-yellow-400">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.7"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 6v12m-6-6h12"
                            />
                        </svg>
                    </div>

                    <div>
                        <flux:heading>
                            Library Identity
                        </flux:heading>

                        <flux:text class="text-xs text-zinc-500">
                            Basic library information
                        </flux:text>
                    </div>

                </div>

                <div class="grid gap-4 sm:grid-cols-2">

                    <flux:input
                        wire:model="libraryName"
                        :label="__('Library Name')"
                        type="text"
                        required
                    />

                    <flux:input
                        wire:model="libraryCode"
                        :label="__('Library Code')"
                        type="text"
                        disabled
                    />

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- LIBRARY SETTINGS --}}
        {{-- ========================================================= --}}

        <form
            wire:submit="updateLibraryInformation"
            class="mt-5 space-y-5"
        >

            {{-- ===================================================== --}}
            {{-- BRANDING --}}
            {{-- ===================================================== --}}

            <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                <div class="mb-4 flex items-center justify-between gap-4">

                    <div>
                        <flux:heading>
                            Library Branding
                        </flux:heading>

                        <flux:text class="mt-0.5 text-xs text-zinc-500">
                            Logo used across your ERP, receipts, ID cards and reports.
                        </flux:text>
                    </div>

                    <div class="hidden rounded-full border border-yellow-500/20 bg-yellow-400/10 px-3 py-1 text-xs font-medium text-yellow-400 sm:block">
                        Brand Identity
                    </div>

                </div>


                <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                    {{-- SMALL LOGO PREVIEW --}}

                    <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-zinc-700 bg-zinc-950 shadow-lg">

                        @if ($libraryLogo)

                            <img
                                src="{{ $libraryLogo->temporaryUrl() }}"
                                alt="Library logo preview"
                                class="h-full w-full object-contain p-2"
                            >

                        @elseif ($currentLogo ?? null)

                            <img
                                src="{{ asset('storage/' . $currentLogo) }}"
                                alt="{{ $libraryName }}"
                                class="h-full w-full object-contain p-2"
                            >

                        @else

                            <div class="flex h-full w-full items-center justify-center bg-yellow-400 text-3xl font-black text-black">
                                {{ strtoupper(substr($libraryName ?: 'L', 0, 1)) }}
                            </div>

                        @endif

                    </div>


                    {{-- UPLOAD --}}

                    <div class="min-w-0 flex-1">

                        <flux:input
                            wire:model="libraryLogo"
                            type="file"
                            :label="__('Library Logo')"
                            accept="image/png,image/jpeg,image/webp"
                        />

                        <flux:text class="mt-1 text-xs text-zinc-500">
                            PNG, JPG or WEBP • Maximum 2 MB
                        </flux:text>

                        @if ($currentLogo ?? null)

                            <flux:button
                                type="button"
                                variant="ghost"
                                class="mt-2"
                                wire:click="removeLibraryLogo"
                            >
                                Remove current logo
                            </flux:button>

                        @endif

                        @error('libraryLogo')
                            <flux:text class="mt-1 text-xs text-red-400">
                                {{ $message }}
                            </flux:text>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- CONTACT + ADDRESS --}}
            {{-- ===================================================== --}}

            <div class="grid gap-5 lg:grid-cols-2">

                {{-- CONTACT --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                    <div class="mb-5">
                        <flux:heading>
                            Contact Information
                        </flux:heading>

                        <flux:text class="mt-0.5 text-xs text-zinc-500">
                            Contact details for receipts and communication.
                        </flux:text>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">

                        <flux:input
                            wire:model="phone"
                            :label="__('Phone')"
                            type="text"
                            autocomplete="tel"
                            placeholder="+91"
                        />

                        <flux:input
                            wire:model="whatsapp"
                            :label="__('WhatsApp')"
                            type="text"
                            autocomplete="tel"
                            placeholder="+91"
                        />

                        <flux:input
                            wire:model="libraryEmail"
                            :label="__('Library Email')"
                            type="email"
                            autocomplete="email"
                            placeholder="library@example.com"
                        />

                        <flux:input
                            wire:model="website"
                            :label="__('Website')"
                            type="url"
                            placeholder="https://example.com"
                        />

                    </div>

                </div>


                {{-- ADDRESS --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                    <div class="mb-5">
                        <flux:heading>
                            Address
                        </flux:heading>

                        <flux:text class="mt-0.5 text-xs text-zinc-500">
                            Physical location of your library.
                        </flux:text>
                    </div>

                    <div class="space-y-4">

                        <flux:textarea
                            wire:model="address"
                            :label="__('Address')"
                            rows="2"
                        />

                        <div class="grid gap-3 sm:grid-cols-3">

                            <flux:input
                                wire:model="city"
                                :label="__('City')"
                                type="text"
                            />

                            <flux:input
                                wire:model="state"
                                :label="__('State')"
                                type="text"
                            />

                            <flux:input
                                wire:model="country"
                                :label="__('Country')"
                                type="text"
                            />

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- OPERATING + ERP --}}
            {{-- ===================================================== --}}

            <div class="grid gap-5 lg:grid-cols-2">

                {{-- OPERATING --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                    <div class="mb-5">
                        <flux:heading>
                            Operating Details
                        </flux:heading>

                        <flux:text class="mt-0.5 text-xs text-zinc-500">
                            Configure your library operating hours.
                        </flux:text>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">

                        <flux:input
                            wire:model="openingTime"
                            :label="__('Opening Time')"
                            type="time"
                            required
                        />

                        <flux:input
                            wire:model="closingTime"
                            :label="__('Closing Time')"
                            type="time"
                            required
                        />

                    </div>

                    <div class="mt-4 rounded-xl border border-zinc-800 bg-zinc-950/50 px-4 py-3">

                        <flux:switch
                            wire:model="sundayOpen"
                            label="Open on Sunday"
                            description="Allow Sunday operations for this library."
                        />

                    </div>

                </div>


                {{-- ERP SETTINGS --}}
                <div class="rounded-2xl border border-zinc-800 bg-zinc-900/60 p-5">

                    <div class="mb-5">
                        <flux:heading>
                            ERP Settings
                        </flux:heading>

                        <flux:text class="mt-0.5 text-xs text-zinc-500">
                            Configure identifiers used by your library.
                        </flux:text>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">

                        <flux:input
                            wire:model="currency"
                            :label="__('Currency')"
                            type="text"
                            required
                        />

                        <flux:input
                            wire:model="studentPrefix"
                            :label="__('Student ID Prefix')"
                            type="text"
                            required
                            maxlength="20"
                        />

                    </div>


                    {{-- STATUS --}}

                    <div class="mt-4 flex items-center justify-between rounded-xl border border-emerald-500/20 bg-emerald-500/5 px-4 py-3">

                        <div>

                            <flux:text class="text-sm font-medium">
                                Library Status
                            </flux:text>

                            <flux:text class="text-xs text-zinc-500">
                                {{ ucfirst($libraryStatus ?? 'Active') }}
                            </flux:text>

                        </div>

                        <div class="flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1.5 text-xs font-semibold text-emerald-400">

                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>

                            {{ ucfirst($libraryStatus ?? 'Active') }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- ===================================================== --}}
            {{-- SAVE BAR --}}
            {{-- ===================================================== --}}

            <div class="flex flex-col gap-4 rounded-2xl border border-zinc-800 bg-zinc-900/60 p-4 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <flux:text class="text-sm font-medium">
                        Library settings
                    </flux:text>

                    <flux:text class="text-xs text-zinc-500">
                        Changes will be applied across your library ERP.
                    </flux:text>

                </div>

                <flux:button
                    variant="primary"
                    type="submit"
                >
                    Save Library Settings
                </flux:button>

            </div>

        </form>


        {{-- ========================================================= --}}
        {{-- DELETE ACCOUNT --}}
        {{-- ========================================================= --}}

        @if ($this->showDeleteUser)

            <div class="mt-6 rounded-2xl border border-red-500/20 bg-red-500/5 p-5">

                <livewire:settings.delete-user-form />

            </div>

        @endif

    </x-settings.layout>

</section>