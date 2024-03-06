@php
  use Carbon\Carbon;
@endphp

<div
  class="w-full rounded-xl bg-gray-100 text-stone-800 dark:text-gray-200 dark:bg-gray-700 p-2"
  x-bind:class="{
    'col-span-1': layout === 'grid',
    'col-span-2': layout === 'list'
  }"
>
  <div class="flex flex-row justify-end items-center flex-wrap lg:flex-nowrap">
     <div class="flex lg:justify-end">
     <x-layout.SVG.check-icon :post="$post"/>
     </div>
     <div class="inline-flex ">
     @auth()
     <dropdown :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}">
     @if ($post->user_id === auth()->user()->id)
     <x-post_dropdown_button>
     @if ($post->bumped_at === null || Carbon::parse($post->bumped_at)->addMinutes(1440) <= Carbon::now())
     <form action="{{ route("posts.bump", $post) }}" method="POST">
     @method("PATCH")
     @csrf
     <button
     type="submit"
     title="Bump the post to the top of the list"
     name="bump"
     value="true"
     >
     Bump
     </button>
     </form>
     @else
     <countdown
     v-bind:post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"
     ></countdown>
     @endif
     </x-post_dropdown_button>

     <x-post_dropdown_button href="{{ route('posts.edit', $post) }}">
     Edit
     </x-post_dropdown_button>
     @endif

     @if (auth()->user()->hasPermissionTo("manage_posts"))
     <span class="border-b border-gray-200 text-center text-xs">
     Admin Controls
     </span>
     <x-post_dropdown_button>
     @if ($post->approved)
     <form
     action="{{ route("admin.approve", $post) }}"
     method="post"
     >
     @csrf
     <button
     type="submit"
     class="w-full text-left text-red-500"
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
     class="w-full text-left text-red-500"
     title="Approve the post and make it visible to the public"
     >
     Approve
     </button>
     </form>
     @endif
     </x-post_dropdown_button>

     <x-post_dropdown_button>
     <nsfwtoggle v-bind:post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}"></nsfwtoggle>
     </x-post_dropdown_button>
     @endif

     <x-post_dropdown_button>
     @if (auth()->user()->hasPermissionTo("manage_posts") ||($post->user_id === auth()->user()->id &&auth()->user()->hasPermissionTo("delete_posts")))
     <form action="{{ route("admin.delete", $post) }}" method="post">
     @method("delete")
     @csrf
     <button
     type="submit"
     onclick="confirm('Are you sure you want to reject and delete this post?')"
     class="w-full text-left text-red-500"
     title="Delete the post"
     >
     Delete
     </button>
     </form>
     @endif
     </x-post_dropdown_button>
     </dropdown>
     <x-admin-layout.cms_approve_button :post="$post"/>
     @endauth
     </div>

  </div>
  <div
    class="lg:flex w-full items-center flex-row justify-between overflow-hidden border-gray-200 p-2 text-center lg:text-left lg:p-6"
  >
    <a
      href="{{ route("posts.show", $post) }}"
      class="text-lg hover:text-indigo-900 dark:hover:text-blue-400 lg:text-2xl font-bold "
      title="Go to post"
    >
      {{ $post->title }}
    </a>

    <div class="flex flex-row divide-x px-2 text-center text-xs lg:text-sm items-center justify-center lg:justify-normal">
      <span class="inline-flex gap-2 px-2 lg:px-6">
          <img
            class="h-10 w-10 rounded-full border border-gray-200 object-cover"
            src="{{ $post->user->getAvatar(["extension" => "webp", "size" => 512]) }}"
            alt="{{ $post->user->getTagAttribute() }}"
            x-bind:class="{
              'hidden': layout === 'grid' || document.documentElement.clientWidth < 1024
            }"
          />
        <span>
        <p>Author:</p>
        <a
          class="hover:text-indigo-900 dark:hover:text-blue-400 hover:underline"
          href="{{ route("users.show", $post->user_id) }}"
        >
          {{ $post->user->global_name }}
        </a>
        </span>
      </span>
      <span class="px-2 lg:px-6 ">
        Genre:
        <br />
        <a
          class="hover:text-indigo-900 dark:hover:text-blue-400 hover:underline"
          href="{{ route("home", ["search" => request("search"), "genre" => $post->genre_id]) }}"
        >
          {{ $post->genre->name ?? "None" }}
        </a>
      </span>
      <span
        class="px-2 lg:px-6"
        title="{{ $post->bumped_at > $post->created_at ? Carbon::parse($post->bumped_at)->format("m/d/y H:i") : $post->created_at->format("m/d/y H:i") }}"
      >
        {!! $post->bumped_at > $post->created_at ? "Bumped: <br>" . Carbon::parse($post->bumped_at)->diffForHumans() : "Created: <br>{$post->created_at->format("m/d/y H:i")}" !!}
      </span>
      <span class="px-2 lg:px-6"
            x-bind:class="{
              'hidden': layout === 'grid'  || document.documentElement.clientWidth < 1024
            }">
        character age:
        <br />
        {{ $post->charage }}+
      </span>

      <span class="px-2 lg:px-6"
            x-bind:class="{
              'hidden': layout === 'grid' || document.documentElement.clientWidth < 1024
            }">
        partner Age:
        <br />
        {{ $post->partnerage }}+
      </span>

    </div>
  </div>

  <show-more :post="{{ json_encode($post, JSON_THROW_ON_ERROR) }}">
    {!! clean($post->content) !!}
  </show-more>
</div>

