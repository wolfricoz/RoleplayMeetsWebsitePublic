<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Settings;
use App\Support\RemoveHtmlFromText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        if (RemoveHtmlFromText::removeHtmlFromText($request->bio) > 2000) {
            return redirect()->back()->with('error', 'Your bio is too long. Please shorten it.');
        }


        $validated = $request->validate([
            'bio' => 'nullable|string|max:2000',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'other' => 'nullable|string|max:255',

        ]);
        foreach (\request()->all() as $key => $value) {
            if (isset($request[$key]) && str_starts_with($key, 'show_')) {
                $validated[$key] = true;
            }
        }
        if (isset($request['NSFW'])) {
            $nsfw['NSFW'] = true;
            $settings = Settings::where('user_id', auth()->id())->first();
            $settings->update($nsfw);
            $settings->save();
        }
        $profile = Profile::where('user_id', auth()->id())->first();
        $profile->update($validated);
        $profile->save();
        return redirect()->back()->with('success', 'Your settings were saved.');
    }
}
