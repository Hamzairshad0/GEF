<x-layouts.app :title="$title" :image="$banner">
    <x-page-hero :title="$title" :banner="$banner" :crumbs="['About Us' => route('about')]" :lead="$intro" />

    <section class="py-20 lg:py-28">
        <div class="container-x">
            <div class="grid grid-cols-2 gap-5 sm:gap-8 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($people as $i => $person)
                    <figure class="reveal reveal-delay-{{ $i % 4 }} group">
                        <div class="relative aspect-[4/5] overflow-hidden rounded-[1.75rem] bg-cream-200">
                            <img src="{{ $person->photo }}" alt="{{ $person->name }}" class="size-full object-cover object-top grayscale-[35%] transition duration-700 ease-out-expo group-hover:scale-105 group-hover:grayscale-0" loading="lazy">
                            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-brand-900/80 to-transparent opacity-0 transition duration-500 group-hover:opacity-100"></div>
                            @if ($person->role)
                                <span class="absolute top-3 left-3 rounded-full bg-white/90 px-3 py-1 text-[11px] font-bold tracking-wide text-brand-700 uppercase backdrop-blur">{{ $person->role }}</span>
                            @endif
                        </div>
                        <figcaption class="mt-4">
                            <p class="font-display text-lg leading-snug font-semibold text-ink-900">{{ $person->name }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
