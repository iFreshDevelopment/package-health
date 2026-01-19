<?php

return [
    'url' => env('HEALTH_URL', 'https://monitor.ifresh.nl'),
    'api_token' => env('HEALTH_API_TOKEN', ''),

    'decider' => \IFresh\PackageHealth\Support\Decider::class,
];
