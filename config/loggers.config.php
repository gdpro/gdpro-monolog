<?php
// Loggers
return [
    'default' => [
        'name' => 'Default Logger',
        'handlers' => [
            'default',
        ]
    ],

    'slow_response_time' => [
        'name' => 'Slow response time',
        'handlers' => [
            'slow_response_time',
        ],
        'processors' => [
            'WebProcessor'
        ]
    ],

    'render_error' => [
        'name' => 'Render',
        'handlers' => [
            'render_error',
        ],
        'processors' => [
            'WebProcessor'
        ]
    ],

    'dispatch_error' => [
        'name' => 'Dispatch',
        'handlers' => [
            'dispatch_error',
        ],
        'processors' => [
            'WebProcessor'
        ]
    ]
];