<?php
namespace GdproMonolog;

use GdproMonolog\Factory\FormatterFactory;
use GdproMonolog\Factory\HandlerFactory;
use GdproMonolog\Factory\LoggerFactory;
use Monolog\Logger;

class MonologManager
{
    protected $config;
    protected $handlerFactory;
    protected $formatterFactory;
    protected $loggerFactory;

    public function __construct(
        array $config,
        HandlerFactory $handlerFactory,
        FormatterFactory $formatterFactory,
        LoggerFactory $loggerFactory
    ) {
        $this->config = $config;
        $this->handlerFactory = $handlerFactory;
        $this->formatterFactory = $formatterFactory;
        $this->loggerFactory = $loggerFactory;
    }

    public function get($name = 'default')
    {
        if(!isset($this->config['loggers'][$name])) {
            return null;
        }

        $loggerConfig = $this->config['loggers'][$name];

        $handlers = [];
        $handlerNames = $loggerConfig['handlers'];
        foreach($handlerNames as $handlerName) {
            $handlerConfig = $this->config['handlers'][$handlerName];

            $handler = $this->handlerFactory->create($handlerConfig);

            if(!isset($handler)) continue;

            $formatterName =  $handlerConfig['formatter'];
            $formatterConfig = $this->config['formatters'][$formatterName];

            $formatter = $this->formatterFactory->create($formatterConfig);

            if(isset($formatter)) {
                $handler->setFormatter($formatter);
            }

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
