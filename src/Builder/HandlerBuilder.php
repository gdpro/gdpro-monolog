<?php
namespace GdproMonolog\Builder;

class HandlerBuilder
{
    public function build($class, $args)
    {
        $FQCN = '\\Monolog\\Handler\\'.$class;

        /** @var \Monolog\Handler\AbstractHandler $handler */
        if($class == 'StreamHandler') {
            $handler = new $FQCN(
                $args['stream'],
                $args['level'],
                $args['bubble'],
                $args['file_permission'],
                $args['user_locking']
            );

            return $handler;
        }

        if($class == 'HipChatHandler') {
            $handler = new $FQCN(
                $args['token'],
                $args['name'],
                $args['room'],
                $args['notify'],
                $args['level'],
                $args['bubble']
            );

            return $handler;
        }

        return null;
    }
}