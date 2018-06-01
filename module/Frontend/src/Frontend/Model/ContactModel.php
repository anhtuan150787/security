<?php
namespace Frontend\Model;

use Zend\Validator\NotEmpty;

class ContactModel extends MasterModel
{
    protected $inputFilter;

    public function __construct($services)
    {
        $this->tableName = 'contact';
        $this->primary  = 'contact_id';

        parent::__construct($services);
    }


}