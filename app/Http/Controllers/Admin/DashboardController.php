<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Post;
use App\Models\VolunteerApplication;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                ['label' => 'Pledged this month', 'value' => 'Rs '.number_format((float) Donation::where('created_at', '>=', now()->startOfMonth())->sum('amount'))],
                ['label' => 'Donation pledges', 'value' => Donation::count()],
                ['label' => 'Unread messages', 'value' => ContactMessage::whereNull('read_at')->count()],
                ['label' => 'New volunteers', 'value' => VolunteerApplication::whereNull('read_at')->count()],
            ],
            'donations' => Donation::latest()->take(8)->get(),
            'postCounts' => Post::selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type'),
        ]);
    }
}
