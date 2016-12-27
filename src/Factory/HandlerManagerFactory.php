<?php
namespace GdproMonolog\Factory;

use GdproMonolog\Builder\HandlerBuilder;
use GdproMonolog\FormatterManager;
use GdproMonolog\HandlerManager;
use Interop\Container\ContainerInterface;

/**
 * Class HandlerManagerFactory
 * @package GdproMonolog\Factory
 */
class HandlerManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        /** @var FormatterManager $formatterManager */

        $config = $this->getConfig($services);
        $formatterManager = $services->get(FormatterManager::class);

        $instance = new HandlerManager();
        $instance->setConfig($config);
        $instance->setFormatterManager($formatterManager);

        return $instance;
    }

    /**
     * @param ContainerInterface $services
     * @return array
     */
    protected function getConfig(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');

        $config = [];
        if (isset($globalConfig['gdpro_monolog']['handlers'])) {
            $config = $globalConfig['gdpro_monolog']['handlers'];
        }

        if (isset($globalConfig['monolog']['handlers'])) {
            $config = array_merge_recursive($config, $globalConfig['monolog']['handlers']);
        }

        return $config;
    }
}
