<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClosedTicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket_close;
    public $admin;

    /**
     * Create a new message instance.
     */
    public function __construct($ticket_close, $admin)
    {
        $this->ticket_close = $ticket_close;
        $this->admin = $admin;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Closed Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.closed_ticket_mail',
            with: [              
                'ticket_number' => $this->ticket_close->ticket_number, 
                'subject' => $this->ticket_close->subject,                
                'customer_issue' => $this->ticket_close->message,  
                'admin_email' => $this->admin->email,              
                'admin_name' => $this->admin->name,              
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
