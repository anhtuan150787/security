<?php
namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Captcha;
use Zend\Captcha\Image as CaptchaImage;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class Main extends Form implements InputFilterProviderInterface
{
    protected $inputFilter;
    protected $captcha;

    protected $validateEmpty;
    protected $validateEmail;
    protected $validateRecordExists;
    protected $validatePictureSize;
    protected $validatePictureExtension;

    protected $service;

    public function init($service = null, $name = null)
    {
        parent::init($service, $name);

        $this->service = $service;

        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        $this->add([
            'name' => 'frmReset',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Làm lại',
                'id' => 'frmReset',
                'class' => 'btn btn-primary',
            ],
        ]);

        $this->add([
            'name' => 'frmSubmit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Thêm mới',
                'id' => 'frmSubmit',
                'class' => 'btn btn-success',
            ],
        ]);

        $this->getCaptcha();
    }

    public function getInputFilterSpecification() {}

    public function getValidateEmpty()
    {
        $this->validateEmpty = [
            'name' => 'not_empty',
            'options' => [
                'messages' => [
                    NotEmpty::IS_EMPTY => 'Vui lòng nhập thông tin',
                ]
            ],
            'break_chain_on_failure' => true,
        ];

        return $this->validateEmpty;
    }

    public function getValidateEmail()
    {
        $this->validateEmail = [
            'name' => 'EmailAddress',
            'options' => [
                'messages' => [
                    EmailAddress::INVALID => 'Email không đúng định dạng',
                    EmailAddress::INVALID_HOSTNAME => 'Email không đúng định dạng',
                    EmailAddress::INVALID_FORMAT => 'Email không đúng định dạng',
                    EmailAddress::INVALID_LOCAL_PART => 'Email không đúng định dạng',
                    EmailAddress::INVALID_MX_RECORD => 'Email không đúng định dạng',
                    EmailAddress::INVALID_SEGMENT => 'Email không đúng định dạng',
                ]
            ]
        ];

        return $this->validateEmail;
    }

    public function getValidateRecordExists($params)
    {
        $this->validateRecordExists = [
            'name' => 'Db\NoRecordExists',
            'options' => [
                'table' => $params['table'],
                'field' => $params['field'],
                'adapter' => $this->service->get('Zend/Db/Adapter/Adapter'),
                'messages' => [
                    NoRecordExists::ERROR_RECORD_FOUND => 'Email đã tồn tại. Vui lòng nhập Email khác',
                ],
            ],
        ];

        return $this->validateRecordExists;
    }

    public function getValidatePictureSize($params)
    {
        $this->validatePictureSize = [
            'name' => 'Zend\Validator\File\Size',
            'options' => [
                'max' => $params['max'],
            ],
        ];

        return $this->validatePictureSize;
    }

    public function getValidatePictureExtension($params)
    {
        $this->validatePictureExtension = [
            'name' => 'Zend\Validator\File\Extension',
            'options' => [
                'extension' => $params['extension'],
            ],
        ];

        return $this->validatePictureExtension;
    }

    public function getCaptcha()
    {
        $configCaptcha = include 'config/captcha.php';
        $this->captcha = new CaptchaImage($configCaptcha);

        return $this;
    }
}