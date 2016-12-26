<?php
namespace GdproMonolog\Factory\Config;

use Interop\Container\ContainerInterface;

class LoggerConfigFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\LoggerConfig(
            $config['gdpro_monolog']['loggers']
        );
    }
}
