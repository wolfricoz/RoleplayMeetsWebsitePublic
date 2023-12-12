<x-layout.header>
    <div class="grid grid-cols-3 m-2 gap-4" x-data="{'layout': 'list'}">
        <div class="inline-flex col-span-3 bg-gray-200">
            <div class="">
                <x-search :search="request('search')" />
            </div>
{{--        Example of how to implement list/grid switching https://codepen.io/brbcoding-the-selector/pen/RwNjXaK --}}
            <div class="sm:hidden lg:inline-flex">
                <div class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
                    hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer" x-on:click="layout = 'grid'" x-bind:class="{'bg-indigo-300': layout === 'grid'}">
                    grid
                </div>
                <div class="m-2.5 mx-0.5 text-sm bg-transparent  text-gray-700 font-semibold hover:text-white py-1 px-2 border border-gray-500
                    hover:border-transparent hover:bg-indigo-900 rounded cursor-pointer" x-on:click="layout = 'list'" x-bind:class="{'bg-indigo-300': layout === 'list'}">
                    List
                </div>

            </div>

            <div>

            </div>
        </div>
        @foreach($posts as $post)
            <div class="w-full bg-gray-100 rounded-xl" x-bind:class="{'col-span-1' : layout  === 'grid', 'col-span-3' : layout === 'list'}">
                <h1 class="p-2 h-10 text-lg text-center w-full border-b border-gray-200 overflow-hidden"> <a href="{{route('posts.show', $post->id)}}">{{$post->title}}</a> </h1>
                <div class="grid grid-cols-3 justify-between border-t border-gray-300">
                    <a href="" class="col-span-1 p-2 text-left">Created at: {{ $post->created_at->format("m/d/y H:i") }}</a>
                    <a href="#"
                       class="text-sm col-span-2 p-2 text-right hover:text-indigo-900">Genre: {{ $post->genre->name }}</a>
                </div>
                <p class="p-2 h-32">
                    {{$post->content}}
                </p>
                <a href="{{route('posts.show', $post->id)}}" class="w-full text-center text-blue-500" >
                    <div class="p-2 w-full border-t border-gray-300 hover:bg-gray-200">

                        Read more


                    </div>
                </a>
            </div>
        @endforeach


    </div>
    <div class="mx-4 my-2">
        {{ $posts->links() }}
    </div>

</x-layout.header>
