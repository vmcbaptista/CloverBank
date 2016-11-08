<?php
/**
 * Created by PhpStorm.
 * User: paulomendez
 * Date: 08/11/16
 * Time: 15:38
 */

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class ResetPasswordCode extends Mailable
{
    public $VerificationCode;
    public $name;


    public function __construct($VerificationCode,$name)
    {
        $this->VerificationCode = $VerificationCode;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.ResetPasswordCode')->with(['name'=>$this->name,'VerificationCode'=>$this->VerificationCode]);
    }
}