<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactmessageResponseMail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $name;
    public $mailSubject;
    public $messageBody;

    /**
     * Create a new message instance.
     *
     * @param $dataset
     */
    public function __construct($dataset)
    {
        $this->name = $dataset['name'];
        $this->email = $dataset['email'];
        $this->mailSubject = $dataset['subject'];
        $this->messageBody = $dataset['response'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailSubject)
            ->to($this->email)
            ->view('emails.contactmessageresponse');
    }
}
