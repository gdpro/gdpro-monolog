<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Zend\Mvc\MvcEvent;

/**
 * Class LogRenderErrorListener
 * @package GdproMonolog\Listener
 */
class LogRenderErrorListener
{
    /**
     * @var \Monolog\Logger
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
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
