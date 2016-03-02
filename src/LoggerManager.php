<?php

namespace GdproMonolog;

use GdproMonolog\Config\LoggerConfig;
use GdproMonolog\Proxy\LoggerProxy;
use Monolog\Logger;

/**
 * Class LoggerManager
 * @package GdproMonolog
 */
class LoggerManager
{
    /**
     * @var array
     */
    protected $registeredLoggers = [];

    /**
     * @var LoggerConfig
     */
    protected $loggerConfig;

    /**
     * @var HandlerManager
     */
    protected $handlerManager;

    /**
     * @var FormatterManager
     */
    protected $formatterManager;

    /**
     * LoggerManager constructor.
     * @param LoggerConfig $loggerConfig
     * @param HandlerManager $handlerManager
     * @param FormatterManager $formatterManager
     */
    public function __construct(
        LoggerConfig $loggerConfig,
        HandlerManager $handlerManager,
        FormatterManager $formatterManager
    ) {
        $this->loggerConfig     = $loggerConfig;
        $this->handlerManager   = $handlerManager;
        $this->formatterManager = $formatterManager;
    }

    /**
     * @param string $name
     * @return Logger
     */
    public function get($name = 'default')
    {
        if(isset($this->registeredLoggers[$name])) {
            return $this->registeredLoggers[$name];
        }

        $loggerConfig = $this->loggerConfig->get($name);

        $handlers       = [];
        $handlerNames   = $loggerConfig['handlers'];
        foreach($handlerNames as $handlerName) {
            $handler    = $this->handlerManager->get($handlerName);
            $handlers[] = $handler;
        }

        $processors = [];
        if(isset($loggerConfig['processors'])) {
            $processorNames = $loggerConfig['processors'];

            foreach($processorNames as $processorName) {
                $processorFQCN  = '\\Monolog\\Processor\\'.$processorName;
                $processor      = new $processorFQCN();
                $processors[]   = $processor;
            }
        }

        $logger = new Logger($loggerConfig['name'], $handlers, $processors);

        return $this->registeredLoggers[$name] = $logger;
    }
}
