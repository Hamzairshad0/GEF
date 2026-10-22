{{-- Shared lightbox for photo galleries and YouTube videos (driven by resources/js/app.js) --}}
<div class="fixed inset-0 z-[70] flex items-center justify-center bg-ink-950/95 p-4 backdrop-blur" data-lightbox hidden role="dialog" aria-modal="true" aria-label="Media viewer">
    <button type="button" class="absolute top-4 right-4 grid size-12 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-900" data-lightbox-close aria-label="Close"><x-icon name="close" class="size-6" /></button>
    <button type="button" class="absolute left-3 grid size-12 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-900 sm:left-6" data-lightbox-prev aria-label="Previous"><x-icon name="chevron-left" class="size-6" /></button>
    <button type="button" class="absolute right-3 grid size-12 place-items-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-900 sm:right-6" data-lightbox-next aria-label="Next"><x-icon name="chevron-right" class="size-6" /></button>
    <figure class="flex max-h-full w-full max-w-6xl flex-col items-center">
        <div class="flex w-full items-center justify-center" data-lightbox-stage></div>
        <figcaption class="mt-4 text-sm text-white/60" data-lightbox-caption></figcaption>
    </figure>
</div>
