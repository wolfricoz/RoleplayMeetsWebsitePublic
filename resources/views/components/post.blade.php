<div class="w-full bg-gray-100 rounded-xl"
     x-bind:class="{'col-span-1' : layout  === 'grid', 'col-span-3' : layout === 'list'}">
    <div class="p-2 h-10 text-lg text-center w-full border-b border-gray-200 overflow-hidden">
        <a href="{{route('posts.show', $post->id)}}" class="hover:text-indigo-900 text-center"
           title="Go to post">
            {{$post->title}}
        </a>
    </div>
    <div class="grid grid-cols-5 px-2 text-xs lg:text-sm border-b border-gray-200 text-center">
        <span class="grid-cols-1 text-left">{!!   $post->updated_at > $post->created_at ? "Updated: <br>{$post->updated_at->format('m/d/y H:i')}" : "Created:  <br>{$post->created_at->format('m/d/y H:i')}" !!}</span>
        <span class="grid-cols-1 ">character age: <br>{{ $post->charage }}+</span>
        <span class="grid-cols-1 ">Author: <br>{{ $post->user->global_name }}</span>
        <span class="grid-cols-1 ">partner Age: <br>{{ $post->partnerage}}+</span>
        <span class="grid-cols-1 text-right">Genre: <br>{{ $post->genre->name }}</span>
    </div>
    <show-more :post="{{ json_encode($post) }}">
        {!!
            clean($post->content)
        !!}
    </show-more>
</div>
