<?php

namespace BiBoUser\Form;

use TmCommon\Common\CommonForm;


class BiBoUserForm extends CommonForm
{

    public function __construct($objectManager, $options)
    {
        parent::__construct($objectManager,$options->getBiBoUserEntityClass());
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'bibo-form');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'email_address',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Email Address',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Password',
            ),
        ));

        $this->add(array(
            'name' => 'username',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'User Name',
            ),
        ));

        $this->add(array(
            'name' => 'first_name',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'First Name',
            ),
        ));

        $this->add(array(
            'name' => 'last_name',
            'type' => 'Zend\Form\Element\Text',

            'options' => array(
                'label' => 'Last Name',
            ),
        ));
        $this->add(array(
            'name' => 'deleted_flag',
            'type' => 'Zend\Form\Element\Checkbox',

            'options' => array(
                'label' => 'Deleted Flag',
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