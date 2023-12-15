<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class button extends Component
{
    /**
     * Create a new component instance.
     */
    public $layout;

    public function __construct($layout = null)
    {
        $this->layout = $layout;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
