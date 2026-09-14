<?php

return [
    'consent_version' => '2026-09-14',

    'metrika' => [
        'counter_id' => env('YANDEX_METRIKA_COUNTER_ID'),
        'enabled' => (bool) env('YANDEX_METRIKA_COUNTER_ID'),
        'webvisor' => false,
        'clickmap' => true,
        'track_links' => true,
        'accurate_track_bounce' => true,
    ],
];
