<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class Category extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'category';
        $this->primary  = 'category_id';

        parent::__construct($services);
    }

    public function getCategories($type, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->getCategory($type, $parent, $level, $data);

        return $result;
    }

    public function getCategory($type, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->fetchWhere([
            'WHERE' => 'category_parent = ' . $parent . ' AND category_type = ' . $type
        ]);

        $level++;

        foreach($result as $row) {
            $post_category_id = $row[$this->primary];

            $data[$post_category_id] = (array) $row;
            $data[$post_category_id]['category_level'] = $level;

            $result = [];
            $result = $this->fetchWhere([
                'WHERE' => 'category_parent = ' . $post_category_id  . ' AND category_type = ' . $type
            ]);

            if (count($result) > 0) {
                $data = $this->getCategory($type, $post_category_id, $level, $data);
            }
        }
        return $data;
    }

}