<?php
namespace GdproMonolog\Factory;

use GdproMonolog\FormatterManager;
use GdproMonolog\HandlerManager;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;

class LoggerManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');
        $config = $globalConfig['gdpro_monolog']['logger'];
        $handlerManager = $services->get(HandlerManager::class);
        $formatterManager = $services->get(FormatterManager::class);

        $instance = new LoggerManager();
        $instance->setConfig($config);
        $instance->setHandlerManager($handlerManager);
        $instance->setFormatterManager($formatterManager);

        return $instance;
    }
}
