<?php
namespace Frontend\Model;

use Zend\Validator\NotEmpty;

class ProductCategoryModel extends MasterModel
{

    public function __construct($services)
    {
        $this->tableName = 'product_category';
        $this->primary  = 'product_category_id';

        parent::__construct($services);
    }

}