<?php
namespace GdproMonolog;

use GdproMonolog\Builder\HandlerBuilder;
use GdproMonolog\Config\HandlerConfig;
use Monolog\Handler\HandlerInterface;

/**
 * Class HandlerManager
 *
 * @package GdproMonolog
 */
class HandlerManager
{
    /**
     * @var array
     */
    protected $registeredHandlers = [];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var FormatterManager
     */
    protected $formatterManager;

    /**
     * @param string $name
     * @return HandlerInterface
     */
    public function get($name = 'default')
    {
        if (isset($this->registeredHandlers[$name])) {
            return $this->registeredHandlers[$name];
        }

        $defaultConfig = $this->config['default'];
        $handlerConfig = array_replace_recursive($defaultConfig, $this->config[$name]);

        $handlerClass = $handlerConfig['class'];
        $handlerArgs = $handlerConfig['args'];
        $handler = call_user_func_array('\\Monolog\\Handler\\'.$handlerClass, $handlerArgs);

        $formatterName = $handlerConfig['formatter'];
        $formatter = $this->formatterManager->get($formatterName);

        $handler->setFormatter($formatter);

        return $this->registeredHandlers[$name] = $handler;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param HandlerBuilder $builder
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param FormatterManager $formatterManager
     */
    public function setFormatterManager($formatterManager)
    {
        $this->formatterManager = $formatterManager;
    }
}
