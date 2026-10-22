@php
    $meta = App\Models\Post::TYPES[$post->type];
    $crumbs = match ($post->type) {
        'program' => ['Our Programs' => route('programs')],
        'department' => ['Our Departments' => route('departments')],
        'campaign' => ['Causes We Support' => route('causes')],
        'blog' => ['Blogs' => route('blogs')],
        default => [],
    };
    $causeMap = [
        'make-a-library-in-ghazali-school' => 'General Donation',
        'start-a-new-school' => 'Start a new School',
        'adopt-a-school' => 'Adopt a School',
        'sponsor-a-disabled-child' => 'Sponsor a disabled Child',
        'sponsor-an-orphan' => 'Educate an Orphan',
        'sponsor-a-students-college-education' => 'Sponsor a Residential College Student',
    ];
@endphp
<x-layouts.app :title="$post->title" :description="$post->meta_description ?: $post->summary(155)" :image="$post->banner">
    <x-page-hero :title="$post->title" :banner="$post->banner" :eyebrow="$meta['label']" :crumbs="$crumbs">
        @if ($post->type === 'blog')
            <p class="mt-6 flex flex-wrap items-center gap-5 text-sm text-white/70">
                <span class="flex items-center gap-2"><x-icon name="calendar" class="size-4" /> {{ $post->published_at?->format('F j, Y') }}</span>
                <span class="flex items-center gap-2"><x-icon name="clock" class="size-4" /> {{ $post->readingTime() }} min read</span>
            </p>
        @endif
    </x-page-hero>

    <section class="py-16 lg:py-24">
        <div class="container-x grid gap-14 lg:grid-cols-[minmax(0,1fr)_22rem]">
            <article class="prose-gef reveal max-w-3xl">
                {!! $post->body !!}
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                @if ($post->type === 'campaign')
                    <div class="rounded-3xl bg-ink-950 p-6 text-white shadow-xl">
                        <p class="font-display text-2xl font-semibold text-white">Support this cause</p>
                        <p class="mt-2 text-sm text-white/60">Pledge your donation and our team will contact you.</p>
                        <div class="mt-5">
                            @include('partials.donate-form', ['variant' => 'dark', 'cause' => $causeMap[$post->slug] ?? 'General Donation'])
                        </div>
                    </div>
                @else
                    <div class="overflow-hidden rounded-3xl bg-brand-700 p-7 text-white grain relative">
                        <x-icon name="heart" class="size-8 text-saffron-300" />
                        <p class="mt-4 font-display text-2xl leading-snug font-semibold text-white">Help us make Pakistan 100% literate.</p>
                        <a href="{{ route('donate') }}" class="btn-accent mt-6 w-full">Donate Now</a>
                    </div>
                @endif

                <div class="rounded-3xl bg-white p-6 ring-1 ring-ink-900/5">
                    <p class="text-xs font-bold tracking-widest text-ink-500 uppercase">Share</p>
                    <div class="mt-3 flex gap-2">
                        @php($shareUrl = urlencode($post->url()))
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-cream-100 transition hover:bg-brand-600 hover:text-white" aria-label="Share on Facebook"><x-icon name="facebook" class="size-4" /></a>
                        <a href="https://x.com/intent/post?url={{ $shareUrl }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-cream-100 transition hover:bg-brand-600 hover:text-white" aria-label="Share on X"><x-icon name="x" class="size-4" /></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-cream-100 transition hover:bg-brand-600 hover:text-white" aria-label="Share on LinkedIn"><x-icon name="linkedin" class="size-4" /></a>
                        <a href="https://wa.me/?text={{ urlencode($post->title.' '.$post->url()) }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-cream-100 transition hover:bg-brand-600 hover:text-white" aria-label="Share on WhatsApp"><x-icon name="whatsapp" class="size-4" /></a>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    @if ($related->isNotEmpty())
        <section class="border-t border-ink-900/5 bg-cream-100 py-20">
            <div class="container-x">
                <div class="flex items-end justify-between gap-6">
                    <h2 class="section-title">More {{ Str::lower($meta['plural']) === 'blogs' ? 'from the blog' : $meta['plural'] }}</h2>
                    @if ($meta['index'] !== 'home')
                        <a href="{{ route($meta['index']) }}" class="btn-outline hidden sm:inline-flex">View all <x-icon name="arrow-right" class="size-4" /></a>
                    @endif
                </div>
                <div class="mt-10 grid gap-8 md:grid-cols-3">
                    @foreach ($related as $i => $item)
                        @include('partials.cards.blog', ['post' => $item, 'index' => $i])
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
