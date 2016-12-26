<?php
namespace GdproMonolog;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\Config\FormatterConfig;

/**
 * Class FormatterManager
 *
 * @package GdproMonolog
 */
class FormatterManager
{
    /**
     * @var array
     */
    protected $registeredFormatters = [];

    /**
     * @var array
     */
    protected $config;

    /**
     * @var FormatterBuilder
     */
    protected $builder;

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name = 'default')
    {
        if (isset($this->registeredFormatters[$name])) {
            return $this->registeredFormatters[$name];
        }

        $formatterConfig    = $this->config[$name];
        $class              = $formatterConfig['class'];
        $args               = $formatterConfig['args'];
        $formatter          = $this->builder->build($class, $args);

        return $this->registeredFormatters[$name] = $formatter;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @param FormatterBuilder $builder
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }
}
