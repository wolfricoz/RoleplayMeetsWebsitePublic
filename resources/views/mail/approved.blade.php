<x-mail.header>
  <div>
    <div class="text-center text-xl text-black">
      Your post has been approved!
    </div>
    <p>Hi {{ $post->user->username }},</p>
    <div>
      Your post
      <span class="text-gray-700">"{{ $post->title }}"</span>
      has been approved by our staff. You can now view it on the site. Here's
      the link to your post:
      <a href="{{ route("posts.show", $post) }}">
        {{ route("posts.show", $post) }}
      </a>

      A big thank you for your contribution to our community!
    </div>
  </div>
</x-mail.header>
