<x-admin-layout.header>
    <div
        id="app"
        class="m-5 flex flex-col gap-4 rounded-xl bg-gray-200 p-4"
        x-data="{ layout: 'list' }"
    >
        @foreach ($posts as $post)
            <x-post :post="$post" />
        @endforeach

        {{ $posts->links() }}
    </div>
</x-admin-layout.header>
