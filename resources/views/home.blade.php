<x-layout.header>
  <div
    id="app"
    class="min-h-full w-full space-y-2 p-2 lg:p-6"
    x-data="{ 'layout': 'list' }"
  >
    <x-postoptionsnav :genres="$genres"></x-postoptionsnav>
    {{-- <div class="inline-flex"> --}}
    <div class="grid w-full grid-cols-2 gap-2 transition-all">
      @forelse ($posts as $post)
        <x-post :post="$post"></x-post>
      @empty
        <div
          class="col-span-2 h-fit rounded-xl p-6 text-center text-xl dark:text-gray-200"
        >
          <p class="">No posts found, check back later!</p>
        </div>
      @endforelse
    </div>

    {{-- @if (! \Illuminate\Support\Facades\Auth::check() ||! auth()->user()->hasPermissionTo("is_patron")) --}}
    {{-- <div class="ml-3 hidden w-48 rounded-xl bg-gray-100 lg:block"> --}}
    {{-- <Adsense --}}
    {{-- data-ad-client="ca-pub-4605197206330320" --}}
    {{-- data-ad-slot="6718590005" --}}
    {{-- data-ad-format="auto" --}}
    {{-- data-full-width-responsive="yes" --}}
    {{-- ></Adsense> --}}
    {{-- </div> --}}
    {{-- @endif --}}
    {{-- </div> --}}
    @if ($posts->count() > 19)
      <div class="mx-20 my-2 rounded-xl bg-gray-100 p-3 dark:bg-gray-700">
        {{ $posts->links() }}
      </div>
    @endif
  </div>
</x-layout.header>
