<?php

return [
    'domain' => $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'],
    'browser' => [
        'CHROME'    => 1,
        'FIREFOX'   => 2,
        'SAFARI'    => 3,
        'OPERA'     => 4,
        'IE'        => 5,
        'OTHERS'    => 0,

    ],
    'timeframe' => [
        'alltime'   => 0,
        '2hours'    => 1,
        'day'       => 2,
        'week'      => 3,
        'month'     => 4,
    ]
];