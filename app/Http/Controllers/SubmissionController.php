<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\VolunteerApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Handles the public donation, contact and volunteer forms. */
class SubmissionController extends Controller
{
    public function donate(Request $request): RedirectResponse
    {
        // Own error bag: this form sits on every page next to the contact/volunteer forms
        $data = $request->validateWithBag('donation', [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30', 'regex:/^[0-9+\-\s()]{7,30}$/'],
            'cause' => ['required', Rule::in(config('ghazali.donation_causes'))],
            'frequency' => ['required', Rule::in(array_keys(config('ghazali.donation_frequencies')))],
            'amount' => ['required', 'numeric', 'min:100', 'max:100000000'],
        ]);

        Donation::create($data);

        return redirect()->route('thank-you')->with('thanks', 'donation');
    }

    public function contact(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Thank you for reaching out. Our team will get back to you soon.');
    }

    public function volunteer(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['required', 'string', 'max:30'],
            'city' => ['nullable', 'string', 'max:80'],
            'institution' => ['nullable', 'string', 'max:160'],
            'interests' => ['nullable', 'array'],
            'interests.*' => [Rule::in(config('ghazali.volunteer_interests'))],
            'message' => ['nullable', 'string', 'max:3000'],
        ]);

        VolunteerApplication::create($data);

        return back()->with('success', 'JazakAllah! Your volunteer application has been received. We will contact you shortly.');
    }
}
