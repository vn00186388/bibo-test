<?php

namespace BiBoUser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OptionsFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $options = new \BiBoUser\Options();
//        $options->setLoginOptions($serviceLocator->get('OdiLoginOptions')) ;
        return $options;
    }
}