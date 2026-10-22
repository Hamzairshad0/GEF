@php
    $contact = config('ghazali.contact');
    $bank = config('ghazali.bank');
@endphp
<x-layouts.app title="Donate">
    <x-page-hero title="Donate" banner="/uploads/2024/02/our-departments-bg.jpg" eyebrow="Your Zakat, Sadqa & donations" lead="Every contribution keeps a Ghazali school open for children who would otherwise never see a classroom." />

    <section class="relative -mt-10 pb-20 lg:pb-28">
        <div class="container-x grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
            {{-- Pledge form --}}
            <div class="reveal is-visible rounded-[2rem] bg-white p-7 shadow-2xl ring-1 shadow-ink-900/10 ring-ink-900/5 sm:p-10">
                <h2 class="text-3xl font-semibold">Make a donation pledge</h2>
                <p class="mt-2 text-ink-600">Choose a cause and amount. Our team will contact you to complete it.</p>
                <div class="mt-8">@include('partials.donate-form')</div>
            </div>

            {{-- Bank details --}}
            <div class="reveal is-visible relative overflow-hidden rounded-[2rem] bg-ink-950 p-7 text-white sm:p-10 grain">
                <div class="absolute -top-20 -right-20 size-64 rounded-full bg-brand-600/40 blur-3xl"></div>
                <div class="relative">
                    <span class="grid size-14 place-items-center rounded-2xl bg-saffron-400 text-ink-900"><x-icon name="bank" class="size-7" /></span>
                    <h2 class="mt-6 text-3xl font-semibold text-white">Direct Deposit</h2>
                    <p class="mt-2 text-white/60">Donate Directly into our Account.</p>
                    <dl class="mt-8 divide-y divide-white/10 rounded-2xl border border-white/10 bg-white/5">
                        @foreach (['Account Title' => $bank['title'], 'Account No' => $bank['account'], 'IBAN' => $bank['iban'], 'Swift Code' => $bank['swift'], 'Bank' => $bank['bank']] as $label => $value)
                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <div>
                                    <dt class="text-xs font-semibold tracking-widest text-white/50 uppercase">{{ $label }}</dt>
                                    <dd class="mt-1 font-mono text-sm sm:text-base">{{ $value }}</dd>
                                </div>
                                @if (in_array($label, ['Account No', 'IBAN']))
                                    <button type="button" data-copy="{{ str_replace(' ', '', $value) }}" class="flex shrink-0 items-center gap-1.5 rounded-full border border-white/15 px-3 py-1.5 text-xs font-semibold transition hover:bg-white hover:text-ink-900">
                                        <x-icon name="copy" class="size-3.5" /> <span data-copy-label>Copy</span>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </div>

        {{-- Other ways to give (content from the original Donate page) --}}
        <div class="container-x mt-20">
            <div class="reveal text-center">
                <span class="eyebrow">More ways to give</span>
                <h2 class="section-title mt-4">However you give, it reaches a child.</h2>
            </div>
            <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['icon' => 'cheque', 'title' => 'Donate by Cheque', 'text' => 'Send your donation cheque in favour of “Ghazali Education Trust” at 5-E Samanberg, Johar Town, Lahore'],
                    ['icon' => 'truck', 'title' => 'Doorstep Collection', 'text' => 'Call (042) 111 438 438 or 0333 1213623 to collect your donation right from your doorstep.', 'href' => 'tel:'.$contact['uan_tel'], 'cta' => 'Call now'],
                    ['icon' => 'door', 'title' => 'Walk-in Donation', 'text' => 'Visit our office & give your donation at 5E Samanberg, Johar Town Timing: 9 am to 5 pm, Monday-Friday', 'href' => $contact['map_url'], 'cta' => 'Get directions'],
                    ['icon' => 'chat', 'title' => 'Request a Call', 'text' => 'Email: info@get.org.pk Whatsapp/SMS:+92 333 1213 623', 'href' => 'https://wa.me/'.ltrim($contact['mobile_tel'], '+'), 'cta' => 'WhatsApp us'],
                    ['icon' => 'briefcase', 'title' => 'Corporate', 'text' => 'For CSR Program or Volunteering pdu@get.org.pk volunteer@get.org.pk', 'href' => 'mailto:'.$contact['csr_email'], 'cta' => 'Email PDU'],
                    ['icon' => 'heart', 'title' => 'Sponsor a cause', 'text' => 'Sponsor an orphan, a disabled child, a college student, or adopt a whole school.', 'href' => route('causes'), 'cta' => 'View causes'],
                ] as $i => $way)
                    <div class="reveal reveal-delay-{{ $i % 3 }} card-lift rounded-3xl bg-white p-7 ring-1 ring-ink-900/5">
                        <span class="grid size-12 place-items-center rounded-2xl bg-brand-50 text-brand-600"><x-icon :name="$way['icon']" class="size-6" /></span>
                        <h3 class="mt-5 text-xl font-semibold">{{ $way['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-ink-600">{{ $way['text'] }}</p>
                        @isset($way['href'])
                            <a href="{{ $way['href'] }}" @if (str_starts_with($way['href'], 'http')) target="_blank" rel="noopener" @endif class="mt-5 inline-flex items-center gap-2 text-sm font-bold text-brand-600">{{ $way['cta'] }} <x-icon name="arrow-right" class="size-4" /></a>
                        @endisset
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Causes --}}
    <section class="bg-cream-100 py-20 lg:py-28">
        <div class="container-x">
            <h2 class="section-title reveal">Causes We Support</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($causes as $i => $cause)
                    @include('partials.cards.cause', ['post' => $cause, 'index' => $i])
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.app>
