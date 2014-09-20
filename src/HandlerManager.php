<?php
namespace GdproMonolog;

use GdproMonolog\Builder\HandlerBuilder;
use GdproMonolog\Config\HandlerConfig;

class HandlerManager
{
    protected $registeredHandlers = [];

    protected $handlerConfig;

    protected $handlerBuilder;

    protected $formatterManager;

    public function __construct(
        HandlerConfig $handlerConfig,
        HandlerBuilder $handlerBuilder,
        FormatterManager $formatterManager
    ) {
        $this->handlerConfig = $handlerConfig;
        $this->handlerBuilder = $handlerBuilder;
        $this->formatterManager = $formatterManager;
    }

    public function get($name = 'default')
    {
        if(isset($this->registeredHandlers[$name])) {
            return $this->registeredHandlers[$name];
        }

        $handlerConfig = $this->handlerConfig->get($name);
        $handlerClass = $handlerConfig['class'];
        $handlerArgs = $handlerConfig['args'];

        $handler = $this->handlerBuilder->build($handlerClass, $handlerArgs);

        $formatterName = $handlerConfig['formatter'];
        $formatter = $this->formatterManager->get($formatterName);
        $handler->setFormatter($formatter);

        $this->registeredHandlers[$name] = $handler;

        return $handler;
    }
}