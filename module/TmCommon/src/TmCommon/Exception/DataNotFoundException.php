<?php

namespace TmCommon\Exception;

use TmCommon\Common\CommonException;

class DataNotFoundException extends CommonException
{
    public function __construct()
    {
        parent::__construct('Data not found');
    }
}
?>