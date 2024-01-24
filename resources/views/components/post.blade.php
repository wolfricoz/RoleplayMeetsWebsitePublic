@php use Carbon\Carbon; @endphp
<div
  class="w-full rounded-xl bg-gray-100"
  x-bind:class="{
        'col-span-1': layout === 'grid',
        'col-span-3': layout === 'list'
    }"
>
  <div
    class="grid grid-cols-3 h-10 w-full overflow-hidden border-b border-gray-200 p-2"
  >
    <div class="col-span-1">
      @auth()
        @if($post->user_id === auth()->user()->id)
          @if ($post->bumped_at === null || Carbon::parse($post->bumped_at)->addDays(1) < now())
            <form
              action="{{ route("posts.bump", $post) }}"
              method="POST"
            >
              @method('PATCH')
              @csrf
              <button
                type="submit"
                class="rounded-xl border border-green-600 px-4 text-sm transition-all hover:bg-green-600 focus:bg-green-600 focus:text-white dark:hover:text-white"
                title="Bump the post to the top of the list"
                name="bump"
                value="true"
              >
                Bump
              </button>
            </form>
          @else
            <countdown :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"></countdown>
          @endif
        @endif
      @endauth

    </div>
    <div class="col-span-1 text-center">

      <a
        href="{{ route("posts.show", $post->id) }}"
        class="text-lg hover:text-indigo-900"
        title="Go to post"
      >
        {{ $post->title }}
      </a>
    </div>
    <div class="col-span-1">

    </div>


  </div>
  <div
    class="grid grid-cols-5 border-b border-gray-200 px-2 text-center text-xs lg:text-sm"
  >
        <span class="grid-cols-1 text-left">
            {!! $post->updated_at > $post->created_at ? "Updated: <br>{$post->updated_at->format("m/d/y H:i")}" : "Created:  <br>{$post->created_at->format("m/d/y H:i")}" !!}
        </span>
    <span class="grid-cols-1">
            character age:
            <br/>
            {{ $post->charage }}+
        </span>
    <span class="grid-cols-1">
            Author:
            <br/>
            <a
              class="hover:text-indigo-900 hover:underline"
              href="{{ route("users.show", $post->user_id) }}"
            >
                {{ $post->user->global_name }}
            </a>
        </span>
    <span class="grid-cols-1">
            partner Age:
            <br/>
            {{ $post->partnerage }}+
        </span>
    <span class="grid-cols-1 text-right">
            Genre:
            <br/>
            <a
              class="hover:text-indigo-900 hover:underline"
              href="{{ route("home", ["search" => request("search"), "genre" => $post->genre_id]) }}"
            >
                {{ $post->genre->name }}
            </a>
        </span>
  </div>
  <show-more :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}">
    {!! clean($post->content) !!}
  </show-more>
  @auth()
    @if (auth()->user()->hasPermissionTo("manage_posts"))
      <div
        class="inline-flex flex-wrap gap-2 border-t border-gray-200 p-1"
      >
        <p class="p-1">Admin Tools:</p>
        @if ($post->approved)
          <form
            action="{{ route("admin.approve", $post) }}"
            method="post"
          >
            @csrf
            <button
              type="submit"
              class="rounded-xl border border-yellow-600 p-1 text-sm transition-all hover:bg-yellow-600 focus:bg-yellow-600 focus:text-white dark:hover:text-white"
              title="Disapprove the post and make it invisible to the public"
            >
              Disapprove
            </button>
          </form>
        @else
          <form
            action="{{ route("admin.approve", $post) }}"
            method="post"
          >
            @csrf
            <button
              type="submit"
              class="rounded-xl border border-green-600 p-1 text-sm transition-all hover:bg-green-600 focus:bg-green-600 focus:text-white dark:hover:text-white"
              title="Approve the post and make it visible to the public"
            >
              Approve
            </button>
          </form>
        @endif

        <form
          action="{{ route("admin.delete", $post) }}"
          method="post"
        >
          @method("delete")
          @csrf
          <button
            type="submit"
            onclick="confirm('Are you sure you want to reject and delete this post?')"
            class="rounded-xl border border-red-600 p-1 text-sm transition-all hover:bg-red-600 focus:bg-red-600 focus:text-white dark:hover:text-white"
            title="Deny and remove the post from the database"
          >
            Delete
          </button>
        </form>
        <nsfwtoggle :post="{{ $post }}"></nsfwtoggle>
        <div>
          Status:
          {{ $post->approved ? "Approved" : "Awaiting Approval" }}
        </div>
      </div>
    @endif()
  @endauth()
</div>
