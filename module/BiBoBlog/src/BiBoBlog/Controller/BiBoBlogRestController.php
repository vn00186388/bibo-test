<?php
namespace BiBoBlog\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;

use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use BiBoBlog\Entity\BiBoBlog ;

class BiBoBlogRestController extends AbstractRestfulController {

    protected $biboBlogService ;

    protected $biboBlogForm ;

    protected $options ;

    public function __construct($biboBlogService, $options,$biboBlogForm ) {
        $this->biboBlogService = $biboBlogService;
        $this->options = $options;
        $this->biboBlogForm = $biboBlogForm ;
    }

    public function getList()
    {
//        $user = JWT::decode($this->_authorizationHeader,'thesecret') ;

        $data = $this->getBiboBlogService()->listBiBoBlogs(0,1000,1) ;
//        var_dump($data) ;
//        die() ;
        $json = new JsonModel($data) ;
        return $json;
    }

    public function get($id)
    {

        //$album = $this->getAlbumTable()->getAlbum($id);
        $blog = $this->getBiboBlogService()->getBiBoBlog($id,1) ;

        $json = new JsonModel($blog) ;
        return $json;
    }

    public function create($data)
    {
        $form = $this->getBiboBlogForm() ;
        $blog = new BiBoBlog() ;
        $form->setInputFilter($blog->getInputFilter());

        $form->setData($data);
        $user = new \stdClass() ;
        $user->username = 'hoangcai' ;
        $user->password = 'e10adc3949ba59abbe56e057f20f883e' ;

        $id = 1 ;
        if ($form->isValid()) {
            $id = $this->getBiboBlogService()->addBiBoBlog($form->getData(), $user, $form->getHydrator()); ////service call
//            $this->update($id, $form->getData()) ;
        }
        return $this->get($id) ;

    }

    public function update($id, $data)
    {
        $data['id'] = $id;

        $blog = $this->getBiboBlogService()->getBiBoBlog($id) ;

        $form = $this->getBiboBlogForm() ;
        $form->bind($blog) ;
        $form->setInputFilter($blog->getInputFilter());
        $form->setData($data);

        if ($form->isValid()) {
            $id = $this->getBiboBlogService()->modifyBiBoBlog($form->getData()); ////service call
        }

        return $this->get($id) ;
    }

    public function delete($id)
    {
        $this->getBiboBlogService()->removeBiBoBlog($id) ;
        //$this->getAlbumTable()->deleteAlbum($id);

        return new JsonModel(array(
            'data' => 'deleted',
        ));
    }

    /**
     * @return mixed
     */
    public function getBiboBlogService()
    {
        return $this->biboBlogService;
    }

    /**
     * @param mixed $biboBlogService
     */
    public function setBiboBlogService($biboBlogService)
    {
        $this->biboBlogService = $biboBlogService;
    }

    /**
     * @return mixed
     */
    public function getBiboBlogForm()
    {
        return $this->biboBlogForm;
    }

    /**
     * @param mixed $biboBlogForm
     */
    public function setBiboBlogForm($biboBlogForm)
    {
        $this->biboBlogForm = $biboBlogForm;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

}