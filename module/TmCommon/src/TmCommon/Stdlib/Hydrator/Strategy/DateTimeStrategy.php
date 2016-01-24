<?php

namespace TmCommon\Stdlib\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class DateTimeStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    protected $format;

    public function __construct($format = 'd.m.Y')
    {
        $this->format = $format;
    }

    public function extract($value)
    {
        if ($value instanceof \DateTime) {
            return $value->format($this->getFormat());
        }
        return "";
    }

    public function hydrate($value)
    {
        return $value;
    }

    /**
     * @param string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }


}