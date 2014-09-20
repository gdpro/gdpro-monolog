<?php
namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class HandlerConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\HandlerConfig(
            $config['gdpro_monolog']['handlers']
        );
    }
}
