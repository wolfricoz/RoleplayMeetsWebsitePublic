<?php

namespace App\Support;

use App\Models\User;

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

    public static function trim_extra_spaces($text): array|string|null
    {
        return preg_replace("/<p><br><\/p>|<div><br><\/div>|([\r\n]{4,}|[\n]{2,}|[\r]{2,})/", "", $text);
    }
}
