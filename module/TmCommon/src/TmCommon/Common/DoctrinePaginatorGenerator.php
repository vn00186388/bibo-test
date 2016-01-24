<?php

namespace TmCommon\Common;

class DoctrinePaginatorGenerator
{
    /**
     * @var \Doctrine\ORM\Query
     */
    protected $doctrineQuery;

    /**
     * @var array
     */
    protected $arrayResults;

    /**
     * @var int
     */
    protected $limit;

    /**
     * @var int
     */
    protected $page;

    /**
     * @var \Zend\Paginator\Paginator
     */
    protected $paginator;

    /**
     * @param int $limit
     * @param int $page
     * @param boolean $isArray
     * @param mixed $target
     */
    public function __construct($target, $page = 0, $limit = 0, $isArray = false)
    {
        $this->limit = $limit;
        $this->page = $page;

        // different adapters : Array results or Doctrine query
        $adapter = null;
        if ($isArray) {
            $this->arrayResults = $target;
            $arrayCollection = new \Doctrine\Common\Collections\ArrayCollection($target);
            $adapter = new \DoctrineModule\Paginator\Adapter\Collection ($arrayCollection);
        } else {
            $this->doctrineQuery = $target;
            $adapter = new \DoctrineORMModule\Paginator\Adapter\DoctrinePaginator (
                new \Doctrine\ORM\Tools\Pagination\Paginator($target));

        }
        $paginator = new \Zend\Paginator\Paginator($adapter);

        if (!$limit) {
            $limit = \TmCommon\Config\Config::DEFAULT_PAGE_ITEMS_LIMIT;
        }
        $paginator->setItemCountPerPage($limit);

        if (!$page) {
            $page = 1;
        }
        $paginator->setCurrentPageNumber($page);

        $this->paginator = $paginator;
    }

    /**
     * @param \Doctrine\ORM\Query
     */
    public function setDoctrineQuery($doctrineQuery)
    {
        $this->doctrineQuery = $doctrineQuery;
    }

    /**
     * @return \Doctrine\ORM\Query
     */
    public function getDoctrineQuery()
    {
        return $this->doctrineQuery;
    }


    /**
     * @param int $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param \Zend\Paginator\Paginator $paginator
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return \Zend\Paginator\Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param array $arrayResults
     */
    public function setArrayResults($arrayResults)
    {
        $this->arrayResults = $arrayResults;
    }

    /**
     * @return array
     */
    public function getArrayResults()
    {
        return $this->arrayResults;
    }

}