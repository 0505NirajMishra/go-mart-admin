<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Webup\LaravelSendinBlue\SendinBlue; // <- you need this
use Webup\LaravelSendinBlue\SendinBlueTransport; // <- you need this
use Illuminate\Contracts\Queue\ShouldQueue;
class Register extends Mailable
{
    use Queueable, SerializesModels;
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }
   
    public function build()
    {
        return $this->subject('Go Mart')
                    ->view('admin.email.registermail');
    }
}