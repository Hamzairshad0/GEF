<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(Request $request): View
    {
        // Read by name: the type comes from route defaults, which bind after path parameters
        $type = $request->route('type');

        $post = Post::where('type', $type)
            ->where('slug', $request->route('slug'))
            ->where('is_published', true)
            ->firstOrFail();

        $related = Post::ofType($type)->whereKeyNot($post->id)
            ->when($type === 'blog', fn ($q) => $q->reorder()->latest('published_at'))
            ->take(3)->get();

        return view('pages.post', compact('post', 'related'));
    }
}
