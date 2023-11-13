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
        $this->middleware('auth');
        $this->user = new User;
    }

    public function index(): mixed
    {
        $result = $this
            ->user
            //->where('id', 10)
            ->get();
        return views('index', compact('result'));
    }

    public function store()
    {
        $validator = new Validator($_POST, [
            'name' => ['required'],
            'email' => ['required'],
        ]);

        if ($validator->fails()) {
            Redirect::back();
        } else {
            $this->user->create($_POST);
            Session::set('message', 'Data create successfull');
            Redirect::back();
        }
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        Session::set('message', 'Data delete successfull');
        Redirect::back();
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
        Redirect::to('/');
    }
}
