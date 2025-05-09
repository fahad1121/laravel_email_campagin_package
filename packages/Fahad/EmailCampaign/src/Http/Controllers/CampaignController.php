<?php

namespace Fahad\EmailCampaign\Http\Controllers;

use Fahad\EmailCampaign\Http\Requests\CampaignRequest;
use Fahad\EmailCampaign\Http\Requests\CustomerRequest;
use Fahad\EmailCampaign\Http\Requests\RecipientRequest;
use Fahad\EmailCampaign\Models\Campaign;
use Fahad\EmailCampaign\Models\Customer;
use Illuminate\Routing\Controller;
use Fahad\EmailCampaign\Jobs\SendCampaignEmail;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::withCount(['recipients as sent_count' => function($query) {
            $query->where('status', 'sent');
        }])->get();

        return response()->json(['success' => true, 'data' => $campaigns]);
    }

    public function store(CampaignRequest $request)
    {
        if($data = $request->validated()){
            $campaign = Campaign::create($data);
            return response()->json(['success' => true, 'data' => $campaign], 201);
        }
    }

    public function show($id)
    {
        $campaign = Campaign::with(['recipients' => function($query) {
            $query->select(
                'customers.*',
                'campaign_recipients.status_title',
                'campaign_recipients.error'
            );
        }])->find($id);

        if (!$campaign) {
            return response()->json(['success' => false, 'message' => 'Campaign not found.'], 404);
        }

        return response()->json(['success' =>true,'data' => $campaign],200);
    }

    public function filterCustomers(CustomerRequest $request)
    {
        if($request->validated()){
            $query = Customer::query();

            if ($request->has('status')) {
                $query->where('status', $request->status);
            }

            if ($request->has('expires_within_days')) {
                $query->where('plan_expiry_date', '<=', now()->addDays((int) $request->expires_within_days));
            }

            $customers = $query->get();

            return response()->json(['success' => true, 'data' => $customers]);
        }
    }

    public function addRecipients(RecipientRequest $request, $campaignId)
    {
        if($request->validated()){
            $campaign = Campaign::findOrFail($campaignId);

            DB::transaction(function () use ($campaign, $request) {
                $campaign->recipients()->syncWithoutDetaching($request->customer_ids);
            });

            return response()->json(['success' => true,'message' => 'Recipients added successfully']);
        }
    }

    public function sendCampaign($campaignId)
    {
        $campaign = Campaign::with('recipients')->findOrFail($campaignId);
        foreach ($campaign->recipients as $recipient) {
            SendCampaignEmail::dispatch($campaign, $recipient);
        }

        return response()->json(['message' => 'Campaign is being sent to recipients']);
    }
}
