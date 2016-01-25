<?php

namespace BiBoComment\Factory;

use BiBoComment\Controller\BiBoCommentController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoCommentControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $controller = new BiBoCommentController(
            $serviceLocator->get('BiBoCommentService'),
            $serviceLocator->get('BiBoCommentOptions'),
            $serviceLocator->get('BiBoCommentForm')
        );
        return $controller;
    }
}