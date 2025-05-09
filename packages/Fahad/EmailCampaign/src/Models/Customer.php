<?php

namespace Fahad\EmailCampaign\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone_number', 'status', 'plan_expiry_date'];

    public function campaigns()
    {
        return $this->belongsToMany(
            Campaign::class,
            'campaign_recipients',
            'customer_id',
            'campaign_id'
        )->withPivot('status_title', 'error');
    }
}
