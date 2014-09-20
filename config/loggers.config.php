<?php
// Loggers
return [
    'default' => [
        'name' => 'Default Logger',
        'handlers' => [
            'default',
            'hipchat'
        ]
    ],

    'slow_response_time' => [
        'name' => 'Slow response time',
        'handlers' => [
            'slow_response_time',
            'hipchat'
        ],
        'processors' => [
            'WebProcessor'
        ]
    ],

    'render_error' => [
        'name' => 'Render',
        'handlers' => [
            'render_error',
            'hipchat'
        ],
        'processors' => [
            'WebProcessor'
        ]
    ],

    'dispatch_error' => [
        'name' => 'Dispatch',
        'handlers' => [
            'dispatch_error',
            'hipchat'
        ],
        'processors' => [
            'WebProcessor'
        ]
    ]
];