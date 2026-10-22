{{-- Newsletter, Annual Reports and Audit Reports --}}
<x-layouts.app :title="$title">
    <x-page-hero :title="$title" banner="/uploads/2024/02/our-departments-bg.jpg" eyebrow="Resources" lead="Download our publications to see how your support is put to work." />

    <section class="py-20 lg:py-28">
        <div class="container-x space-y-16">
            @foreach ($groups as $heading => $documents)
                <div>
                    @if ($heading)
                        <div class="reveal mb-8 flex items-center gap-4">
                            <h2 class="text-3xl font-semibold">{{ $heading }}</h2>
                            <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-bold text-brand-700">{{ $documents->count() }}</span>
                            <span class="h-px flex-1 bg-ink-900/10"></span>
                        </div>
                    @endif
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @foreach ($documents as $i => $doc)
                            <div class="reveal reveal-delay-{{ $i % 4 }} card-lift group relative flex items-center gap-4 rounded-2xl bg-white p-4 ring-1 ring-ink-900/5">
                                <span class="relative grid h-16 w-13 shrink-0 place-items-center rounded-lg bg-brand-600 text-white shadow-md transition group-hover:-rotate-6">
                                    <x-icon name="file" class="size-6" />
                                    <span class="absolute -bottom-1.5 rounded bg-ink-900 px-1.5 text-[9px] font-bold tracking-wider">PDF</span>
                                </span>
                                <a href="{{ $doc->file_url }}" target="_blank" rel="noopener" class="min-w-0 flex-1 after:absolute after:inset-0">
                                    <span class="block truncate font-semibold text-ink-900">{{ $doc->label() }}</span>
                                    <span class="text-xs text-ink-500">{{ $doc->language === 'ur' ? 'Urdu' : 'English' }}{{ $doc->year() ? ' · '.$doc->year() : '' }}</span>
                                </a>
                                <a href="{{ $doc->file_url }}" download class="relative z-10 grid size-10 shrink-0 place-items-center rounded-full bg-cream-100 text-ink-700 transition hover:bg-saffron-400 hover:text-ink-900" aria-label="Download {{ $doc->label() }}">
                                    <x-icon name="download" class="size-4" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layouts.app>
