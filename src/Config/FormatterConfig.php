<?php
namespace GdproMonolog\Config;

class FormatterConfig extends \ArrayObject
{
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function get($name = 'default')
    {
        $defaultConfig = $this->config['default'];

        if($name == 'default') {
            return $defaultConfig;
        }

        $configName = $this->config[$name];

        $newConfig = array_replace_recursive($defaultConfig, $configName);

        return $newConfig;
    }
}