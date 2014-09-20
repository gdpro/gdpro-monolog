<?php
namespace GdproMonolog\Factory\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogDispatchErrorListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];

        return new \GdproMonolog\Listener\LogDispatchErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
