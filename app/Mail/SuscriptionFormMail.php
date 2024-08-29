<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SuscriptionFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject='Formulario de suscripción';
    public $msg;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->msg=$message;
    }
    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('emails.suscription')
        ->attach($this->msg['archivo']->getRealPath(),[
            'as'=>$this->msg['archivo']->getClientOriginalName()
        ]);
    }
}
