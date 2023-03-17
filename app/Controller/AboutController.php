<?php

namespace App\Controller;

use App\Controller\Controller;


class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return views('about');
    }
}
