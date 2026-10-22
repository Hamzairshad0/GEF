<x-layouts.app title="Volunteers" image="/uploads/2024/10/Volunteer-Services-Banner.webp">
    <x-page-hero title="Volunteers" banner="/uploads/2024/10/Volunteer-Services-Banner.webp" eyebrow="GEF Involve" lead="Become a part of leading organization in education sector in Pakistan." />

    <section class="py-20 lg:py-28">
        <div class="container-x grid gap-14 lg:grid-cols-[1fr_1fr] lg:items-start">
            <div class="reveal">
                <span class="eyebrow">100% literate Pakistan</span>
                <h2 class="section-title mt-4">Pakistan’s largest volunteer drive</h2>
                <div class="mt-6 space-y-5 text-lg leading-8 text-ink-700">
                    <p>Become a part of leading organization in education sector in Pakistan. Ghazali Education Foundation (GEF) is working since 1995 for its mission of 100% literate Pakistan. Volunteers and workers and Ghazali Education Foundation (GEF) working tirelessly to achieve dream of GEF “100% literate Pakistan”</p>
                    <p>This volunteer drive is Pakistan’s largest volunteer drive in which volunteers from different educational and professional institutes are selected. Volunteers after selection will get hands on experiences on different dimensions including social work, leadership, event management, public speaking, workshops, training, content writing, photography, graphic designing etc.</p>
                </div>
                <h3 class="mt-10 font-sans text-sm font-bold tracking-widest text-ink-500 uppercase">Efforts of Volunteers are recognized through different rewards including:</h3>
                <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                    @foreach (['Internships', 'Jobs', 'Souvenirs', 'Certificates', 'Management and leadership role', 'Event head', 'National and International Exposures', 'Leadership Camps', 'and recommendations etc.'] as $reward)
                        <li class="flex items-center gap-3 rounded-2xl bg-white px-4 py-3 text-sm font-semibold ring-1 ring-ink-900/5">
                            <span class="grid size-8 shrink-0 place-items-center rounded-full bg-saffron-100 text-saffron-600"><x-icon name="check" class="size-4" stroke="2.5" /></span>
                            {{ $reward }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="reveal reveal-delay-2 rounded-[2rem] bg-white p-7 shadow-xl ring-1 shadow-ink-900/5 ring-ink-900/5 sm:p-10 lg:sticky lg:top-28" id="apply">
                <h2 class="text-3xl font-semibold">Apply to volunteer</h2>
                <p class="mt-2 text-ink-600">Tell us a little about yourself and we’ll be in touch.</p>
                @include('partials.flash')
                <form method="POST" action="{{ route('volunteers.store') }}#apply" class="mt-8 grid gap-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <label><span class="field-label">Full name *</span><input name="name" value="{{ old('name') }}" required class="field" autocomplete="name"></label>
                        <label><span class="field-label">Phone *</span><input type="tel" name="phone" value="{{ old('phone') }}" required class="field" autocomplete="tel"></label>
                    </div>
                    <label><span class="field-label">Email *</span><input type="email" name="email" value="{{ old('email') }}" required class="field" autocomplete="email"></label>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <label><span class="field-label">City</span><input name="city" value="{{ old('city') }}" class="field"></label>
                        <label><span class="field-label">Institute / Organisation</span><input name="institution" value="{{ old('institution') }}" class="field"></label>
                    </div>
                    <fieldset>
                        <legend class="field-label">Areas of interest</legend>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach (config('ghazali.volunteer_interests') as $interest)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="interests[]" value="{{ $interest }}" class="peer sr-only" @checked(in_array($interest, old('interests', [])))>
                                    <span class="inline-block rounded-full border border-ink-900/10 px-3.5 py-2 text-xs font-semibold text-ink-700 transition peer-checked:border-brand-600 peer-checked:bg-brand-600 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-saffron-400">{{ $interest }}</span>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                    <label><span class="field-label">Why do you want to volunteer?</span><textarea name="message" rows="4" class="field">{{ old('message') }}</textarea></label>
                    @include('partials.form-errors')
                    <button class="btn-primary mt-2 py-4 text-base">Submit application <x-icon name="arrow-right" class="size-5" /></button>
                </form>
            </div>
        </div>
    </section>
</x-layouts.app>
