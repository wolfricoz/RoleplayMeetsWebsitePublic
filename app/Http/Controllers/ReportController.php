<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  /**
   * @param Post $post
   * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View
   */
  public function index(Post $post)
    {
        return view('posts.report', [
          'report_reasons' => Report::$options,
          'post' => $post,
        ]);
    }

  /**
   * @param Request $request
   * @param Post $post
   * @return RedirectResponse
   */
  public function store(Request $request, Post $post): RedirectResponse
    {
        $request->validate([
          'reason' => 'required',
          'description' => 'required',
        ]);
        Report::create([
          'user_id' => auth()->user()->id,
          'post_id' => $post->id,
          'reason' => $request->reason,
          'description' => $request->description,
        ]);

        return redirect()->route('posts.show', $post)->with('message', 'Post reported successfully');
    }

    public function admin(): View
    {
        return view('admin.reports', [
          'reports' => Report::all(),
        ]);
    }

    public function changeStatus(Report $report, string $status): RedirectResponse
    {
        $report->update(['status' => $status]);
        return redirect()->back()->with('message', "Report status updated with: $status");
    }


}
