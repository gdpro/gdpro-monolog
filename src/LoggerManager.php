<?php
namespace GdproMonolog;

use GdproMonolog\Config\LoggerConfig;
use GdproMonolog\Proxy\LoggerProxy;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class LoggerManager
 *
 * @package GdproMonolog
 */
class LoggerManager
{
    /**
     * @var array
     */
    protected $registeredLoggers = [];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var HandlerManager
     */
    protected $handlerManager;

    /**
     * @var FormatterManager
     */
    protected $formatterManager;

    /**
     * @param string $name
     * @return LoggerInterface
     */
    public function get($name = 'default')
    {
        if (isset($this->registeredLoggers[$name])) {
            return $this->registeredLoggers[$name];
        }

        $loggerConfig = $this->config[$name];

        $handlers = [];
        $handlerNames = $loggerConfig['handlers'];
        foreach ($handlerNames as $handlerName) {
            $handler = $this->handlerManager->get($handlerName);
            $handlers[] = $handler;
        }

        $processors = [];
        if (isset($loggerConfig['processors'])) {
            $processorNames = $loggerConfig['processors'];

            foreach ($processorNames as $processorName) {
                $processorFQCN = '\\Monolog\\Processor\\'.$processorName;
                $processor = new $processorFQCN();
                $processors[] = $processor;
            }
        }

        $logger = new Logger($loggerConfig['name'], $handlers, $processors);

        return $this->registeredLoggers[$name] = $logger;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param HandlerManager $handlerManager
     */
    public function setHandlerManager($handlerManager)
    {
        $this->handlerManager = $handlerManager;
    }

    /**
     * @param FormatterManager $formatterManager
     */
    public function setFormatterManager($formatterManager)
    {
        $this->formatterManager = $formatterManager;
    }
}
