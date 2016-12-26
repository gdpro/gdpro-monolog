<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class FormatterManagerFactory
 * @package GdproMonolog\Factory
 */
class FormatterManagerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\FormatterManager
     */
    public function createService(ServiceLocatorInterface $services)
    {
        return new \GdproMonolog\FormatterManager(
            $services->get('gdpro_monolog.config.formatter'),
            $services->get('gdpro_monolog.builder.formatter')
        );
    }
}
