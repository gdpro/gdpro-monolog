<?php
namespace GdproMonolog\Factory\Config;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormatterConfigFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\FormatterConfig(
            $config['gdpro_monolog']['formatters']
        );
    }
}
