<?php
namespace Admin\Form;

use Zend\Form\Form;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class WebsiteEmail extends Main
{
    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->add([
            'name' => 'website_email_system_name',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'System name',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'website_email_system_host',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Host',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'website_email_system_port',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Port',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'website_email_system_username',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Tài khoản',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'website_email_system_password',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'Mật khẩu',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);

        $this->add([
            'name' => 'website_email_system_ssl',
            'type' => 'Text',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options' => [
                'label' => 'SSL',
                'label_attributes' => ['class' => 'control-label col-md-2 col-sm-2 col-xs-12'],
            ],
        ]);
    }

    public function getInputFilterSpecification()
    {
        parent::getInputFilterSpecification();

        $inputFilter = [
            'website_email_system_name' => [
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