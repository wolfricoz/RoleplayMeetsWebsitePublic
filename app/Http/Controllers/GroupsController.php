<?php

namespace App\Http\Controllers;

use App\Models\groups;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        return view('admin.groups', [
            'groups' => groups::orderBy('name')->paginate(12),
        ]);
    }

    private function validateCheckbox(Request $request, $name)
    {
        if ($request->has($name)) {
            return true;
        }
        return false;
    }
    public function update(Request $request)
    {
        $attr = $request->validate([
            'id' => 'required',


        ]);
        $post = groups::find($request->id);
        $attr['access_dashboard'] = $this->validateCheckbox($request, 'access_dashboard');
        $attr['manage_posts'] = $this->validateCheckbox($request, 'manage_posts');
        $attr['manage_users'] = $this->validateCheckbox($request, 'manage_users');
        $attr['manage_rules'] = $this->validateCheckbox($request, 'manage_rules');
        $attr['manage_genres'] = $this->validateCheckbox($request, 'manage_genres');
        $attr['manage_groups'] = $this->validateCheckbox($request, 'manage_groups');
        $attr['manage_roles'] = $this->validateCheckbox($request, 'manage_roles');
        $attr['manage_settings'] = $this->validateCheckbox($request, 'manage_settings');
        $attr['is_patron'] = $this->validateCheckbox($request, 'is_patron');



        $post->update($attr);
        return redirect()->back()->with('success', 'Group updated!');
    }
}
