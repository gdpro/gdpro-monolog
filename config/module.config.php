<?php
return [
    'gdpro_monolog' => [
        'formatters' => [
            'default' => [
                'class' => 'LineFormatter',
            ]
        ],

        'handlers' => [
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
                    // The minimum logging level at which this handler will be triggered
                    'level' => \Monolog\Logger::DEBUG,
                    // Whether the messages that are handled can bubble up the stack or not
                    'bubble' => true
                ],
                'formatter' => 'default'
            ]
        ],

        'loggers' => [
            'default' => [
                'name' => 'Default Logger',
                'handlers' => [
                    'default',
                    'hipchat'
                ]
            ],
//            'exception' => [
//                'name' => 'Exception Logger',
//                'handlers' => [
//                    'default',
//                    'hipchat'
//                ]
//            ],
//            'hipchat' => [
//                'name' => 'Hipchat Logger',
//                'handlers' => [
//                    'default',
//                    'hipchat'
//                ]
//            ]
        ]
    ],

    'service_manager' => [
        'factories' => [
            'gdpro_monolog.manager' => 'GdproMonolog\Factory\MonologManagerFactory'
        ]
    ]
];
