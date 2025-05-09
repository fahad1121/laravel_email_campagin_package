<?php

namespace Fahad\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignRecipient extends Model
{
    protected $table = 'campaign_recipients';

    protected $fillable = ['campaign_id', 'customer_id', 'status', 'sent_at', 'error'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function customer()
    {
        return $this->belongsTo(config('EmailCampaign.customer_model', 'App\Models\Customer'));
    }
}
