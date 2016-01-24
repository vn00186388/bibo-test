<?php

namespace TmCommon\Factory\ViewHelper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CustomPaginationControlFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $viewHelper = new \TmCommon\ViewHelper\CustomPaginationControl();
        return $viewHelper;
    }
}