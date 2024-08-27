<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Gemini API Key
    |--------------------------------------------------------------------------
    |
    | The API key for authenticating with the Gemini service. You can obtain
    | this key from your Gemini account dashboard. Make sure to keep this key
    | secure and never expose it publicly.
    |
    */

    'api_key' => env('API_GEMINI_KEY', 'AIzaSyD8aLRL3OESOA1jILadzAowxTB2gkYelDI'),

    /*
    |--------------------------------------------------------------------------
    | Gemini API URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the Gemini API. This URL is used for making requests to
    | the Gemini service. You shouldn't need to change this unless you're
    | using a custom endpoint.
    |
    */

    'url' => env('GEMINI_URL', 'https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent'),
];
