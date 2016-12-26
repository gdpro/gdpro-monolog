<?php
namespace GdproMonolog\Factory;

use Interop\Container\ContainerInterface;

class FormatterManagerFactory
{
    public function __invoke(ContainerInterface $services)
    {
        return new \GdproMonolog\FormatterManager(
            $services->get('gdpro_monolog.config.formatter'),
            $services->get('gdpro_monolog.builder.formatter')
        );
    }
}
