<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLoginInfo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $username;
    public $password;
    public $name;

    public function __construct($username,$password,$name)
    {
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;



    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.SendLoginInfo')->with(['username'=>$this->username,'password'=>$this->password,'name'=>$this->name]);
    }
}
