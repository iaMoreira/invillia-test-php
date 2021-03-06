<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProcessOrdersMail extends Mailable
{
    use Queueable, SerializesModels;

    private $itens;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($itens)
    {
        $this->itens = $itens;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.process-orders')->with(['itens' => $this->itens]);
    }
}
