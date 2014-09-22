<?php
namespace GdproMonolog;

use GdproMonolog\Config\LoggerConfig;
use GdproMonolog\Proxy\LoggerProxy;
use Monolog\Logger;

class LoggerManager
{
    protected $registeredLoggers = [];

    protected $loggerConfig;

    protected $handlerManager;

    protected $formatterManager;

    public function __construct(
        LoggerConfig $loggerConfig,
        HandlerManager $handlerManager,
        FormatterManager $formatterManager
    ) {
        $this->loggerConfig = $loggerConfig;
        $this->handlerManager = $handlerManager;
        $this->formatterManager = $formatterManager;
    }

    public function get($name = 'default')
    {
        if(isset($this->registeredLoggers[$name])) {
            return $this->registeredLoggers[$name];
        }

        $loggerConfig = $this->loggerConfig->get($name);

        $handlers = [];
        $handlerNames = $loggerConfig['handlers'];
        foreach($handlerNames as $handlerName) {
            $handler = $this->handlerManager->get($handlerName);

            $handlers[] = $handler;
        }

        $processors = [];
        if(isset($loggerConfig['processors'])) {
            $processorNames = $loggerConfig['processors'];

            foreach($processorNames as $processorName) {
                $processorFQCN = '\\Monolog\\Processor\\'.$processorName;
                $processor = new $processorFQCN();
                $processors[] = $processor;
            }
        }

        $logger = new Logger($loggerConfig['name'], $handlers, $processors);

        $this->registeredLoggers[$name] = $logger;

        return $logger;
    }
}
