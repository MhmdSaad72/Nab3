<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelledMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data ;
        $this->email = $data['email'] ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this
            ->to($this->email)
            ->from("Nab3@example.com", "Nab3")
            ->subject('Cancelled Mail')
            ->markdown('emails.cancelled');
    }
}
