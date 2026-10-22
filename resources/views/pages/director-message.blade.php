<x-layouts.app title="Executive Director Message" image="/uploads/2024/02/IDS-img.jpeg">
    <x-page-hero title="Executive Director Message" banner="/uploads/2024/02/EDS-MESSAGE-bg.jpg" :crumbs="['About Us' => route('about')]" />

    <section class="py-20 lg:py-28">
        <div class="container-x grid gap-14 lg:grid-cols-[0.8fr_1.2fr] lg:items-start">
            <div class="reveal lg:sticky lg:top-28">
                <div class="relative">
                    <div class="absolute -inset-3 rotate-2 rounded-[2.25rem] bg-brand-600"></div>
                    <img src="/uploads/2024/02/IDS-img.jpeg" alt="Syed Aamir Mahmood" class="relative aspect-[4/5] w-full rounded-[2rem] object-cover object-top shadow-2xl">
                </div>
                <div class="mt-8">
                    <p class="font-display text-2xl font-semibold">Syed Aamir Mahmood</p>
                    <p class="text-ink-500">Executive Director, Ghazali Education Foundation (Tamgha E Imtiaz)</p>
                </div>
            </div>
            <article class="reveal reveal-delay-2">
                <x-icon name="quote" class="size-14 text-saffron-400" />
                <div class="prose-gef mt-6">
                    <p>During my experience in the development sector for more than two decades, I have realized that the only way to develop our beloved Pakistan is the promotion and spread of education in the country. Unfortunately, country’s literacy rate is alarmingly low. Number of out of school children is rapidly increasing. Children in the rural areas do not have access to education due to a number of reasons. Education for the girls is even a bigger issue.</p>
                    <p>Rationally speaking, we cannot expect a progressive Pakistan with such a poor state of education in the country. We need to work for education. Ghazali Education Foundation (GEF) was created to address the issue of low literacy rate, mainly in rural Pakistan</p>
                    <p>So far, it is successfully operating in the rural Pakistan for the spread of education. Credit goes to our dedicated team and humble donors/supporters. We need further support from you to improve and spread our activities. I welcome you to come forward and join us to take your part in the development of Pakistan through supporting education from the platform of Ghazali Education Foundation (GEF). Stay Blessed!</p>
                </div>
                <div class="mt-10 flex flex-wrap gap-3 border-t border-ink-900/10 pt-8">
                    <a href="{{ route('donate') }}" class="btn-primary">Join us — Donate <x-icon name="heart" class="size-4" /></a>
                    <a href="{{ route('volunteers') }}" class="btn-outline">Become a volunteer</a>
                </div>
            </article>
        </div>
    </section>
</x-layouts.app>
