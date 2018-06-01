<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Post extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->add([
            'name' => 'post_title_vn',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Tiêu đề (VN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'post_title_en',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Tiêu đề (EN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'post_quote_vn',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control description',
            ],
            'options' => [
                'label' => 'Tóm tắt (VN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'post_quote_en',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control description',
            ],
            'options' => [
                'label' => 'Tóm tắt (EN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);


        $this->add([
            'name' => 'post_body_vn',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control content',
            ],
            'options' => [
                'label' => 'Nội dung (VN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'post_body_en',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => [
                'class' => 'form-control content',
            ],
            'options' => [
                'label' => 'Nội dung (EN)',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);


        $this->add([
            'name' => 'category_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Danh mục',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
                'disable_inarray_validator' => true,
            ],
        ]);

        $this->add([
            'name' => 'post_picture',
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
            'name' => 'post_status',
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
            'post_title_vn' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
            'post_title_en' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
            'category_id' => [
                'required' => false,
            ],
        ];


        return $inputFilter;
    }


}