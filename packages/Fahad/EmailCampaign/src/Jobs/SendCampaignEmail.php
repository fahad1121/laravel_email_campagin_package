<?php

namespace Fahad\EmailCampaign\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Fahad\EmailCampaign\Models\Campaign;
use Fahad\EmailCampaign\Models\CampaignRecipient;
use Fahad\EmailCampaign\Mail\CampaignMail;

class SendCampaignEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    protected $customer;

    public function __construct(Campaign $campaign, $customer)
    {
        $this->campaign = $campaign;
        $this->customer = $customer;
    }

    public function handle()
    {
        $recipient = CampaignRecipient::where('campaign_id', $this->campaign->id)
            ->where('customer_id', $this->customer->id)
            ->first();

        try {
            Mail::to($this->customer->email)->send(new CampaignMail($this->campaign));

            $recipient->update([
                'status_title' => 'sent',
            ]);
        } catch (\Exception $e) {
            $recipient->update([
                'status_title' => 'failed',
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
