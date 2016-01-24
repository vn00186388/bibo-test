<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/BiBoBlog for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace BiBoBlog;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\FormElementProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;


class Module implements AutoloaderProviderInterface, ConfigProviderInterface,
    ServiceProviderInterface, FormElementProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(

            'factories' => array(
                'BiBoBlogOptions' => '\BiBoBlog\Factory\OptionsFactory',
                'BiBoBlogService' => '\BiBoBlog\Factory\BiBoBlogServiceFactory',
                'BiBoBlogForm' => '\BiBoBlog\Factory\BiBoBlogFormFactory',
            )
        );
    }

    public function getFormElementConfig()
    {
        return array(
            'factories' => array()
        );
    }
}
