<aside
  class="flex h-full flex-col justify-between bg-gray-200 shadow-2xl transition-all dark:bg-zinc-800 dark:text-gray-200"
  :class="{'w-12': !open, 'w-48 items-center': open}"
>
  <div>
    <div class="" :class="{'hidden': !open, 'w-48': open}">
      <h1 class="w-full text-center text-xl font-semibold">Roleplay Meets</h1>
      <h6 class="w-full text-center text-sm font-semibold">CMS Panel</h6>
    </div>

    <x-admin-layout.cms_button
      href="{{ route('admin.dashboard') }}"
      :permission="auth()->user()->hasPermissionTo('access_dashboard')"
    >
      <x-slot name="icon">
        <x-layout.SVG.home-icon/>
      </x-slot>

      Dashboard
    </x-admin-layout.cms_button>
{{--    Post Management --}}
    <div
      class="w-full border-b border-gray-300 text-center text-xs"
      :class="{'hidden': !open, 'w-48': open}"
    >
      Post Management
    </div>
    <x-admin-layout.cms_button
      href="{{ route('admin.queue') }}"
      :permission="auth()->user()->hasPermissionTo('manage_posts')"
      :display="$queueCount"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.queue/>
      </x-slot>
      Mod Queue
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.posts')  }}"
      :permission="auth()->user()->hasPermissionTo('manage_posts')"
      :display="$postsCount"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.posts/>
      </x-slot>
      Posts
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.genres') }}"
      :permission="auth()->user()->hasPermissionTo('manage_genres')"
      :display="count($genres)"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.categories/>
      </x-slot>
      Categories
    </x-admin-layout.cms_button>

{{--    User Management --}}

    <div
      class="w-full border-b border-gray-300 text-center text-xs"
      :class="{'hidden': !open, 'w-48': open}"
    >
      User Management
    </div>




    <x-admin-layout.cms_button
      href="{{ route('admin.users') }}"
      :permission="auth()->user()->hasPermissionTo('manage_users')"
      :display="$usersCount"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.users/>
      </x-slot>
      Users
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.bans.view') }}"
      :permission="auth()->user()->hasPermissionTo('ban_users')"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.bans/>
      </x-slot>
      Bans
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.groups') }}"
      :permission="auth()->user()->hasPermissionTo('manage_groups')"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.groups/>
      </x-slot>
      Groups
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.reports') }}"
      :permission="auth()->user()->hasPermissionTo('manage_roles')"
      :display="$reportsCount"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.reports/>
      </x-slot>
      Reports
    </x-admin-layout.cms_button>

    <div
      class="w-full border-b border-gray-300 text-center text-xs"
      :class="{'hidden': !open, 'w-48': open}"
    >
      Site Management
    </div>

    <x-admin-layout.cms_button
      href="{{ route('admin.rules') }}"
      :permission="auth()->user()->hasPermissionTo('manage_rules')"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.rules/>
      </x-slot>
      Rules
    </x-admin-layout.cms_button>
    <x-admin-layout.cms_button
      href="{{ route('admin.settings') }}"
      :permission="auth()->user()->hasPermissionTo('manage_settings')"
    >
      <x-slot name="icon">
        <x-admin-layout.SVG.settings/>
      </x-slot>
      Settings
    </x-admin-layout.cms_button>
    <a class="transition-all hover:cursor-pointer">
      <x-layout.SVG.sidebar-icon/>
    </a>
  </div>
  <x-admin-layout.cms_button
    href="{{ route('home') }}"
    :permission="auth()->user()->hasPermissionTo('access_dashboard')"
  >
    <x-slot name="icon">
      <x-layout.SVG.return/>
    </x-slot>
    Back to Site
  </x-admin-layout.cms_button>
</aside>

<main class="h-full w-full max-w-full overflow-y-scroll">
  {{ $slot }}
</main>
