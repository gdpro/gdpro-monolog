<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class FormatterManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\FormatterManager(
            $services->get('gdpro_monolog.config.formatter'),
            $services->get('gdpro_monolog.builder.formatter')
        );
    }
}
