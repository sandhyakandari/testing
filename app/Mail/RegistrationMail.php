<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->data["title"] == "Player") {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), "Kheldhaara team"),
                subject: 'Kheldhaara: New player register with us!',
            );
        }

        if ($this->data["title"] == "Academy") {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), "Kheldhaara team"),
                subject: 'Kheldhaara: New academy register with us!',
            );
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->data["title"] == "Player") {
            return new Content(
                view: 'Mailtemplate.newPlayerRegister',
                with: ["data" => $this->data]
            );
        }
        if ($this->data['title'] == "Academy") {
            return new content(
                view: 'Mailtemplate.newAcademyRegister',
                with: ["data" => $this->data]
            );
        }
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
