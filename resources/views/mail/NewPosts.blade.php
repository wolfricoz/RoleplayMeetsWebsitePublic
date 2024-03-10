<x-mail.header>
  <div style="text-align: center;">
    <h1 style="text-align: center; border-bottom: black solid 1px;">A post has been submitted to the queue! There are now {{ $queueCount ?? 0 }} in the queue </h1>
    <div>
      <span style="font-size: 1.5em;">"{{ $post->title }}"</span>
      <p style="color: #777;">By {{ $post->user->username }}</p>
      <p style="font-size: 0.8em; text-align: center;">
        {!! clean($post->content) !!}
      </p>

      <a href="{{ route('admin.queue') }}" style="text-underline:  #9900FF; color:  #9900FF; margin-top: 1em;">Click here to go to the queue</a>
    </div>
  </div>
</x-mail.header>
