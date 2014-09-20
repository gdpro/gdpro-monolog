<?php
return [
    'gdpro_monolog' => [
        'listeners' => [
            'check_slow_response_time' => [
                'logger' => 'slow_response_time',
                // Response time limit in micro seconds
                'threshold' => '700'
            ],

            'log_dispatch_error' => [
                'logger' => 'dispatch_error'
            ],

            'log_render_error' => [
                'logger' => 'dispatch_error'
            ]
        ],

        'formatters' => include 'formatters.config.php',
        'handlers' => include 'handlers.config.php',
        'loggers' => include 'loggers.config.php'
    ],

    'service_manager' => [
        'invokables' => [
            // Builders
            'gdpro_monolog.builder.formatter' => 'GdproMonolog\Builder\FormatterBuilder',
            'gdpro_monolog.builder.handler' => 'GdproMonolog\Builder\HandlerBuilder'
        ],
        'factories' => [
            // Manager
            'gdpro_monolog.manager' => 'GdproMonolog\Factory\MonologManagerFactory',
            'gdpro_monolog.manager.handler' => 'GdproMonolog\Factory\HandlerManagerFactory',
            'gdpro_monolog.manager.formatter' => 'GdproMonolog\Factory\FormatterManagerFactory',

            // Config
            'gdpro_monolog.config.handler' => 'GdproMonolog\Factory\Config\HandlerConfigFactory',
            'gdpro_monolog.config.formatter' => 'GdproMonolog\Factory\Config\FormatterConfigFactory',

            // Listeners
            'gdpro_monolog.listener.check_slow_response_time' =>
                'GdproMonolog\Factory\Listener\CheckSlowResponseTimeListenerFactory',
            'gdpro_monolog.listener.log_render_error' =>
                'GdproMonolog\Factory\Listener\LogRenderErrorListenerFactory',
            'gdpro_monolog.listener.log_dispatch_error' =>
                'GdproMonolog\Factory\Listener\LogDispatchErrorListenerFactory',
        ]
    ]
];
