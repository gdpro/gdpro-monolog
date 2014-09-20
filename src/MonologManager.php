<?php
namespace GdproMonolog;

use Monolog\Logger;

class MonologManager
{
    protected $config;
    protected $handlerManager;
    protected $formatterManager;

    public function __construct(
        array $config,
        HandlerManager $handlerManager,
        FormatterManager $formatterManager
    ) {
        $this->config = $config;
        $this->handlerManager = $handlerManager;
        $this->formatterManager = $formatterManager;
    }

    public function get($name = 'default')
    {
        if(!isset($this->config['loggers'][$name])) {
            $name = 'default';
        }

        $loggerConfig = $this->config['loggers'][$name];

        $handlers = [];
        $handlerNames = $loggerConfig['handlers'];
        foreach($handlerNames as $handlerName) {
            $handler = $this->handlerManager->get($handlerName);

            $handlers[] = $handler;
        }

        $processorNames = null;
        if(isset($loggerConfig['processors'])) {
            $processorNames = $loggerConfig['processors'];
        }

        $processors = [];
        foreach($processorNames as $processorName) {
            $processorFQCN = '\\Monolog\\Processor\\'.$processorName;
            $processor = new $processorFQCN();
            $processors[] = $processor;
        }

        $logger = new Logger($loggerConfig['name'], $handlers, $processors);

        return $logger;
    }
}
