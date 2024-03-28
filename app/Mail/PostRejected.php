<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostRejected extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */

  public string $reason;
  public Post $post;
  public string $email_title;
  public string $title;
  public string $content;
  public string $footer;
  public User $user;
  public string $url;

  public function __construct($reason, $post)
  {
    $this->reason = $reason;
    $this->post = $post;
    $this->email_title = 'Your post has been rejected!';
    $this->title = $post->title;
    $this->content = $post->content;
    $this->user = $post->user;

  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      subject: 'Post Denied',
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
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
