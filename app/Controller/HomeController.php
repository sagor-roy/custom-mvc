<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\User;

class HomeController extends Controller
{

    public function index() : mixed
    {
        $data = new User();
        $result = $data->get();
        return views('index.php', compact('result'));
    }
}
