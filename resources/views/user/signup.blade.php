<x-layout.header>
  <div id="app" class="flex items-center justify-center">
    <div class="flex flex-col lg:w-1/2">
      <form method="POST" action="{{ route("users.settings.update") }}">
        @csrf
        <div
          class="m-5 mb-1 rounded-xl bg-gray-100 p-4 lg:w-full dark:bg-gray-700 dark:text-gray-200"
        >
          <div class="text-center">
            <h1 class="text-xl font-bold">
              Thank you for signing up for RoleplayMeets.com!
            </h1>
            <h6 class="text-sm">
              Please fill in your date of birth to finalize registration. This
              information will not be shared with other users; it is only used
              to verify that you are of legal age to use this site. Lying about
              your age will result in a permanent ban.
            </h6>
          </div>

          <div class="w-48">
            <x-settings_forum_field
              name="dob"
              type="date"
              max=""
              min="1900-01-01"
            >
              * date of birth
            </x-settings_forum_field>
            @if ($errors->any())
              <div class="text-red-500">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li class="text-sm text-red-500">
                      {{ $error }}
                    </li>
                  @endforeach
                </ul>
              </div>
            @endif

            <button
              type="submit"
              class="rounded-md bg-indigo-900 p-2 text-white"
            >
              Save
            </button>
            <button
              formaction="{{ route("logout") }}"
              class="mx-2 rounded-md bg-indigo-900 p-2.5 text-white"
            >
              Logout
            </button>
          </div>
          <article class="text-center text-sm text-gray-500">
            By creating an account, you agree to the
            <a href="{{ route("tos") }}" class="text-blue-600">
              Terms of Service
            </a>
            and
            <a href="{{ route("rules") }}" class="text-blue-600">rules</a>
            .
          </article>
        </div>

        <div
          class="m-5 rounded-xl bg-gray-100 p-4 lg:w-full dark:bg-gray-700 dark:text-gray-200"
        >
          <div class="border-b border-gray-200">
            <h1 id="profile" class="text-center text-2xl font-bold">
              Profile Settings
            </h1>
            <h6 class="text-center text-sm">
              Your profile settings affect how you appear on the site. These are
              completely optional.
            </h6>
          </div>

          <div class="mt-1 border-b border-gray-200">
            <label class="font-bold">Biography</label>
            <summernote
              :name="'bio'"
              :maxlength="512"
              :value="{{ json_encode(auth()->user()->profile->bio, JSON_THROW_ON_ERROR) }}"
              :required="false"
            ></summernote>
            <div class="mt-1 w-fit">
              <x-settings_forum_field
                name="pronouns"
                value="{{ auth()->user()->profile->pronouns ?? null }}"
                type="text"
                :toggle="auth()->user()->profile->show_pronouns"
              >
                Pronouns
              </x-settings_forum_field>
              <x-settings_forum_field
                name="location"
                type="hidden"
                :toggle="auth()->user()->profile->show_location"
              >
                Country
              </x-settings_forum_field>
              <select
                name="location"
                class="rounded-xl dark:bg-gray-600 dark:text-gray-200"
              >
                <option value="0">Select a country</option>
                @foreach ($countries as $country)
                  @if (auth()->user()->profile->location === $country)
                    <option value="{{ $country }}" selected>
                      {{ $country }}
                    </option>
                    @continue
                  @endif

                  <option value="{{ $country }}">
                    {{ $country }}
                  </option>
                @endforeach
              </select>
              <x-settings_forum_field
                name="website"
                value="{{ auth()->user()->profile->website ?? null }}"
                :toggle="auth()->user()->profile->show_website"
              >
                Website
              </x-settings_forum_field>
            </div>
            <h1 class="mt-3 text-center font-bold">
              Where can users contact you?
            </h1>
          </div>

          <div class="mt-1 w-fit">
            <x-settings_forum_field
              name="discord"
              value="{{ auth()->user()->profile->show_discord ?? null }}"
              type="hidden"
              :toggle="auth()->user()->profile->show_discord"
            >
              discord username
            </x-settings_forum_field>
            <x-settings_forum_field
              name="email"
              value="{{ auth()->user()->profile->email ?? null }}"
              :toggle="auth()->user()->profile->show_email"
            >
              Public Email
            </x-settings_forum_field>
            <x-settings_forum_field
              name="twitter"
              value="{{ auth()->user()->profile->twitter ?? null }}"
              :toggle="auth()->user()->profile->show_twitter"
            >
              Twitter
            </x-settings_forum_field>
            <x-settings_forum_field
              name="reddit"
              value="{{ auth()->user()->profile->reddit ?? null }}"
              :toggle="auth()->user()->profile->show_reddit"
            >
              Reddit
            </x-settings_forum_field>
            <x-settings_forum_field
              name="telegram"
              value="{{ auth()->user()->profile->telegram ?? null }}"
              :toggle="auth()->user()->profile->show_telegram"
            >
              telegram
            </x-settings_forum_field>

            <x-settings_forum_field
              name="other"
              value="{{ auth()->user()->profile->other ?? null }}"
              :toggle="auth()->user()->profile->show_other"
            >
              Other social media
            </x-settings_forum_field>

            <button
              type="submit"
              class="rounded-md bg-indigo-900 p-2 text-white"
            >
              Save
            </button>
          </div>
        </div>
        <div
          class="m-5 rounded-xl bg-gray-100 p-4 lg:w-full dark:bg-gray-700 dark:text-gray-200"
        >
          <div class="border-b border-gray-200">
            <h1 id="Setting" class="text-center text-2xl font-bold">
              Website Settings
            </h1>
            <h6 class="text-center text-sm">
              These settings affect your browsing experience on the site.
            </h6>
          </div>
          <x-settings_forum_field
            name="location"
            type="hidden"
            :description="('This setting affects the visibility of NSFW content on the site. By default, NSFW content is hidden.')"
          >
            NSFW
          </x-settings_forum_field>

          <select
            name="nsfw"
            class="mt-1 rounded-xl dark:bg-gray-600 dark:text-gray-200"
          >
            @foreach ($post_types as $option)
              <option
                value="{{ $option }}"
                {{ auth()->user()->settings->nsfw === $option ? "selected" : "" }}
              >
                {{ $option }}
              </option>
            @endforeach
          </select>
          <button
            type="submit"
            class="mt-2 block rounded-md bg-indigo-900 p-2 text-white"
          >
            Save
          </button>
        </div>
      </form>

      <div
        class="m-5 rounded-xl bg-gray-100 p-4 lg:w-full dark:bg-gray-700 dark:text-gray-200"
      >
        <div class="border-b border-gray-200">
          <h1 id="Remove" class="text-center text-2xl font-bold">
            Delete Account
          </h1>
          <h6 class="text-center text-sm">
            This will remove your account and all your data from the site.
          </h6>
        </div>
        <form
          method="POST"
          action="{{ route("users.delete", auth()->user()) }}"
          class="mt-5"
        >
          @method("DELETE")
          @csrf
          <button
            type="submit"
            class="mt-2 block rounded-md bg-red-600 p-2 font-bold text-white"
            onclick="confirm('Are you certain you want to permanently remove your account?')"
          >
            Permanently delete your account
          </button>
          <p class="text-sm font-bold text-red-500">
            * Upon receipt of a delete request, roleplaymeets.com reserves the
            right to retain your data for up to 30 days for processing of the
            deletion. During this 30-day processing period, your account, posts,
            and other personal information will not be accessible. If you wish
            to cancel your deletion request, you may log in to roleplaymeets.com
            at any time during the 30-day processing period, which will cancel
            the processing and restore your account to full functionality.
          </p>
        </form>
      </div>
    </div>
  </div>
</x-layout.header>
