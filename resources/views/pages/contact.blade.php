@php($contact = config('ghazali.contact'))
<x-layouts.app title="Contact Us">
    <x-page-hero title="Contact Us" banner="/uploads/2024/02/EDS-MESSAGE-bg.jpg" eyebrow="GEF Involve" lead="We care for students, protect their welfare, and prepare them for the future are the most important issues we face during our lifetime." />

    <section class="py-20 lg:py-28">
        <div class="container-x">
            <div class="grid gap-5 md:grid-cols-3">
                @foreach ([
                    ['icon' => 'map-pin', 'label' => 'Head Office Address', 'value' => $contact['address'], 'href' => $contact['map_url']],
                    ['icon' => 'phone', 'label' => 'Call for help', 'value' => $contact['uan'], 'href' => 'tel:'.$contact['uan_tel']],
                    ['icon' => 'mail', 'label' => 'Mail us for information', 'value' => $contact['email'], 'href' => 'mailto:'.$contact['email']],
                ] as $i => $item)
                    <a href="{{ $item['href'] }}" @if (str_starts_with($item['href'], 'http')) target="_blank" rel="noopener" @endif class="reveal reveal-delay-{{ $i }} card-lift group flex items-start gap-5 rounded-3xl bg-white p-7 ring-1 ring-ink-900/5">
                        <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-brand-600 text-white transition group-hover:bg-saffron-400 group-hover:text-ink-900"><x-icon :name="$item['icon']" class="size-6" /></span>
                        <span>
                            <span class="block text-xs font-bold tracking-widest text-ink-500 uppercase">{{ $item['label'] }}</span>
                            <span class="mt-2 block font-display text-xl leading-snug font-semibold">{{ $item['value'] }}</span>
                        </span>
                    </a>
                @endforeach
            </div>

            <div class="mt-10 grid gap-8 lg:grid-cols-[1fr_1.1fr]" id="message">
                <div class="reveal rounded-[2rem] bg-white p-7 ring-1 ring-ink-900/5 sm:p-10">
                    <h2 class="text-3xl font-semibold">Send us a message</h2>
                    <p class="mt-2 text-ink-600">We usually respond within one working day ({{ $contact['office_hours'] }}).</p>
                    @include('partials.flash')
                    <form method="POST" action="{{ route('contact.store') }}#message" class="mt-8 grid gap-4">
                        @csrf
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label><span class="field-label">Your name *</span><input name="name" value="{{ old('name') }}" required class="field" autocomplete="name"></label>
                            <label><span class="field-label">Phone</span><input type="tel" name="phone" value="{{ old('phone') }}" class="field" autocomplete="tel"></label>
                        </div>
                        <label><span class="field-label">Email *</span><input type="email" name="email" value="{{ old('email') }}" required class="field" autocomplete="email"></label>
                        <label><span class="field-label">Subject</span><input name="subject" value="{{ old('subject') }}" class="field"></label>
                        <label><span class="field-label">Message *</span><textarea name="message" rows="5" required class="field">{{ old('message') }}</textarea></label>
                        @include('partials.form-errors')
                        <button class="btn-primary mt-2 py-4 text-base">Send message <x-icon name="arrow-right" class="size-5" /></button>
                    </form>
                </div>
                <div class="reveal reveal-delay-2 min-h-[420px] overflow-hidden rounded-[2rem] ring-1 ring-ink-900/5">
                    <iframe src="{{ $contact['map_embed'] }}" class="size-full min-h-[420px] grayscale-[30%]" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Ghazali Education Foundation head office on Google Maps"></iframe>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
