<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class Acl extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'acl';
        $this->primary  = 'acl_id';

        parent::__construct($services);
    }

    public function getAcls($parent = 0, $level = -1, $data = array())
    {
        $result = $this->getAcl($parent, $level, $data);

        return $result;
    }

    public function getAcl($parent = 0, $level = -1, $data = array())
    {
        $result = $this->fetchWhere([
            'WHERE' => 'acl_parent = ' . $parent,
        ]);

        $level++;

        foreach($result as $row) {
            $acl_id = $row['acl_id'];

            $data[$acl_id] = (array) $row;
            $data[$acl_id]['acl_level'] = $level;

            $result = [];
            $result = $this->fetchWhere([
                'WHERE' => 'acl_parent = ' . $acl_id,
            ]);

            if (count($result) > 0) {
                $data = $this->getAcl($acl_id, $level, $data);
            }
        }
        return $data;
    }

}