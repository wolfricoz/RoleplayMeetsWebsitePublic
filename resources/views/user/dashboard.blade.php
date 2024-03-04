<x-layout.header>
  <div class="p-2 lg:p-6 space-y-2 min-h-full w-full"
       x-data="{ 'layout': 'list' }"
  >
    <x-postoptionsnav :genres="$genres"></x-postoptionsnav>
    <div class="inline-flex gap-2">
      <div
        id="app"
        class="grid grid-cols-2 gap-2 lg:grid-cols-2 "

      >

        <div
          class="col-span-2 h-fit gap-4 rounded-xl dark:bg-gray-700 dark:text-gray-200 bg-gray-200 p-2 lg:col-span-2 lg:justify-center"
        >
          <h1 class="m-2 text-center text-2xl font-bold">Dashboard</h1>
          <div class="flex flex-row justify-center gap-4">
            <div class="flex flex-row flex-wrap justify-center gap-4">
              <article class="rounded-xl border border-gray-300 p-2">
                <h6>Total Posts:</h6>
                <p class="text-center">
                  {{ count($user->posts) }}
                </p>
              </article>
              <article class="rounded-xl border border-gray-300 p-2">
                <h6>Approved Posts:</h6>
                <p class="text-center">
                  {{ count($user->posts->where("approved", "=", true)) }}
                </p>
              </article>
              <article class="rounded-xl border border-gray-300 p-2">
                <h6>Pending Posts:</h6>
                <p class="text-center">
                  {{ count($user->posts->where("approved", "=", false)) }}
                </p>
              </article>
            </div>
          </div>
        </div>




        @forelse ($posts as $post)
          <x-post :post="$post" />
        @empty
          <div class="col-span-2 w-full rounded-xl bg-gray-100 p-6 text-xl">
            <p class="text-center">No posts yet!</p>
          </div>
        @endforelse
      </div>
      <x-profile_sidebar :user="$user"></x-profile_sidebar>
    </div>

  </div>

  <div class="mx-4 my-2">
    {{ $posts->links() }}
  </div>
</x-layout.header>
