<?php
namespace Zf2Monolog;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MonologFactory implements FactoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $monologConfig = $config['monolog'];

        // create a log channel
        $log = new Logger('name');


        $log->pushHandler(new StreamHandler('path/to/your.log', Logger::WARNING));

// add records to the log-
        $log->addWarning('Foo');
        $log->addError('Bar');

    }
}