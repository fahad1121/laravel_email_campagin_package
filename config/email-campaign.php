<?php

return [
    'email_provider' => env('EMAIL_CAMPAIGN_PROVIDER', 'mailtrap'),

    'mailtrap' => [
        'host' => env('MAIL_HOST', 'sandbox.smtp.mailtrap.io'),
        'port' => env('MAIL_PORT', 2525),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
    ],

    // Customer statuses (unchanged)
    'customer_statuses' => [
        'paid',
        'grace_period',
        'expired'
    ],
];
