<?php
namespace GdproMonolog\Factory\Config;

use Interop\Container\ContainerInterface;

class FormatterConfigFactory
{
    public function __invoke(ContainerInterface $services)
    {
        $config = $services->get('config');

        return new \GdproMonolog\Config\FormatterConfig(
            $config['gdpro_monolog']['formatters']
        );
    }
}
