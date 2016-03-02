<?php

namespace GdproMonolog;

use GdproMonolog\Builder\HandlerBuilder;
use GdproMonolog\Config\HandlerConfig;

/**
 * Class HandlerManager
 * @package GdproMonolog
 */
class HandlerManager
{
    /**
     * @var array
     */
    protected $registeredHandlers = [];

    /**
     * @var HandlerConfig
     */
    protected $handlerConfig;

    /**
     * @var HandlerBuilder
     */
    protected $handlerBuilder;

    /**
     * @var FormatterManager
     */
    protected $formatterManager;

    /**
     * HandlerManager constructor.
     * @param HandlerConfig $handlerConfig
     * @param HandlerBuilder $handlerBuilder
     * @param FormatterManager $formatterManager
     */
    public function __construct(
        HandlerConfig $handlerConfig,
        HandlerBuilder $handlerBuilder,
        FormatterManager $formatterManager
    ) {
        $this->handlerConfig    = $handlerConfig;
        $this->handlerBuilder   = $handlerBuilder;
        $this->formatterManager = $formatterManager;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name = 'default')
    {
        if(isset($this->registeredHandlers[$name])) {
            return $this->registeredHandlers[$name];
        }

        $handlerConfig  = $this->handlerConfig->get($name);
        $handlerClass   = $handlerConfig['class'];
        $handlerArgs    = $handlerConfig['args'];
        $handler        = $this->handlerBuilder->build($handlerClass, $handlerArgs);
        $formatterName  = $handlerConfig['formatter'];
        $formatter      = $this->formatterManager->get($formatterName);

        $handler->setFormatter($formatter);

        return $this->registeredHandlers[$name] = $handler;
    }
}
