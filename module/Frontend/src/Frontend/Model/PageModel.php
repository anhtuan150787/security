<?php
namespace Frontend\Model;

use Zend\Validator\NotEmpty;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PageModel extends MasterModel
{
    public function __construct($services)
    {
        $this->tableName = 'post'; //VIEW POST
        $this->primary  = 'post_id';

        $this->tableView = 'view_post';

        parent::__construct($services);
    }
}