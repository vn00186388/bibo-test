<?php

namespace TmCommon\Exception;

use TmCommon\Common\CommonException;

class NoPrivilegeException extends CommonException
{
    public function __construct()
    {
        parent::__construct('Not enough privilege');
    }
}
?>