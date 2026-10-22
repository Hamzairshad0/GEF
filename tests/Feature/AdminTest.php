<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_guests_and_non_admins_are_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->actingAs(User::factory()->create())->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_log_in_and_non_admin_cannot(): void
    {
        $admin = $this->admin();
        $user = User::factory()->create();

        $this->post('/admin/login', ['email' => $user->email, 'password' => 'password'])->assertSessionHasErrors('email');
        $this->post('/admin/login', ['email' => $admin->email, 'password' => 'password'])->assertRedirect('/admin');
        $this->assertAuthenticatedAs($admin);
    }

    public function test_admin_pages_render(): void
    {
        $this->actingAs($this->admin());

        foreach (['/admin', '/admin/slides', '/admin/slides/create', '/admin/donations', '/admin/messages', '/admin/volunteers'] as $url) {
            $this->get($url)->assertOk();
        }
        foreach (array_keys(Post::TYPES) as $type) {
            $this->get("/admin/posts?type={$type}")->assertOk();
            $this->get("/admin/posts/create?type={$type}")->assertOk();
        }
    }

    public function test_admin_can_create_update_and_delete_a_post(): void
    {
        $this->actingAs($this->admin());

        $this->post('/admin/posts', [
            'type' => 'blog', 'title' => 'New school opens', 'slug' => 'new-school-opens',
            'body' => '<p>Hello</p>', 'is_published' => '1',
        ])->assertRedirect();
        $post = Post::where('slug', 'new-school-opens')->firstOrFail();
        $this->get('/blog/new-school-opens')->assertOk()->assertSee('New school opens');
        $this->get("/admin/posts/{$post->id}/edit")->assertOk();

        $this->put("/admin/posts/{$post->id}", ['title' => 'New school opened', 'slug' => 'new-school-opens'])->assertRedirect();
        $this->assertFalse($post->fresh()->is_published);
        $this->assertSame('blog', $post->fresh()->type);

        $this->delete("/admin/posts/{$post->id}")->assertRedirect();
        $this->assertModelMissing($post);
    }

    public function test_slug_must_be_unique_per_type(): void
    {
        $this->actingAs($this->admin());
        Post::create(['type' => 'blog', 'slug' => 'taken', 'title' => 'A']);

        $this->post('/admin/posts', ['type' => 'blog', 'title' => 'B', 'slug' => 'taken'])->assertSessionHasErrors('slug');
        $this->post('/admin/posts', ['type' => 'program', 'title' => 'B', 'slug' => 'taken'])->assertSessionHasNoErrors();
    }

    public function test_admin_can_update_donation_status(): void
    {
        $this->actingAs($this->admin());
        $donation = Donation::create(['name' => 'A', 'email' => 'a@example.com', 'phone' => '0300', 'cause' => 'Zakat', 'amount' => 1000]);

        $this->patch("/admin/donations/{$donation->id}", ['status' => 'received'])->assertRedirect();
        $this->assertSame('received', $donation->fresh()->status);

        $this->patch("/admin/donations/{$donation->id}", ['status' => 'bogus'])->assertSessionHasErrors('status');
    }
}
