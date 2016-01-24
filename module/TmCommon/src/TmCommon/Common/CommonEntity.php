<?php

namespace TmCommon\Common;

/**
 *  Abstract class for Entity
 */
class CommonEntity
{

    /**
     * constructor
     *
     * @param array $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function getArrayValue()
    {
        return get_object_vars($this);
    }

    /**
     * magic get method
     */
    public function __get($property)
    {
        $methodName1 = 'get' . $property;
        $methodName2 =  $property;
        if (method_exists($this, $methodName1)) {
            return $this->$methodName1();
        } elseif (method_exists($this, $methodName2)) {
            return $this->$methodName2();
        }

        throw new \Exception('Method not found');
    }

    /**
     * magic set method
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
    }



}

