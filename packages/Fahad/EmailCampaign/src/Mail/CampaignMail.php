<?php

namespace Fahad\EmailCampaign\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Fahad\EmailCampaign\Models\Campaign;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;

    /**
     * Create a new message instance.
     *
     * @param \Fahad\EmailCampaign\Models\Campaign $campaign
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->campaign->subject)
            ->view('emailcampaign::emails.campaign')
            ->with([
                'campaign' => $this->campaign,
            ]);
    }
}
