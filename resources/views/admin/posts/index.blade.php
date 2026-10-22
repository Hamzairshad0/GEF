<x-layouts.admin :title="App\Models\Post::TYPES[$type]['plural']">
    <x-slot:actions>
        <a href="{{ route('admin.posts.create', ['type' => $type]) }}" class="btn-primary"><x-icon name="plus" class="size-4" /> New {{ Str::lower(App\Models\Post::TYPES[$type]['label']) }}</a>
    </x-slot:actions>

    <section class="overflow-hidden rounded-2xl bg-white ring-1 ring-ink-900/5">
        <ul class="divide-y divide-ink-900/5">
            @forelse ($posts as $post)
                <li class="flex items-center gap-4 px-5 py-4 hover:bg-cream-50">
                    <img src="{{ $post->image() }}" alt="" class="size-14 shrink-0 rounded-xl bg-cream-200 object-cover">
                    <div class="min-w-0 flex-1">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="block truncate font-semibold hover:text-brand-600">{{ $post->title }}</a>
                        <p class="text-xs text-ink-500">/{{ App\Models\Post::TYPES[$post->type]['prefix'] }}/{{ $post->slug }} · Order {{ $post->sort }} @if ($post->type === 'blog') · {{ $post->published_at?->format('M j, Y') }}@endif</p>
                    </div>
                    <span class="hidden rounded-full px-2.5 py-1 text-xs font-bold sm:inline {{ $post->is_published ? 'bg-emerald-50 text-emerald-700' : 'bg-ink-900/5 text-ink-500' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span>
                    <a href="{{ $post->url() }}" target="_blank" class="grid size-9 place-items-center rounded-full hover:bg-cream-100" aria-label="View"><x-icon name="eye" class="size-4" /></a>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="grid size-9 place-items-center rounded-full hover:bg-cream-100" aria-label="Edit"><x-icon name="pencil" class="size-4" /></a>
                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete “{{ addslashes($post->title) }}”? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button class="grid size-9 place-items-center rounded-full text-brand-600 hover:bg-brand-50" aria-label="Delete"><x-icon name="trash" class="size-4" /></button>
                    </form>
                </li>
            @empty
                <li class="px-5 py-10 text-center text-ink-500">Nothing here yet.</li>
            @endforelse
        </ul>
    </section>
    <div class="mt-6">{{ $posts->links() }}</div>
</x-layouts.admin>
