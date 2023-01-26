<?php

function views($path, $data = [])
{
    extract($data);
    require_once VIEWS . '/views/' . $path;
}

function env($key)
{
    return $_ENV[$key];
}
