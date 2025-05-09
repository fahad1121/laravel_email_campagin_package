<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// routes/web.php
Route::get('/send-test', function () {
    Mail::raw('This is a test email sent via Gmail SMTP!', function ($message) {
        $message->to('mfahadbutt18@gmail.com')
            ->subject('Test Email from Laravel');
    });

    return 'Test email sent!';
});
