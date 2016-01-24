<?php

namespace TmCommon\ViewHelper;

use Zend\View\Helper\AbstractHelper;

class DialogErrorMessage extends AbstractHelper
{
    /**
     * invoke
     */
    public function __invoke()
    {
        $popupMessageUtil = new \TmCommon\Util\PopupMessageUtil();
        $message = $popupMessageUtil->getMessage();
        $code = $popupMessageUtil->getCode();
        $popupMessageUtil->clear();
        return $this->getView()->partial('tm-common/partial/dialog-error-message', array(
            'message' => $message,
            'code' => $code,
        ));
    }

}