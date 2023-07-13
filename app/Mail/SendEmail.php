<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $emailAddresses;

    public function __construct($emailAddresses)
    {
        $this->emailAddresses = $emailAddresses;
    }

    public function build()
    {
        return $this->subject('Subject of the email')
                    ->to($this->emailAddresses)
                    ->view('welcome');
    }
}
