<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.report', [
          'report_reasons' => Report::$options,
          'post' => $post,
        ]);
    }
}
