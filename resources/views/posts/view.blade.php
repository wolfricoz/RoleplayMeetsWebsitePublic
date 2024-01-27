<x-layout.header>
  <div class="">
    <div
      id="app"
      class="m-2 mr-0 grid grid-cols-3 gap-2 lg:m-6 lg:grid-cols-4 lg:gap-4"
      x-data="{ 'layout': 'list' }"
    >
      <x-profile_sidebar :user="$user"></x-profile_sidebar>
      <div
        class="col-span-3 row-auto row-start-1 h-fit space-y-2 rounded-xl bg-gray-200 p-4"
      >
        <div class="rounded-b-xl border-b border-gray-300">
          <h1 class="text-center text-xl font-bold">{{ $post->title }}</h1>
        </div>
        <article class="">
          {!! clean($post->content) !!}
        </article>
        <div></div>
      </div>
    </div>
  </div>
</x-layout.header>
