@php use function MongoDB\BSON\toJSON; @endphp
<div class="w-full bg-gray-100 rounded-xl"
     x-bind:class="{'col-span-1' : layout  === 'grid', 'col-span-3' : layout === 'list'}">
    <div class="p-2 h-10 text-lg text-center w-full border-b border-gray-200 overflow-hidden">
        <a href="{{route('posts.show', $post->id)}}" class="hover:text-indigo-900 text-center"
           title="Go to post">
            {{$post->title}}
        </a>
    </div>
    <div class="grid grid-cols-5 px-2 text-xs lg:text-sm border-b border-gray-200 text-center">
        <span
            class="grid-cols-1 text-left">
            {!!   $post->updated_at > $post->created_at ? "Updated: <br>{$post->updated_at->format('m/d/y H:i')}" : "Created:  <br>{$post->created_at->format('m/d/y H:i')}" !!}
        </span>
        <span class="grid-cols-1 ">
            character age: <br>{{ $post->charage }}+
        </span>
        <span class="grid-cols-1 ">Author: <br>
            <a class="hover:text-indigo-900 hover:underline" href="{{ route('users.show', $post->user_id) }}">{{ $post->user->global_name }}</a>
        </span>
        <span class="grid-cols-1 ">
            partner Age: <br>
            {{ $post->partnerage}}+
        </span>
        <span class="grid-cols-1 text-right">
            Genre: <br>
            <a class="hover:text-indigo-900 hover:underline" href="{{ route('home', ['search'=>request('search'), 'genre'=>$post->genre_id]) }}">{{ $post->genre->name }}</a>
        </span>
    </div>
    <show-more :post="{{ json_encode($post) }}">
        {!!
            clean($post->content)
        !!}
    </show-more>
    <div class="inline-flex gap-2 border-t border-gray-200 p-1">
        <p class="p-1">
            Admin Tools:
        </p>
        @if($post->approved)
            <form action="{{route('admin.approve', $post)}}" method="post">
                @csrf
                <button type="submit"
                        class="border border-yellow-600 p-1 text-sm rounded-xl
                                       hover:bg-yellow-600 dark:hover:text-white focus:bg-yellow-600 focus:text-white transition-all"
                        title="Disapprove the post and make it invisible to the public">
                    Disapprove
                </button>
            </form>
        @else
            <form action="{{route('admin.approve', $post)}}" method="post">
                @csrf
                <button type="submit"
                        class="border border-green-600 p-1 text-sm rounded-xl
                                       hover:bg-green-600 dark:hover:text-white focus:bg-green-600 focus:text-white transition-all"
                        title="Approve the post and make it visible to the public">
                    Approve
                </button>
            </form>
        @endif

        <form action="{{route('admin.delete', $post)}}" method="post">
            @method('delete')
            @csrf
            <button type="submit"
                    onclick="confirm('Are you sure you want to reject and delete this post?')"
                    class="border border-red-600 p-1 text-sm rounded-xl
                                       hover:bg-red-600 dark:hover:text-white focus:bg-red-600 focus:text-white transition-all"
                    title="Deny and remove the post from the database">
                Delete
            </button>
        </form>
        <nsfwtoggle :post="{{ $post }}">

        </nsfwtoggle>
    </div>
</div>
