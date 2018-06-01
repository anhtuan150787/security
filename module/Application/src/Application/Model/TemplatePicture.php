<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class TemplatePicture extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'template_picture';
        $this->primary  = 'template_picture_id';

        parent::__construct($services);
    }

}