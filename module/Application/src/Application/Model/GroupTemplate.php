<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class GroupTemplate extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'group_template';
        $this->primary  = 'group_template_id';

        parent::__construct($services);
    }

}