<?php

namespace App\Controller;

use App\Base\Mail;
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
        $mail = new Mail;
        $data = $_POST;
        $mail->send('mail.index', function ($mail) {
            $mail->setFrom('from@example.com', 'First Last');
            $mail->addReplyTo('replyto@example.com', 'First Last');
            $mail->addAddress('whoto@example.com', 'John Doe');
            $mail->Subject = 'PHPMailer SMTP test';
        });
        Redirect::back('/');
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
