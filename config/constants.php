<?php

return [
    'domain' => $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'],
    'browser' => [
        'OTHERS'    => 0,
        'CHROME'    => 1,
        'FIREFOX'   => 2,
        'SAFARI'    => 3,
        'OPERA'     => 4,
        'EDGE'      => 5,
        'IE'        => 6,
        

    ],
    'timeframe' => [
        'alltime'   => 0,
        '2hours'    => 2,
        'day'       => 24,
        'week'      => 168,
        'month'     => 720,
    ],
    'hours_to_milliseconds' => 3600000,
];