<x-layouts.app title="Media">
    <x-page-hero title="Media" banner="/uploads/2024/02/EDS-MESSAGE-bg.jpg" eyebrow="Resources" lead="Watch our stories and browse photos from charity events across Pakistan." />

    {{-- Videos --}}
    <section class="py-20 lg:py-28">
        <div class="container-x">
            <div class="reveal flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <span class="eyebrow">Videos</span>
                    <h2 class="section-title mt-4">Watch GEF in action</h2>
                </div>
                <a href="{{ config('ghazali.social.youtube') }}" target="_blank" rel="noopener" class="btn-outline"><x-icon name="youtube" class="size-4 text-[#ff0000]" /> Subscribe on YouTube</a>
            </div>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($videos as $i => $video)
                    <a href="https://youtu.be/{{ $video->youtube_id }}" data-lightbox-item data-group="videos" data-youtube="{{ $video->youtube_id }}" data-caption="GEF video {{ $i + 1 }}"
                       class="reveal reveal-delay-{{ $i % 3 }} group relative block aspect-video overflow-hidden rounded-3xl bg-ink-900 {{ $i === 0 ? 'sm:col-span-2 lg:row-span-2 lg:aspect-auto' : '' }}">
                        <img src="{{ $video->thumbnail() }}" alt="" class="size-full object-cover opacity-90 transition duration-700 ease-out-expo group-hover:scale-105 group-hover:opacity-70" loading="lazy">
                        <span class="absolute inset-0 grid place-items-center">
                            <span class="grid size-16 place-items-center rounded-full bg-white/90 text-brand-600 shadow-2xl transition duration-500 group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white {{ $i === 0 ? 'lg:size-24' : '' }}">
                                <x-icon name="play" class="ml-1 size-6 {{ $i === 0 ? 'lg:size-9' : '' }}" />
                            </span>
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Charity event galleries --}}
    <section class="bg-cream-100 py-20 lg:py-28" data-filter-root>
        <div class="container-x">
            <div class="reveal">
                <span class="eyebrow">Gallery</span>
                <h2 class="section-title mt-4">{{ $galleries->first()?->event ?? 'Charity Events' }}</h2>
            </div>
            <div class="no-scrollbar -mx-5 mt-8 flex gap-2 overflow-x-auto px-5 pb-2 sm:mx-0 sm:flex-wrap sm:px-0" role="tablist">
                <button type="button" data-filter="all" aria-selected="true" class="shrink-0 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-sm font-semibold transition hover:border-brand-400 aria-selected:border-brand-600 aria-selected:bg-brand-600 aria-selected:text-white">All cities</button>
                @foreach ($galleries as $gallery)
                    <button type="button" data-filter="{{ $gallery->id }}" aria-selected="false" class="shrink-0 rounded-full border border-ink-900/10 bg-white px-4 py-2 text-sm font-semibold transition hover:border-brand-400 aria-selected:border-brand-600 aria-selected:bg-brand-600 aria-selected:text-white">
                        {{ $gallery->title }} <span class="opacity-60">{{ $gallery->images->count() }}</span>
                    </button>
                @endforeach
            </div>
            <div class="mt-10 columns-2 gap-4 md:columns-3 lg:columns-4">
                @foreach ($galleries as $gallery)
                    @foreach ($gallery->images as $image)
                        <a href="{{ $image->path }}" data-lightbox-item data-group="gallery" data-caption="{{ $gallery->title }}" data-filter-item="{{ $gallery->id }}"
                           class="group relative mb-4 block break-inside-avoid overflow-hidden rounded-2xl bg-cream-200">
                            <img src="{{ $image->path }}" alt="{{ $gallery->event }} — {{ $gallery->title }}" class="w-full transition duration-700 ease-out-expo group-hover:scale-105" loading="lazy" decoding="async">
                            <span class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/70 to-transparent p-3 text-xs font-semibold text-white opacity-0 transition group-hover:opacity-100">{{ $gallery->title }}</span>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
