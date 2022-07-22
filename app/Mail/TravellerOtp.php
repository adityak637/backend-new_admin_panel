<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TravellerOtp extends Mailable
{
    use Queueable, SerializesModels;
public $traveller;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($traveller)
    {
        $this->traveller=$traveller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Otp")->markdown('emails.Traveller.otp');
    }
}