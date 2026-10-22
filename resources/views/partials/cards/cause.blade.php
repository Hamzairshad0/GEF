@php
    $icons = [
        'make-a-library-in-ghazali-school' => 'book',
        'start-a-new-school' => 'school',
        'adopt-a-school' => 'building',
        'sponsor-a-disabled-child' => 'heart',
        'sponsor-an-orphan' => 'hand',
        'sponsor-a-students-college-education' => 'graduation',
    ];
@endphp
<article class="reveal reveal-delay-{{ ($index ?? 0) % 3 }} card-lift group relative flex flex-col overflow-hidden rounded-3xl bg-white ring-1 ring-ink-900/5">
    {{-- The badge sits outside the clipped image box so it can overlap the card body --}}
    <div class="relative">
        <div class="aspect-[16/10] overflow-hidden">
            <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="size-full object-cover transition duration-700 ease-out-expo group-hover:scale-110" loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-ink-950/50 to-transparent opacity-0 transition duration-500 group-hover:opacity-100"></div>
        </div>
        <span class="absolute -bottom-7 left-6 z-10 grid size-14 place-items-center rounded-2xl bg-brand-600 text-white shadow-lg ring-4 ring-white transition duration-500 group-hover:-rotate-6 group-hover:bg-saffron-400 group-hover:text-ink-900">
            <x-icon :name="$icons[$post->slug] ?? 'heart'" class="size-6" />
        </span>
    </div>
    <div class="flex flex-1 flex-col p-6 pt-10">
        <h3 class="text-xl leading-snug font-semibold">{{ $post->title }}</h3>
        <p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-ink-600">{{ $post->summary(160) }}</p>
        <div class="mt-6 flex items-center justify-between gap-3">
            <a href="{{ $post->url() }}" class="inline-flex items-center gap-2 text-sm font-bold text-brand-600 after:absolute after:inset-0">
                Learn More <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" />
            </a>
            <a href="{{ route('donate') }}" class="relative z-10 rounded-full bg-cream-100 px-4 py-2 text-xs font-bold text-ink-900 transition hover:bg-brand-600 hover:text-white">Donate</a>
        </div>
    </div>
</article>
