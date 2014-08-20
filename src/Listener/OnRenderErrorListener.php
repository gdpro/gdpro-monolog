<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class OnRenderErrorListener implements ListenerAggregateInterface
{
    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = array();

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER_ERROR,
            array($this, 'onRenderError')
        );
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onRenderError(MvcEvent $e)
    {
        var_dump('on render error'); exit;
        // create a log channel
        $log = new Logger('RENDER-ERROR');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }
}
