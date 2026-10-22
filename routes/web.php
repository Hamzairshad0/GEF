<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubmissionController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

// Public site — paths mirror the original WordPress site
Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/board-of-directors-governing-body', 'board')->name('board');
    Route::get('/ambassadors', 'ambassadors')->name('ambassadors');
    Route::get('/executive-director-message', 'directorMessage')->name('director-message');
    Route::get('/schools', 'schools')->name('schools');
    Route::get('/programs', 'listing')->defaults('type', 'program')->name('programs');
    Route::get('/departments', 'listing')->defaults('type', 'department')->name('departments');
    Route::get('/causes-we-support', 'listing')->defaults('type', 'campaign')->name('causes');
    Route::get('/blogs', 'listing')->defaults('type', 'blog')->name('blogs');
    Route::get('/volunteers', 'volunteers')->name('volunteers');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::get('/donate', 'donate')->name('donate');
    Route::get('/newsletter', 'newsletter')->name('newsletter');
    Route::get('/annual-reports', 'annualReports')->name('annual-reports');
    Route::get('/audit-reports', 'auditReports')->name('audit-reports');
    Route::get('/etaleem-magazine', 'magazine')->name('magazine');
    Route::get('/media', 'media')->name('media');
    Route::get('/thank-you', 'thankYou')->name('thank-you');
});

foreach (['program' => 'our-programs', 'department' => 'our-departments', 'campaign' => 'our-campaigns', 'story' => 'our-achievements', 'blog' => 'blog'] as $type => $prefix) {
    Route::get("/{$prefix}/{slug}", [PostController::class, 'show'])->defaults('type', $type)->name("{$type}.show");
}

Route::middleware('throttle:10,1')->controller(SubmissionController::class)->group(function () {
    Route::post('/donate', 'donate')->name('donate.store');
    Route::post('/contact-us', 'contact')->name('contact.store');
    Route::post('/volunteers', 'volunteer')->name('volunteers.store');
});

// Admin panel
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [Admin\AuthController::class, 'create'])->middleware('guest')->name('login');
    Route::post('login', [Admin\AuthController::class, 'store'])->middleware('guest');

    Route::middleware(EnsureAdmin::class)->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'destroy'])->name('logout');
        Route::get('/', Admin\DashboardController::class)->name('dashboard');
        Route::resource('posts', Admin\PostController::class)->except('show');
        Route::resource('slides', Admin\HeroSlideController::class)->except('show');

        Route::controller(Admin\InboxController::class)->group(function () {
            Route::get('donations', 'donations')->name('donations');
            Route::patch('donations/{donation}', 'updateDonation')->name('donations.update');
            Route::get('messages', 'messages')->name('messages');
            Route::patch('messages/{message}', 'readMessage')->name('messages.read');
            Route::get('volunteers', 'volunteers')->name('volunteers');
            Route::patch('volunteers/{application}', 'readVolunteer')->name('volunteers.read');
        });
    });
});
