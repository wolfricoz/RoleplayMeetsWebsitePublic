<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class search extends Component
{
    /**
     * Create a new component instance.
     */

    public $genres;
    public function __construct($genres)
    {
        $this->genres = $genres;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search');
    }
}
