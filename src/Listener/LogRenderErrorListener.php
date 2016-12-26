<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class LogRenderErrorListener
 *
 * @package GdproMonolog\Listener
 */
class LogRenderErrorListener implements ListenerAggregateInterface
{
    /**
     * @var \Monolog\Logger
     */
    protected $logger;

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            [$this, 'onRenderError']
        );
    }

    /**
     * @param EventManagerInterface $events
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * @param MvcEvent $e
     */
    public function onRenderError(MvcEvent $e)
    {
        $resultVariables    = $e->getResult()->getVariables();
        $message            = $resultVariables['exception']->getMessage();

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
