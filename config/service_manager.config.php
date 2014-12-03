<?php
return [
    'invokables' => [
        // Builders
        'gdpro_monolog.builder.formatter' => 'GdproMonolog\Builder\FormatterBuilder',
        'gdpro_monolog.builder.handler' => 'GdproMonolog\Builder\HandlerBuilder'
    ],
    'factories' => [
        // Manager
        'gdpro_monolog.manager' => 'GdproMonolog\Factory\LoggerManagerFactory',
        'gdpro_monolog.manager.handler' => 'GdproMonolog\Factory\HandlerManagerFactory',
        'gdpro_monolog.manager.formatter' => 'GdproMonolog\Factory\FormatterManagerFactory',

        // Config
        'gdpro_monolog.config.logger' => 'GdproMonolog\Factory\Config\LoggerConfigFactory',
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
];