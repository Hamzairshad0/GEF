@props(['title', 'banner' => null, 'eyebrow' => null, 'crumbs' => [], 'lead' => null])
<section class="relative isolate overflow-hidden bg-ink-950 text-white">
    @if ($banner)
        <img src="{{ $banner }}" alt="" class="absolute inset-0 -z-10 size-full scale-105 object-cover opacity-60 animate-kenburns" fetchpriority="high">
    @endif
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-ink-950 via-ink-950/60 to-ink-950/20"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-brand-900/70 to-transparent"></div>
    <div class="container-x pt-20 pb-16 sm:pt-28 sm:pb-20">
        <nav aria-label="Breadcrumb" class="reveal is-visible">
            <ol class="flex flex-wrap items-center gap-2 text-xs font-semibold text-white/60">
                <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                @foreach ($crumbs as $label => $url)
                    <li class="flex items-center gap-2"><x-icon name="chevron-right" class="size-3" /><a href="{{ $url }}" class="transition hover:text-white">{{ $label }}</a></li>
                @endforeach
                <li class="flex items-center gap-2"><x-icon name="chevron-right" class="size-3" /><span class="text-saffron-300" aria-current="page">{{ Str::limit($title, 50) }}</span></li>
            </ol>
        </nav>
        @if ($eyebrow)
            <p class="mt-8 text-xs font-bold tracking-[0.2em] text-saffron-300 uppercase">{{ $eyebrow }}</p>
        @endif
        <h1 class="{{ $eyebrow ? 'mt-3' : 'mt-8' }} max-w-4xl font-display text-4xl leading-[1.05] font-semibold text-white text-balance sm:text-5xl lg:text-6xl">{{ $title }}</h1>
        @if ($lead)
            <p class="mt-5 max-w-2xl text-lg text-white/75">{{ $lead }}</p>
        @endif
        {{ $slot }}
    </div>
</section>
