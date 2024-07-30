<?php

namespace App\Helpers;

class Helper
{
    public static function dateSlashToDash($date)
    {
        return strpos($date, '/') > 0 ?

            implode('-',array_reverse(explode('/', $date))):

            $date;
    }

    public static function find($model, $array)
    {
        return $model::where($array['column'], $array['value'])->first();
    }
}