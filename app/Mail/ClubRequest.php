<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClubRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $clubReg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($clubReg)
    {
        $this->clubReg = $clubReg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.clubRequest');
    }
}
