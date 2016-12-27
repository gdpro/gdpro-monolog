<?php
namespace GdproMonolog;

use GdproMonolog\Factory\FormatterManagerFactory;
use GdproMonolog\Factory\HandlerManagerFactory;
use GdproMonolog\Factory\LoggerManagerFactory;
use GdproMonolog\Listener\CheckSlowResponseTimeListener;
use GdproMonolog\Listener\Factory\CheckSlowResponseTimeListenerFactory;
use GdproMonolog\Listener\Factory\LogDispatchErrorListenerFactory;
use GdproMonolog\Listener\Factory\LogRenderErrorListenerFactory;
use GdproMonolog\Listener\LogDispatchErrorListener;
use GdproMonolog\Listener\LogRenderErrorListener;

return [
    'service_manager' => [
        'factories' => [
            LoggerManager::class => LoggerManagerFactory::class,
            HandlerManager::class => HandlerManagerFactory::class,
            FormatterManager::class => FormatterManagerFactory::class,
            CheckSlowResponseTimeListener::class => CheckSlowResponseTimeListenerFactory::class,
            LogRenderErrorListener::class => LogRenderErrorListenerFactory::class,
            LogDispatchErrorListener::class => LogDispatchErrorListenerFactory::class
        ]
    ],
    'gdpro_monolog' => [
        'listeners' => [
            'check_slow_response_time' => [
                'enabled' => true,
                'logger' => 'slow_response_time',
                // Response time limit in micro seconds, this time only take in
                // Account the application time, not the latency of the network.
                'threshold' => '400'
            ],
            'log_dispatch_error' => [
                'enabled' => true,
                'logger' => 'dispatch_error'
            ],
            'log_render_error' => [
                'enabled' => true,
                'logger' => 'render_error'
            ]
        ],
        'loggers' => [
            'default' => [
                'name' => 'Default Logger',
                'handlers' => [
                    'default'
                ],
                'processors' => [
                    'WebProcessor',
                    'PsrLogMessageProcessor'
                ]
            ],
            'slow_response_time' => [
                'name' => 'Slow response time',
                'handlers' => [
                    'slow_response_time'
                ],
                'processors' => [
                    'WebProcessor',
                    'PsrLogMessageProcessor'
                ]
            ],
            'render_error' => [
                'name' => 'Render',
                'handlers' => [
                    'render_error'
                ],
                'processors' => [
                    'WebProcessor',
                    'PsrLogMessageProcessor'
                ]
            ],
            'dispatch_error' => [
                'name' => 'Dispatch',
                'handlers' => [
                    'dispatch_error'
                ],
                'processors' => [
                    'WebProcessor',
                    'PsrLogMessageProcessor'
                ]
            ]
        ],
        'handlers' => [
            'default' => [
                'class' => 'StreamHandler',
                // This args match to the constructor arg of the class
                'args' => [
                    'stream' => 'data/log/default.log',
                ],
                'formatter' => 'default'
            ],
            'render_error' => [
                'class' => 'StreamHandler',
                'args' => [
                    'stream' => 'data/log/render_error.log',
                ],
                'formatter' => 'default'
            ],
            'dispatch_error' => [
                'class' => 'StreamHandler',
                'args' => [
                    'stream' => 'data/log/dispatch_error.log',
                ],
                'formatter' => 'default'
            ],
            'slow_response_time' => [
                'class' => 'StreamHandler',
                'args' => [
                    'stream' => 'data/log/slow_response_time.log',
                ],
                'formatter' => 'default'
            ]
        ],
        'formatters'    => [
            'default' => [
                'class' => 'LineFormatter',
                'args' => [
                    'format' => "%datetime% - %channel% - %message% \n%extra% \n"
                ]
            ]
        ]
    ]
];
