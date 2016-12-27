<?php
namespace GdproMonolog;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\Config\FormatterConfig;
use Monolog\Formatter\FormatterInterface;

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
     * @param string $name
     * @return FormatterInterface
     */
    public function get($name = 'default')
    {
        if (isset($this->registeredFormatters[$name])) {
            return $this->registeredFormatters[$name];
        }

        $formatterConfig = $this->config[$name];
        $formatterClass = $formatterConfig['class'];
        $formatterArgs = $formatterConfig['args'];
        $formatterFqcn = '\\Monolog\\Formatter\\'.$formatterClass;
        $reflection = new \ReflectionClass($formatterFqcn);
        $formatter = $reflection->newInstanceArgs($formatterArgs);

        return $this->registeredFormatters[$name] = $formatter;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
}
