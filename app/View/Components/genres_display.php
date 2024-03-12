<?php

namespace App\View\Components;

use App\Models\Post as PostAlias;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class genres_display extends Component
{
  /**
   * Create a new component instance.
   */

  public PostAlias $post;

  public function __construct($post)
  {
    $this->post = $post;
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.genres_display');
  }
}
