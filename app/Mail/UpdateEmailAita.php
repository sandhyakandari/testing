<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateEmailAita extends Mailable
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
        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Academy') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team1'),
                subject: 'Kheldhaara: Update Email Request',
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Academy') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: Update aita number request'
            );
        }

        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Player') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: Update Email Request',
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Player') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: Update aita number request'
            );
        }

        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Admin') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: Email has updated',
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Admin') {
            return new Envelope(
                from: new Address(env('MAIL_USERNAME'), 'Kheldhaara Team'),
                subject: 'Kheldhaara: AITA number updated!'
            );
        }
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Academy') {
            return new Content(
                view: 'Mailtemplate.academyEmailUpdate',
                with: ['data' => $this->data]
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Academy') {
            return new Content(
                view: 'Mailtemplate.academyAitaUpdate',
                with: ['data' => $this->data]
            );
        }

        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Player') {
            return new Content(
                view: 'Mailtemplate.playerEmailUpdate',
                with: ['data' => $this->data]
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Player') {
            return new Content(
                view: 'Mailtemplate.playerAitaUpdate',
                with: ['data' => $this->data]
            );
        }

        if ($this->data['title'] == 'Email' && $this->data['type'] == 'Admin') {
            return new Content(
                view: 'Mailtemplate.adminEmailUpdated',
                with: ['data' => $this->data]
            );
        }

        if ($this->data['title'] == 'Aita' && $this->data['type'] == 'Admin') {
            return new Content(
                view: 'Mailtemplate.adminAitaUpdated',
                with: ['data' => $this->data]
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
