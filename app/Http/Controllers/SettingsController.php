<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Settings;
use App\Support\Helpers;
use App\Support\RemoveHtmlFromText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings', [
            'user' => auth()->user(),
            'countries' => \Countries::getList('en')
        ]);
    }

    public function update(Request $request): RedirectResponse
    {

        if (strlen(RemoveHtmlFromText::removeHtmlFromText($request->bio)) > 512) {

            return redirect()->back()->withErrors(['bio' => 'Your bio may not exceed 512 characters.']);
        }
        $validated = $request->validate([
            'bio' => 'nullable|string',
            'pronouns' => 'nullable|string|max:32',
            'location' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:32',
            'reddit' => 'nullable|string|max:32',
            'telegram' => 'nullable|string|max:32',
            'instagram' => 'nullable|string|max:32',
            'other' => 'nullable|string|max:32',

        ]);
        $validated['bio'] = clean(trim(Helpers::trim_extra_spaces($validated['bio'])));
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
