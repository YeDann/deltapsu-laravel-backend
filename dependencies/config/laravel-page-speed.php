<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable Laravel Page Speed
    |--------------------------------------------------------------------------
    |
    | Set this field to false to disable the laravel page speed service.
    | You would probably replace that in your local configuration to get a readable output.
    |
    */
    'enable' => env('LARAVEL_PAGE_SPEED_ENABLE', true),

    /*
    |--------------------------------------------------------------------------
    | Skip Routes
    |--------------------------------------------------------------------------
    |
    | Skip Routes paths to exclude.
    | You can use * as wildcard.
    |
    */
    'skip' => [
    '*.pdf', //Ignore all routes with final .pdf
    '*/downloads/*',//Ignore all routes that contain 'downloads'
    'assets/*', // Ignore all routes with the 'assets' prefix
]

];