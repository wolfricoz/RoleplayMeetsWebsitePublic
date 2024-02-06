<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * @property $approved
 * @property $nsfw
 */
class post extends Component
{
  /**
   * Create a new component instance.
   */
  public \App\Models\Post $post;

  public function __construct($post)
  {
    $this->post = $post;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.post');
  }
}
