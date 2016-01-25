<?php

namespace BiBoComment\Service;

use Doctrine\ORM\Tools\Pagination\Paginator;
use TmCommon\Common\CommonService ;

class BiBoCommentService extends CommonService
{

    /**
     * @var \BiBoComment\Options
     */
    protected $options;

    /**
     * @var \BiBoBlog\Service\BiBoBlogService
     */
    protected $biboBlogService ;

    /**
     * @param \BiBoBlog\Service\BiBoBlogService $biboBlogService
     */
    public function setBiBoBlogService($biboBlogService)
    {
        $this->biboBlogService = $biboBlogService;
    }


    /**
     * @return \BiBoBlog\Service\BiBoBlogService
     */
    public function getBiBoBlogService()
    {
        return $this->biboBlogService;
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

    public function listBiBoComments ($user, $offset = 0, $limit = 10) {

        $BiBoCommentEC = $this->getOptions()->getBiBoCommentEntityClass();

        $em = $this->getEntityManager() ;
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from($BiBoCommentEC, 'u')
            ->orderBy('u.createdAt','DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );

        return $paginator;

//        return $em->createQuery("SELECT di FROM ".$BiBoCommentEC." di JOIN di.user u where u.id =". $user->id. " order by di.createdAt DESC")->getResult() ;


//        $resultSet = $this->tableGateway->select();
//        return $resultSet;
    }




    public function getBiBoComment($id) {

        $BiBoCommentEC = $this->getOptions()->getBiBoCommentEntityClass();
        $em = $this->getEntityManager() ;
        return  $em->createQuery("SELECT di FROM ".$BiBoCommentEC." di  where di.id =".$id)->getSingleResult() ;
    }

    public function addBiBoComment($data, $blog_id, $hydrator) { //// IN service
        $BiBoCommentEC = $this->getOptions()->getBiBoCommentEntityClass();
        $BiBoComment = $hydrator->hydrate($data,new $BiBoCommentEC()) ;
        $BiBoComment->id = 0 ;

        $BiBoComment->blog = $this->getBiBoBlogService()->getBiBoBlog($blog_id) ;

        $BiBoComment->createdAt = new \DateTime("now");
        $BiBoComment->updatedAt = new \DateTime("now");

        $this->getEntityManager()->persist($BiBoComment);
        $this->getEntityManager()->flush();
        return $BiBoComment->id;
    }

    public function modifyBiBoComment ($data) {
        $data->updatedAt = new \DateTime("now");
//        $data->src = $this->getFileService()->getFile(0, 2, $user) == -1 ? "" : $this->getFileService()->getFile(0, 2, $user)->src ;
        $this->getEntityManager()->merge($data);
        $this->getEntityManager()->flush();
        return $data->id ;
    }
//
    public function removeBiBoComment($id) {
        $BiBoCommentEC = $this->getOptions()->getBiBoCommentEntityClass();

        $entity = $this->getEntityManager()->getRepository($BiBoCommentEC)->find($id) ;

        $this->getEntityManager()->remove($entity);

        $this->getEntityManager()->flush();
    }


}