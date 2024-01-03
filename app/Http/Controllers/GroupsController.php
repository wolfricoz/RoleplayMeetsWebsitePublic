<?php

namespace App\Http\Controllers;

use App\Models\groups;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    public function index()
    {
        return view('admin.groups', [
            'roles' => Role::orderBy('name')->paginate(12),
            'permissions' => Permission::all(),
        ]);
    }

    private function validateCheckbox(Request $request, $name)
    {
        if ($request->has($name)) {
            return true;
        }
        return false;
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo(explode(',',$request->permissions));
        return redirect()->back()->with('success', "{$role->name} created!");
    }

    public function update(Request $request)
    {

        $role = Role::findById($request->role_id);
        $role->syncPermissions(explode(',',$request->permissions));
        return redirect()->back()->with('success', "{$role->name} updated!");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back()->with('success', "{$role->name} deleted!");
    }


}
