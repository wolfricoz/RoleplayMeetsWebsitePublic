<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.groups', [
            'roles' => Role::orderBy('name')->paginate(12),
            'permissions' => Permission::all(),
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo(explode(',', $request->permissions));
        return redirect()->back()->with('success', "$role->name created!");
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->name = $request->name;
        $role->syncPermissions(explode(',', $request->permissions));
        $role->save();
        return redirect()->back()->with('success', "$role->name updated!");
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->back()->with('success', "$role->name deleted!");
    }


}
