<?php
namespace GdproMonolog\Factory\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class LogRenderErrorListenerFactory
 * @package GdproMonolog\Factory\Listener
 */
class LogRenderErrorListenerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Listener\LogRenderErrorListener
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config     = $services->get('config');
        $loggerName = $config['gdpro_monolog']['listeners']['log_render_error']['logger'];

        return new \GdproMonolog\Listener\LogRenderErrorListener(
            $services->get('gdpro_monolog.manager')->get($loggerName)
        );
    }
}
