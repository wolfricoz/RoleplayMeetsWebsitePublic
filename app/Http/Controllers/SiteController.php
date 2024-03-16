<?php

namespace App\Http\Controllers;

use App\Support\ConfigEditor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class SiteController extends Controller
{
    public function index()
    {
      $settings = new ConfigEditor('site_settings');
//      dd($settings->get());
        return view('admin.settings', [
          'settings' => $settings,
          'roles' => Role::all(),
        ]);

    }

    public function update(Request $request, ConfigEditor $settings): \Illuminate\Http\RedirectResponse
    {
      $validated = $request->validate([
        'admin_role' => 'required',
        'site_slogan' => 'nullable|string|max:32',
        'support_email' => 'required|email',
        'discord_invite' => 'required|url',
      ]);
      $settings->set($validated)->save();
      return redirect()->back()->with('success', 'Settings successfully updated.');
    }

    public function terms_of_service()
    {
      return view('termsofservice');
    }

    public function support()
    {
      return view('support');
    }
}
