<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $changes;

    /**
     * Create a new message instance.
     */
    public function __construct($contact, $changes)
    {
        $this->contact = $contact;
        $this->changes = $changes;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Updated',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd($this->changes);

        return new Content(
            view: 'email',
            with: [
                // 'contact' => $this->contact,
                'changes' => $this->changes,
            ],
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
