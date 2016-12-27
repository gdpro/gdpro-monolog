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
        $config = $this->getConfig($services);
        $handlerManager = $services->get(HandlerManager::class);
        $formatterManager = $services->get(FormatterManager::class);

        $instance = new LoggerManager();
        $instance->setConfig($config);
        $instance->setHandlerManager($handlerManager);
        $instance->setFormatterManager($formatterManager);

        return $instance;
    }

    protected function getConfig(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');

        $config = [];
        if(isset($globalConfig['gdpro_monolog']['loggers'])) {
            $config = array_merge_recursive($globalConfig['gdpro_monolog']['loggers']);
        }

        if(isset($globalConfig['monolog']['loggers'])) {
            $config = array_merge_recursive($globalConfig['monolog']['loggers']);
        }

        return $config;
    }
}
