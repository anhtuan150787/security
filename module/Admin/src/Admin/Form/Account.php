<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Account extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->add([
            'name' => 'account_username',
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
            'name' => 'account_name',
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
            'name' => 'account_phone',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Điện thoại',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'account_picture',
            'type' => 'file',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Hình đại diện',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'account_email',
            'type' => 'email',
            'attributes' => [
                'class' => 'form-control',
                'required' => 'required',
            ],
            'options' => [
                'label' => 'Email',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add(array(
            'name' => 'account_password',
            'type' => 'Password',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mật khẩu',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ));

        $this->add(array(
            'name' => 'account_password_confirm',
            'type' => 'Password',
            'attributes' => [
                'class' => 'form-control',
                'data-validate-linked' => 'account_password',
            ],
            'options' => [
                'label' => 'Nhập lại Mật khẩu',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ));

        $this->add([
            'name' => 'group_account_id',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => [
                'class' => 'form-control required',
            ],
            'options' => [
                'label' => 'Nhóm',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
                'disable_inarray_validator' => true,
            ],
        ]);

        $this->add([
            'name' => 'account_status',
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
            'account_username' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
            'account_name' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'validators' => [$this->getValidateEmpty()]
            ],
            'account_email' => array(
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => [
                    $this->getValidateEmpty(),
                    $this->getValidateEmail(),
                ],
            ),
            'account_password' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'Stringtrim'],
                ],
                'validators' => [
                    $this->getValidateEmpty(),
                ]
            ],
            'account_picture' => [
                'required' => false,
                'allow_empty' => true,
                'validators' => [
                    $this->getValidatePictureSize(['max' => '1MB']),
                    $this->getValidatePictureExtension(['extension' => 'png,jpg,gif,jpeg']),
                ],
            ],
            'account_phone' => [
                'required' => false,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'Stringtrim'],
                ],
            ],
        ];

        return $inputFilter;
    }


}