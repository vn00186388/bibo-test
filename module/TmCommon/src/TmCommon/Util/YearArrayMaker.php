<?php
/**
 * User: Tai
 *
 */

namespace TmCommon\Util;

class YearArrayMaker extends AbstractUtil
{

    protected $startYear;

    public function __construct($startYear)
    {
        $this->startYear = $startYear;
    }


    public function makeArray()
    {
        $years = array();
        $today = new \DateTime();
        $currentYear = $today->format('Y');
        for ($i = $currentYear; $i >= $this->getStartYear(); $i--) {
            $years[$i] = $i;
        }

        return $years;
    }

    /**
     * @param mixed $startYear
     */
    public function setStartYear($startYear)
    {
        $this->startYear = $startYear;
    }

    /**
     * @return mixed
     */
    public function getStartYear()
    {
        return $this->startYear;
    }


}