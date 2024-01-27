<x-layout.header>
  <div
    id="app"
    class="m-6 grid grid-cols-3 gap-4"
    x-data="{ 'layout': 'list' }"
  >
    <div
      class="col-span-3 flex h-12 gap-4 rounded-full bg-gray-200 px-4 lg:inline-flex lg:justify-between"
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
        <x-button href="{{ route('posts.create') }}">Create Post</x-button>
      @else
        <div></div>
      @endauth()
    </div>
    @foreach ($posts as $post)
      <x-post :post="$post" />
    @endforeach
  </div>
  <div class="mx-4 my-2">
    {{ $posts->links() }}
  </div>
</x-layout.header>
