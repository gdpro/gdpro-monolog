<?php
return [
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

        'formatters' => include 'formatters.config.php',
        'handlers' => include 'handlers.config.php',
        'loggers' => include 'loggers.config.php'
    ],

    'service_manager' => include 'service_manager.config.php'
];
