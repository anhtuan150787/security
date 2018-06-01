<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class Navigation extends Builder
{
    public function __construct($services)
    {
        $this->table    = 'navigation';
        $this->primary  = 'navigation_id';

        parent::__construct($services);
    }

    public function getNavigations($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->getNavigationLoop($group_navigation_id, $parent, $level, $data);

        return $result;
    }

    public function getNavigationLoop($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->fetchWhere([
            'JOIN' => 'LEFT JOIN group_navigation ON navigation.group_navigation_id = group_navigation.group_navigation_id',
            'WHERE' => 'navigation_parent = ' . $parent . (($group_navigation_id != null) ? ' AND navigation.group_navigation_id = ' . $group_navigation_id : ''),
            'ORDER' => 'navigation_position ASC'
        ]);

        $level++;

        foreach($result as $row) {
            $menu_id = $row[$this->primary];

            $data[$menu_id] = (array) $row;
            $data[$menu_id]['navigation_level'] = $level;

            $result = [];
            $result = $this->fetchWhere([
                'JOIN' => 'LEFT JOIN group_navigation ON navigation.group_navigation_id = group_navigation.group_navigation_id',
                'WHERE' => 'navigation_parent = ' . $menu_id . (($group_navigation_id != null) ? ' AND navigation.group_navigation_id = ' . $group_navigation_id : ''),
                'ORDER' => 'navigation_position ASC'
            ]);

            if (count($result) > 0) {
                $data = $this->getNavigationLoop($group_navigation_id, $menu_id, $level, $data);
            }
        }
        return $data;
    }

    public function getFrontendNavigations($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->getFrontendNavigationLoop($group_navigation_id, $parent, $level, $data);

        return $result;
    }

    public function getFrontendNavigationLoop($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->fetchWhere([
            'JOIN' => 'LEFT JOIN group_navigation ON navigation.group_navigation_id = group_navigation.group_navigation_id',
            'WHERE' => 'navigation_status = 1 AND navigation_parent = ' . $parent . (($group_navigation_id != null) ? ' AND navigation.group_navigation_id = ' . $group_navigation_id : ''),
            'ORDER' => 'navigation_position ASC'
        ]);

        $level++;

        foreach($result as $row) {
            $menu_id = $row[$this->primary];

            $data[$menu_id] = (array) $row;
            $data[$menu_id]['navigation_level'] = $level;

            $result = [];
            $result = $this->fetchWhere([
                'JOIN' => 'LEFT JOIN group_navigation ON navigation.group_navigation_id = group_navigation.group_navigation_id',
                'WHERE' => 'navigation_status = 1 AND navigation_parent = ' . $menu_id . (($group_navigation_id != null) ? ' AND navigation.group_navigation_id = ' . $group_navigation_id : ''),
                'ORDER' => 'navigation_position ASC'
            ]);

            if (count($result) > 0) {
                $data = $this->getFrontendNavigationLoop($group_navigation_id, $menu_id, $level, $data);
            }
        }
        return $data;
    }


}