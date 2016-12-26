<?php
namespace GdproMonolog\Factory\Config;

use Interop\Container\ContainerInterface;

class HandlerConfigFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\HandlerConfig(
            $config['gdpro_monolog']['handlers']
        );
    }
}
