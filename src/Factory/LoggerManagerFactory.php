<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggerManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\LoggerManager(
            $services->get('gdpro_monolog.config.logger'),
            $services->get('gdpro_monolog.manager.handler'),
            $services->get('gdpro_monolog.manager.formatter')
        );
    }
}
