<?php
namespace Blur\Service\Monolog;

use Zend\Stdlib\AbstractOptions;

class LoggerOptions extends AbstractOptions
{

    /**
     * Logger name
     *
     * @var string
     */
    protected $name = 'BlurMonolog';

    /**
     * Handlers
     *
     * @var array
     */
    protected $handlers = array();

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param array $handlers
     */
    public function setHandlers(array $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }



}