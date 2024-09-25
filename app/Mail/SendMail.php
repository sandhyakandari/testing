<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->data['title'] == "Forget Password") {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: Reset Password link',
            );
        }
        if ($this->data["title"] == "contact us form") {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), "Kheldhaara team"),
                subject: 'Kheldhaara: New visitor Message',
            );
        }

        return new Envelope(
            from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
            subject: 'Registration and Email Verification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->data['title'] == "Forget Password") {
            return new Content(
                view: 'Mailtemplate.reset-email',
            );
        }

        if ($this->data["title"] == "contact us form") {
            return new Content(
                view:'Mailtemplate.contactUs'
            );
        }
        return new Content(
            view: 'Mailtemplate.verify-email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
