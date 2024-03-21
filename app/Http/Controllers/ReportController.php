<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Post $post)
    {
        return view('posts.report', [
          'post' => $post,
        ]);
    }
}
