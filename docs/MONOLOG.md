Monolog Documentation
=====================

Default Logger
--------------
<code php>
    $this->getServiceLocator()->get('gdpro-monolog_default')->addDebug('hello world');
</code>


Exception Logger
--------------
<code php>
    $this->getServiceLocator()->get('my_awesome_customized_logger')->addDebug('hello world');
</code>


Create a logger specific to your application
--------------------------------------------
In the file module.config.file add the following code and replace {MyApplication} by the name of your application.
<code php>
'{MyApplication}\Service\Monolog\Default' => [
    'name' => '{MyApplication} Default Logger',
    'handlers' => [
        'default' => [
            'name' => 'Monolog\Handler\StreamHandler',
            'args' => [
                'path' => 'data/log/{MyApplication}.default.log',
                'level' => \Monolog\Logger::DEBUG,
                'bubble' => true
            ],
            'formatter' => [
                'name' => 'Monolog\Formatter\LogstashFormatter',
                'args' => [
                    'application' => '{MyApplication}',
                ],
            ],
        ],
    ]
],
</code>

