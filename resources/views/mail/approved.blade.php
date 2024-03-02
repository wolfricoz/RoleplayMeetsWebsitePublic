<x-mail.header>
  <div>
    <h1 class="text-xl text-black text-center">Your post has been approved!</h1>
    <p>Hi {{ $post->user->username }},</p>
    <article>
      Your post <span class="text-gray-700">"{{ $post->title }}"</span> has been approved by our staff. You can now view it on the site.

      Here's the link to your post: <a href="{{ route('posts.show', $post) }}">{{ route('posts.show', $post) }}</a>

      A big thank you for your contribution to our community!
    </article>
  </div>

</x-mail.header>

