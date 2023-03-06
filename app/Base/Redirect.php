<?php

namespace App\Base;

class Redirect
{
    public static function back($path)
    {
        header("Location:{$path}");
    }
}
