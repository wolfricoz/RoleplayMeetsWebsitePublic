<x-layout.header>
  <div id="app" class="min-h-full w-full inline-flex">
    <div

      class="m-6 grid grid-cols-3 gap-4 w-full"
      x-data="{ 'layout': 'list' }"
    >
      <x-postoptionsnav :genres="$genres"></x-postoptionsnav>

      @forelse ($posts as $post)
        <x-post :post="$post"></x-post>
      @empty
        <div class="col-span-1 lg:col-span-3 rounded-xl h-fit text-center text-xl p-6 ">
          <p class="" >
            No posts found, check back later!
          </p>
        </div>
      @endforelse
      @if($posts->count() > 0)
      <div class="col-span-1 lg:col-span-3 mx-20 my-2 bg-gray-100 rounded-xl p-3">
        {{ $posts->links() }}
      </div>
      @endif
    </div>
    @if(!\Illuminate\Support\Facades\Auth::check() || ! auth()->user()->hasPermissionTo("is_patron"))
    <div class="hidden lg:block w-48 m-2 bg-gray-100 rounded-xl">
      <Adsense
        data-ad-client="ca-pub-4605197206330320"
        data-ad-slot="6718590005">
      </Adsense>
    </div>
    @endif
  </div>



</x-layout.header>
