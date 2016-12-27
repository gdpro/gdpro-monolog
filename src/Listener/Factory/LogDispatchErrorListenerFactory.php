<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\LogDispatchErrorListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;

class LogDispatchErrorListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $loggerName = $this->getLoggerName($services);
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new LogDispatchErrorListener();
        $instance->setLogger($logger);

        return $instance;
    }

    protected function getLoggerName(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');

        $loggerName = null;
        if(isset($config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'])) {
            $loggerName = $globalConfig['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];
        }

        if(isset($config['monolog']['listeners']['log_dispatch_error']['logger'])) {
            $loggerName = $globalConfig['monolog']['listeners']['log_dispatch_error']['logger'];
        }

        return $loggerName;
    }
}
