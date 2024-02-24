<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.create')->only('create', 'store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //The pluck method created an asociative array with name fields;
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $request['user_id'] = auth()->user()->id;

        $post = Post::create($request->all());

        $url = Storage::put('posts', $request->file('file'));
        $post->image()->create([
            'url' => $url
        ]);

        $post->tags()->attach($request->tags);

        Cache::flush();

        return redirect()->route('admin.posts.index')->with('success', 'El post se creó con éxito');;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id');
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        if ($post->user->id == auth()->user()->id) {
            $post->update($request->all());

            if ($request->file('file')) {
                $url = Storage::put('posts', $request->file('file'));

                if ($post->image) {
                    Storage::delete($post->image->url);

                    $post->image->update([
                        'url' => $url
                    ]);
                } else {
                    $post->image()->create([
                        'url' => $url
                    ]);
                }
            }

            $post->tags()->sync($request->tags);

            Cache::flush();

            return redirect()->route('admin.posts.index')->with('success', 'El post se actualizó con éxito');
        }

        $status = $post->status == 'enable' ? 'disable' : 'enable';
        $post->update([
            'status' => $status
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'El post se actualizó con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        Cache::flush();

        return redirect()->route('admin.posts.index')->with('success', 'El post se eliminó con éxito');
    }
}
