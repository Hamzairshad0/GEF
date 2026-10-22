<x-layouts.app title="etaleem Magazine" image="/uploads/2025/04/Website-Cover.jpg">
    <x-page-hero title="etaleem Magazine" banner="/uploads/2025/04/Website-Cover.jpg" eyebrow="Downloadable Resources" lead="Our monthly magazine — read every issue online." />

    <section class="py-20 lg:py-28">
        <div class="container-x">
            @php($latest = $issues->first())
            @if ($latest)
                <div class="reveal mb-16 grid items-center gap-10 rounded-[2rem] bg-ink-950 p-6 text-white sm:p-10 lg:grid-cols-[0.6fr_1fr]">
                    <a href="{{ $latest->file_url }}" target="_blank" rel="noopener" class="group relative mx-auto block w-full max-w-xs">
                        <img src="{{ $latest->cover }}" alt="etaleem Magazine {{ $latest->title }} cover" class="w-full rounded-xl shadow-2xl transition duration-500 group-hover:-rotate-2 group-hover:scale-[1.03]">
                    </a>
                    <div>
                        <span class="rounded-full bg-saffron-400 px-3 py-1 text-xs font-bold tracking-wide text-ink-900 uppercase">Latest issue</span>
                        <h2 class="mt-5 font-display text-5xl font-semibold text-white">{{ $latest->title }}</h2>
                        <p class="mt-4 max-w-md text-white/70">Stories, achievements and news from Ghazali schools across Pakistan.</p>
                        <a href="{{ $latest->file_url }}" target="_blank" rel="noopener" class="btn-accent mt-8">Read this issue <x-icon name="eye" class="size-4" /></a>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-5">
                @foreach ($issues->skip(1) as $i => $issue)
                    <a href="{{ $issue->file_url }}" target="_blank" rel="noopener" class="reveal reveal-delay-{{ $i % 4 }} group block">
                        <div class="relative overflow-hidden rounded-xl bg-cream-200 shadow-md ring-1 ring-ink-900/5 transition duration-500 group-hover:-translate-y-2 group-hover:shadow-2xl">
                            <img src="{{ $issue->cover }}" alt="etaleem Magazine {{ $issue->title }} cover" class="aspect-[3/4] w-full object-cover" loading="lazy">
                            <span class="absolute inset-0 grid place-items-center bg-brand-900/70 opacity-0 transition group-hover:opacity-100">
                                <span class="flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-bold text-ink-900"><x-icon name="eye" class="size-4" /> View</span>
                            </span>
                        </div>
                        <p class="mt-3 font-semibold">{{ $issue->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
