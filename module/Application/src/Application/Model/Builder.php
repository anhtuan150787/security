<?php
namespace Application\Model;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class Builder {

    protected $tableGateway;
    protected $dbAdapter;
    protected $services;
    protected $cache;
    protected $tableView;

    public $table;
    public $primary;

    public function __construct($services)
    {
        $this->services = $services;
        $this->dbAdapter = $this->services->get('Zend/Db/Adapter/Adapter');
        $this->tableGateway = new TableGateway($this->table, $this->dbAdapter);
    }

    public function fetchPage($options)
    {
        $page = $options['page'];
        $pageItemPerCount = $options['pageItemPerCount'];

        $start = ($page - 1) * $pageItemPerCount;
        $end = $pageItemPerCount;
        $limit = $start . ',' . $end;

        $resultTotal = $this->fetchWhere($options);
        $total = count($resultTotal);

        $options['LIMMIT'] = $limit;
        $result = $this->fetchWhere($options);

        $resultArray = iterator_to_array($result);

        $paging = new Paginator(new ArrayAdapter($resultArray));
        $paging->setCurrentPageNumber($page);
        $paging->setItemCountPerPage($pageItemPerCount);

        return ['paging' => $paging, 'data' => $resultArray, 'total' => $total];
    }

    public function fetchPrimary($primaryId)
    {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE ' . $this->primary . '=' . $primaryId;

        return $this->getRow($sql);
    }

    public function fetchAll()
    {
        $sql = 'SELECT * FROM ' . $this->table;

        return $this->getFetch($sql);
    }

    public function fetchRow($options)
    {
        $sql = $this->getSql($options);

        return $this->getRow($sql);
    }

    public function fetchWhere($options)
    {
        $sql = $this->getSql($options);

        $result = $this->getFetch($sql);

        return $result;
    }

    public function getSql($options)
    {
        $sql = 'SELECT';

        $columns = ' * ';
        if ($options['COLUMNS']) {
            $columns = ' ' . $options['COLUMNS'];
        }

        $from = ' FROM ' . $this->table;
        if ($options['FROM']) {
            $from = ' FROM ' . $options['FROM'];
        }

        $join = ' ';
        if ($options['JOIN']) {
            $join = ' ' . $options['JOIN'] . ' ';
        }

        $where = ' WHERE 1=1 ';
        if ($options['WHERE']) {
            $where .= ' AND ' . $options['WHERE'];
        }

        $group = ' ';
        if ($options['GROUP']) {
            $group .= ' GROUP BY ' . $options['GROUP'];
        }

        $limit = ' ';
        if ($options['LIMIT']) {
            $limit .= ' LIMIT ' . $options['LIMIT'];
        }

        $order = ' ORDER BY ' . $this->primary . ' DESC';
        if ($options['ORDER']) {
            $order = ' ORDER BY ' . $options['ORDER'];
        }

        $sql .= $columns . $from . $join . $where . $group . $order . $limit;

        return $sql;
    }

    public function getRow($sql)
    {
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();

        return $result->current();
    }

    public function getFetch($sql)
    {
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();

        return $result;
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

    public function deletePrimary($id)
    {
        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->primary . '=' . $id;
        $statement = $this->tableGateway->getAdapter()->query($sql);
        $result = $statement->execute();
    }

    public function deleteWhere($where)
    {
        $this->tableGateway->delete($where);
    }

}