<div class="flex h-12 col-span-3 bg-gray-200 rounded-full px-4 gap-4
        lg:justify-between lg:inline-flex">


    <div class="hidden lg:inline-flex">
        <div class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-bold py-1 px-2
            cursor-pointer">
            Layout:
        </div>
        <x-button :layout="'grid'">
            Grid
        </x-button>
        <x-button :layout="'list'">
            List
        </x-button>

    </div>
    <x-search :genres="$genres"/>
    @auth()
        @if(Auth::user()->hasPermissionTo('create_posts'))
            <x-button href="{{ route('posts.create') }}">
                Create new post
            </x-button>
        @else
            <x-button>
                No permission to create posts
            </x-button>
        @endif()

    @else
        <x-button href="{{ route('login') }}">
            Login to create posts
        </x-button>
    @endauth()

</div>
