<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class Template extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'template';
        $this->primary  = 'template_id';

        parent::__construct($services);
    }

}