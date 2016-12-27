<?php
namespace GdproMonolog\Listener\Factory;

use GdproMonolog\Listener\LogRenderErrorListener;
use GdproMonolog\LoggerManager;
use Interop\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class LogRenderErrorListenerFactory
 * @package GdproMonolog\Listener\Factory
 */
class LogRenderErrorListenerFactory
{
    /**
     * @param ContainerInterface $services
     * @return LogRenderErrorListener
     */
    public function __invoke(ContainerInterface $services)
    {
        $loggerName = $this->getLoggerName($services);
        $loggerManager = $services->get(LoggerManager::class);
        $logger = $loggerManager->get($loggerName);

        $instance = new LogRenderErrorListener();
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
        if (isset($config['gdpro_monolog']['listeners']['log_render_error']['logger'])) {
            $loggerName = $globalConfig['gdpro_monolog']['listeners']['log_render_error']['logger'];
        }

        if (isset($config['monolog']['listeners']['log_render_error']['logger'])) {
            $loggerName = $globalConfig['monolog']['listeners']['log_render_error']['logger'];
        }

        return $loggerName;
    }
}
