<?php
namespace GdproMonolog\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MonologManagerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $gdproMonologConfig = $config['gdpro_monolog'];

        return new \GdproMonolog\MonologManager(
            $gdproMonologConfig,
            new HandlerFactory(),
            new FormatterFactory(),
            new LoggerFactory()
        );
    }
}
