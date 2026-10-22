{{-- "Our Schools" — districts by province --}}
<section class="py-20 lg:py-28">
    <div class="container-x">
        <div class="reveal grid items-end gap-6 md:grid-cols-2">
            <div>
                <span class="eyebrow">Where we work</span>
                <h2 class="section-title mt-4">Our Schools</h2>
            </div>
            <p class="text-lg text-ink-600 md:text-right">Ghazali schools are spread across {{ collect(config('ghazali.schools'))->flatten()->count() }} listed districts in four provinces.</p>
        </div>
        <div class="mt-12 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
            @foreach (config('ghazali.schools') as $province => $districts)
                <div class="reveal rounded-3xl bg-white p-7 ring-1 ring-ink-900/5 {{ $loop->first ? 'lg:row-span-3' : '' }}">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-semibold">{{ $province }}</h3>
                        <span class="rounded-full bg-brand-50 px-3 py-1 text-xs font-bold text-brand-700">{{ count($districts) }} districts</span>
                    </div>
                    <ul class="mt-5 flex flex-wrap gap-2">
                        @foreach ($districts as $district)
                            <li class="rounded-lg bg-cream-100 px-3 py-1.5 text-sm text-ink-700 transition hover:bg-brand-600 hover:text-white">{{ $district }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
