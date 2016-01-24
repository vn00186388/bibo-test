<?php

namespace TmCommon\Common;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;


class CommonForm extends Form
{
    public function __construct(ObjectManager $objectManager, $target)
    {
        parent::__construct();
        $this->setAttribute('method', 'post');
        $hydrator = new DoctrineObject($objectManager,$target);
        $this->setHydrator($hydrator);
    }

}