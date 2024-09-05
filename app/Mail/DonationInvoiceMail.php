<?php

namespace App\Mail;

use App\Models\CauseDonation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donationData;
    public $causeData;

    /**
     * Create a new message instance.
     */
    public function __construct(CauseDonation $donationData, $causeData)
    {
        $this->donationData = $donationData;
        $this->causeData = $causeData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donation Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('user.emails.invoice')
                    ->subject('Your Donation Invoice')
                    ->with([
                        'donation_data' => $this->donationData,
                        'cause_data' => $this->causeData,
                    ]);
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
