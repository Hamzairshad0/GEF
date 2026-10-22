<x-layouts.admin title="Donation pledges">
    <x-slot:actions>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.donations') }}" class="rounded-full px-3 py-1.5 text-sm font-semibold {{ request('status') ? 'bg-white' : 'bg-ink-900 text-white' }}">All</a>
            @foreach (App\Models\Donation::STATUSES as $status)
                <a href="{{ route('admin.donations', ['status' => $status]) }}" class="rounded-full px-3 py-1.5 text-sm font-semibold {{ request('status') === $status ? 'bg-ink-900 text-white' : 'bg-white' }}">{{ ucfirst($status) }}</a>
            @endforeach
        </div>
    </x-slot:actions>
    <section class="rounded-2xl bg-white ring-1 ring-ink-900/5">
        @include('admin.inbox.donation-table')
    </section>
    <div class="mt-6">{{ $donations->links() }}</div>
</x-layouts.admin>
