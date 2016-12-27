<?php
namespace GdproMonolog\Listener;

use Psr\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class LogRenderErrorListener
 * @package GdproMonolog\Listener
 */
class LogRenderErrorListener
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param MvcEvent $e
     */
    public function onRenderError(MvcEvent $e)
    {
        $resultVariables = $e->getResult()->getVariables();
        $message = $resultVariables['exception']->getMessage();

        $this->logger->error($message);
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
