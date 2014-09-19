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
//        $moduleRouteListener = new ModuleRouteListener();
//        $moduleRouteListener->attach($eventManager);

//        $eventManager ->attach(new OnDispatchErrorListener());
//        $eventManager ->attach(new OnRenderErrorListener());


//        $eventManager->attach('dispatch.error', function($event){
//               var_dump('DISPATCH ERROR'); exit;
//
//                $exception = $event->getResult()->exception;
//                if ($exception) {
//                    $sm = $event->getApplication()->getServiceManager();
//                    $service = $sm->get('ApplicationServiceErrorHandling');
//                    $service->logException($exception);
//                }
//            });
//
//        $eventManager->attach('render.error', function($event){
//                var_dump('DISPATCH ERROR'); exit;
//
//                $exception = $event->getResult()->exception;
//                if ($exception) {
//                    $sm = $event->getApplication()->getServiceManager();
//                    $service = $sm->get('ApplicationServiceErrorHandling');
//                    $service->logException($exception);
//                }
//            });




//        $eventManager ->attach(new MonologListener());
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
