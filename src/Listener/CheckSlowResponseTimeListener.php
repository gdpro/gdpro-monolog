<?php
namespace GdproMonolog\Listener;

use GdproMonolog\Exception\LoggingException;
use Monolog\Logger;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class CheckSlowResponseTimeListener
 *
 * @package GdproMonolog\Listener
 */
class CheckSlowResponseTimeListener implements ListenerAggregateInterface
{
    /**
     * @var $startTime
     */
    protected $startTime;

    /**
     * Set the limit of time acceptable for the request
     *
     * @var $limit
     */
    protected $threshold;

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
        $this->startTime = microtime(true);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, [$this, 'onFinish']);
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
    public function onFinish(MvcEvent $e)
    {
        $endTime        = microtime(true);
        $elapsedTime    = ($endTime - $this->startTime) * 1000;

        if ($elapsedTime > $this->threshold) {
            $message = sprintf("%.0fms", $elapsedTime);

            try {
                $this->logger->info($message);
            } catch (\Exception $e) {
                $message = 'An Exception happenned while logging message for CheckSlowRespondTimeListener on action onFinish';
                throw new LoggingException($message, 500, $e);
            }
        }
    }

    /**
     * @param mixed $threshold
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
