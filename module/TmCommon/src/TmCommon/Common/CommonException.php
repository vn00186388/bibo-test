<?php

namespace TmCommon\Common;

class CommonException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}

?>