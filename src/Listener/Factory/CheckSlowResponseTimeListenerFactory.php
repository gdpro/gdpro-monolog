<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\CheckSlowResponseTimeListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;

class CheckSlowResponseTimeListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['check_slow_response_time']['logger'];
        $threshold  = $config['gdpro_monolog']['listeners']['check_slow_response_time']['threshold'];
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new CheckSlowResponseTimeListener();
        $instance->setThresold($threshold);
        $instance->setLogger($logger);

        return $instance;
    }
}
