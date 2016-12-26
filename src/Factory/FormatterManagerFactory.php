<?php
namespace GdproMonolog\Factory;

use GdproMonolog\Builder\FormatterBuilder;
use GdproMonolog\FormatterManager;
use Interop\Container\ContainerInterface;

class FormatterManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');
        $config = $globalConfig['gdpro_monolog']['formatter'];
        $builder = $services->get(FormatterBuilder::class);

        $instance = new FormatterManager();
        $instance->setConfig($config);
        $instance->setBuilder($builder);

        return $instance;
    }
}
