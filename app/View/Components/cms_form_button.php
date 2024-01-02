<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class cms_form_button extends Component
{
    /**
     * Create a new component instance.
     */
    public $color;

    public function __construct($color = 'blue')
    {
        $this->color = $color;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout.cms_form_button');
    }
}
