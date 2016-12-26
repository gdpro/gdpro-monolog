<?php
namespace GdproMonolog\Config;

/**
 * Class HandlerConfig
 * @package GdproMonolog\Config
 */
class HandlerConfig
{
    /**
     * @var array
     */
    protected $config;

    /**
     * HandlerConfig constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     * @return array
     */
    public function get($name = 'default')
    {
        $defaultConfig = $this->config['default'];

        if($name == 'default') {
            return $defaultConfig;
        }

        return array_replace_recursive($defaultConfig, $this->config[$name]);
    }
}
