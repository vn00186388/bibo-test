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

    public function listBiBoBlogs ($offset = 0, $limit = 10, $option = 0) {

        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();

        $em = $this->getEntityManager() ;

        if (!$option) {
            $qb = $em->createQueryBuilder();

            $qb->select('u')
                ->from($BiBoBlogEC, 'u')
                ->orderBy('u.createdAt','DESC')
                ->setMaxResults($limit)
                ->setFirstResult($offset);

            $query = $qb->getQuery();

            $paginator = new Paginator( $query );

            return $paginator;
        }
        else {
            return $em->createQuery("SELECT di FROM ".$BiBoBlogEC." di order by di.createdAt DESC")->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY) ;
        }
    }

    public function getBiBoBlog($id, $option = 0) {

        $BiBoBlogEC = $this->getOptions()->getBiBoBlogEntityClass();
        $em = $this->getEntityManager() ;
        if (!$option)
            return  $em->createQuery("SELECT di FROM ".$BiBoBlogEC." di  where di.id =".$id)->getSingleResult() ;
        else {
            $data = $em->createQuery("SELECT di FROM ".$BiBoBlogEC." di  where di.id =".$id)->getSingleResult(\Doctrine\ORM\Query::HYDRATE_ARRAY) ;

            $data['createdAt'] = date_format($data['createdAt'],DATETIME_FORMAT) ;
            $data['updatedAt'] = date_format($data['updatedAt'], DATETIME_FORMAT) ;

            return $data ;

        }
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