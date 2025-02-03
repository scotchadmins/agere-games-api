<?php
return [
    // Base URL for the API
    'base_url' => env('GAMING_API_BASE_URL', 'https://staging.agere.games/api/games/admin'),

    // Authentication token
    'token' => env('GAMING_API_TOKEN', ''),

    // Casino ID
    'casino' => env('GAMING_API_CASINO', ''),

    // Default currency
    'currency' => env('GAMING_API_CURRENCY', 'USD'),

    // Default language
    'language' => env('GAMING_API_LANGUAGE', 'en'),
];
