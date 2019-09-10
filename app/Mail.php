<?php

namespace App;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Database\Eloquent\Model;

class Mail
{
    public $mail ;
    
    public function __construct($to , $sub , $body){
        $this->mail             = new PHPMailer;
        $this->mail->SMTPAuth   = true; 
        $this->mail->Host       = "mail.akwanmedia-erp.com"; 
        $this->mail->Port       = 587; 
        $this->mail->Username = "sendmail@akwanmedia-erp.com"; 
        $this->mail->Password = "B!*v!+bkKkxq"; 
        $this->mail->SMTPAutoTLS = false;
        $this->mail->SMTPSecure = false;
        $this->mail->Subject = $sub;
        $this->mail->Body    = $body;
        $this->mail->AddAddress($to);
        $this->mail->SetFrom('vginv@vginv.com', 'vginv');
    }

    public function send(){
        $this->mail->Send();
    }
}
