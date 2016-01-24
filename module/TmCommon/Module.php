<?php

namespace TmCommon;

use \Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use \Zend\ModuleManager\Feature\ConfigProviderInterface;
use \Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements
    AutoloaderProviderInterface, ConfigProviderInterface, ServiceProviderInterface
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'CustomPaginationControl' => '\TmCommon\Factory\ViewHelper\CustomPaginationControlFactory',
                'CurrentUrl' => '\TmCommon\Factory\ViewHelper\CurrentUrlFactory',
                'PopupMessage' => '\TmCommon\Factory\ViewHelper\PopupMessageFactory',
                'DialogErrorMessage' => '\TmCommon\Factory\ViewHelper\DialogErrorMessageFactory',
                'DateTime' =>'\TmCommon\Factory\ViewHelper\DateTimeFactory',
                'DisplayTime' =>'\TmCommon\Factory\ViewHelper\DisplayTimeFactory',
            ),
        );
    }
}
