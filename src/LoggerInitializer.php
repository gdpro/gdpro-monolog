<?php
namespace GdproMonolog\Service\Monolog;

use Zend\ServiceManager\InitializerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MonologInitializer implements InitializerInterface
{

    /**
     * Initialize
     *
     * @param $instance
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceof MonologAwareInterface) {
            $instance->setMonologService($serviceLocator->get('BlurMonologService'));
        }
    }
}