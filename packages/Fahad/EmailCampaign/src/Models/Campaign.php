<?php

namespace Fahad\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Fahad\EmailCampaign\Models\Customer;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subject', 'body'];

    public function recipients()
    {
        return $this->belongsToMany(
            Customer::class,
            'campaign_recipients',
            'campaign_id',
            'customer_id'
        )->withPivot('status_title', 'error');
    }
}
