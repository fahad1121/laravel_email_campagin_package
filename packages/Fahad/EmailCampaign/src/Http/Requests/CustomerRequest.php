<?php

namespace Fahad\EmailCampaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'status' => 'nullable|in:'.implode(',', config('EmailCampaign.customer_statuses')),
            'expires_within_days' => 'nullable|integer|min:1',
        ];
    }
}
