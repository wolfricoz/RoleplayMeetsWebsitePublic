<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.user.index', [
            'users' => User::first()->paginate(20),
        ]);
    }

    public function show(User $user)
    {
        return view('admin.user.manage', [
            'user' => $user,
            'roles' => Role::all()
        ]);
    }


    public function update(Request $request, User $user)
    {
        $roles = explode(',', $request->permissions);
        $user->syncRoles($roles);
        return redirect()->route('admin.users.show', $user);
    }


    public function indexbans()
    {
        return view('admin.user.bans', [
            'users' => User::first()->where('banned_at', '!=', null)->paginate(20),
        ]);
    }

    public function ban(Request $request, User $user)
    {
        request()->validate([
            'comment' => 'required',
            'expired_at' => 'nullable|date',
        ]);
        if (!$request->has('expired_at')){
            $user->ban([
                'comment' => $request->comment,
            ]);
            return redirect()->route('admin.users.show', $user);
        }
        $user->ban([
            'comment' => $request->comment,
            'expired_at' => $request->expired_at,
        ]);


        return redirect()->route('admin.users.show', $user);
    }

    public function unban(User $user)
    {
        $user->unban();
        return redirect()->back();
    }
}
