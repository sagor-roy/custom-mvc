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

        if (!$validator->fails()) {
            if (Auth::attempt('customer', $_POST)) {
                Redirect::go('/');
            } else {
                Session::set('message', 'credential does not match');
                Redirect::back();
            }
        }
        Redirect::back();
    }

    public function store()
    {
        $validator =  new Validator($_POST, [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            Redirect::back();
        } else {
            $data = $_POST;
            $data['password'] = Hash::make($_POST['password']);
            $this->customer->create($data);
            Session::set('message', 'Data create successfull');
            Redirect::back();
        }
    }

    public function logout()
    {
        Auth::logout();
        Redirect::go('/login');
    }
}
