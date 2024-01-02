<x-admin-layout.header>
    <div id="app" class="flex flex-col gap-4 m-5 bg-gray-200 p-4 rounded-xl" x-data="{layout: 'list'}">
        @forelse($posts as $post)
            <x-post :post="$post"/>
        @empty
            <p class="text-center text-2xl">No posts found</p>
        @endforelse
        {{ $posts->links() }}
    </div>
</x-admin-layout.header>
