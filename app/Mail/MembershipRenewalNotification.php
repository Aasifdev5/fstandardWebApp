<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MembershipRenewalNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $membershipType;
    public $membershipEndDate;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $membershipType
     * @param $membershipEndDate
     */
    public function __construct($user, $membershipType, $membershipEndDate)
    {
        $this->user = $user;
        $this->membershipType = $membershipType;
        $this->membershipEndDate = $membershipEndDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Membership Successfully Renewed')
                    ->view('emails.membership-renewal-notification');
    }
}
