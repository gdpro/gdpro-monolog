<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class LogDispatchErrorListener
 *
 * @package GdproMonolog\Listener
 */
class LogDispatchErrorListener implements ListenerAggregateInterface
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
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'onDispatchError']);
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
