<?php
namespace Frontend\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Zend\Validator\Db\NoRecordExists;
use Zend\Validator\EmailAddress;
use Zend\Validator\NotEmpty;

class WebsiteGeneralModel extends MasterModel
{
    public function __construct($services)
    {
        $this->tableName = 'website_general';
        $this->primary  = 'website_general_id';

        parent::__construct($services);
    }
}