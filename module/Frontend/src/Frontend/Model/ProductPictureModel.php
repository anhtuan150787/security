<?php
namespace Frontend\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\NotEmpty;

class ProductPictureModel extends MasterModel
{
    protected $inputFilter;

    public function __construct($services)
    {
        $this->tableName = 'product_picture';
        $this->primary  = 'product_picture_id';

        parent::__construct($services);
    }
}