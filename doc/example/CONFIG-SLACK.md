<?php
return [
    'monolog' => [
        'loggers' => [
            'slack' => [
                'name' => 'my slack logggeerrr',
                'handlers' => [
                    'slack'
                ],
                'processors' => [
                    'WebProcessor',
                    'GitProcessor',
                    'IntrospectionProcessor',
                    'PsrLogMessageProcessor'
                ]
            ]
        ],
        'handlers' => [
            'slack' => [
                'class' => 'SlackHandler',
                'args' => [
                    'token' => 'YOUR TOKEN SLACK HERE',
                    'channel' => 'log', // Channel on slack
                    'username' => 'monolog', // Your user name on the channel
                    'useAttachment' => true,
                    'iconEmoji' => null,
                    'level' => 400
                ],
                'formatter' => 'slack'
            ],
        ],
        'formatters' => [
            'slack' => [
                'class' => 'LineFormatter',
                'args' => [
                    'format' => "%datetime% - %channel% - %message% \n%extra% \n"
                ]
            ],
        ]
    ]
];
