<?php
return [
    'monolog' => [

    ],

    'Blur\Service\Monolog\Default' => [
        'name' => 'Default Logger',
        'handlers' => [
            'default' => [
                'name' => 'Monolog\Handler\StreamHandler',
                'args' => [
                    'path' => 'data/log/default.log',
                    'level' => \Monolog\Logger::DEBUG,
                    'bubble' => true
                ],
                'formatter' => [
                    'name' => 'Monolog\Formatter\LogstashFormatter',
                    'args' => [
                        'application' => 'Blurgroup/Blur',
                    ]
                ]
            ]
        ]
    ],
    'Blur\Service\Monolog\Exception' => [
        'name' => 'Exception Logger',
        'handlers' => [
            'default' => [
                'name' => 'Monolog\Handler\StreamHandler',
                'args' => [
                    'path' => 'data/log/exception.log',
                    'level' => \Monolog\Logger::DEBUG,
                    'bubble' => true
                ],
                'formatter' => [
                    'name' => 'Monolog\Formatter\LogstashFormatter',
                    'args' => [
                        'application' => 'Blur',
                    ]
                ]
            ]
        ]
    ],
    'MyChromeLogger' => [
        'name' => 'Chrome Logger',
        'handlers' => [
            [
                'name' => 'Monolog\Handler\ChromePHPHandler',
            ]
        ]
    ]


];

//keLog::config('logstash', array(
//    'engine' => 'Monolog.Monolog',
//    'channel' => 'app',
//    'handlers' => array(
//        'RotatingFile' => array(
//            LOGS . 'logstash.log',
//            30,
//            'formatters' => array(
//                'Logstash' => array('web', env('SERVER_ADDR'))
//            ),
//            'processors' => array('MemoryPeakUsage')
//        ),
//        'Stream' => array(
//            LOGS . 'logstash.log',
//            'formatters' => array(
//                'Line' => array("%datetime% %channel% %level_name%: %message% %context% %extra%\n")
//            ),
//            'processors' => array('MemoryUsage', 'Web')
//        ),
//        'CakeEmail' => array(
//            'admin@domain.com',
//            'ALERT: APPLICATION REQUIRES IMMEDIATE ATTENTION.',
//            'default'
//        )
//    )
//));


// OLD CONFIG OF MY OTEHR MODULE
//return [
//    'log_trace_tiguada_options' => [
//        'name' => 'Trace Logger for Tiguada',
//        'handlers' => [
//            'default' => [
//                'name' => 'Monolog\Handler\StreamHandler',
//                'args' => [
//                    'path' => 'data/log/tiguada.trace.log',
//                    'level' => \Monolog\Logger::INFO,
//                    'bubble' => true
//                ],
//                'formatter' => [
//                    'name' => 'Monolog\Formatter\LogstashFormatter',
//                    'args' => [
//                        'application' => 'Tiguada',
//                    ]
//                ]
//            ]
//        ]
//    ],
//    '\Service\Monolog\Default' => [
//        'name' => 'Default Logger',
//        'handlers' => [
//            'default' => [
//                'name' => 'Monolog\Handler\StreamHandler',
//                'args' => [
//                    'path' => 'data/log/default.log',
//                    'level' => \Monolog\Logger::DEBUG,
//                    'bubble' => true
//                ],
//                'formatter' => [
//                    'name' => 'Monolog\Formatter\LogstashFormatter',
//                    'args' => [
//                        'application' => 'Blurgroup/Blur',
//                    ]
//                ]
//            ]
//        ]
//    ],
//    '\Service\Monolog\Exception' => [
//        'name' => 'Exception Logger',
//        'handlers' => [
//            'default' => [
//                'name' => 'Monolog\Handler\StreamHandler',
//                'args' => [
//                    'path' => 'data/log/exception.log',
//                    'level' => \Monolog\Logger::DEBUG,
//                    'bubble' => true
//                ],
//                'formatter' => [
//                    'name' => 'Monolog\Formatter\LogstashFormatter',
//                    'args' => [
//                        'application' => 'Blur',
//                    ]
//                ]
//            ]
//        ]
//    ],
//    'MyChromeLogger' => [
//        'name' => 'Chrome Logger',
//        'handlers' => [
//            [
//                'name' => 'Monolog\Handler\ChromePHPHandler',
//            ]
//        ]
//    ]
//];