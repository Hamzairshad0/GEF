<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Gallery;
use App\Models\HeroSlide;
use App\Models\Person;
use App\Models\Post;
use App\Models\Video;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'slides' => HeroSlide::where('is_active', true)->orderBy('sort')->get(),
            'causes' => Post::ofType('campaign')->get(),
            'stories' => Post::ofType('story')->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', ['departments' => Post::ofType('department')->get()]);
    }

    public function board(): View
    {
        return view('pages.people', [
            'title' => 'Board of Directors / Governing Body',
            'banner' => '/uploads/2024/02/boardTruty.jpg',
            'intro' => 'A Governing body of an organization and seeks to ensure the best interest of stakeholders in all types of management decisions.',
            'people' => Person::where('group', 'board')->orderBy('sort')->get(),
        ]);
    }

    public function ambassadors(): View
    {
        return view('pages.people', [
            'title' => 'Ambassadors',
            'banner' => '/uploads/2024/02/ambassadors-bg.jpeg',
            'intro' => 'Throughout history, ambassadors have always been symbolic incarnations of the sovereignty of their nations and the dignity of their leaders.',
            'people' => Person::where('group', 'ambassador')->orderBy('sort')->get(),
        ]);
    }

    public function directorMessage(): View
    {
        return view('pages.director-message');
    }

    public function schools(): View
    {
        return view('pages.schools');
    }

    /** Listing pages for programs, departments, causes and blogs. */
    public function listing(string $type): View
    {
        $banners = [
            'program' => '/uploads/2024/02/compagins-scaled.jpg',
            'department' => '/uploads/2024/02/our-departments-bg.jpg',
            'campaign' => '/uploads/2024/02/Campaigns-bg.jpg',
            'blog' => '/uploads/2024/02/gec.jpg',
        ];

        $query = Post::ofType($type);

        return view('pages.listing', [
            'type' => $type,
            'title' => Post::TYPES[$type]['plural'],
            'banner' => $banners[$type],
            'posts' => $type === 'blog' ? $query->reorder()->latest('published_at')->paginate(9) : $query->get(),
        ]);
    }

    public function volunteers(): View
    {
        return view('pages.volunteers');
    }

    public function careers(): View
    {
        return view('pages.careers');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function donate(): View
    {
        return view('pages.donate', ['causes' => Post::ofType('campaign')->get()]);
    }

    public function newsletter(): View
    {
        return view('pages.documents', [
            'title' => 'Newsletter',
            'groups' => [
                'Newsletter In English' => Document::where('type', 'newsletter')->where('language', 'en')->orderBy('sort')->get(),
                'Newsletter In Urdu' => Document::where('type', 'newsletter')->where('language', 'ur')->orderBy('sort')->get(),
            ],
        ]);
    }

    public function annualReports(): View
    {
        return view('pages.documents', [
            'title' => 'Annual Reports',
            'groups' => ['' => Document::where('type', 'annual_report')->orderBy('sort')->get()],
        ]);
    }

    public function auditReports(): View
    {
        return view('pages.documents', [
            'title' => 'Audit Reports',
            'groups' => ['' => Document::where('type', 'audit_report')->orderBy('sort')->get()],
        ]);
    }

    public function magazine(): View
    {
        return view('pages.magazine', [
            'issues' => Document::where('type', 'magazine')->orderBy('sort')->get(),
        ]);
    }

    public function media(): View
    {
        return view('pages.media', [
            'videos' => Video::orderBy('sort')->get(),
            'galleries' => Gallery::with('images')->orderBy('sort')->get(),
        ]);
    }

    public function thankYou(): View
    {
        return view('pages.thank-you');
    }
}
