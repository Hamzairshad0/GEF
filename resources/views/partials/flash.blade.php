@if (session('success'))
    <div class="mt-6 flex items-start gap-3 rounded-2xl bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 ring-1 ring-emerald-200" role="status">
        <x-icon name="check" class="mt-0.5 size-5 shrink-0" stroke="2.5" />
        {{ session('success') }}
    </div>
@endif
