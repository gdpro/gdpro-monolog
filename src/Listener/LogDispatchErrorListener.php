<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Zend\Mvc\MvcEvent;

/**
 * Class LogDispatchErrorListener
 * @package GdproMonolog\Listener
 */
class LogDispatchErrorListener
{
    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * @param MvcEvent $e
     */
    public function onDispatchError(MvcEvent $e)
    {
        $exception = $e->getParam('exception');

        if (! $exception instanceof \Exception) {
            return;
        }

        $this->logger->error($exception->getTraceAsString());
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
