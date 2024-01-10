<?php

namespace App\Support;

class RemoveHtmlFromText
{
    public static function removeHtmlFromText($text)
    {
        return preg_replace('/<[^>]*>/', '', $text);
    }

}
