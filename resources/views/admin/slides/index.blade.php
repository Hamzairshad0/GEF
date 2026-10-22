<x-layouts.admin title="Hero slides">
    <x-slot:actions>
        <a href="{{ route('admin.slides.create') }}" class="btn-primary"><x-icon name="plus" class="size-4" /> New slide</a>
    </x-slot:actions>

    <p class="-mt-4 mb-6 text-sm text-ink-500">These slides rotate in the home page banner, in display order.</p>
    <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($slides as $slide)
            <article class="overflow-hidden rounded-2xl bg-white ring-1 ring-ink-900/5 {{ $slide->is_active ? '' : 'opacity-60' }}">
                <div class="relative aspect-video">
                    <img src="{{ $slide->image }}" alt="" class="size-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-ink-950/80 to-transparent"></div>
                    <span class="absolute top-3 left-3 rounded-full bg-white px-2.5 py-0.5 text-xs font-bold">#{{ $slide->sort }}</span>
                    <p class="absolute right-4 bottom-3 left-4 font-display text-lg leading-tight font-semibold text-white">{{ $slide->title }}</p>
                </div>
                <div class="flex items-center justify-between gap-3 p-4">
                    <span class="text-xs font-bold {{ $slide->is_active ? 'text-emerald-700' : 'text-ink-500' }}">{{ $slide->is_active ? 'Active' : 'Hidden' }}</span>
                    <div class="flex gap-1">
                        <a href="{{ route('admin.slides.edit', $slide) }}" class="grid size-9 place-items-center rounded-full hover:bg-cream-100" aria-label="Edit"><x-icon name="pencil" class="size-4" /></a>
                        <form method="POST" action="{{ route('admin.slides.destroy', $slide) }}" onsubmit="return confirm('Remove this slide?')">
                            @csrf @method('DELETE')
                            <button class="grid size-9 place-items-center rounded-full text-brand-600 hover:bg-brand-50" aria-label="Delete"><x-icon name="trash" class="size-4" /></button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</x-layouts.admin>
