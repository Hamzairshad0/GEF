<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Support\Uploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type', 'program');
        abort_unless(isset(Post::TYPES[$type]), 404);

        return view('admin.posts.index', [
            'type' => $type,
            'posts' => Post::where('type', $type)->orderBy('sort')->latest('published_at')->paginate(20)->withQueryString(),
        ]);
    }

    public function create(Request $request): View
    {
        $type = $request->query('type', 'program');
        abort_unless(isset(Post::TYPES[$type]), 404);

        return view('admin.posts.form', ['post' => new Post(['type' => $type, 'is_published' => true, 'published_at' => now()])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $post = Post::create($this->validated($request));

        return redirect()->route('admin.posts.index', ['type' => $post->type])->with('success', 'Saved “'.$post->title.'”.');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.form', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $post->update($this->validated($request, $post));

        return redirect()->route('admin.posts.index', ['type' => $post->type])->with('success', 'Updated “'.$post->title.'”.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return back()->with('success', 'Deleted “'.$post->title.'”.');
    }

    private function validated(Request $request, ?Post $post = null): array
    {
        $type = $post?->type ?? $request->input('type');

        $data = $request->validate([
            'type' => [Rule::requiredIf(! $post), Rule::in(array_keys(Post::TYPES))],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'alpha_dash', 'max:255', Rule::unique('posts')->where('type', $type)->ignore($post)],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'sort' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'banner_file' => ['nullable', 'image', 'max:4096'],
            'thumb_file' => ['nullable', 'image', 'max:4096'],
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['sort'] ??= 0;
        foreach (['banner', 'thumb'] as $field) {
            if ($request->hasFile("{$field}_file")) {
                $data[$field] = Uploads::store($request->file("{$field}_file"));
            }
            unset($data["{$field}_file"]);
        }
        if ($post) {
            unset($data['type']);
        }

        return $data;
    }
}
