{{-- Video stories from GEF's programs (the "start donating now!" video slider on the original site) --}}
@php($videos = config('ghazali.program_videos'))
<div class="reveal relative overflow-hidden rounded-[2rem] bg-ink-950 text-white shadow-2xl shadow-ink-900/10" data-vtabs data-duration="9000">
    <div class="grid lg:grid-cols-[1.2fr_1fr]">
        <div class="relative aspect-video lg:aspect-auto lg:min-h-[560px]">
            @foreach ($videos as $i => $video)
                <video class="absolute inset-0 size-full object-cover transition-opacity duration-700 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
                       data-vtab-video muted loop playsinline preload="{{ $i === 0 ? 'metadata' : 'none' }}" aria-hidden="true">
                    <source src="{{ $video['video'] }}" type="video/mp4">
                </video>
            @endforeach
            <div class="absolute inset-0 bg-gradient-to-t from-ink-950/80 via-transparent to-transparent lg:bg-gradient-to-r lg:from-transparent lg:via-transparent lg:to-ink-950"></div>
            <div class="absolute bottom-6 left-6 flex items-center gap-3 rounded-full bg-ink-950/50 py-2 pr-5 pl-2 backdrop-blur">
                <span class="grid size-9 place-items-center rounded-full bg-brand-600"><span class="size-2 animate-pulse rounded-full bg-white"></span></span>
                <span class="text-xs font-semibold tracking-widest uppercase">From our schools</span>
            </div>
        </div>
        <div class="flex flex-col justify-center px-6 py-12 sm:px-10 lg:px-12 xl:px-16">
            <span class="eyebrow !text-saffron-300">Start donating now!</span>
            <div class="relative mt-6 min-h-[13rem]">
                @foreach ($videos as $i => $video)
                    <div data-vtab-copy class="transition duration-700 ease-out-expo {{ $i === 0 ? '' : 'pointer-events-none absolute inset-0 translate-y-4 opacity-0' }}">
                        <h2 class="font-display text-3xl leading-tight font-semibold text-white text-balance sm:text-4xl">{{ $video['title'] }}</h2>
                        <p class="mt-5 text-lg leading-relaxed text-white/70">{{ $video['text'] }}</p>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 grid gap-1" role="tablist" aria-label="Program videos">
                @foreach ($videos as $i => $video)
                    <button type="button" role="tab" data-vtab="{{ $i }}" aria-selected="{{ $i === 0 ? 'true' : 'false' }}"
                            class="vtab group {{ $i === 0 ? 'is-active' : '' }} flex items-center gap-4 rounded-xl px-3 py-3 text-left transition hover:bg-white/5">
                        <span class="font-display text-sm text-white/40 tabular-nums group-[.is-active]:text-saffron-300">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="flex-1">
                            <span class="line-clamp-1 text-sm font-semibold text-white/60 transition group-hover:text-white group-[.is-active]:text-white">{{ $video['title'] }}</span>
                            <span class="mt-2 block h-0.5 overflow-hidden rounded bg-white/10"><span class="vbar block h-full bg-saffron-400"></span></span>
                        </span>
                    </button>
                @endforeach
            </div>
            <a href="{{ route('donate') }}" class="btn-accent mt-10 self-start">Donate Now <x-icon name="heart" class="size-4" /></a>
        </div>
    </div>
</div>
