<?php
namespace Frontend\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\NotEmpty;

class PostCategoryModel extends MasterModel
{

    public function __construct($services)
    {
        $this->tableName = 'post_category';
        $this->primary  = 'post_category_id';

        parent::__construct($services);
    }


}