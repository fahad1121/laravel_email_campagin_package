<?php

namespace Fahad\EmailCampaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ];
    }
}
