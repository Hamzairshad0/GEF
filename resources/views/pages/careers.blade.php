<x-layouts.app title="Careers">
    <x-page-hero title="Careers" banner="/uploads/2024/02/our-departments-bg.jpg" eyebrow="GEF Involve" />

    <section class="py-24 lg:py-32">
        <div class="container-x">
            <div class="reveal mx-auto max-w-2xl rounded-[2rem] bg-white p-10 text-center ring-1 ring-ink-900/5 sm:p-14">
                <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-brand-50 text-brand-600"><x-icon name="briefcase" class="size-8" /></span>
                <h2 class="mt-6 text-4xl font-semibold">Coming Soon</h2>
                <p class="mt-4 text-lg text-ink-600">Openings at Ghazali Education Foundation will be listed here. Meanwhile, you can join us as a volunteer.</p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('volunteers') }}" class="btn-primary">Become a volunteer <x-icon name="arrow-right" class="size-4" /></a>
                    <a href="mailto:{{ config('ghazali.contact.email') }}" class="btn-outline">{{ config('ghazali.contact.email') }}</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
