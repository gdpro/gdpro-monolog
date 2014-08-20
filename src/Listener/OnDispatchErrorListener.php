<?php
namespace GdproMonolog\Listener;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class OnDispatchErrorListener implements ListenerAggregateInterface
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
            MvcEvent::EVENT_DISPATCH_ERROR,
            array($this, 'onDispatchError')
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

    public function onDispatchError(MvcEvent $e)
    {

        var_dump($e->isError());
        exit;

        $this->

            // create a log channel
            $log = new Logger('DISPATCH-ERROR');
        $log->pushHandler(
            new StreamHandler('data/log/default-error.log', Logger::ERROR)
        );

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: ' . $e->getRequest()->getRequestUri());
        $log->addError(
            'Exception: ' . $resultVariables['exception']->getMessage()
        );
        $log->addError($e->getError());
    }


}