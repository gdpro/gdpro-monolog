<?php
namespace GdproMonolog\Factory;

class FormatterFactory
{
    public function create($config)
    {
        $formatterClass = $config['class'];
        $formatterFQCN = '\\Monolog\\Formatter\\'.$formatterClass;

        $args = null;
        if(isset($config['args'])) {
            $args = $config['args'];
        }

        if($formatterClass == 'LogstashFormatter') {
            $formatter = new $formatterFQCN($args['application']);
            return $formatter;
        }

        if($formatterClass == 'LineFormatter') {
            $formatter = new $formatterFQCN();
            return $formatter;
        }

        return null;
    }
}