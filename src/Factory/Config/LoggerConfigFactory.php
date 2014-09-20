<?php
namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggerConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\LoggerConfig(
            $config['gdpro_monolog']['loggers']
        );
    }
}
