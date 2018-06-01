<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Acl extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->add([
            'name' => 'acl_name',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Tên',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'acl_parent',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Root',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
                'disable_inarray_validator' => true,
            ],
        ]);

        $this->add([
            'name' => 'acl_module',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Module',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'acl_controller',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Controller',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'acl_action',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Action',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'acl_status',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Trạng thái',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
                'disable_inarray_validator' => true,
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        parent::getInputFilterSpecification();

        $inputFilter = [
            'acl_name' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
        ];

        return $inputFilter;
    }


}