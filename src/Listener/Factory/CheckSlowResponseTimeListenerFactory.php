<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\CheckSlowResponseTimeListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class CheckSlowResponseTimeListenerFactory
 * @package GdproMonolog\Listener\Factory
 */
class CheckSlowResponseTimeListenerFactory
{
    /**
     * @param ContainerInterface $services
     * @return CheckSlowResponseTimeListener
     */
    public function __invoke(ContainerInterface $services)
    {
        /** @var LoggerManager $loggerManager */
        /** @var LoggerInterface $logger */

        $loggerName = $this->getLoggerName($services);
        $threshold  = $this->getThresold($services);
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new CheckSlowResponseTimeListener();
        $instance->setThresold($threshold);
        $instance->setLogger($logger);

        return $instance;
    }

    /**
     * @param ContainerInterface $services
     * @return string|null
     */
    protected function getLoggerName(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');

        $loggerName = null;
        if (isset($config['gdpro_monolog']['listeners']['check_slow_response_time']['logger'])) {
            $loggerName = $globalConfig['gdpro_monolog']['listeners']['check_slow_response_time']['logger'];
        }

        if (isset($config['monolog']['listeners']['check_slow_response_time']['logger'])) {
            $loggerName = $globalConfig['monolog']['listeners']['check_slow_response_time']['logger'];
        }

        return $loggerName;
    }

    protected function getThresold(ContainerInterface $services)
    {
        $globalConfig = $services->get('config');

        $threshold = null;
        if (isset($globalConfig['gdpro_monolog']['listeners']['check_slow_response_time']['threshold'])) {
            $threshold = $globalConfig['gdpro_monolog']['listeners']['check_slow_response_time']['threshold'];
        }

        if (isset($globalConfig['monolog']['listeners']['check_slow_response_time']['threshold'])) {
            $threshold = $globalConfig['monolog']['listeners']['check_slow_response_time']['threshold'];
        }

        return $threshold;
    }
}
