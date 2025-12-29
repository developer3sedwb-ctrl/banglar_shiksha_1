<?php

namespace App\Helpers;

class StringHelper
{
    public static function truncate($string, $length = 100, $append = '...')
    {
        if (strlen($string) <= $length) {
            return $string;
        }

        return substr($string, 0, $length - strlen($append)) . $append;
    }

    public static function containsAll($haystack, array $needles)
    {
        foreach ($needles as $needle) {
            if (!str_contains($haystack, $needle)) {
                return false;
            }
        }
        return true;
    }
}
