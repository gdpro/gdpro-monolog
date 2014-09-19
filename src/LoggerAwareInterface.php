<?php
namespace GdproMonolog;

use Monolog\Logger;

interface LoggerAwareInterface
{

    /**
     * @param Logger $loggerService
     * @return void
     */
    public function setLoggerService(Logger $loggerService);

    /**
     * @return Logger
     */
    public function getLoggerService();
}