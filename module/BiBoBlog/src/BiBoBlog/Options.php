<?php

namespace BiBoBlog;


class Options
{

    /**
     * @var string
     */
    protected $biboBlogEntityClass = '\BiBoBlog\Entity\BiBoBlog';
    
    /**
     * @param string $biboBlogEntityClass
     */
    public function setbiboBlogEntityClass($biboBlogEntityClass)
    {
        $this->biboBlogEntityClass = $biboBlogEntityClass;
    }

    /**
     * @return string
     */
    public function getbiboBlogEntityClass()
    {
        return $this->biboBlogEntityClass;
    }


}