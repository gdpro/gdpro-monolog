<?php
namespace GdproMonolog\Factory\Listener;

use Interop\Container\ContainerInterface;

class CheckSlowResponseTimeListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config     = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['check_slow_response_time']['logger'];
        $threshold  = $config['gdpro_monolog']['listeners']['check_slow_response_time']['threshold'];

        return new \GdproMonolog\Listener\CheckSlowResponseTimeListener(
            $threshold,
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
