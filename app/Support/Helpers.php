<?php

namespace App\Support;

use App\Models\User;

class Helpers
{

    public static function trim_extra_spaces($text): array|string|null
    {
        $text = preg_replace("/<div><br><\/div>|([\r\n]{4,}|[\n]{2,}|[\r]{2,})|(<br>){2,}/", "", $text);
        return preg_replace("/(<p><br><\/p>){2,}/", "<p><br></p>", $text);
    }

}
