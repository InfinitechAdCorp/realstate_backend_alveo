<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactUsMail extends Mailable
{
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject('New Contact Us Inquiry')
                    ->view('emails.contact')
                    ->with('data', $this->data);
    }
}
