<?php
namespace GdproMonolog\Builder;

/**
 * Class FormatterBuilder
 * @package GdproMonolog\Builder
 */
class FormatterBuilder
{
    public function build($class, $args)
    {
        $FQCN = '\\Monolog\\Formatter\\'.$class;

        if($class == 'LogstashFormatter') {
            $formatter = new $FQCN($args['application']);
            return $formatter;
        }

        if($class == 'LineFormatter') {
            $formatter = new $FQCN();
            return $formatter;
        }

        return null;
    }
}
