@if ($errors->any())
    <ul class="space-y-1 rounded-2xl bg-brand-50 px-5 py-4 text-sm text-brand-700 ring-1 ring-brand-200" role="alert">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
