@php
    $contact = config('ghazali.contact');
    $nav = [
        ['label' => 'About Us', 'children' => [
            ['label' => 'About Us', 'route' => 'about', 'icon' => 'building', 'desc' => 'Our journey since 1997'],
            ['label' => 'Board of Directors / Governing Body', 'route' => 'board', 'icon' => 'users', 'desc' => 'The people who guide GEF'],
            ['label' => 'Our Departments', 'route' => 'departments', 'icon' => 'layout', 'desc' => 'Teams behind every classroom'],
            ['label' => 'Ambassadors', 'route' => 'ambassadors', 'icon' => 'sparkles', 'desc' => 'Voices that carry our mission'],
        ]],
        ['label' => 'Our Programs', 'route' => 'programs'],
        ['label' => 'Causes We Support', 'route' => 'causes'],
        ['label' => 'GEF Involve', 'children' => [
            ['label' => 'Volunteers', 'route' => 'volunteers', 'icon' => 'hand', 'desc' => "Join Pakistan's largest volunteer drive"],
            ['label' => 'Careers', 'route' => 'careers', 'icon' => 'briefcase', 'desc' => 'Work with us'],
            ['label' => 'Contact Us', 'route' => 'contact', 'icon' => 'chat', 'desc' => 'We would love to hear from you'],
        ]],
        ['label' => 'Resources', 'children' => [
            ['label' => 'Blogs', 'route' => 'blogs', 'icon' => 'pencil', 'desc' => 'Stories and insights'],
            ['label' => 'Newsletters', 'route' => 'newsletter', 'icon' => 'mail', 'desc' => 'English & Urdu editions'],
            ['label' => 'Annual Reports', 'route' => 'annual-reports', 'icon' => 'file', 'desc' => 'Our yearly impact'],
            ['label' => 'etaleem Magazine', 'route' => 'magazine', 'icon' => 'book', 'desc' => 'Monthly magazine'],
            ['label' => 'Audit Reports', 'route' => 'audit-reports', 'icon' => 'check', 'desc' => 'Full transparency'],
            ['label' => 'Media', 'route' => 'media', 'icon' => 'image', 'desc' => 'Videos & event galleries'],
        ]],
    ];
    $isActive = fn ($item) => isset($item['route'])
        ? request()->routeIs($item['route'])
        : collect($item['children'])->contains(fn ($c) => request()->routeIs($c['route']));
@endphp

{{-- Utility bar --}}
<div class="relative z-50 hidden bg-ink-950 text-xs text-white/70 md:block">
    <div class="container-x flex h-10 items-center justify-between">
        <div class="flex items-center gap-6">
            <a href="tel:{{ $contact['uan_tel'] }}" class="flex items-center gap-2 transition hover:text-white"><x-icon name="phone" class="size-3.5 text-saffron-400" /> UAN: {{ $contact['uan'] }}</a>
            <a href="mailto:{{ $contact['email'] }}" class="flex items-center gap-2 transition hover:text-white"><x-icon name="mail" class="size-3.5 text-saffron-400" /> {{ $contact['email'] }}</a>
            <span class="hidden items-center gap-2 lg:flex"><x-icon name="map-pin" class="size-3.5 text-saffron-400" /> {{ $contact['address'] }}</span>
        </div>
        <div class="flex items-center gap-1">
            @foreach (config('ghazali.social') as $network => $url)
                <a href="{{ $url }}" target="_blank" rel="noopener" class="grid size-7 place-items-center rounded-full transition hover:bg-white/10 hover:text-white" aria-label="{{ ucfirst($network) }}">
                    <x-icon :name="$network" class="size-3.5" />
                </a>
            @endforeach
        </div>
    </div>
</div>

<header data-header data-over-hero="{{ $overHero ? 'true' : 'false' }}"
        class="site-header {{ $overHero ? 'absolute md:top-10' : 'sticky' }} inset-x-0 top-0 z-40 bg-white/90 text-ink-900 shadow-[0_1px_0_rgba(0,0,0,0.06)] backdrop-blur-xl transition-all duration-500">
    <div class="container-x flex h-20 items-center justify-between gap-6 transition-all duration-500" data-header-inner>
        <a href="{{ route('home') }}" class="group flex shrink-0 items-center gap-3" aria-label="{{ config('ghazali.name') }} home">
            <span class="grid size-12 place-items-center rounded-2xl bg-white shadow-md ring-1 ring-black/5 transition group-hover:rotate-[-4deg]">
                <img src="/images/emblem.png" alt="" class="h-9 w-auto">
            </span>
            <span class="font-display text-lg leading-[1.05] font-semibold">
                Ghazali<br><span class="text-sm font-medium opacity-80">Education Foundation</span>
            </span>
        </a>

        <nav class="hidden items-center gap-1 xl:flex" aria-label="Main">
            @foreach ($nav as $item)
                @if (isset($item['children']))
                    <div class="group relative" data-dropdown>
                        <button type="button" class="nav-link flex items-center gap-1 whitespace-nowrap rounded-full px-3.5 py-2 text-sm font-semibold transition hover:text-brand-600 {{ $isActive($item) ? 'text-brand-600' : 'text-ink-800' }}" aria-expanded="false" data-dropdown-trigger>
                            {{ $item['label'] }} <x-icon name="chevron-down" class="size-4 transition group-hover:rotate-180 group-focus-within:rotate-180" />
                        </button>
                        <div class="invisible absolute top-full left-1/2 w-[22rem] -translate-x-1/2 translate-y-3 pt-3 opacity-0 transition duration-300 ease-out-expo group-hover:visible group-hover:translate-y-0 group-hover:opacity-100 group-focus-within:visible group-focus-within:translate-y-0 group-focus-within:opacity-100">
                            <div class="rounded-3xl bg-white p-2 text-ink-900 shadow-2xl ring-1 shadow-ink-900/10 ring-ink-900/5">
                                @foreach ($item['children'] as $child)
                                    <a href="{{ route($child['route']) }}" class="group/item flex items-start gap-3 rounded-2xl p-3 transition hover:bg-cream-100">
                                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-brand-50 text-brand-600 transition group-hover/item:bg-brand-600 group-hover/item:text-white"><x-icon :name="$child['icon']" class="size-5" /></span>
                                        <span>
                                            <span class="block text-sm font-semibold">{{ $child['label'] }}</span>
                                            <span class="block text-xs text-ink-500">{{ $child['desc'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route($item['route']) }}" class="nav-link whitespace-nowrap rounded-full px-3.5 py-2 text-sm font-semibold transition hover:text-brand-600 {{ $isActive($item) ? 'text-brand-600' : 'text-ink-800' }}">{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>

        <div class="flex items-center gap-2">
            <a href="{{ route('donate') }}" class="btn-primary hidden sm:inline-flex">
                <x-icon name="heart" class="size-4" /> Donate
            </a>
            <button type="button" class="grid size-11 place-items-center rounded-full bg-ink-900/5 xl:hidden" data-menu-open aria-label="Open menu">
                <x-icon name="menu" class="size-6" />
            </button>
        </div>
    </div>
</header>

{{-- Mobile menu --}}
<div class="fixed inset-0 z-[60] xl:hidden" data-menu hidden>
    <div class="absolute inset-0 bg-ink-950/60 opacity-0 backdrop-blur-sm transition duration-300" data-menu-overlay></div>
    <aside class="absolute inset-y-0 right-0 flex w-[min(24rem,100%)] translate-x-full flex-col bg-cream-50 shadow-2xl transition duration-500 ease-out-expo" data-menu-panel>
        <div class="flex items-center justify-between border-b border-ink-900/10 px-5 py-4">
            <img src="/images/logo.png" alt="{{ config('ghazali.name') }}" class="h-11 w-auto">
            <button type="button" class="grid size-11 place-items-center rounded-full bg-ink-900/5" data-menu-close aria-label="Close menu"><x-icon name="close" class="size-6" /></button>
        </div>
        <nav class="flex-1 overflow-y-auto px-3 py-4" aria-label="Mobile">
            @foreach ($nav as $item)
                @if (isset($item['children']))
                    <details class="group border-b border-ink-900/5" @if ($isActive($item)) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between px-3 py-4 font-display text-xl font-semibold">
                            {{ $item['label'] }} <x-icon name="chevron-down" class="size-5 transition group-open:rotate-180" />
                        </summary>
                        <div class="grid gap-1 pb-3 pl-3">
                            @foreach ($item['children'] as $child)
                                <a href="{{ route($child['route']) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium {{ request()->routeIs($child['route']) ? 'bg-brand-50 text-brand-700' : 'text-ink-700' }}">
                                    <x-icon :name="$child['icon']" class="size-4 text-brand-600" /> {{ $child['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </details>
                @else
                    <a href="{{ route($item['route']) }}" class="block border-b border-ink-900/5 px-3 py-4 font-display text-xl font-semibold {{ $isActive($item) ? 'text-brand-600' : '' }}">{{ $item['label'] }}</a>
                @endif
            @endforeach
        </nav>
        <div class="space-y-3 border-t border-ink-900/10 p-5">
            <a href="{{ route('donate') }}" class="btn-primary w-full"><x-icon name="heart" class="size-4" /> Donate Now</a>
            <a href="tel:{{ $contact['uan_tel'] }}" class="btn-outline w-full"><x-icon name="phone" class="size-4" /> {{ $contact['uan'] }}</a>
        </div>
    </aside>
</div>
