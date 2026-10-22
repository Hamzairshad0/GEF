@php
    $leads = [
        'program' => 'Thirteen programs reaching rural children, orphans, special children, out-of-school youth and communities in crisis.',
        'department' => 'The dedicated teams that keep 850+ schools running, transparent and growing.',
        'campaign' => 'Pick a cause close to your heart — every rupee goes towards a child’s education.',
        'blog' => 'Insights, stories and ideas on education in Pakistan.',
    ];
    $crumbs = $type === 'department' ? ['About Us' => route('about')] : [];
@endphp
<x-layouts.app :title="$title" :image="$banner">
    <x-page-hero :title="$title" :banner="$banner" :crumbs="$crumbs" :lead="$leads[$type]" />

    <section class="py-20 lg:py-28">
        <div class="container-x">
            @if ($type === 'campaign')
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $i => $post)
                        @include('partials.cards.cause', ['post' => $post, 'index' => $i])
                    @endforeach
                </div>
            @elseif ($type === 'blog')
                @php($featured = $posts->onFirstPage() ? $posts->first() : null)
                @if ($featured)
                    <a href="{{ $featured->url() }}" class="reveal group mb-12 grid overflow-hidden rounded-[2rem] bg-white ring-1 ring-ink-900/5 lg:grid-cols-2">
                        <div class="aspect-[16/10] overflow-hidden lg:aspect-auto">
                            <img src="{{ $featured->image() }}" alt="" class="size-full object-cover transition duration-700 ease-out-expo group-hover:scale-105">
                        </div>
                        <div class="flex flex-col justify-center p-8 lg:p-14">
                            <span class="w-fit rounded-full bg-saffron-100 px-3 py-1 text-xs font-bold tracking-wide text-saffron-600 uppercase">Latest</span>
                            <h2 class="mt-5 text-3xl leading-tight font-semibold transition group-hover:text-brand-700 lg:text-4xl">{{ $featured->title }}</h2>
                            <p class="mt-4 text-ink-600">{{ $featured->summary(220) }}</p>
                            <p class="mt-6 flex items-center gap-4 text-sm text-ink-500">
                                <span class="flex items-center gap-1.5"><x-icon name="calendar" class="size-4" /> {{ $featured->published_at?->format('M j, Y') }}</span>
                                <span class="flex items-center gap-1.5"><x-icon name="clock" class="size-4" /> {{ $featured->readingTime() }} min read</span>
                            </p>
                        </div>
                    </a>
                @endif
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $i => $post)
                        @continue($featured && $post->is($featured))
                        @include('partials.cards.blog', ['post' => $post, 'index' => $i])
                    @endforeach
                </div>
                <div class="mt-14">{{ $posts->links() }}</div>
            @else
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $i => $post)
                        <a href="{{ $post->url() }}" class="reveal reveal-delay-{{ $i % 3 }} card-lift group relative flex flex-col overflow-hidden rounded-3xl bg-white ring-1 ring-ink-900/5">
                            <div class="relative aspect-[16/10] overflow-hidden">
                                <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="size-full object-cover transition duration-700 ease-out-expo group-hover:scale-110" loading="lazy">
                                <span class="absolute top-4 left-4 rounded-full bg-white/90 px-3 py-1 font-display text-sm font-semibold text-brand-700 backdrop-blur">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex flex-1 flex-col p-6">
                                <h2 class="font-display text-xl leading-snug font-semibold">{{ $post->title }}</h2>
                                <p class="mt-3 line-clamp-3 flex-1 text-sm leading-6 text-ink-600">{{ $post->summary(170) }}</p>
                                <span class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-brand-600">Learn More <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</x-layouts.app>
