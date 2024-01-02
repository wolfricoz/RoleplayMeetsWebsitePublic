<?php

namespace App\View\Components;

use App\Models\genres;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class cms_sidebar extends Component
{
    /**
     * Create a new component instance.
     */

    public function __construct(genres $test )
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout.cms_sidebar');
    }
}
