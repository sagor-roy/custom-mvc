<?php

function views($path, $data = [])
{
    extract($data);
    require_once VIEWS . '/views/' . $path . '.php';
}

function env($key)
{
    return $_ENV[$key];
}

function asset($path)
{
    return BASEURL . '/assets/' . $path;
}
