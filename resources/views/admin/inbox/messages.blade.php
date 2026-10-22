<x-layouts.admin title="Contact messages">
    <div class="space-y-4">
        @forelse ($messages as $message)
            <article class="rounded-2xl bg-white p-6 ring-1 {{ $message->read_at ? 'ring-ink-900/5' : 'ring-2 ring-saffron-400' }}">
                <div class="flex flex-wrap items-start justify-between gap-4">
                    <div>
                        <p class="font-semibold">{{ $message->name }} @unless ($message->read_at)<span class="ml-2 rounded-full bg-saffron-100 px-2 py-0.5 text-xs font-bold text-saffron-600">New</span>@endunless</p>
                        <p class="text-sm text-ink-500"><a href="mailto:{{ $message->email }}" class="hover:text-brand-600">{{ $message->email }}</a>@if ($message->phone) · {{ $message->phone }}@endif · {{ $message->created_at->diffForHumans() }}</p>
                    </div>
                    <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                        @csrf @method('PATCH')
                        <button class="rounded-full border border-ink-900/10 px-3 py-1.5 text-xs font-semibold hover:bg-cream-100">{{ $message->read_at ? 'Mark unread' : 'Mark read' }}</button>
                    </form>
                </div>
                @if ($message->subject)<p class="mt-4 font-semibold">{{ $message->subject }}</p>@endif
                <p class="mt-2 whitespace-pre-line text-ink-700">{{ $message->message }}</p>
            </article>
        @empty
            <p class="rounded-2xl bg-white p-10 text-center text-ink-500 ring-1 ring-ink-900/5">No messages yet.</p>
        @endforelse
    </div>
    <div class="mt-6">{{ $messages->links() }}</div>
</x-layouts.admin>
