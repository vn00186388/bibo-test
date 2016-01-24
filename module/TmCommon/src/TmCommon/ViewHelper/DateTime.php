<?php

namespace TmCommon\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class DateTime extends AbstractHelper
{
    /**
     * invoke
     */
    public function __invoke($datetime)
    {
        if ($datetime != null) {
            return date_format($datetime, \TmCommon\Config\Config::DATE_TIME_FORMAT);
        }
        return null;
    }

}