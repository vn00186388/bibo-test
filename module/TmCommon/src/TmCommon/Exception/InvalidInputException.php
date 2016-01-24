<?php

namespace TmCommon\Exception;

use TmCommon\Common\CommonException;

class InvalidInputException extends CommonException
{
    public function __construct()
    {
        parent::__construct('Input is invalid');
    }
}
?>