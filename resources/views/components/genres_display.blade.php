@foreach ($post->tags()->get() as $genre)
  <a
    class="w-26` my-1 flex items-center whitespace-nowrap rounded-xl bg-green-500 px-2 py-0.5 text-center text-xs font-semibold text-white hover:bg-green-400"
    href="{{ route("home", ["search" => request("search"), "genre" => $genre->name]) }}"
  >
    {{ $genre->name }}
  </a>
@endforeach
