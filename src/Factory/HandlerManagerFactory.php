<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HandlerManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\HandlerManager(
            $services->get('gdpro_monolog.config.handler'),
            $services->get('gdpro_monolog.builder.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
