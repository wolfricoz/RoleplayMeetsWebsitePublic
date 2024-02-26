<div
  class="flex h-12 w-full items-center gap-4 lg:inline-flex lg:h-12 lg:rounded-full"
>
  <div
    class="flex h-full w-full flex-wrap items-center gap-4 rounded-xl bg-gray-200 dark:bg-gray-700"
  >
    <div class="hidden gap-1 lg:inline-flex">
      <div
        class="cursor-pointer bg-transparent px-2 py-1 text-sm font-bold text-gray-700"
      ></div>
      <x-button :layout="'grid'">
        <x-layout.SVG.grid-icon />
      </x-button>
      <x-button :layout="'list'">
        <x-layout.SVG.list-icon />
      </x-button>
    </div>

    <x-search :genres="$genres" />
  </div>

  @auth()
    @if (Auth::user()->hasPermissionTo("create_posts"))
      <x-post-button href="{{ route('posts.create') }}">
        Create new post
      </x-post-button>
    @else
      <x-post-button>No permission to create posts</x-post-button>
    @endif()
  @else
    <x-post-button href="{{ route('login') }}">
      Login to create posts
    </x-post-button>
  @endauth()
</div>
