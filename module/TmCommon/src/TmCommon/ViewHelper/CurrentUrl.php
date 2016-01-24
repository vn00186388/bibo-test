<?php

namespace TmCommon\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class CurrentUrl extends AbstractHelper
{
    /**
     * invoke
     */
    public function __invoke()
    {
        return urlencode($_SERVER['REQUEST_URI']);
    }

}