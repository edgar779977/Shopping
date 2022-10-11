<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var int
     */
    private $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $id)
    {
        //
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.EmailVerification')->with('url', "http://127.0.0.1:8000/api/verifyEmail/{$this->id}");
    }
}
