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
        /** @var HandlerBuilder $builder */
        /** @var FormatterManager $formatterManager */

        $config = $this->getConfig($services);
        $builder = $services->get(HandlerBuilder::class);
        $formatterManager = $services->get(FormatterManager::class);

        $instance = new HandlerManager();
        $instance->setConfig($config);
        $instance->setBuilder($builder);
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
            $config = array_merge_recursive($globalConfig['gdpro_monolog']['handlers']);
        }

        if (isset($globalConfig['monolog']['handlers'])) {
            $config = array_merge_recursive($globalConfig['monolog']['handlers']);
        }

        return $config;
    }
}
