<x-admin-layout.header>
    <div id="app" class="m-5 bg-gray-100 p-4 rounded-xl">
        <img class="h-32 w-32 m-auto rounded-full object-cover border border-gray-200 "
             src="{{ $user->getAvatar(['extension' => 'webp', 'size' => 512]) }}"
             alt="{{ $user->getTagAttribute() }}"/>
        <div class="text-center border-b border-gray-200 p-2 my-2">
            <h1 class="text-xl font-bold">{{ $user->global_name }}</h1>
            <div class="flex justify-center gap-4">
                <h6 class="text-sm font-bold">{{ $user->id}}</h6>
            </div>
            <h6 class="text-sm">{{ $user->profile->bio }}</h6>

        </div>
        <ul class="text-xs">
            <li>Legend:</li>
            <li>✅ public</li>
            <li>❌ hidden</li>
        </ul>
        <div class="grid grid-cols-2 gap-4">
            <div class="col-span-1 p-2">
                <div class="text-center border-b border-gray-200 p-2 my-2">
                    <h1 class="text-lg font-bold">Discord Info</h1>
                </div>
                <x-admin-layout.profile_item :show="false" :label="('Discord Username')">
                    {{ $user->username }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Discord ID')">
                    {{ $user->id }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Discord Email')">
                    {{ $user->email }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Multi-factor authentication')">
                    {{ $user->mfa_enabled ? '✅' : '❌' }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Verified')">
                    {{ $user->verified ? '✅' : '❌' }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Nitro')">
                    {{ $user->premium_type }}
                </x-admin-layout.profile_item>
                <x-admin-layout.profile_item :show="false" :label="('Locale')">
                    {{ $user->locale }}
                </x-admin-layout.profile_item>


            </div>
            <div class="col-span-1 p-2">
                <div class="text-center border-b border-gray-200 p-2 my-2">
                    <h1 class="text-lg font-bold">Profile</h1>
                </div>
                <article class="">

                    <x-admin-layout.profile_item :show="$user->profile->show_discord" :label="('Discord')">
                        {{ $user->username }}
                    </x-admin-layout.profile_item>

                    <x-admin-layout.profile_item :show="true" :label="('Website')">
                        {{ $user->profile->website ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_location" :label="('Location')">
                        {{ $user->profile->location ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_pronouns" :label="('Pronouns')">
                        {{ $user->profile->pronouns ?? '❌'}}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_email" :label="('Public Email')">
                        {{ $user->profile->email ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_twitter" :label="('Twitter')">
                        {{ $user->profile->twitter ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_reddit" :label="('Reddit')">
                        {{ $user->profile->reddit ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_telegram" :label="('Telegram')">
                        {{ $user->profile->telegram ?? '❌' }}
                    </x-admin-layout.profile_item>
                    <x-admin-layout.profile_item :show="$user->profile->show_other" :label="('Other')">
                        {{ $user->profile->other ?? '❌' }}
                    </x-admin-layout.profile_item>
                </article>
            </div>


        </div>
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-5">
            @csrf
            <multiselectrole :values="{{ $roles }}" :selected="{{ $user->roles }}" title="Roles">

            </multiselectrole>
            <x-admin-layout.cms_form_button class="mt-2 border-blue-700 hover:bg-blue-600">
                Update
            </x-admin-layout.cms_form_button>
        </form>
        <form class="p-5" x-data="{permanent: true}" method="POST" action="{{ route('admin.users.ban', $user) }}">
            @csrf
            <h6 class=" text-lg text-red-500 font-bold">Ban</h6>
            <label for="reason" class="font-bold">Reason</label>
            <div class="">
                <summernote :name="'comment'"
                            :maxlength="512"
                            :value="{{ json_encode(old('reason'), JSON_THROW_ON_ERROR) }}"></summernote>
            </div>
            <label class="relative inline-flex items-center me-5 cursor-pointer">
                <input id="" type="checkbox" value="" class="sr-only peer" x-model="permanent" checked>
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600"></div>
                <span class="ms-3 text-sm font-medium text-gray-900">Permanent</span>
            </label>
            <div x-show="!permanent">
                <label for="expires_at" class="font-bold ml-3">Expires At</label>
                <input id="expires_at" name="expires_at" type="datetime-local" value="{{ old('expires_at') }}"
                       class="text-sm border-2 border-gray-400 rounded-lg w-64">
            </div>
            <x-admin-layout.cms_form_button class="block mt-2 border-red-700 hover:bg-red-600">
                Ban
            </x-admin-layout.cms_form_button>
        </form>


    </div>
</x-admin-layout.header>
