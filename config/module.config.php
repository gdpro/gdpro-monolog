<?php
namespace GdproMonolog;

use Monolog\Logger;

return [
    'service_manager' => [
        'invokables' => [
            // Builders
            'gdpro_monolog.builder.formatter'   => 'GdproMonolog\Builder\FormatterBuilder',
            'gdpro_monolog.builder.handler'     => 'GdproMonolog\Builder\HandlerBuilder'
        ],
        'factories' => [
            // Manager
            'gdpro_monolog.manager'             => 'GdproMonolog\Factory\LoggerManagerFactory',
            'gdpro_monolog.manager.handler'     => 'GdproMonolog\Factory\HandlerManagerFactory',
            'gdpro_monolog.manager.formatter'   => 'GdproMonolog\Factory\FormatterManagerFactory',

            // Config
            'gdpro_monolog.config.logger'       => 'GdproMonolog\Factory\Config\LoggerConfigFactory',
            'gdpro_monolog.config.handler'      => 'GdproMonolog\Factory\Config\HandlerConfigFactory',
            'gdpro_monolog.config.formatter'    => 'GdproMonolog\Factory\Config\FormatterConfigFactory',

            // Listeners
            'gdpro_monolog.listener.check_slow_response_time' => 'GdproMonolog\Factory\Listener\CheckSlowResponseTimeListenerFactory',
            'gdpro_monolog.listener.log_render_error' => 'GdproMonolog\Factory\Listener\LogRenderErrorListenerFactory',
            'gdpro_monolog.listener.log_dispatch_error' => 'GdproMonolog\Factory\Listener\LogDispatchErrorListenerFactory',
        ]
    ],
    'gdpro_monolog' => [
        'listeners' => [
            'check_slow_response_time' => [
                'enabled'   => true,
                'logger'    => 'slow_response_time',
                // Response time limit in micro seconds, this time only take in
                // Account the application time, not the latency of the network.
                'threshold' => '400'
            ],
            'log_dispatch_error' => [
                'enabled'   => true,
                'logger'    => 'dispatch_error'
            ],
            'log_render_error' => [
                'enabled'   => true,
                'logger'    => 'render_error'
            ]
        ],
        'loggers'       => [
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
        'formatters'    => [
            'default' => [
                'class' => 'LineFormatter',
                'args' => [
                    'application' => 'gdpro'
                ]
            ]
        ],
        'handlers'      => [
            // Default define the default value for all you handlers. So please do not delete
            'default' => [
                'class' => 'StreamHandler',
                'args' => [
                    'stream' =>  'data/log/default.log',
                    // The minimum logging level at which this handler will be triggered
                    'level' => Logger::DEBUG,
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
        ]
    ]
];
