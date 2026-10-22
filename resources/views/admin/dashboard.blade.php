<x-layouts.admin title="Dashboard">
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div class="rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
                <p class="text-xs font-bold tracking-widest text-ink-500 uppercase">{{ $stat['label'] }}</p>
                <p class="mt-3 font-display text-3xl font-semibold">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-[1.6fr_1fr]">
        <section class="rounded-2xl bg-white ring-1 ring-ink-900/5">
            <div class="flex items-center justify-between border-b border-ink-900/5 px-6 py-4">
                <h2 class="font-sans text-base font-bold">Latest donation pledges</h2>
                <a href="{{ route('admin.donations') }}" class="text-sm font-semibold text-brand-600">View all</a>
            </div>
            @include('admin.inbox.donation-table', ['donations' => $donations])
        </section>

        <section class="rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
            <h2 class="font-sans text-base font-bold">Content</h2>
            <ul class="mt-4 divide-y divide-ink-900/5">
                @foreach (App\Models\Post::TYPES as $type => $meta)
                    <li class="flex items-center justify-between py-3">
                        <a href="{{ route('admin.posts.index', ['type' => $type]) }}" class="font-medium hover:text-brand-600">{{ $meta['plural'] }}</a>
                        <span class="rounded-full bg-cream-100 px-2.5 py-0.5 text-sm font-semibold">{{ $postCounts[$type] ?? 0 }}</span>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</x-layouts.admin>
