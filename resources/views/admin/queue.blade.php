<x-admin-layout.header>
    <div id="app" class="flex flex-col gap-4 m-5 bg-gray-200 p-4 rounded-xl" x-data="{layout: 'list'}">
        @foreach($posts as $post)
            <x-post :post="$post"/>

        @endforeach
        {{ $posts->links() }}
    </div>
</x-admin-layout.header>
