<?php
namespace GdproMonolog;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Mvc\MvcEvent;

class MonologListener implements ListenerAggregateInterface
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
        $priority = 1;
        $this->listeners[] = $events->attach(MvcEvent::EVENT_ROUTE, array($this, 'onRoute'), $priority);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'), $priority);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER, array($this, 'onRender'), $priority);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), $priority);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_RENDER_ERROR, array($this, 'onRenderError'), $priority);
        $this->listeners[] = $events->attach(MvcEvent::EVENT_FINISH, array($this, 'onFinish'), $priority);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $listener) {
            if ($events->detach($listener)) {
                unset($this->listeners[$index]);
            }
        }
    }

    public function onDispatchError(MvcEvent $e) {
        if(!$e->isError()) {
            return;
        }

        // create a log channel
        $log = new Logger('DISPATCH-ERROR');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }

    public function onRenderError(MvcEvent $e)
    {
        // create a log channel
        $log = new Logger('RENDER-ERROR');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }

    public function onRender(MvcEvent $e) {
        if(!$e->isError()) {
            return;
        }

        // create a log channel
        $log = new Logger('RENDER');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }

    public function onDispatch(MvcEvent $e) {
        if(!$e->isError()) {
            return;
        }

        // create a log channel
        $log = new Logger('DISPATCH');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }

    public function onFinish(MvcEvent $e)
    {
        if(!$e->isError()) {
            return;
        }

        // create a log channel
        $log = new Logger('FINISH');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }

    public function onRoute(MvcEvent $e)
    {
        if(!$e->isError()) {
            return;
        }

        // create a log channel
        $log = new Logger('ROUTE');
        $log->pushHandler(new StreamHandler('data/log/default-error.log', Logger::ERROR));

        $resultVariables = $e->getResult()->getVariables();

        // add records to the log
        $log->addError('Request URI: '.$e->getRequest()->getRequestUri());
        $log->addError('Exception: '.$resultVariables['exception']->getMessage());
        $log->addError($e->getError());
    }
}