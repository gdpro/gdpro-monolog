<?php
namespace GdproMonolog\Service\Monolog;

use Monolog\Logger;
use Monolog\Formatter\FormatterInterface;
use RuntimeException;
use Zend\Code\Reflection\ClassReflection;
use Zend\Log\LoggerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MonologFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var MonologOptions $options */
        $options = $serviceLocator->get('BlurMonologOptions');
        return $this->createLogger($serviceLocator, $options);
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param MonologOptions $options
     * @return Logger
     */
    public function createLogger(ServiceLocatorInterface $serviceLocator, MonologOptions $options)
    {
        $logger = new Logger($options->getName());

        foreach ($options->getHandlers() as $handler) {
            $logger->pushHandler($this->createHandler($serviceLocator, $handler));
        }

        return $logger;
    }

    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @param string|array $handler
     * @return LoggerInterface
     *
     * @throws RuntimeException
     */
    public function createHandler(ServiceLocatorInterface $serviceLocator, $handler)
    {
        if (is_string($handler) && $serviceLocator->has($handler)) {
            return $serviceLocator->get($handler);
        } else {
            if (!isset($handler['name'])) {
                throw new RuntimeException('Cannot create logger handler');
            }

            if (!class_exists($handler['name'])) {
                throw new RuntimeException('Cannot create logger handler (' . $handler['name'] . ')');
            }

            if (isset($handler['args'])) {
                if (!is_array($handler['args'])) {
                    throw new RuntimeException('Arguments of handler(' . $handler['name'] . ') must be array');
                }

                $reflection = new ClassReflection($handler['name']);

                $instance = call_user_func_array(array($reflection, 'newInstance'), $handler['args']);
            } else {
	            $class = $handler['name'];

	            $instance = new $class();
            }

	        if (isset($handler['formatter'])) {
		        $formatter = $this->createFormatter($serviceLocator, $handler['formatter']);
		        $instance->setFormatter($formatter);
	        }

            return $instance;
        }
    }

	/**
	 * @param ServiceLocatorInterface $serviceLocator
	 * @param string|array $formatter
	 * @return FormatterInterface
	 *
	 * @throws RuntimeException
	 */
	public function createFormatter(ServiceLocatorInterface $serviceLocator, $formatter)
	{
		if (is_string($formatter) && $serviceLocator->has($formatter)) {
			return $serviceLocator->get($formatter);
		} else {
			if (!isset($formatter['name'])) {
				throw new RuntimeException('Cannot create logger formatter');
			}

			if (!class_exists($formatter['name'])) {
				throw new RuntimeException('Cannot create logger formatter (' . $formatter['name'] . ')');
			}

			if (isset($formatter['args'])) {
				if (!is_array($formatter['args'])) {
					throw new RuntimeException('Arguments of formatter(' . $formatter['name'] . ') must be array');
				}

				$reflection = new ClassReflection($formatter['name']);

				return call_user_func_array(array($reflection, 'newInstance'), $formatter['args']);
			}

			$class = $formatter['name'];

			return new $class();
		}
	}
}
