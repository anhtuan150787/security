<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Category extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->add([
            'name' => 'category_name_vn',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Danh mục (VN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'category_name_en',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Danh mục (EN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'category_description_vn',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control description',
            ],
            'options' => [
                'label' => 'Mô tả (VI)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'category_description_en',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control description',
            ],
            'options' => [
                'label' => 'Mô tả (EN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'category_picture',
            'type' => 'file',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Hình',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);



        $this->add([
            'name' => 'category_parent',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Danh mục cha',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
                'disable_inarray_validator' => true,
            ],
        ]);


        $this->add([
            'name' => 'category_status',
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
            'category_name_vn' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
            'category_name_en' => [
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