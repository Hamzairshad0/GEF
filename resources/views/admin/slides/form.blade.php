<x-layouts.admin :title="$slide->exists ? 'Edit slide' : 'New slide'">
    <form method="POST" enctype="multipart/form-data" action="{{ $slide->exists ? route('admin.slides.update', $slide) : route('admin.slides.store') }}" class="grid gap-6 xl:grid-cols-[1fr_22rem]">
        @csrf
        @if ($slide->exists) @method('PUT') @endif
        <div class="space-y-5 rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
            @include('partials.form-errors')
            <label class="block"><span class="field-label">Small label above the title</span><input name="eyebrow" value="{{ old('eyebrow', $slide->eyebrow) }}" class="field" placeholder="Causes We Support"></label>
            <label class="block"><span class="field-label">Title</span><input name="title" value="{{ old('title', $slide->title) }}" required class="field text-lg font-semibold"></label>
            <label class="block"><span class="field-label">Subtitle</span><textarea name="subtitle" rows="3" class="field">{{ old('subtitle', $slide->subtitle) }}</textarea></label>
            <div class="grid gap-4 sm:grid-cols-2">
                <label class="block"><span class="field-label">Button label</span><input name="cta_label" value="{{ old('cta_label', $slide->cta_label) }}" class="field"></label>
                <label class="block"><span class="field-label">Button link</span><input name="cta_url" value="{{ old('cta_url', $slide->cta_url) }}" class="field" placeholder="/donate"></label>
            </div>
        </div>
        <div class="space-y-5">
            <div class="space-y-4 rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
                <label class="flex items-center justify-between"><span class="font-semibold">Active</span><input type="checkbox" name="is_active" value="1" class="size-5 accent-brand-600" @checked(old('is_active', $slide->is_active))></label>
                <label class="block"><span class="field-label">Display order</span><input type="number" min="0" name="sort" value="{{ old('sort', $slide->sort) }}" class="field"></label>
                <button class="btn-primary w-full">{{ $slide->exists ? 'Save changes' : 'Add slide' }}</button>
            </div>
            <div class="rounded-2xl bg-white p-6 ring-1 ring-ink-900/5">
                <p class="field-label">Background photo {{ $slide->exists ? '' : '*' }}</p>
                @if ($slide->image)<img src="{{ $slide->image }}" alt="" class="mb-3 aspect-video w-full rounded-xl object-cover">@endif
                <input type="file" name="image_file" accept="image/*" @unless ($slide->exists) required @endunless class="block w-full text-sm file:mr-3 file:rounded-full file:border-0 file:bg-cream-100 file:px-4 file:py-2 file:text-sm file:font-semibold">
                <p class="mt-2 text-xs text-ink-500">Landscape photo, at least 1920px wide. Text sits on the left, so keep faces centre or right.</p>
            </div>
        </div>
    </form>
</x-layouts.admin>
