<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationSucessfully extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $role;
    public $department;
    public $mailTo;

    /**
     * Create a new message instance.
     *
     * @param string $name
     * @param string $role
     * @param string $department
     * @param string $mailTo
     */
    public function __construct(string $name, string $role, string $department, string $mailTo ='user')
    {
        $this->name = $name;
        $this->role = $role;
        $this->department = $department;
        $this->mailTo = $mailTo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->mailTo === 'user') {
            return $this->view('mails.registrationsucessfully')
                ->subject('New ' . $this->role . ' was added.');
        } else {
            return $this->view('mails.registrationsucessfully')
                ->subject('You add new ' . $this->role);
        }
    }


}
