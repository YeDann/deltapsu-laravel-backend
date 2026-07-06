<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'sendgrid' => [
        'api_key' => env('SENDGRID_API_KEY'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    // netCOMPONENT DILP 經銷商庫存查詢 API。憑證僅存於各環境 .env，程式一律經此以 config() 讀取。
    'dilp' => [
        'base_url'  => env('DILP_BASE_URL'),
        'username'  => env('DILP_USERNAME'),
        'password'  => env('DILP_PASSWORD'),
        'token_ttl' => (int) env('DILP_TOKEN_TTL', 840),   // 秒，API token 有效 900，留 buffer
        'cache_ttl' => (int) env('DILP_CACHE_TTL', 300),   // 庫存查詢結果短快取秒數
        'mock'      => (bool) env('DILP_MOCK', false),     // 測試環境空庫存時回 fixture
        'debug'     => (bool) env('DILP_DEBUG', false),    // 開啟時把每次請求/原始回應記到 log（除錯用）
    ],

];
