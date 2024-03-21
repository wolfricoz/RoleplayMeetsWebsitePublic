<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Settings;
use App\Support\Helpers;
use App\Support\RemoveHtmlFromText;
use Countries;
use DateTime;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('user.settings', [
            'user' => auth()->user(),
            'countries' => Countries::getList()
        ]);
    }

    public function dob()
    {
        if (auth()->user()->profile->dob !== null) {
            return redirect()->route('users.settings');
        }
        return view('user.signup', [
            'user' => auth()->user(),
            'countries' => Countries::getList()
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(Request $request): RedirectResponse
    {
        $user = auth()->user();
        $bio = RemoveHtmlFromText::removeHtmlFromText($request->bio);

        if (strlen($bio) > 512) {
            return redirect()->back()->withErrors(['bio' => 'Your bio may not exceed 512 characters.']);
        }

        $profile = $request->validate([
            'dob' => 'required|date',
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

        if ($profile['dob'] > now()->subYears(18)) {
            $user->ban([
                'comment' => 'User is under 18.',
                'expired_at' => now()->addYears(18 - (new DateTime($profile['dob']))->diff(now())->y ?? 1),
            ]);
            return redirect()->route('home');
        }

        $profile['dob'] = $user->profile->dob ?? $profile['dob'];
        $profile['bio'] = clean(trim(Helpers::trim_extra_spaces($profile['bio'])));

        foreach ($request->all() as $key => $value) {
            if (str_starts_with($key, 'show_')) {
                $profile[$key] = true;
            }
        }

        if (isset($request['nsfw'])) {
            Settings::where('user_id', auth()->id())->first()->update(['nsfw'=> $request['nsfw']]);
        }

        Profile::where('user_id', auth()->id())->first()->update($profile);

        return redirect()->route('dashboard')->with('success', 'Your settings were saved.');
    }
}
