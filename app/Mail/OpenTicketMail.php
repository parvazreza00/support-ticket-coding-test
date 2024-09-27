<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OpenTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketData;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($ticketData)
    {
        $this->ticketData = $ticketData;
        $this->subject = "Open Ticket " . $ticketData->subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.open_ticket_mail',
            with: [               
                'ticket_number' => $this->ticketData->ticket_number,                
                'customer_email' => $this->ticketData->user->email,                
                'customer_name' => $this->ticketData->user->name,                
                'customer_issue' => $this->ticketData->message,                
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
