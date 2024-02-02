@if (Route::is(["admin.posts", "admin.queue"]))
  @if ($post->approved)
    <form action="{{ route("admin.approve", $post) }}" method="post">
      @csrf
      <x-admin-layout.cms_form_button
        name="disapprove"
        value="false"
        class="w-full border-red-700 text-left hover:bg-red-600"
        title="Disapprove the post and make it invisible to the public"
      >
        Disapprove
      </x-admin-layout.cms_form_button>
    </form>
  @else
    <form action="{{ route("admin.approve", $post) }}" method="post">
      @csrf
      <x-admin-layout.cms_form_button
        name="approve"
        value="true"
        class="w-full border-green-700 text-left hover:bg-green-600"
        title="Approve the post and make it visible to the public"
      >
        Approve
      </x-admin-layout.cms_form_button>
    </form>
  @endif
@endif
