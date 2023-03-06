<?php

namespace App\Base;

class Validator
{
    public static function check($input,$array)
    {
        $error_message = array();
        foreach ($array as $key => $value) {
            if ($key === 'required') {
                
            }
        }
        return $error_message;
    }
}
