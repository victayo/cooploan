<?php

namespace App\Mail;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuarantorApproval extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $loan;
    private $loanUrl;
    private $approvalStatus;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Loan $loan, $loanUrl, $approvalStatus)
    {
        $this->user = $user;
        $this->loan = $loan;
        $this->approvalStatus = $approvalStatus;
        $this->loanUrl = $loanUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Guarantor Approval',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.guarantor.approval',
            with: [
                'user' => $this->user,
                'approvalStatus' => strtoupper($this->approvalStatus),
                'loan' => $this->loan,
                'loanUrl' => $this->loanUrl
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
