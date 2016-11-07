<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 07/11/16
 * Time: 16:59
 */

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class MudancaDePassword extends Mailable
{
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
        return $this->view('mail.MudancaDePassword')->with(['username'=>$this->username,'password'=>$this->password,'name'=>$this->name]);
    }
}