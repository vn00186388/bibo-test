<?php

namespace TmCommon\Factory\ViewHelper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DialogErrorMessageFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $viewHelper = new \TmCommon\ViewHelper\DialogErrorMessage();
        return $viewHelper;
    }
}