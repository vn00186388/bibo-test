<?php

namespace BiBoUser;


class Options
{

    /**
     * @var string
     */
    protected $biboUserEntityClass = '\BiBoUser\Entity\BiBoUser';
    
    /**
     * @param string $biboUserEntityClass
     */
    public function setbiboUserEntityClass($biboUserEntityClass)
    {
        $this->biboUserEntityClass = $biboUserEntityClass;
    }

    /**
     * @return string
     */
    public function getbiboUserEntityClass()
    {
        return $this->biboUserEntityClass;
    }


}