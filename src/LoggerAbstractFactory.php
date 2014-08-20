<?php
namespace GdproMonolog;

use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LoggerAbstractFactory implements AbstractFactoryInterface
{

    /**
     * @var array
     */
    protected $config;

    /**
     * {@inheritdoc}
     */
    public function canCreateServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $this->getConfig($serviceLocator);
        return isset($config[$requestedName]);
    }

    /**
     * {@inheritdoc}
     */
    public function createServiceWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName)
    {
        $config = $this->getConfig($serviceLocator);

        $factory = new MonologFactory();
        return $factory->createLogger($serviceLocator, new LoggerOptions($config[$requestedName]));
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return array
     */
    public function getConfig(ServiceLocatorInterface $serviceLocator)
    {
        if (null !== $this->config) {
            return $this->config;
        }

        $config = $serviceLocator->get('config');

        if (isset($config['GdproMonolog'])) {
            $this->config = $config['GdproMonolog'];
        } else {
            $this->config = array();
        }

        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

}