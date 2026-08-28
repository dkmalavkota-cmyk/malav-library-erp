@php
    $libraryName = auth()->user()?->library?->name ?? 'Library ERP';

    $pageTitle = filled($title ?? null)
        ? $title . ' - ' . $libraryName
        : $libraryName;
@endphp

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $pageTitle }}</title>

<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

@fonts

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance