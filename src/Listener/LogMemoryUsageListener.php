<?php
namespace GdproMonolog\Listener;

use Psr\Log\LoggerInterface;
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
     * @var LoggerInterface
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
