@foreach($post->tags()->get() as $genre)
  <a class="bg-green-500 hover:bg-green-400 text-white text-xs text-center font-semibold py-0.5 my-1 px-2 rounded-xl flex items-center w-26` whitespace-nowrap"
     href="{{ route("home", ["search" => request("search"), "genre" => $genre->name]) }}">{{ $genre->name }}</a>
@endforeach
