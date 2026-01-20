<?php

return [
    'url' => env('HEALTH_URL', 'https://monitor.ifresh.nl/notify'),
    'api_token' => env('HEALTH_API_TOKEN', ''),

    'decider' => \IFresh\PackageHealth\Support\Decider::class,
];
