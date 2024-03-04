<x-admin-layout.header>
  <div id="app" class="m-5 dark:text-gray-200 p-4">
    <div class="grid grid-cols-3 gap-4 border-b border-gray-300">
      <div class="col-span-1 p-2"></div>
      <div class="col-span-1 text-center">
        <h1 class="text-xl font-bold">Settings</h1>
        <h6 class="text-sm">
          Manage the settings for the website, be careful with the changes as
          they affect the entire website.
        </h6>
      </div>
      <div class="col-span-1"></div>
    </div>
    <div class="flex flex-col lg:col-span-4">
      <form
        action="{{ route("admin.settings.update") }}"
        method="POST"
        class="space-y-2"
      >
        @csrf
        @method("PATCH")

        <div>
          <label for="site_name">
            Site Name
            <p class="text-xs">This is the name of the website.</p>
          </label>
          <input
            id="site_name"
            name="site_name"
            type="text"
            class="w-64 rounded-xl dark:bg-gray-600 "
            value="{{ $settings->get("site_name") }}"
            maxlength="32"
          />
        </div>
        <div>
          <label for="site_slogan">
            Site Slogan
            <p class="text-xs">
              This is the slogan that appears in the top left of the website.
            </p>
          </label>
          <input
            id="site_slogan"
            name="site_slogan"
            type="text"
            class="w-64 rounded-xl dark:bg-gray-600 "
            value="{{ $settings->get("site_slogan") }}"
            maxlength="32"
          />
        </div>
        <div>
          <label for="discord_invite">
            Discord Invite
            <p class="text-xs">
              This is the invite link for the discord server.
            </p>
          </label>
          <input
            id="discord_invite"
            name="discord_invite"
            type="text"
            class="w-64 rounded-xl dark:bg-gray-600 "
            value="{{ $settings->get("discord_invite") }}"
          />
        </div>
        <div>
          <label for="support_email">
            Support Email
            <p class="text-xs">
              This is the email that users can contact for support.
            </p>
          </label>
          <input
            id="support_email"
            name="support_email"
            type="text"
            class="w-64 rounded-xl dark:bg-gray-600 "
            value="{{ $settings->get("support_email") }}"
          />
        </div>
        <div>
          <label for="admin_role">
            Admin Role
            <p class="text-xs">
              This role is the default admin role for the website, it will have
              all the permissions.
            </p>
          </label>
          <select
            name="admin_role"
            id="admin_role"
            class="w-64 rounded-xl dark:bg-gray-600 "
          >
            @foreach ($roles as $role)
              <option
                value="{{ $role->name }}"
                {{ $role->name === $settings->get("admin_role") ? "selected" : "" }}
              >
                {{ $role->name }}
              </option>
            @endforeach
          </select>
        </div>
        <x-admin-layout.cms_form_button
          onclick="return confirm('Are you sure you want to update the settings?')"
        >
          Submit
        </x-admin-layout.cms_form_button>
      </form>
    </div>
  </div>
</x-admin-layout.header>
