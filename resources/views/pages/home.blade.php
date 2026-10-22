<x-layouts.app>
    @include('partials.home.hero')

    {{-- What we believe in --}}
    <section class="relative overflow-hidden py-24 lg:py-32">
        <div class="pointer-events-none absolute top-10 -right-40 size-[28rem] rounded-full bg-saffron-200/40 blur-3xl"></div>
        <div class="container-x relative grid items-center gap-14 lg:grid-cols-2">
            <div class="reveal">
                <span class="eyebrow">What we Believe In</span>
                <h2 class="section-title mt-4">Every child deserves a classroom, a teacher and a future.</h2>
                <div class="mt-10 grid gap-5 sm:grid-cols-2">
                    <div class="card-lift rounded-3xl bg-white p-7 shadow-sm ring-1 ring-ink-900/5">
                        <span class="grid size-12 place-items-center rounded-2xl bg-brand-600 text-white"><x-icon name="eye" class="size-6" /></span>
                        <h3 class="mt-5 text-2xl font-semibold">Vision</h3>
                        <p class="mt-3 font-display text-lg text-ink-700 italic">“{{ config('ghazali.vision') }}”</p>
                    </div>
                    <div class="card-lift rounded-3xl bg-ink-900 p-7 text-white shadow-sm">
                        <span class="grid size-12 place-items-center rounded-2xl bg-saffron-400 text-ink-900"><x-icon name="sparkles" class="size-6" /></span>
                        <h3 class="mt-5 text-2xl font-semibold text-white">Mission</h3>
                        <p class="mt-3 text-white/75">{{ config('ghazali.mission') }}</p>
                    </div>
                </div>
            </div>
            <div class="reveal reveal-delay-2 relative">
                <div class="grid grid-cols-5 grid-rows-6 gap-4" style="height: 34rem">
                    <img src="/uploads/2026/03/activity.jpg-scaled.jpeg" alt="Ghazali school students" class="col-span-3 row-span-4 size-full rounded-3xl object-cover shadow-xl" loading="lazy">
                    <img src="/uploads/2024/02/our-departments-bg.jpg" alt="Morning assembly at a GET model school" class="col-span-2 row-span-3 size-full rounded-3xl object-cover shadow-xl" loading="lazy">
                    <div class="col-span-2 row-span-3 flex flex-col justify-end rounded-3xl bg-brand-600 p-6 text-white shadow-xl">
                        <span class="font-display text-5xl font-semibold">1997</span>
                        <span class="mt-1 text-sm text-white/80">Started as the Pakistan Rural Education Program</span>
                    </div>
                    <img src="/uploads/2024/02/orphan-neddy.jpg" alt="Students walking to class" class="col-span-3 row-span-2 size-full rounded-3xl object-cover object-[center_30%] shadow-xl" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    {{-- Achieved milestones --}}
    <section class="relative overflow-hidden bg-brand-700 py-20 text-white grain">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(251,191,36,.25),transparent_45%),radial-gradient(circle_at_80%_90%,rgba(0,0,0,.35),transparent_50%)]"></div>
        <div class="container-x relative">
            <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div>
                    <span class="eyebrow !text-saffron-300">Our impact</span>
                    <h2 class="mt-3 font-display text-4xl font-semibold text-white sm:text-5xl">Achieved Milestones</h2>
                </div>
                <a href="{{ route('schools') }}" class="btn-glass">Explore our schools <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-12 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5">
                @foreach (config('ghazali.milestones') as $i => $m)
                    <div class="reveal reveal-delay-{{ min($i, 3) }} group rounded-3xl border border-white/10 bg-white/5 p-6 backdrop-blur transition hover:-translate-y-1 hover:bg-white/10 {{ $loop->last ? 'col-span-2 md:col-span-1' : '' }}">
                        <x-icon :name="$m['icon']" class="size-7 text-saffron-300 transition group-hover:scale-110" />
                        <p class="mt-6 font-display text-5xl font-semibold tabular-nums">
                            <span data-count="{{ $m['value'] }}">0</span><span class="text-saffron-300">{{ $m['suffix'] }}</span>
                        </p>
                        <p class="mt-2 text-sm font-semibold tracking-widest text-white/70 uppercase">{{ $m['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Executive Director message --}}
    <section class="py-24 lg:py-32">
        <div class="container-x grid items-center gap-14 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="reveal relative mx-auto w-full max-w-md lg:max-w-none">
                <div class="absolute -inset-4 -rotate-3 rounded-[2.5rem] bg-saffron-300"></div>
                <img src="/uploads/2024/10/ghazali-ceo-img.webp" alt="Syed Aamir Mahmood, Executive Director" class="relative aspect-[4/5] w-full rounded-[2rem] object-cover shadow-2xl" loading="lazy">
                <div class="absolute -right-4 -bottom-6 rounded-2xl bg-white p-5 shadow-xl sm:-right-8">
                    <p class="font-display text-lg font-semibold">Syed Aamir Mahmood</p>
                    <p class="text-sm text-ink-500">Executive Director · Tamgha E Imtiaz</p>
                </div>
            </div>
            <div class="reveal reveal-delay-2">
                <span class="eyebrow">Executive Director's Message</span>
                <h2 class="section-title mt-4">Helping Each Other Can Make World Better</h2>
                <x-icon name="quote" class="mt-8 size-10 text-brand-200" />
                <div class="mt-4 space-y-5 text-lg leading-8 text-ink-700">
                    <p>As the dedicated Executive Director of Ghazali Education Foundation, I bring two decades of passion and commitment to the forefront of our mission. Recognizing the pivotal role education plays in Pakistan's development, it's disheartening to see persistently low literacy rates and a growing number of out-of-school children, especially in rural areas where challenges are exacerbated, particularly for girls.</p>
                    <p>At Ghazali Education Foundation, we're not just acknowledging these challenges; we're confronting them head-on. We firmly believe that every child, regardless of their background, deserves access to top-notch education. Our vision extends beyond classrooms — we aim to illuminate the path to a brighter future for our country by equipping youth with knowledge, skills, and values to shape a positive impact on society. Join us in this transformative journey towards a more educated, empowered, and vibrant Pakistan.</p>
                </div>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('director-message') }}" class="btn-primary">Read the full message <x-icon name="arrow-right" class="size-4" /></a>
                    <a href="{{ route('board') }}" class="btn-outline">Meet the board</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Causes we support --}}
    <section class="bg-cream-100 py-24 lg:py-32">
        <div class="container-x">
            <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div class="reveal max-w-2xl">
                    <span class="eyebrow">Causes We Support</span>
                    <h2 class="section-title mt-4">Choose where your kindness goes to work.</h2>
                </div>
                <a href="{{ route('causes') }}" class="btn-outline reveal">View all causes <x-icon name="arrow-right" class="size-4" /></a>
            </div>
            <div class="mt-14 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($causes as $i => $cause)
                    @include('partials.cards.cause', ['post' => $cause, 'index' => $i])
                @endforeach
            </div>
        </div>
    </section>

    {{-- Join our team + program videos share one light section so each reads as its own card --}}
    <section class="bg-cream-100 pb-24 lg:pb-32">
        <div class="container-x space-y-10">
            <div class="reveal grid overflow-hidden rounded-[2rem] bg-white ring-1 ring-ink-900/5 md:grid-cols-[1.1fr_0.9fr]">
                <div class="flex flex-col justify-center p-8 sm:p-12">
                    <span class="eyebrow">GEF Involve</span>
                    <h2 class="mt-4 font-display text-4xl font-semibold sm:text-5xl">Join Our Team</h2>
                    <p class="mt-4 max-w-md text-lg text-ink-600">Become a part of leading organization in education sector in Pakistan — volunteer, intern or build a career with us.</p>
                    <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-3">
                        <a href="{{ route('volunteers') }}" class="btn-primary">Become a Volunteer <x-icon name="arrow-right" class="size-4" /></a>
                        <a href="{{ route('careers') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-ink-800 hover:text-brand-600">Careers <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></a>
                    </div>
                </div>
                <div class="relative min-h-64 md:min-h-full">
                    <img src="/uploads/theme/banner_team.jpg" alt="Smiling Ghazali school student" class="absolute inset-0 size-full object-cover object-[70%_center]" loading="lazy">
                </div>
            </div>

            @include('partials.home.program-videos')
        </div>
    </section>

    {{-- GEF school's network --}}
    <section class="overflow-hidden py-24 lg:py-32">
        <div class="container-x grid items-center gap-12 lg:grid-cols-[1.15fr_0.85fr]">
            <div class="reveal relative">
                <div class="absolute inset-10 rounded-full bg-brand-100/60 blur-3xl"></div>
                <img src="/uploads/2025/03/Pakistan_map.png" alt="Map of Pakistan showing the number of Ghazali schools in each district" class="relative w-full drop-shadow-xl" loading="lazy">
            </div>
            <div class="reveal reveal-delay-2" data-tabs>
                <span class="eyebrow">GEF school’s network</span>
                <h2 class="section-title mt-4">850+ schools in 45 districts, from Swabi to Kashmore.</h2>
                <div class="mt-8 flex flex-wrap gap-2" role="tablist">
                    @foreach (config('ghazali.schools') as $province => $districts)
                        <button type="button" role="tab" data-tab="{{ Str::slug($province) }}" class="rounded-full border border-ink-900/10 px-4 py-2 text-sm font-semibold transition hover:border-brand-400 aria-selected:border-brand-600 aria-selected:bg-brand-600 aria-selected:text-white" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $province }} <span class="ml-1 opacity-60">{{ count($districts) }}</span>
                        </button>
                    @endforeach
                </div>
                @foreach (config('ghazali.schools') as $province => $districts)
                    <div data-tab-panel="{{ Str::slug($province) }}" class="mt-6 flex flex-wrap gap-2" @unless ($loop->first) hidden @endunless>
                        @foreach ($districts as $district)
                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-white px-3 py-1.5 text-sm text-ink-700 shadow-sm ring-1 ring-ink-900/5"><x-icon name="map-pin" class="size-3.5 text-brand-500" />{{ $district }}</span>
                        @endforeach
                    </div>
                @endforeach
                <a href="{{ route('schools') }}" class="btn-primary mt-8">See all our schools <x-icon name="arrow-right" class="size-4" /></a>
            </div>
        </div>
    </section>

    {{-- Stories of hope --}}
    <section class="bg-ink-950 py-24 text-white lg:py-32" data-carousel>
        <div class="container-x">
            <div class="flex flex-col items-start justify-between gap-6 md:flex-row md:items-end">
                <div class="reveal">
                    <span class="eyebrow !text-saffron-300">Stories Of Hope</span>
                    <h2 class="mt-4 font-display text-4xl font-semibold text-white sm:text-5xl">From classrooms to change-makers.</h2>
                </div>
                <div class="flex gap-2">
                    <button type="button" data-carousel-prev class="grid size-12 place-items-center rounded-full border border-white/20 transition hover:bg-white hover:text-ink-900" aria-label="Previous story"><x-icon name="arrow-left" class="size-5" /></button>
                    <button type="button" data-carousel-next class="grid size-12 place-items-center rounded-full bg-saffron-400 text-ink-900 transition hover:bg-white" aria-label="Next story"><x-icon name="arrow-right" class="size-5" /></button>
                </div>
            </div>
            <div class="no-scrollbar -mx-5 mt-12 flex snap-x snap-mandatory gap-6 overflow-x-auto scroll-smooth px-5 pb-4 sm:-mx-8 sm:px-8" data-carousel-track>
                @foreach ($stories as $story)
                    <a href="{{ $story->url() }}" class="group relative flex aspect-[4/5] w-[85%] shrink-0 snap-start flex-col justify-end overflow-hidden rounded-[2rem] sm:w-[60%] lg:w-[calc(33.333%-1rem)]">
                        <img src="{{ $story->image() }}" alt="" class="absolute inset-0 size-full object-cover transition duration-700 ease-out-expo group-hover:scale-105" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-ink-950 via-ink-950/40 to-transparent"></div>
                        <div class="relative p-7">
                            <h3 class="font-display text-2xl leading-snug font-semibold text-white">{{ $story->title }}</h3>
                            <p class="mt-3 line-clamp-3 text-sm text-white/70">{{ $story->summary(170) }}</p>
                            <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-saffron-300">Learn more <x-icon name="arrow-up-right" class="size-4 transition group-hover:translate-x-0.5 group-hover:-translate-y-0.5" /></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- News & updates --}}
    <section class="py-24 lg:py-28">
        <div class="container-x">
            <div class="reveal text-center">
                <span class="eyebrow">News &amp; Updates</span>
                <h2 class="section-title mt-4">Transparency in every rupee.</h2>
            </div>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach ([
                    ['route' => 'newsletter', 'title' => 'Newsletters', 'icon' => 'mail', 'text' => 'News from our schools in English and Urdu.'],
                    ['route' => 'annual-reports', 'title' => 'Annual Reports', 'icon' => 'file', 'text' => 'Our programs, reach and results, year by year.'],
                    ['route' => 'audit-reports', 'title' => 'Audit Reports', 'icon' => 'check', 'text' => 'Independently audited financial statements.'],
                ] as $i => $card)
                    <a href="{{ route($card['route']) }}" class="reveal reveal-delay-{{ $i }} card-lift group relative overflow-hidden rounded-3xl bg-white p-8 ring-1 ring-ink-900/5">
                        <div class="absolute -top-10 -right-10 size-32 rounded-full bg-brand-50 transition duration-500 group-hover:scale-[3]"></div>
                        <div class="relative">
                            <span class="grid size-14 place-items-center rounded-2xl bg-brand-600 text-white"><x-icon :name="$card['icon']" class="size-7" /></span>
                            <h3 class="mt-6 text-2xl font-semibold">{{ $card['title'] }}</h3>
                            <p class="mt-2 text-ink-600">{{ $card['text'] }}</p>
                            <span class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-brand-600">Read more <x-icon name="arrow-right" class="size-4 transition group-hover:translate-x-1" /></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
