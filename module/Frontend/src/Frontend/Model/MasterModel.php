<?php
namespace Frontend\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

class MasterModel {

    protected $tableGateway;
    protected $dbAdapter;
    protected $services;
    protected $cache;
    protected $tableView;

    public $tableName;
    public $primary;

    public function __construct($services)
    {
        $this->services = $services;
        $this->dbAdapter = $this->services->get('Zend/Db/Adapter/Adapter');
        $this->tableGateway = new TableGateway($this->tableName, $this->dbAdapter);
    }

    public function savePrimary($data, $id = null)
    {
        if ($id == null) {
            $this->tableGateway->insert($data);
            $id = $this->tableGateway->lastInsertValue;
        } else {
            $this->tableGateway->update($data, array($this->primary => $id));
        }

        return $id;
    }

    public function saveWhere($data, $where)
    {
        $this->tableGateway->update($data, $where);
    }

    public function fetchPage($page, $pageItemPerCount)
    {
        $select = new Select($this->tableName);
        $select->order($this->primary . ' DESC');

        $paginatorAdapter = new DbSelect($select, $this->tableGateway->getAdapter());
        $result = new Paginator($paginatorAdapter);

        $result->setCurrentPageNumber($page);
        $result->setItemCountPerPage($pageItemPerCount);

        return $result;
    }

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->tableName;
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();

        $data = [];
        foreach($result as $k => $v) {
            $data[$k] = $v;
        }

        return $data;
    }

    public function fetchWhere($where, $limit = null)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $where;
        if ($limit != null) {
            $sql .= ' LIMIT ' . $limit;
        }
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();

        $data = [];
        foreach($result as $k => $v) {
            $data[$k] = $v;
        }

        return $data;
    }

    public function fetchPrimary($id)
    {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE ' . $this->primary . '=' . $id;
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();
        $data = $result->current();

        return $data;
    }

    public function deletePrimary($id)
    {
        $sql = 'DELETE FROM ' . $this->tableName . ' WHERE ' . $this->primary . '=' . $id;
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();
    }

    public function deleteWhere($where)
    {
        $this->tableGateway->delete($where);
    }

    public function countAll($where = null)
    {
        $sql = 'SELECT count(' . $this->primary . ') as total FROM ' . $this->tableName;

        if ($where != null) {
            $sql .= ' WHERE ' . $where;
        }

        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();
        $result = $result->current();

        $data = $result['total'];

        return $data;

    }
}