<aside
    class="col-span-3 rounded-xl bg-gray-200 p-6 lg:col-span-1 lg:col-start-4 lg:row-span-9"
>
    <div class="rounded-full border-b border-gray-300">
        <h1 class="text-center text-2xl font-bold">
            {{ $user->global_name }}'s Profile
        </h1>
        @if ($user->profile->show_pronouns)
            <h6 class="text-center text-sm">
                {{ $user->profile->pronouns }}
            </h6>
        @endif
    </div>
    <p>
        {!! clean($user->profile->bio ?? "No biography yet!") !!}
    </p>
    <x-public_profile_item
        :show="$user->profile->show_location"
        :label="('Country')"
    >
        {{ $user->profile->location ?? 'No information provided.' }}
    </x-public_profile_item>

    <div class="my-2 rounded-full border-b border-gray-300">
        <h1 class="text-center font-bold">Contact me here!</h1>
    </div>
    <x-public_profile_item
        :show="$user->profile->show_discord"
        :label="('Discord')"
    >
        {{ $user->username ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_email"
        :label="('Email')"
    >
        {{ $user->email ?? 'No information provided.' }}
    </x-public_profile_item>

    <x-public_profile_item
        :show="$user->profile->show_reddit"
        :label="('Twitter')"
    >
        {{ $user->profile->twitter ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_reddit"
        :label="('Reddit')"
    >
        {{ $user->profile->reddit ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_reddit"
        :label="('Reddit')"
    >
        {{ $user->profile->reddit ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_telegram"
        :label="('Telegram')"
    >
        {{ $user->profile->telegram ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_other"
        :label="('Other')"
    >
        {{ $user->profile->other ?? 'No information provided.' }}
    </x-public_profile_item>
    <x-public_profile_item
        :show="$user->profile->show_website"
        :label="('Website')"
    >
        {{ $user->profile->website ?? 'No information provided.' }}
    </x-public_profile_item>
    @if ($user->id === auth()->user()->id)
        <p class="pt-3 text-xs">
            Want to update your profile?
            <a href="{{ route("users.settings") }}" class="text-blue-500">
                Click here!
            </a>
        </p>
    @endif
</aside>
