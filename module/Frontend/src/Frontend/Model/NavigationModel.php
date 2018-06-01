<?php
namespace Frontend\Model;

use Frontend\Model\MasterModel;
use Zend\Validator\NotEmpty;

class NavigationModel extends MasterModel
{
    public function __construct($services)
    {
        $this->tableName = 'navigation';
        $this->primary  = 'navigation_id';

        $this->tableView = 'view_navigation';

        parent::__construct($services);
    }

    public function getNavigations($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $result = $this->getNavigationLoop($group_navigation_id, $parent, $level, $data);

        return $result;
    }

    public function getNavigationLoop($group_navigation_id = null, $parent = 0, $level = -1, $data = array())
    {
        $sql = 'SELECT * FROM ' . $this->tableView . ' WHERE navigation_status = 1 AND navigation_parent = ' . $parent;

        if ($group_navigation_id != null) {
            $sql .= ' AND group_navigation_id = ' . $group_navigation_id;
        }

        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();

        $level++;

        foreach($result as $row) {
            $menu_id = $row[$this->primary];

            $data[$menu_id] = (array) $row;
            $data[$menu_id]['navigation_level'] = $level;

            $sql = 'SELECT * FROM ' . $this->tableView . ' WHERE navigation_status = 1 AND navigation_parent = ' . $menu_id;

            if ($group_navigation_id != null) {
                $sql .= ' AND group_navigation_id = ' . $group_navigation_id;
            }

            $statement = $this->tableGateway->getAdapter()->query($sql);
            $result = $statement->execute();

            if ($result->count() > 0) {
                $data = $this->getNavigationLoop($group_navigation_id, $menu_id, $level, $data);
            }
        }
        return $data;
    }
}