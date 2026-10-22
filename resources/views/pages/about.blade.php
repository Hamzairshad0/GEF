<x-layouts.app title="About Us" image="/uploads/2024/02/about-us-bg.jpg">
    <x-page-hero title="About Us" banner="/uploads/2024/02/about-us-bg.jpg" eyebrow="Since 1997" lead="From a single rural education program to 850+ schools serving over 125,000 children across Pakistan." />

    <section class="py-20 lg:py-28">
        <div class="container-x grid gap-14 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="reveal space-y-5 text-lg leading-8 text-ink-700">
                <span class="eyebrow">Who we are</span>
                <p class="font-display text-2xl leading-snug text-ink-900">Ghazali Education Foundation began its journey in 1997 when a team of young and passionate individuals, under the leadership of Mr. Syed Aamir Mahmood, launched the Pakistan Rural Education Program (PREP) to provide education to underprivileged children in rural areas.</p>
                <p>Over time, the initiative expanded and was renamed Ghazali Education Foundation, which has grown into a massive operation that serves over 125,000 children across Pakistan.</p>
                <p>GEF is now dedicated to providing formal education to all children regardless of their background. Its various programs cater to diverse children, including special needs, orphans, and the underprivileged. Ghazali Education Foundation has established over 850 schools primarily in remote areas of Pakistan, ensuring that children from all corners of the country can access education.</p>
                <p>Ghazali Education Foundation didn’t just happen; it happened with the grace of Allah Almighty and the support of our incredible partners. You can be part of this electrifying journey – make a difference by donating generously.</p>
                <a href="{{ route('donate') }}" class="btn-primary mt-4">Donate generously <x-icon name="heart" class="size-4" /></a>
            </div>
            <div class="reveal reveal-delay-2 grid grid-cols-2 gap-4">
                @foreach (array_slice(config('ghazali.milestones'), 0, 4) as $m)
                    <div class="rounded-3xl {{ $loop->index % 3 === 0 ? 'bg-brand-600 text-white' : 'bg-white ring-1 ring-ink-900/5' }} p-7">
                        <x-icon :name="$m['icon']" class="size-7 {{ $loop->index % 3 === 0 ? 'text-saffron-300' : 'text-brand-600' }}" />
                        <p class="mt-8 font-display text-5xl font-semibold"><span data-count="{{ $m['value'] }}">0</span>{{ $m['suffix'] }}</p>
                        <p class="mt-1 text-sm font-semibold tracking-wider uppercase opacity-70">{{ $m['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- History --}}
    <section class="bg-cream-100 py-20 lg:py-28">
        <div class="container-x">
            <div class="reveal mx-auto max-w-3xl text-center">
                <span class="eyebrow">History</span>
                <h2 class="section-title mt-4">Empowering Pakistan’s Future through Education</h2>
                <p class="mt-4 font-display text-xl text-ink-600 italic">A Beacon of Hope: Empowering Pakistan’s Future through Education</p>
            </div>
            <div class="mx-auto mt-14 grid max-w-6xl gap-6 md:grid-cols-2">
                @foreach ([
                    'In the heart of Pakistan, where dreams often fade amidst the harsh realities of life, the Ghazali Education Foundation stands as a beacon of hope, illuminating the path towards a brighter future for the nation’s children',
                    'With a dishearteningly low literacy rate and a growing number of out-of-school children, Pakistan’s educational landscape faces immense challenges. Children in rural areas are disproportionately affected, their access to quality education impeded by geographical barriers and limited resources. And amidst these disparities, girls face even steeper obstacles, their voices often silenced by societal norms and cultural constraints.',
                    'At Ghazali Education Foundation, we refuse to accept these realities as insurmountable. We are driven by an unwavering belief that every child, regardless of their background or circumstances, deserves the opportunity to learn, to grow, and to reach their full potential. Our commitment to education is not merely a noble cause; it is an investment in Pakistan’s future, a promise to unleash the untapped potential that lies dormant within our youth.',
                    'Through our network of over 800+ schools and dedicated educators, we have transformed the lives of thousands of children across Pakistan. Our holistic approach to education goes beyond traditional academics, nurturing our students’ intellectual, social, and emotional growth. We instill in them the values of compassion, resilience, and critical thinking, empowering them to become responsible citizens and leaders of tomorrow.',
                    'Our journey has not been without its challenges, but the stories of our students, their unwavering determination, and their unwavering belief in the power of education fuel our passion. We have witnessed firsthand how education can break the shackles of poverty, ignite a passion for learning, and open doors to endless possibilities.',
                    'As we move forward, we remain steadfast in our mission to bridge the educational divide and create a world where every child in Pakistan has access to the quality education they deserve. Your support, in any form, is an invaluable investment in the future of our nation. Together, we can create a Pakistan where education is not a privilege but a fundamental right, where every child has the opportunity to shine and contribute to a brighter, more prosperous tomorrow.',
                ] as $i => $paragraph)
                    <div class="reveal reveal-delay-{{ $i % 2 }} relative rounded-3xl bg-white p-8 ring-1 ring-ink-900/5">
                        <span class="absolute top-6 right-7 font-display text-5xl font-semibold text-brand-100">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <p class="relative leading-7 text-ink-700">{{ $paragraph }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Model of GEF schools --}}
    <section class="py-20 lg:py-28">
        <div class="container-x">
            <div class="reveal flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <span class="eyebrow">How we work</span>
                    <h2 class="section-title mt-4">Model of GEF Schools</h2>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('programs') }}" class="btn-primary">Programs of GEF <x-icon name="arrow-right" class="size-4" /></a>
                    <a href="{{ route('departments') }}" class="btn-outline">Departments of GEF</a>
                </div>
            </div>
            <a href="/uploads/2024/02/1-25-new1-1024x562.png" data-lightbox-item data-caption="Model of GEF Schools" class="reveal group mt-10 block overflow-hidden rounded-[2rem] bg-white p-4 ring-1 ring-ink-900/5 sm:p-8">
                <img src="/uploads/2024/02/1-25-new1-1024x562.png" alt="Model of GEF Schools diagram" class="mx-auto w-full max-w-5xl transition duration-700 group-hover:scale-[1.02]" loading="lazy">
            </a>
        </div>
    </section>

    {{-- Departments --}}
    <section class="bg-ink-950 py-20 text-white lg:py-28">
        <div class="container-x">
            <div class="reveal flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <span class="eyebrow !text-saffron-300">The teams behind every classroom</span>
                    <h2 class="mt-4 font-display text-4xl font-semibold text-white sm:text-5xl">Our Departments</h2>
                </div>
                <a href="{{ route('departments') }}" class="btn-glass">All departments <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($departments as $department)
                    <a href="{{ $department->url() }}" class="reveal group flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:border-saffron-400/60 hover:bg-white/10">
                        <img src="{{ $department->image() }}" alt="" class="size-16 shrink-0 rounded-xl object-cover" loading="lazy">
                        <span class="flex-1 font-semibold">{{ $department->title }}</span>
                        <x-icon name="arrow-up-right" class="size-5 shrink-0 text-white/40 transition group-hover:text-saffron-300" />
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.schools-grid')
</x-layouts.app>
