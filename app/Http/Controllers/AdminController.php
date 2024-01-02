<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\groups;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function nsfwtoggle(Request $request, Post $post): Response
    {
        if (auth()->user()->id !== $post->user_id && !auth()->user()->group->manage_posts) {
            return response('Unauthorized', 401);
        }

        $post->nsfw = !$post->nsfw;
        $post->save();
        return redirect()->back()->with('success', 'NSFW status toggled!');
    }

    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->back()->with('success', 'Post deleted!');
    }


}
