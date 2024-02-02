<?php

namespace App\View\Components;

use App\Models\Rules;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class rule extends Component
{
    /**
     * Create a new component instance.
     */
    public $rule;
    public $count;

    public function __construct($rule, $count)
    {
        $this->rule = $rule;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rule');
    }
}
