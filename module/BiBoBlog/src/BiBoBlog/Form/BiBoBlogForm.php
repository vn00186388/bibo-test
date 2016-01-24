<?php

namespace BiBoBlog\Form;

use TmCommon\Common\CommonForm;


class BiBoBlogForm extends CommonForm
{

    public function __construct($objectManager, $options)
    {
        parent::__construct($objectManager,$options->getBiBoBlogEntityClass());
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bibo-form');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Title',
            ),
        ));

        $this->add(array(
            'name' => 'slug',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Slug',
            ),
        ));

        $this->add(array(
            'name' => 'content',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Content',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),

        ));

    }



}