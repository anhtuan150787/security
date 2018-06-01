<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Navigation extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);
    }

    public function getInputFilterSpecification()
    {
    }


}