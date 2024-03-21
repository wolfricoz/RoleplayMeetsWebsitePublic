<x-admin-layout.header>
  <div id="app" class="flex flex-col gap-4 p-4 dark:text-gray-200" x-data="{ layout: 'list' }">
    @forelse ($posts as $post)
      <x-post :post="$post" />
    @empty
      <h1 class="text-center text-2xl font-bold">All posts are approved!</h1>
      <h6 class="text-center">Check back later!</h6>
    @endforelse

    {{ $posts->links() }}
  </div>
</x-admin-layout.header>
