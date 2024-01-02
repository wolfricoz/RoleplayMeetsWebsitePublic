<x-layout.header>
    <div id="app" class="grid grid-cols-3 m-6 gap-4" x-data="{'layout': 'list'}">
        <x-postoptionsnav :genres="$genres">

        </x-postoptionsnav>

        @forelse($posts as $post)
            <x-post :post="$post">
            </x-post>
        @empty
                <div class="col-span-3">
                    <p class="col-span-1 lg:col-span-3 text-center text-2xl">No posts found, check back later</p>
                </div>
        @endforelse


    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>

</x-layout.header>
