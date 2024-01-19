<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Genres;
use App\Models\Post;
use App\Support\Helpers;
use App\Support\RemoveHtmlFromText;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->approved(true)->filter(request(['search', 'genre']))->banned()->paginate(12);

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
            'title' => 'required|min:10|max:255',
            'content' => 'required',
            'charage' => 'required|numeric|min:18|max:999',
            'partnerage' => 'required|numeric|min:18|max:999',
            'genre_id' => 'required',
        ]);
        if (strlen(RemoveHtmlFromText::removeHtmlFromText(request('content'))) > 10000) {
            return back()->withErrors(['content' => 'Your post may not exceed 10000 characters.']);
        }


        $attributes['user_id'] = auth()->id();
        $attributes['content'] = clean(trim(Helpers::trim_extra_spaces(request('content'))));
//        dd($attributes['content']);
        Post::create($attributes);
        return redirect('/')->with('success', 'Post successfully created and is awaiting approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): void
    {
        //
    }

    Public function admin()
    {
        $posts = Post::latest()->approved(true)->filter(request(['search', 'genre']))->paginate(12);
        return view('admin.posts', [
            'posts' => $posts,
            'genres' => Genres::all(),
        ]);
    }
}
