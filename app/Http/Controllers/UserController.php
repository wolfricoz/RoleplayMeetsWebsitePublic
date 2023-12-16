<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }
        return view('user.home', [
            'user' => auth()->user(),
            'posts' => auth()->user()->posts()->latest()->paginate(10),
        ]);
    }




}
