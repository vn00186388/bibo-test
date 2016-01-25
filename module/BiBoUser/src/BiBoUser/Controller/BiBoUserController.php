<?php

namespace BiBoUser\Controller;

use BiBoUser\Entity\BiBoUser;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class BiBoUserController extends AbstractActionController
{

    protected $biboUserService ;

    protected $biboUserForm ;

    protected $options ;


    public function __construct($biboUserService, $options, $biboUserForm)
    {
        $this->biboUserService = $biboUserService;
        $this->options = $options;
        $this->biboUserForm = $biboUserForm ;
    }

    public function indexAction()
    {
        $request = $this->getRequest() ;

        if ($request->isPost()) {
            $data = $request->getPost() ;
            $user = $this->getBiBoUserService()->getBiBoUser($data['username'],$data['password']) ;
            if (!is_null($user)) {
                $container = new Container('user_login') ;
                $container->user = $user;
                return $this->redirect()->toRoute('bi-bo-blog');
            }
        }

    }

    public function addAction() {
        $form = $this->getBiBoUserForm() ;

        $request = $this->getRequest();

        if ($request->isPost()) {
            $user = new BiBoUser() ;
            $form->setInputFilter($user->getInputFilter()) ;
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBiBoUserService()->addBiBoUser($form->getData(), $form->getHydrator()) ;
                return $this->redirect()->toRoute('bi-bo-user');
            }


        }
        return array('form' => $form);
    }

    public function logoutAction() {
        $container = new Container('user_login') ;

        if (isset($container->user) && !is_null($container->user)) {
            unset($container->user) ;
        }
        else {
            return $this->redirect()->toRoute('bi-bo-user');
        }
    }



    public function setBiBoUserService($biboUserService) {
        $this->biboUserService = $biboUserService;
    }

    public function getBiBoUserService() {
        return $this->biboUserService;
    }

    /**
     * @param \BiBoUser\Options $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \BiBoUser\Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param \BiBoUser\Form\BiBoUserForm $biboUserForm
     */
    public function setBiBoUserForm($biboUserForm)
    {
        $this->biboUserForm = $biboUserForm;
    }

    /**
     * @return \BiBoUser\Form\BiBoUserForm
     */
    public function getBiBoUserForm()
    {
        return $this->biboUserForm;
    }


}
