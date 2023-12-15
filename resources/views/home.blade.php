<x-layout.header>
    <div id="app" class="grid grid-cols-3 m-6 gap-4" x-data="{'layout': 'list'}">
        <div class="flex h-12 col-span-3 bg-gray-200 rounded-full px-4 gap-4
        lg:justify-between lg:inline-flex">



            <div class="hidden lg:inline-flex">
                <div class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-bold py-1 px-2
            cursor-pointer">
                    Layout:
                </div>
                <div class=" m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
            hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer" x-on:click="layout = 'grid'"
                     x-bind:class="{'bg-indigo-400': layout === 'grid'}">
                    grid
                </div>
                <div class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
            hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer" x-on:click="layout = 'list'"
                     x-bind:class="{'bg-indigo-400': layout === 'list'}">
                    List
                </div>

            </div>
            <x-search :search="request('search')"/>
        </div>
        @foreach($posts as $post)
            <div class="w-full bg-gray-100 rounded-xl"
                 x-bind:class="{'col-span-1' : layout  === 'grid', 'col-span-3' : layout === 'list'}">
                <h1 class="p-2 h-10 text-lg text-center w-full border-b border-gray-200 overflow-hidden">
                    <a href="{{route('posts.show', $post->id)}}" class="hover:text-indigo-900" title="Go to post">
                        {{$post->title}}
                    </a>
                </h1>
                <div class="grid grid-cols-3 justify-between border-t border-gray-300">
                    <a href="" class="col-span-2 p-2 text-left">Created at: {{ $post->created_at->format("m/d/y H:i") }}
                        <br>{{ $post->updated_at }}</a>
                    <a href="#"
                       class="text-sm col-span-1 p-2 text-right hover:text-indigo-900">Genre: {{ $post->genre->name }}</a>
                </div>
                <show-more :post="{{ json_encode($post) }}">

                </show-more>
            </div>
        @endforeach


    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>

</x-layout.header>
