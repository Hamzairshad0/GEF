<x-layouts.app title="Our Schools">
    <x-page-hero title="Our Schools" banner="/uploads/2024/02/our-departments-bg.jpg" eyebrow="GEF school’s network" />

    <section class="pt-20">
        <div class="container-x">
            <div class="reveal overflow-hidden rounded-[2rem] bg-white p-6 ring-1 ring-ink-900/5 sm:p-10">
                <img src="/uploads/2025/03/Pakistan_map.png" alt="Map of Pakistan showing the number of Ghazali schools in each district" class="mx-auto w-full max-w-4xl" loading="lazy">
            </div>
        </div>
    </section>

    @include('partials.schools-grid')
</x-layouts.app>
