<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminApprovalRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $email;
    public $token;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $email, $token)
    {
        $this->nama = $nama;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Persetujuan Registrasi Admin - Hafidz Catering',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_approval_request',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
