<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-neutral-950 antialiased">

    <div class="min-h-screen flex items-center justify-center px-4 py-8">

        <div class="w-full max-w-md">

            {{-- Malav Library Branding --}}
            <div class="mb-8 text-center">

                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center justify-center"
                    wire:navigate
                >

                    <img
                        src="{{ asset('images/malav-library-logo.png') }}"
                        alt="Malav Library"
                        class="h-20 w-20 object-contain"
                    >

                </a>

                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white">
                    Malav Library
                </h1>

                <p class="mt-1 text-sm font-semibold text-yellow-400">
                    Library ERP
                </p>

            </div>


            {{-- Login Content --}}
            <div class="flex flex-col gap-6">

                {{ $slot }}

            </div>


            {{-- Footer --}}
            <div class="mt-7 text-center">

                <p class="text-xs text-zinc-600">
                    © {{ now()->year }} Malav Library. All rights reserved.
                </p>

            </div>

        </div>

    </div>


    @persist('toast')

        <flux:toast.group>

            <flux:toast />

        </flux:toast.group>

    @endpersist


    @fluxScripts

</body>

</html>