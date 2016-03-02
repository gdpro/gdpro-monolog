<?php

namespace GdproMonolog\Builder;

/**
 * Class FormatterBuilder
 * @package GdproMonolog\Builder
 */
class FormatterBuilder
{
    /**
     * @param $class
     * @param $args
     * @return mixed
     */
    public function build($class, $args)
    {
        $FQCN = '\\Monolog\\Formatter\\'.$class;

        if($class == 'LogstashFormatter') {
            return new $FQCN($args['application']);
        }

        if($class == 'LineFormatter') {
            return new $FQCN();
        }
    }
}
