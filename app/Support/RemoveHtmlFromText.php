<?php

namespace App\Support;

class RemoveHtmlFromText
{
    public static function removeHtmlFromText($text)
    {
        $text = preg_replace('/[\r\n]+/', '', $text);
        return preg_replace('/<[^>]*>/', '', $text);
    }

}
