<x-layout.header>
    <div id="app" class="grid grid-cols-3 m-6 gap-4" x-data="{'layout': 'list'}">
        <x-postoptionsnav :genres="$genres">

        </x-postoptionsnav>

        @foreach($posts as $post)
            <x-post :post="$post"/>
        @endforeach


    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>

</x-layout.header>
