<?php

namespace App\Formatters;

class StrToDate
{
    public static function format($item, $format = 'd.m.Y H:i'): string
    {
        $date = strtotime($item);
        return date($format, $date);
    }
}
