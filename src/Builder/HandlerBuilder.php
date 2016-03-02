<?php

namespace GdproMonolog\Builder;

/**
 * Class HandlerBuilder
 * @package GdproMonolog\Builder
 */
class HandlerBuilder
{
    /**
     * @param $class
     * @param $args
     * @return mixed
     */
    public function build($class, $args)
    {
        $FQCN = '\\Monolog\\Handler\\'.$class;

        if($class == 'StreamHandler') {
            return new $FQCN(
                $args['stream'],
                $args['level'],
                $args['bubble'],
                $args['file_permission'],
                $args['user_locking']
            );
        }

        if($class == 'HipChatHandler') {
            return new $FQCN(
                $args['token'],
                $args['name'],
                $args['room'],
                $args['notify'],
                $args['level'],
                $args['bubble']
            );
        }
    }
}
