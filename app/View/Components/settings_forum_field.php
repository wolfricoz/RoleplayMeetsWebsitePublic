<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class settings_forum_field extends Component
{
    /**
     * Create a new component instance.
     */

    public $toggle;
    public function __construct($toggle = false)
    {
        $this->toggle = $toggle;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.settings_forum_field');
    }
}
