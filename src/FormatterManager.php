<?php
namespace GdproMonolog;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\Config\FormatterConfig;

/**
 * Class FormatterManager
 * @package GdproMonolog
 */
class FormatterManager
{
    /**
     * @var array
     */
    protected $registeredFormatters = [];

    /**
     * @var FormatterConfig
     */
    protected $formatterConfig;

    /**
     * @var FormatterBuilder
     */
    protected $formatterBuilder;

    /**
     * FormatterManager constructor.
     * @param FormatterConfig $formatterConfig
     * @param FormatterBuilder $formatterBuilder
     */
    public function __construct(
        FormatterConfig $formatterConfig,
        FormatterBuilder $formatterBuilder
    ) {
        $this->formatterConfig  = $formatterConfig;
        $this->formatterBuilder = $formatterBuilder;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name = 'default')
    {
        if(isset($this->registeredFormatters[$name])) {
            return $this->registeredFormatters[$name];
        }

        $formatterConfig    = $this->formatterConfig->get($name);
        $class              = $formatterConfig['class'];
        $args               = $formatterConfig['args'];
        $formatter          = $this->formatterBuilder->build($class, $args);

        return $this->registeredFormatters[$name] = $formatter;
    }
}
