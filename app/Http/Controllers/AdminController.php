<?php

namespace App\Http\Controllers;

use App\Models\Genres;
use App\Models\groups;
use App\Models\Post;
use App\Support\Charts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
  public function index()
  {

    return view('admin.dashboard', [
      'new_posts_chart' => Charts::CreateLineChart(['model' => 'App\Models\Post', 'chart_title' => 'new Posts by date',]),
      'bumped_post_chart' => Charts::CreateLineChart(['model' => 'App\Models\Post', 'chart_title' => 'Bumped Posts by date', 'group_by_field' => 'bumped_at',]),
      'new_users_chart' => Charts::CreateLineChart(['model' => 'App\Models\User', 'chart_title' => 'New Signups by date']),
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
    $post->bumped_at = Carbon::now();
    $post->save();
    return redirect()->back()->with('success', 'Post successfully approved!');
  }

  public function nsfwtoggle(Request $request, Post $post): Response
  {
    if (auth()->user()->id !== $post->user_id && !auth()->user()->hasPermissionTo('manage_posts')) {
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
