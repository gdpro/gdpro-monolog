<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LoggerManagerFactory
 * @package GdproMonolog\Factory
 */
class LoggerManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\LoggerManager
     */
    public function createService(ServiceLocatorInterface $services)
    {
        return new \GdproMonolog\LoggerManager(
            $services->get('gdpro_monolog.config.logger'),
            $services->get('gdpro_monolog.manager.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
