@php($contact = config('ghazali.contact'))
<footer class="relative overflow-hidden bg-ink-950 text-white/70">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-saffron-400/50 to-transparent"></div>
    <div class="container-x grid gap-12 py-16 md:grid-cols-2 lg:grid-cols-[1.4fr_1fr_1fr_1.3fr] lg:py-20">
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                <span class="grid size-14 place-items-center rounded-2xl bg-white"><img src="/images/emblem.png" alt="" class="h-10 w-auto" loading="lazy"></span>
                <span class="font-display text-xl leading-tight font-semibold text-white">Ghazali<br><span class="text-base font-normal text-white/70">Education Foundation</span></span>
            </a>
            <p class="mt-6 max-w-xs font-display text-lg text-white/90 italic">“{{ config('ghazali.vision') }}”</p>
            <div class="mt-6 flex flex-wrap gap-2">
                @foreach (config('ghazali.social') as $network => $url)
                    <a href="{{ $url }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($network) }}" class="grid size-10 place-items-center rounded-full border border-white/10 transition hover:-translate-y-0.5 hover:border-saffron-400 hover:bg-saffron-400 hover:text-ink-900">
                        <x-icon :name="$network" class="size-4" />
                    </a>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="font-sans text-sm font-bold tracking-widest text-white uppercase">Quick Links</h2>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach (['about' => 'About Us', 'board' => 'Board of Directors / Governing Body', 'director-message' => 'Executive Director Message', 'schools' => 'Our Schools'] as $route => $label)
                    <li><a href="{{ route($route) }}" class="transition hover:text-saffron-300">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h2 class="font-sans text-sm font-bold tracking-widest text-white uppercase">Resources</h2>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach (['newsletter' => 'Newsletter', 'annual-reports' => 'Annual Reports', 'audit-reports' => 'Audit Reports', 'media' => 'Media'] as $route => $label)
                    <li><a href="{{ route($route) }}" class="transition hover:text-saffron-300">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h2 class="font-sans text-sm font-bold tracking-widest text-white uppercase">Contacts</h2>
            <ul class="mt-5 space-y-4 text-sm">
                <li><a href="https://wa.me/{{ ltrim($contact['mobile_tel'], '+') }}" target="_blank" rel="noopener" class="flex gap-3 transition hover:text-saffron-300"><x-icon name="whatsapp" class="mt-0.5 size-4 shrink-0 text-saffron-400" /> {{ $contact['mobile'] }}</a></li>
                <li><a href="tel:{{ $contact['uan_tel'] }}" class="flex gap-3 transition hover:text-saffron-300"><x-icon name="phone" class="mt-0.5 size-4 shrink-0 text-saffron-400" /> UAN: {{ $contact['uan'] }}</a></li>
                <li><a href="mailto:{{ $contact['email'] }}" class="flex gap-3 transition hover:text-saffron-300"><x-icon name="mail" class="mt-0.5 size-4 shrink-0 text-saffron-400" /> {{ $contact['email'] }}</a></li>
                <li><a href="{{ $contact['map_url'] }}" target="_blank" rel="noopener" class="flex gap-3 transition hover:text-saffron-300"><x-icon name="map-pin" class="mt-0.5 size-4 shrink-0 text-saffron-400" /> {{ $contact['address'] }}</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="container-x flex flex-col items-center justify-between gap-3 py-6 text-xs text-white/50 sm:flex-row">
            <p>© {{ date('Y') }} {{ config('ghazali.name') }}. All rights reserved.</p>
            <p>Making Pakistan 100% literate, one child at a time.</p>
        </div>
    </div>
</footer>
