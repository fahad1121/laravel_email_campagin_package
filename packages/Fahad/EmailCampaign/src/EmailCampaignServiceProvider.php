<?php

namespace Fahad\EmailCampaign;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class EmailCampaignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $configPath = __DIR__.'/../config/EmailCampaign.php';

        if (file_exists($configPath)) {
            $this->mergeConfigFrom($configPath, 'EmailCampaign');
        }
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'EmailCampaign');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([__DIR__.'/../config/EmailCampaign.php' => config_path('EmailCampaign.php'),
        ], 'EmailCampaign-config');
    }
}
