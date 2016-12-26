<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\LogRenderErrorListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;

class LogRenderErrorListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_render_error']['logger'];
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);


        $instance = new LogRenderErrorListener();
        $instance->setLogger($logger);

        return $instance;
    }
}
