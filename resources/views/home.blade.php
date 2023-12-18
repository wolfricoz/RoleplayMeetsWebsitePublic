<x-layout.header>
    <div id="app" class="grid grid-cols-3 m-6 gap-4" x-data="{'layout': 'list'}">
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
            <x-search :search="request('search')"/>
            @auth()
            <x-button href="{{ route('posts.create') }}">
                Create Post
            </x-button>
            @else
                <div>

                </div>
            @endauth()

        </div>
        @foreach($posts as $post)
            <x-post :post="$post"/>
        @endforeach


    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>

</x-layout.header>
