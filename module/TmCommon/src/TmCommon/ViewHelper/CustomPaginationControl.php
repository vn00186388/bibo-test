<?php

namespace TmCommon\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class CustomPaginationControl extends AbstractHelper
{
    /**
     * invoke
     */
    public function __invoke($list, $queries = array())
    {
        $view = $this->getView();
        return $view->paginationControl($list, 'sliding', 'tm-common/partial/pagination-control.phtml', $queries);
    }

}