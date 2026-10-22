@props(['title' => 'Dashboard'])
@php
    $links = [
        ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => 'layout'],
        ['route' => 'admin.slides.index', 'label' => 'Hero slides', 'icon' => 'image', 'match' => 'admin.slides.*'],
    ];
    foreach (App\Models\Post::TYPES as $type => $meta) {
        $links[] = ['url' => route('admin.posts.index', ['type' => $type]), 'label' => $meta['plural'], 'icon' => 'file', 'type' => $type];
    }
    $inbox = [
        ['route' => 'admin.donations', 'label' => 'Donations', 'icon' => 'heart'],
        ['route' => 'admin.messages', 'label' => 'Messages', 'icon' => 'mail', 'count' => App\Models\ContactMessage::whereNull('read_at')->count()],
        ['route' => 'admin.volunteers', 'label' => 'Volunteers', 'icon' => 'hand', 'count' => App\Models\VolunteerApplication::whereNull('read_at')->count()],
    ];
    $currentType = request('type', request()->route('post')?->type);
    $isActive = function ($link) use ($currentType) {
        if (isset($link['type'])) {
            return request()->routeIs('admin.posts.*') && $currentType === $link['type'];
        }
        return request()->routeIs($link['match'] ?? $link['route']);
    };
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>{{ $title }} · GEF Admin</title>
    <link rel="icon" type="image/png" href="/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500..700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-cream-100">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-[16rem_1fr]">
        <aside class="bg-ink-950 text-white/70 lg:sticky lg:top-0 lg:h-screen lg:overflow-y-auto">
            <div class="flex items-center gap-3 px-5 py-5">
                <span class="grid size-10 place-items-center rounded-xl bg-white"><img src="/images/emblem.png" alt="" class="h-7"></span>
                <span class="font-display text-lg font-semibold text-white">GEF Admin</span>
            </div>
            <nav class="no-scrollbar flex gap-1 overflow-x-auto px-3 pb-3 lg:flex-col lg:overflow-visible">
                @foreach ($links as $link)
                    <a href="{{ $link['url'] ?? route($link['route']) }}" class="flex shrink-0 items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $isActive($link) ? 'bg-white/10 text-white' : 'hover:bg-white/5 hover:text-white' }}">
                        <x-icon :name="$link['icon']" class="size-4" /> {{ $link['label'] }}
                    </a>
                @endforeach
                <p class="mt-4 hidden px-3 text-[11px] font-bold tracking-widest text-white/40 uppercase lg:block">Inbox</p>
                @foreach ($inbox as $link)
                    <a href="{{ route($link['route']) }}" class="flex shrink-0 items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition {{ $isActive($link) ? 'bg-white/10 text-white' : 'hover:bg-white/5 hover:text-white' }}">
                        <x-icon :name="$link['icon']" class="size-4" /> {{ $link['label'] }}
                        @if (($link['count'] ?? 0) > 0)
                            <span class="ml-auto rounded-full bg-saffron-400 px-2 text-xs font-bold text-ink-900">{{ $link['count'] }}</span>
                        @endif
                    </a>
                @endforeach
            </nav>
            <div class="hidden border-t border-white/10 p-3 lg:block">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm hover:bg-white/5 hover:text-white"><x-icon name="globe" class="size-4" /> View website</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm hover:bg-white/5 hover:text-white"><x-icon name="logout" class="size-4" /> Log out</button>
                </form>
            </div>
        </aside>

        <main class="min-w-0 p-5 sm:p-8 lg:p-10">
            <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                <h1 class="font-display text-3xl font-semibold">{{ $title }}</h1>
                {{ $actions ?? '' }}
            </div>
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-2xl bg-emerald-50 px-5 py-3 text-sm font-medium text-emerald-800 ring-1 ring-emerald-200"><x-icon name="check" class="size-4" stroke="2.5" /> {{ session('success') }}</div>
            @endif
            {{ $slot }}
        </main>
    </div>
</body>
</html>
