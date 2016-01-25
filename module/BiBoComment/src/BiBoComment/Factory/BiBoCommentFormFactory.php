<?php

namespace BiBoComment\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoCommentFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $options = $serviceLocator->get('BiBoCommentOptions');
        $form = new \BiBoComment\Form\BiBoCommentForm($em, $options);
        return $form;
    }
}