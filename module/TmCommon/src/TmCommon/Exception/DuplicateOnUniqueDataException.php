<?php

namespace TmCommon\Exception;

use TmCommon\Common\CommonException;

class DuplicateOnUniqueDataException extends CommonException
{
    public function __construct()
    {
        parent::__construct('Many entries on unique one');
    }
}
?>