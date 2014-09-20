<?php
namespace GdproMonolog\Factory\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LogRenderErrorListenerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_render_error']['logger'];

        return new \GdproMonolog\Listener\LogRenderErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
