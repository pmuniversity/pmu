<?php
return [
    // Mail Notification
    'mail_notification' => env('MAIL_NOTIFICATION') ?: false,
    // Default Icon
    'default_desktop_icon' => env('DEFAULT_DESKTOP_ICON') ?: '/images/desktop/favicon.ico',
    'default_mobile_icon' => env('DEFAULT_MOBILE_ICON') ?: '/images/mobile/favicon.ico',
    'desktop_title' => 'desktop',
    'mobile_title' => 'mobile',
    // Meta
    'meta' => [
        'keywords' => '',
        'description' => ''
    ],
    // Google Analytics
    'google' => [
        'id' => env('GOOGLE_ANALYTICS_ID', 'Google-Analytics-ID'),
        'open' => env('GOOGLE_OPEN') ?: false
    ],
];