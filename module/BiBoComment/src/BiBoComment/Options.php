<?php

namespace BiBoComment;


class Options
{

    /**
     * @var string
     */
    protected $biboCommentEntityClass = '\BiBoComment\Entity\BiBoComment';
    
    /**
     * @param string $biboCommentEntityClass
     */
    public function setbiboCommentEntityClass($biboCommentEntityClass)
    {
        $this->biboCommentEntityClass = $biboCommentEntityClass;
    }

    /**
     * @return string
     */
    public function getbiboCommentEntityClass()
    {
        return $this->biboCommentEntityClass;
    }


}