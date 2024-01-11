<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class profile_item extends Component
{
    /**
     * Create a new component instance.
     */
    public $show;
    public $label;

    public function __construct($show, $label)
    {
        $this->show = $show;
        $this->label = $label;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout.profile_item');
    }
}
