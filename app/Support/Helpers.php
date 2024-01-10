<?php

namespace App\Support;

use App\Models\User;
use Spatie\Permission\Models\Role;

class Helpers
{
    public static function get_highest_role(User $user)
    {
        $roles = $user->roles()->get();
        $highest_role = null;
        foreach ($roles as $role) {
            if ($highest_role === null) {
                $highest_role = $role;
                continue;
            }
            if (count($role->permissions) > count($highest_role->permissions)) {
                $highest_role = $role;
                continue;
            }
            if ((count($role->permissions) === count($highest_role->permissions)) && $role->id < $highest_role->id) {
                $highest_role = $role;
            }
        }
        return $highest_role;
    }
}
