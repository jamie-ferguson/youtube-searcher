<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | This value is a Google Cloud API key. This is used to identify a GC server
    | application and can be used to access public data anonymously.
    | see https://cloud.google.com/docs/authentication/api-keys
    |
    */
    'api_key' => env('GOOGLE_API_KEY', null),
];
