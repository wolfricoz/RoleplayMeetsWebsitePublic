<x-layout.header>
    <div class="">
        <div
            id="app"
            class="m-2 mr-0 grid grid-cols-3 gap-2 lg:m-6 lg:grid-cols-4 lg:gap-4"
            x-data="{ 'layout': 'list' }"
        >
            <x-profile_sidebar :user="$user"></x-profile_sidebar>

            <x-postoptionsnav :genres="$genres"></x-postoptionsnav>

            @forelse ($posts as $post)
                <x-post :post="$post" />
            @empty
                <div
                    class="col-span-3 w-full rounded-xl bg-gray-100 p-6 text-xl"
                >
                    <p class="text-center">No posts yet!</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>
</x-layout.header>
