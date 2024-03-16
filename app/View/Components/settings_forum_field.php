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
    public string $description;
    public function __construct($description, $toggle = false)
    {
        $this->toggle = $toggle;
        $this->description = $description;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.settings_forum_field');
    }
}
