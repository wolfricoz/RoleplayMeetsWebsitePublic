<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cms_role_form extends Component
{
    /**
     * Create a new component instance.
     */

    public $role;
    public $permissions;
    public function __construct($permissions, $role = null)
    {
        $this->role = $role;
        $this->permissions = $permissions;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-layout.cms_role_form')->with([
            'role' => $this->role,
            'permissions' => $this->permissions,
        ])->with($this->attributes->all());
    }
}
