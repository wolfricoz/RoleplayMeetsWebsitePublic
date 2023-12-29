<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class cms_button extends Component
{
    /**
     * Create a new component instance.
     */
    public $permission;
    public $display;

    public function __construct($permission, $display = null)
    {
        $this->permission = $permission;
        $this->display = $display;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout.cms_button');
    }
}
