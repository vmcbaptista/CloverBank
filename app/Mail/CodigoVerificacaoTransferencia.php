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
use Illuminate\Support\Facades\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class CodigoVerificacaoTransferencia extends Mailable
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
        return $this->view('mail.CodigoVerificacaotransferencia')->with(['name'=>$this->name,'VerificationCode'=>$this->VerificationCode]);
    }
}