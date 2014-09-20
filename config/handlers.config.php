<?php
// Handlers
return [
    // Default define the default value for all you handlers. So please do not delete
    'default' => [
        'class' => 'StreamHandler',
        'args' => [
            'stream' =>  'data/log/default.log',
            // The minimum logging level at which this handler will be triggered
            'level' => \Monolog\Logger::DEBUG,
            // Whether the messages that are handled can bubble up the stack or not
            'bubble' => true,
            // Optional, file permissions (default (0644) are only for owner read/write)
            'file_permission' => 0777,
            // Try to lock log file before doing any writes
            'user_locking' => false
        ],
        'formatter' => 'default'
    ],

    'render_error' => [
        'args' => [
            'stream' =>  'data/log/render_error.log'
        ]
    ],

    'dispatch_error' => [
        'args' => [
            'stream' =>  'data/log/dispatch_error.log'
        ]
    ],

    'slow_response_time' => [
        'args' => [
            'stream' =>  'data/log/slow_response_time.log'
        ]
    ],

    'hipchat' => [
        'class' => 'HipChatHandler',
        'args' => [
            // HipChat API token
            'token' => '39e5dc0282a53887240c2673ee0277',
            // Name used to send the message (from)
            'name' => 'socialcar',
            // HipChat Room Id or name, where messages are sent
            'room' => 'socialcar',
            // Should the message trigger a notification in the clients
            'notify' => true,
        ],
    ]
];