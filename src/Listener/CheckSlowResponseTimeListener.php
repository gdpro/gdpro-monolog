<?php
namespace GdproMonolog\Listener;

use GdproMonolog\Exception\LoggingException;
use Psr\Log\LoggerInterface;
use Zend\Mvc\MvcEvent;

/**
 * Class CheckSlowResponseTimeListener
 * @package GdproMonolog\Listener
 */
class CheckSlowResponseTimeListener
{
    /**
     * @var int $startTime
     */
    protected $startTime;

    /**
     * Set the limit of time acceptable for the request
     *
     * @var int $limit
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
     * @param int $threshold
     */
    public function setThreshold($threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }
}
