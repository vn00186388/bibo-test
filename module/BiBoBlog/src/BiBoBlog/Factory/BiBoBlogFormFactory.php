<?php

namespace BiBoBlog\Factory;


use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BiBoBlogFormFactory implements FactoryInterface
{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $em = $serviceLocator->get('doctrine.entitymanager.orm_default');
        $options = $serviceLocator->get('BiBoBlogOptions');
        $form = new \BiBoBlog\Form\BiBoBlogForm($em, $options);
        return $form;
    }
}