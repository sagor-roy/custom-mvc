<?php

namespace App\Controller;

use App\Base\Auth;
use App\Base\Hash;
use App\Base\Redirect;
use App\Base\Session;
use App\Base\Validator;
use App\Controller\Controller;
use App\Model\Customer;

class AuthController extends Controller
{
    private $customer;
    public $auth;

    public function __construct()
    {
        $this->auth = new Auth;
        $this->customer = new Customer;
    }

    public function index()
    {
        return views('auth/login');
    }

    public function register()
    {
        return views('auth/register');
    }

    public function login()
    {
        $validator =  new Validator($_POST, [
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            Redirect::back('/login');
        } else {
            $data = $_POST;

            $credential = [
                'email' => $data['email'],
                'password' => $data['password'],
            ];

            // if (Auth::check()) {
            //     echo 'yes';
            // } else {
            //     echo 'no';
            // }

            var_dump(Auth::user());


            //var_dump($this->auth->attempt('customer', $credential));

            // if ($this->auth->attempt('customer', $credential)) {
            //     var_dump(Auth::user());
            // } else {
            //     echo 'faild';
            // }
        }
    }

    public function store()
    {
        $validator =  new Validator($_POST, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            Redirect::back('/register');
        } else {
            $data = $_POST;
            $data['password'] = Hash::make($_POST['password']);
            $this->customer->create($data);
            Session::set('message', 'Data create successfull');
            Redirect::back('/register');
        }
    }
}
