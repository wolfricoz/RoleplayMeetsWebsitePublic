<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\Post;
use App\Models\User;
use App\Support\AutoMod;
use App\Support\Helpers;
use App\Support\RemoveHtmlFromText;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $posts = Post::approved(true)->
    NSFW()->
    filter(request(['search', 'genre']))
      ->banned()
      ->orderBy('bumped_at', 'desc')
      ->orderBy('created_at', 'desc')
      ->orderBy('updated_at', 'desc')
      ->paginate(20);

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
    $old_post = AutoMod::check_duplicates(['user_id' => auth()->id(), 'content' => request('content')]);
    if ($old_post) {
      return redirect()->route('posts.show', $old_post['post'])
        ->with('error', "Your post is too similar to this post at {$old_post['similarity']}% similarity. Please bump it instead.");
    }
    $attributes = request()->validate([
      'title' => 'required|min:10|max:255',
      'content' => 'required',
      'charage' => 'required|numeric|min:18|max:999',
      'partnerage' => 'required|numeric|min:18|max:999',
      'genre_id' => 'required',
    ]);
    if (strlen(RemoveHtmlFromText::removeHtmlFromText(request('content'))) > 10000) {
      return back()->withErrors(['content' => 'Your post may not exceed 10000 characters.'])->withInput();
    }


    $attributes['user_id'] = auth()->id();
    $attributes['content'] = clean(trim(Helpers::trim_extra_spaces(request('content'))));
    $attributes['bumped_at'] = now();
//        dd($attributes['content']);
    Post::create($attributes);
    return redirect('/')->with('success', 'Post successfully created and is awaiting approval.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
  {
    return view('posts.view', [
      'user' => User::findOrFail($post->user_id),
      'post' => $post,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Post $post): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
  {
    return view('posts.edit', [
      'post' => $post,
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post): RedirectResponse
  {
    if (!auth()->user()->id === $post->user_id) {
      abort(403, 'Unauthorized action.');
    }
    if (request('bump') === "true") {
      if (Carbon::parse($post->bumped_at)->addHours(23) > Carbon::now()) {
        return redirect()->back()->with('error', 'You can only bump your post once every 24 hours.');
      }

      $post->bumped_at = Carbon::now();
      $post->save();
      return redirect()->back()->with('success', 'Post bumped!');
    }

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
    $attributes['content'] = clean(trim(Helpers::trim_extra_spaces(request('content'))));
    $attributes['approved'] = false;
    $post->update($attributes);
    return redirect('/')->with('success', 'Post successfully updated and is awaiting approval.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post): void
  {
    //
  }


  public function admin()
  {
    $posts = Post::latest()->approved(true)->filter(request(['search', 'genre']))->paginate(12);
    return view('admin.posts', [
      'posts' => $posts,
      'genres' => Genres::all(),
    ]);
  }
}
