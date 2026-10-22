{{-- The quick donation form that appears on every page of the original site --}}
@php
    $dark = ($variant ?? 'light') === 'dark';
    $cause ??= null;
@endphp
<form method="POST" action="{{ route('donate.store') }}" class="grid gap-4" data-donate-form>
    @csrf
    <div>
        <span class="field-label {{ $dark ? '!text-white/60' : '' }}">Choose an amount (PKR)</span>
        <div class="grid grid-cols-2 gap-2 sm:grid-cols-4">
            @foreach (config('ghazali.donation_presets') as $preset)
                <button type="button" data-amount="{{ $preset }}"
                        class="rounded-xl border px-3 py-3 text-sm font-bold transition data-[selected]:border-saffron-400 data-[selected]:bg-saffron-400 data-[selected]:text-ink-900 {{ $dark ? 'border-white/15 bg-white/5 text-white hover:border-white/40' : 'border-ink-900/10 bg-white text-ink-900 hover:border-brand-400' }}">
                    {{ number_format($preset) }}
                </button>
            @endforeach
        </div>
    </div>
    <div class="grid gap-3 sm:grid-cols-2">
        <label class="block">
            <span class="sr-only">Amount</span>
            <input type="number" name="amount" min="100" step="1" required placeholder="Other amount" value="{{ old('amount') }}" class="field" data-amount-input>
        </label>
        <label class="block">
            <span class="sr-only">Cause</span>
            <select name="cause" class="field" required>
                @foreach (config('ghazali.donation_causes') as $option)
                    <option value="{{ $option }}" @selected(old('cause', $cause) === $option)>{{ $option }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <div class="flex flex-wrap gap-2" role="radiogroup" aria-label="Frequency">
        @foreach (config('ghazali.donation_frequencies') as $value => $label)
            <label class="cursor-pointer">
                <input type="radio" name="frequency" value="{{ $value }}" class="peer sr-only" @checked(old('frequency', 'one-time') === $value)>
                <span class="inline-block rounded-full border px-4 py-2 text-xs font-semibold transition peer-checked:border-brand-600 peer-checked:bg-brand-600 peer-checked:text-white peer-focus-visible:ring-2 peer-focus-visible:ring-saffron-400 {{ $dark ? 'border-white/15 text-white/80' : 'border-ink-900/10 text-ink-700' }}">{{ $label }}</span>
            </label>
        @endforeach
    </div>
    <div class="grid gap-3 sm:grid-cols-3">
        <input type="text" name="name" required placeholder="Your Name" value="{{ old('name') }}" class="field" autocomplete="name" aria-label="Your Name">
        <input type="email" name="email" required placeholder="Email Address" value="{{ old('email') }}" class="field" autocomplete="email" aria-label="Email Address">
        <input type="tel" name="phone" required placeholder="Phone" value="{{ old('phone') }}" class="field" autocomplete="tel" aria-label="Phone">
    </div>
    @if ($errors->donation->any())
        <p class="rounded-xl bg-brand-50 px-4 py-3 text-sm text-brand-700" role="alert">{{ $errors->donation->first() }}</p>
    @endif
    <button type="submit" class="btn-accent w-full py-4 text-base">
        <x-icon name="heart" class="size-5" /> Donate Now
    </button>
    <p class="text-center text-xs {{ $dark ? 'text-white/50' : 'text-ink-500' }}">Our team will contact you to complete your donation securely.</p>
</form>
