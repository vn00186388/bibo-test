<?php
/**
 * User: Tai
 * Date: 8/30/13
 * Time: 3:51 PM
 *
 */

namespace TmCommon\Util;

class PopupMessageUtil
{

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var \Zend\Session\Container
     */
    protected $sessionContainer;

    public function __construct()
    {
    }

    public function clear()
    {
        $session = new \Zend\Session\Container(\TmCommon\Config\Config::SESSION_NAMESPACE);
        $session->message = "";
    }

    public function setErrorCode()
    {
        $this->setCode(\TmCommon\Config\Config::POPUP_MESSAGE_ERROR_CODE);
    }

    public function setSuccessCode()
    {
        $this->setCode(\TmCommon\Config\Config::POPUP_MESSAGE_SUCCESS_CODE);
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        $session = $this->getSessionContainer();
        $session->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        $session = $this->getSessionContainer();
        $this->message = $session->message;
        return $this->message;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
        $session = $this->getSessionContainer();
        $session->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        $session = $this->getSessionContainer();
        $this->code = $session->code;
        return $this->code;
    }

    /**
     * @param \Zend\Session\Container $sessionContainer
     */
    public function setSessionContainer($sessionContainer)
    {
        $this->sessionContainer = $sessionContainer;
    }

    /**
     * @return \Zend\Session\Container
     */
    public function getSessionContainer()
    {
        if ($this->sessionContainer === null) {
            $this->sessionContainer = new \Zend\Session\Container(\TmCommon\Config\Config::SESSION_NAMESPACE);
        }
        return $this->sessionContainer;
    }


}