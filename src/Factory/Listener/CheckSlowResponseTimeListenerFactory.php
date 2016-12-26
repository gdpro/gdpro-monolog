<?php
namespace GdproMonolog\Factory\Listener;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class CheckSlowResponseTimeListenerFactory
 * @package GdproMonolog\Factory\Listener
 */
class CheckSlowResponseTimeListenerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $services
     * @return \GdproMonolog\Listener\CheckSlowResponseTimeListener
     */
    public function createService(ServiceLocatorInterface $services)
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
