<?php

namespace App\Controller;

use App\Base\Redirect;
use App\Base\Session;
use App\Base\Validator;
use App\Controller\Controller;
use App\Model\User;

class HomeController extends Controller
{
    private $user;
    public function __construct()
    {
        $this->user = new User;
    }

    public function index(): mixed
    {
        $result = $this->user->get('user');
        return views('index', compact('result'));
    }

    public function store()
    {
        // if (empty($_POST['name']) || empty($_POST['email'])) {
        //     Session::set('message', 'Input field is required');
        // } else {
        //     $this->user->create($_POST);
        //     Session::set('message', 'Data create successfull');
        // }
        // Redirect::back('/');

        $check =  Validator::check($_POST, [
            'name' => 'required',
            'email' => 'required'
        ]);

        var_dump($check);
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        Session::set('message', 'Data delete successfull');
        Redirect::back('/');
    }

    public function edit($id)
    {
        $result = $this->user->find($id);
        return views('view', compact('result'));
    }

    public function update()
    {
        $data = $_POST;
        $this->user->update($data['id'], $data);
        Session::set('message', 'Data update successfull');
        Redirect::back('/');
    }
}
