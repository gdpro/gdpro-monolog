<?php
namespace GdproMonolog\Factory;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\FormatterManager;
use Interop\Container\ContainerInterface;

/**
 * Class FormatterManagerFactory
 * @package GdproMonolog\Factory
 */
class FormatterManagerFactory
{
    /**
     * @param ContainerInterface $services
     * @return FormatterManager
     */
    public function __invoke(ContainerInterface $services)
    {
        /** @var FormatterBuilder $builder */

        $config = $this->getConfig($services);
        $builder = $services->get(FormatterBuilder::class);

        $instance = new FormatterManager();
        $instance->setConfig($config);
        $instance->setBuilder($builder);

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
        if(isset($globalConfig['gdpro_monolog']['formatters'])) {
            $config = array_merge_recursive($globalConfig['gdpro_monolog']['formatters']);
        }

        if(isset($globalConfig['monolog']['formatters'])) {
            $config = array_merge_recursive($globalConfig['monolog']['formatters']);
        }

        return $config;
    }
}
