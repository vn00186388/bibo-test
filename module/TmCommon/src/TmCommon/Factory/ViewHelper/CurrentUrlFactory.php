<?php

namespace TmCommon\Factory\ViewHelper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CurrentUrlFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $viewHelper = new \TmCommon\ViewHelper\CurrentUrl();
        return $viewHelper;
    }
}