@php($meta = App\Models\Post::TYPES[$post->type])
<x-layouts.admin :title="($post->exists ? 'Edit ' : 'New ').Str::lower($meta['label'])">
    @if ($post->exists)
        <x-slot:actions>
            <a href="{{ $post->url() }}" target="_blank" class="btn-outline"><x-icon name="eye" class="size-4" /> View on site</a>
        </x-slot:actions>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" class="grid gap-6 xl:grid-cols-[1fr_20rem]">
        @csrf
        @if ($post->exists) @method('PUT') @else <input type="hidden" name="type" value="{{ $post->type }}"> @endif

        <div class="space-y-5 rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
            @include('partials.form-errors')
            <label class="block"><span class="field-label">Title</span><input name="title" value="{{ old('title', $post->title) }}" required class="field text-lg font-semibold" data-slug-source></label>
            <label class="block">
                <span class="field-label">URL slug</span>
                <div class="flex items-center rounded-xl border border-ink-900/10 bg-cream-50 pl-4 text-sm text-ink-500 focus-within:border-brand-500">
                    /{{ $meta['prefix'] }}/
                    <input name="slug" value="{{ old('slug', $post->slug) }}" required class="w-full border-0 bg-transparent px-1 py-3 text-ink-900 focus:outline-none" data-slug-target>
                </div>
            </label>
            <label class="block"><span class="field-label">Excerpt (shown on cards)</span><textarea name="excerpt" rows="3" class="field">{{ old('excerpt', $post->excerpt) }}</textarea></label>
            <label class="block">
                <span class="field-label">Body (HTML)</span>
                <textarea name="body" rows="22" class="field font-mono text-xs leading-5">{{ old('body', $post->body) }}</textarea>
                <span class="mt-1 block text-xs text-ink-500">Use &lt;p&gt;, &lt;h2&gt;, &lt;h3&gt;, &lt;ul&gt;&lt;li&gt;, &lt;strong&gt;, &lt;a href&gt; and &lt;img src&gt;.</span>
            </label>
            <label class="block"><span class="field-label">SEO meta description</span><textarea name="meta_description" rows="2" class="field">{{ old('meta_description', $post->meta_description) }}</textarea></label>
        </div>

        <div class="space-y-5">
            <div class="space-y-4 rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
                <label class="flex items-center justify-between">
                    <span class="font-semibold">Published</span>
                    <input type="checkbox" name="is_published" value="1" class="size-5 accent-brand-600" @checked(old('is_published', $post->is_published))>
                </label>
                <label class="block"><span class="field-label">Publish date</span><input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="field"></label>
                <label class="block"><span class="field-label">Display order</span><input type="number" min="0" name="sort" value="{{ old('sort', $post->sort) }}" class="field"></label>
                <button class="btn-primary w-full">{{ $post->exists ? 'Save changes' : 'Create' }}</button>
            </div>
            @foreach (['banner' => 'Banner image', 'thumb' => 'Card thumbnail (optional)'] as $field => $label)
                <div class="rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
                    <p class="field-label">{{ $label }}</p>
                    @if ($post->$field)
                        <img src="{{ $post->$field }}" alt="" class="mb-3 aspect-video w-full rounded-xl object-cover">
                    @endif
                    <input type="file" name="{{ $field }}_file" accept="image/*" class="block w-full text-sm file:mr-3 file:rounded-full file:border-0 file:bg-cream-100 file:px-4 file:py-2 file:text-sm file:font-semibold">
                </div>
            @endforeach
        </div>
    </form>

    @unless ($post->exists)
        <script>
            // Suggest a slug from the title for new posts
            const source = document.querySelector('[data-slug-source]');
            const target = document.querySelector('[data-slug-target]');
            source.addEventListener('input', () => {
                if (target.dataset.touched) return;
                target.value = source.value.toLowerCase().normalize('NFKD').replace(/[^\w\s-]/g, '').trim().replace(/[\s_]+/g, '-');
            });
            target.addEventListener('input', () => (target.dataset.touched = '1'));
        </script>
    @endunless
</x-layouts.admin>
