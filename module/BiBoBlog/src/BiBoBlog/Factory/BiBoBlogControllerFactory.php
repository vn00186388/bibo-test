<?php

namespace BiBoBlog\Factory;

use BiBoBlog\Controller\BiBoBlogController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoBlogControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $controller = new BiBoBlogController(
            $serviceLocator->get('BiBoBlogService'),
            $serviceLocator->get('BiBoBlogOptions'),
            $serviceLocator->get('BiBoBlogForm')
        );
        return $controller;
    }
}