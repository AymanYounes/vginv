<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub , $content)
    {
        $this->subject   = $sub ;
        $this->content   = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("mails.newCustomer")
        ->from("support@vginv.com", "vginv")    
        ->subject($this->subject);
    }
}
