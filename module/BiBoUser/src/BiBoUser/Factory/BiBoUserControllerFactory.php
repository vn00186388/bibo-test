<?php

namespace BiBoUser\Factory;

use BiBoUser\Controller\BiBoUserController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoUserControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $controller = new BiBoUserController(
            $serviceLocator->get('BiBoUserService'),
            $serviceLocator->get('BiBoUserOptions'),
            $serviceLocator->get('BiBoUserForm')
        );
        return $controller;
    }
}