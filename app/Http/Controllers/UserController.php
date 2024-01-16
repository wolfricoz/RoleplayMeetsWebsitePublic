<?php

namespace App\Http\Controllers;

use App\Models\Genres;
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
            'posts' => auth()->user()->posts()->latest()->filter(['genre', 'search'])->paginate(10),
            'genres' => Genres::all(),
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($user->banned_at !== null) {
            return redirect()->route('home')->with('error', 'This user is banned.');
        }

        return view('user.user', [
            'user' => $user,
            'posts' => $user->posts()->latest()->approved('true')->paginate(10),
            'genres' => Genres::all(),
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('home')->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();
        return redirect()->route('home')->with('success', 'User restored.');
    }
}
