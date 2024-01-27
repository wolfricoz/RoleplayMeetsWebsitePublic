<div
  class="col-span-3 flex flex-wrap gap-4 rounded-xl bg-gray-200 px-4 lg:inline-flex lg:h-12 lg:justify-between lg:rounded-full"
>
  <div class="hidden lg:inline-flex">
    <div
      class="m-2.5 mx-0.5 cursor-pointer bg-transparent px-2 py-1 text-sm font-bold text-gray-700"
    >
      Layout:
    </div>
    <x-button :layout="'grid'">Grid</x-button>
    <x-button :layout="'list'">List</x-button>
  </div>

  <x-search :genres="$genres" />
  @auth()
    @if (Auth::user()->hasPermissionTo("create_posts"))
      <x-button href="{{ route('posts.create') }}">Create new post</x-button>
    @else
      <x-button>No permission to create posts</x-button>
    @endif()
  @else
    <x-button href="{{ route('login') }}">Login to create posts</x-button>
  @endauth()
</div>
