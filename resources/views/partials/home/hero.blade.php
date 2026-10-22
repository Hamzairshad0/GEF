{{--
    Home hero: copy on the left, photo on the right inside an arch (the dome from GEF's logo).
    Copy and photos crossfade together; driven by initHero() in resources/js/app.js.
--}}
<section class="relative isolate overflow-hidden bg-cream-100" data-hero data-duration="6500" aria-roledescription="carousel" aria-label="Featured causes">
    {{-- Quiet background texture --}}
    <div class="pointer-events-none absolute inset-0 -z-10 opacity-[0.35] [background-image:radial-gradient(var(--color-cream-300)_1.2px,transparent_1.2px)] [background-size:22px_22px] [mask-image:linear-gradient(to_right,black,transparent_60%)]"></div>
    <div class="pointer-events-none absolute -top-40 right-[-10rem] -z-10 size-[36rem] rounded-full bg-saffron-200/50 blur-3xl"></div>

    <div class="container-x grid items-center gap-10 py-10 sm:gap-12 sm:py-16 lg:grid-cols-[1.1fr_0.9fr] lg:gap-16 lg:py-10">
        {{-- Copy --}}
        <div class="order-2 lg:order-1">
            <div class="grid">
                @foreach ($slides as $i => $slide)
                    <div class="hero-copy {{ $i === 0 ? 'is-active' : '' }}" data-hero-slide aria-roledescription="slide" aria-label="{{ $i + 1 }} of {{ $slides->count() }}">
                        <p data-anim="1" class="inline-flex items-center gap-2 rounded-full bg-brand-600/10 px-3.5 py-1.5 text-xs font-bold tracking-[0.16em] text-brand-700 uppercase">
                            <span class="size-1.5 rounded-full bg-brand-600"></span>{{ $slide->eyebrow }}
                        </p>
                        <h1 data-anim="2" class="mt-6 font-display text-4xl leading-[1.08] font-semibold text-ink-900 text-balance sm:text-5xl lg:text-[2.9rem] xl:text-[3.4rem]">
                            {{ $slide->title }}
                        </h1>
                        <svg data-anim="2" class="mt-4 h-3 w-36 text-saffron-400" viewBox="0 0 150 12" fill="none" aria-hidden="true"><path d="M2 9C30 3 70 2 148 6" stroke="currentColor" stroke-width="4" stroke-linecap="round"/></svg>
                        @if ($slide->subtitle)
                            <p data-anim="3" class="mt-5 max-w-lg text-lg leading-relaxed text-ink-600">{{ $slide->subtitle }}</p>
                        @endif
                        <div data-anim="4" class="mt-8 flex flex-wrap items-center gap-3">
                            @if ($slide->cta_url)
                                <a href="{{ $slide->cta_url }}" class="btn-primary group px-7 py-3.5">
                                    {{ $slide->cta_label ?: 'Learn More' }}
                                    <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
                                </a>
                            @endif
                            <a href="{{ route('about') }}" class="btn-outline px-7 py-3.5">About GEF</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Arch-framed photos --}}
        <div class="relative order-1 mx-auto w-full max-w-md sm:max-w-lg lg:order-2 lg:max-w-none">
            <div class="absolute inset-0 translate-x-4 translate-y-4 rounded-t-full rounded-b-[2rem] border-2 border-brand-600/30 sm:translate-x-6 sm:translate-y-6" aria-hidden="true"></div>
            {{-- On desktop the arch height follows the viewport so the whole hero fits above the fold --}}
            <div class="relative aspect-square overflow-hidden rounded-t-full sm:aspect-[4/4.4] rounded-b-[2rem] bg-cream-200 shadow-2xl shadow-brand-900/20 lg:aspect-auto lg:h-[clamp(26rem,calc(100svh-12rem),38rem)]">
                @foreach ($slides as $i => $slide)
                    <div class="hero-image {{ $i === 0 ? 'is-active' : '' }}" data-hero-image>
                        <img src="{{ $slide->image }}" alt="" class="size-full object-cover" @if ($i > 0) loading="lazy" @else fetchpriority="high" @endif>
                    </div>
                @endforeach
            </div>

            {{-- Controls: a solid bar on the photo --}}
            <div class="absolute bottom-4 left-1/2 z-10 flex -translate-x-1/2 items-center gap-2 rounded-full bg-white p-1.5 shadow-xl ring-1 ring-ink-900/5 sm:gap-3">
                <button type="button" class="grid size-10 place-items-center rounded-full text-ink-800 transition hover:bg-cream-100" data-hero-prev aria-label="Previous slide"><x-icon name="arrow-left" class="size-4" /></button>
                <div class="flex items-center gap-1.5" role="tablist" aria-label="Choose slide">
                    @foreach ($slides as $i => $slide)
                        <button type="button" role="tab" data-hero-tab="{{ $i }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}" aria-label="{{ $slide->title }}"
                                class="hero-tab {{ $i === 0 ? 'is-active' : '' }} group relative h-6 w-3.5 transition-[width] duration-500 ease-out-expo sm:w-5 [&.is-active]:w-10 sm:[&.is-active]:w-12">
                            <span class="absolute inset-x-0 top-1/2 block h-[3px] -translate-y-1/2 overflow-hidden rounded-full bg-ink-900/15 transition group-hover:bg-ink-900/30">
                                <span class="bar block h-full rounded-full bg-brand-600"></span>
                            </span>
                        </button>
                    @endforeach
                </div>
                <span class="sr-only">Slide <span data-hero-current>01</span> of {{ $slides->count() }}</span>
                <button type="button" class="grid size-8 place-items-center rounded-full text-ink-500 transition hover:text-ink-900" data-hero-toggle aria-label="Pause slideshow">
                    <x-icon name="pause" class="size-3" data-icon-pause />
                    <x-icon name="play" class="hidden size-3" data-icon-play />
                </button>
                <button type="button" class="grid size-10 place-items-center rounded-full bg-brand-600 text-white transition hover:bg-brand-700" data-hero-next aria-label="Next slide"><x-icon name="arrow-right" class="size-4" /></button>
            </div>

            {{-- Students chip --}}
            <div class="absolute top-[42%] -left-3 hidden items-center gap-3 rounded-2xl bg-white p-3 pr-5 shadow-xl ring-1 ring-ink-900/5 sm:flex lg:-left-10">
                <span class="grid size-11 place-items-center rounded-xl bg-saffron-400 text-ink-900"><x-icon name="students" class="size-5" /></span>
                <span>
                    <span class="block font-display text-xl leading-none font-semibold text-ink-900">125,000+</span>
                    <span class="text-xs text-ink-500">students learning today</span>
                </span>
            </div>

            {{-- Rotating seal --}}
            <div class="absolute -top-3 -right-1 hidden size-28 sm:block lg:-right-6" aria-hidden="true">
                <svg viewBox="0 0 120 120" class="size-full animate-[spin_24s_linear_infinite] text-brand-700">
                    <defs><path id="hero-seal" d="M60 60m-46 0a46 46 0 1 1 92 0a46 46 0 1 1-92 0"/></defs>
                    <circle cx="60" cy="60" r="58" fill="white"/>
                    <text font-size="10.5" font-weight="700" letter-spacing="2.6" fill="currentColor"><textPath href="#hero-seal">SINCE 1997 • GHAZALI EDUCATION •</textPath></text>
                </svg>
                <img src="/images/emblem.png" alt="" class="absolute top-1/2 left-1/2 h-11 -translate-x-1/2 -translate-y-1/2">
            </div>
        </div>
    </div>
</section>
