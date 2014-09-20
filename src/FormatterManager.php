<?php
namespace GdproMonolog;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\Config\FormatterConfig;

class FormatterManager
{
    protected $registeredFormatters = [];

    protected $formatterConfig;

    protected $formatterBuilder;

    public function __construct(
        FormatterConfig $formatterConfig,
        FormatterBuilder $formatterBuilder
    ) {
        $this->formatterConfig = $formatterConfig;
        $this->formatterBuilder = $formatterBuilder;
    }

    public function get($name = 'default')
    {
        if(isset($this->registeredFormatters[$name])) {
            return $this->registeredFormatters[$name];
        }

        $formatterConfig = $this->formatterConfig->get($name);
        $class = $formatterConfig['class'];
        $args = $formatterConfig['args'];

        $formatter = $this->formatterBuilder->build($class, $args);

        $this->registeredFormatters[$name] = $formatter;

        return $formatter;
    }
}