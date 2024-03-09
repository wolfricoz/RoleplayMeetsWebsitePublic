<x-mail.header>
  <div>
    <div class="text-center text-xl text-black">
      Your post has been returned to the queue
    </div>
    <p>Hi {{ $post->user->username }},</p>
    <div>
      Your post
      <span class="text-gray-700">"{{ $post->title }}"</span>
      has been returned to the queue by our staff. You can view it on the
      dashboard and, we will review it again and hopefully approve it soon. If
      the post breaks our rules, we will let you know with a denial email.
    </div>
  </div>
</x-mail.header>
