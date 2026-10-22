<div class="overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="text-xs tracking-wider text-ink-500 uppercase">
            <tr class="border-b border-ink-900/5">
                <th class="px-6 py-3 font-semibold">Donor</th>
                <th class="px-6 py-3 font-semibold">Cause</th>
                <th class="px-6 py-3 text-right font-semibold">Amount</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-ink-900/5">
            @forelse ($donations as $donation)
                <tr class="hover:bg-cream-50">
                    <td class="px-6 py-3">
                        <p class="font-semibold">{{ $donation->name }}</p>
                        <p class="text-xs text-ink-500"><a href="mailto:{{ $donation->email }}" class="hover:text-brand-600">{{ $donation->email }}</a> · <a href="tel:{{ $donation->phone }}" class="hover:text-brand-600">{{ $donation->phone }}</a></p>
                    </td>
                    <td class="px-6 py-3">{{ $donation->cause }} <span class="text-xs text-ink-500">({{ $donation->frequency }})</span></td>
                    <td class="px-6 py-3 text-right font-semibold tabular-nums">Rs {{ number_format((float) $donation->amount) }}</td>
                    <td class="px-6 py-3">
                        <form method="POST" action="{{ route('admin.donations.update', $donation) }}">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="rounded-lg border border-ink-900/10 bg-white px-2 py-1 text-xs font-semibold">
                                @foreach (App\Models\Donation::STATUSES as $status)
                                    <option value="{{ $status }}" @selected($donation->status === $status)>{{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-3 whitespace-nowrap text-ink-500">{{ $donation->created_at->format('M j, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-10 text-center text-ink-500">No donation pledges yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
