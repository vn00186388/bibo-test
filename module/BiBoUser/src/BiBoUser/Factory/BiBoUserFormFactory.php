<?php

namespace BiBoUser\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoUserFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $options = $serviceLocator->get('BiBoUserOptions');
        $form = new \BiBoUser\Form\BiBoUserForm($em, $options);
        return $form;
    }
}