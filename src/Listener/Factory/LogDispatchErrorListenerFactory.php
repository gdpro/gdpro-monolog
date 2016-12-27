<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\LogDispatchErrorListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class LogDispatchErrorListenerFactory
 * @package GdproMonolog\Listener\Factory
 */
class LogDispatchErrorListenerFactory
{
    /**
     * @param ContainerInterface $services
     * @return LogDispatchErrorListener
     */
    public function __invoke(ContainerInterface $services)
    {
        /** @var LoggerManager $loggerManager */
        /** @var LoggerInterface $logger */

        $loggerName = $this->getLoggerName($services);
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new LogDispatchErrorListener();
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
        if (isset($config['gdpro_monolog']['listeners']['log_dispatch_error']['logger'])) {
            $loggerName = $globalConfig['gdpro_monolog']['listeners']['log_dispatch_error']['logger'];
        }

        if (isset($config['monolog']['listeners']['log_dispatch_error']['logger'])) {
            $loggerName = $globalConfig['monolog']['listeners']['log_dispatch_error']['logger'];
        }

        return $loggerName;
    }
}
