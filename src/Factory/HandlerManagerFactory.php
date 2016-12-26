<?php
namespace GdproMonolog\Factory;

use GdproMonolog\Builder\HandlerBuilder;
use GdproMonolog\FormatterManager;
use GdproMonolog\HandlerManager;
use Interop\Container\ContainerInterface;

class HandlerManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');
        $config = $globalConfig['gdpro_monolog']['handlers'];

        $builder = $services->get(HandlerBuilder::class);
        $formatterManager = $services->get(FormatterManager::class);

        $instance = new HandlerManager();
        $instance->setConfig($config);
        $instance->setBuilder($builder);
        $instance->setFormatterManager($formatterManager);

        return $instance;
    }
}
