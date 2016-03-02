<?php

namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class HandlerManagerFactory
 * @package GdproMonolog\Factory
 */
class HandlerManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\HandlerManager
     */
    public function createService(ServiceLocatorInterface $services)
    {
        return new \GdproMonolog\HandlerManager(
            $services->get('gdpro_monolog.config.handler'),
            $services->get('gdpro_monolog.builder.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
