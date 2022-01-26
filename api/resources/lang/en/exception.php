<?php

return [
    'only' => [
        'super_admin' => 'Oops! You are not authorized to access this endpoint.',
        'json' => 'Oops! Invalid request. `Accept: application/json` is required in your request header.'
    ],
    'unauthorized' => [
        'owner' => 'Oops! You are not the owner of the shop.'
    ],
];
