<x-admin-layout.header>
  {!! $new_posts_chart->renderChartJsLibrary() !!}
  <div class="m-5 grid grid-cols-3 gap-4 p-4 dark:text-gray-200">
    <div class="col-span-1 rounded-xl bg-gray-200 dark:bg-gray-700 p-2">
      <h1 class="text-center text-2xl font-bold">New Posts</h1>
      {!! $new_posts_chart->renderHtml() !!}
      {!! $new_posts_chart->renderJs() !!}
    </div>
    <div class="col-span-1 rounded-xl bg-gray-200 dark:bg-gray-700 p-2">
      <h1 class="text-center text-2xl font-bold ">Bumped Posts</h1>
      {!! $bumped_post_chart->renderHtml() !!}
      {!! $bumped_post_chart->renderJs() !!}
    </div>
    <div class="col-span-1 rounded-xl bg-gray-200 dark:bg-gray-700 p-2">
      <h1 class="text-center text-2xl font-bold">New Users</h1>
      {!! $new_users_chart->renderHtml() !!}
      {!! $new_users_chart->renderJs() !!}
    </div>
  </div>
</x-admin-layout.header>
