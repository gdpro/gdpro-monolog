<?php
namespace GdproMonolog;

use GdproMonolog\Listener\CheckSlowResponseTimeListener;
use GdproMonolog\Listener\LogDispatchErrorListener;
use GdproMonolog\Listener\LogMemoryUsageListener;
use GdproMonolog\Listener\LogRenderErrorListener;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * @package GdproMonolog
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $services = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $eventManager->attach(MvcEvent::EVENT_FINISH, [
            $services->get(CheckSlowResponseTimeListener::class),
            'onFinish'
        ]);

        $eventManager->attach(MvcEvent::EVENT_RENDER_ERROR, [
            $services->get(LogRenderErrorListener::class),
            'onRenderError'
        ]);

        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, [
            $services->get(LogDispatchErrorListener::class),
            'onDispatchError'
        ]);

        $eventManager->attach(MvcEvent::EVENT_FINISH, [
            $services->get(LogMemoryUsageListener::class),
            'onFinish'
        ]);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
