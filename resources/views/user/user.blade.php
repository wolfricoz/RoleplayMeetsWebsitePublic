<x-layout.header>
    {{-- Make this a component, maybe make the component controller grab the genres --}}
    <div
        id="app"
        class="m-6 grid grid-cols-3 gap-4"
        x-data="{ 'layout': 'list' }"
    >
        <div
            class="col-span-3 flex h-12 gap-4 rounded-full bg-gray-200 px-2 lg:inline-flex lg:justify-center"
        >
            <h1 class="m-2 text-center text-2xl font-bold">
                {{ $user->global_name }}'s Profile
            </h1>
        </div>
        <x-postoptionsnav :genres="$genres"></x-postoptionsnav>
        @foreach ($posts as $post)
            <x-post :post="$post" />
        @endforeach
    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>
</x-layout.header>
