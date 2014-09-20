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
            $services->get('gdpro_monolog.manager.handler'),
//            new HandlerFactory(),
            $services->get('gdpro_monolog.manager.formatter')
//            new FormatterFactory(),
//            $services->get('gdpro_monolog.builder.logger')
//            new LoggerFactory()
        );
    }
}
