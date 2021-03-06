<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class WebsiteGeneral extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'website_general';
        $this->primary  = 'website_general_id';

        parent::__construct($services);
    }

}