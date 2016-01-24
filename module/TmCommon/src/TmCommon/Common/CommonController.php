<?php

namespace TmCommon\Common;

use Zend\Mvc\Controller\AbstractActionController;

class CommonController extends AbstractActionController
{

    /**
     * instruction:  set success message, combined with PopupMessage view helper in layout
     */
    public function setSuccessMessage($message = null)
    {
        $popupMessageUtil = new \TmCommon\Util\PopupMessageUtil();
        $popupMessageUtil->setSuccessCode();
        if (!$message) {
            $message = \TmCommon\Config\Config::DEFAULT_VALUE_SUCCESS;
        }
        $popupMessageUtil->setMessage($message);
    }

    /**
     * instruction: set error message, combined with PopupMessage view helper in layout
     */
    public function setErrorMessage($message = null)
    {
        $popupMessageUtil = new \TmCommon\Util\PopupMessageUtil();
        $popupMessageUtil->setErrorCode();
        if (!$message) {
            $message = \TmCommon\Config\Config::DEFAULT_VALUE_ERROR;
        }
        $popupMessageUtil->setMessage($message);
    }

    public function query($name, $default = null)
    {
        return $this->params()->fromQuery($name, $default);
    }
}

