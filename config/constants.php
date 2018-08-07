<?php

return [
    'browser' => [
        'OTHERS' => 0,
        'CHROME' => 1,
        'FIREFOX' => 2,
        'SAFARI' => 3,
        'OPERA' => 4,
        'EDGE' => 5,
        'IE' => 6,


    ],
    'timeframe' => [
        'alltime' => 0,
        '2hours' => 2,
        'day' => 24,
        'week' => 168,
        'month' => 720,
    ],
    'typeShortUrl' => [
        'GENERATE' => 0,
        'CUSTOMIZE' => 1
    ],

    'error' =>[
        'ERROR_EXIST' => 'This link already existed. Please choose another short link',
        'INVALID_URL' => 'Invalid original URL',
        'ERROR_CUSTOM' => 'Invalid custom url'
    ],

    'hours_to_milliseconds' => 3600000,
];