<a href="{{ $post->url() }}" class="reveal reveal-delay-{{ ($index ?? 0) % 3 }} group flex flex-col">
    <div class="aspect-[16/10] overflow-hidden rounded-3xl bg-cream-200">
        <img src="{{ $post->image() }}" alt="" class="size-full object-cover transition duration-700 ease-out-expo group-hover:scale-105" loading="lazy">
    </div>
    @if ($post->type === 'blog')
        <p class="mt-5 flex items-center gap-4 text-xs font-semibold text-ink-500">
            <span class="flex items-center gap-1.5"><x-icon name="calendar" class="size-3.5" /> {{ $post->published_at?->format('M j, Y') }}</span>
            <span class="flex items-center gap-1.5"><x-icon name="clock" class="size-3.5" /> {{ $post->readingTime() }} min read</span>
        </p>
    @endif
    <h3 class="mt-4 text-xl leading-snug font-semibold transition group-hover:text-brand-700">{{ $post->title }}</h3>
    <p class="mt-2 line-clamp-2 text-sm leading-6 text-ink-600">{{ $post->summary(140) }}</p>
</a>
