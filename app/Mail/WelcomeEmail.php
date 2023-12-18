<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userId;
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    public function build()
    {
        return $this->subject('Welcome to Blogapp')->view('emails.welcome');
    }

}
