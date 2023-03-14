<?php

namespace App\Base;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    private $host;
    private $port;
    private $username;
    private $password;

    public function __construct()
    {
        $this->host = env('MAIL_HOST');
        $this->port = env('MAIL_PORT');
        $this->username = env('MAIL_USERNAME');
        $this->password = env('MAIL_PASSWORD');
    }

    public function send($html, $callback)
    {
        $html = str_replace('.', '/', $html);
        $html = file_get_contents(ROOT_PATH . '/views/' . $html . '.php');
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->Host = "{$this->host}";
        $mail->Port = $this->port;
        $mail->SMTPAuth = true;
        $mail->Username = "{$this->username}";
        $mail->Password = "{$this->password}";
        $mail->Body = $html;
        $mail->isHTML(true);
        call_user_func($callback, $mail);
        return $mail->send();
    }
}
