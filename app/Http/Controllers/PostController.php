<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Genres;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->filter(request(['search', 'genre']))->paginate(12);

        return view('home', [
            'posts' => $posts,
            'genres' => Genres::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create', [
            'genres' => Genres::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'content' => 'required',
            'charage' => 'required|numeric|min:18|max:999',
            'partnerage' => 'required|numeric|min:18|max:999',
            'genre_id' => 'required',
        ]);
        $attributes['user_id'] = auth()->id();
        $attributes['content'] = clean(trim(request('content')));
        Post::create($attributes);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
