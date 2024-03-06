<x-layout.header>
  <div class="p-2 lg:p-6 space-y-2 min-h-full w-full"
    x-data="{ 'layout': 'list' }">
    <x-postoptionsnav :genres="$genres"></x-postoptionsnav>
    <div class="space-y-2 lg:space-y-0 lg:flex lg:flex-row-reverse gap-2">
      <x-profile_sidebar :user="$user"></x-profile_sidebar>
      <div
        id="app"
        class="grid grid-cols-2 gap-2  lg:gap-4"

      >


        @forelse ($posts as $post)
          <x-post :post="$post" />
        @empty
          <div class="col-span-2 w-full rounded-xl bg-gray-100 p-6 text-xl">
            <p class="text-center">No posts yet!</p>
          </div>
        @endforelse
      </div>

    </div>


  </div>
  <div class="mx-4 my-2">
    {{ $posts->links() }}
  </div>
</x-layout.header>
