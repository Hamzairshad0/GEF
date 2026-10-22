<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Post;
use App\Models\VolunteerApplication;
use Database\Seeders\ContentSeeder;
use Database\Seeders\HeroSlideSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([ContentSeeder::class, HeroSlideSeeder::class]);
    }

    public function test_every_static_page_renders(): void
    {
        $pages = ['/', '/about-us', '/board-of-directors-governing-body', '/ambassadors', '/executive-director-message',
            '/schools', '/programs', '/departments', '/causes-we-support', '/blogs', '/volunteers', '/careers',
            '/contact-us', '/donate', '/newsletter', '/annual-reports', '/audit-reports', '/etaleem-magazine', '/media', '/thank-you'];

        foreach ($pages as $page) {
            $this->get($page)->assertOk();
        }
    }

    public function test_home_page_shows_hero_slides_and_causes(): void
    {
        $this->get('/')
            ->assertSee("Let's Make Pakistan 100% Literate")
            ->assertSee('Sponsor a Disabled Child')
            ->assertSee('Achieved Milestones')
            ->assertSee('Stories Of Hope');
    }

    public function test_every_post_is_reachable_on_its_original_url(): void
    {
        foreach (Post::all() as $post) {
            $this->get(parse_url($post->url(), PHP_URL_PATH))->assertOk()->assertSee(e($post->title), false);
        }

        $this->get('/our-programs/does-not-exist')->assertNotFound();
        $this->get('/blog/rural-inclusive-education-program')->assertNotFound();
    }

    public function test_unpublished_posts_are_hidden(): void
    {
        $post = Post::where('type', 'blog')->first();
        $post->update(['is_published' => false]);

        $this->get('/blog/'.$post->slug)->assertNotFound();
    }

    public function test_donation_pledge_is_stored(): void
    {
        $this->post('/donate', [
            'name' => 'Ayesha Khan', 'email' => 'ayesha@example.com', 'phone' => '0300 1234567',
            'cause' => 'Zakat', 'frequency' => 'monthly', 'amount' => 5000,
        ])->assertRedirect(route('thank-you'));

        $this->assertDatabaseHas(Donation::class, ['email' => 'ayesha@example.com', 'cause' => 'Zakat', 'status' => 'pledged']);
    }

    public function test_donation_rejects_unknown_cause_into_its_own_error_bag(): void
    {
        $this->from('/contact-us')->post('/donate', [
            'name' => 'X', 'email' => 'x@example.com', 'phone' => '03001234567',
            'cause' => 'Something else', 'frequency' => 'one-time', 'amount' => 5000,
        ])->assertRedirect('/contact-us')->assertSessionHasErrorsIn('donation', 'cause');

        $this->assertDatabaseCount(Donation::class, 0);
    }

    public function test_contact_and_volunteer_forms_are_stored(): void
    {
        $this->from('/contact-us')->post('/contact-us', [
            'name' => 'Bilal', 'email' => 'bilal@example.com', 'message' => 'How can my company help?',
        ])->assertRedirect('/contact-us')->assertSessionHas('success');

        $this->from('/volunteers')->post('/volunteers', [
            'name' => 'Sara', 'email' => 'sara@example.com', 'phone' => '03001112223',
            'interests' => ['Photography', 'Content writing'],
        ])->assertRedirect('/volunteers')->assertSessionHas('success');

        $this->assertDatabaseHas(ContactMessage::class, ['email' => 'bilal@example.com']);
        $this->assertSame(['Photography', 'Content writing'], VolunteerApplication::first()->interests);
    }
}
