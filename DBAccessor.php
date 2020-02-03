<?php

abstract class DBAccessor{

    protected $dbh;
    protected $dbName;
    protected $tableName;

    function __construct($dbName, $tableName, $user, $password)	{
        $dsn = 'mysql:dbname=' . $dbName . ';host=localhost;charset=utf8';

        $this->dbh = new PDO($dsn, $user, $password);
        $this->dbh->query('SET NAMES utf8');
        $this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        $this->tableName = $tableName;
    }

    public function fetchAll(){
        $sql = 'SELECT * FROM ' . $this->tableName . ' ORDER BY id DESC';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    abstract public function insert($param);

    abstract public function delete($entity);
}