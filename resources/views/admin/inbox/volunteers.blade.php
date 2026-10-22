<x-layouts.admin title="Volunteer applications">
    <div class="grid gap-4 xl:grid-cols-2">
        @forelse ($applications as $application)
            <article class="rounded-2xl bg-white p-6 ring-1 {{ $application->read_at ? 'ring-ink-900/5' : 'ring-2 ring-saffron-400' }}">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="font-semibold">{{ $application->name }}</p>
                        <p class="text-sm text-ink-500"><a href="mailto:{{ $application->email }}" class="hover:text-brand-600">{{ $application->email }}</a> · <a href="tel:{{ $application->phone }}" class="hover:text-brand-600">{{ $application->phone }}</a></p>
                        <p class="mt-1 text-sm text-ink-500">{{ collect([$application->city, $application->institution])->filter()->join(' · ') }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.volunteers.read', $application) }}">
                        @csrf @method('PATCH')
                        <button class="rounded-full border border-ink-900/10 px-3 py-1.5 text-xs font-semibold hover:bg-cream-100">{{ $application->read_at ? 'Mark new' : 'Mark reviewed' }}</button>
                    </form>
                </div>
                @if ($application->interests)
                    <div class="mt-4 flex flex-wrap gap-1.5">
                        @foreach ($application->interests as $interest)
                            <span class="rounded-full bg-brand-50 px-2.5 py-1 text-xs font-semibold text-brand-700">{{ $interest }}</span>
                        @endforeach
                    </div>
                @endif
                @if ($application->message)<p class="mt-4 whitespace-pre-line text-sm text-ink-700">{{ $application->message }}</p>@endif
                <p class="mt-4 text-xs text-ink-400">Applied {{ $application->created_at->diffForHumans() }}</p>
            </article>
        @empty
            <p class="rounded-2xl bg-white p-10 text-center text-ink-500 ring-1 ring-ink-900/5 xl:col-span-2">No applications yet.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $applications->links() }}</div>
</x-layouts.admin>
