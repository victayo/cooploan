<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuarantorRequest extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $guarantor;
    private $loan;
    private $url;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $guarantor, $loan, $url)
    {
        $this->user = $user;
        $this->guarantor = $guarantor;
        $this->loan = $loan;
        $this->url = $url;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Guarantor Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.guarantor.request',
            with: [
                'user' => $this->user,
                'guarantor' => $this->guarantor,
                'loan' => $this->loan,
                'url' => $this->url
            ]
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
