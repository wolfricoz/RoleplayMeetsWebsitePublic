<x-layout.header>
{{--  Make this a component, maybe make the component controller grab the genres  --}}
    <div id="app" class="grid grid-cols-3 m-6 gap-4" x-data="{'layout': 'list'}">
        <div class="flex h-12 col-span-3 bg-gray-200 rounded-full px-2 gap-4
        lg:justify-center lg:inline-flex">
            <h1 class="m-2 text-2xl font-bold text-center">{{ $user->global_name }}'s Profile</h1>
        </div>
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
