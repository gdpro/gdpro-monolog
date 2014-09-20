<?php
namespace GdproMonolog;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use GdproMonolog\Listener\OnDispatchErrorListener;
use GdproMonolog\Listener\OnRenderErrorListener;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $services = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attachAggregate($services->get('gdpro_monolog.listener.check_slow_response_time'));
        $eventManager->attachAggregate($services->get('gdpro_monolog.listener.log_render_error'));
        $eventManager->attachAggregate($services->get('gdpro_monolog.listener.log_dispatch_error'));
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src',
                ),
            ),
        );
    }
}
