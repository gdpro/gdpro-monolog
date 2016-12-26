<?php
namespace GdproMonolog\Factory;

use Interop\Container\ContainerInterface;

class HandlerManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        return new \GdproMonolog\HandlerManager(
            $services->get('gdpro_monolog.config.handler'),
            $services->get('gdpro_monolog.builder.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
