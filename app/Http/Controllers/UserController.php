<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }
        return view('user.dashboard', [
            'user' => auth()->user(),
            'posts' => auth()->user()->posts()->latest()->paginate(10),
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.user', [
            'user' => $user,
            'posts' => $user->posts()->latest()->paginate(10),
        ]);
    }



}
