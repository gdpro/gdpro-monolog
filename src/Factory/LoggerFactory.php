<?php
namespace GdproMonolog\Factory;

class LoggerFactory
{
    public function create($config)
    {

        $logger = new Logger($config['name']);


        foreach ($options->getHandlers() as $handler) {
            $logger->pushHandler($this->createHandler($serviceLocator, $handler));
        }

        return $logger;
    }
}
