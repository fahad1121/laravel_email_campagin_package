<?php

namespace Fahad\EmailCampaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipientRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
        ];
    }

}
