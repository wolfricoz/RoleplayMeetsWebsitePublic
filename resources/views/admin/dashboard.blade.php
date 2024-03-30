<x-admin-layout.header>
  {!! $new_posts_chart->renderChartJsLibrary() !!}
  <div class="grid grid-cols-1 gap-4 p-4 lg:grid-cols-3 dark:text-gray-200">
    <div class="col-span-1 rounded-xl bg-gray-200 p-6 dark:bg-gray-700">
      <h1 class="text-center text-2xl font-bold ">Site Stats</h1>
      <article>
        <p class="text-center">
          Hi <strong>{{ auth()->user()->username }}</strong>, welcome to the dashboard.
        </p>


        <img
          class="mx-2 mt-2 h-8 w-8 rounded-full border border-gray-200 object-cover"
          src="{{ Auth::user()->getAvatar(["extension" => "webp", "size" => 32]) }}"
          alt="{{ Auth::user()->getTagAttribute() }}"
        />
        <p>
        date: {{ now()->format('d/m/y H:i') }}
        </p>
        <p>
        Total Users: {{ $usersCount }}
        </p>
        <p>
        Total Posts: {{ $postsCount }}
        </p>
        <p>
        posts waiting for approval: {{ $queueCount }}
        </p>
        <p>
        Reported Posts: {{ $reportsCount }}
        </p>
        <p>
        Total categories: {{ count($genres) }}
        </p>


      </article>
    </div>

    <div class="col-span-1 rounded-xl bg-gray-200 p-2 dark:bg-gray-700">
      <h1 class="text-center text-2xl font-bold">New Posts</h1>
      <div>
        {!! $new_posts_chart->renderHtml() !!}
        {!! $new_posts_chart->renderJs() !!}
      </div>
    </div>
    <div class="col-span-1 rounded-xl bg-gray-200 p-2 dark:bg-gray-700">
      <h1 class="text-center text-2xl font-bold">Bumped Posts</h1>
      {!! $bumped_post_chart->renderChartJsLibrary() !!}
      {!! $bumped_post_chart->renderHtml() !!}
      {!! $bumped_post_chart->renderJs() !!}
    </div>
    <div class="col-span-1 rounded-xl bg-gray-200 p-2 dark:bg-gray-700">
      <h1 class="text-center text-2xl font-bold">New Users</h1>
      {!! $new_users_chart->renderChartJsLibrary() !!}
      {!! $new_users_chart->renderHtml() !!}
      {!! $new_users_chart->renderJs() !!}
    </div>
  </div>
</x-admin-layout.header>
