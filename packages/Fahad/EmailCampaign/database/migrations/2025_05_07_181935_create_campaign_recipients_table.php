<?php

use Fahad\EmailCampaign\Models\Campaign;
use Fahad\EmailCampaign\Models\Customer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Campaign::class);
            $table->foreignIdFor(Customer::class);
            $table->enum('status_title', ['Paid', 'Grace period', 'Expired'])->default('Paid');
            $table->text('error');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_recipients');
    }
};
