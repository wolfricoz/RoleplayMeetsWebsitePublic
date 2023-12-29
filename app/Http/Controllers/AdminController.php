<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Genres;
use App\Models\Post;
use http\Client\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.dashboard', [

        ]);
    }

    public function queue()
    {
        $posts = Post::latest()->approved(false)->filter(request(['search', 'genre']))->paginate(12);
        return view('admin.queue', [
            'posts' => $posts,
            'genres' => Genres::all(),
        ]);
    }

    public function approvetoggle(Request $request, Post $post): RedirectResponse
    {
        $post->approved = !$post->approved;
        $post->save();
        return redirect()->back();
    }
    public function nsfwtoggle(Request $request, Post $post): RedirectResponse
    {
        $post->nsfw = !$post->nsfw;
        $post->save();
//        return redirect()->back();
        return redirect()->back();
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->back('admin.queue');
    }
}
