<?php
namespace GdproMonolog\Listener;

use Psr\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class LogDispatchErrorListener
 * @package GdproMonolog\Listener
 */
class LogDispatchErrorListener
{
    /**
     * @var LoggerInterface
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
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
