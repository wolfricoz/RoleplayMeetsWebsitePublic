<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdatedPost extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public Post $post;
  public string $email_title;
  public string $title;
  public string $content;
  public string $footer;
  public User $user;
  public string $url;

  public function __construct($post)
  {
    $this->post = $post;
    $this->email_title = 'your post has been updated and submitted to the queue!';
    $this->title = $post->title;
    $this->content = $post->content;
    $this->user = $post->user;
    $this->url = route('users.show', $post->user);
    $this->footer = "Your post will be reviewed by our moderators, we strive to approve posts within 24 hours. You can view the status of your post below.";

  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'your post has been updated and submitted to the queue!',
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'mail.Transactional',
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
