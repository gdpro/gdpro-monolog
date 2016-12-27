<?php
namespace GdproMonolog;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Class Module
 * @package GdproMonolog
 */
class Module implements ConfigProviderInterface
{
    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
