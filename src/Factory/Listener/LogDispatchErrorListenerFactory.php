<?php
namespace GdproMonolog\Factory\Listener;

use Interop\Container\ContainerInterface;

class LogDispatchErrorListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config     = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];

        return new \GdproMonolog\Listener\LogDispatchErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
