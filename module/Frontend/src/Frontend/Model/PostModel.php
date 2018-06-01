<?php
namespace Frontend\Model;

use Zend\Validator\NotEmpty;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class PostModel extends MasterModel
{
    public function __construct($services)
    {
        $this->tableName = 'post'; //VIEW POST
        $this->primary  = 'post_id';

        $this->tableView = 'view_post';

        parent::__construct($services);
    }

    public function fetchPage($page, $pageItemPerCount, $whereIn = null)
    {
        $where = 'post_type = 1 AND post_status = 1';
        $select = new Select($this->tableName);
        $select->order($this->primary . ' DESC');

        if($where != null)
            $where .= ' AND ' . $whereIn;

        $select->where($where);

        $paginatorAdapter = new DbSelect($select, $this->tableGateway->getAdapter());
        $result = new Paginator($paginatorAdapter);

        $result->setCurrentPageNumber($page);
        $result->setItemCountPerPage($pageItemPerCount);

        return $result;
    }

}