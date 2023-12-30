<aside class="flex flex-col justify-between w-48 h-full bg-gray-200">
    <div>
        <div class="m-4">
            <h1 class="w-full text-center text-xl font-semibold">Roleplay Meets</h1>
            <h6 class="w-full text-center text-sm font-semibold">CMS Panel</h6>
        </div>
        <x-admin-layout.cms_button href="{{ route('admin.dashboard') }}" :permission="auth()->user()->group->access_dashboard">
            Dashboard
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button href="{{ route('admin.queue') }}" :permission="auth()->user()->group->manage_posts">
            Mod Queue
        </x-admin-layout.cms_button >
        <x-admin-layout.cms_button href="{{ route('admin.posts')  }}" :permission="auth()->user()->group->manage_posts">
            Posts
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->group->manage_posts">
            Genres
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->group->manage_rules">
            Rules
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->group->manage_posts">
            Users
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->group->manage_posts">
            Groups
        </x-admin-layout.cms_button>
        <x-admin-layout.cms_button :permission="auth()->user()->group->manage_posts">
            Settings
        </x-admin-layout.cms_button>



    </div>
    <x-admin-layout.cms_button href="{{ route('home') }}" :permission="auth()->user()->group->access_dashboard">
        Back to Site
    </x-admin-layout.cms_button>
</aside>

<main class="w-full h-full max-w-full overflow-y-scroll ">
    {{ $slot }}
</main>
