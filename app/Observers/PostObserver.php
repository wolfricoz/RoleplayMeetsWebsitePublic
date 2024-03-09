<?php

namespace App\Observers;

use App\Mail\NewPost;
use App\Mail\PostRejected;
use App\Mail\UpdatedPost;
use App\Models\Post;
use App\Support\AutoMod;
use Illuminate\Support\Facades\Mail;

class PostObserver
{

    private function check_banned_words($post): bool|array
    {
      $banned_words = AutoMod::check_for_words($post->content . $post->title, config('site_settings.banned_words'));
      if ($banned_words) {
        $banned_words = implode(count($banned_words) > 1 ? ", " : "" , $banned_words);
        Mail::to(auth()->user()->email)->send(new PostRejected("Your post contains banned words: $banned_words"));
        $post->delete();
        return true;
      }
      return false;
    }

    private function check_nsfw_words($post): void
    {
      $nsfw_words = AutoMod::check_for_words($post->content . $post->title, config('site_settings.nsfw_words'));
      if ($nsfw_words) {
        $post->nsfw = true;
        $post->save();
      }
    }
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        if ($this->check_banned_words($post)) {
          return;
        }
        $this->check_nsfw_words($post);
        mail::to('support@roleplaymeets.com')->send(new NewPost($post));
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
      if ($this->check_banned_words($post)) {
        return;
      }
      if ($post->nsfw === false){
        $this->check_nsfw_words($post);
      }
      mail::to('support@roleplaymeets.com')->send(new UpdatedPost($post));
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {

    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
