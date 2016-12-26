<?php
namespace GdproMonolog\Factory\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LogDispatchErrorListenerFactory
 * @package GdproMonolog\Factory\Listener
 */
class LogDispatchErrorListenerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Listener\LogDispatchErrorListener
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config     = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];

        return new \GdproMonolog\Listener\LogDispatchErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
