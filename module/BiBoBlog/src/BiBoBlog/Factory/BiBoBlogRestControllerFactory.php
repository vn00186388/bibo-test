<?php

namespace BiBoBlog\Factory;

use BiBoBlog\Controller\BiBoBlogRestController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoBlogRestControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $controller = new BiBoBlogRestController(
            $serviceLocator->get('BiBoBlogService'),
            $serviceLocator->get('BiBoBlogOptions'),
            $serviceLocator->get('BiBoBlogForm')
        );
        return $controller;
    }
}