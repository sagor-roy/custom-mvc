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
        $this->middleware('guest');
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
            if (Auth::attempt('customer', $credential)) {
                Redirect::back('/');
            } else {
                Session::set('message', 'credential does not match');
                Redirect::back('/login');
            }
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

    public function logout()
    {
        Auth::logout();
        Redirect::back('/login');
    }
}
