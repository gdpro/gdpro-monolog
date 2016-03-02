<?php

namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LoggerConfigFactory
 * @package GdproMonolog\Factory\Config
 */
class LoggerConfigFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Config\LoggerConfig
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\LoggerConfig(
            $config['gdpro_monolog']['loggers']
        );
    }
}
