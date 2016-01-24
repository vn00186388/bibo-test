<?php

namespace TmCommon\Common;

use \Zend\ServiceManager\ServiceManagerAwareInterface;
use \Doctrine\ORM\EntityManager;
use \Zend\ServiceManager\ServiceManager;

class CommonService implements ServiceManagerAwareInterface
{

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * @var mixed
     */
    protected $options;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct($entityManager = null)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManager|null
     * @throws \Exception
     */
    public function getEntityManager()
    {
        if (!$this->entityManager) {
            throw new \Exception('No entity manager is set.');
        }
        return $this->entityManager;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }




}

?>