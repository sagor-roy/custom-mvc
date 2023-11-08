<?php

use Jenssegers\Blade\Blade;

function views($path, $data = [])
{
    $blade = new Blade(ROOT_PATH . '/views', ROOT_PATH . '/storage');
    return $blade->make($path, $data)->render();
}

// function env($key)
// {
//     return $_ENV[$key];
// }

function asset($path)
{
    return BASEURL . '/assets/' . $path;
}
