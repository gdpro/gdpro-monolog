<?php
namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class HandlerConfigFactory
 * @package GdproMonolog\Factory\Config
 */
class HandlerConfigFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Config\HandlerConfig
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\HandlerConfig(
            $config['gdpro_monolog']['handlers']
        );
    }
}
