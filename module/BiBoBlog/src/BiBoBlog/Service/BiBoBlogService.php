<?php

namespace BiBoBlog\Service;

use Doctrine\ORM\Tools\Pagination\Paginator;
use TmCommon\Common\CommonService ;

class BiBoBlogService extends CommonService
{

    /**
     * @var \BiBoBlog\Options
     */
    protected $options;

    /**
     * @var \BiBoUser\Service\BiBoUserService
     */
    protected $biboUserService ;

    /**
     * @param \BiBoUser\Service\BiBoUserService $biboUserService
     */
    public function setBiBoUserService($biboUserService)
    {
        $this->biboUserService = $biboUserService;
    }


    /**
     * @return \BiBoUser\Service\BiBoUserService
     */
    public function getBiBoUserService()
    {
        return $this->biboUserService;
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

    public function listBiBoBlogs ($user, $offset = 0, $limit = 10) {

        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();

        $em = $this->getEntityManager() ;
        $qb = $em->createQueryBuilder();

        $qb->select('u')
            ->from($BiBoBlogEC, 'u')
            ->orderBy('u.createdAt','DESC')
            ->setMaxResults($limit)
            ->setFirstResult($offset);

        $query = $qb->getQuery();

        $paginator = new Paginator( $query );

        return $paginator;

//        return $em->createQuery("SELECT di FROM ".$BiBoBlogEC." di JOIN di.user u where u.id =". $user->id. " order by di.createdAt DESC")->getResult() ;


//        $resultSet = $this->tableGateway->select();
//        return $resultSet;
    }




    public function getBiBoBlog($id) {

        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();
        $em = $this->getEntityManager() ;
        return  $em->createQuery("SELECT di FROM ".$BiBoBlogEC." di  where di.id =".$id)->getSingleResult() ;
    }

    public function addBiBoBlog($data, $user, $hydrator) { //// IN service
        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();
        $BiBoBlog = $hydrator->hydrate($data,new $BiBoBlogEC()) ;
        $BiBoBlog->id = 0 ;
        $BiBoBlog->user = $this->getBiBoUserService()->getBiBoUser($user->username,$user->password) ;

        $BiBoBlog->createdAt = new \DateTime("now");
        $BiBoBlog->updatedAt = new \DateTime("now");

        $this->getEntityManager()->persist($BiBoBlog);
        $this->getEntityManager()->flush();
        return $BiBoBlog->id;
    }

    public function modifyBiBoBlog ($data) {
        $data->updatedAt = new \DateTime("now");
//        $data->src = $this->getFileService()->getFile(0, 2, $user) == -1 ? "" : $this->getFileService()->getFile(0, 2, $user)->src ;
        $this->getEntityManager()->merge($data);
        $this->getEntityManager()->flush();
        return $data->id ;
    }
//
    public function removeBiBoBlog($id) {
        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();

        $entity = $this->getEntityManager()->getRepository($BiBoBlogEC)->find($id) ;

        $this->getEntityManager()->remove($entity);

        $this->getEntityManager()->flush();
    }


}