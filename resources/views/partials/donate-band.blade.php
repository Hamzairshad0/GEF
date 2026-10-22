@unless (request()->routeIs('donate', 'thank-you'))
<section class="relative overflow-hidden bg-brand-800 text-white grain" id="donate-band">
    <img src="/uploads/theme/footer-bg.jpg" alt="" class="absolute inset-0 size-full object-cover opacity-20 mix-blend-luminosity" loading="lazy">
    <div class="absolute -top-32 -left-32 size-96 rounded-full bg-saffron-400/20 blur-3xl"></div>
    <div class="absolute -right-24 -bottom-40 size-[30rem] rounded-full bg-brand-500/40 blur-3xl"></div>
    <div class="container-x relative grid items-center gap-12 py-20 lg:grid-cols-[1fr_1.1fr] lg:py-24">
        <div class="reveal">
            <span class="eyebrow !text-saffron-300">Start donating now!</span>
            <h2 class="mt-4 font-display text-4xl leading-tight font-semibold text-white text-balance sm:text-5xl">
                Little by little, a little becomes <em class="text-saffron-300">a lot.</em>
            </h2>
            <p class="mt-5 max-w-lg text-lg text-white/75">Your Zakat, Sadqa and donations keep 850+ schools open for children who would otherwise never see a classroom.</p>
            <dl class="mt-8 grid max-w-md grid-cols-3 gap-4">
                @foreach (array_slice(config('ghazali.hero_stats'), 1) as $stat)
                    <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                        <dt class="text-xs text-white/60">{{ $stat['label'] }}</dt>
                        <dd class="mt-1 font-display text-2xl font-semibold">{{ $stat['value'] }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
        <div class="reveal reveal-delay-2 rounded-[2rem] border border-white/10 bg-ink-950/40 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
            @include('partials.donate-form', ['variant' => 'dark'])
        </div>
    </div>
</section>
@endunless
