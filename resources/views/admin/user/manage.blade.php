<x-admin-layout.header>
  <div
    id="app"
    class="m-5 rounded-xl bg-gray-100 p-4 dark:bg-gray-700 dark:text-gray-200"
  >
    @isset($user->banned_at)
      <div class="rounded-xl bg-red-500 p-2 text-center text-white">
        <h1 class="font-bold">This user is banned</h1>

        <p>{{ $user->getBans()->first()->comment }}</p>
      </div>
    @endisset

    <img
      class="m-auto h-32 w-32 rounded-full border border-gray-200 object-cover"
      src="{{ $user->getAvatar(["extension" => "webp", "size" => 512]) }}"
      alt="{{ $user->getTagAttribute() }}"
    />
    <div class="my-2 border-b border-gray-200 p-2 text-center">
      <h1 class="text-xl font-bold">{{ $user->global_name }}</h1>
      <div class="flex justify-center gap-4">
        <h6 class="text-sm font-bold">{{ $user->id }}</h6>
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
        <div class="my-2 border-b border-gray-200 p-2 text-center">
          <h1 class="text-lg font-bold">Discord Info</h1>
        </div>
        <x-admin-layout.profile_item
          :show="false"
          :label="('Discord Username')"
        >
          {{ $user->username }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item :show="false" :label="('Discord ID')">
          {{ $user->id }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item :show="false" :label="('Discord Email')">
          {{ $user->email }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item
          :show="false"
          :label="('Multi-factor authentication')"
        >
          {{ $user->mfa_enabled ? "✅" : "❌" }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item :show="false" :label="('Verified')">
          {{ $user->verified ? "✅" : "❌" }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item :show="false" :label="('Nitro')">
          {{ $user->premium_type }}
        </x-admin-layout.profile_item>
        <x-admin-layout.profile_item :show="false" :label="('Locale')">
          {{ $user->locale }}
        </x-admin-layout.profile_item>
      </div>
      <div class="col-span-1 p-2">
        <div class="my-2 border-b border-gray-200 p-2 text-center">
          <h1 class="text-lg font-bold">Profile</h1>
        </div>
        <article class="">
          <x-admin-layout.profile_item
            :show="$user->profile->show_discord"
            :label="('Discord')"
          >
            {{ $user->username }}
          </x-admin-layout.profile_item>

          <x-admin-layout.profile_item :show="true" :label="('Website')">
            {{ $user->profile->website ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_location"
            :label="('Location')"
          >
            {{ $user->profile->location ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_pronouns"
            :label="('Pronouns')"
          >
            {{ $user->profile->pronouns ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_email"
            :label="('Public Email')"
          >
            {{ $user->profile->email ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_twitter"
            :label="('Twitter')"
          >
            {{ $user->profile->twitter ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_reddit"
            :label="('Reddit')"
          >
            {{ $user->profile->reddit ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_telegram"
            :label="('Telegram')"
          >
            {{ $user->profile->telegram ?? "❌" }}
          </x-admin-layout.profile_item>
          <x-admin-layout.profile_item
            :show="$user->profile->show_other"
            :label="('Other')"
          >
            {{ $user->profile->other ?? "❌" }}
          </x-admin-layout.profile_item>
        </article>
      </div>
    </div>
    @if (auth()->user()->hasPermissionTo("manage_roles"))
      <form
        method="POST"
        action="{{ route("admin.users.update", $user) }}"
        class="p-5"
      >
        @csrf
        <multiselectrole
          :values="{{ $roles }}"
          :selected="{{ $user->roles }}"
          title="Roles"
        ></multiselectrole>
        <x-admin-layout.cms_form_button
          class="mt-2 border-blue-700 hover:bg-blue-600 dark:border-blue-400 dark:text-gray-200"
        >
          Update
        </x-admin-layout.cms_form_button>
      </form>
    @endif

    @if (auth()->user()->hasPermissionTo("ban_users"))
      <form
        class="p-5"
        x-data="{ permanent: true }"
        method="POST"
        action="{{ route("admin.users.ban", $user) }}"
      >
        @csrf
        <h6 class="text-lg font-bold text-red-500">Ban</h6>
        <label for="comment" class="font-bold">Reason</label>
        <div class="">
          <textarea
            id="comment"
            name="comment"
            class="w-full rounded-lg border-2 text-sm dark:bg-gray-600 dark:text-gray-200"
          ></textarea>
        </div>
        <label class="relative me-5 inline-flex cursor-pointer items-center">
          <input
            id=""
            type="checkbox"
            value=""
            class="peer sr-only"
            x-model="permanent"
            checked
          />
          <div
            class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:start-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-red-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-4 peer-focus:ring-red-300 rtl:peer-checked:after:-translate-x-full dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-red-800"
          ></div>
          <span class="ms-3 text-sm font-medium">Permanent</span>
        </label>
        <div x-show="!permanent">
          <label for="expires_at" class="ml-3 font-bold">Expires At</label>
          <input
            id="expired_at"
            name="expired_at"
            type="date"
            value="{{ old("expires_at") }}"
            class="ml-2 w-64 rounded-lg border-2 text-sm  dark:bg-gray-700 dark:text-gray-200"

          />
        </div>
        <div class="block">
          <div class="flex flex-row">
            <a
              onclick="return confirm('Are you sure you want to ban {{ $user->username }}?')"
            >
              <x-admin-layout.cms_form_button
                class="mt-2 block border-red-700 px-5 hover:bg-red-600 dark:text-gray-200"
              >
                Ban
              </x-admin-layout.cms_form_button>
            </a>

          </div>

        </div>


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
      </form>
      <div class="border-b border-gray-200">
        <h1 id="Remove" class="text-center text-2xl font-bold">
          Delete Account
        </h1>
        <h6 class="text-center text-sm">
          This will remove the {{ $user->username }}'s account and all personal data from the site.
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
          class="mx-auto block rounded-md bg-red-600 p-2 font-bold text-white"
          onclick="confirm('Are you certain you want to permanently remove {{ $user->username }}\'s account?')"
        >
          Permanently delete {{ $user->username }}'s account
        </button>
        <p class="text-sm font-bold text-red-500 text-center">
          Removals take 30 days to complete. If the user logs in during this time, the removal will be cancelled.
        </p>
      </form>
  </div>

  @endif
</x-admin-layout.header>
