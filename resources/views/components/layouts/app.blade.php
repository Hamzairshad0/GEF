@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'overHero' => false,
])
@php
    $siteName = config('ghazali.name');
    $pageTitle = $title ? "{$title} | {$siteName}" : "{$siteName} | ".config('ghazali.tagline');
    $metaDescription = $description ?: 'Ghazali Education Foundation runs 850+ schools serving 125,000+ children across Pakistan. '.config('ghazali.vision').'.';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="theme-color" content="#9c0c11">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ url($image ?: '/uploads/2024/02/orphan-neddy.jpg') }}">
    <link rel="icon" type="image/png" href="/favicon.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400..700;1,9..144,400..600&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen">
    <a href="#main" class="sr-only z-[100] rounded-full bg-white px-4 py-2 focus:not-sr-only focus:fixed focus:top-3 focus:left-3">Skip to content</a>

    @include('partials.header', ['overHero' => $overHero])

    <main id="main">
        {{ $slot }}
    </main>

    @include('partials.donate-band')
    @include('partials.footer')
    @include('partials.lightbox')
</body>
</html>
