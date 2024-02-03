<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::where('status', 'enable')->latest('id')->paginate(8);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post): View
    {
        $relatedPosts = Post::where('category_id', $post->category_id)
                                ->where([['status', 'enable'], ['id', '!=', $post->id]])
                                ->latest('id')
                                ->take(4)
                                ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function category(Category $category)
    {
        $posts = Post::where([
                ['category_id', $category->id],
                ['status', 'enable']
            ])
            ->latest('id')
            ->paginate(4);

        $categories = $category::all();
        $tags = Tag::all();
        $latestPosts = Post::latest('id')->take(4)->get();

        return view('posts.category', compact('posts', 'category', 'tags', 'categories', 'latestPosts'));
    }

    public function tag(Tag $tag)
    {
        // * Return posts lists with x tag
        //return $tag->posts;
        // * Return relation
        $tags = $tag->where('id', '!=', $tag->id)->get();
        $posts = $tag->posts()->where('status', 'enable')->latest('id')->paginate(4);
        $categories = Category::all();
        $latestPosts = Post::latest('id')->take(4)->get();

        return view('posts.tag', compact('tag', 'tags', 'posts', 'categories', 'latestPosts'));
    }
}
