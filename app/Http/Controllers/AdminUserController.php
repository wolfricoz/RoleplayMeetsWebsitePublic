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
            'users' => User::all(),
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

    public function ban(Request $request, User $user)
    {
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
}
