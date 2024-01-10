<aside class="flex flex-col justify-between w-48 h-full bg-gray-200">

    <div>
        <div class="m-4">
            <h1 class="w-full text-center text-xl font-semibold">Roleplay Meets</h1>
            <h6 class="w-full text-center text-sm font-semibold">CMS Panel</h6>
        </div>
        <div class="border-b border-gray-300 w-full text-xs text-center">
            User Management
        </div>
        <x-admin-layout.cms_button href="{{ route('admin.dashboard') }}"
                                   :permission="auth()->user()->hasPermissionTo('access_dashboard')">
            Dashboard
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button href="{{ route('admin.queue') }}" :permission="auth()->user()->hasPermissionTo('manage_posts')"
                                   :display="$queueCount">
            Mod Queue
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button href="{{ route('admin.posts')  }}" :permission="auth()->user()->hasPermissionTo('manage_posts')"
                                   :display="$postsCount">
            Posts
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->hasPermissionTo('manage_genres')" :display="$genresCount">
            Genres
        </x-admin-layout.cms_button>

        <x-admin-layout.cms_button  href="{{ route('admin.users') }}" :permission="auth()->user()->hasPermissionTo('manage_users')" :display="$usersCount">
            Users
        </x-admin-layout.cms_button>

        <div class="border-b border-gray-300 w-full text-xs text-center">
            Site Management
        </div>
        <x-admin-layout.cms_button href="{{ route('admin.groups') }}" :permission="auth()->user()->hasPermissionTo('manage_groups')">
            Groups
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->hasPermissionTo('manage_rules')">
            Rules
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->hasPermissionTo('manage_settings')">
            Settings
        </x-admin-layout.cms_button>


    </div>
    <x-admin-layout.cms_button href="{{ route('home') }}" :permission="auth()->user()->hasPermissionTo('access_dashboard')">
        Back to Site
    </x-admin-layout.cms_button>
</aside>

<main class="w-full h-full max-w-full overflow-y-scroll ">
    {{ $slot }}
</main>
