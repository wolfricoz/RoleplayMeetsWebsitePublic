<?php

namespace App\Http\Controllers;

use App\Mail\postDisapprove;
use App\Mail\PostApproved;
use App\Mail\PostRejected;
use App\Models\Genres;
use App\Models\Post;
use App\Support\Charts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
  public function index()
  {

    return view('admin.dashboard', [
      'new_posts_chart' => Charts::CreateLineChart(['model' => 'App\Models\Post', 'chart_title' => 'new Posts by date']),
      'bumped_post_chart' => Charts::CreateLineChart(['model' => 'App\Models\Post', 'chart_title' => 'Bumped Posts by date',
        'group_by_field' => 'bumped_at', 'chart_type' => 'bar', 'filter_period' => 'week']),
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
    if ($post->created_at !== $post->updated_at) {
      $post->bumped_at = Carbon::now();
    }
    if ($post->approved) {
      $post->approved = !$post->approved;
      $post->save();
      Mail::to($post->user->email)->send(new PostDisapprove($post));
      return redirect()->back()->with('success', 'Post has been returned to the queue!');
    }

    $post->approved = !$post->approved;
    $post->save();
    Mail::to($post->user->email)->send(new PostApproved($post));
    return redirect()->back()->with('success', 'Post successfully approved!');
  }

  public function reject(Request $request, Post $post): RedirectResponse
  {
    $post->delete();
    Mail::to($post->user->email)->send(new PostRejected($request['reason'], $post));
    return redirect()->back()->with('success', 'Post rejected!');
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
