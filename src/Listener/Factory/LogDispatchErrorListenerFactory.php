<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\LogDispatchErrorListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;

class LogDispatchErrorListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config  = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new LogDispatchErrorListener();
        $instance->setLogger($logger);

        return $instance;
    }
}
