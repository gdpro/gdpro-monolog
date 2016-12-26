<?php
namespace GdproMonolog\Factory;

use Interop\Container\ContainerInterface;

class LoggerManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        return new \GdproMonolog\LoggerManager(
            $services->get('gdpro_monolog.config.logger'),
            $services->get('gdpro_monolog.manager.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
