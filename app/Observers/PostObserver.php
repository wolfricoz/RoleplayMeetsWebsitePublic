<?php

namespace App\Observers;

use App\Mail\PostRejected;
use App\Models\Post;
use App\Support\AutoMod;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use JsonException;
use Spatie\Permission\Models\Role;

/**
 * @property array $admin_emails
 */
class PostObserver
{
  /**
   * Handle the Post "creating" event.
   */

  private string $banned_words;

  public function __construct()
  {
    $admin = Role::findByName('admin');
    $this->admin_emails = [];
    foreach ($admin->users as $user) {
      $this->admin_emails[] = $user->email;
    }
  }

  /**
   * @throws JsonException
   */
  private function send_message_discord(Post $post): void
  {
    $tag = optional($post->tags()->get()->first())->name ?? 'No tag';
    $webhook = config('site_settings.discord_webhook');
    $options = [
      'http' => [
        'header' => "Content-Type: application/json\r\n",
        'method' => 'POST',
        'content' => json_encode([
          'content' => "A new post has been detected!",
          'embeds' => [
            [
              'title' => $post->title,
              'description' => $post->content,
              'url' => route('admin.queue'),
              'color' => hexdec('FF0000'),
              'author' => [
                'name' => $post->user->username,
                'url' => route('users.show', $post->user),
                'icon_url' => $post->user->avatar,
              ],
              'footer' => [
                'text' => $tag,
              ],
            ],
          ],
        ], JSON_THROW_ON_ERROR),
      ],
    ];
    $context = stream_context_create($options);
    file_get_contents($webhook, false, $context);
  }

  private function auto_mod($post): void
  {
    if (optional(auth()->user())->hasPermissionTo('bypass_auto_mod')) {
      return;
    }
    if ($this->check_banned_words($post)) {
      Mail::to(auth()->user()->email)->send(new PostRejected("Your post contains banned words: $this->banned_words",
        $post));
      $post->delete();
      return;
    }
    if ($post->nsfw === 'sfw') {
      $this->check_nsfw_words($post);
    }
//    mail::to($this->admin_emails)->send(new UpdatedPost($post));
  }

  private function check_banned_words($post): bool|array|string
  {
    $banned_words = AutoMod::check_for_words($post->content . $post->title, config('site_settings.banned_words'));
    if ($banned_words) {
      $this->banned_words = implode(count($banned_words) > 1 ? ", " : "", $banned_words);
      return true;
    }
    return false;
  }

  private function check_nsfw_words($post): void
  {
    $nsfw_words = AutoMod::check_for_words($post->content . $post->title, config('site_settings.nsfw_words'));
    if ($nsfw_words) {
      $post->nsfw = 'nsfw';
      $post->save();
    }
    $extreme_words = AutoMod::check_for_words($post->content . $post->title, config('site_settings.extreme_words'));
    if ($extreme_words) {
      $post->nsfw = 'extreme';
      $post->save();
    }

  }

  /**
   * Handle the Post "created" event.
   */
  public function created(Post $post): void
  {
    $this->auto_mod($post);
    try {
      $this->send_message_discord($post);
    } catch (JsonException $e) {
      Log::error($e->getMessage());
    }
  }

  /**
   * Handle the Post "updated" event.
   */
  public function updated(Post $post): void
  {
    $this->auto_mod($post);
  }

  /**
   * Handle the Post "deleted" event.
   */
  public function deleted(Post $post): void {
    Log::info("Post soft-deleted: $post->title");
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
    Log::info("Post permanently deleted: $post->title");
  }
}
