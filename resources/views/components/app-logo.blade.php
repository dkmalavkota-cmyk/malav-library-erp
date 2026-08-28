@php
    $library = auth()->user()?->library;
    $libraryName = $library?->name ?? 'Library';
    $libraryInitial = strtoupper(substr($libraryName, 0, 1));
@endphp

<div class="flex items-center gap-3">
    <div class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl bg-yellow-500 text-black font-black text-xl shadow-lg">
    @if($library?->logo)
        <img
            src="{{ asset('storage/' . $library->logo) }}"
            alt="{{ $libraryName }}"
            class="h-full w-full object-contain"
        >
    @else
        {{ $libraryInitial }}
    @endif
</div>

    <div class="leading-tight">
        <div class="text-sm font-bold text-white">
            {{ $libraryName }}
        </div>

        <div class="text-xs text-gray-400">
            Library ERP
        </div>
    </div>
</div>