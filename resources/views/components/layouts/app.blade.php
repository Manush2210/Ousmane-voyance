<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/layout/logo.png') }}">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:site_name" content="Voyance Spirituelle Expert">
    <meta property="og:title" content="{{ $title ?? 'Voyance Spirituelle Expert' }}">
    <meta property="og:description"
        content="{{ $description ?? 'Voyance Spirituelle Expert - Services de voyance en ligne et de lithothérapie ' }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('assets/images/layout/logo.png') }}">

    <title>{{ $title ?? 'Voyance Spirituelle Expert' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles()
</head>

<body>
    @livewire('layout.navbar')
    {{ $slot }}
    @livewire('components.layout.footer')
    @livewire('components.product.cart-updated')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
