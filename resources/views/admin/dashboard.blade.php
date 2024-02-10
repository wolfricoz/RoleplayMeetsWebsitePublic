<x-admin-layout.header>
  {!! $new_posts_chart->renderChartJsLibrary() !!}
  <div class="m-5 grid grid-cols-3 rounded-xl bg-gray-100 p-4 gap-4">
    <div class="col-span-1">
      <h1 class="text-center text-2xl font-bold text-gray-800">New Posts</h1>
      {!! $new_posts_chart->renderHtml() !!}
      {!! $new_posts_chart->renderJs() !!}
    </div>
    <div class="col-span-1">
      <h1 class="text-center text-2xl font-bold text-gray-800">Bumped Posts</h1>
      {!! $bumped_post_chart->renderHtml() !!}
      {!! $bumped_post_chart->renderJs() !!}
    </div>
    <div class="col-span-1">
      <h1 class="text-center text-2xl font-bold text-gray-800">New Users</h1>
      {!! $new_users_chart->renderHtml() !!}
      {!! $new_users_chart->renderJs() !!}
    </div>
  </div>
</x-admin-layout.header>
