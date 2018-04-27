<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fileLink;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $fileLink, $name)
    {
        $this->email = $email;
        $this->fileLink = $fileLink;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->view('mail.send')
            ->with(['fileLink'=> $this->fileLink, 'name' => $this->name])
            ->from('file.storages.ex@gmail.com');
    }
}
