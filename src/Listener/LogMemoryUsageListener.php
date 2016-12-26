<?php
namespace GdproMonolog\Listener;

use Zend\Mvc\MvcEvent;

/**
 * Class LogMemoryUsageListener
 * @package GdproMonolog\Listener
 */
class LogMemoryUsageListener
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
     * @param MvcEvent $e
     */
    public function onFinish(MvcEvent $e)
    {
        $message = memory_get_usage();

        $this->logger->info($message);
    }
}
