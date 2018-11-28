<?php

return [
    'api_url'       => env('TEAMLEADER_API_URL', 'https://api.teamleader.eu'),
    'auth_url'      => env('TEAMLEADER_AUTH_URL', 'https://app.teamleader.eu'),
    'client_id'     => env('TEAMLEADER_ID'),
    'client_secret' => env('TEAMLEADER_SECRET'),
    'redirect_uri'  => env('TEAMLEADER_REDIRECT'),
    'client'        => null,
];
