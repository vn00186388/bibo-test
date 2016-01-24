<?php
/**
 * User: Tai
 * Date: 10/29/13
 * Time: 4:17 PM
 *
 */

namespace TmCommon\Stdlib\Hydrator\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

class EntityIdentifyStrategy implements StrategyInterface
{
    /**
     * @var string
     */
    protected $idString;

    public function __construct($idString = 'id')
    {
        $this->idString = $idString;
    }

    public function extract($value)
    {
        if ($value && $value->id) {
            $idString = $this->getIdString();
            return $value->$idString;
        }

        return null;
    }

    public function hydrate($value)
    {
        return $value;
    }

    /**
     * @param string $idString
     */
    public function setIdString($idString)
    {
        $this->idString = $idString;
    }

    /**
     * @return string
     */
    public function getIdString()
    {
        return $this->idString;
    }


}