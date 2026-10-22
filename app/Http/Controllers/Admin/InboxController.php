<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\VolunteerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

/** Read-only views of public form submissions, plus donation status tracking. */
class InboxController extends Controller
{
    public function donations(Request $request): View
    {
        return view('admin.inbox.donations', [
            'donations' => Donation::when($request->query('status'), fn ($q, $s) => $q->where('status', $s))
                ->latest()->paginate(25)->withQueryString(),
        ]);
    }

    public function updateDonation(Request $request, Donation $donation): RedirectResponse
    {
        $donation->update($request->validate(['status' => ['required', Rule::in(Donation::STATUSES)]]));

        return back()->with('success', 'Donation marked as '.$donation->status.'.');
    }

    public function messages(): View
    {
        return view('admin.inbox.messages', ['messages' => ContactMessage::latest()->paginate(20)]);
    }

    public function readMessage(ContactMessage $message): RedirectResponse
    {
        $message->update(['read_at' => $message->read_at ? null : now()]);

        return back();
    }

    public function volunteers(): View
    {
        return view('admin.inbox.volunteers', ['applications' => VolunteerApplication::latest()->paginate(20)]);
    }

    public function readVolunteer(VolunteerApplication $application): RedirectResponse
    {
        $application->update(['read_at' => $application->read_at ? null : now()]);

        return back();
    }
}
