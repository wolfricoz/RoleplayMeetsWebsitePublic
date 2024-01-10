@php use App\Models\Profile; @endphp
<x-layout.header>
    <div id="app" class="flex justify-center items-center">
        <div class="flex flex-col lg:w-1/2">
            <div class="m-5 p-4 lg:w-full bg-gray-100 border border-gray-200 rounded-xl mb-1">
                <div class="border-b border-gray-200">
                    <h1 id="discord" class="text-2xl font-bold text-center ">Discord Information</h1>
                    <h6 class="text-sm text-center">
                        The following options are provided by discord and can be changed through discord.
                    </h6>
                </div>
                <div class="mt-1">
                    <img src="{{ auth()->user()->getAvatar(['extension' => 'webp', 'size' => 128]) }}" alt=""
                         class="m-auto h-32 w-32 rounded-full border border-gray-200 bg-gray-50">
                    <p>
                        Discord ID: {{ auth()->user()->id }}
                    </p>
                    <p>
                        global name: {{ auth()->user()->global_name }}
                    </p>
                    <p>
                        Username: {{ auth()->user()->username }}
                    </p>
                    <p>
                        Email: {{ auth()->user()->email }}
                    </p>
                </div>


            </div>
            <div class="m-5 p-4 lg:w-full bg-gray-100 border border-gray-200 rounded-xl ">
                <div class="border-b border-gray-200">
                    <h1 id="profile" class="text-2xl font-bold text-center ">Profile Settings</h1>
                    <h6 class="text-sm text-center">
                        Your profile settings affect how you appear on the site.
                    </h6>
                </div>
                <form method="POST" action="{{ route('users.settings.update') }}">
                    @csrf
                    <div class="mt-1 border-b border-gray-200">
                        <label class="font-bold">Biography</label>
                        <summernote :name="'biography'"
                                    :maxlength="2000"
                                    :value="{{ json_encode(old('biography'), JSON_THROW_ON_ERROR) }}"></summernote>
                        <div class="mt-1 w-fit">

                            <x-settings_forum_field name="pronouns"
                                                    value="{{ auth()->user()->profile->pronouns ?? null }}"
                                                    type="text"
                                                    :toggle="auth()->user()->profile->show_pronouns">
                                Pronouns
                            </x-settings_forum_field>
                            <x-settings_forum_field name="location"
                                                    value="{{ auth()->user()->profile->location ?? null }}"
                                                    :toggle="auth()->user()->profile->show_location">
                                Location
                            </x-settings_forum_field>
                            <x-settings_forum_field name="website"
                                                    value="{{ auth()->user()->profile->website ?? null }}">
                                Website
                            </x-settings_forum_field>
                        </div>
                        <h1 class="font-bold text-center mt-3">Where can users contact you?</h1>
                    </div>

                    <div class="mt-1 w-fit ">


                        <x-settings_forum_field name="show_discord"
                                                value="{{ auth()->user()->profile->show_discord ?? null }}"
                                                type="hidden"
                                                :toggle="auth()->user()->profile->show_discord">
                            discord username
                        </x-settings_forum_field>
                        <x-settings_forum_field name="email" value="{{ auth()->user()->profile->email ?? null }}"
                                                :toggle="auth()->user()->profile->show_email">
                            Public Email
                        </x-settings_forum_field>
                        <x-settings_forum_field name="twitter" value="{{ auth()->user()->profile->twitter ?? null }}"
                                                :toggle="auth()->user()->profile->show_twitter">
                            Twitter
                        </x-settings_forum_field>
                        <x-settings_forum_field name="reddit" value="{{ auth()->user()->profile->reddit ?? null }}"
                                                :toggle="auth()->user()->profile->show_reddit">
                            Reddit
                        </x-settings_forum_field>
                        <x-settings_forum_field name="telegram" value="{{ auth()->user()->profile->telegram ?? null }}"
                                                :toggle="auth()->user()->profile->show_telegram">
                            telegram
                        </x-settings_forum_field>


                        <x-settings_forum_field name="other" value="{{ auth()->user()->profile->other ?? null }}"
                                                :toggle="auth()->user()->profile->show_other">
                            Other social media
                        </x-settings_forum_field>


                        <button type="submit" class="bg-indigo-900 text-white rounded-md p-2">Save</button>
                    </div>
                </form>
            </div>
            <div class="m-5 p-4 lg:w-full bg-gray-100 border border-gray-200 rounded-xl ">
                <div class="border-b border-gray-200">
                    <h1 id="Setting" class="text-2xl font-bold text-center ">Website Settings</h1>
                    <h6 class="text-sm text-center">
                        These settings affect your browsing experience on the site.
                    </h6>
                </div>
                <form method="POST" action="{{ route('users.settings.update') }}" class="mt-5">
                    @csrf
                    <span class="w-36 font-bold">NSFW?</span>
                    <label class="ml-3 inline-flex items-center rounded-md cursor-pointer dark:text-gray-800">
                        <input name="NSFW" type="checkbox"
                               class="hidden peer" {{ auth()->user()->settings->NSFW ? 'checked' : '' }}>
                        <span class="px-4  rounded-l-md bg-green-500 peer-checked:bg-gray-500">Hidden</span>
                        <span class="px-4 rounded-r-md bg-gray-500 peer-checked:bg-blue-400">Shown</span>
                    </label>
                    <button type="submit" class="block bg-indigo-900 text-white rounded-md p-2 mt-2">Save</button>
                </form>
            </div>

            <div class="m-5 p-4 lg:w-full bg-gray-100 border border-gray-200 rounded-xl ">
                <div class="border-b border-gray-200">
                    <h1 id="Remove" class="text-2xl font-bold text-center ">Delete Account</h1>
                    <h6 class="text-sm text-center">
                        This will remove your account and all your data from the site.
                    </h6>
                </div>
                <form method="POST" action="{{ route('users.delete', auth()->user()) }}" class="mt-5">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="block bg-red-600 text-white font-bold rounded-md p-2 mt-2"
                            onclick="confirm('Are you certain you want to permanently remove your account?')">
                        Permanently delete your account
                    </button>
                    <p class="text-red-500 text-sm font-bold">* Upon receipt of a delete request, roleplaymeets.com
                        reserves the right to retain your data for up to 30 days for processing of the deletion. During
                        this 30-day processing period, your account, posts, and other personal information will not be
                        accessible. If you wish to cancel your deletion request, you may log in to roleplaymeets.com at
                        any time during the 30-day processing period, which will cancel the processing and restore your
                        account to full functionality.</p>
                </form>
            </div>
        </div>
    </div>
</x-layout.header>

