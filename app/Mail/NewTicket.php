<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewTicket extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $ticket_text;
    public $author;
    /**
     * Create a new message instance.
     *
     * @param $subject
     * @param $ticket_text
     * @param $author
     */
    public function __construct(string $subject, string $ticket_text, string $author)
    {
        $this->subject=$subject;
        $this->ticket_text=$ticket_text;
        $this->author=$author;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newtickets');
    }
}
