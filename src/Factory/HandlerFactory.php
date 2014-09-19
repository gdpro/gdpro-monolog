<?php
namespace GdproMonolog\Factory;

class HandlerFactory
{
    public function create($config)
    {
        $handlerClass = $config['class'];
        $handlerFQCN = '\\Monolog\\Handler\\'.$handlerClass;

        $args = null;
        if(isset($config['args'])) {
            $args = $config['args'];
        }

        /** @var \Monolog\Handler\AbstractHandler $handler */
        if($handlerClass == 'StreamHandler') {
            $handler = new $handlerFQCN(
                $args['stream'],
                $args['level'],
                $args['bubble'],
                $args['file_permission'],
                $args['user_locking']
            );

            return $handler;
        }

        if($handlerClass == 'HipChatHandler') {
            $handler = new $handlerFQCN(
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