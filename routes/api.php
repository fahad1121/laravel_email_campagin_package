<?php

use Illuminate\Support\Facades\Route;

use Fahad\EmailCampaign\Http\Controllers\CampaignController;

Route::prefix('campaigns')->group(function () {
    Route::get('/', [CampaignController::class, 'index']);
    Route::post('/', [CampaignController::class, 'store']);
    Route::get('/{id}', [CampaignController::class, 'show']);
    Route::post('/{campaignId}/recipients', [CampaignController::class, 'addRecipients']);
    Route::post('/filter-customers', [CampaignController::class, 'filterCustomers']);
    Route::post('/{campaignId}/send', [CampaignController::class, 'sendCampaign']);
});
