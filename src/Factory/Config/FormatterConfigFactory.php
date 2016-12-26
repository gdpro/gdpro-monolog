<?php
namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FormatterConfigFactory
 * @package GdproMonolog\Factory\Config
 */
class FormatterConfigFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Config\FormatterConfig
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\FormatterConfig(
            $config['gdpro_monolog']['formatters']
        );
    }
}
