<x-layouts.app title="Thank You">
    <section class="relative overflow-hidden py-28 lg:py-40">
        <div class="pointer-events-none absolute top-0 left-1/2 size-[40rem] -translate-x-1/2 rounded-full bg-saffron-200/50 blur-3xl"></div>
        <div class="container-x relative text-center">
            <span class="mx-auto grid size-20 animate-float place-items-center rounded-3xl bg-brand-600 text-white shadow-xl shadow-brand-600/30"><x-icon name="heart" class="size-10" /></span>
            <h1 class="mt-8 font-display text-5xl font-semibold sm:text-6xl">JazakAllah Khair!</h1>
            <p class="mx-auto mt-5 max-w-xl text-lg text-ink-600">
                @if (session('thanks') === 'donation')
                    Your donation pledge has been received. A member of our team will contact you shortly to complete it.
                @else
                    Thank you for supporting Ghazali Education Foundation.
                @endif
            </p>
            <p class="mx-auto mt-3 max-w-xl text-ink-500">Prefer to give right away? Use the bank details on our <a href="{{ route('donate') }}" class="font-semibold text-brand-600 underline underline-offset-4">Donate page</a>.</p>
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="{{ route('home') }}" class="btn-primary">Back to home</a>
                <a href="{{ route('causes') }}" class="btn-outline">Explore causes</a>
            </div>
        </div>
    </section>
</x-layouts.app>
