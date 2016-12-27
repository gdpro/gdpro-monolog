<?php
namespace GdproMonolog;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\Builder\HandlerBuilder;
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
                ]
            ],
            'slow_response_time' => [
                'name' => 'Slow response time',
                'handlers' => [
                    'slow_response_time'
                ],
                'processors' => [
                    'WebProcessor'
                ]
            ],
            'render_error' => [
                'name' => 'Render',
                'handlers' => [
                    'render_error'
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
        ],
        'handlers'      => [
            // Default define the default value for all you handlers. So please do not delete
            'default' => [
                'class' => 'StreamHandler',
                // This args match to the constructor arg of the class
                'args' => [
                    'stream' =>  'data/log/default.log',
                    // The minimum logging level at which this handler will be triggered
                    'level' => 100,
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
            ]
        ],
        'formatters'    => [
            'default' => [
                'class' => 'LineFormatter',
                'args' => [
                    'application' => 'gdpro'
                ]
            ]
        ],
    ]
];
