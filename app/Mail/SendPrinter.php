<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPrinter extends Mailable
{
    use Queueable, SerializesModels;
    public $messageRecipient;
    public $messageSubject;
    public $messageContent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messageRecipient, $messageSubject, $messageContent)
    {
        $this->messageRecipient = $messageRecipient;
        $this->messageSubject = $messageSubject;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.printeremail')
            ->to($this->messageRecipient)
            ->subject($this->messageSubject);
    }
}
