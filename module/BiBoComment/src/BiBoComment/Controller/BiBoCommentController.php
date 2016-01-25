<?php

namespace BiBoComment\Controller;

use BiBoComment\Entity\BiBoComment;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class BiBoCommentController extends AbstractActionController
{

    protected $biboCommentService ;

    protected $biboCommentForm ;

    protected $options ;


    public function __construct($biboCommentService, $options, $biboCommentForm)
    {
        $this->biboCommentService = $biboCommentService;
        $this->options = $options;
        $this->biboCommentForm = $biboCommentForm ;
    }



    public function addAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        $form = $this->getBiBoCommentForm() ;
        $request = $this->getRequest();
        $container = new Container('user_login') ;

        if ($request->isPost()) {
            $comment = new BiBoComment() ;
            $form->setInputFilter($comment->getInputFilter()) ;
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBiBoCommentService()->addBiBoComment($form->getData(), $id, $form->getHydrator()) ;
                return $this->redirect()->toRoute('bi-bo-blog');
            }
        }
        return array('form' => $form, 'id' => $id);
    }







    public function setBiBoCommentService($biboCommentService) {
        $this->biboCommentService = $biboCommentService;
    }

    public function getBiBoCommentService() {
        return $this->biboCommentService;
    }

    /**
     * @param \BiBoComment\Options $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \BiBoComment\Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param \BiBoComment\Form\BiBoCommentForm $biboCommentForm
     */
    public function setBiBoCommentForm($biboCommentForm)
    {
        $this->biboCommentForm = $biboCommentForm;
    }

    /**
     * @return \BiBoComment\Form\BiBoCommentForm
     */
    public function getBiBoCommentForm()
    {
        return $this->biboCommentForm;
    }


}
