<?php

namespace BiBoBlog\Controller;

use BiBoBlog\Entity\BiBoBlog;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\View\Model\ViewModel;

class BiBoBlogController extends AbstractActionController
{

    protected $biboBlogService ;

    protected $biboBlogForm ;

    protected $options ;


    public function __construct($biboBlogService, $options, $biboBlogForm)
    {
        $this->biboBlogService = $biboBlogService;
        $this->options = $options;
        $this->biboBlogForm = $biboBlogForm ;
    }

    public function indexAction()
    {
        $page = $this->params()->fromRoute('page', 1);

        $limit = 10;
        $offset = ($page == 0) ? 0 : ($page - 1) * $limit;

        $container = new Container('user_login') ;

        $blogs = $this->getBiBoBlogService()->listBiBoBlogs($container->user, $offset, $limit) ;

        return new ViewModel(array(
            'blogs' => $blogs,
            'page' => $page
        ));

    }

    public function addAction() {
        $form = $this->getBiBoBlogForm() ;
        $request = $this->getRequest();
        $container = new Container('user_login') ;

        if ($request->isPost()) {
            $blog = new BiBoBlog() ;
            $form->setInputFilter($blog->getInputFilter()) ;
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBiBoBlogService()->addBiBoBlog($form->getData(), $container->user, $form->getHydrator()) ;
                return $this->redirect()->toRoute('bi-bo-blog');
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        $container = new Container('user_login') ;

        if (!$id) {
            return $this->redirect()->toRoute('bi-bo-blog', array(
                'action' => 'add'
            ));
        }

        // Get the Album with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $blog = $this->getBiBoBlogService()->getBiBoBlog($id);

        }
        catch (\Exception $ex) {
            return $this->redirect()->toRoute('bi-bo-blog', array(
                'action' => 'index'
            ));
        }

        $form = $this->getBiBoBlogForm() ;
        $form->bind($blog);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($blog->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getBiBoBlogService()->modifyBiBoBlog($form->getData()) ;

                // Redirect to list of albums
                return $this->redirect()->toRoute('bi-bo-blog');
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('bi-bo-blog');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->getBiBoBlogService()->removeBiBoBlog($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('bi-bo-blog');
        }

        return array(
            'id'    => $id,
            'blog' => $this->getBiBoBlogService()->getBiBoBlog($id)
        );
    }



    public function setBiBoBlogService($biboBlogService) {
        $this->biboBlogService = $biboBlogService;
    }

    public function getBiBoBlogService() {
        return $this->biboBlogService;
    }

    /**
     * @param \BiBoBlog\Options $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return \BiBoBlog\Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param \BiBoBlog\Form\BiBoBlogForm $biboBlogForm
     */
    public function setBiBoBlogForm($biboBlogForm)
    {
        $this->biboBlogForm = $biboBlogForm;
    }

    /**
     * @return \BiBoBlog\Form\BiBoBlogForm
     */
    public function getBiBoBlogForm()
    {
        return $this->biboBlogForm;
    }


}
