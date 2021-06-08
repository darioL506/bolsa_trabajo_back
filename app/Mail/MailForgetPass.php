<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailForgetPass extends Mailable
{
    use Queueable, SerializesModels;

    private $name;
    private $newPass;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$newPass)
    {
        $this->name = $name;
        $this->newPass = $newPass;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        {
            return $this->from('no@reply.com', 'CIFP Virgen de Gracia, Bolsa de Trabajo')
                ->subject('Contraseña olvidada')
                ->markdown('mails.forgotPass')
                ->with([
                    'name' => $this->name,
                    'newPass' => $this->newPass,
                    'link' => '/inboxes/'
                ]);
        }
    }
}
