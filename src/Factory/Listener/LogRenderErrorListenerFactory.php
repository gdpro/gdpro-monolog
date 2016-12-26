<?php
namespace GdproMonolog\Factory\Listener;

use Interop\Container\ContainerInterface;

class LogRenderErrorListenerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config     = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_render_error']['logger'];

        return new \GdproMonolog\Listener\LogRenderErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
