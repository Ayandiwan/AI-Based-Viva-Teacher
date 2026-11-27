<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'mistral' => [
        'api_key' => env('MISTRAL_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Groq AI
    |--------------------------------------------------------------------------
    */

    'groq' => [
        'key' => env('GROQ_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | OpenRouter AI
    |--------------------------------------------------------------------------
    */

    'openrouter' => [
        'key' => env('OPENROUTER_API_KEY'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Cloudflare Workers AI
    |--------------------------------------------------------------------------
    */

    'cloudflare' => [
        'account_id' => env('CLOUDFLARE_ACCOUNT_ID'),
        'api_token' => env('CLOUDFLARE_API_TOKEN'),
    ],

];
