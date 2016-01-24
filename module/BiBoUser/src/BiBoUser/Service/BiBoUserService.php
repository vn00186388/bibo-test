<?php

namespace BiBoUser\Service;

use Doctrine\ORM\NoResultException;
use TmCommon\Common\CommonService ;

class BiBoUserService extends CommonService
{

    /**
     * @var \BiBoUser\Options
     */
    protected $options;

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


    public function getBiBoUser($username, $password) {

        $result = null ;
        $BiBoUserEC = $this->getOptions()->getBiBoUserEntityClass();
        $em = $this->getEntityManager() ;
        try {
            $result = $em->createQuery("SELECT di FROM " . $BiBoUserEC . " di  where di.username ='" . $username . "' AND di.password='" . $password . "'")->getSingleResult();
        }
        catch(NoResultException $ex) {
            $result = null ;
        }
        return $result ;
    }

    public function addBiBoUser($data, $hydrator) { //// IN service
        $BiBoUserEC = $this->getOptions()->getBiBoUserEntityClass();
        $BiBoUser = $hydrator->hydrate($data,new $BiBoUserEC()) ;
        $BiBoUser->id = 0 ;
        $BiBoUser->createdAt = new \DateTime("now");
        $BiBoUser->updatedAt = new \DateTime("now");

        $this->getEntityManager()->persist($BiBoUser);
        $this->getEntityManager()->flush();
        return $BiBoUser->id;
    }

//    public function modifyBiBoUser ($data, $user) {
//        $data->updatedTime = new \DateTime("now");
//        $file = $this->getFileService()->getFile(0, 2, $user) ;
//        if ( $file  != null) {
//            $oldFile = $this->getFileService()->getFile($data->src, 4);
//            if ($oldFile != null) {
//                $this->getFileService()->removeFile($oldFile->id) ;
//            }
//            $data->src =  $file->src ;
//        }
////        $data->src = $this->getFileService()->getFile(0, 2, $user) == -1 ? "" : $this->getFileService()->getFile(0, 2, $user)->src ;
//        $this->getEntityManager()->merge($data);
//        $this->getEntityManager()->flush();
//        return $data->id ;
//    }
//
//    public function removeBiBoUser($id) {
//        $BiBoUserEC = $this->getOptions()->getBiBoUserEntityClass();
//
//        $entity = $this->getEntityManager()->getRepository($BiBoUserEC)->find($id) ;
//
//        $oldFile = $this->getFileService()->getFile($entity->src, 4);
//
//        if ($oldFile != null) {
//            $this->getFileService()->removeFile($oldFile->id) ;
//        }
//        $this->getEntityManager()->remove($entity);
//
//        $this->getEntityManager()->flush();
//    }


}