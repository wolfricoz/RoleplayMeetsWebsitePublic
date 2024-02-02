<aside class="flex h-full w-48 flex-col justify-between bg-gray-200">
  <div>
    <div class="m-4">
      <h1 class="w-full text-center text-xl font-semibold">Roleplay Meets</h1>
      <h6 class="w-full text-center text-sm font-semibold">CMS Panel</h6>
    </div>
    <div class="w-full border-b border-gray-300 text-center text-xs">
      User Management
    </div>
    <x-admin-layout.cms_button
      href="{{ route('admin.dashboard') }}"
      :permission="auth()->user()->hasPermissionTo('access_dashboard')"
    >
      Dashboard
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.queue') }}"
      :permission="auth()->user()->hasPermissionTo('manage_posts')"
      :display="$queueCount"
    >
      Mod Queue
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.posts')  }}"
      :permission="auth()->user()->hasPermissionTo('manage_posts')"
      :display="$postsCount"
    >
      Posts
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      :permission="auth()->user()->hasPermissionTo('manage_genres')"
      :display="count($genres)"
    >
      Genres [Todo]
    </x-admin-layout.cms_button>

    <x-admin-layout.cms_button
      href="{{ route('admin.users') }}"
      :permission="auth()->user()->hasPermissionTo('manage_users')"
      :display="$usersCount"
    >
      Users
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.bans.view') }}"
      :permission="auth()->user()->hasPermissionTo('ban_users')"
    >
      Bans
    </x-admin-layout.cms_button>

    <div class="w-full border-b border-gray-300 text-center text-xs">
      Site Management
    </div>
    <x-admin-layout.cms_button
      href="{{ route('admin.groups') }}"
      :permission="auth()->user()->hasPermissionTo('manage_groups')"
    >
      Groups
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.rules') }}"
      :permission="auth()->user()->hasPermissionTo('manage_rules')"
    >
      Rules
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      :permission="auth()->user()->hasPermissionTo('manage_settings')"
    >
      Settings [Todo]
    </x-admin-layout.cms_button>
  </div>
  <x-admin-layout.cms_button
    href="{{ route('home') }}"
    :permission="auth()->user()->hasPermissionTo('access_dashboard')"
  >
    Back to Site
  </x-admin-layout.cms_button>
</aside>

<main class="h-full w-full max-w-full overflow-y-scroll">
  {{ $slot }}
</main>
